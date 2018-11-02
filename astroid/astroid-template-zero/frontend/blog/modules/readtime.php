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
?>
<dd class="readtime">
   <i class="far fa-newspaper"></i>
   <?php echo JText::sprintf('ASTROID_ARTICLE_BLOG_READTIME', $article->readtime); ?>
</dd>