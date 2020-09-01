<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('JPATH_BASE') or die;

JHtml::_('bootstrap.framework');

$canEdit = $displayData['params']->get('access-edit');
$articleId = $displayData['item']->id;

?>

<div class="icons">
	<?php if (empty($displayData['print'])) : ?>

		<?php if ($canEdit || $displayData['params']->get('show_print_icon') || $displayData['params']->get('show_email_icon')) : ?>
			<div class="btn-group content-edit-dropdown float-right">
				<button class="btn dropdown-toggle py-1 px-2" type="button" id="dropdownMenuButton-<?php echo $articleId; ?>" aria-label="<?php echo JText::_('JUSER_TOOLS'); ?>"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="fas fa-cog fa-sm" aria-hidden="true"></span>
					<span class="caret" aria-hidden="true"></span>
				</button>
				<?php // Note the actions class is deprecated. Use dropdown-menu instead. ?>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton-<?php echo $articleId; ?>">
					<?php if ($displayData['params']->get('show_print_icon')) : ?>
						<li class="dropdown-item print-icon"> <?php echo JHtml::_('icon.print_popup', $displayData['item'], $displayData['params']); ?> </li>
					<?php endif; ?>
					<?php if ($displayData['params']->get('show_email_icon')) : ?>
						<li class="dropdown-item email-icon"> <?php echo JHtml::_('icon.email', $displayData['item'], $displayData['params']); ?> </li>
					<?php endif; ?>
					<?php if ($canEdit) : ?>
						<li class="dropdown-item edit-icon"> <?php echo JHtml::_('icon.edit', $displayData['item'], $displayData['params']); ?> </li>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

	<?php else : ?>

		<div class="float-right">
			<?php echo JHtml::_('icon.print_screen', $displayData['item'], $displayData['params']); ?>
		</div>

	<?php endif; ?>
</div>
