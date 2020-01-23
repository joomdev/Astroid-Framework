<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid;

defined('_JEXEC') or die;

abstract class Framework
{
    protected static $document = null;
    protected static $template = null;
    protected static $debugger = null;
    protected static $auditor = null;
    protected static $form = null;
    protected static $client = null;
    public static $isAstroid = false;

    public static function init()
    {
        self::check();
        define('_ASTROID', 1);
        if (self::isSite()) {
            $template = \JFactory::getApplication()->getTemplate(true);
            $astId = $template->params->get('astroid', 0);
            if (!empty($astId)) {
                self::$isAstroid = true;
            } else if (file_exists(JPATH_SITE . "/templates/{$template->template}/params/")) {
                self::$isAstroid = true;
            }
            if (self::$isAstroid) {
                self::$template = new Template();
                self::$document = new Document();
            }
        } else {
            $astroid = \JFactory::getApplication()->input->get('astroid', 0, 'RAW');
            $id = \JFactory::getApplication()->input->get('id', 0, 'INT');
            if (!empty($astroid) && !empty($id)) {
                $template = new Template($id);
                if (Helper\Template::isAstroidTemplate($template->template)) {
                    self::$isAstroid = true;
                    self::$template = $template;
                    self::$document = new Document();
                }
            }
        }
        if (self::$isAstroid) {
            self::constants();
            self::$debugger = new Debugger();
        }
    }

    public static function constants()
    {
        define('ASTROID_MEDIA', JPATH_SITE . '/media/astroid/assets');
        define('ASTROID_MEDIA_URL', \JURI::root() . 'media/astroid/assets/');
        define('ASTROID_LAYOUTS', JPATH_LIBRARIES . '/astroid/framework/layouts');
        define('ASTROID_ELEMENTS', JPATH_LIBRARIES . '/astroid/framework/elements');

        if (self::$isAstroid) {
            $template = Framework::getTemplate();
            define('ASTROID_TEMPLATE_PATH', JPATH_SITE . '/templates/' . $template->template);
            define('ASTROID_TEMPLATE_MEDIA_VERSION', md5(md5($template->getParams()->toString())));
            define('ASTROID_TEMPLATE_SCSS_VERSION', md5(serialize($template->getThemeVariables())));
            define('ASTROID_TEMPLATE_CSS_VERSION', md5(ASTROID_TEMPLATE_MEDIA_VERSION . ASTROID_TEMPLATE_SCSS_VERSION));
        }
    }

    public static function getDocument(): Document
    {
        return self::$document;
    }

    public static function getTemplate($id = null): Template
    {
        if ($id !== null) {
            self::$template = new Template($id);
        }
        return self::$template;
    }
    
    public static function getAuditor($id = null): Auditor
    {
        if ($id !== null) {
            self::$auditor = new Auditor($id);
        }
        return self::$auditor;
    }

    public static function getClient(): Helper\Client
    {
        if (self::$client === null) {
            self::$client = self::getClientType() == 'site' ? new Site() : new Admin();
        }
        return self::$client;
    }

    public static function getDebugger(): Debugger
    {
        if (self::$debugger === null) {
            self::$debugger = new Debugger();
        }
        return self::$debugger;
    }

    public static function check()
    {
        if (self::isAdmin() && \JFactory::getUser()->id) {
            $app = \JFactory::getApplication();
            $redirect = $app->input->get->get('ast', '', 'RAW');
            if (!empty($redirect)) {
                $app->redirect(base64_decode(urldecode($redirect)));
            }
        }
    }

    public static function getClientType()
    {
        $app = \JFactory::getApplication();
        return $app->isClient('administrator') ? 'administrator' : 'site';
    }

    public static function isAdmin()
    {
        return self::getClientType() == 'administrator';
    }

    public static function isSite()
    {
        return self::getClientType() == 'site';
    }

    public static function getForm(): Helper\Form
    {
        if (self::$form === null) {
            self::$form = new Helper\Form('template');
        }
        return self::$form;
    }

    public static function forms($form, $data)
    {
        $astroid_dir = 'libraries' . '/' . 'astroid';
        \JForm::addFormPath(JPATH_SITE . '/' . $astroid_dir . '/framework/forms');
        if ($form->getName() == 'com_menus.item') {
            $form->loadFile('menu', false);
            $form->loadFile('banner', false);
            $form->loadFile('og', false);
        }

        if ($form->getName() == 'com_content.article') {
            $form->loadFile('article', false);
            $form->loadFile('blog', false);
            $form->loadFile('opengraph', false);
        }

        if ($form->getName() == 'com_categories.categorycom_content') {
            $form->loadFile('category_blog', false);
        }

        if ($form->getName() == 'com_menus.item' && (isset($data->request['option']) && $data->request['option'] == 'com_content') && (isset($data->request['view']) && $data->request['view'] == 'category') && (isset($data->request['layout']) && $data->request['layout'] == 'blog')) {
            $form->loadFile('menu_blog', false);
        }
        if ($form->getName() == 'com_menus.item' && (isset($data->request['option']) && $data->request['option'] == 'com_content') && (isset($data->request['view']) && $data->request['view'] == 'featured')) {
            $form->loadFile('menu_blog', false);
        }

        if ($form->getName() == 'com_users.user' || $form->getName() == 'com_admin.profile') {
            $form->loadFile('author', false);
        }
    }
}
