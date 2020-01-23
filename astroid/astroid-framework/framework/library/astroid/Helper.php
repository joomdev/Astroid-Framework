<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid;

defined('_JEXEC') or die;

\JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_cache/models', 'CacheModel');

class Helper
{
    public static function loadLanguage($extension, $client = 'site')
    {
        $lang = \JFactory::getLanguage();
        $lang->load($extension, ($client == 'site' ? JPATH_SITE : JPATH_ADMINISTRATOR));
    }

    public static function getPluginParams()
    {
        $plugin = \JPluginHelper::getPlugin('system', 'astroid');
        return new \JRegistry($plugin->params);
    }

    public static function getJoomlaUrl()
    {
        $app = \JFactory::getApplication();
        $atm = $app->input->get('atm', 0, 'INT');
        $id = $app->input->get('id', 0, 'INT');
        if ($atm) {
            return \JRoute::_('index.php?option=com_advancedtemplates&view=style&layout=edit&id=' . $id);
        } else {
            return \JRoute::_('index.php?option=com_templates&view=style&layout=edit&id=' . $id);
        }
    }

    public static function getAstroidUrl($task, $params = [])
    {
        $query = [];
        foreach ($params as $key => $value) {
            $query[] = $key . '=' . $value;
        }
        $query = empty($query) ? '' : '&' . implode('&', $query);
        return \JRoute::_('index.php?option=com_ajax&astroid=save' . $query);
    }

    public static function classify($word)
    {
        return str_replace([' ', '_', '-'], '', ucwords(str_replace('.', '_', $word), ' _-'));
    }

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    public static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }

    public static function title($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    public static function joomlaMediaVersion()
    {
        return \JFactory::getDocument()->getMediaVersion();
    }

    public static function refreshVersion()
    {
        $version = new \JVersion;
        $version->refreshMediaVersion();
    }

    public static function getJSONData($name)
    {
        $json = file_get_contents(ASTROID_MEDIA . '/json/' . $name . '.json');
        return \json_decode($json, true);
    }

    public static function getXml($url)
    {
        return simplexml_load_file($url, 'SimpleXMLElement');
    }

    public static function triggerEvent($name, $data = [])
    {
        \JPluginHelper::importPlugin('astroid');
        \JFactory::getApplication()->triggerEvent($name, $data);
    }

    public static function clearCacheByTemplate($template)
    {
        return self::clearCache($template, ['style', 'custom', 'astroid', 'preset', 'compiled']);
    }

    public static function clearCache($template = '', $prefix = 'style')
    {
        $template_dir = JPATH_SITE . '/' . 'templates' . '/' . $template . '/' . 'css';
        $version = new \JVersion;
        $version->refreshMediaVersion();
        if (!file_exists($template_dir)) {
            throw new \Exception("Template not found.", 404);
        }

        if (is_array($prefix)) {
            foreach ($prefix as $pre) {
                $styles = preg_grep('~^' . $pre . '-.*\.(css)$~', scandir($template_dir));
                foreach ($styles as $style) {
                    unlink($template_dir . '/' . $style);
                }
            }
        } else {
            $styles = preg_grep('~^' . $prefix . '-.*\.(css)$~', scandir($template_dir));
            foreach ($styles as $style) {
                unlink($template_dir . '/' . $style);
            }
        }

        $document = Framework::getDocument();
        self::clearJoomlaCache();
        return true;
    }

    public static function clearJoomlaCache()
    {
        /* $app = \JFactory::getApplication();
        $model = \JModelLegacy::getInstance('Cache', 'CacheModel', array('ignore_request' => true));
        $clients    = array(1, 0);
        foreach ($clients as $client) {
            $mCache = $model->getCache($client);
            foreach ($mCache->getAll() as $cache) {
                $mCache->clean($cache->group);
            }
        }
        $app->triggerEvent('onAfterPurge', array()); */
    }

    public static function minifyCSS($css)
    {
        return str_replace(';}', '}', str_replace('; ', ';', str_replace(' }', '}', str_replace('{ ', '{', str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), "", preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css))))));
    }

    // from AstroidFrameworkHelper

    public static function replaceRelationshipOperators($str)
    {
        $str = str_replace(" AND ", " && ", $str);
        $str = str_replace(" OR ", " || ", $str);
        return $str;
    }

    public static function getJoomlaVersion()
    {
        $version = new \JVersion;
        $version = $version->getShortVersion();
        $version = substr($version, 0, 1);
        return $version;
    }

    public static function getAstroidFieldsets($form)
    {
        $astroidfieldsets = $form->getFieldsets();
        usort($astroidfieldsets, "self::fieldsetOrding");

        $fieldsets = [];

        foreach ($astroidfieldsets as $af) {
            $fieldsets[$af->name] = $af;
        }

        return $fieldsets;
    }

    public static function fieldsetOrding($a, $b)
    {
        if ($a->order == $b->order) {
            return 0;
        }

        if ($a->order == '' || $b->order == '') {
            return 1;
        }

        return ($a->order < $b->order) ? -1 : 1;
    }

    public static function getModules()
    {
        $db = \JFactory::getDbo();
        $query = "SELECT #__modules.*, #__usergroups.title as access_title FROM #__modules JOIN #__usergroups ON #__usergroups.id=#__modules.access WHERE #__modules.client_id=0";

        $db->setQuery($query);
        $results = $db->loadObjectList();

        $return = [];
        foreach ($results as $result) {
            $return[] = ['id' => $result->id, 'title' => $result->title, 'module' => $result->module, 'type' => 'module', 'published' => $result->published, 'access_title' => $result->access_title, 'position' => $result->position, 'showtitle' => $result->showtitle];
        }

        return $return;
    }

    public static function getAllAstroidElements()
    {
        \jimport('astroid.framework.template');
        \jimport('astroid.framework.element');

        $template = Framework::getTemplate();
        // Template Directories
        $elements_dir = JPATH_LIBRARIES . '/astroid/framework/elements/';
        $template_elements_dir = JPATH_SITE . '/templates/' . $template->template . '/astroid/elements/';

        // Getting Elements from Template Directories
        $elements = array_filter(glob($elements_dir . '*'), 'is_dir');
        $template_elements = array_filter(glob($template_elements_dir . '*'), 'is_dir');

        // Merging Elements
        $elements = array_merge($elements, $template_elements);

        $return = array();

        foreach ($elements as $element_dir) {
            $xmlfile = $element_dir . '/' . (str_replace($template_elements_dir, '', str_replace($elements_dir, '', $element_dir))) . '.xml';
            if (file_exists($xmlfile)) {
                $type = str_replace($template_elements_dir, '', str_replace($elements_dir, '', $element_dir));

                $template = new \stdClass();
                $template->template = ASTROID_TEMPLATE_NAME;
                $template->params = new \stdClass();
                $template = Framework::getTemplate();
                $element = new \AstroidElement($type, [], $template);
                $return[] = $element;
            }
        }
        //exit;
        return $return;
    }

    public static function getPositions()
    {
        $template = Framework::getTemplate();
        $templateXML = \JPATH_SITE . '/templates/' . $template->template . '/templateDetails.xml';
        $template = simplexml_load_file($templateXML);
        $positions = [];
        foreach ($template->positions[0] as $position) {
            $p = (string) $position;
            $positions[$p] = $p;
        }
        return $positions;
    }

    public static function frameworkVersion()
    {
        $xml = self::getXML(JPATH_ADMINISTRATOR . '/manifests/libraries/astroid.xml');
        $version = (string) $xml->version;
        return $version;
    }
}
