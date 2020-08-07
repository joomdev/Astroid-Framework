<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * 	DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 *  You can easily override all files under /frontend/ folder.
 * 	Just copy the file to ROOT/templates/YOURTEMPLATE/html/frontend/header/ folder to create and override
 */
// No direct access.
defined('_JEXEC') or die;

jimport('astroid.framework.menu');

extract($displayData);

$params = $template->params;
$mode = $params->get('header_horizontal_menu_mode', 'left');
$block_1_type = $params->get('header_block_1_type', 'blank');
$block_1_position = $params->get('header_block_1_position', '');
$block_1_custom = $params->get('header_block_1_custom', '');
$header_menu = $params->get('header_menu', 'mainmenu');
$enable_offcanvas = $params->get('enable_offcanvas', FALSE);
$header_mobile_menu = $params->get('header_mobile_menu', '');
$offcanvas_animation = $params->get('offcanvas_animation', 'st-effect-1');
$offcanvas_direction = $params->get('offcanvas_direction', 'offcanvasDirLeft');
$offcanvas_togglevisibility = $params->get('offcanvas_togglevisibility', 'd-block');
$class = ['astroid-header', 'astroid-horizontal-header', 'astroid-horizontal-'.$mode.'-header'];
$navClass = ['nav', 'astroid-nav', 'd-none', 'd-lg-flex'];
$navWrapperClass = ['align-self-center', 'px-2', 'd-none', 'd-lg-block'];
?>
<!-- header starts -->
<header data-megamenu data-megamenu-class=".has-megamenu" data-megamenu-content-class=".megamenu-container" data-dropdown-arrow="<?php echo $template->params->get('dropdown_arrow', 0) ? 'true' : 'false'; ?>" data-header-offset="true" data-transition-speed="<?php echo $template->params->get('dropdown_animation_speed', 300); ?>" data-animation="<?php echo $template->params->get('dropdown_animation_type', 'fade'); ?>" data-easing="<?php echo $template->params->get('dropdown_animation_ease', 'linear'); ?>" data-astroid-trigger="<?php echo $template->params->get('dropdown_trigger', 'hover'); ?>" data-megamenu-submenu-class=".nav-submenu,.nav-submenu-static" id="astroid-header" class="<?php echo implode(' ', $class); ?>">
   <div class="d-flex flex-row justify-content-between">
      <?php if (!empty($header_mobile_menu)) { ?>
         <div class="d-flex d-lg-none justify-content-start">
            <div class="header-mobilemenu-trigger d-lg-none burger-menu-button align-self-center" data-offcanvas="#astroid-mobilemenu" data-effect="mobilemenu-slide">
               <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
            </div>
         </div>
      <?php } ?>
      <div class="header-left-section d-flex justify-content-between">
         <?php $template->loadLayout('logo'); ?>
         <?php
         if ($mode == 'left') {
            // header nav starts
            AstroidMenu::getMenu($header_menu, $navClass, null, 'left', 'horizontal', $navWrapperClass);
            // header nav ends
         }
         ?>
      </div>
      <?php
      if ($mode == 'center') {
         echo '<div class="header-center-section d-none d-lg-block justify-content-center">';
         // header nav starts
         AstroidMenu::getMenu($header_menu, $navClass, null, 'left', 'horizontal', $navWrapperClass);
         // header nav ends
         echo '</div>';
      }
      ?>
      <?php if ($block_1_type != 'blank' || $mode == 'right' || $enable_offcanvas): ?>
         <div class="header-right-section d-flex justify-content-end">
            <?php
            if ($mode == 'right') {
               // header nav starts
               AstroidMenu::getMenu($header_menu, $navClass, null, 'left', 'horizontal', $navWrapperClass);
               // header nav ends
            }
            ?>
            <?php if ($enable_offcanvas) { ?>
               <div class="header-offcanvas-trigger burger-menu-button align-self-center <?php echo $offcanvas_togglevisibility; ?>" data-offcanvas="#astroid-offcanvas" data-effect="<?php echo $offcanvas_animation; ?>" data-direction="<?php echo $offcanvas_direction; ?>" >
                  <button type="button" class="button">
                     <span class="box">
                        <span class="inner"></span>
                     </span>
                  </button>
               </div>
            <?php } ?>
            <?php if ($block_1_type != 'blank'): ?>
               <div class="header-right-block d-none d-lg-block align-self-center px-2">
                  <?php
                  if ($block_1_type == 'position') {
                     echo '<div class="header-block-item">';
                     echo $template->renderModulePosition($block_1_position, 'xhtml');
                     echo '</div>';
                  }
                  if ($block_1_type == 'custom') {
                     echo '<div class="header-block-item">';
                     echo $block_1_custom;
                     echo '</div>';
                  }
                  ?>
               </div>
            <?php endif; ?>
         </div>
      <?php endif; ?>
   </div>
</header>
<!-- header ends -->