<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;
?>
<div class="latestnews">
   <ul class="list-group list-group-flush">
      <?php foreach ($list as $item) : $image = json_decode($item->images); ?>
      <li itemscope itemtype="https://schema.org/Article" class="list-group-item px-0">
         <?php if($image->image_intro != "") : ?>
            <a class="article-title" href="<?php echo $item->link; ?>" itemprop="url" class="">
               <img class="card-img-top pb-2" src="<?php echo JURI::root().$image->image_intro; ?>" alt="<?php echo htmlspecialchars($image->image_fulltext_alt); ?>">
            </a>
         <?php endif; ?>
         <h6>
            <a class="article-title" href="<?php echo $item->link; ?>" itemprop="url" class="">
               <span itemprop="name">
                  <?php echo $item->title; ?>
               </span>
            </a>
         </h6>
      </li>
      <?php endforeach; ?>
   </ul>
</div>