<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
?>

<?php
/**
 * @package     Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;

/** @var JDocumentError $this */
// Get params
$app = JFactory::getApplication();
$lib = JPATH_SITE . '/libraries/astroid/framework/template.php';
if (file_exists($lib)) {
   jimport('astroid.framework.template');
} else {
   die('Please install and activate <a href="https://github.com/joomdev/Astroid-Framework/releases" target="_blank">Astroid Framework</a> in order to use this template.');
}
$template = new AstroidFrameworkTemplate($app->getTemplate(true));
$errorContent = $template->params->get('error_404_content', '');
$errorButton = $template->params->get('error_call_to_action', '');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
   <head>
      <meta charset="utf-8" />
      <title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
      <?php
      $template->loadTemplateCSS('custom', true);
      $template->loadLayout('typography', true, ['in_head' => false]);
      $favicon = $template->params->get('favicon', '');
      if (!empty($favicon = $template->params->get('favicon', ''))) {
         echo '<link href="' . JURI::root() . 'images/' . $favicon . '" rel="shortcut icon" type="image/x-icon" />';
      }
      ?>
   </head>
   <body class="error-page">
	 <div class="container">
		<div class="row" style="height: 100vh;">
		   <div class="col-12 text-center align-self-center">
			  <?php
			  if (!empty($errorContent)) {
				 echo str_replace('{errormessage}', htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'), str_replace('{errorcode}', $this->error->getCode(), $errorContent));
			  } else {
				 ?>
				 <div class="py-5">
					<h2 class="display-1"><?php echo $this->error->getCode(); ?></h2>
					<h5 class="display-4"><?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></h5>
				 </div>
				 <?php
			  }
			  ?>
			  <a class="btn btn-primary" href="<?php echo JURI::root(); ?>" role="button"><?php echo $errorButton; ?></a>

			  <?php if ($this->debug) : ?>
				 <hr>
				 <code>
					ERROR <?php echo $this->error->getCode(); ?> - <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?> in <?php echo htmlspecialchars($this->error->getFile(), ENT_QUOTES, 'UTF-8'); ?>:<?php echo $this->error->getLine(); ?>
				 </code>
				 <div class="clearfix mb-3"></div>
			  <?php endif; ?>

		   </div>
		</div>
		<div>
		   <?php if ($this->debug) : ?>
			  <div class="mb-5">
				 <?php echo $this->renderBacktrace(); ?>
				 <?php // Check if there are more Exceptions and render their data as well ?>
				 <?php if ($this->error->getPrevious()) : ?>
					<?php $loop = true; ?>
					<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
					<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
					<?php $this->setError($this->_error->getPrevious()); ?>
					<?php while ($loop === true) : ?>
					   <p><strong><?php echo JText::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
					   <p>
						  <?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
						  <br/><?php echo htmlspecialchars($this->_error->getFile(), ENT_QUOTES, 'UTF-8'); ?>:<?php echo $this->_error->getLine(); ?>
					   </p>
					   <?php echo $this->renderBacktrace(); ?>
					   <?php $loop = $this->setError($this->_error->getPrevious()); ?>
					<?php endwhile; ?>
					<?php // Reset the main error object to the base error ?>
					<?php $this->setError($this->error); ?>
				 <?php endif; ?>
			  </div>
		   <?php endif; ?>
		</div>
	 </div>
      <?php echo $this->getBuffer('modules', 'debug', array('style' => 'none')); ?>
   </body>
</html>