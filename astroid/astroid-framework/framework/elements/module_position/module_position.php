<?php

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