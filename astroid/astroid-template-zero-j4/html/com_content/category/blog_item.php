<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
jimport('astroid.framework.article');
jimport('astroid.framework.template');
$template = new AstroidFrameworkTemplate(JFactory::getApplication()->getTemplate(true));
// Astroid Article/Blog

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;

$astroidArticle = new AstroidFrameworkArticle($this->item, true);
// Create a shortcut for params.
$params = $this->item->params;
$tpl_params = JFactory::getApplication()->getTemplate(true)->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info = $params->get('info_block_position', 0);
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') );
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
      echo LayoutHelper::render('joomla.content.intro_image', $this->item);
   } else {
      echo LayoutHelper::render('joomla.content.post_formats.post_' . $post_format, array('params' => $post_attribs, 'item' => $this->item));
   }
   $image = $astroidArticle->getImage();
   if (is_string($image) && !empty($image)) {
      $astroidArticle->template->loadLayout('blog.modules.image', true, ['image' => $image, 'title' => $this->item->title]);
   }
   $astroid_article_badge = $template->params->get('astroid_article_badge', 1) ? ($astroidArticle->article->params->get('astroid_article_badge', 0) ? 1 : 0) : 0;
   ?>
   <div class="card-body<?php echo $tpl_params->get('show_post_format') ? ' has-post-format' : ''; ?><?php echo $astroid_article_badge ? ' has-badge' : ''; ?><?php echo (!empty($image) ? ' has-image' : ''); ?>">
      <?php if ($template->params->get('astroid_badge', 1)) { ?>
         <?php if ($astroidArticle->article->params->get('astroid_article_badge', 0)) { ?>
            <?php
            if ($astroidArticle->article->params->get('astroid_article_badge_type', 2) == 1) {
               $style = '.article-badge.article-badge-custom.article-id-'.$this->item->id.':after{ border-left-color: ' . $astroidArticle->article->params->get('astroid_article_badge_color', '#000'). '} .article-badge.article-badge-custom.article-id-'.$this->item->id.':before{ border-bottom-color: ' . $astroidArticle->article->params->get('astroid_article_badge_color', '#000'). '; }';
               $document->addStyleDeclaration($style);
               ?>
               <div style="background: <?php echo $astroidArticle->article->params->get('astroid_article_badge_color', '#000'); ?>" class="article-badge article-badge-<?php 
			   if($astroidArticle->article->params->get('astroid_article_badge_type', 2) == 1){
						echo 'custom article-id-'.$this->item->id;
				   } else {
						echo $astroidArticle->article->params->get('astroid_article_badge_type', 2);
					}
				?>"><?php echo JText::_($astroidArticle->article->params->get('astroid_article_badge_text', '')); ?></div>
            <?php } else { ?>
               <div class="article-badge article-badge-<?php echo $astroidArticle->article->params->get('astroid_article_badge_type', 2); ?>"><?php echo JText::_('ASTROID_ARTICLE_OPTIONS_BADGE_' . ($astroidArticle->article->params->get('astroid_article_badge_type', 2)) . '_LBL'); ?></div>
            <?php } ?>
         <?php } ?>
      <?php } ?>
      <div class="item-title">
         <?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>
      </div>
      <?php echo LayoutHelper::render('joomla.content.post_formats.icons', $post_format); ?>
      <?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
         <?php echo LayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'astroidArticle' => $astroidArticle, 'position' => 'above')); ?>
      <?php endif; ?>
      <?php echo $this->item->introtext; ?>
      <?php if ($info == 1 || $info == 2) : ?>
         <?php if ($useDefList) : ?>
            <?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
            <?php echo LayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'astroidArticle' => $astroidArticle, 'position' => 'below')); ?>
         <?php endif; ?>
      <?php endif; ?>
      <?php if (!$params->get('show_intro')) : ?>
         <?php echo $this->item->event->afterDisplayTitle; ?>
      <?php endif; ?>
      <?php echo $this->item->event->beforeDisplayContent; ?>
      <?php
      if ($params->get('show_readmore') && $this->item->readmore) :
         if ($params->get('access-view')) :
            $link = Route::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
         else :
            $menu = Factory::getApplication()->getMenu();
            $active = $menu->getActive();
            $itemId = $active->id;
	    $link = new Uri(Route::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
	    $link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
         endif; ?>
         <?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>
      <?php endif; ?>
   </div>
      <?php if ($this->item->stage_condition == ContentComponent::CONDITION_UNPUBLISHED|| strtotime($this->item->publish_up) > strtotime(Factory::getDate()) ||
       ((strtotime($this->item->publish_down) < strtotime(Factory::getDate())) && $this->item->publish_down != Factory::getDbo()->getNullDate())) :
      ?>
   </div>
<?php endif; ?>
<?php if ($params->get('show_tags') && !empty($this->item->tags->itemTags)) : ?>
   <?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; ?>
