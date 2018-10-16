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
$rating = empty($article->rating) ? 0 : $article->rating;
$rating_count = empty($article->rating_count) ? 0 : $article->rating_count;
?>

<div class="article-rating">
   <div class="ui star rating" id="<?php echo 'content_vote_' . (int) $article->id; ?>"></div>
   <div data-votes="<?php echo $rating_count; ?>" class="vote-count article-rating-votecount-<?php echo $article->id; ?>">(<?php echo $rating_count; ?> vote<?php echo $rating_count == 1 ? '' : 's'; ?>)</div>
   <div class="loading article-rating-loading-<?php echo $article->id; ?> d-none"></div>
   <div class="message d-none article-rating-message-<?php echo $article->id; ?>"></div>
</div>
<?php //echo JHtml::_('form.token');  ?>
<script>
   (function ($) {
      $(function () {
         var ratingtimer = null
         var ratingtimer2 = null
         $('#<?php echo 'content_vote_' . (int) $article->id; ?>').rating({
            initialRating: <?php echo $rating; ?>,
            maxRating: 5,
            onRate: function (value) {
               $.ajax({
                  url: "<?php echo JURI::root(); ?>index.php?option=com_ajax&astroid=rate",
                  option: 'com_ajax',
                  method: 'POST',
                  beforeSend: function () {
                     window.clearTimeout(ratingtimer);
                     window.clearTimeout(ratingtimer2);
                     $('.article-rating-loading-<?php echo $article->id; ?>').removeClass('d-none');
                     $('.article-rating-votecount-<?php echo $article->id; ?>').addClass('d-none');
                     $('.article-rating-message-<?php echo $article->id; ?>').addClass('d-none').text('').removeClass('error').removeClass('success').removeClass('animated').removeClass('fadeIn').removeClass('fadeOut');
                  },
                  data: {
                     vote: value,
                     id: '<?php echo $article->id; ?>',
                     '<?php echo JSession::getFormToken(); ?>': 1
                  },
                  dataType: 'json',
                  error: function () {
                     $('.article-rating-votecount-<?php echo $article->id; ?>').removeClass('d-none');
                     $('.article-rating-loading-<?php echo $article->id; ?>').addClass('d-none');
                  },
                  success: function (response) {
                     $('.article-rating-votecount-<?php echo $article->id; ?>').removeClass('d-none');
                     $('.article-rating-loading-<?php echo $article->id; ?>').addClass('d-none');
                     $('.article-rating-message-<?php echo $article->id; ?>').text(response.message).removeClass('d-none').addClass(response.status).addClass('animated').addClass('fadeIn');
                     ratingtimer = setTimeout(function () {
                        $('.article-rating-message-<?php echo $article->id; ?>').removeClass('fadeIn').addClass('fadeOut');
                        ratingtimer2 = setTimeout(function () {
                           $('.article-rating-message-<?php echo $article->id; ?>').addClass('d-none').text('').removeClass('error').removeClass('success').removeClass('animated').removeClass('fadeIn').removeClass('fadeOut');
                        }, 600);
                     }, 2000);

                     if (response.status == 'success') {
                        var _votes = $('.vote-count').data('votes');
                        _votes = parseInt(_votes) + 1;
                        _text = 'vote' + (_votes == 1 ? '' : 's');
                        $('.vote-count').text('(' + _votes + ' ' + _text + ')').addClass('change');
                        setTimeout(function () {
                           $('.vote-count').removeClass('change');
                        }, 300);
                     }
                  }
               });
            }
         });
      });
   })(jQuery);
</script>