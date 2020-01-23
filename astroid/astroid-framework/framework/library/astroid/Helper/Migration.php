<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

namespace Astroid\Helper;

defined('_JEXEC') or die;

// #1 `classname` and it's function `funcname` is deprecated and no longer suppoerted. use `funcname` instead of. see #link
// #2 `classname` is deprecated and no longer suppoerted. use `classname` instead of. see #link

class Migration
{
    public static $funcmap = [
        // AstroidFramework
        'AstroidFramework_getTemplate' => [1, 'Astroid\Framework::getTemplate()'],
        'AstroidFramework_addStyleSheet' => [1, 'Astroid\Framework::getDocument()->addStyleSheet($url, $attribs)'],
        'AstroidFramework_addStyleDeclaration' => [1, 'Astroid\Framework::getDocument()->addStyleDeclaration($css)'],
        'AstroidFramework_addScript' => [1, 'Astroid\Framework::getDocument()->addScript($js, $position)'],
        'AstroidFramework_addScriptDeclaration' => [1, 'Astroid\Framework::getDocument()->addScriptDeclaration($js, $position)'],

        // AstroidFrameworkConstants
        'AstroidFrameworkConstants' => [2, 'Astroid\Helper\Constants'],

    ];

    public static function check($classname = '', $method = '', $delimeter = '__')
    {
        if (!isset(self::$funcmap[$classname . $delimeter . $method])) {
            return;
        }
        $migrate = self::$funcmap[$classname . $delimeter . $method];
    }

    public static function checkStatic($classname = '', $method = '', $delimeter = '__')
    {
        return self::check($classname, $method, '_');
    }
}
