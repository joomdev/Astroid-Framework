<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * 	DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 *  You can easily override all files under /frontend/ folder.
 * 	Just copy the file to ROOT/templates/YOURTEMPLATE/html/frontend/header/ folder to create and override
 */
// No direct access.
defined('_JEXEC') or die;

extract($displayData);

$document = Astroid\Framework::getDocument();
$params = Astroid\Framework::getTemplate()->getParams();
$header = $params->get('header', TRUE);
$header_mode = $params->get('header_mode', 'horizontal');

if (!($header && !empty($header_mode) && $header_mode == 'sidebar')) {
   return;
}

$mode = $params->get('header_sidebar_menu_mode', 'left');

if ($mode == 'left' || $mode == 'right') {
   $document->include('header.sidebar.single-block');
} else {
   $document->include('header.sidebar.double-block');
}
