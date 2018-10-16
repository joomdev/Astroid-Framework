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
$text = $params->get('astroid_article_quote_text', '');
$author = $params->get('astroid_article_quote_author', '');
if (empty($text) && empty($author)) {
   return;
}
?>
<div class="card mb-3">
   <div class="card-body">
      <blockquote class="blockquote text-right">
         <?php if (!empty($text)) { ?>
            <p class="mb-0"><?php echo $text; ?></p>
         <?php } ?>
         <?php if (!empty($author)) { ?>
            <footer class="blockquote-footer"><cite title="<?php echo $author; ?>"><?php echo $author; ?></cite></footer>
            <?php } ?>
      </blockquote>
   </div>
</div>