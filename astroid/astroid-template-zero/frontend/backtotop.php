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

$enable_backtotop = $template->params->get('backtotop', 1);
if (!$enable_backtotop) {
   return;
}

$style = '';
$astyle = '';
$class = [];
$html = '';
$backtotop_icon = $template->params->get('backtotop_icon', 'fas fa-arrow-up');
$backtotop_icon_size = $template->params->get('backtotop_icon_size', 20);
$backtotop_icon_color = $template->params->get('backtotop_icon_color', 'white');
$backtotop_icon_bgcolor = $template->params->get('backtotop_icon_bgcolor', 'blue');
$backtotop_icon_style = $template->params->get('backtotop_icon_style', 'circle');
$backtotop_on_mobile = $template->params->get('backtotop_on_mobile', 1);
$paddingpercent = 10;
$padding = ($backtotop_icon_size / $paddingpercent);
$style .= 'font-size:' . $backtotop_icon_size . 'px; color:' . $backtotop_icon_color . ';';

switch ($backtotop_icon_style) {
   case 'rounded':
      $astyle .= 'border-radius : ' . round($padding) . 'px;';
      break;
   case 'square':
      $style .= 'line-height:' . $backtotop_icon_size . 'px;  padding: ' . round($padding) . 'px';
      break;
   default:
      $style .= 'height:' . $backtotop_icon_size . 'px; width:' . $backtotop_icon_size . 'px; line-height:' . $backtotop_icon_size . 'px; text-align:center;';
      break;
}
$astyle .= 'background:' . $backtotop_icon_bgcolor . ';';
$class[] = $backtotop_icon_style;

if (!$backtotop_on_mobile) {
   $class[] = 'hideonsm';
   $class[] = 'hideonxs';
}

$html .= '<a id="astroid-backtotop" class="' . implode(' ', $class) . '" href="javascript:void(0)" style="' . $astyle . '"><i class="' . $backtotop_icon . '" style="' . $style . '"></i></a>';
echo $html;
?>