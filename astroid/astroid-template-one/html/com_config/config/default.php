<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

// Load tooltips behavior
HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('formbehavior.chosen', 'select');

Factory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'config.cancel' || document.formvalidator.isValid(document.getElementById('application-form'))) {
			Joomla.submitform(task, document.getElementById('application-form'));
		}
	}
");
?>

<form action="<?php echo Route::_('index.php?option=com_config'); ?>" id="application-form" method="post" name="adminForm" class="form-validate">

	<div class="row-fluid">
		<!-- Begin Content -->

		<div class="btn-toolbar" role="toolbar" aria-label="<?php echo Text::_('JTOOLBAR'); ?>">
			<div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('config.save.config.apply')">
					<span class="icon-ok"></span> <?php echo Text::_('ASTROID_SAVE') ?>
				</button>
			</div>
			<div class="btn-group">
				<button type="button" class="btn" onclick="Joomla.submitbutton('config.cancel')">
					<span class="icon-cancel"></span> <?php echo Text::_('JCANCEL') ?>
				</button>
			</div>
		</div>

		<hr class="hr-condensed" />

		<div id="page-site" class="tab-pane active">
			<div class="row-fluid">
				<?php echo $this->loadTemplate('site'); ?>
				<?php echo $this->loadTemplate('metadata'); ?>
				<?php echo $this->loadTemplate('seo'); ?>
			</div>
		</div>

		<input type="hidden" name="task" value="" />
		<?php echo HTMLHelper::_('form.token'); ?>

		<!-- End Content -->
	</div>

</form>
