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

$enable_footer = $template->params->get('footer', 0);
if ($enable_footer) {
   $footer_copyright = $template->params->get('footer_copyright');
   // values to find & replace	
   $year = JFactory::getDate()->format('Y');
   $sitename = JFactory::getApplication()->get('sitename');
   $find = array('{year}', '{sitename}');
   $replace = array($year, $sitename);
   $footertext = str_replace($find, $replace, $footer_copyright);
   $html = '<div id="astroid-footer" class="astroid-footer">' . $footertext . '</div>';
   echo $html;
}
?> 