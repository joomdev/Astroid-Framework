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

$doc = JFactory::getDocument();
$doc->addScript(JURI::root() . 'templates/' . $template->template . '/js/vendor/jquery.countdown.min.js');
$app = JFactory::getApplication();
// Background Image
$background_image = $template->params->get('coming_soon_background_image');
$styles = [];
if (!empty($background_image)) {
   $background_repeat = $template->params->get('coming_soon_background_repeat', 'inherit');
   $background_size = $template->params->get('coming_soon_background_size', 'inherit');
   $background_position = $template->params->get('coming_soon_background_position', 'inherit');
   $background_attachment = $template->params->get('coming_soon_background_attachment', 'inherit');
   $styles[] = 'background-image:url(' . JURI::root() . 'images/' . $background_image . ')';
   $styles[] = 'background-repeat:' . $background_repeat;
   $styles[] = 'background-attachment:' . $background_attachment;
   $styles[] = 'background-position:' . $background_position;
   $styles[] = 'background-size:' . $background_size;
}
$comingsoon_logo = "";
$hascs_logo = 0;
if ($cs_logo = $template->params->get('coming_soon_logo')) {
   $comingsoon_logo = JURI::root() . 'images/' . $cs_logo;
   $hascs_logo = 1;
}
$comingsoon_date = $template->params->get("coming_soon_countdown_date", '2019-01-01');
?>

<div class="comingsoon-wrap" style="<?php echo implode(';', $styles); ?>">	
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
            $('#astroid-countdown').countdown('<?php echo date('Y/m/d', strtotime($comingsoon_date)); ?>').on('update.countdown', function (event) {
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