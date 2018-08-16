<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
/*
 * card (output module content in a bootstrap 4 card)
 */

function modChrome_card($module, &$params, &$attribs) {
   $moduleTag = $params->get('module_tag', 'div');
   $headerTag = htmlspecialchars($params->get('header_tag', 'h5'), ENT_COMPAT, 'UTF-8');
   $bootstrapSize = (int) $params->get('bootstrap_size', 0);
   $moduleClass = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';

   // Temporarily store header class in variable
   $headerClass = $params->get('header_class');
   $headerClass = $headerClass ? ' class="module-title pb-2 ' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title pb-2"';

   $content = trim($module->content);

   if (!empty($content)) :
      echo '<div class="card">';
      echo '<div class="card-body">';
      ?>
      <<?php echo $moduleTag; ?> class="module<?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>">
      <?php if ($module->showtitle != 0) : ?>
         <<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
      <?php endif; ?>

      <?php echo $content; ?>
      </<?php echo $moduleTag; ?>>
      <?php
      echo '</div>';
      echo '</div>';
   endif;
}

function modChrome_border_layout($module, &$params, &$attribs) {
   $moduleTag = $params->get('module_tag', 'div');
   $headerTag = htmlspecialchars($params->get('header_tag', 'h5'), ENT_COMPAT, 'UTF-8');
   $bootstrapSize = (int) $params->get('bootstrap_size', 0);
   $moduleClass = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';

   // Temporarily store header class in variable
   $headerClass = $params->get('header_class');
   $headerClass = $headerClass ? ' class="module-title pb-2 ' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title pb-2"';

   $content = trim($module->content);

   if (!empty($content)) :
      echo '<div class="border rounded p-3 mb-4">';
      ?>
      <<?php echo $moduleTag; ?> class="module<?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>">
      <?php if ($module->showtitle != 0) : ?>
         <<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
      <?php endif; ?>

      <?php echo $content; ?>
      </<?php echo $moduleTag; ?>>
      <?php
      echo '</div>';
   endif;
}

function modChrome_astroidxhtml($module, &$params, &$attribs) {
   $moduleTag = $params->get('module_tag', 'div');
   $headerTag = htmlspecialchars($params->get('header_tag', 'h5'), ENT_COMPAT, 'UTF-8');
   $bootstrapSize = (int) $params->get('bootstrap_size', 0);
   $moduleClass = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';

   // Temporarily store header class in variable
   $headerClass = $params->get('header_class');
   $headerClass = $headerClass ? ' class="module-title pb-2 ' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title pb-2"';

   $content = trim($module->content);

   if (!empty($content)) :
      ?>
      <<?php echo $moduleTag; ?> class="module<?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>">
      <?php if ($module->showtitle != 0) : ?>
         <<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
      <?php endif; ?>
      <?php echo $content; ?>
      </<?php echo $moduleTag; ?>>
      <?php
   endif;
}

function modChrome_split_title($module, &$params, &$attribs) {
   $moduleTag = htmlspecialchars($params->get('module_tag', 'div'), ENT_QUOTES, 'UTF-8');
   $bootstrapSize = (int) $params->get('bootstrap_size', 0);
   $moduleClass = $bootstrapSize !== 0 ? ' span' . $bootstrapSize : '';
   $headerTag = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
   $headerClass = htmlspecialchars($params->get('header_class', 'page-header'), ENT_COMPAT, 'UTF-8');

   if ($module->content) {
      echo '<' . $moduleTag . ' class="split-title-module' . htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass . '">';

      if ($module->showtitle) {
         $title = explode('|', $module->title);
         $html = '';
         $html .= '<' . $headerTag . ' class="split-title' . $headerClass . '">';
         $index = 1;
         foreach ($title as $title_text) {
            $html .= '<span class="split-' . $index . '">' . $title_text . '</span>';
            $index++;
         }
         $html .= '</' . $headerTag . '>';
      }

      echo $module->content;
      echo '</' . $moduleTag . '>';
   }
}
