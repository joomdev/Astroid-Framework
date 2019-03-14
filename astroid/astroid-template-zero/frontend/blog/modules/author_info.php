<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * 	DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 *  You can easily override all files under /frontend/ folder.
 *	Just copy the file to ROOT/templates/YOURTEMPLATE/html/frontend/blog/ folder to create and override
 */
// No direct access.
defined('_JEXEC') or die;
extract($displayData);

$article = $params['article'];
// Get User Details
$user = JFactory::getUser($article->created_by);
$params = new JRegistry();
$params->loadString($user->params, 'JSON');
// Get social profiles
$socials = $params->get('astroid_author_social', []);
$hash_email = md5(strtolower(trim($user->email)));
?>

<div class="author-wrap bg-light border p-2 mt-5">
   <div class="author-body d-flex">
      <div class="author-thumb mr-4">
         <?php if (!empty($params->get('astroid_author_picture', 0))) { ?>
            <div class="author-thumb mr-4">
               <?php if ($params->get('astroid_author_picture', 'gravatar') == "upload") { ?>
                  <?php if (!empty($params->get('upload', ''))) { ?>
                     <img width="80" src="<?php echo JURI::base() . $params->get('upload', ''); ?>">
                  <?php } else { ?>
                     <img width="80" src="<?php echo JURI::base(); ?>images/<?php echo $template->template; ?>/user-avatar.png">
                  <?php } ?>
               <?php } ?>
               <?php if ($params->get('astroid_author_picture', '') == "gravatar") { ?>
                  <img src="https://www.gravatar.com/avatar/<?php echo $hash_email; ?>" />
               <?php } ?>
            </div>
         <?php } ?>
      </div>
      <div class="author-info">
         <h3 class="p-0"><?php echo $user->name; ?></h3>
         <?php if (!empty($params->get('astroid_author_aboutme', ''))) { ?>
            <p class="mt-2 pt-3 text-muted border-top"><?php echo $params->get('astroid_author_aboutme', ''); ?></p>
         <?php } ?>
      </div>
   </div>
   <?php if (!empty($socials)) { ?>
      <ul class="list-inline border-top author-social-links m-0 pt-2">
         <?php foreach ($socials as $social) { ?>
            <li class="list-inline-item">
               <a target="_blank" rel="noopener" href="<?php echo $social->link; ?>"><i class="<?php echo $social->icon; ?> fa-lg"></i></a>
            </li>
         <?php } ?>
      </ul>
   <?php } ?>
</div>