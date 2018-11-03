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

$article = $params['article'];
$params = $article->params;

$type = $params->get('astroid_article_video_type', 'youtube');
$url = $params->get('astroid_article_video_url', '');
$id = AstroidFrameworkArticle::getVideoId($url, $type);
if (empty($id)) {
   return;
}
?>
<div itemprop="video" itemscope itemtype="https://schema.org/VideoObject" class="embed-responsive embed-responsive-16by9 mb-3">
   <meta itemprop="name" content="<?php echo $article->title; ?>" />
   <?php
   switch ($type) {
      case 'youtube':
         ?>
         <meta itemprop="thumbnailURL" content="https://i.ytimg.com/vi/<?php echo $id; ?>/maxresdefault.jpg" />
         <meta itemprop="embedURL" content="https://youtube.googleapis.com/v/<?php echo $id; ?>" />
         <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $id; ?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
         <?php
         break;
      case 'vimeo':
         ?>
         <meta itemprop="thumbnailURL" content="http://i.vimeocdn.com/video/<?php echo $id; ?>.jpg" />
         <meta itemprop="embedURL" content="https://vimeo.com/<?php echo $id; ?>" />
         <iframe src="https://player.vimeo.com/video/<?php echo $id; ?>" width="640" height="269" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
         <?php
         break;
   }
   ?>
</div>