<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
jimport('astroid.framework.article');
jimport('astroid.framework.template');
$template = new AstroidFrameworkTemplate(JFactory::getApplication()->getTemplate(true));
// Astroid Article/Blog
$astroidArticle = new AstroidFrameworkArticle($this->item, true);
// Create a shortcut for params.
$params = $this->item->params;
$tpl_params = JFactory::getApplication()->getTemplate(true)->params;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info = $params->get('info_block_position', 0);
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') ||  $template->params->get('astroid_readtime', 1));
$document = JFactory::getDocument();
// Post Format
$post_attribs = new JRegistry(json_decode($this->item->attribs));
$post_format = $post_attribs->get('post_format', 'standard');
?>
<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate()) || ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) :
   ?>
   <div class="system-unpublished">
   <?php endif; ?>
   <?php
   if ($post_format == 'standard') {
      echo JLayoutHelper::render('joomla.content.intro_image', $this->item);
   } else {
      echo JLayoutHelper::render('joomla.content.post_formats.post_'.$post_format, array('params' => $post_attribs, 'item' => $this->item));
   }
   $image = $astroidArticle->getImage();
   if (is_string($image) && !empty($image)) {
      $astroidArticle->template->loadLayout('blog.modules.image', true, ['image' => $image, 'title' => $this->item->title]);
   }
   ?>
   <div class="card-body<?php echo $tpl_params->get('show_post_format') ? ' has-post-format' : ''; ?><?php echo (!empty($image) ? ' has-image' : ''); ?>">
      <?php $astroidArticle->renderArticleBadge(); ?>
      <div class="article-title item-title">
         <?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>
      </div>
      <?php echo JLayoutHelper::render('joomla.content.post_formats.icons', $post_format); ?>
      <?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
         <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'astroidArticle' => $astroidArticle, 'position' => 'above')); ?>
      <?php endif; ?>
      <div class="article-intro-text"><?php echo $this->item->introtext; ?></div>
      <?php if ($info == 1 || $info == 2) : ?>
         <?php if ($useDefList) : ?>
            <?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block 
                  ?>
            <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'astroidArticle' => $astroidArticle, 'position' => 'below')); ?>
         <?php endif; ?>
      <?php endif; ?>
      <?php if (!$params->get('show_intro')) : ?>
         <?php echo $this->item->event->afterDisplayTitle; ?>
      <?php endif; ?>
      <?php echo $this->item->event->beforeDisplayContent; ?>
      <?php
      if ($params->get('show_readmore') && $this->item->readmore) :
         if ($params->get('access-view')) :
            $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
         else :
            $menu = JFactory::getApplication()->getMenu();
            $active = $menu->getActive();
            $itemId = $active->id;
            $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid='.$itemId);
            $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
            $link = new JUri($link1);
            $link->setVar('return', base64_encode($returnURL));
         endif;
         ?>
         <?php echo JLayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>
      <?php endif; ?>
   </div>
   <?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate()) || ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) :
      ?>
   </div>
<?php endif; ?>
<?php if ($params->get('show_tags') && !empty($this->item->tags->itemTags)) : ?>
   <?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; ?>