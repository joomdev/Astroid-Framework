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

$enable_footer = $template->params->get('footer', 0);
if ($enable_footer) {
   $footer_copyright = $template->params->get('footer_copyright');
   // values to find & replace	
   $year = JFactory::getDate()->format('Y');
   $sitename = JFactory::getApplication()->get('sitename');
   $find = array('{year}', '{sitename}');
   $replace = array($year, $sitename);
   $footertext = str_replace($find, $replace, $footer_copyright);
   $html = '<div id="astroid-footer" class="py-3">' . $footertext . ' <br><a href="https://www.joomdev.com/products/templates" target="_blank">Free Joomla Templates</a> by <a href="https://www.joomdev.com" target="_blank">JoomDev</a></div>';
   echo $html;
}
?> 