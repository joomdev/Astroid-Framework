<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;
?>
   <div class="latestnews<?php echo $moduleclass_sfx; ?>">
      <ul class="latestnews list-group list-group-flush">
         <?php foreach ($list as $item) : $image = json_decode($item->images); ?>
         <li class="list-group-item pb-2 px-0">
            <h6>
               <a class="article-title" href="<?php echo $item->link; ?>" class="">
                  <?php echo $item->title; ?>
               </a>
            </h6>
         </li>
         <?php endforeach; ?>
      </ul>
   </div>