<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * 	DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 *  You can easily override all files under /frontend/ folder.
 *	Just copy the file to ROOT/templates/YOURTEMPLATE/html/frontend/blog/ folder to create and override
 */
// No direct access.
defined('_JEXEC') or die;
extract($displayData);

$article = $params['article'];
$params = $article->params;
$article_comments = $template->params->get('article_comments', 'none');
?>
<!--- Facebook Comment Section Start --->
<?php
if ($article_comments == 'facebook') {
   $fb_id = $template->params->get('article_comments_fb_id', '');
   ?>
   <?php if (!empty($fb_id)) { ?>
      <div class="astroid-comment">
         <div class="card-body"><div class="fb-comments"  data-width="<?php echo $template->params->get('article_comments_fb_width'); ?>" data-numposts="5" data-colorscheme="dark">
            </div>
         </div>
      </div>
      <div id="fb-root"></div>
      <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
               return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1&appId=<?php echo $fb_id; ?>&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script>
   <?php } else { ?>
      <div class="alert alert-danger" role="alert">
         <h4 class="alert-heading"><?php echo JText::_('ASTROID_FACEBOOK_COMMENT_ERROR_LBL'); ?></h4>
         <p><?php echo JText::_('ASTROID_FACEBOOK_COMMENT_ERROR_DESC'); ?></h4>
      </div>
   <?php } ?>
<?php } ?>
<!--- Facebook Comment Section End --->

<!--- Disqus Comment Section Start --->
<?php
if ($article_comments == 'disqus') {
   $disqus_id = $template->params->get('article_comments_disqus_id', '');
   ?>
   <?php if (!empty($disqus_id)) { ?>
      <div class="astroid-commen">
         <div class="card-body"><div id="disqus_thread"></div></div>
      </div>
      <script>
         (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://<?php echo $disqus_id; ?>.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
         })();
      </script>
   <?php } else { ?>
      <div class="alert alert-danger" role="alert">
         <h4 class="alert-heading"><?php echo JText::_('ASTROID_DISQUS_COMMENT_ERROR_LBL'); ?></h4>
         <p><?php echo JText::_('ASTROID_DISQUS_COMMENT_ERROR_DESC'); ?></h4>
      </div>
   <?php } ?>
<?php } ?>
<!--- Disqus Comment Section End --->

<!--- Hyper Comment Section Start --->
<?php
if ($article_comments == 'hyper') {
   $hyper_id = $template->params->get('article_comments_hyper_id', '');
   ?>
   <?php if (!empty($hyper_id)) { ?>
      <div class="astroid-commen">
         <div class="card-body">
            <div id="hypercomments_widget"></div>
            <script type="text/javascript">
               _hcwp = window._hcwp || [];
               _hcwp.push({widget: "Stream", widget_id:<?php echo $hyper_id; ?>});
               (function () {
                  if ("HC_LOAD_INIT" in window)
                     return;
                  HC_LOAD_INIT = true;
                  var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
                  var hcc = document.createElement("script");
                  hcc.type = "text/javascript";
                  hcc.async = true;
                  hcc.src = ("https:" == document.location.protocol ? "https" : "http") + "://w.hypercomments.com/widget/hc/WIDGET_ID/" + lang + "/widget.js";
                  var s = document.getElementsByTagName("script")[0];
                  s.parentNode.insertBefore(hcc, s.nextSibling);
               })();
            </script>
         </div>
      </div>
   <?php } else { ?>
      <div class="alert alert-danger" role="alert">
         <h4 class="alert-heading"><?php echo JText::_('ASTROID_HYPER_COMMENT_ERROR_LBL'); ?></h4>
         <p><?php echo JText::_('ASTROID_HYPER_COMMENT_ERROR_DESC'); ?></h4>
      </div>
   <?php } ?>
<?php } ?>
<!--- Hyper Comment Section End --->

<!--- Intense Comment Section Start --->
<?php
if ($article_comments == 'intense') {
   $intense_id = $template->params->get('article_comments_intense_id', '');
   ?>
   <?php if (!empty($intense_id)) { ?>
      <div class="astroid-commen">
         <div class="card-body">
            <script>
               var idcomments_acct = '<?php echo $intense_id; ?>';
               var idcomments_post_id;
               var idcomments_post_url;
            </script>
            <span id="IDCommentsPostTitle" style="display:none"></span>
            <script type='text/javascript' src='https://www.intensedebate.com/js/genericCommentWrapperV2.js'></script>
         </div>
      </div>
   <?php } else { ?>
      <div class="alert alert-danger" role="alert">
         <h4 class="alert-heading"><?php echo JText::_('ASTROID_INTENSE_COMMENT_ERROR_LBL'); ?></h4>
         <p><?php echo JText::_('ASTROID_INTENSE_COMMENT_ERROR_DESC'); ?></h4>
      </div>
   <?php } ?>

<?php } ?>
<!--- Intense Comment Section End --->