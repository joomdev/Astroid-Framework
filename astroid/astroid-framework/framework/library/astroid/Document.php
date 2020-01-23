<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid;

defined('_JEXEC') or die;

require_once __DIR__ . "/../scssphp/scss.inc.php";

use Leafo\ScssPhp\Compiler;

class Document
{
    protected $_metas = [], $_links = [];
    protected $_javascripts = ['head' => [], 'body' => []];
    protected $_stylesheets = [];
    protected $_scripts = ['head' => [], 'body' => []];
    protected $_styles = ['desktop' => [], 'tablet' => [], 'mobile' => []];
    protected $_customtags = ['head' => [], 'body' => []];
    protected $_dev = null;

    public function include($section, $data = [], $return = false)
    {
        $template = Framework::getTemplate();

        if (Framework::isAdmin() && file_exists(JPATH_LIBRARIES . '/astroid/framework/layouts/' . str_replace('.', '/', $section) . '.php')) {
            $layout = new \JLayoutFile($section, JPATH_LIBRARIES . '/astroid/framework/layouts');
        } else if (file_exists(JPATH_SITE . '/templates/' . $template->template . '/html/frontend/' . str_replace('.', '/', $section) . '.php')) {
            $layout = new \JLayoutFile($section, JPATH_SITE . '/templates/' . $template->template . '/html/frontend');
        } else if (file_exists(JPATH_LIBRARIES . '/astroid/framework/frontend/' . str_replace('.', '/', $section) . '.php')) {
            $layout = new \JLayoutFile($section, JPATH_LIBRARIES . '/astroid/framework/frontend');
        } else {
            return '';
        }

        if ($return) {
            return $layout->render($data);
        }
        echo $layout->render($data);
    }

    public function position($position, $style = 'none')
    {
        if (empty($position)) {
            return '';
        }
        $return = '';
        $beforeContent = $this->_positionContent($position, 'before');
        if (!empty($beforeContent)) {
            $return .= $beforeContent;
        }
        $return .= $this->_position($position, $style);
        $afterContent = $this->_positionContent($position, 'after');
        if (!empty($afterContent)) {
            $return .= $afterContent;
        }
        return $return;
    }

    public function loadModule($content)
    {
        // Expression to search for(module Position)
        $regex = '/{loadposition\s(.*?)}/i';
        preg_match_all($regex, $content, $matches, PREG_SET_ORDER);
        if ($matches) {
            foreach ($matches as $match) {
                $matcheslist = explode(',', $match[1]);
                $position = trim($matcheslist[0]);
                $output = $this->_modulePosition($position);
                // We should replace only first occurrence in order to allow positions with the same name to regenerate their content:
                $content = preg_replace("|$match[0]|", $output, $content, 1);
            }
        }
        // Expression to search for(id)
        $regexmodid = '/{loadmoduleid\s([1-9][0-9]*)}/i';
        preg_match_all($regexmodid, $content, $matchesmodid, PREG_SET_ORDER);
        // If no matches, skip this
        if ($matchesmodid) {
            foreach ($matchesmodid as $match) {
                $id = trim($match[1]);
                $output = $this->_moduleId($id);

                // We should replace only first occurrence in order to allow positions with the same name to regenerate their content:
                $content = preg_replace("|$match[0]|", $output, $content, 1);
            }
        }
        return $content;
    }

    private function _modulePosition($position)
    {
        $this->modules[$position] = '';
        $document = \JFactory::getDocument();
        $renderer = $document->loadRenderer('module');
        $modules = \JModuleHelper::getModules($position);
        ob_start();

        foreach ($modules as $module) {
            echo $renderer->render($module);
        }

        $this->modules[$position] = ob_get_clean();

        return $this->modules[$position];
    }

    private function _moduleId($id)
    {
        $this->modules[$id] = '';
        $document = \JFactory::getDocument();
        $renderer = $document->loadRenderer('module');
        $modules = \JModuleHelper::getModuleById($id);
        ob_start();

        if ($modules->id > 0) {
            echo $renderer->render($modules);
        }

        $this->modules[$id] = ob_get_clean();

        return $this->modules[$id];
    }

    private function _position($position, $style)
    {
        if (empty($position)) {
            return '';
        }
        $return = '';
        $modules = \JModuleHelper::getModules($position);
        if (count($modules)) {
            $return .= '<jdoc:include type="modules" name="' . $position . '" style="' . $style . '" />';
        }
        return $return;
    }

    public function _positionContent($position, $load = 'after')
    {
        $contents = $this->_positionLayouts();
        $return = '';
        if (isset($contents[$position]) && !empty($contents[$position])) {
            foreach ($contents[$position] as $layout) {
                $layout = explode(':', $layout);
                if ($layout[1] == $load) {
                    $return .= $this->include($layout[0], [], true);
                }
            }
        }
        return $return;
    }

    private function _positionLayouts()
    {
        $params = Framework::getTemplate()->getParams();
        $astroidcontentlayouts = $params->get('astroidcontentlayouts', 'social:astroid-top-social:after,contactinfo:astroid-top-contact:after');
        $return = [];
        if (!empty($astroidcontentlayouts)) {
            $astroidcontentlayouts = explode(',', $astroidcontentlayouts);
            foreach ($astroidcontentlayouts as $astroidcontentlayout) {
                $astroidcontentlayout = explode(':', $astroidcontentlayout);
                if (isset($return[$astroidcontentlayout[1]])) {
                    $return[$astroidcontentlayout[1]][] = $astroidcontentlayout[0] . ':' . $astroidcontentlayout[2];
                } else {
                    $return[$astroidcontentlayout[1]] = [];
                    $return[$astroidcontentlayout[1]][] = $astroidcontentlayout[0] . ':' . $astroidcontentlayout[2];
                }
            }
        }
        return $return;
    }

    protected function checkDev()
    {
        $params = Framework::getTemplate()->getParams();
        if ($params->exists('developemnt_mode')) {
            $dev = $params->get('developemnt_mode', 0);
        } else {
            $dev = $params->get('development_mode', 0);
        }
        $this->_dev = ($dev ? true : false);
    }

    public function isDev()
    {
        if ($this->_dev === null) {
            $this->checkDev();
        }
        return $this->_dev;
    }

    public function addMeta($name, $content, $attribs = [])
    {
        $this->_metas[$name] = [
            'name' => $name,
            'content' => $content,
            'attribs' => $attribs
        ];
    }

    public function addLink($href = '', $rel = 'stylesheet', $attribs = ['type' => 'text/css'])
    {
        $this->_links[] = [
            'href' => $href,
            'rel' => $rel,
            'attribs' => $attribs
        ];
    }

    public function renderMeta()
    {
        $html = '';
        foreach ($this->_metas as $meta) {
            $html .= '<meta';
            if (!empty($meta['name'])) {
                $html .= ' name="' . $meta['name'] . '"';
            }
            foreach ($meta['attribs'] as $attribProp => $attribVal) {
                $html .= ' ' . $attribProp . '="' . $attribVal . '"';
            }
            if (!empty($meta['content'])) {
                $html .= ' content="' . $meta['content'] . '"';
            }
            $html .= ' />';
        }
        return $html;
    }

    public function renderLinks()
    {
        $html = '';
        foreach ($this->_links as $link) {
            $html .= '<link';
            if (!empty($link['href'])) {
                $html .= ' href="' . $this->_systemUrl($link['href']) . '"';
            }
            if (!empty($link['rel'])) {
                $html .= ' rel="' . $link['rel'] . '"';
            }
            foreach ($link['attribs'] as $attribProp => $attribVal) {
                $html .= ' ' . $attribProp . '="' . $attribVal . '"';
            }
            $html .= ' />';
        }
        return $html;
    }

    public function addScript($url, $position = 'head', $options = [], $attribs = [])
    {
        if (!is_array($url)) {
            $url = [$url];
        }
        foreach ($url as $u) {
            if (!empty(trim($u))) {
                $script = [];
                $script['url'] = $u;
                $script['attribs'] = $attribs;
                $script['options'] = $options;
                $this->_javascripts[$position][] = $script;
            }
        }
    }

    public function getScripts($position = 'head')
    {
        $html = '';
        foreach ($this->_javascripts[$position] as $javascript) {
            $html .= '<script src="' . $this->_systemUrl($javascript['url']) . '"></script>';
        }
        foreach ($this->_scripts[$position] as $script) {
            $html .= '<script type="' . $script['type'] . '">' . $script['content'] . '</script>';
        }
        return $html;
    }

    public function getCustomTags($position = 'head')
    {
        $content = '';
        foreach ($this->_customtags[$position] as $tag) {
            $content .= $tag;
        }
        return $content;
    }

    protected function _systemUrl(&$url)
    {
        if (file_exists(ASTROID_MEDIA . '/' . $url)) {
            $url = \JURI::root() . 'media/astroid/assets/' . $url;
        } elseif (Framework::isSite() && file_exists(ASTROID_TEMPLATE_PATH . '/' . $url)) {
            $url = \JURI::root() . 'templates/' . Framework::getTemplate()->template . '/' . $url;
        } else if (file_exists(JPATH_SITE . '/' . $url)) {
            $url = \JURI::root() . $url;
        }
        return $url . '?' . Helper::joomlaMediaVersion();
    }

    public function addScriptDeclaration($content, $position = 'head', $type = 'text/javascript')
    {
        if (empty($content)) {
            return;
        }
        $script = [];
        $script['content'] = $content;
        $script['type'] = $type;
        $this->_scripts[$position][] = $script;
    }

    public function addStyleDeclaration($content, $device = 'desktop')
    {
        if (empty($content)) {
            return;
        }
        $this->_styles[$device][] = trim($content);
    }

    public function addStyleSheet($url, $attribs = ['rel' => 'stylesheet', 'type' => 'text/css'])
    {
        if (!is_array($url)) {
            $url = [$url];
        }
        foreach ($url as $u) {
            if (!empty(trim($u))) {
                $stylesheet = ['url' => $u, 'attribs' => $attribs];
                $this->_stylesheets[md5($u)] = $stylesheet;
            }
        }
    }

    public function addCustomTag($content, $position = 'head')
    {
        if (empty($content)) {
            return;
        }
        $this->_customtags[$position][] = trim($content);
    }

    public function loadFontAwesome()
    {
        $this->addStyleSheet("https://use.fontawesome.com/releases/v5.11.2/css/all.css");
    }

    public function getStylesheets()
    {
        $content = '';
        foreach ($this->_stylesheets as $stylesheet) {
            $content .= '<link href="' . $this->_systemUrl($stylesheet['url']) . '"';
            foreach ($stylesheet['attribs'] as $prop => $value) {
                $content .= ' ' . $prop . '="' . $value . '"';
            }
            $content .= ' />';
        }
        return $content;
    }

    public function renderScss($path)
    {
        $template = Framework::getTemplate();
        Helper::clearCache($template->template, ['compiled-scss']);
        $templateScssPath = ASTROID_TEMPLATE_PATH . '/scss/' . $template->template;

        $scss = new Compiler();
        $content = '';
        if (file_exists($templateScssPath . '/variables_override.scss')) {
            $content .= '@import "' . ASTROID_MEDIA . '/vendor/bootstrap/scss/functions";';
            $content .= '@import "' . $templateScssPath . '/variables_override";';
        }

        $content .= '@import "' . ASTROID_MEDIA . '/vendor/bootstrap/scss/bootstrap";';
        $content .= '@import "' . ASTROID_MEDIA . '/vendor/astroid/scss/astroid";';

        if (file_exists($templateScssPath . '/style.scss')) {
            $content .= '@import "' . $templateScssPath . '/style";';
        }

        if (file_exists(ASTROID_TEMPLATE_PATH . '/scss/custom/custom.scss')) {
            $content .= '@import "' . ASTROID_TEMPLATE_PATH . '/scss/custom/custom";';
        }

        $variables = $template->getThemeVariables();
        if (!empty($variables)) {
            $scss->setVariables($variables);
        }
        $css = $scss->compile($content);

        file_put_contents($path, Helper::minifyCSS($css));
    }

    public function renderCss($path = null)
    {
        $template = Framework::getTemplate();
        Helper::clearCache($template->template, ['compiled-css']);
        $cssScript = '';
        foreach ($this->_styles as $device => $css) {
            if ($device == 'mobile') {
                $cssScript .= '@media (max-width: 767.98px) {' . implode('', $this->_styles[$device]) . '}';
            } elseif ($device == 'tablet') {
                $cssScript .= '@media (max-width: 991.98px) {' . implode('', $this->_styles[$device]) . '}';
            } else {
                $cssScript .= implode('', $this->_styles[$device]);
            }
        }
        if ($path !== null) {
            file_put_contents($path, Helper::minifyCSS($cssScript));
        } else {
            return $cssScript;
        }
    }

    public function getBodyClass($extra_class = '')
    {
        $template = Framework::getTemplate();
        
        $params = $template->getParams();
        $app = \JFactory::getApplication();
        $menu = $app->getMenu()->getActive();

        $class = [];
        $class[] = "site";
        $class[] = "astroid-framework";

        $option = $app->input->get('option', '', 'STRING');
        $view = $app->input->get('view', '', 'STRING');
        $layout = $app->input->get('layout', 'default', 'STRING');
        $task = $app->input->get('task', '', 'STRING');
        $header = $params->get('header', TRUE);
        $headerMode = $params->get('header_mode', 'horizontal', 'STRING');
        $Itemid = $app->input->get('Itemid', '', 'INT');

        if (!empty($option)) {
            $class[] = htmlspecialchars(str_replace('_', '-', $option));
        }
        if (!empty($view)) {
            $class[] = 'view-' . $view;
        }
        if (!empty($layout)) {
            $class[] = 'layout-' . $layout;
        }
        if (!empty($task)) {
            $class[] = 'task-' . $task;
        }
        if (!empty($Itemid)) {
            $class[] = 'itemid-' . $Itemid;
        }

        if ($header && !empty($headerMode) && $headerMode == 'sidebar') {
            $sidebarDirection = $params->get('header_sidebar_menu_mode', 'left');
            $class[] = "header-sidebar-" . $sidebarDirection;
        }

        if (isset($menu) && $menu) {
            if ($menu->params->get('pageclass_sfx')) {
                $class[] = $menu->params->get('pageclass_sfx');
            }
            if ($menu->get('alias')) {
                // menu alias without -alias appended will be removed in the next version.
                $class[] = $menu->get('alias');
                $class[] = $menu->get('alias') . '-alias';
            }
        }
        if (!empty($template->id)) {
            $class[] = 'tp-style-' . $template->id;
        }

        $class[] = $template->language;
        $class[] = $template->direction;

        if (!empty($extra_class) && !is_array($extra_class)) {
            $extra_class = [$extra_class];
        }

        if (!empty($extra_class)) {
            foreach ($extra_class as $ext_class) {
                $class[] = $ext_class;
            }
        }

        return implode(' ', $class);
    }

    public function isBuilder()
    {
        $jinput = \JFactory::getApplication()->input;
        $option = $jinput->get('option', '');
        $view = $jinput->get('view', '');
        return (($option == "com_sppagebuilder" && $view == "page") || ($option == "com_quix" && $view == "page") || ($option == "com_jdbuilder" && $view == "page"));
    }

    public function astroidCSS()
    {
        if (file_exists(ASTROID_TEMPLATE_PATH . '/css/compiled-' . ASTROID_TEMPLATE_CSS_VERSION . '.css')) {
            return;
        }

        if (!file_exists(ASTROID_TEMPLATE_PATH . '/css/compiled-' . ASTROID_TEMPLATE_SCSS_VERSION . '.css')) {
            $this->renderScss(ASTROID_TEMPLATE_PATH . '/css/compiled-' . ASTROID_TEMPLATE_SCSS_VERSION . '.css');
        }
        if (!file_exists(ASTROID_TEMPLATE_PATH . '/css/compiled-' . ASTROID_TEMPLATE_MEDIA_VERSION . '.css')) {
            $this->renderCss(ASTROID_TEMPLATE_PATH . '/css/compiled-' . ASTROID_TEMPLATE_MEDIA_VERSION . '.css');
        }

        $content = '';
        $content .= file_get_contents(ASTROID_TEMPLATE_PATH . '/css/compiled-' . ASTROID_TEMPLATE_SCSS_VERSION . '.css');
        $content .= file_get_contents(ASTROID_TEMPLATE_PATH . '/css/compiled-' . ASTROID_TEMPLATE_MEDIA_VERSION . '.css');
        file_put_contents(ASTROID_TEMPLATE_PATH . '/css/compiled-' . ASTROID_TEMPLATE_CSS_VERSION . '.css', $content);
    }
}
