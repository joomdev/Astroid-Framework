<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid\Helper;

use Astroid\Helper;

defined('_JEXEC') or die;

class Client
{
    protected $format = 'json';

    public function __construct()
    {
        $this->format = \JFactory::getApplication()->input->get('format', 'json', 'RAW');
    }

    protected function responseMime()
    {
        $mime_types = array(
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $type = isset($mime_types[$this->format]) ? $mime_types[$this->format] : $mime_types['json'];

        header('Content-Type: ' . $type);
    }

    protected function response($data)
    {
        $this->responseMime();
        switch ($this->format) {
            case 'json':
                $return = [];
                $return['status'] = 'success';
                $return['code'] = 200;
                $return['data'] = $data;
                $data = \json_encode($return);
                break;
        }
        echo $data;
        exit();
    }

    protected function errorResponse(\Exception $e)
    {
        $this->responseMime();
        switch ($this->format) {
            case 'json':
                $return = [];
                $return['status'] = 'error';
                $return['code'] = $e->getCode();
                $return['message'] = $e->getMessage();
                $data = \json_encode($return);
                break;
            default:
                $data = $e->getCode() . ' : ' . $e->getMessage();
                break;
        }
        echo $data;
        exit();
    }

    public function execute($task)
    {
        try {
            $func = Helper::classify($task);
            if (!method_exists($this, $func)) {
                return;
            }
            $this->$func();
        } catch (\Exception $e) {
            $this->errorResponse($e);
        }
    }

    protected function checkAuth()
    {
        if (!\JSession::checkToken()) {
            throw new \Exception(\JText::_('ASTROID_AJAX_ERROR'));
        }
    }

    protected function checkAndRedirect()
    {
        if (!\JFactory::getUser()->id) {
            $uri = \JFactory::getURI();
            $return = $uri->toString();
            \JFactory::getApplication()->redirect(\JRoute::_('index.php?ast=' . urlencode(base64_encode($return))));
        }
    }

    public function onContentPrepareForm($form, $data)
    {
        $astroid_dir = 'libraries/astroid';
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
