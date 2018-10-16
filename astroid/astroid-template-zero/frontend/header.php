<?php
/**
 * @package		Astroid Framework
 * @author		JoomDev https://www.joomdev.com
 * @copyright	Copyright (C) 2009 - 2018 JoomDev.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
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