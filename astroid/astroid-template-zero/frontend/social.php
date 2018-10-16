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
$class = @$params['class'];
$social_profiles = $template->params->get('social_profiles', []);
$style = $template->params->get('social_profiles_style', 1);
if (!empty($social_profiles)) {
   $social_profiles = json_decode($social_profiles);
}
?>

<ul class="nav navVerticalView astroid-social-icons<?php echo!empty($class) ? ' ' . $class : ''; ?>">
   <?php
   foreach ($social_profiles as $social_profile) {
      switch ($social_profile->id) {
         case 'whatsapp':
            $social_profile_link = 'https://api.whatsapp.com/send?phone=' . $social_profile->link;
            break;
         case 'telegram':
            $social_profile_link = 'http://t.me/' . $social_profile->link;
            break;
         case 'skype':
            $social_profile_link = 'skype:' . $social_profile->link . '?chat';
            break;
         default:
            $social_profile_link = $social_profile->link;
            break;
      }
      echo '<li><a style="color:' . ($style == 1 ? 'inherit' : $social_profile->color) . '" href="' . $social_profile_link . '" target="_blank" rel="noopener"><i class="' . $social_profile->icon . '"></i></a></li>';
   }
   ?>
</ul>