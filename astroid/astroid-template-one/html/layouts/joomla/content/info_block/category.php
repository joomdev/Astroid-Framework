<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('JPATH_BASE') or die;

?>
	<dd class="category-name">
		<?php $title = $this->escape($displayData['item']->category_title); ?>
		<?php if ($displayData['params']->get('link_category') && $displayData['item']->catslug) : ?>
		<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
		<i class="far fa-folder"></i>
		<?php echo $url; ?>
		<?php else : ?>
		<i class="far fa-folder"></i>
		<?php echo '<span itemprop="genre">' . $title . '</span>'; ?>
		<?php endif; ?>
	</dd>