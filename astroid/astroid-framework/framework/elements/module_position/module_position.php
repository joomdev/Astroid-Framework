<?php

defined('_JEXEC') or die;
extract($displayData);
jimport('joomla.application.module.helper');
jimport('astroid.framework.astroid');
$position = $params->get('position', '');
$template = AstroidFramework::getTemplate();
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