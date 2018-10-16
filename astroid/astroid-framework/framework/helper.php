<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
jimport('astroid.framework.constants');
jimport('astroid.framework.template');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.element');

use Leafo\ScssPhp\Compiler;

class AstroidFrameworkHelper {

   public static function getAstroidElements() {

      $elements_dir = JPATH_LIBRARIES . '/' . 'astroid' . '/' . 'framework' . '/' . 'elements' . '/';
      $template_elements_dir = JPATH_SITE . '/' . 'templates' . '/' . ASTROID_TEMPLATE_NAME . '/' . 'astroid' . '/' . 'elements' . '/';
      $elements = array_filter(glob($elements_dir . '*'), 'is_dir');
      $template_elements = array_filter(glob($template_elements_dir . '*'), 'is_dir');
      $elements = array_merge($elements, $template_elements);
      $return = array();

      $defaultxml = JPATH_LIBRARIES . '/' . 'astroid' . '/' . 'framework' . '/' . 'elements' . '/' . 'default.xml';

      $xml = simplexml_load_file($defaultxml);
      $default = self::getElementConfig($xml, "");

      foreach ($elements as $element_dir) {
         $xmlfile = $element_dir . '/' . (str_replace($template_elements_dir, '', str_replace($elements_dir, '', $element_dir))) . '.xml';
         if (file_exists($xmlfile)) {
            $xml = simplexml_load_file($xmlfile);
            $type = str_replace($template_elements_dir, '', str_replace($elements_dir, '', $element_dir));
            $element = self::getElementConfig($xml, $type, $default['icon'], $default['description'], $default['color'], $default['multiple'], $default['options']);
            $return[] = $element;
         }
      }
      //exit;
      return $return;
   }

   public static function getAllAstroidElements() {

      // Template Directories
      $elements_dir = JPATH_LIBRARIES . '/' . 'astroid' . '/' . 'framework' . '/' . 'elements' . '/';
      $template_elements_dir = JPATH_SITE . '/' . 'templates' . '/' . ASTROID_TEMPLATE_NAME . '/' . 'astroid' . '/' . 'elements' . '/';

      // Getting Elements from Template Directories
      $elements = array_filter(glob($elements_dir . '*'), 'is_dir');
      $template_elements = array_filter(glob($template_elements_dir . '*'), 'is_dir');

      // Merging Elements
      $elements = array_merge($elements, $template_elements);

      $return = array();

      foreach ($elements as $element_dir) {
         $xmlfile = $element_dir . '/' . (str_replace($template_elements_dir, '', str_replace($elements_dir, '', $element_dir))) . '.xml';
         if (file_exists($xmlfile)) {
            $type = str_replace($template_elements_dir, '', str_replace($elements_dir, '', $element_dir));

            $template = new \stdClass();
            $template->template = ASTROID_TEMPLATE_NAME;
            $template->params = new \stdClass();
            $template = new AstroidFrameworkTemplate($template);
            $element = new AstroidElement($type, [], $template);
            $return[] = $element;
         }
      }
      //exit;
      return $return;
   }

   public static function getElementClassName($type) {
      $type = str_replace('-', ' ', $type);
      $type = str_replace('_', ' ', $type);
      $type = ucwords(strtolower($type));
      return 'AstroidElement' . str_replace(' ', '', $type);
   }

   public static function getTemplatePostions() {
      $db = JFactory::getDbo();
      $query = "SELECT * FROM `#__modules` GROUP BY `position`";

      $query = $db->getQuery(true)
              ->select('DISTINCT(position)')
              ->from('#__modules')
              ->where($db->quoteName('client_id') . ' = ' . 0)
              ->order('position');

      $db->setQuery($query);
      $results = $db->loadObjectList();
      $return = array();
      $return[] = array('name' => "None", 'value' => "");


      $exists = [];
      for ($i = 1; $i <= 10; $i++) {
         $return[] = array('name' => "position-" . $i, 'value' => "position-" . $i);
         $exists[] = "position-" . $i;
      }

      foreach ($results as $result) {
         if (empty($result->position) || in_array($result->position, $exists)) {
            continue;
         }
         $return[] = array('name' => $result->position, 'value' => $result->position);
      }

      return $return;
   }

   public static function getAnimationStyles() {
      $groups = AstroidFrameworkConstants::$animations;
      $return = array();
      foreach ($groups as $group => $animations) {
         foreach ($animations as $key => $value) {
            $return[] = array('name' => $value, 'value' => $key, 'group' => $group);
         }
      }
      return $return;
   }

   public static function getTemplateById($id = null) {
      $db = JFactory::getDbo();
      $query = "SELECT * FROM `#__template_styles` WHERE `id`='$id'";
      $db->setQuery($query);
      $result = $db->loadObject();
      if (!empty($result)) {
         $template = new AstroidFrameworkTemplate($result);
         return $template;
      } else {
         return null;
      }
   }

   public static function compileSass($sass_path, $css_path, $sass, $css, $variables = array()) {
      try {
         require_once JPATH_LIBRARIES . '/' . 'astroid' . '/' . 'framework' . '/' . 'library' . '/' . 'scssphp' . '/' . 'scss.inc.php';
         $scss = new Compiler();
         $scss->setImportPaths($sass_path);
         $scss->setFormatter('Leafo\ScssPhp\Formatter\Compressed');
         if (!empty($variables)) {
            $scss->setVariables($variables);
         }
         $content = $scss->compile('@import "' . $sass . '";');
         file_put_contents($css_path . '/' . $css, $content);
      } catch (\Exception $e) {
         print_r($e);
         exit;
         echo '<h1>' . $e->getMessage() . '</h1>';
         echo '<h3>' . $e->getFile() . ' in ' . $e->getLine() . '</h3>';
         exit;
      }
   }

   public static function AstroidMedia($action) {
      $data = null;
      switch ($action) {
         case "library":
            $input = JFactory::getApplication()->input;
            $folder = $input->get('folder', '', 'RAW');
            $data = self::getMediaLibrary();
            $data['current_folder'] = 'images' . (empty($folder) ? '' : '/' . $folder);
            break;
         case "upload":
            $data = self::uploadMedia();
            break;
         case "create-folder":
            $data = self::createFolder();
            break;
         default:
            throw new \Exception("Bad Request", 400);
            break;
      }
      return $data;
   }

   public static function getMediaLibrary() {
      $input = JFactory::getApplication()->input;
      $user = JFactory::getUser();
      $asset = $input->get('asset');
      $author = $input->get('author');

      if (!$user->authorise('core.manage', 'com_media') && (!$asset || (!$user->authorise('core.edit', $asset) && !$user->authorise('core.create', $asset) && count($user->getAuthorisedCategories($asset, 'core.create')) == 0) && !($user->id == $author && $user->authorise('core.edit.own', $asset)))) {
         throw new JAccessExceptionNotallowed(JText::_('JERROR_ALERTNOAUTHOR'), 403);
      }

      $params = JComponentHelper::getParams('com_media');

      JLoader::register('MediaHelper', JPATH_ADMINISTRATOR . '/components/com_media/helpers/media.php');


      // Set the path definitions
      $popup_upload = $input->get('pop_up', null);
      $path = 'file_path';
      $view = $input->get('view');

      if (substr(strtolower($view), 0, 6) == 'images' || $popup_upload == 1) {
         $path = 'image_path';
      }

      define('COM_MEDIA_BASE', JPATH_ROOT . '/' . $params->get($path, 'images'));
      define('COM_MEDIA_BASEURL', JUri::root() . $params->get($path, 'images'));

      $mediamodelPath = JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_media' . DIRECTORY_SEPARATOR . 'models';
      JModelLegacy::addIncludePath($mediamodelPath);
      $model = JModelLegacy::getInstance('List', 'MediaModel');
      return $model->getList();
   }

   public static function uploadMedia() {
      $input = JFactory::getApplication()->input;
      $dir = $input->get('dir', '', 'RAW');
      $media = $input->get('media', '', 'images');

      if (empty($dir)) {
         $dir = JPATH_SITE . '/' . 'images' . '/' . date('Y');
         if (!file_exists($dir)) {
            mkdir($dir, 0777);
         }
         if (!file_exists($dir . '/' . date('m'))) {
            mkdir($dir . '/' . date('m'), 0777);
         }
         if (!file_exists($dir . '/' . date('m') . '/' . date('d'))) {
            mkdir($dir . '/' . date('m') . '/' . date('d'), 0777);
         }

         $uploadDir = $dir . '/' . date('m') . '/' . date('d');
         $uploadFolder = date('Y') . '/' . date('m') . '/' . date('d');
      } else {
         $uploadDir = JPATH_SITE . '/' . $dir;
         if ($dir == 'images') {
            $uploadFolder = '';
         } else {
            $uploadFolder = preg_replace('/images\//', '', $dir, 1);
         }
      }


      $fieldName = 'file';

      $fileError = $_FILES[$fieldName]['error'];
      if ($fileError > 0) {
         switch ($fileError) {
            case 1:
               throw new \Exception(JText::_('FILE TO LARGE THAN PHP INI ALLOWS'));
               return;

            case 2:
               throw new \Exception(JText::_('FILE TO LARGE THAN HTML FORM ALLOWS'));
               return;

            case 3:
               throw new \Exception(JText::_('ERROR PARTIAL UPLOAD'));
               return;

            case 4:
               throw new \Exception(JText::_('ERROR NO FILE'));
               return;
         }
      }


      $pathinfo = pathinfo($_FILES[$fieldName]['name']);
      $uploadedFileExtension = $pathinfo['extension'];
      $uploadedFileExtension = strtolower($uploadedFileExtension);
      if ($media == 'images') {
         $validFileExts = explode(',', 'jpeg,jpg,png,gif');
      } else {
         $validFileExts = explode(',', 'mp4,mpeg,mpg');
      }
      if (!in_array($uploadedFileExtension, $validFileExts)) {
         throw new \Exception(JText::_('INVALID EXTENSION'));
      }

      $fileTemp = $_FILES[$fieldName]['tmp_name'];

      if ($media == 'images') {
         $imageinfo = getimagesize($fileTemp);
         $okMIMETypes = 'image/jpeg,image/pjpeg,image/png,image/x-png,image/gif';
         $validFileTypes = explode(",", $okMIMETypes);

         if (!is_int($imageinfo[0]) || !is_int($imageinfo[1]) || !in_array($imageinfo['mime'], $validFileTypes)) {
            throw new \Exception(JText::_('INVALID FILETYPE'));
         }
      }

      $fileName = preg_replace("/[^A-Za-z0-9]/i", "-", $pathinfo['filename']) . '.' . $pathinfo['extension'];

      $uploadPath = $uploadDir . '/' . $fileName;

      if (file_exists($uploadPath)) {
         $fileName = preg_replace("/[^A-Za-z0-9]/i", "-", $pathinfo['filename']) . '-' . time() . '.' . $pathinfo['extension'];

         $uploadPath = $uploadDir . '/' . $fileName;
      }

      if (!JFile::upload($fileTemp, $uploadPath)) {
         throw new \Exception(JText::_('ERROR MOVING FILE'));
      } else {
         return ['status' => 'success', 'filepath' => $uploadPath, 'filename' => $fileName, 'uploadpath' => $uploadDir, 'folder' => $uploadFolder];
      }
   }

   public static function createFolder() {
      $input = JFactory::getApplication()->input;
      $directory = $input->get('dir', '', 'RAW');
      $name = $input->get('name', '', 'RAW');

      $dir = JPATH_SITE . '/' . $directory . '/' . $name;
      if (file_exists($dir)) {
         throw new \Exception("Folder `$name` already exists", 0);
      }
      mkdir($dir, 0777);

      $folder = $name;
      if ($directory != 'images') {
         $directory = preg_replace('/images\//', '', $directory, 1);
         $folder = $directory . '/' . $name;
      }

      return ['message' => "Folder `$name` successfully created.", 'folder' => $folder];
   }

   public static function getJSONData($name) {
      $fontsJSON = file_get_contents(JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'json' . '/' . $name . '.json');
      return \json_decode($fontsJSON, true);
   }

   public static function getGoogleFonts() {
      $fonts = self::getJSONData('webfonts');
      return $fonts['items'];
   }

   public static function getFAIcons($html = false) {
      if ($html) {
         $icons = self::getJSONData('fa-icons');
         $array = [];
         $array[] = ['value' => '', 'name' => 'None'];
         foreach ($icons as $icon) {
            $array[] = ['value' => $icon['value'], 'name' => '<i class="' . $icon['value'] . '"></i> ' . $icon['name']];
         }
         $icons = $array;
      } else {
         $icons = self::getJSONData('fa-icons');
      }
      return $icons;
   }

   public static function clearCache($template = '') {
      $template_dir = JPATH_SITE . '/' . 'templates' . '/' . $template . '/' . 'css';
      $version = new \JVersion;
      $version->refreshMediaVersion();
      if (!file_exists($template_dir)) {
         throw new \Exception("Template not found.", 404);
      }
      $styles = preg_grep('~^style-.*\.(css)$~', scandir($template_dir));
      foreach ($styles as $style) {
         unlink($template_dir . '/' . $style);
      }
      $custom_styles = preg_grep('~^custom-.*\.(css)$~', scandir($template_dir));
      foreach ($custom_styles as $style) {
         unlink($template_dir . '/' . $style);
      }
      return $styles;
   }

   public static function getAstroidFieldsets($form) {
      $astroidfieldsets = $form->getFieldsets();
      usort($astroidfieldsets, "self::fieldsetOrding");

      $fieldsets = [];

      foreach ($astroidfieldsets as $af) {
         $fieldsets[$af->name] = $af;
      }

      return $fieldsets;
   }

   public static function replaceRelationshipOperators($str) {
      $str = str_replace(" AND ", " && ", $str);
      $str = str_replace(" OR ", " || ", $str);
      return $str;
   }

   public static function fieldsetOrding($a, $b) {
      if ($a->order == $b->order) {
         return 0;
      }

      if ($a->order == '' || $b->order == '') {
         return 1;
      }

      return ($a->order < $b->order) ? -1 : 1;
   }

   public static function getModules() {
      $db = JFactory::getDbo();
      $query = "SELECT `#__modules`.*,`#__usergroups`.`title` as `access_title` FROM `#__modules` JOIN `#__usergroups` ON `#__usergroups`.`id`=`#__modules`.`access` WHERE `#__modules`.`client_id`=0";
      $db->setQuery($query);
      $results = $db->loadObjectList();

      $return = [];
      foreach ($results as $result) {
         $return[] = ['id' => $result->id, 'title' => $result->title, 'module' => $result->module, 'type' => 'module', 'published' => $result->published, 'access_title' => $result->access_title, 'position' => $result->position, 'showtitle' => $result->showtitle];
      }

      return $return;
   }

   public static function getPositions() {
      $db = \JFactory::getDbo();

      $query = $db->getQuery(true);
      $query->select(array('*'));
      $query->from($db->quoteName('#__template_styles'));
      $query->where($db->quoteName('client_id') . ' = 0');
      $query->where($db->quoteName('id') . ' = ' . $db->quote(\JFactory::getApplication()->input->get('id', 0, 'INT')));
      $db->setQuery($query);

      $template_style = $db->loadObject();

      $templateXML = \JPATH_SITE . '/templates/' . $template_style->template . '/templateDetails.xml';
      $template = simplexml_load_file($templateXML);
      $positions = [];
      foreach ($template->positions[0] as $position) {
         $p = (string) $position;
         $positions[$p] = $p;
      }
      return $positions;
   }

   public static function getTemplatePartials($template) {
      $template_dir = JPATH_SITE . '/' . 'templates' . '/' . $template . '/' . 'frontend' . '/partials/';
      if (file_exists($template_dir)) {
         $partials = self::getPartials($template_dir, $template_dir);
         return $partials;
      } else {
         return $partials;
      }
   }

   public static function getPartials($dir, $templatedir) {
      $files = glob($dir . '*');
      $partials = [];
      foreach ($files as $file) {
         if (!is_dir($file)) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if ($extension == 'php') {
               $prefix = str_replace(DIRECTORY_SEPARATOR, '.', str_replace($templatedir, '', $dir));
               $partials[] = $prefix . pathinfo($file, PATHINFO_FILENAME);
            }
         } else if ($file != "." && $file != ".." && is_dir($file)) {
            $sub_partials = self::getPartials($file . '/', $templatedir);
            $partials = array_merge($partials, $sub_partials);
         }
      }
      return $partials;
   }

   public static function isSystemFont($font) {
      return isset(AstroidFrameworkConstants::$system_fonts[$font]);
   }

   public static function setTemplateDefaults($template, $id, $parent_id = 0) {
      $params_path = JPATH_SITE . "/templates/{$template}/params/{$id}.json";
      if (!file_exists($params_path)) {
         if (!empty($parent_id) && file_exists(JPATH_SITE . "/templates/{$template}/params/" . $parent_id . '.json')) {
            $params = file_get_contents(JPATH_SITE . "/templates/{$template}/params" . '/' . $parent_id . '.json');
            file_put_contents(JPATH_SITE . "/templates/{$template}/params" . '/' . $id . '.json', $params);
         } else if (file_exists(JPATH_SITE . '/templates/' . $template . '/astroid/default.json')) {
            $params = file_get_contents(JPATH_SITE . '/templates/' . $template . '/astroid/default.json');
            if (!file_exists(JPATH_SITE . "/templates/{$template}/params")) {
               mkdir(JPATH_SITE . "/templates/{$template}/params");
            }
            $params = str_replace('TEMPLATE_NAME', $template, $params);
            file_put_contents(JPATH_SITE . "/templates/{$template}/params" . '/' . $id . '.json', $params);
         } else {
            if (!file_exists(JPATH_SITE . "/templates/{$template}/params")) {
               mkdir(JPATH_SITE . "/templates/{$template}/params");
            }
            file_put_contents(JPATH_SITE . "/templates/{$template}/params" . '/' . $id . '.json', '');
         }
         $db = JFactory::getDbo();
         $object = new stdClass();
         $object->id = $id;
         $object->params = \json_encode(["astroid" => $id]);
         $db->updateObject('#__template_styles', $object, 'id');
         self::uploadTemplateDefaults($template, $id);
      }
   }

   public static function uploadTemplateDefaults($template, $id) {
      $source = JPATH_SITE . '/templates/' . $template . '/images/default';
      $destination = JPATH_SITE . '/images/' . $template;
      $files = JFolder::files($source);
      JFolder::copy($source, $destination, '', true);
   }

}
