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

// Logo Alt Text
$app = JFactory::getApplication();
$sitename = $app->get('sitename');

// Getting params from template
$params = $template->params;
$logo_type = $params->get('logo_type', 'image'); // Logo Type

$header_mode = $template->params->get('header_mode', 'horizontal');
$header_stacked_menu_mode = $params->get('header_stacked_menu_mode', 'center');

if ($logo_type == 'text') {
   $config = JFactory::getConfig();
   $logo_text = $params->get('logo_text', $config->get('sitename')); // Logo Text
   $tag_line = $params->get('tag_line', ''); // Logo Tagline
} else {
// Logo file
   $default_logo = $params->get('defult_logo', false);
   $mobile_logo = $params->get('mobile_logo', false);
   $stickey_header_logo = $params->get('stickey_header_logo', false);
}
$class = ['astroid-logo', 'astroid-logo-' . $logo_type, 'd-flex align-items-center align-items-md-start'];
?>
<!-- logo starts -->
<!-- <div class="<?php /* echo implode(' ', $class); */ ?>"> -->
<?php if ($logo_type == 'text'): ?>
   <!-- text logo starts -->
   <?php
   $mr = ($header_mode == 'stacked' && ($header_stacked_menu_mode == 'seperated' || $header_stacked_menu_mode == 'center')) ? '' : ' mr-0 mr-lg-4';
   ?>
   <div class="<?php echo implode(' ', $class); ?> flex-column<?php echo $mr; ?>">
      <a class="site-title" href="<?php echo JURI::root(); ?>"><?php echo $logo_text; ?></a>
      <p class="site-tagline"><?php echo $tag_line; ?></p>
   </div>
   <!-- text logo ends -->
<?php endif; ?>
<?php if ($logo_type == 'image'): ?>
   <!-- image logo starts -->
   <?php
   $mr = ($header_mode == 'stacked' && ($header_stacked_menu_mode == 'seperated' || $header_stacked_menu_mode == 'center')) ? '' : ' mr-0 mr-lg-4';
   ?>
   <a class="<?php echo implode(' ', $class); ?><?php echo $mr; ?>" href="<?php echo JURI::root(); ?>">
      <?php if (!empty($default_logo)) { ?>
         <img src="<?php echo JURI::root() . '/images/' . $default_logo; ?>" alt="<?php echo $sitename; ?>" class="astroid-logo-default" />
      <?php } ?>
      <?php if (!empty($mobile_logo)) { ?>
         <img src="<?php echo JURI::root() . '/images/' . $mobile_logo; ?>" alt="<?php echo $sitename; ?>" class="astroid-logo-mobile" />
      <?php } ?>
      <?php if (!empty($stickey_header_logo)) { ?>
         <img src="<?php echo JURI::root() . '/images/' . $stickey_header_logo; ?>" alt="<?php echo $sitename; ?>" class="astroid-logo-sticky" />
      <?php } ?>
   </a>
   <!-- image logo ends -->
<?php endif; ?>
<!-- </div> -->
<!-- logo ends -->
