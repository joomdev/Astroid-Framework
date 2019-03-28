<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;

class AstroidCache {

   public static function elementCache($layout, $params, $data) {
      $cache = \JFactory::getCache('astroid_elements', 'callback');
      $cache->setLifeTime(60);

      $wrkaroundoptions = array('nopathway' => 1, 'nohead' => 0, 'nomodules' => 1, 'modulemode' => 1, 'mergehead' => 1);
      $wrkarounds = true;

      $ret = $cache->get(array('AstroidElement', 'renderElement'), array($layout, $params, $data), 'astroid_elements' . md5(serialize(array($layout, $params, $data)) . self::getVersion()), $wrkarounds, $wrkaroundoptions);
      return $ret;
   }

   public static function layoutCache($partial, $params, $template) {
      $cache = \JFactory::getCache('astroid_layouts', 'callback');
      $cache->setLifeTime(60);

      $wrkaroundoptions = array('nopathway' => 1, 'nohead' => 0, 'nomodules' => 1, 'modulemode' => 1, 'mergehead' => 1);
      $wrkarounds = true;

      $ret = $cache->get(array('AstroidFrameworkTemplate', 'renderLoadLayout'), array($partial, $params, $template), 'astroid_layouts' . md5(serialize(array($partial, $params, $template)) . self::getVersion()), $wrkarounds, $wrkaroundoptions);
      return $ret;
   }

   public static function getVersion() {
      $document = JFactory::getDocument();
      $config = JFactory::getConfig();
      $version = '';
      if (!$config->get('debug', 0)) {
         $version = $document->getMediaVersion();
      }
      return $version;
   }

}
