<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
define('COMPILE_SASS', 0);

JLoader::registerNamespace('Astroid', JPATH_LIBRARIES . '/astroid/framework/library/astroid', false, false, 'psr4');

/**
 * Astroid system plugin
 *
 * @since  1.0
 */
class plgSystemAstroid extends JPlugin
{

   protected $app;

   public function onAfterInitialise()
   {
      Astroid\Framework::init();
   }

   public function onAfterDispatch()
   {
      if (Astroid\Framework::isSite() && Astroid\Framework::$isAstroid) {
         Astroid\Framework::getClient()->beforeRender();
      }
   }

   public function onExtensionAfterSave($context, $table, $isNew)
   {
      if (Astroid\Framework::isAdmin() && $context == "com_templates.style" && $isNew && Astroid\Helper\Template::isAstroidTemplate($table->template)) {
         $params = \json_decode($table->params, TRUE);
         $parent_id = $params['astroid'];
         Astroid\Helper\Template::setTemplateDefaults($table->template, $table->id, $parent_id);
      }
   }

   public function onAfterRoute()
   {
      Astroid\Helper::loadLanguage('astroid');

      $option = $this->app->input->get('option', '');
      $astroid = $this->app->input->get('astroid', '');

      if ($option == 'com_ajax' && !empty($astroid)) {
         Astroid\Framework::getClient()->execute($astroid);
      }
   }

   public function onContentPrepareForm($form, $data)
   {
      Astroid\Framework::forms($form, $data);
   }

   public function onAfterRender()
   {
      if (Astroid\Framework::isAdmin()) {
         Astroid\Framework::getClient()->addTemplateLabels(); // to add label in styles list
      }

      if (Astroid\Framework::isSite() && Astroid\Framework::$isAstroid) {
         Astroid\Framework::getClient()->afterRender();
      }
   }

   public function onAfterAstroidFormLoad($template, $form)
   {
      if (!count($template->getPresets())) {
         $form->removeField('template_preset', 'params');
         $form->removeField('presets', 'params');
      }
   }

   // onBeforeAstroidRender
   // onAfterAstroidRender
}
