<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;
define('COMPILE_SASS', 0);

JLoader::registerNamespace('Astroid', JPATH_LIBRARIES . '/astroid/framework/library/astroid', false, false, 'psr4');

use Astroid\Framework;

/**
 * Astroid system plugin
 *
 * @since  1.0
 */
class plgSystemAstroid extends JPlugin
{

   protected $app;

   public function __construct(&$subject, $config)
   {
      parent::__construct($subject, $config);
   }

   public function onAfterRoute()
   {
      Framework::init();
      $option = $this->app->input->get('option', '');
      $astroid = $this->app->input->get('astroid', '');
      if ($option == 'com_ajax' && !empty($astroid)) {
         Astroid\Framework::getClient()->execute($astroid);
      }
   }

   public function onContentPrepareForm($form, $data)
   {
      Astroid\Framework::getClient()->onContentPrepareForm($form, $data);
   }

   public function onBeforeCompileHead()
   {
      if (Framework::isAdmin()) {
         return;
      }
      $doc = \JFactory::getDocument();

      $dontInclude = array(
         '/media/jui/js/jquery.js',
         '/media/jui/js/jquery.min.js',
         '/media/jui/js/jquery-noconflict.js',
         '/media/jui/js/jquery-migrate.js',
         '/media/jui/js/jquery-migrate.min.js',
         '/media/jui/js/bootstrap.js',
         '/media/system/js/core-uncompressed.js',
         '/media/system/js/tabs-state.js',
         '/media/system/js/core.js',
         '/media/system/js/mootools-core.js',
         '/media/system/js/mootools-core-uncompressed.js',
      );

      foreach ($doc->_scripts as $key => $script) {
         if (in_array($key, $dontInclude)) {
            unset($doc->_scripts[$key]);
         }
      }
   }

   public function onAfterRender()
   {
      Astroid\Framework::getClient()->onAfterRender();
   }

   public function onAfterRespond()
   {
      if (!(Astroid\Helper::getPluginParams()->get('astroid_debug', 0)) || Framework::isAdmin()) {
         return;
      }

      $cache = \JPluginHelper::getPlugin('system', 'cache');
      if (Framework::isSite() && !empty($cache)) {
         return;
      }

      // Capture output.
      $contents = ob_get_contents();

      if ($contents) {
         ob_end_clean();
      }
      echo Astroid\Helper::str_lreplace('</body>', Astroid\Helper::debug() . '</body>', $contents);
   }

   public function onExtensionAfterSave($context, $table, $isNew)
   {
      if (Astroid\Framework::isAdmin() && $context == "com_templates.style" && $isNew && Astroid\Helper\Template::isAstroidTemplate($table->template)) {
         $params = \json_decode($table->params, TRUE);
         $parent_id = $params['astroid'];
         Astroid\Helper\Template::setTemplateDefaults($table->template, $table->id, $parent_id);
      }
   }

   public function onAfterAstroidFormLoad($template, $form)
   {
      if ($template->isAstroid && Framework::isAdmin() && !count($template->getPresets())) {
         $form->removeField('template_preset', 'params');
         $form->removeField('presets', 'params');
      }
   }

   // onBeforeAstroidRender
   // onAfterAstroidRender
}
