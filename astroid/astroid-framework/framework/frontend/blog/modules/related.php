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
$items = $params['items'];
if (empty($items)) {
   return;
}
?>
<div class="relatedposts-wrap mb-3 mt-5">
   <h4><?php echo JText::_('ASTROID_ARTICLE_RELATED_LBL'); ?></h4>
   <div class="relateditems row">
      <?php foreach ($items as $item) : $images = json_decode($item->images); ?>
         <div class="col-md-6 p-2">
            <div class="card h-100 mb-4">
               <?php
               if (!empty($images->image_intro)) {
                  ?>
                  <a href="<?php echo $item->route; ?>">
                     <img class="card-img-top" src="<?php echo $images->image_intro; ?>" data-holder-rendered="true">
                  </a>
               <?php } ?>
               <div class="card-body">
                  <small class="text-muted"> <?php echo $item->category_title; ?></small>
                  <a href="<?php echo $item->route; ?>"><h3><?php echo $item->title; ?></h3></a>
                  <?php echo $item->introtext; ?>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
</div>