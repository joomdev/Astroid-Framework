<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
// No direct access.
defined('_JEXEC') or die;
$doc = JFactory::getDocument();
$app = JFactory::getApplication();

/** @var JDocumentHtml $this */
JLoader::import('joomla.filesystem.file');
//JHtml::_('behavior.framework', true);
$lib = JPATH_SITE . '/libraries/astroid/framework/template.php';
if (file_exists($lib)) {
   jimport('astroid.framework.template');
   jimport('astroid.framework.constants');
} else {
   die('Please install and activate <a href="https://www.joomdev.com/astroid/" target="_blank">Astroid Framework</a> in order to use this template.');
}
$template = new AstroidFrameworkTemplate($this);

// Output as HTML5
$this->setHtml5(true);

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add stylesheets
JHtml::_('stylesheet', 'templates/system/css/system.css', array('version' => 'auto'));

// Astroid Assets
$template->loadTemplateCSS('custom');
?>
<!DOCTYPE html>
<html lang="<?php echo $template->language; ?>" dir="<?php echo $template->direction; ?>">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta name="HandheldFriendly" content="true" />
      <meta name="apple-mobile-web-app-capable" content="YES" />
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v<?php echo AstroidFrameworkConstants::$fontawesome_version; ?>/css/all.css" >
   <jdoc:include type="head" />
   <?php
   /*
    * Let's add the favicon
    */
   $favicon = $template->params->get('favicon', '');
   if (!empty($favicon = $template->params->get('favicon', ''))) {
      $doc->addFavicon(JURI::root() . 'images/' . $favicon, '');
   }
// Adding basic Scripts, jQuery & Bootstrap JS

   if (isset($doc->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js'])) {
      $template->loadTemplateJS('vendor/bootstrap/popper.min.js,vendor/bootstrap/bootstrap.min.js,vendor/jquery.astroidmobilemenu.js,vendor/jquery.jdvideobg.js,vendor/jquery.offcanvas.js,script.js');
   } else {
      $template->loadTemplateJS('vendor/bootstrap/jquery.min.js,vendor/bootstrap/popper.min.js,vendor/bootstrap/bootstrap.min.js,vendor/jquery.astroidmobilemenu.js,vendor/jquery.jdvideobg.js,vendor/jquery.offcanvas.js,script.js');
   }
   $template->loadLayout('typography');
   $template->loadLayout('colors');
   ?>
   <?php $template->head(); ?>
</head>
<body class="<?php echo $template->bodyClass($template->language, $template->direction); ?>">
<jdoc:include type="message" />
<jdoc:include type="component" />
</body>
</html>