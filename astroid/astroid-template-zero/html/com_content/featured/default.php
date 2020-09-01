<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
if (version_compare(JVERSION, '3.99999.99999', 'le'))
{
	JHtml::_('behavior.caption');
} else {
	// No alternate for caption.js yet in Joomla 4.
}
// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>
<div class="blog-featured<?php echo $this->pageclass_sfx;?>" itemscope itemtype="https://schema.org/Blog">
  <?php if ($this->params->get('show_page_heading') != 0) : ?>
    <div class="item-title">
      <h1>
      <?php echo $this->escape($this->params->get('page_heading')); ?>
      </h1>
    </div>
  <?php endif; ?>

   <?php $leadingcount = 0; ?>
   <?php if (!empty($this->lead_items)) : ?>
      <div class="items-leading clearfix">
         <?php foreach ($this->lead_items as &$item) : ?>
                <div class="article-wraper">
                  <div class="article-wraper-inner">
                    <article class="item leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?><?php echo $item->featured ? ' item-featured' : ''; ?>"
                            itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                                <?php
                                $this->item = & $item;
                                echo $this->loadTemplate('item');
                                ?>
                    </article>
                  </div>
                 </div>
            <?php $leadingcount++; ?>
         <?php endforeach; ?>
      </div><!-- end items-leading -->
   <?php endif; ?>

   <?php
   $introcount = (count($this->intro_items));
   $counter = 0;
   ?>

     <?php if (!empty($this->intro_items)) : ?>
            <?php $row = $counter / $this->columns; ?>
            <div class="items-row <?php echo 'row-' . $row; ?> row clearfix">
				 <?php foreach ($this->intro_items as $key => &$item) : ?>
				  <?php $rowcount = ((int) $key % (int) $this->columns) + 1; ?>
							<div class="col-lg-<?php echo round((12 / $this->columns)); ?>">
							   <div class="article-wraper">
                  <div class="article-wraper-inner">
                      <article class="item column-<?php echo $rowcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?><?php echo $item->featured ? ' item-featured' : ''; ?>"
                          itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                            <?php
                            $this->item = & $item;
                            echo $this->loadTemplate('item');
                            ?>
                      </article>
                  <?php $counter++; ?>
                    </div>
								  </div>
							</div>
				  <?php endforeach; ?>
	        </div>
         <?php endif; ?>

   <?php if (!empty($this->link_items)) : ?>
      <?php echo $this->loadTemplate('links'); ?>
   <?php endif; ?>

  <?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) : ?>
    <div class="pagination-wrapper">
      <?php echo $this->pagination->getPagesLinks(); ?>
      <?php if ($this->params->def('show_pagination_results', 1)) : ?>
          <p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>