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
                  <img class="card-img-top" src="<?php echo $images->image_intro; ?>" data-holder-rendered="true">
               <?php } ?>
               <div class="card-body">
                  <a href="<?php echo $item->route; ?>"><h3><?php echo $item->title; ?></h3></a>
                  <p class="card-text"><?php echo $item->introtext; ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                     <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('JGLOBAL_HITS'); ?>"><?php echo $item->hits; ?></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('JDATE'); ?>"><?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?></button>
                     </div>
                     <small class="text-muted"> <?php echo $item->category_title; ?></small>
                  </div>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
</div>