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

class astroidInstallerScript {

   /**
    * 
    * Function to run before installing the component	 
    */
   public function preflight($type, $parent) {
      $plugin_dir = JPATH_LIBRARIES . '/' . 'astroid' . '/' . 'plugins' . '/';
      $plugins = array_filter(glob($plugin_dir . '*'), 'is_dir');
      foreach ($plugins as $plugin) {
         if ($type == "uninstall") {
            $this->uninstallPlugin($plugin, $plugin_dir);
         }
      }
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
      $plugin_dir = JPATH_LIBRARIES . '/' . 'astroid' . '/' . 'plugins' . '/';
      $plugins = array_filter(glob($plugin_dir . '*'), 'is_dir');
      foreach ($plugins as $plugin) {
         $this->uninstallPlugin($plugin, $plugin_dir);
      }
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
      $plugin_dir = JPATH_LIBRARIES . '/' . 'astroid' . '/' . 'plugins' . '/';
      $plugins = array_filter(glob($plugin_dir . '*'), 'is_dir');
      foreach ($plugins as $plugin) {
         if ($type == "install" || $type == "update") {
            $this->installPlugin($plugin, $plugin_dir);
         }
      }
      $this->astroidTemplateTableMigration();
   }

   public function astroidTemplateTableMigration() {
      if (!$this->isTableExists()) {
         $this->createTable();
      }
      $ast_templates = $this->getAstroidTemplates();
      foreach ($ast_templates as $ast_template) {
         $this->checkAndUpgrade($ast_template);
      }
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
      
      $object = new stdClass();
      $object->id = $template->id;
      $object->params = \json_encode(["astroid_template_id" => $db->insertid()]);
      $db->updateObject('#__template_styles', $object, 'id');
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

   public function installPlugin($plugin, $plugin_dir) {
      $db = JFactory::getDbo();
      $plugin_name = str_replace($plugin_dir, '', $plugin);

      $installer = new JInstaller;
      $installer->install($plugin);

      $query = $db->getQuery(true);
      $query->update('#__extensions');
      $query->set($db->quoteName('enabled') . ' = 1');
      $query->where($db->quoteName('element') . ' = ' . $db->quote($plugin_name));
      $query->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));
      $db->setQuery($query);
      $db->execute();
      return true;
   }

   public function uninstallPlugin($plugin, $plugin_dir) {
      $db = JFactory::getDbo();
      $plugin_name = str_replace($plugin_dir, '', $plugin);
      $query = $db->getQuery(true);
      $query->update('#__extensions');
      $query->set($db->quoteName('enabled') . ' = 0');
      $query->where($db->quoteName('element') . ' = ' . $db->quote($plugin_name));
      $query->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));
      $db->setQuery($query);
      $db->execute();
      return true;
   }

}
