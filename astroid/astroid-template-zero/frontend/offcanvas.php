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
$params = $template->params;

$header = $params->get('header', TRUE);
$enable_offcanvas = $params->get('enable_offcanvas', FALSE);
if (!$header || !$enable_offcanvas) {
   return;
}
$module_position = 'offcanvas';
$togglevisibility = $params->get('offcanvas_togglevisibility', 'd-block');
$effect = $params->get('offcanvas_animation', 'st-effect-1');
$panelwidth = $params->get('offcanvas_panelwidth', '320px');
$openfrom = $params->get('offcanvas_openfrom', 'left');
?>
<div class="astroid-offcanvas d-none d-init" id="astroid-offcanvas">
   <div class="burger-menu-button active">
      <button type="button" class="button close-offcanvas offcanvas-close-btn">
         <span class="box">
            <span class="inner"></span>
         </span>
      </button>
   </div>
   <div class="astroid-offcanvas-inner">
      <?php echo $template->renderModulePosition($module_position, 'astroidxhtml'); ?>
   </div>
</div>

<?php
$style = '.astroid-offcanvas {width: ' . $panelwidth . ';} .astroid-offcanvas .dropdown-menus {width: ' . $panelwidth . ' !important;}';

// Effects Styles
switch ($effect) {
   case 'st-effect-1':
      $style .= '.st-effect-1.astroid-offcanvas{visibility:visible;-webkit-transform:translate3d(-100%, 0, 0);transform:translate3d(-100%, 0, 0);}.st-effect-1.astroid-offcanvas-open .st-effect-1.astroid-offcanvas{ visibility:visible;-webkit-transform:translate3d(0, 0, 0);transform:translate3d(0, 0, 0);}.st-effect-1.astroid-offcanvas::after{display:none;}';
      break;
   case 'st-effect-2':
      $style .= '.st-effect-2.astroid-offcanvas-open .astroid-content{-webkit-transform:translate3d(' . $panelwidth . ', 0, 0);transform:translate3d(' . $panelwidth . ', 0, 0);}.astroid-offcanvas-opened .astroid-wrapper{background:rgb(173, 181, 189);}.st-effect-2.astroid-offcanvas{z-index:0 !important;}.st-effect-2.astroid-offcanvas-open .st-effect-2.astroid-offcanvas{visibility: visible; -webkit-transition:-webkit-transform 0.5s;transition:transform 0.5s;}.st-effect-2.astroid-offcanvas::after{display:none;}';
      break;
   case 'st-effect-3':
      $style .= '.st-effect-3.astroid-offcanvas-open .astroid-content{-webkit-transform:translate3d(' . $panelwidth . ', 0, 0);transform:translate3d(' . $panelwidth . ', 0, 0);}.st-effect-3.astroid-offcanvas-open .st-effect-3.astroid-offcanvas{-webkit-transform:translate3d(0%, 0, 0);transform:translate3d(0%, 0, 0);}.st-effect-3.astroid-offcanvas{-webkit-transform:translate3d(-100%, 0, 0);transform:translate3d(-100%, 0, 0);}.st-effect-3.astroid-offcanvas-open .st-effect-3.astroid-offcanvas{visibility:visible;-webkit-transition:-webkit-transform 0.5s;transition:transform 0.5s;}.st-effect-3.astroid-offcanvas::after{display: none;}';
      break;
   case 'st-effect-9':
      $style .= '.st-effect-9.astroid-container{-webkit-perspective:1500px;perspective:1500px;}.st-effect-9 .astroid-content{-webkit-transform-style:preserve-3d;transform-style:preserve-3d;}.st-effect-9.astroid-offcanvas-open .astroid-content{-webkit-transform:translate3d(0, 0, -' . $panelwidth . ');transform:translate3d(0, 0, -' . $panelwidth . ');}.st-effect-9.astroid-offcanvas{opacity:1;-webkit-transform:translate3d(-100%, 0, 0);transform:translate3d(-100%, 0, 0);}.st-effect-9.astroid-offcanvas-open .st-effect-9.astroid-offcanvas{visibility:visible;-webkit-transition:-webkit-transform 0.5s;transition:transform 0.5s;-webkit-transform:translate3d(0, 0, 0);transform:translate3d(0, 0, 0);}.st-effect-9.astroid-offcanvas::after{display:none;}';
      break;
}
$template->addStyledeclaration($style);
?>