<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * 	DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 *  You can easily override all files under /frontend/ folder.
 *	Just copy the file to ROOT/templates/YOURTEMPLATE/html/frontend/ folder to create and override
 */
defined('_JEXEC') or die;
extract($displayData);
jimport('astroid.framework.menu');
$header = $template->params->get('header', TRUE);
$mode = $template->params->get('header_mode', 'horizontal');

if (!$header) {
   return;
}
$template->loadLayout('header.' . $mode, true);
$enable_sticky_menu = $template->params->get('enable_sticky_menu', false);
if ($enable_sticky_menu) {
   $template->loadLayout('header.sticky', true);
}
?>