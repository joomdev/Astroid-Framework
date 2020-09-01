<?php
/**
 * @package Astroid Framework
 * @author  JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2019 Joomdev, Inc. All rights reserved.
 * @license GNU General Public License version 2 or later;
*/

defined ('_JEXEC') or die();

JHtml::_('behavior.tabstate');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', '#jform_catid', null, array('disable_search_threshold' => 0));
$this->tab_name = 'com-content-form';
$this->ignore_fieldsets = array('image-intro', 'image-full', 'jmetadata', 'item_associations');

// Create shortcut to parameters.
$params = $this->state->get('params');

//Blog Options
$attribs = json_decode($this->item->attribs, false);
// Article type option

$this->form->setValue('astroid_article_type', 'attribs' , (isset($attribs->astroid_article_type) && $attribs->astroid_article_type) ? $attribs->astroid_article_type : '');
$this->form->setValue('astroid_article_video_type', 'attribs' , (isset($attribs->astroid_article_video_type) && $attribs->astroid_article_video_type) ? $attribs->astroid_article_video_type : 'standard');

$this->form->setValue('astroid_article_video_url', 'attribs' , (isset($attribs->astroid_article_video_url) && $attribs->astroid_article_video_url) ? $attribs->astroid_article_video_url : '');

$this->form->setValue('astroid_article_gallery_width', 'attribs' , (isset($attribs->astroid_article_gallery_width) && $attribs->astroid_article_gallery_width) ? $attribs->astroid_article_gallery_width : '');

$this->form->setValue('astroid_article_gallery_bullets', 'attribs' , (isset($attribs->astroid_article_gallery_bullets) && $attribs->astroid_article_gallery_bullets) ? $attribs->astroid_article_gallery_bullets : @$attribs->astroid_article_gallery_bullets);

$this->form->setValue('astroid_article_gallery_navigation', 'attribs' , (isset($attribs->astroid_article_gallery_navigation) && $attribs->astroid_article_gallery_navigation) ? $attribs->astroid_article_gallery_navigation : @$attribs->astroid_article_gallery_navigation);

$this->form->setValue('astroid_article_thumbnail', 'attribs' , (isset($attribs->astroid_article_thumbnail) && $attribs->astroid_article_thumbnail) ? $attribs->astroid_article_thumbnail : @$attribs->astroid_article_thumbnail);

$this->form->setValue('astroid_article_gallery_items', 'attribs' , (isset($attribs->astroid_article_gallery_items) && $attribs->astroid_article_gallery_items) ? $attribs->astroid_article_gallery_items : '');

$this->form->setValue('astroid_article_audio_source', 'attribs' , (isset($attribs->astroid_article_audio_source) && $attribs->astroid_article_audio_source) ? $attribs->astroid_article_audio_source : '');


$this->form->setValue('astroid_article_audio_soundcloud', 'attribs' , (isset($attribs->astroid_article_audio_soundcloud) && $attribs->astroid_article_audio_soundcloud) ? $attribs->astroid_article_audio_soundcloud : '');

$this->form->setValue('astroid_article_audio_spotify', 'attribs' , (isset($attribs->astroid_article_audio_spotify) && $attribs->astroid_article_audio_spotify) ? $attribs->astroid_article_audio_spotify : '');

$this->form->setValue('astroid_article_review_heading', 'attribs' , (isset($attribs->astroid_article_review_heading) && $attribs->astroid_article_review_heading) ? $attribs->astroid_article_review_heading : '');

$this->form->setValue('astroid_article_review_summery', 'attribs' , (isset($attribs->astroid_article_review_summery) && $attribs->astroid_article_review_summery) ? $attribs->astroid_article_review_summery : '');

$this->form->setValue('astroid_article_review_good', 'attribs' , (isset($attribs->astroid_article_review_good) && $attribs->astroid_article_review_good) ? $attribs->astroid_article_review_good : '');

$this->form->setValue('astroid_article_review_bad', 'attribs' , (isset($attribs->astroid_article_review_bad) && $attribs->astroid_article_review_bad) ? $attribs->astroid_article_review_bad : '');

$this->form->setValue('astroid_article_review_rating', 'attribs' , (isset($attribs->astroid_article_review_rating) && $attribs->astroid_article_review_rating) ? $attribs->astroid_article_review_rating : '');

$this->form->setValue('astroid_article_button_action', 'attribs' , (isset($attribs->astroid_article_button_action) && $attribs->astroid_article_button_action) ? $attribs->astroid_article_button_action : '');

$this->form->setValue('astroid_article_button_link', 'attribs' , (isset($attribs->astroid_article_button_link) && $attribs->astroid_article_button_link) ? $attribs->astroid_article_button_link : '');

$this->form->setValue('astroid_article_review_criterias', 'attribs' , (isset($attribs->astroid_article_review_criterias) && $attribs->astroid_article_review_criterias) ? $attribs->astroid_article_review_criterias : '');

$this->form->setValue('astroid_article_quote_text', 'attribs' , (isset($attribs->astroid_article_quote_text) && $attribs->astroid_article_quote_text) ? $attribs->astroid_article_quote_text : '');

$this->form->setValue('astroid_article_quote_author', 'attribs' , (isset($attribs->astroid_article_quote_author) && $attribs->astroid_article_quote_author) ? $attribs->astroid_article_quote_author : '');

$this->form->setValue('astroid_article_badge', 'attribs' , (isset($attribs->astroid_article_badge) && $attribs->astroid_article_badge) ? $attribs->astroid_article_badge : '');

$this->form->setValue('astroid_article_badge_type', 'attribs' , (isset($attribs->astroid_article_badge_type) && $attribs->astroid_article_badge_type) ? $attribs->astroid_article_badge_type : '');

$this->form->setValue('astroid_article_badge_text', 'attribs' , (isset($attribs->astroid_article_badge_text) && $attribs->astroid_article_badge_text) ? $attribs->astroid_article_badge_text : '');

$this->form->setValue('astroid_article_badge_color', 'attribs' , (isset($attribs->astroid_article_badge_color) && $attribs->astroid_article_badge_color) ? $attribs->astroid_article_badge_color : '');

$this->form->setValue('astroid_article_badge_text_color', 'attribs' , (isset($attribs->astroid_article_badge_text_color) && $attribs->astroid_article_badge_text_color) ? $attribs->astroid_article_badge_text_color : '');

$this->form->setValue('astroid_readtime', 'attribs' , (isset($attribs->astroid_readtime) && $attribs->astroid_readtime) ? $attribs->astroid_readtime : @$attribs->astroid_readtime);
$this->form->setValue('astroid_posttype', 'attribs' , (isset($attribs->astroid_posttype) && $attribs->astroid_posttype) ? $attribs->astroid_posttype : @$attribs->astroid_posttype);

$this->form->setValue('astroid_relatedposts', 'attribs' , (isset($attribs->astroid_relatedposts) && $attribs->astroid_relatedposts) ? $attribs->astroid_relatedposts : '');
$this->form->setValue('astroid_socialshare', 'attribs' , (isset($attribs->astroid_socialshare) && $attribs->astroid_socialshare) ? $attribs->astroid_socialshare : '');

$this->form->setValue('astroid_comments', 'attribs' , (isset($attribs->astroid_comments) && $attribs->astroid_comments) ? $attribs->astroid_comments : '');
$this->form->setValue('astroid_og_title', 'attribs' , (isset($attribs->astroid_og_title) && $attribs->astroid_og_title) ? $attribs->astroid_og_title : '');
$this->form->setValue('astroid_og_desc', 'attribs' , (isset($attribs->astroid_og_desc) && $attribs->astroid_og_desc) ? $attribs->astroid_og_desc : '');
$this->form->setValue('astroid_og_image', 'attribs' , (isset($attribs->astroid_og_image) && $attribs->astroid_og_image) ? $attribs->astroid_og_image : '');
$this->form->setValue('astroid_authorinfo', 'attribs' , (isset($attribs->astroid_authorinfo) && $attribs->astroid_authorinfo) ? $attribs->astroid_authorinfo : @$attribs->astroid_authorinfo);
// End Articles Type

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params->show_publishing_options);

if (!$editoroptions)
{
	$params->show_urls_images_frontend = '0';
}

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'article.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
		{
			" . $this->form->getField('articletext')->save() . "
			Joomla.submitform(task);
		}
	}
");
?>
<div class="edit item-page<?php echo $this->pageclass_sfx; ?>">
	<?php if ($params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_content&a_id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-vertical com-content-adminForm">
		<fieldset>
			<?php echo JHtml::_('bootstrap.startTabSet', $this->tab_name, array('active' => 'editor')); ?>

			<?php echo JHtml::_('bootstrap.addTab', $this->tab_name, 'editor', JText::_('COM_CONTENT_ARTICLE_CONTENT')); ?>
				<?php echo $this->form->renderField('title'); ?>

				<?php if (is_null($this->item->id)) : ?>
					<?php echo $this->form->renderField('alias'); ?>
				<?php endif; ?>

				<?php echo $this->form->getInput('articletext'); ?>

				<?php if ($this->captchaEnabled) : ?>
					<?php echo $this->form->renderField('captcha'); ?>
				<?php endif; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php if ($params->get('show_urls_images_frontend')) : ?>
			<?php echo JHtml::_('bootstrap.addTab', $this->tab_name, 'images', JText::_('COM_CONTENT_IMAGES_AND_URLS')); ?>
				
				<div class="row">
					<div class="col-sm-6 mb-3">
						<?php echo $this->form->renderField('image_intro', 'images'); ?>
						<?php echo $this->form->renderField('image_intro_alt', 'images'); ?>
						<?php echo $this->form->renderField('image_intro_caption', 'images'); ?>
						<?php echo $this->form->renderField('float_intro', 'images'); ?>
					</div>

					<div class="col-sm-6">
						<?php echo $this->form->renderField('image_fulltext', 'images'); ?>
						<?php echo $this->form->renderField('image_fulltext_alt', 'images'); ?>
						<?php echo $this->form->renderField('image_fulltext_caption', 'images'); ?>
						<?php echo $this->form->renderField('float_fulltext', 'images'); ?>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-sm-4 mb-3">
						<?php echo $this->form->renderField('urla', 'urls'); ?>
						<?php echo $this->form->renderField('urlatext', 'urls'); ?>
						<div class="control-group">
							<div class="controls">
								<?php echo $this->form->getInput('targeta', 'urls'); ?>
							</div>
						</div>
					</div>

					<div class="col-sm-4 mb-3">
						<?php echo $this->form->renderField('urlb', 'urls'); ?>
						<?php echo $this->form->renderField('urlbtext', 'urls'); ?>
						<div class="control-group">
							<div class="controls">
								<?php echo $this->form->getInput('targetb', 'urls'); ?>
							</div>
						</div>
					</div>

					<div class="col-sm-4 mb-3">
						<?php echo $this->form->renderField('urlc', 'urls'); ?>
						<?php echo $this->form->renderField('urlctext', 'urls'); ?>
						<div class="control-group">
							<div class="controls">
								<?php echo $this->form->getInput('targetc', 'urls'); ?>
							</div>
						</div>
					</div>
				</div>
				
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			<?php endif; ?>

			<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

			<?php echo JHtml::_('bootstrap.addTab', $this->tab_name, 'publishing', JText::_('COM_CONTENT_PUBLISHING')); ?>
				<?php echo $this->form->renderField('catid'); ?>
				<?php echo $this->form->renderField('tags'); ?>
				<?php if ($params->get('save_history', 0)) : ?>
					<?php echo $this->form->renderField('version_note'); ?>
				<?php endif; ?>
				<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
					<?php echo $this->form->renderField('created_by_alias'); ?>
				<?php endif; ?>
				<?php if ($this->item->params->get('access-change')) : ?>
					<?php echo $this->form->renderField('state'); ?>
					<?php echo $this->form->renderField('featured'); ?>
					<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
						<?php echo $this->form->renderField('publish_up'); ?>
						<?php echo $this->form->renderField('publish_down'); ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php echo $this->form->renderField('access'); ?>
				<?php if (is_null($this->item->id)) : ?>
					<div class="control-group">
						<div class="control-label">
						</div>
						<div class="controls">
							<?php echo JText::_('COM_CONTENT_ORDERING'); ?>
						</div>
					</div>
				<?php endif; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php echo JHtml::_('bootstrap.addTab', $this->tab_name, 'language', JText::_('JFIELD_LANGUAGE_LABEL')); ?>
				<?php echo $this->form->renderField('language'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php if ($params->get('show_publishing_options', 1) == 1) : ?>
				<?php echo JHtml::_('bootstrap.addTab', $this->tab_name, 'metadata', JText::_('COM_CONTENT_METADATA')); ?>
					<?php echo $this->form->renderField('metadesc'); ?>
					<?php echo $this->form->renderField('metakey'); ?>
				<?php echo JHtml::_('bootstrap.endTab'); ?>
			<?php endif; ?>

			<?php echo JHtml::_('bootstrap.endTabSet'); ?>

			<input type="hidden" name="task" value="">
			<input type="hidden" name="return" value="<?php echo $this->return_page; ?>">
			<?php echo JHtml::_('form.token'); ?>
		</fieldset>
		<div class="btn-toolbar">
				<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('article.save')">
					<span class="fas fa-check"></span> <?php echo JText::_('ASTROID_SAVE') ?>
				</button>
				<button type="button" class="btn btn-secondary ml-2" onclick="Joomla.submitbutton('article.cancel')">
					<span class="fas fa-times"></span> <?php echo JText::_('JCANCEL') ?>
				</button>
			<?php if ($params->get('save_history', 0) && $this->item->id) : ?>
				<?php echo $this->form->getInput('contenthistory'); ?>
			<?php endif; ?>
		</div>
	</form>
</div>
