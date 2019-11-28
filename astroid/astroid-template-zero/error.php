<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
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

// Background Image
$background_setting_404 = $template->params->get('background_setting_404');
$styles = [];
$video = [];
   if($background_setting_404){
      if($background_setting_404 =="color"){
         $background_color_404 = $template->params->get('background_color_404', '');
         if (!empty($background_color_404)) {
            $styles[] = 'background-color:' . $background_color_404;
         }
      }
      if($background_setting_404 =="image"){

         $img_background_color_404 = $template->params->get('img_background_color_404', '');
         $img_background_color = empty($img_background_color_404) ? 'inherit' : $img_background_color_404;
         $styles[] = 'background-color:' . $img_background_color_404;

         $background_image_404 = $template->params->get('background_image_404', '');
         if (!empty($background_image_404)) {
            $styles[] = 'background-image: url(' . JURI::root() .$template->SeletedMedia().'/' . $background_image_404 . ')';
            $background_repeat_404 = $template->params->get('background_repeat_404', '');
            $background_repeat_404 = empty($background_repeat_404) ? 'inherit' : $background_repeat_404;
            $styles[] = 'background-repeat:' . $background_repeat_404;

            $background_size_404 = $template->params->get('background_size_404', '');
            $background_size_404 = empty($background_size_404) ? 'inherit' : $background_size_404;
            $styles[] = 'background-size:' . $background_size_404;

            $background_attchment_404 = $template->params->get('background_attchment_404', '');
            $background_attchment_404 = empty($background_attchment_404) ? 'inherit' : $background_attchment_404;
            $styles[] = 'background-attachment:' . $background_attchment_404;

            $background_position_404 = $template->params->get('background_position_404', '');
            $background_position_404 = empty($background_position_404) ? 'inherit' : $background_position_404;
            $styles[] = 'background-position:' . $background_position_404;
         }
      }

         if($background_setting_404 =="video"){
            $attributes = [];
            $background_video_404 = $template->params->get('background_video_404', '');
            if (!empty($background_video_404)) {
               $attributes['data-jd-video-bg'] = JURI::root() .$template->SeletedMedia(). '/' . $background_video_404;
					$videobgjs = 'vendor/jquery.jdvideobg.js';
               if(!isset($template->_js[$videobgjs])){
                	$template->addScript($videobgjs);
               }
            }

            $return = [];
            foreach ($attributes as $key => $value) {
               $return[] = $key . '="' . $value . '"';
            }
            $video =  $return;  
			 }
			 
   }
	
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
         echo '<link href="' . JURI::root() .$template->SeletedMedia(). '/' . $favicon . '" rel="shortcut icon" type="image/x-icon" />';
      }
      ?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/jquery.jdvideobg.js"></script>
      
   </head>
   <body class="error-page" style="<?php echo implode(';', $styles); ?>" <?php  echo implode(' ', $video); ?>>
	 <div class="container">
		<div class="row">
		   <div class="col-12 text-center align-self-center">
			  <?php
			  if (!empty($errorContent)) {
			
				$errorContent = $template->_loadModule($errorContent);
				
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
			  <a class="btn btn-backtohome" href="<?php echo JURI::root(); ?>" role="button"><?php echo $errorButton; ?></a>

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
	</body>
</html>