<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * 	DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 *  You can easily override all files under /frontend/ folder.
 *	Just copy the file to ROOT/templates/YOURTEMPLATE/html/frontend/blog/ folder to create and override
 */
// No direct access.
defined('_JEXEC') or die;
extract($displayData);

$params = $article->params;

$type = $params->get('astroid_article_video_type', 'youtube');
$url = $params->get('astroid_article_video_url', '');
$content = Astroid\Helper\Video::getVideoByTypeUrl($type, $url, true);
if (empty($content)) {
   return;
}
?>
<div itemprop="video" itemscope itemtype="https://schema.org/VideoObject" class="embed-responsive embed-responsive-16by9 article-video">
   <meta itemprop="name" content="<?php echo $article->title; ?>" />
   <?php echo $content; ?>
</div>