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
$class = '';
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
if ($backtotop_icon_style == 'circle') {
   $style .= 'height:' . $backtotop_icon_size . 'px; width:' . $backtotop_icon_size . 'px; line-height:' . $backtotop_icon_size . 'px; text-align:center;';
} elseif ($backtotop_icon_style == 'rounded') {
   $astyle .= 'border-radius : ' . round($padding) . 'px;';
} else {
   $style .= 'line-height:' . $backtotop_icon_size . 'px;  padding: ' . round($padding) . 'px';
}
$astyle .= 'background:' . $backtotop_icon_bgcolor . ';';
$class .= 'icon-style-' . $backtotop_icon_style;
if ($backtotop_on_mobile == 0) {
   $html .= '<a id="astroid-backtotop" class="hide-sm ' . $backtotop_icon_style . '" href="javascript:void(0)" style="' . $astyle . '"><i class="' . $backtotop_icon . ' " style="' . $style . '"></i></a>';
} else {
   $html .= '<a id="astroid-backtotop" class="' . $backtotop_icon_style . '" href="javascript:void(0)" style="' . $astyle . '"><i class="' . $backtotop_icon . '" style="' . $style . '"></i></a>';
}
echo $html;
?>

