<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
// No direct access.
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$app = JFactory::getApplication();

/** @var JDocumentHtml $this */
JLoader::import('joomla.filesystem.file');
JHtml::_('behavior.framework', true);
$lib = JPATH_SITE . '/libraries/astroid/framework/template.php';
if (file_exists($lib)) {
   jimport('astroid.framework.astroid');
   jimport('astroid.framework.template');
   jimport('astroid.framework.constants');
} else {
   die('Please install and activate <a href="https://www.astroidframework.com/" target="_blank">Astroid Framework</a> in order to use this template.');
}
$template = AstroidFramework::getTemplate();
// Output as HTML5
$this->setHtml5(true);

// Add stylesheets
JHtml::_('stylesheet', 'templates/system/css/system.css', array('version' => 'auto'));

// Astroid Assets
$template->loadTemplateCSS('custom.css');
$template->_loadFontAwesome();
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
   <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta name="HandheldFriendly" content="true" />
      <meta name="apple-mobile-web-app-capable" content="YES" />
   <jdoc:include type="head" />
   <?php
   /*
    * Let's add the favicon
    */
   $favicon = $template->params->get('favicon', '');
   if (!empty($favicon = $template->params->get('favicon', ''))) {
      $doc->addFavicon(JURI::root() . 'images/' . $favicon, '');
   }
   // Let's add the Smooth Scroll JD is enabled.
    $enable_smooth_scroll = $template->params->get('enable_smooth_scroll', '');
	if($enable_smooth_scroll == '1') {
		$smooth_scroll_speed = $template->params->get('smooth_scroll_speed', '');
		$template->loadTemplateJS('vendor/smooth-scroll.polyfills.min.js');
		$smoothashell = '
			var scroll = new SmoothScroll(\'a[href*="#"]\', {
            speed: '.$smooth_scroll_speed.',
            header: ".astroid-header"
			});
		';
		$template->addScriptDeclaration($smoothashell);
	}
	// Adding basic Scripts, jQuery & Bootstrap JS

   if (isset($doc->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js'])) {
      $template->loadTemplateJS('vendor/jquery.easing.min.js,vendor/bootstrap/popper.min.js,vendor/bootstrap/bootstrap.min.js,vendor/jquery.astroidmobilemenu.js,vendor/jquery.jdmegamenu.js,vendor/jquery.offcanvas.js');
   } else {
      $template->loadTemplateJS('vendor/bootstrap/jquery.min.js,vendor/jquery.easing.min.js,vendor/bootstrap/popper.min.js,vendor/bootstrap/bootstrap.min.js,vendor/jquery.astroidmobilemenu.js,vendor/jquery.jdmegamenu.js,vendor/jquery.offcanvas.js');
   }

   /*
    * 	Basic Layout Background settings added here for now.
    * 	Will be positioned larer in ther future.
    * 	Only takes effect, if layout is boxed.
    */
   if ($template->params->get('template_layout') == 'boxed') {
      $styles = '';
      // Background color
      if ($template->params->get('color_body_background_color')) {
         $styles .= 'background-color: ' . $template->params->get('color_body_background_color') . ';';
      }
      // Let's add the image styles only if an image is selected.
      if ($template->params->get('basic_background_image')) {
         $styles .= '
				background-image: url("' . JURI::root() .$template->SeletedMedia(). '/' . $template->params->get('basic_background_image') . '");
				background-repeat: ' . $template->params->get('basic_background_repeat') . ';
				background-size: ' . $template->params->get('basic_background_size') . ';
				background-position: ' . str_replace('_', ' ', $template->params->get('basic_background_position')) . ';
				background-attachment: ' . $template->params->get('basic_background_attachment') . ';
			';
      }

      $bodystyle = 'body {' . $styles . '}';
      $template->addStyleDeclaration($bodystyle);
   }
   $template->loadLayout('typography');
   $template->loadLayout('colors');
   ?>
   <?php $template->head(); ?>
</head>
<body class="<?php echo $template->bodyClass($template->language, $template->direction); ?>">
   <?php
   if ($template->params->get('developemnt_mode', 0)) {
      $template->loadLayout('comingsoon');
   } else {
      $template->loadLayout('preloader');
      $template->loadLayout('backtotop');
      $template->renderLayout();
   }
   ?>
<jdoc:include type="modules" name="debug" />
<?php
$template->body();
$template->addScript('script.js');
$template->addScript('custom.js');
$template->loadJS();
$template->loadCSSFile();
?>
</body>
</html>