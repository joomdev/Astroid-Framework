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
$source = $params->get('astroid_article_audio_source', 'soundcloud');
$soundcloud = $params->get('astroid_article_audio_soundcloud', '');
$spotify = $params->get('astroid_article_audio_spotify', '');
?>
<?php if ($source == 'soundcloud' && !empty($soundcloud)) { ?>
   <div class="mb-3">
      <?php echo $soundcloud; ?>
   </div>
<?php }
?>
<?php if ($source == 'spotify' && !empty($spotify)) { ?>
   <div class="mb-3">
      <iframe src="https://embed.spotify.com/?uri=<?php echo $spotify; ?>" width="100%" height="80" frameborder="0" allowtransparency="true"></iframe>
   </div>
   <?php
}?>