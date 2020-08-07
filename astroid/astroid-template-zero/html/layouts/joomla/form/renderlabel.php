<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('JPATH_BASE') or die;

extract($displayData);

/**
 * Layout variables
 * ---------------------
 * 	$text         : (string)  The label text
 * 	$description  : (string)  An optional description to use in a tooltip
 * 	$for          : (string)  The id of the input this label is for
 * 	$required     : (boolean) True if a required field
 * 	$classes      : (array)   A list of classes
 * 	$position     : (string)  The tooltip position. Bottom for alias
 */
$classes = array_filter((array) $classes);

$id = $for.'-lbl';
$title = '';

if (!empty($description)) {
   if ($text && $text !== $description) {
      $title = ' title="'.htmlspecialchars(trim($text, ':')).'"'
             .' data-content="'.htmlspecialchars($description).'"';

      if (!$position && JFactory::getLanguage()->isRtl()) {
         $position = ' data-placement="left" ';
      }
   } else {
      $title = ' title="'.JHtml::_('tooltipText', trim($text, ':'), $description, 0).'"';
   }
}

if ($required) {
   $classes[] = 'required';
}
?>
<label data-toggle="popover" id="<?php echo $id; ?>" for="<?php echo $for; ?>"<?php if (!empty($classes)) echo ' class="'.implode(' ', $classes).'"'; ?><?php echo $title; ?><?php echo $position; ?>>
   <?php echo $text; ?><?php if ($required) : ?><span class="star">&#160;*</span><?php endif; ?>
</label>
