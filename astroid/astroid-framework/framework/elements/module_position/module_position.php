<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * 	DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 *  You can easily override all files under /frontend/ folder.
 *	Just copy the file to ROOT/templates/YOURTEMPLATE/html/frontend/ folder to create and override
 */
// No direct access.
defined('_JEXEC') or die;
extract($displayData);
jimport('joomla.application.module.helper');
$position = $params->get('position', '');

$beforeContent = $template->getAstroidContent($position, 'before');
if (!empty($beforeContent)) {
   echo $beforeContent;
}
if (!empty(JModuleHelper::getModules($position))) {
   echo $template->modulePosition($position, 'astroidxhtml');
}
$afterContent = $template->getAstroidContent($position, 'after');
if (!empty($afterContent)) {
   echo $afterContent;
}
?>