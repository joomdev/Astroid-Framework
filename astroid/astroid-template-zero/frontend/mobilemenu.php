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
jimport('astroid.framework.menu');
$params = $template->params;

$header = $params->get('header', TRUE);
$header_mobile_menu = $params->get('header_mobile_menu', '');
if (!$header) {
   return;
}
if (empty($header_mobile_menu)) {
   return;
}
?>
<div class="astroid-mobilemenu d-none d-init" data-class-prefix="astroid-mobilemenu" id="astroid-mobilemenu">
<div class="burger-menu-button active">
   <button type="button" class="button close-offcanvas offcanvas-close-btn">
      <span class="box">
         <span class="inner"></span>
      </span>
   </button>
</div>
   <?php AstroidMenu::getMobileMenu($header_mobile_menu); ?>
</div>
<?php
$style = '.mobilemenu-slide.astroid-mobilemenu{visibility:visible;-webkit-transform:translate3d(-100%, 0, 0);transform:translate3d(-100%, 0, 0);}.mobilemenu-slide.astroid-mobilemenu-open .mobilemenu-slide.astroid-mobilemenu {visibility:visible;-webkit-transform:translate3d(0, 0, 0);transform:translate3d(0, 0, 0);}.mobilemenu-slide.astroid-mobilemenu::after{display:none;}';
$document = JFactory::getDocument();
$document->addStyledeclaration($style);
?>