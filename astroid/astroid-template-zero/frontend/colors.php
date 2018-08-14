<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
// No direct access.
defined('_JEXEC') or die;
extract($displayData);

// Body
$body_background_color = $template->params->get('body_background_color', '');
$body_text_color = $template->params->get('body_text_color', '');
$body_link_color = $template->params->get('body_link_color', '');
$body_link_hover_color = $template->params->get('body_link_hover_color', '');

// Header
$header_background_color = $template->params->get('header_bg', '');
$header_text_color = $template->params->get('header_text_color', '');
$header_link_hover_color = $template->params->get('header_link_hover_color', '');
$header_logo_text_color = $template->params->get('header_logo_text_color', '');
$header_logo_text_tagline_color = $template->params->get('header_logo_text_tagline_color', '');
$sticky_header_background_color = $template->params->get('sticky_header_background_color', '');

// Main Menu
$main_link_color = $template->params->get('main_menu_link_color', '');
$main_link_hover_color = $template->params->get('main_menu_link_hover_color', '');
$main_link_active_color = $template->params->get('main_menu_link_active_color', '');

// Dropdown Menu
$dropdown_main_background_color = $template->params->get('dropdown_bg_color', '');
$dropdown_main_link_color = $template->params->get('dropdown_link_color', '');
$dropdown_main_hover_link_color = $template->params->get('dropdown_menu_link_hover_color', '');
$dropdown_main_hover_background_color = $template->params->get('dropdown_menu_hover_bg_color', '');
$dropdown_main_active_link_color = $template->params->get('dropdown_menu_active_link_color', '');
$dropdown_main_active_background_color = $template->params->get('dropdown_menu_active_bg_color', '');

// Mobile OffCanvas
$mobile_background_color = $template->params->get('mobile_backgroundcolor', '');
$mobile_link_color = $template->params->get('mobile_menu_link_color', '');
$mobile_menu_text_color = $template->params->get('mobile_menu_text_color', '');
$mobile_hover_background_color = $template->params->get('mobile_hover_background_color', '');
$mobile_active_link_color = $template->params->get('mobile_menu_active_link_color', '');
$mobile_active_background_color = $template->params->get('mobile_menu_active_bg_color', '');
?>

<?php

// Body Coloring
$body_styles = [];
if (!empty($body_background_color)) {
   $body_styles[] = 'body{background-color: ' . $body_background_color . ';}';
}
if (!empty($body_text_color)) {
   $body_styles[] = 'body{color: ' . $body_text_color . ';}';
}
if (!empty($body_link_color)) {
   $body_styles[] = 'body a{color: ' . $body_link_color . ';}';
}
if (!empty($body_link_hover_color)) {
   $body_styles[] = 'body a:hover{color: ' . $body_link_hover_color . ';}';
}
?>

<?php

// Header Coloring
$header_styles = [];
if (!empty($header_background_color)) {
   $header_styles[] = '.astroid-header-section{ background-color: ' . $header_background_color . ' !important;}';
}
if (!empty($header_text_color)) {
   $header_styles[] = 'header{ color: ' . $header_text_color . ' !important;}';
}
if (!empty($header_logo_text_color)) {
   $header_styles[] = '.astroid-logo-text .site-title{ color: ' . $header_logo_text_color . ' !important;}';
}
if (!empty($header_logo_text_tagline_color)) {
   $header_styles[] = '.astroid-logo-text .site-tagline{ color: ' . $header_logo_text_tagline_color . ' !important;}';
}
if (!empty($sticky_header_background_color)) {
   $header_styles[] = '#astroid-sticky-header{ background-color: ' . $sticky_header_background_color . ' !important;}';
}
?>

<?php

// Main Menu Coloring
$main_menu_styles = [];
if (!empty($main_link_color)) {
   $main_menu_styles[] = '.astroid-nav .nav-link{ color: ' . $main_link_color . ' !important;}';
}
if (!empty($main_link_hover_color)) {
   $main_menu_styles[] = '.astroid-nav .nav-link:hover, .astroid-nav .nav-link:focus{ color: ' . $main_link_hover_color . ' !important;}';
}
if (!empty($main_link_active_color)) {
   $main_menu_styles[] = '.astroid-nav .nav-link.active{ color: ' . $main_link_active_color . ' !important;}';
}
?>

<?php

// Dropdown Coloring
$dropdown_styles = [];
if (!empty($dropdown_main_background_color)) {
   $dropdown_styles[] = '.astroid-nav .navbar-subnav, .astroid-nav .has-subnav.nav-item-level-1.hovered:after, .astroid-nav .has-subnav.nav-item-level-1.hovered:before{ background: ' . $dropdown_main_background_color . ' !important;}';
   $dropdown_styles[] = '.astroid-nav .megamenu-container,.astroid-nav .has-megamenu.nav-item-level-1.hovered:after,.astroid-nav .has-megamenu.nav-item-level-1.hovered:before{ background: ' . $dropdown_main_background_color . ' !important;}';
}
if (!empty($dropdown_main_link_color)) {
   $dropdown_styles[] = '.astroid-nav .navbar-subnav a.nav-link{ color: ' . $dropdown_main_link_color . ' !important;}';
   $dropdown_styles[] = '.astroid-nav .megamenu-container a.nav-link{ color: ' . $dropdown_main_link_color . ' !important;}';
}
if (!empty($dropdown_main_hover_link_color)) {
   $dropdown_styles[] = '.astroid-nav .navbar-subnav a.nav-link:hover{ color: ' . $dropdown_main_hover_link_color . ' !important;}';
   $dropdown_styles[] = '.astroid-nav .megamenu-container a.nav-link:hover{ color: ' . $dropdown_main_hover_link_color . ' !important;}';
}
if (!empty($dropdown_main_hover_background_color)) {
   $dropdown_styles[] = '.astroid-nav .navbar-subnav a.nav-link:hover{ background-color: ' . $dropdown_main_hover_background_color . ' !important;}';
   $dropdown_styles[] = '.astroid-nav .megamenu-container a.nav-link:hover{ background-color: ' . $dropdown_main_hover_background_color . ' !important;}';
}
if (!empty($dropdown_main_active_link_color)) {
   $dropdown_styles[] = '.astroid-nav .navbar-subnav a.nav-link.active{ color: ' . $dropdown_main_active_link_color . ' !important;}';
   $dropdown_styles[] = '.astroid-nav .megamenu-container a.nav-link.active{ color: ' . $dropdown_main_active_link_color . ' !important;}';
}
if (!empty($dropdown_main_active_background_color)) {
   $dropdown_styles[] = '.astroid-nav .navbar-subnav a.nav-link.active{ background-color: ' . $dropdown_main_active_background_color . ' !important;}';
   $dropdown_styles[] = '.astroid-nav .megamenu-container a.nav-link.active{ background-color: ' . $dropdown_main_active_background_color . ' !important;}';
}
?>

<?php

// Mobile Menu Coloring
$mobilemenu_styles = [];
if (!empty($mobile_background_color)) {
   $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item a,.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item .menu-indicator,.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-indicator-back{ background-color: ' . $mobile_background_color . ' !important;}';
}
if (!empty($mobile_menu_text_color)) {
   $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner *{ color: ' . $mobile_menu_text_color . ' !important;}';
}
if (!empty($mobile_link_color)) {
   $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item a, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item .menu-indicator,.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-indicator-back{ color: ' . $mobile_link_color . ' !important;}';
}
if (!empty($mobile_hover_background_color)) {
   $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item a:hover{ background-color: ' . $mobile_hover_background_color . ' !important;}';
}
if (!empty($mobile_active_link_color)) {
   $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item a.active{ color: ' . $mobile_active_link_color . ' !important;}';
}
if (!empty($mobile_active_background_color)) {
   $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item a.active{ background-color: ' . $mobile_active_background_color . ' !important;}';
}
?>

<?php

$document = JFactory::getDocument();
$document->addStyledeclaration(implode('', $body_styles));
$document->addStyledeclaration(implode('', $header_styles));
$document->addStyledeclaration(implode('', $main_menu_styles));
$document->addStyledeclaration(implode('', $dropdown_styles));
$document->addStyledeclaration(implode('', $mobilemenu_styles));
?>