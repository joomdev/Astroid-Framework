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
$mode = $params->get('header_sidebar_menu_mode', 'left');
$block_1_type = $params->get('header_block_1_type', 'blank');
$block_1_position = $params->get('header_block_1_position', '');
$block_1_custom = $params->get('header_block_1_custom', '');
$header_menu = $params->get('header_menu', 'mainmenu');
$enable_offcanvas = $params->get('enable_offcanvas', FALSE);
$header_mobile_menu = $params->get('header_mobile_menu', '');
$offcanvas_animation = $params->get('offcanvas_animation', 'st-effect-1');
$offcanvas_togglevisibility = $params->get('offcanvas_togglevisibility', 'd-block');
$class = ['astroid-header', 'astroid-sidebar-header', 'sidebar-dir-' . $mode, 'h-100', 'has-sidebar'];
$navClass = ['nav', 'astroid-nav', 'd-none', 'd-lg-flex'];
$navWrapperClass = ['align-self-center', 'px-2', 'd-none', 'd-lg-block'];
?>
<!-- header starts -->
<header id="astroid-header" class="<?php echo implode(' ', $class); ?>">
   <div class="astroid-sidebar-content h-100">
      <div class="astroid-sidebar-collapsable">
         <i class="fa"></i>
      </div>
      <div class="astroid-sidebar-logo">
         <?php if (!empty($header_mobile_menu)) { ?>
            <div class="justify-content-start astroid-sidebar-mobile-menu">
               <div class="header-mobilemenu-trigger burger-menu-button align-self-center" data-offcanvas="#astroid-mobilemenu" data-effect="mobilemenu-slide">
                  <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
               </div>
            </div>
         <?php } ?>
         <?php $template->loadLayout('logo'); ?>
      </div>
      <div class="astroid-sidebar-menu">
         <?php AstroidMenu::getSidebarMenu($header_menu); ?>
      </div>
      <?php if ($block_1_type != 'blank'): ?>
         <div class="astroid-sidebar-block">
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
</header>
<!-- header ends -->