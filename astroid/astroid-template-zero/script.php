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
      if ($type == "install" && !$this->isTableExists()) {
         $this->createTable();
         $template = $this->getTemplateByName($template);
         $this->installDefaultJSON($template);
         $this->uploadDefaultImages($template);
      } else if ($type == "install" && $this->isTableExists()) {
         $template = $this->getTemplateByName($template);
         $this->installDefaultJSON($template);
         $this->uploadDefaultImages($template);
         $ast_templates = $this->getAstroidTemplates();
         foreach ($ast_templates as $ast_template) {
            $this->checkAndUpgrade($ast_template);
         }
      } else if ($type == "update") {
         if (!$this->isTableExists()) {
            $this->createTable();
         }
         $ast_templates = $this->getAstroidTemplates();
         foreach ($ast_templates as $ast_template) {
            $this->checkAndUpgrade($ast_template);
         }
      }
   }

   public function installDefaultJSON($template) {
      if (file_exists(JPATH_SITE . '/templates/' . $template->template . '/astroid/default.json')) {
         $params = file_get_contents(JPATH_SITE . '/templates/' . $template->template . '/astroid/default.json');
         $db = JFactory::getDbo();
         $object = new stdClass();
         $object->id = null;
         $object->template_id = $template->id;
         $object->title = $template->title;
         $params = str_replace('TEMPLATE_NAME', $template->template, $params);
         $object->params = $params;
         $object->created = time();
         $object->updated = time();
         $db->insertObject('#__astroid_templates', $object);

         $object = new stdClass();
         $object->id = $template->id;
         $object->params = \json_encode(["astroid_template_id" => $db->insertid()]);
         $db->updateObject('#__template_styles', $object, 'id');
      }
   }

   public function moveParamsJSON($template) {
      $db = JFactory::getDbo();
      $object = new stdClass();
      $object->id = null;
      $object->template_id = $template->id;
      $object->title = $template->title;
      $object->params = $template->params;
      $object->created = time();
      $object->updated = time();
      $db->insertObject('#__astroid_templates', $object);
      $ast_id = $db->insertid();

      $object = new stdClass();
      $object->id = $template->id;
      $object->params = \json_encode(["astroid_template_id" => $ast_id]);
      $db->updateObject('#__template_styles', $object, 'id');
   }

   public function checkAndUpgrade($template) {
      $db = JFactory::getDbo();
      $query = "SELECT * FROM `#__astroid_templates` WHERE `template_id`='" . $template->id . "'";
      $db->setQuery($query);
      $result = $db->loadObject();
      if (empty($result)) {
         $this->moveParamsJSON($template);
      } else {
         $object = new stdClass();
         $object->id = $template->id;
         $object->params = \json_encode(["astroid_template_id" => $result->id]);
         $db->updateObject('#__template_styles', $object, 'id');
      }
   }

   public function getTemplates($template) {
      $db = JFactory::getDbo();
      $query = "SELECT * FROM `#__template_styles` WHERE `template`='" . $template . "'";
      $db->setQuery($query);
      $templates = $db->loadObjectList();
      return $templates;
   }

   public function getTemplateByName($template) {
      $db = JFactory::getDbo();
      $query = "SELECT * FROM `#__template_styles` WHERE `template`='" . $template . "'";
      $db->setQuery($query);
      $template = $db->loadObject();
      return $template;
   }

   public function getAstroidTemplates() {
      $db = JFactory::getDbo();
      $query = "SELECT * FROM `#__template_styles`";
      $db->setQuery($query);
      $templates = $db->loadObjectList();
      $return = array();
      foreach ($templates as $template) {
         if ($this->isAstroidTemplate($template->template)) {
            $return[] = $template;
         }
      }
      return $return;
   }

   public function isAstroidTemplate($name) {
      return file_exists(JPATH_SITE . "/templates/{$name}/frontend");
   }

   public function isTableExists() {
      $tables = JFactory::getDbo()->getTableList();
      $table = JFactory::getDbo()->getPrefix() . 'astroid_templates';
      return in_array($table, $tables);
   }

   public function createTable() {
      $db = JFactory::getDbo();
      $query = "CREATE TABLE `#__astroid_templates` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `template_id` int(11) NOT NULL,
            `title` varchar(255) NOT NULL,
            `params` longtext NOT NULL,
            `created` bigint(11) NOT NULL,
            `updated` bigint(11) NOT NULL,
            PRIMARY KEY (`id`)
          );";
      $db->setQuery($query);
      $db->execute();
   }

   public function uploadDefaultImages($template) {
      $source = JPATH_SITE . '/templates/' . $template->template . '/images/default';
      $destination = JPATH_SITE . '/images/' . $template->template;
      $files = JFolder::files($source);
      JFolder::copy($source, $destination, '', true);
   }

   public function installPlugin($plugin, $plugin_dir) {
      
   }

   public function uninstallPlugin($plugin, $plugin_dir) {
      
   }

}
