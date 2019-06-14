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


// Sticky Header
$stick_header_bg_color                 = $template->params->get('stick_header_bg_color', '');
$stick_header_link_color               = $template->params->get('stick_header_menu_link_color', '');
$stick_header_link_hover_color         = $template->params->get('stick_header_menu_link_hover_color', '');
$stick_header_link_active_color        = $template->params->get('stick_header_menu_link_active_color', '');

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

//Miscellaneous -> Contact Us
$icon_color = $template->params->get('icon_color', '');
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
   $header_styles[] = '.astroid-header-section,.astroid-sidebar-header{ background-color: ' . $header_background_color . ' !important;}';
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
?>

<?php
// Sticky Header Coloring
$sticky_header_styles = [];
if (!empty($stick_header_bg_color)) {
   $sticky_header_styles[] = '#astroid-sticky-header{ background-color: ' . $stick_header_bg_color . ' !important;}';
}
if (!empty($stick_header_link_color)) {
   $sticky_header_styles[] = '#astroid-sticky-header .astroid-nav .nav-link{ color: ' . $stick_header_link_color . ' !important;}';
}
if (!empty($stick_header_link_hover_color)) {
   $sticky_header_styles[] = '#astroid-sticky-header .nav-link:hover, .astroid-nav .nav-link:focus{ color: ' . $stick_header_link_hover_color . ' !important;}';
}
if (!empty($stick_header_link_active_color)) {
   $sticky_header_styles[] = '#astroid-sticky-header .nav-link.active{ color: ' . $stick_header_link_active_color . ' !important;}';
}
?>

<?php
// Main Menu Coloring
$main_menu_styles = [];
if (!empty($main_link_color)) {
   $main_menu_styles[] = '.astroid-nav .nav-link{ color: ' . $main_link_color . ' !important;}';
   $main_menu_styles[] = '.astroid-sidebar-menu .nav-link{ color: ' . $main_link_color . ' !important;}';
}
if (!empty($main_link_hover_color)) {
   $main_menu_styles[] = '.astroid-nav .nav-link:hover, .astroid-nav .nav-link:focus{ color: ' . $main_link_hover_color . ' !important;}';
   $main_menu_styles[] = '.astroid-sidebar-menu .nav-link:hover, .astroid-sidebar-menu .nav-link:focus{ color: ' . $main_link_hover_color . ' !important;}';
}
if (!empty($main_link_active_color)) {
   $main_menu_styles[] = '.astroid-nav .nav-link.active{ color: ' . $main_link_active_color . ' !important;}';
   $main_menu_styles[] = '.astroid-sidebar-menu .nav-link.active{ color: ' . $main_link_active_color . ' !important;}';
}
?>

<?php
// Dropdown Coloring
$dropdown_styles = [];
if (!empty($dropdown_main_background_color)) {
   $dropdown_styles[] = '.nav-submenu, .megamenu-container{ background: ' . $dropdown_main_background_color . ' !important;}';
}
if (!empty($dropdown_main_background_color)) {
   $dropdown_styles[] = '.has-megamenu.open .arrow{ border-bottom-color: ' . $dropdown_main_background_color . ' !important;}';
}
if (!empty($dropdown_main_link_color)) {
   $dropdown_styles[] = '.astroid-nav .megamenu-container .megamenu-title, .astroid-nav .megamenu-container li.nav-item-submenu > a{ color: ' . $dropdown_main_link_color . ' !important;}';
}
if (!empty($dropdown_main_active_link_color)) {
   $dropdown_styles[] = '.astroid-nav .megamenu-container li.nav-item-active > a, .menu_open .menu-go-back .fas{ color: ' . $dropdown_main_active_link_color . ' !important;}';
}
if (!empty($dropdown_main_active_background_color)) {
   $dropdown_styles[] = '.astroid-nav .megamenu-container li.nav-item-active > a{ background-color: ' . $dropdown_main_active_background_color . ' !important;}';
}
if (!empty($dropdown_main_hover_link_color)) {
   $dropdown_styles[] = '.astroid-nav .megamenu-container li > a:hover, .astroid-nav .megamenu-submenu-container .megamenu-submenu li > a:hover{ color: ' . $dropdown_main_hover_link_color . ' !important;}';
}
if (!empty($dropdown_main_hover_background_color)) {
   $dropdown_styles[] = '.astroid-nav .megamenu-container li > a:hover, .astroid-nav .megamenu-submenu-container .megamenu-submenu li > a:hover{ background-color: ' . $dropdown_main_hover_background_color . ' !important;}';
}
?>

<?php
// Off-Canvas Coloring
$mobilemenu_styles = [];
if (!empty($mobile_background_color)) {
   $mobilemenu_styles[] = '.astroid-offcanvas, .astroid-mobilemenu, .astroid-mobilemenu-container .astroid-mobilemenu-inner .dropdown-menus,.astroid-offcanvas .burger-menu-button{ background-color: ' . $mobile_background_color . ' !important;}';
}
if (!empty($mobile_menu_text_color)) {
   $mobilemenu_styles[] = '.astroid-offcanvas, .astroid-mobilemenu, .menu_open .menu-indicator-back .fas { color: ' . $mobile_menu_text_color . ' !important;}';
}
if (!empty($mobile_link_color)) {
   $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item a, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-indicator .menu-item .fas{ color: ' . $mobile_link_color . ' !important;}';
}
if (!empty($mobile_hover_background_color)) {
   $mobilemenu_styles[] = '.fgfdfd{ background-color: ' . $mobile_hover_background_color . ' !important;}';
}
if (!empty($mobile_active_link_color)) {
   $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.active > a, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.active > .nav-header, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.nav-item-active > a, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.active > .menu-indicator .fas, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.nav-item-active .fas{ color: ' . $mobile_active_link_color . ' !important;}';
}
if (!empty($mobile_active_background_color)) {
   $mobilemenu_styles[] = '.astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.active, .astroid-mobilemenu-container .astroid-mobilemenu-inner .menu-item.nav-item-active, .menu-go-back { background-color: ' . $mobile_active_background_color . ' !important;}';
}
?>

<?php
//
$contact_icon_color = '';
if (!empty($icon_color)) {
   $contact_icon_color = '.astroid-contact-info i[class*="fa-"]{color:' . $icon_color . ';}';
}
?>

<?php
   $template->addStyledeclaration(implode('', $body_styles));
   $template->addStyledeclaration(implode('', $header_styles));
   $template->addStyledeclaration(implode('', $sticky_header_styles));
   $template->addStyledeclaration(implode('', $main_menu_styles));
   $template->addStyledeclaration(implode('', $dropdown_styles));
   $template->addStyledeclaration(implode('', $mobilemenu_styles));
   $template->addStyledeclaration($contact_icon_color);
?>