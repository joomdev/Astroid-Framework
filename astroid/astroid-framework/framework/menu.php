<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
jimport('astroid.framework.constants');
jimport('joomla.application.module.helper');

class AstroidMenu {

   public static function getMenu($menutype = '', $nav_class = [], $logo = null, $logoOdd = 'left', $headerType = 'horizontal', $nav_wrapper_class = []) {
      if (empty($menutype)) {
         return '';
      }

      $list = self::getList($menutype);
      $base = self::getBase();
      $active = self::getActive();
      $default = self::getDefault();
      $active_id = $active->id;
      $default_id = $default->id;
      $path = $base->tree;
      $showAll = 1;

      $return = [];
      echo '<div class="' . (!empty($nav_wrapper_class) ? ' ' . implode(' ', $nav_wrapper_class) : '') . '"><ul class="' . implode(' ', $nav_class) . '">';
      $megamenu = false;

      $count_menu = 0;
      foreach ($list as $i => &$item) {
         if ($item->level == 1) {
            $count_menu++;
         }
      }
      $logo_position = $count_menu / 2;
      $logo_position = (int) $logo_position;
      if ($count_menu % 2 != 0) {
         $logo_position = $logoOdd == 'left' ? $logo_position + 1 : $logo_position;
      }

      $logo_position_count = 0;
      $astroid_menu_options = new stdClass();
      foreach ($list as $i => &$item) {
         $params_astroid_menu_options = $item->params->get('astroid_menu_options', NULL);
         if ($params_astroid_menu_options !== NULL) {
            $astroid_menu_options = $params_astroid_menu_options;
         } else if ($item->level != 1 && $params_astroid_menu_options == NULL) {
            $parent_options = new stdClass();
            $parent_options->width = (string) @$astroid_menu_options->width;
            $astroid_menu_options = $parent_options;
         }

         if ($item->level == 1 && $params_astroid_menu_options == NULL) {
            $astroid_menu_options = new stdClass();
         }

         if ($item->level == 1) {
            $megamenu = (bool) @$astroid_menu_options->megamenu;
         }

         $class = ['nav-item', 'nav-item-level-' . $item->level];
         $class[] = 'item-' . $item->id;

         if ($item->id == $default_id) {
            $class[] = 'default';
         }

         if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id)) {
            $class [] = 'current';
         }

         if (in_array($item->id, $path)) {
            $class[] = 'active';
         } elseif ($item->type === 'alias') {
            $aliasToId = $item->params->get('aliasoptions');

            if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
               $class[] = 'active';
            } elseif (in_array($aliasToId, $path)) {
               $class[] = 'alias-parent-active';
            }
         }

         if ($item->type === 'separator') {
            $class[] = 'divider';
         }

         if ($item->deeper) {
            $class[] = 'deeper';
         }

         if ($item->parent) {
            $class[] = 'parent';
         }

         if ($megamenu) {
            $class[] = 'has-megamenu';
         } else {
            if ($item->parent) {
               $class[] = 'has-subnav';
            }
         }

         if ($item->level == 1) {
            if (($logo_position_count == $logo_position) && $logo !== null) {
               $app = JFactory::getApplication();
               $template = $app->getTemplate(true);
               $template = new AstroidFrameworkTemplate($template);
               echo '<li class="nav-item nav-stacked-logo flex-grow-1 text-center">';
               $template->loadLayout('logo');
               echo '</li>';
            }
            $logo_position_count++;
         }

         $customclass = (string) @$astroid_menu_options->customclass;
         $icon = (string) @$astroid_menu_options->icon;
         $showtitle = (string) @$astroid_menu_options->showtitle;
         $subtitle = (string) @$astroid_menu_options->subtitle;
         $width = (string) @$astroid_menu_options->width;
         $width = empty($width) ? '280px' : $width;

         $alignment = (string) @$astroid_menu_options->alignment;
         $alignment = empty($alignment) ? 'left' : $alignment;

         $item->icon = $icon;
         $item->showtitle = $showtitle;
         $item->subtitle = $subtitle;
         if (!empty($customclass)) {
            $class[] = $customclass;
         }

         if ($megamenu && $item->level == 1) {
            echo '<li class="' . \implode(' ', $class) . '">';
            echo self::getAnchor($item, in_array('active', $class));
            echo self::getMegaMenu($item, $astroid_menu_options, $list);
            echo '</li>';
         } elseif (!$megamenu) {
            echo '<li class="' . \implode(' ', $class) . '">';

            echo self::getAnchor($item, in_array('active', $class));

            // The next item is deeper.
            if ($item->deeper) {
               $styles = [];
               if (!empty($width)) {
                  $styles[] = 'width:' . $width;
               }

               echo '<ul style="' . implode($styles) . '" class="nav-child list-group navbar-subnav level-' . $item->level . '" data-align="' . $alignment . '">';
            }
            // The next item is shallower.
            elseif ($item->shallower) {
               echo '</li>';
               echo str_repeat('</ul></li>', $item->level_diff);
            }
            // The next item is on the same level.
            else {
               echo '</li>';
            }
         }
      }
      echo '</ul></div>';
   }

   public static function getMegaMenuSubItems($parent, $listAll) {
      $base = self::getBase();
      $active = self::getActive();
      $default = self::getDefault();
      $active_id = $active->id;
      $default_id = $default->id;
      $path = $base->tree;

      $return = [];

      $list = [];

      foreach ($listAll as $i => &$item) {
         if ($item->parent_id != $parent->id) {
            continue;
         }
         $list[] = $item;
      }

      echo '<ul class="nav-child list-group navbar-subnav level-' . $parent->level . '">';
      foreach ($list as $i => &$item) {

         $class = ['nav-item', 'nav-item-level-' . $item->level];
         $class[] = 'item-' . $item->id;

         if ($item->id == $default_id) {
            $class[] = 'default';
         }

         if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id)) {
            $class [] = 'current';
         }

         if (in_array($item->id, $path)) {
            $class[] = 'active';
         } elseif ($item->type === 'alias') {
            $aliasToId = $item->params->get('aliasoptions');

            if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
               $class[] = 'active';
            } elseif (in_array($aliasToId, $path)) {
               $class[] = 'alias-parent-active';
            }
         }

         if ($item->type === 'separator') {
            $class[] = 'divider';
         }

         if ($item->deeper) {
            $class[] = 'deeper';
         }

         if ($item->parent) {
            $class[] = 'parent';
         }

         if ($item->parent) {
            $class[] = 'has-subnav';
         }

         echo '<li class="' . \implode(' ', $class) . '">';
         echo self::getAnchor($item, in_array('active', $class));
         if ($item->parent) {
            self::getMegaMenuSubItems($item, $listAll);
         }
         echo '</li>';
      }
      echo '</ul>';
   }

   public static function getMobileMenu($menutype = '') {
      if (empty($menutype)) {
         return '';
      }

      //echo '<button type="button" class="btn btn-primary mobile-trigger d-lg-none"><i class="fas fa-bars"></i></button>';

      $list = self::getList($menutype);
      $base = self::getBase();
      $active = self::getActive();
      $default = self::getDefault();
      $active_id = $active->id;
      $default_id = $default->id;
      $path = $base->tree;
      $showAll = 1;

      $return = [];
      echo '<ul class="astroid-mobile-menu d-none">';
      $megamenu = false;
      $count_menu = 0;
      foreach ($list as $i => &$item) {
         if ($item->level == 1) {
            $count_menu++;
         }
      }

      foreach ($list as $i => &$item) {

         $astroid_menu_options = $item->params->get('astroid_menu_options', []);
         if ($item->level == 1) {
            $megamenu = (bool) @$astroid_menu_options->megamenu;
         }

         $class = ['nav-item', 'nav-item-level-' . $item->level];
         $class[] = 'item-' . $item->id;

         if ($item->id == $default_id) {
            $class[] = 'default';
         }

         if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id)) {
            $class [] = 'current';
         }

         if (in_array($item->id, $path)) {
            $class[] = 'active';
         } elseif ($item->type === 'alias') {
            $aliasToId = $item->params->get('aliasoptions');

            if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
               $class[] = 'active';
            } elseif (in_array($aliasToId, $path)) {
               $class[] = 'alias-parent-active';
            }
         }

         if ($item->deeper) {
            
         }

         if ($item->parent) {
            
         }

         $customclass = (string) @$astroid_menu_options->customclass;
         $icon = (string) @$astroid_menu_options->icon;
         $showtitle = (string) @$astroid_menu_options->showtitle;
         $subtitle = (string) @$astroid_menu_options->subtitle;
         $width = (string) @$astroid_menu_options->width;
         $alignment = (string) @$astroid_menu_options->alignment;
         $item->icon = $icon;
         $item->showtitle = $showtitle;
         $item->subtitle = $subtitle;
         if (!empty($customclass)) {
            $class[] = $customclass;
         }
         echo '<li class="' . \implode(' ', $class) . '">';
         echo self::getAnchor($item, in_array('active', $class));
         if ($item->deeper) {
            echo '<ul class="nav-child list-group navbar-subnav level-' . $item->level . '" data-align="' . $alignment . '">';
         } elseif ($item->shallower) {
            echo '</li>';
            echo str_repeat('</ul></li>', $item->level_diff);
         } else {
            echo '</li>';
         }
      }

      echo '</ul>';
   }

   public static function getMegaMenu($item, $astroid_menu_options, $items) {
      $showtitle = (bool) @$astroid_menu_options->showtitle;
      $icon = (string) @$astroid_menu_options->icon;
      $customclass = (string) @$astroid_menu_options->customclass;
      $megamenu_width = (string) @$astroid_menu_options->megamenu_width;
      $rows = (string) @$astroid_menu_options->rows;
      $megamenu_direction = (string) @$astroid_menu_options->megamenu_direction;
      $rows = !empty($rows) ? json_decode($rows, true) : [];

      $styles = [];
      if (!empty($megamenu_width)) {
         $styles[] = 'width:' . $megamenu_width;
      }


      echo '<div class="megamenu-container" data-align="' . $megamenu_direction . '" style="' . implode(';', $styles) . '">';
      if (!empty($rows)) {
         foreach ($rows as $row) {
            echo '<div class="row">';
            foreach ($row['cols'] as $col) {
               echo '<div class="col col-md-' . $col['size'] . '">';
               try {

                  foreach ($col['elements'] as $element) {
                     if ($element['type'] == "module") {
                        $module = JModuleHelper::getModule($element['module'], $element['title']);
                        if ($module->id) {
                           echo '<div class="mega-menu-item mega-menu-module">';
                           echo JModuleHelper::renderModule($module, ['style' => $module->style]);
                           echo "</div>";
                        }
                     } else {
                        echo '<div class="mega-menu-item mega-menu-submenus">';
                        foreach ($items as $i => $subitem) {
                           if ($subitem->id != $element['id']) {
                              continue;
                           }
                           $subitem->anchor_css = empty($subitem->anchor_css) ? 'megamenu-title' : ' ' . $subitem->anchor_css;
                           echo self::getAnchor($subitem);
                           if ($subitem->parent) {
                              echo '<div class="megamenu-subnav">';
                              self::getMegaMenuSubItems($subitem, $items);
                              echo '</div>';
                           }
                        }
                        echo "</div>";
                     }
                  }
               } catch (\Exception $e) {
                  
               }
               echo '</div>';
            }
            echo '</div>';
         }
      }
      echo '</div>';
   }

   public static function renderModuleById($name, $title) {

      $module = JModuleHelper::getModule($name, $title);

//      
//      
//      $db = JFactory::getDbo();
//      $query = "SELECT * FROM `#__modules` WHERE `id`='$id'";
//      $db->setQuery($query);
//      $result = $db->loadObject();
//
//      if (empty($result)) {
//         throw new \Exception("Module Not found", 404);
//      }
//
//      $module = new \stdClass;
//      $module->id = $result->id;
//      $module->title = $result->title;
//      $module->module = $result->module;
//      $module->position = $result->position;
//      $module->content = $result->content;
//      $module->showtitle = $result->showtitle;
//      $module->control = $result->showtitle;
//      $module->params = '';
   }

   public static function getAnchor($item, $active = false) {
      $attributes = [];
      if ($item->anchor_title) {
         $attributes['title'] = $item->anchor_title;
      } else {
         $attributes['title'] = $item->title;
      }

      if ($item->anchor_css) {
         $attributes['class'] = 'nav-link ' . $item->anchor_css;
      } else {
         $attributes['class'] = 'nav-link';
      }

      if ($active) {
         $attributes['class'] .= ' active';
      }

      if ($item->anchor_rel) {
         $attributes['rel'] = $item->anchor_rel;
      }

      $linktype = $item->title;

      if ($item->menu_image) {
         if ($item->menu_image_css) {
            $image_attributes['class'] = $item->menu_image_css;
            $linktype = JHtml::_('image', $item->menu_image, $item->title, $image_attributes);
         } else {
            $linktype = JHtml::_('image', $item->menu_image, $item->title);
         }

         if ($item->params->get('menu_text', 1)) {
            $linktype .= '<span class="image-title">' . $item->title . '</span>';
         }
      }

      if ($item->browserNav == 1) {
         $attributes['target'] = '_blank';
         $attributes['rel'] = 'noopener noreferrer';
      } elseif ($item->browserNav == 2) {
         $options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';
         $attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
      }

      //return JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $linktype, $attributes);

      $attr = [];
      foreach ($attributes as $key => $attribute) {
         $attr[] = $key . '="' . $attribute . '"';
      }



      $return = '<a href="' . $item->flink . '" ' . implode(' ', $attr) . '>';

      if (!empty($item->icon)) {
         $return .= '<i class="' . $item->icon . '"></i> ';
      }
      if (empty($item->showtitle)) {
         $return .= '<span>' . $item->title . '</span>';
      }

      if ($item->level <= 1 && !empty($item->subtitle) && empty($item->showtitle)) {
         $return .= '<small>' . $item->subtitle . '</small>';
      }

      $return .= '</a>';
      return $return;
   }

   public static function getList($menutype) {
      $app = JFactory::getApplication();
      $menu = $app->getMenu();

      // Get active menu item
      $base = self::getBase();
      $user = JFactory::getUser();
      $levels = $user->getAuthorisedViewLevels();
      asort($levels);

      $path = $base->tree;
      $start = 1;
      $end = 0;
      $showAll = 1;
      $items = $menu->getItems('menutype', $menutype);
      $hidden_parents = array();
      $lastitem = 0;

      if ($items) {
         foreach ($items as $i => $item) {
            $item->parent = false;

            if (isset($items[$lastitem]) && $items[$lastitem]->id == $item->parent_id && $item->params->get('menu_show', 1) == 1) {
               $items[$lastitem]->parent = true;
            }

            if (($start && $start > $item->level) || ($end && $item->level > $end) || (!$showAll && $item->level > 1 && !in_array($item->parent_id, $path)) || ($start > 1 && !in_array($item->tree[$start - 2], $path))) {
               unset($items[$i]);
               continue;
            }

            // Exclude item with menu item option set to exclude from menu modules
            if (($item->params->get('menu_show', 1) == 0) || in_array($item->parent_id, $hidden_parents)) {
               $hidden_parents[] = $item->id;
               unset($items[$i]);
               continue;
            }

            $item->deeper = false;
            $item->shallower = false;
            $item->level_diff = 0;

            if (isset($items[$lastitem])) {
               $items[$lastitem]->deeper = ($item->level > $items[$lastitem]->level);
               $items[$lastitem]->shallower = ($item->level < $items[$lastitem]->level);
               $items[$lastitem]->level_diff = ($items[$lastitem]->level - $item->level);
            }

            $lastitem = $i;
            $item->active = false;
            $item->flink = $item->link;

            // Reverted back for CMS version 2.5.6
            switch ($item->type) {
               case 'separator':
                  break;

               case 'heading':
                  // No further action needed.
                  break;

               case 'url':
                  if ((strpos($item->link, 'index.php?') === 0) && (strpos($item->link, 'Itemid=') === false)) {
                     // If this is an internal Joomla link, ensure the Itemid is set.
                     $item->flink = $item->link . '&Itemid=' . $item->id;
                  }
                  break;

               case 'alias':
                  $item->flink = 'index.php?Itemid=' . $item->params->get('aliasoptions');
                  break;

               default:
                  $item->flink = 'index.php?Itemid=' . $item->id;
                  break;
            }

            if ((strpos($item->flink, 'index.php?') !== false) && strcasecmp(substr($item->flink, 0, 4), 'http')) {
               $item->flink = JRoute::_($item->flink, true, $item->params->get('secure'));
            } else {
               $item->flink = JRoute::_($item->flink);
            }

            // We prevent the double encoding because for some reason the $item is shared for menu modules and we get double encoding
            // when the cause of that is found the argument should be removed
            $item->title = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8', false);
            $item->anchor_css = htmlspecialchars($item->params->get('menu-anchor_css', ''), ENT_COMPAT, 'UTF-8', false);
            $item->anchor_title = htmlspecialchars($item->params->get('menu-anchor_title', ''), ENT_COMPAT, 'UTF-8', false);
            $item->anchor_rel = htmlspecialchars($item->params->get('menu-anchor_rel', ''), ENT_COMPAT, 'UTF-8', false);
            $item->menu_image = $item->params->get('menu_image', '') ?
                    htmlspecialchars($item->params->get('menu_image', ''), ENT_COMPAT, 'UTF-8', false) : '';
            $item->menu_image_css = htmlspecialchars($item->params->get('menu_image_css', ''), ENT_COMPAT, 'UTF-8', false);
         }

         if (isset($items[$lastitem])) {
            $items[$lastitem]->deeper = (($start ?: 1) > $items[$lastitem]->level);
            $items[$lastitem]->shallower = (($start ?: 1) < $items[$lastitem]->level);
            $items[$lastitem]->level_diff = ($items[$lastitem]->level - ($start ?: 1));
         }
      }

      return $items;
   }

   public static function getBase() {
      $menu = JFactory::getApplication()->getMenu();
      $active = $menu->getActive();


      if ($active) {
         return $active;
      }

      return self::getActive();
   }

   public static function getActive() {
      $menu = JFactory::getApplication()->getMenu();
      return $menu->getActive() ?: self::getDefault();
   }

   public static function getDefault() {
      $menu = JFactory::getApplication()->getMenu();
      $lang = JFactory::getLanguage();

      // Look for the home menu
      if (JLanguageMultilang::isEnabled()) {
         return $menu->getDefault($lang->getTag());
      } else {
         return $menu->getDefault();
      }
   }

}
