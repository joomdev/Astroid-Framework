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
$params = $article->params;
$heading = $params->get('astroid_article_review_heading', '');
$summery = $params->get('astroid_article_review_summery', '');
$good_things = $params->get('astroid_article_review_good', '');
$bad_things = $params->get('astroid_article_review_bad', '');
$overall_rating = $params->get('astroid_article_review_rating', 0);

$button_text = $params->get('astroid_article_button_action', '');
$button_link = $params->get('astroid_article_button_link', '');

$criterias = $params->get('astroid_article_review_criterias', []);

if (empty($overall_rating)) {
   $score = 0;
   $items = 0;
   foreach ($criterias as $criteria) {
      $score += $criteria['score'];
      $items++;
   }
   $overall_rating = $score / $items;
}
?>
<div class="card mb-3">
   <div class="card-body">
      <div class="review-head row border-bottom pb-3 mb-3">
         <div class="col-auto">
            <div class="review-total-score">
               <span style="min-width: 110px;" class="score-value d-block display-4 py-3 bg-warning text-white text-center"><?php echo $overall_rating; ?></span>
               <span class="score-label d-block small text-center bg-dark py-1 text-white"><?php echo JText::_('ASTROID_ARTICLE_TOTAL_SCORE'); ?></span>
            </div>
         </div>
         <div class="col">
            <?php if (!empty($heading)) { ?>
               <h3><?php echo $heading; ?></h3>
            <?php } ?>
            <?php if (!empty($summery)) { ?>
               <p><?php echo $summery; ?></p>
            <?php } ?>
         </div>
      </div>
      <div class="review-criterias row border-bottom pb-3 mb-3">
         <?php
         foreach ($criterias as $criteria) {
            ?>
            <div class="review-criteria col-12 mb-3">
               <div class="review-criteria-title">
                  <p class="review-criteria-label d-inline-block m-0"><?php echo $criteria['title']; ?></p>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="review-criteria-progress progress mt-1">
                        <div class="progress-bar progress-bar-viewport-animation" data-value="<?php echo $criteria['score'] * 10; ?>" role="progressbar" style="width: 0%" aria-valuenow="<?php echo $criteria['score']; ?>" aria-valuemin="0" aria-valuemax="10"></div>
                     </div>
                  </div>
                  <div class="col-auto">
                     <p class="review-criteria-rating d-inline-block m-0"><?php echo $criteria['score']; ?>/10</p>
                  </div>
               </div>
            </div>
            <?php
         }
         ?>
      </div>
      <div class="review-good-bad row border-bottom pb-3 mb-3">
         <div class="col-md-6">
            <h4 class="text-success"><?php echo JText::_('ASTROID_ARTICLE_PROS_LBL'); ?></h4>
            <ul class="list-unstyled">
               <?php
               foreach (explode("\n", $good_things) as $good_thing) {
                  ?>
                  <li><i class="fa fa-check-circle text-success"></i> <?php echo $good_thing; ?></li>
               <?php } ?>
            </ul>
         </div>
         <div class="col-md-6">
            <h4 class="text-danger"><?php echo JText::_('ASTROID_ARTICLE_CONS_LBL'); ?></h4>
            <ul class="list-unstyled">
               <?php
               foreach (explode("\n", $bad_things) as $bad_thing) {
                  ?>
                  <li><i class="fa fa-minus-circle text-danger"></i> <?php echo $bad_thing; ?></li>
               <?php } ?>
            </ul>
         </div>
      </div>
      <?php if (!empty($button_text) && !empty($button_link)) { ?>
         <div class="row">
            <div class="col text-center">
               <a href="<?php echo $button_link; ?>" class="btn btn-primary"><?php echo $button_text; ?></a>
            </div>
         </div>
      <?php } ?>
   </div>
</div>