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

$doc = JFactory::getDocument();
$doc->addScript(JURI::root() . 'templates/' . $template->template . '/js/vendor/jquery.countdown.min.js');
$doc->addScript(JURI::root() . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'vendor' . '/' . 'moment.min.js');
$doc->addScript(JURI::root() . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'vendor' . '/' . 'moment-timezone.min.js');
$doc->addScript(JURI::root() . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'vendor' . '/' . 'moment-timezone-with-data-2012-2022.min.js');
$app = JFactory::getApplication();
// Background Image
 
$background_setting = $template->params->get('background_setting');
$styles = [];
$video = [];
   if($background_setting){
      if($background_setting =="color"){
         $background_color = $template->params->get('background_color', '');
         if (!empty($background_color)) {
            $styles[] = 'background-color:' . $background_color;
         }
      }
      if($background_setting =="image"){
         $background_image = $template->params->get('background_image', '');
         if (!empty($background_image)) {
            $styles[] = 'background-image: url(' . JURI::root() . 'images/' . $background_image . ')';
            $background_repeat = $template->params->get('background_repeat', '');
            $background_repeat = empty($background_repeat) ? 'inherit' : $background_repeat;
            $styles[] = 'background-repeat:' . $background_repeat;

            $background_size = $template->params->get('background_size', '');
            $background_size = empty($background_size) ? 'inherit' : $background_size;
            $styles[] = 'background-size:' . $background_size;

            $background_attchment = $template->params->get('background_attchment', '');
            $background_attchment = empty($background_attchment) ? 'inherit' : $background_attchment;
            $styles[] = 'background-attachment:' . $background_attchment;

            $background_position = $template->params->get('background_position', '');
            $background_position = empty($background_position) ? 'inherit' : $background_position;
            $styles[] = 'background-position:' . $background_position;
         }
      }

         if($background_setting =="gradient"){
            $background_gradient = $template->params->get('background_gradient', '');
            if (!empty($background_gradient)) {
               $styles[] = 'background-image: '.$background_gradient->gradient_type.'-gradient('. $background_gradient->start_color.','.$background_gradient->stop_color.')';
            }
         }

         if($background_setting =="video"){
            $attributes = [];
            $background_video = $template->params->get('background_video', '');
            if (!empty($background_video)) {
               $attributes['data-jd-video-bg'] = JURI::root() . 'images/' . $background_video;
               $template = AstroidFramework::getTemplate();
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
      
$comingsoon_logo = "";
$hascs_logo = 0;
if ($cs_logo = $template->params->get('coming_soon_logo')) {
   $comingsoon_logo = JURI::root() . 'images/' . $cs_logo;
   $hascs_logo = 1;
}
$comingsoon_date = $template->params->get("coming_soon_countdown_date", 'January 1st 2022, 00:00 am');
$date = new DateTime($comingsoon_date, new DateTimeZone(JFactory::getConfig()->get('offset')));
$comingsoon_date = $date->format('Y/m/d H:i:s');

?>

<div class="comingsoon-wrap" style="<?php echo implode(';', $styles); ?>" <?php  echo implode(' ', $video); ?>>	
   <div class="container">
      <div class="text-center">
         <div id="comingsoon">
            <div class="comingsoon-page-logo">
               <?php if ($hascs_logo) { ?>
                  <img class="comingsoon-logo m-auto" alt="logo" src="<?php echo $comingsoon_logo; ?>" />
               <?php } ?>
            </div>

            <?php if ($template->params->get('coming_soon_content')) { ?>
               <div class="comingsoon-content">
                  <?php echo $template->params->get('coming_soon_content'); ?>
               </div>
            <?php } ?>

            <?php if ($comingsoon_date) { ?>
               <div id="astroid-countdown" class="comingsoon-date text-center">
                  <div class="days mx-4">
                     <span class="count">-</span>
                     <span class="label"><?php echo JText::_('ASTROID_DAYS'); ?></span>
                  </div>
                  <div class="hours mx-4">
                     <span class="count">-</span>
                     <span class="label"><?php echo JText::_('ASTROID_HOURS'); ?></span>
                  </div>
                  <div class="minutes mx-4">
                     <span class="count">-</span>
                     <span class="label"><?php echo JText::_('ASTROID_MINUTES'); ?></span>
                  </div>
                  <div class="seconds mx-4">
                     <span class="count">-</span>
                     <span class="label"><?php echo JText::_('ASTROID_SECONDS'); ?></span>
                  </div>
               </div>
            <?php } ?>
            <?php
            if ($template->params->get('coming_soon_social', 1)) {
               $template->loadLayout('social', true, ['class' => 'd-inline-block mt-5']);
            }
            ?>
         </div>
      </div>
   </div>
</div>

<?php if (!empty($comingsoon_date)) { ?>
   <script>
      (function ($) {
         $(function () {
            moment.tz.setDefault("<?php echo JFactory::getConfig()->get('offset'); ?>");
            var _timer = moment('<?php echo $comingsoon_date; ?>', 'YYYY/MM/DD HH:mm:ss').tz('<?php echo JFactory::getConfig()->get('offset'); ?>');
            var _timezone = moment.tz.guess();
            var _countdown = _timer.clone().tz(_timezone).format('YYYY/MM/DD HH:mm:ss');
            $('#astroid-countdown').countdown(_countdown).on('update.countdown', function (event) {
               $(this).children('.days').children('.count').html(event.strftime('%D'));
               $(this).children('.hours').children('.count').html(event.strftime('%H'));
               $(this).children('.minutes').children('.count').html(event.strftime('%M'));
               $(this).children('.seconds').children('.count').html(event.strftime('%S'));
            }).on('finish.countdown', function (event) {
               $(this).children('.days').children('.count').html('0');
               $(this).children('.hours').children('.count').html('0');
               $(this).children('.minutes').children('.count').html('0');
               $(this).children('.seconds').children('.count').html('0');
            });
         });
      })(jQuery);
   </script>

   
<?php } ?>