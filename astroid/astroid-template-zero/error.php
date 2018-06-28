<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;

/** @var JDocumentError $this */
$showRightColumn = 0;
$showleft = 0;
$showbottom = 0;

// Get params
$app = JFactory::getApplication();
$params = $app->getTemplate(true)->params;
$logo = $params->get('logo');
$color = $params->get('templatecolor');
$navposition = $params->get('navposition');
$lib = JPATH_SITE . '/libraries/astroid/framework/template.php';
if (file_exists($lib)) {
   jimport('astroid.framework.template');
} else {
   die('Please install and activate <a href="https://github.com/joomdev/Astroid-Framework/releases" target="_blank">Astroid Framework</a> in order to use this template.');
}
$template = new AstroidFrameworkTemplate($app->getTemplate(true));
$template->loadLayout('error');
?>