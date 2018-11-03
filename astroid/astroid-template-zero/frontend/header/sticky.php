<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
// No direct access.
defined('_JEXEC') or die;

jimport('astroid.framework.menu');

extract($displayData);

$params = $template->params;
$header_menu = $params->get('header_menu', 'mainmenu');
$enable_offcanvas = $params->get('enable_offcanvas', FALSE);
$offcanvas_animation = $params->get('offcanvas_animation', 'st-effect-1');
$offcanvas_togglevisibility = $params->get('offcanvas_togglevisibility', 'd-block');
$class = ['astroid-header', 'astroid-header-sticky'];
$stickyheader = $params->get('stickyheader', 'static');
$header_mobile_menu = $params->get('header_mobile_menu', '');
$class[] = 'header-' . $stickyheader . '-desktop';
$stickyheadermobile = $params->get('stickyheadermobile', 'static');
$class[] = 'header-' . $stickyheadermobile . '-mobile';
$stickyheadertablet = $params->get('stickyheadertablet', 'static');
$class[] = 'header-' . $stickyheadertablet . '-tablet';
$navClass = ['nav', 'astroid-nav', 'd-none', 'd-lg-flex'];
$navWrapperClass = ['astroid-nav-wraper', 'align-self-center', 'px-2', 'd-none', 'd-lg-block'];
$mode = $params->get('header_horizontal_menu_mode', 'left');
switch ($mode) {
   case 'left':
      $navWrapperClass[] = 'mr-auto';
      break;
   case 'right':
      $navWrapperClass[] = 'ml-auto';
      break;
   case 'center':
      $navWrapperClass[] = 'mx-auto';
      break;
}
?>
<!-- header starts -->
<div id="astroid-sticky-header" class="<?php echo implode(' ', $class); ?> d-none border-bottom shadow-sm">
   <div class="container d-flex flex-row justify-content-between">
      <?php if (!empty($header_mobile_menu)) { ?>
         <div class="d-flex d-lg-none justify-content-start">
            <div class="header-mobilemenu-trigger d-lg-none burger-menu-button align-self-center" data-offcanvas="#astroid-mobilemenu" data-effect="mobilemenu-slide">
               <button class="button" type="button"><span class="box"><span class="inner"></span></span></button>
            </div>
         </div>
      <?php } ?>
      <div class="header-left-section d-flex justify-content-center flex-grow-1">
         <?php
         $template->loadLayout('logo');
         // header nav starts
         AstroidMenu::getMenu($header_menu, $navClass, null, 'left', 'sticky', $navWrapperClass);
         // header nav ends
         ?>
      </div>
      <?php if ($enable_offcanvas): ?>
         <div class="header-right-section d-flex justify-content-end">
            <div class="header-offcanvas-trigger burger-menu-button align-self-center <?php echo $offcanvas_togglevisibility; ?>" data-offcanvas="#astroid-offcanvas" data-effect="<?php echo $offcanvas_animation; ?>">
               <button type="button" class="button">
                  <span class="box">
                     <span class="inner"></span>
                  </span>
               </button>
            </div>
         </div>
      <?php endif; ?>
   </div>
</div>
<!-- header ends -->