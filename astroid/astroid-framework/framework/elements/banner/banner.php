<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 * You can easily override all files under /astroid/ folder.
 * Just copy the file to JROOT/templates/YOUR_ASTROID_TEMPLATE/astroid/elements/banner/banner.php folder to create and override
 * See https://docs.joomdev.com/article/override-core-layouts/ for documentation
 */
// No direct access.
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$jinput = $app->input;
$menuId = $jinput->get('Itemid', 0, 'INT');

$menu = $app->getMenu();
$item = $menu->getItem($menuId);
if (empty($item)) {
   return;
}

$params = new JRegistry();
$params->loadString($item->params);

$astroid_banner_visibility = $params->get('astroid_banner_visibility', "currentPage");
if ($astroid_banner_visibility == "currentPage") {
   if ((isset($item->query['option']) && $item->query['option'] != $jinput->get('option', '')) || (isset($item->query['view']) && $item->query['view'] != $jinput->get('view', '')) || (isset($item->query['layout']) && $item->query['layout'] != $jinput->get('layout', ''))) {
      return;
   }
}
$style = [];

$astroid_banner_enabled = $params->get('astroid_banner_enabled');
if ($astroid_banner_enabled) {
   $astroid_banner_title_enabled = $params->get('astroid_banner_title_enabled', 1);
   if ($astroid_banner_title_enabled) {
      $astroid_banner_title = $params->get('astroid_banner_title', '');
      $astroid_banner_subtitle = $params->get('astroid_banner_subtitle', '');
      $astroid_banner_title = empty($astroid_banner_title) ? $item->title : $astroid_banner_title;
      $astroid_banner_title_tag = $params->get('astroid_banner_title_tag', 'h3');
   }
   $astroid_banner_bgcolor = $params->get('astroid_banner_bgcolor', '');

   $astroid_banner_bgimage = $params->get('astroid_banner_bgimage', '');
   $astroid_banner_bgimage_position = $params->get('astroid_banner_bgimage_position', '');
   if ($astroid_banner_bgimage_position == 'custom') {
      $astroid_banner_bgimage_position_x = $params->get('astroid_banner_bgimage_position_x', '');
      $astroid_banner_bgimage_position_y = $params->get('astroid_banner_bgimage_position_y', '');
      if (!empty($astroid_banner_bgimage_position_x)) {
         $style[] = 'background-position-x:'.$astroid_banner_bgimage_position_x;
      }
      if (!empty($astroid_banner_bgimage_position_y)) {
         $style[] = 'background-position-y:'.$astroid_banner_bgimage_position_y;
      }
   } elseif (!empty($astroid_banner_bgimage_position)) {
      $style[] = 'background-position:'.$astroid_banner_bgimage_position;
   }
   $astroid_banner_bgimage_repeat = $params->get('astroid_banner_bgimage_repeat', '');
   if (!empty($astroid_banner_bgimage_repeat)) {
      $style[] = 'background-repeat:'.$astroid_banner_bgimage_repeat;
   }
   $astroid_banner_bgimage_size = $params->get('astroid_banner_bgimage_size', '');
   if ($astroid_banner_bgimage_size == 'custom') {
      $astroid_banner_bgimage_width = $params->get('astroid_banner_bgimage_width', '');
      if (!empty($astroid_banner_bgimage_width)) {
         $style[] = 'background-size:'.$astroid_banner_bgimage_width;
      }
   } elseif (!empty($astroid_banner_bgimage_size)) {
      $style[] = 'background-size:'.$astroid_banner_bgimage_size;
   }

   $astroid_banner_bgimage_attachment = $params->get('astroid_banner_bgimage_attachment', '');
   if (!empty($astroid_banner_bgimage_attachment)) {
      $style[] = 'background-attachment:'.$astroid_banner_bgimage_attachment;
   }

   $astroid_banner_class = $params->get('astroid_banner_class', '');
   $astroid_banner_wrapper = $params->get('astroid_banner_wrapper', '');
   $astroid_banner_textcolor = $params->get('astroid_banner_textcolor', '');


   if (!empty($astroid_banner_bgcolor)) {
      $style[] = 'background-color:'.$astroid_banner_bgcolor;
   }
   if (!empty($astroid_banner_bgimage)) {
      $style[] = 'background-image:url('.$astroid_banner_bgimage.')';
   }
   $style = !empty($style) ? 'style="'.implode(';', $style).'"' : '';
   $styletext = [];
   if (!empty($astroid_banner_textcolor)) {
      $styletext[] = 'color:'.$astroid_banner_textcolor;
   }
   $styletext = !empty($styletext) ? 'style="'.implode(';', $styletext).'"' : '';
   ?>
   <div class="astroid-banner-inner<?php echo !empty($astroid_banner_class) ? ' '.$astroid_banner_class : ''; ?>" <?php echo $style; ?>>
      <?php
         if (!empty($astroid_banner_wrapper)) {
            echo '<div class="'.$astroid_banner_wrapper.'">';
         }
         if ($astroid_banner_title_enabled) {
            echo '<'.$astroid_banner_title_tag.' class="astroid-banner-title"'.$styletext.'>'.$astroid_banner_title.'</'.$astroid_banner_title_tag.'>';
            if (!empty($astroid_banner_subtitle)) {
               echo '<span class="astroid-banner-subtitle"'.$styletext.'>'.$astroid_banner_subtitle.'</span>';
            }
         }
         if (!empty($astroid_banner_wrapper)) {
            echo '</div>';
         }
         ?>
   </div>
<?php
}
?>