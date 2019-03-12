<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
// No direct access.
defined('_JEXEC') or die;

jimport('astroid.framework.menu');

extract($displayData);

/**
 * Layout variables
 * -----------------
 * @var   string   $item            Item Object.
 * @var   string   $options         Astroid Menu Options.
 */
$options = $params['options'];
$item = $params['item'];
$active = $params['active'];
$header = @$params['header'];
$is_mobile_menu = $params['mobilemenu'];
if ($item->type == "heading") {
   $item->flink = 'javascript:void(0);';
}

$attributes = [];
if ($item->anchor_title) {
   $attributes['title'] = $item->anchor_title;
} else {
   $attributes['title'] = $item->title;
}

if ($item->anchor_css) {
   $attributes['class'] = $item->anchor_css;
} else {
   $attributes['class'] = '';
}

if ($item->level == 1 || $is_mobile_menu) {
   $attributes['class'] .= ' nav-link';
}

if ($active) {
   $attributes['class'] .= ' active';
}

if ($item->anchor_rel) {
   $attributes['rel'] = $item->anchor_rel;
}

if ($item->browserNav == 1) {
   $attributes['target'] = '_blank';
   $attributes['rel'] = 'noopener noreferrer';
} elseif ($item->browserNav == 2) {
   $iframe_options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';
   $attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $iframe_options . "'); return false;";
}
$attributes['data-drop-action'] = 'hover';
if (($options->megamenu || ($item->parent && $item->deeper == 1)) && !$is_mobile_menu) {
   $attributes['class'] .= " megamenu-item-link";
   //$attributes['data-jddrop-align'] = ($item->level != 1 ? 'right' : $options->alignment);
   //$attributes['data-jddrop-speed'] = $template->params->get('dropdown_animation_speed', 300);
   //$attributes['data-jddrop-effect'] = $template->params->get('dropdown_animation_type', 'slide');
   //$attributes['data-jddrop-ease'] = $template->params->get('dropdown_animation_ease', 'linear');
   //$attributes['data-jddrop-position'] = ($item->level != 1 ? 'right' : 'bottom');
   if ($item->level == 1) {
      if ($header == 'sticky') {
         //$attributes['data-jddrop-offset'] = '12px';
      } else {
         //$attributes['data-jddrop-offset'] = '17px';
      }
      //$attributes['data-drop-action'] = $template->params->get('menudropeffect', 'hover');
   }
}

if ($attributes['data-drop-action'] == 'click') {
   //$item->flink = 'javascript:void(0);';
}

$attributes['class'] .= " item-link-" . $item->type;
$attributes['class'] .= " item-level-" . $item->level;

$attr = [];
foreach ($attributes as $key => $attribute) {
   $attr[] = $key . '="' . $attribute . '"';
}
?>
<!--menu link starts-->
<a href="<?php echo $item->flink; ?>" <?php echo implode(' ', $attr); ?>>
   <span class="nav-title">
      <?php if (!empty($options->icon)) { ?>
         <i class="<?php echo $options->icon; ?>"></i>
      <?php } ?>
      <?php if (!$options->icononly) { ?>
         <?php if (!empty($item->menu_image)) { ?>
            <img src="<?php echo JURI::root() . $item->menu_image; ?>" />
         <?php } ?>
         <?php if (!empty($item->menu_image) && $item->params->get('menu_text', 1)) { ?>
            <?php echo $item->title; ?>
         <?php } else if (!empty($item->menu_image) && !$item->params->get('menu_text', 1)) { ?>

         <?php } else { ?>
            <?php echo $item->title; ?>
         <?php } ?>
      <?php } ?>
      <?php if ($options->badge) { ?>
         <?php if ($item->level == 1) { ?>
            <sup>
               <span class="menu-item-badge" style="background: <?php echo $options->badge_bgcolor ?>; color: <?php echo $options->badge_color ?> !important;">
                  <?php echo $options->badge_text; ?>
               </span>
            </sup>
         <?php } else { ?>
            <span class="menu-item-badge" style="background: <?php echo $options->badge_bgcolor ?> !important; color: <?php echo $options->badge_color ?>;">
               <?php echo $options->badge_text; ?>
            </span>
         <?php } ?>
      <?php } ?>
      <?php if (!$is_mobile_menu && $item->level == 1 && (($item->parent && $item->deeper == 1) || $options->megamenu)) { ?>
         <i class="fa fa-chevron-down nav-item-caret"></i>
      <?php } elseif (!$is_mobile_menu && $item->parent && !($item->type == "heading" || $item->type == "separator")) { ?>
         <i class="fa fa-chevron-right nav-item-caret"></i>
      <?php } ?>
   </span>
   <?php if (!$is_mobile_menu && $item->level == 1 && !empty($options->subtitle)) { ?>
      <small class="nav-subtitle"><?php echo $options->subtitle ?></small>
   <?php } ?>
</a>
<!--menu link ends-->