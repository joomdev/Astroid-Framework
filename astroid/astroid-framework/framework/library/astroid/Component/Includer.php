<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid\Component;

use Astroid\Framework;
use Astroid\Helper;

defined('_JEXEC') or die;

class Includer
{
    public static $params;
    public static function run($content = null)
    {
        if ($content === null) {
            $app = \JFactory::getApplication();
            $body = $app->getBody();
        } else {
            $body = $content;
        }
        $body = preg_replace_callback('/(<astroid:include\s[^>]*type=")([^"]*)("[^>]* \/>)/siU', function ($matches) {
            $html = $matches[0];
            $method = Helper::classify($matches[2]);
            if (method_exists(self::class, '_' . $method)) {
                $method = '_' . $method;
                $html = self::$method();
            }
            return $html;
        }, $body);
        if ($content === null) {
            $app->setBody($body);
        } else {
            return $body;
        }
    }

    public static function _headMeta()
    {
        $document = Framework::getDocument();
        return $document->renderMeta();
    }

    public static function _headStyles()
    {
        $document = Framework::getDocument();
        $content = '';
        $content .= Helper\Head::styles();
        $content .= $document->renderLinks();
        $content .= $document->getStylesheets();
        return $content;
    }

    public static function _headScripts()
    {
        $document = Framework::getDocument();

        $content = '';
        $content .= $document->getScripts('head');
        $content .= $document->getCustomTags('head');
        return $content;
    }

    public static function _bodyScripts()
    {
        $document = Framework::getDocument();
        if (Framework::isSite()) {
            $document->addScript('vendor/astroid/js/script.js', 'body');
        }
        $content = '';
        $content .= $document->getScripts('body');
        $content .= $document->getCustomTags('body');
        return $content;
    }

    public static function _debug()
    {
        $debugger = Framework::getDebugger();
        return $debugger->getReports();
    }
}
