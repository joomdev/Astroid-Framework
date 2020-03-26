<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_BASE') or die;

?>
	<dd class="modified">
		<i class="far fa-calendar-alt"></i>
		<time datetime="<?php echo JHtml::_('date', $displayData['item']->modified, 'c'); ?>" itemprop="dateModified">
			<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $displayData['item']->modified, JText::_('DATE_FORMAT_LC3'))); ?>
		</time>
	</dd>