<?php

jimport('astroid.framework.template');

abstract class AstroidFramework {

   public static $template = null;

   public static function getTemplate() {
      if (!self::$template) {
         self::$template = self::createTemplate();
      }

      return self::$template;
   }

   public static function createTemplate() {
      return new AstroidFrameworkTemplate(JFactory::getApplication()->getTemplate(true));
   }

}
