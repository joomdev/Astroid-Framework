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

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
$user = Factory::getUser();

Factory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'config.cancel' || document.formvalidator.isValid(document.getElementById('templates-form')))
		{
			Joomla.submitform(task, document.getElementById('templates-form'));
		}
	}
");
?>

<form action="<?php echo Route::_('index.php?option=com_config'); ?>" method="post" name="adminForm" id="templates-form" class="form-validate">

	<div class="row-fluid">
		<!-- Begin Content -->

		<div class="btn-toolbar" role="toolbar" aria-label="<?php echo JText::_('JTOOLBAR'); ?>">
			<div class="btn-group">
				<button type="button" class="btn btn-primary mr-2" onclick="Joomla.submitbutton('config.save.templates.apply')">
					<span class="icon-ok"></span> <?php echo Text::_('ASTROID_SAVE') ?>
				</button>
			</div>
			<div class="btn-group">
				<button type="button" class="btn mr-2" onclick="Joomla.submitbutton('config.cancel')">
					<span class="icon-cancel"></span> <?php echo Text::_('JCANCEL') ?>
				</button>
			</div>
		</div>

		<hr class="hr-condensed" />

		<div id="page-site" class="tab-pane active">
			<div class="row-fluid">
				<?php // Get the menu parameters that are automatically set but may be modified.
				echo $this->loadTemplate('options'); ?>
			</div>
		</div>

		<input type="hidden" name="task" value="" />
		<?php echo HTMLHelper::_('form.token'); ?>

		<!-- End Content -->
	</div>

</form>