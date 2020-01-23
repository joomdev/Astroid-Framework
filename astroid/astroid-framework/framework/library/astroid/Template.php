<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid;

defined('_JEXEC') or die;

class Template
{
    protected $jtemplate = null;
    public $template = null;
    public $language = '';
    public $direction = '';
    public $id = 0;
    protected $params = null;
    protected static $presets = null;
    protected static $fonts = null;

    public function __construct($id = null)
    {
        if ($id === null) {
            $this->jtemplate = \JFactory::getApplication()->getTemplate(true);
        } else {
            $this->jtemplate = $this->_getById($id);
        }

        $this->template = $this->jtemplate->template;
        $this->language = \JFactory::getLanguage()->getTag();
        $this->direction = \JFactory::getLanguage()->isRtl() ? 'rtl' : 'ltr';

        $this->title = isset($this->jtemplate->title) ? $this->jtemplate->title : '';
        if (!defined('ASTROID_TEMPLATE_NAME')) {
            define('ASTROID_TEMPLATE_NAME', $this->template);
        }
        $this->params = new \JRegistry();
        $this->_ID();
        $this->loadParams();
        if (Framework::isAdmin()) {
            $this->version = $this->_version();
            $this->astroidVersion = Helper::frameworkVersion();
        }
    }

    protected function _version()
    {
        $xml = Helper::getXML(JPATH_SITE . "/templates/{$this->template}/templateDetails.xml");
        $version = (string) $xml->version;
        return $version;
    }

    protected function _ID()
    {
        if (!isset($this->jtemplate->id) || empty($this->jtemplate->id)) {
            $astId = $this->jtemplate->params->get('astroid', 0);
            if (!empty($astId)) {
                $this->id = $astId;
            }
        } else {
            $this->id = $this->jtemplate->id;
        }
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getThemeVariables()
    {
        $variables = [];
        $variables['blue'] = $this->params->get('theme_blue', '#007bff');
        $variables['indigo'] = $this->params->get('theme_indigo', '#6610f2');
        $variables['purple'] = $this->params->get('theme_purple', '#6f42c1');
        $variables['pink'] = $this->params->get('theme_pink', '#e83e8c');
        $variables['red'] = $this->params->get('theme_red', '#dc3545');
        $variables['orange'] = $this->params->get('theme_orange', '#fd7e14');
        $variables['yellow'] = $this->params->get('theme_yellow', '#ffc107');
        $variables['green'] = $this->params->get('theme_green', '#28a745');
        $variables['teal'] = $this->params->get('theme_teal', '#20c997');
        $variables['cyan'] = $this->params->get('theme_cyan', '#17a2b8');
        $variables['white'] = $this->params->get('theme_white', '#fff');
        $variables['gray100'] = $this->params->get('theme_gray100', '#f8f9fa');
        $variables['gray600'] = $this->params->get('theme_gray600', '#6c757d');
        $variables['gray800'] = $this->params->get('theme_gray800', '#343a40');
        $primary = $this->params->get('theme_primary', 'blue');
        $variables['primary'] = $variables[$primary];
        $secondary = $this->params->get('theme_secondary', 'gray600');
        $variables['secondary'] = $variables[$secondary];
        $success = $this->params->get('theme_success', 'green');
        $variables['success'] = $variables[$success];
        $info = $this->params->get('theme_info', 'cyan');
        $variables['info'] = $variables[$info];
        $warning = $this->params->get('theme_warning', 'yellow');
        $variables['warning'] = $variables[$warning];
        $danger = $this->params->get('theme_danger', 'red');
        $variables['danger'] = $variables[$danger];
        $light = $this->params->get('theme_light', 'gray100');
        $variables['light'] = $variables[$light];
        $dark = $this->params->get('theme_dark', 'gray800');
        $variables['dark'] = $variables[$dark];
        $variables = $this->_variableOverrides($variables);
        return $variables;
    }

    protected function _variableOverrides($variables)
    {
        $sass_overrides = $this->params->get('sass_overrides');
        $sass_overrides = \json_decode($sass_overrides, true);
        if (empty($sass_overrides)) {
            return $variables;
        }

        foreach ($sass_overrides as $sass_override) {
            $variable = $sass_override['variable'];
            if (!empty($variable) && !empty($sass_override['value'])) {
                if (substr($variable, 0, 1) === "$") {
                    $variable = ltrim($variable, '$');
                }
                $variables[$variable] = $sass_override['value'];
            }
        }
        return $variables;
    }

    protected function _getById($id)
    {
        $db = \JFactory::getDbo();
        $query = "SELECT `template`,`id`,`title` FROM `#__template_styles` WHERE `id`='$id'";
        $db->setQuery($query);
        $result = $db->loadObject();
        if (!empty($result)) {
            return $result;
        } else {
            return \JFactory::getApplication()->getTemplate(true);
        }
    }

    protected function _getPresets()
    {
        $presets_path = JPATH_SITE . "/templates/{$this->template}/astroid/presets/";
        if (!file_exists($presets_path)) {
            return [];
        }
        $files = array_filter(glob($presets_path . '/' . '*.json'), 'is_file');
        $presets = [];
        foreach ($files as $file) {
            $json = file_get_contents($file);
            $data = \json_decode($json, true);
            $preset = ['title' => pathinfo($file)['filename'], 'colors' => [], 'preset' => [], 'thumbnail' => '', 'name' => pathinfo($file)['filename']];
            if (isset($data['title']) && !empty($data['title'])) {
                $preset['title'] = \JText::_($data['title']);
            }
            if (isset($data['thumbnail']) && !empty($data['thumbnail'])) {
                $preset['thumbnail'] = \JURI::root() . 'templates/' . $this->template . '/' . $data['thumbnail'];
            }
            if (isset($data['colors'])) {
                $colors = [];
                $properties = [];
                foreach ($data['colors'] as $prop => $color) {
                    if (is_array($color)) {
                        foreach ($color as $subprop => $color2) {
                            if (!empty($color2)) {
                                $properties[$prop][$subprop] = $color2;
                                $colors[] = $color2;
                            }
                        }
                    } else {
                        if (!empty($color)) {
                            $properties[$prop] = $color;
                            $colors[] = $color;
                        }
                    }
                }
                $colors = array_keys(array_count_values($colors));
                $preset['colors'] = array_unique($colors);
                $preset['preset'] = $properties;
            }
            $presets[$preset['name']] = $preset;
        }
        return $presets;
    }

    public function getPresets()
    {
        if (self::$presets === null) {
            self::$presets = $this->_getPresets();
        }

        return self::$presets;
    }

    protected function loadParams()
    {
        $path = JPATH_SITE . "/templates/{$this->template}/params/" . $this->id . '.json';
        $json = file_get_contents($path);
        $this->params->loadString($json, 'JSON');
    }

    public function setPreset($preset)
    {
        $presets = $this->getPresets();
        if (!in_array($preset, $presets)) {
            return;
        }

        $data = $presets[$preset];
        foreach ($data as $attr => $val) {
            if (is_array($val)) {
                $obj = $this->params->get($attr);
                foreach ($val as $subattr => $subval) {
                    $obj->{$subattr} = $subval;
                }
                $this->params->set($attr, $obj);
            } else {
                $this->params->set($attr, $val);
            }
        }
    }

    public function getFonts()
    {
        if (self::$fonts === null) {
            self::$fonts = Helper\Font::getUploadedFonts($this->template);
        }
        return self::$fonts;
    }

    public function setLog($text, $type = 'success')
    {
    }

    public function getLayout()
    {
        $layout = $this->params->get("layout", NULL);
        if ($layout === NULL) {
            $value = \file_get_contents(ASTROID_MEDIA . '/json/layouts/default.json');
            $layout = \json_decode($value, true);
        } else {
            $layout = \json_decode($layout, true);
        }
        return $layout;
    }

    public function getElementLayout($type)
    {
        $template_path = JPATH_SITE . "/templates/{$this->template}/astroid/elements";
        if (file_exists($template_path . '/' . $type . '/' . $type . '.php')) {
            return $template_path . '/' . $type . '/' . $type . '.php';
        }

        if (file_exists(ASTROID_ELEMENTS . '/' . $type . '/' . $type . '.php')) {
            return ASTROID_ELEMENTS . '/' . $type . '/' . $type . '.php';
        }

        throw new \Exception("Astroid can not found layout for `" . $type . "` element.");
    }
}
