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
jimport('astroid.framework.menu');
$errorContent = $template->params->get('error_404_content', '');
$errorButton = $template->params->get('error_call_to_action', '');
?>
<html>
   <head>
      <?php
      // Astroid Assets
      $template->loadTemplateCSS('custom', true);
      ?>
   </head>
   <body>
      <section>
         <div class="container">
            <div class="row">
               <div class="col-12 text-center">
                  <?php echo $errorContent; ?>
                  <a class="btn btn-secondary" href="<?php echo JURI::root(); ?>" role="button"><?php echo $errorButton; ?></a>
               </div>
            </div>
         </div>
      </section>
   </body>
</html>