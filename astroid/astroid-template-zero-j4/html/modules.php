<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg. To render a module mod_test in the submenu style, you would use the following include:
 * <jdoc:include type="module" name="test" style="submenu" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */

/*
 * Module chrome for rendering the module in a submenu
 */
function modChrome_no($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
	}
}

function modChrome_card($module, &$params, &$attribs) {
   $moduleTag = $params->get('module_tag', 'div');
   $headerTag = htmlspecialchars($params->get('header_tag', 'h5'), ENT_COMPAT, 'UTF-8');
   $bootstrapSize = (int) $params->get('bootstrap_size', 0);
   $moduleClass = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';

   // Temporarily store header class in variable
   $headerClass = $params->get('header_class');
   $headerClass = $headerClass ? ' class="module-title' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title"';

   $content = trim($module->content);

   if (!empty($content)) :
      ?>
      <<?php echo $moduleTag; ?> class="moduletable <?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>">
      <?php 
      echo '<div class="card">';
      echo '<div class="card-body">';
      ?>
      <?php if ($module->showtitle != 0) : ?>
         <<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
      <?php endif; ?>

      <?php echo $content; ?>
      <?php
      echo '</div>';
      echo '</div>';
      ?>
      </<?php echo $moduleTag; ?>>
      <?php
   endif;
}

function modChrome_border_layout($module, &$params, &$attribs) {
   $moduleTag = $params->get('module_tag', 'div');
   $headerTag = htmlspecialchars($params->get('header_tag', 'h5'), ENT_COMPAT, 'UTF-8');
   $bootstrapSize = (int) $params->get('bootstrap_size', 0);
   $moduleClass = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';

   // Temporarily store header class in variable
   $headerClass = $params->get('header_class');
   $headerClass = $headerClass ? ' class="module-title' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title"';

   $content = trim($module->content);

   if (!empty($content)) :
      ?>
      <<?php echo $moduleTag; ?> class="moduletable <?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>">
      <?php
      echo '<div class="border rounded p-3 mb-4">';
      ?>
      <?php if ($module->showtitle != 0) : ?>
         <<?php echo $headerTag . $headerClass . '>' . $module->title; ?></<?php echo $headerTag; ?>>
      <?php endif; ?>

      <?php echo $content; ?>
      <?php
      echo '</div>';
      ?>
      </<?php echo $moduleTag; ?>>
      <?php
   endif;
}

function modChrome_astroidxhtml($module, &$params, &$attribs) {
   $moduleTag = $params->get('module_tag', 'div');
   $headerTag = htmlspecialchars($params->get('header_tag', 'h5'), ENT_COMPAT, 'UTF-8');
   $bootstrapSize = (int) $params->get('bootstrap_size', 0);
   $moduleClass = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';

   // Temporarily store header class in variable
   $headerClass = $params->get('header_class');
   $headerClass = $headerClass ? ' class="module-title' . htmlspecialchars($headerClass, ENT_COMPAT, 'UTF-8') . '"' : ' class="module-title"';

   $content = trim($module->content);

   if (!empty($content)) :
      ?>
      <<?php echo $moduleTag; ?> class="moduletable <?php echo htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8') . $moduleClass; ?>">
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
         $html .= '<' . $headerTag . ' class="split-title ' . $headerClass . '">';
         $index = 1;
         foreach ($title as $title_text) {
            $html .= '<span class="split-' . $index . '">' . $title_text . '</span>';
            $index++;
         }
         $html .= '</' . $headerTag . '>';
         echo $html;
      }

      echo $module->content;
      echo '</' . $moduleTag . '>';
   }
}
