<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_BASE') or die;

?>
	<dd class="parent-category-name">
		<?php $title = $this->escape($displayData['item']->parent_title); ?>
		<?php if ($displayData['params']->get('link_parent_category') && !empty($displayData['item']->parent_slug)) : ?>
		<?php $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->parent_slug)).'" itemprop="genre">'.$title.'</a>'; ?>
		<i class="far fa-folder-open"></i>
		<?php echo $url; ?>
		<?php else : ?>
		<i class="far fa-folder-open"></i>
		<?php echo '<span itemprop="genre">'.$title.'</span>'; ?>
		<?php endif; ?>
	</dd>