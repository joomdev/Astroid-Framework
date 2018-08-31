<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
// no direct access
defined('_JEXEC') or die;
jimport('joomla.filesystem.file');

class astroid_template_zeroInstallerScript {

   /**
    * 
    * Function to run after installing the component	 
    */
   public function postflight($type, $parent) {
      // $parent->manifest->astroid->version
      $template = $parent->getElement();
      if ($type == "install") {
         $template = $this->getTemplateByName($template);
         $this->installDefaultJSON($template);
         $this->uploadDefaultImages($template);
      }

      $lib = JPATH_SITE . '/libraries/astroid/framework/template.php';
      if (file_exists($lib)) {
         include_once JPATH_SITE . '/libraries/astroid/framework/constants.php';
         $astroidVersion = AstroidFrameworkConstants::$astroid_version;
         $version = @$parent->manifest->astroid->version;
         $minimumVersion = !empty($version) ? $version : $astroidVersion;

         if ($this->isAstroidOldVersion($minimumVersion, $astroidVersion)) {
            JFactory::getApplication()->enqueueMessage(JText::_('Your <strong>currently installed template</strong> is requires minimum version <strong>' . $minimumVersion . '</strong> of Astroid Framework<strong>. Please install <a target="_blank" href="https://github.com/joomdev/Astroid-Framework/releases/' . ($minimumVersion ? 'tags/v' . $version : 'latest') . '">Astroid Framework' . ($minimumVersion ? ' v' . $minimumVersion : ' Latest Release') . '</a></strong>'), 'error');
         }
      } else {
         $version = @$parent->manifest->astroid->version;
         $version = !empty($version) ? $version : '';

         JFactory::getApplication()->enqueueMessage(JText::_('In order to use <strong>currently installed template</strong> is requires <strong><a target="_blank" href="https://github.com/joomdev/Astroid-Framework/releases/' . ($version ? 'tags/' . $version : 'latest') . '">Astroid Framework' . ($version ? ' ' . $version : '') . '</a></strong>'), 'error');
      }
   }

   public function isAstroidOldVersion($minimum_version, $installer_version) {
      $minimum_version = (int) str_replace('.', '', $minimum_version);
      $installer_version = (int) str_replace('.', '', $installer_version);
      return $minimum_version > $installer_version;
   }

   public function installDefaultJSON($template) {
      if (file_exists(JPATH_SITE . '/templates/' . $template->template . '/astroid/default.json')) {
         $params = file_get_contents(JPATH_SITE . '/templates/' . $template->template . '/astroid/default.json');
         if (!file_exists(JPATH_SITE . "/templates/{$template->template}/params")) {
            mkdir(JPATH_SITE . "/templates/{$template->template}/params");
         }
         file_put_contents(JPATH_SITE . "/templates/{$template->template}/params" . '/' . $template->id . '.json', $params);
      }
      $db = JFactory::getDbo();
      $object = new stdClass();
      $object->id = $template->id;
      $object->params = \json_encode(["astroid" => $template->id]);
      $db->updateObject('#__template_styles', $object, 'id');
   }

   public function getTemplateByName($template) {
      $db = JFactory::getDbo();
      $query = "SELECT * FROM `#__template_styles` WHERE `template`='" . $template . "'";
      $db->setQuery($query);
      $template = $db->loadObject();
      return $template;
   }

   public function uploadDefaultImages($template) {
      $source = JPATH_SITE . '/templates/' . $template->template . '/images/default';
      $destination = JPATH_SITE . '/images/' . $template->template;
      $files = JFolder::files($source);
      JFolder::copy($source, $destination, '', true);
   }

}
