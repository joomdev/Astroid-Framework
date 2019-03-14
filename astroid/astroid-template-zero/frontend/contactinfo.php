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
$contact_details = $template->params->get('contact_details', 1);
if (!$contact_details) {
   return;
}
$phone = $template->params->get('contact_phone_number', '');
$mobile = $template->params->get('contact_mobile_number', '');
$email = $template->params->get('contact_email_address', '');
$openhours = $template->params->get('contact_open_hours', '');
$address = $template->params->get('contact_address', '');
$contact_display = $template->params->get('contact_display', 'icons');
?>

<div class="astroid-contact-info">
   <?php if (!empty($address)) { ?>
      <span class="mr-3 d-inline-block">
         <?php if ($contact_display == "icons") : ?>
            <i class="fas fa-map-marker-alt mr-1"></i>
         <?php endif; ?>
         <?php if ($contact_display == "text") : ?>
            <?php echo JText::_('TPL_ASTROID_ADDRESS_LABEL'); ?>:
         <?php endif; ?>
         <?php echo $address; ?>
      </span>
   <?php } ?>

   <?php if (!empty($phone)) { ?>
      <span class="mr-3 d-inline-block">
         <?php if ($contact_display == "icons") : ?>
            <i class="fas fa-phone fa-rotate-90 mr-1"></i>
         <?php endif; ?>
         <?php if ($contact_display == "text") : ?>
            <?php echo JText::_('TPL_ASTROID_PHONE_LABEL'); ?>:
         <?php endif; ?>
         <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
      </span>
   <?php } ?>

   <?php if (!empty($mobile)) { ?>
      <span class="mr-3 d-inline-block">
         <?php if ($contact_display == "icons") : ?>
            <i class="fas fa-mobile-alt mr-1"></i>
         <?php endif; ?>
         <?php if ($contact_display == "text") : ?>
            <?php echo JText::_('TPL_ASTROID_MOBILE_LABEL'); ?>:
         <?php endif; ?>
         <a href="tel:<?php echo $mobile; ?>"><?php echo $mobile; ?></a>
      </span>
   <?php } ?>

   <?php if (!empty($email)) { ?>
      <span class="mr-3 d-inline-block">
         <?php if ($contact_display == "icons") : ?>
            <i class="far fa-envelope mr-1"></i>
         <?php endif; ?>
         <?php if ($contact_display == "text") : ?>
            <?php echo JText::_('JGLOBAL_EMAIL'); ?>:
         <?php endif; ?>
         <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
      </span>
   <?php } ?>

   <?php if (!empty($openhours)) { ?>
      <span class="mr-3 d-inline-block">
         <?php if ($contact_display == "icons") : ?>
            <i class="far fa-clock mr-1"></i>
         <?php endif; ?>
         <?php if ($contact_display == "text") : ?>:
            <?php echo JText::_('TPL_ASTROID_OPENHOURS_LABEL'); ?>
         <?php endif; ?>
         <?php echo $openhours; ?>
      </span>
   <?php } ?>
</div>