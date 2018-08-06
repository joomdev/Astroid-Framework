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
    * Function to run before installing the component	 
    */
   public function preflight($type, $parent) {
      
   }

   /**
    *
    * Function to run when installing the component
    * @return void
    */
   public function install($parent) {
      
   }

   /**
    *
    * Function to run when installing the component
    * @return void
    */
   public function uninstall($parent) {
      
   }

   /**
    * 
    * Function to run when updating the component
    * @return void
    */
   function update($parent) {
      
   }

   /**
    * 
    * Function to update database schema
    */
   public function updateDatabaseSchema($update) {
      
   }

   /**
    * 
    * Function to run after installing the component	 
    */
   public function postflight($type, $parent) {
      $template = $parent->getElement();
      if ($type == 'install') {

         $db = JFactory::getDbo();
         $query = "ALTER TABLE `#__template_styles` CHANGE `params` `params` LONGTEXT NOT NULL;";
         $db->setQuery($query);
         $db->execute();

         if (file_exists(JPATH_SITE . '/templates/' . $template . '/astroid/default.json')) {
            $params = file_get_contents(JPATH_SITE . '/templates/' . $template . '/astroid/default.json');
            $db = JFactory::getDbo();
            $object = new stdClass();
            $object->template = $template;

            $params = str_replace('TEMPLATE_NAME', $template, $params);
            $object->params = $params;
            $db->updateObject('#__template_styles', $object, 'template');
         } else {
            //JFactory::getApplication()->enqueueMessage(JText::_('Astroid default params not set.'), 'warning');
         }
      }

      if ($type == "install" || $type == "update") {
         $this->uploadDefaultImages($template);
      }
   }

   public function uploadDefaultImages($template) {
      $source = JPATH_SITE . '/templates/' . $template . '/images/default';
      $destination = JPATH_SITE . '/images/' . $template;
      $files = JFolder::files($source);
      JFolder::copy($source, $destination, '', true);
   }

   public function installPlugin($plugin, $plugin_dir) {
      
   }

   public function uninstallPlugin($plugin, $plugin_dir) {
      
   }

}
