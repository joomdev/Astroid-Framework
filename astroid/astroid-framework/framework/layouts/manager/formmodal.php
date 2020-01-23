<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_BASE') or die;
extract($displayData);
?>
<div class="ezlb-pop" id="element-settings">
    <div class="ezlb-pop-overlay"></div>
    <div class="ezlb-pop-body">
        <div class="astroid-ring-loading"></div>
        <div id="element-settings-form" ng-bind-html="elementFormContent"></div>
        <div class="ezlb-pop-footer text-right">
            <button type="button" id="element-settings-save" class="btn btn-lg btn-wide btn-round btn-astroid"><?php echo JText::_('ASTROID_SAVE'); ?></button>
        </div>
    </div>
</div>