<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
define('COMPILE_SASS', 0);
jimport('astroid.framework.helper');
jimport('astroid.framework.template');

use Leafo\ScssPhp\Compiler;

/**
 * Astroid system plugin
 *
 * @since  1.0
 */
class plgSystemAstroid extends JPlugin {

   protected $app;

   public function onBeforeRender() {
      if ($this->app->isAdmin()) {
         if (JFactory::getUser()->id) {
            $astroid_redirect = $this->app->input->get->get('ast', '');
            if (!empty($astroid_redirect)) {
               $this->app->redirect(base64_decode(urldecode($astroid_redirect)));
            }
         }

         $document = \JFactory::getDocument();
         $version = new \JVersion;
         $script = [];
         $script[] = "jQuery(document).ready(function(){"
                 . "jQuery('body').addClass('joomla-" . ((int) $version->getShortVersion()) . "')"
                 . "})";
         $document->addScriptdeclaration(implode(';', $script));
      }
   }

   public function onExtensionAfterSave($context, $table, $isNew) {
      if ($this->app->isAdmin() && $context == "com_templates.style" && $isNew && $this->isAstroidTemplate($table->template)) {
         $db = JFactory::getDbo();
         $params = \json_decode($table->params, TRUE);
         $ast_id = $params['astroid_template_id'];
         $query = "SELECT * FROM `#__astroid_templates` WHERE `id`='" . $ast_id . "'";
         $db->setQuery($query);
         $astroid_template = $db->loadObject();

         $object = new stdClass();
         $object->id = null;
         $object->template_id = $table->id;
         $object->title = $table->title;
         $object->params = $astroid_template->params;
         $object->created = time();
         $object->updated = time();
         $db->insertObject('#__astroid_templates', $object);
         $ast_id = $db->insertid();

         $object = new stdClass();
         $object->id = $table->id;
         $object->params = \json_encode(["astroid_template_id" => $ast_id]);
         $db->updateObject('#__template_styles', $object, 'id');
      }
   }

   public function onAfterRoute() {
      $option = $this->app->input->get('option', '');
      $astroid = $this->app->input->get('astroid', '');

      // load astroid language
      $lang = JFactory::getLanguage();
      $lang->load("astroid", JPATH_SITE);

      if ($this->app->isAdmin()) {
         if ($option == 'com_ajax') {
            switch ($astroid) {
               case "save":
                  header('Content-Type: application/json');
                  header('Access-Control-Allow-Origin: *');
                  $return = array();
                  try {
                     if (!JSession::checkToken()) {
                        throw new \Exception('The most recent request was denied because it contained an invalid security token. Please refresh the page and try again.');
                     }
                     $params = $this->app->input->post->get('params', array(), 'RAW');
                     $export_settings = $this->app->input->post->get('export_settings', 0, 'INT');
                     if ($export_settings) {
                        $return["status"] = "success";
                        $return["code"] = 200;
                        $return["data"] = $params;
                     } else {
                        $template = new \stdClass();
                        $template->template_id = $this->app->input->get('id', NULL, 'INT');
                        $template->params = \json_encode($params);
                        $db = JFactory::getDbo();
                        $db->updateObject('#__astroid_templates', $template, 'template_id');

                        $templateObj = AstroidFrameworkHelper::getTemplateById($template->template_id);
                        //AstroidFrameworkHelper::clearCache($templateObj->template);
                        $return["status"] = "success";
                        $return["code"] = 200;
                        $return["data"] = $template;
                     }
                  } catch (\Exception $e) {
                     $return["status"] = "error";
                     $return["code"] = $e->getCode();
                     $return["message"] = $e->getMessage();
                  }
                  echo \json_encode($return);
                  die();
                  break;
               case "media":
                  header('Content-Type: application/json');
                  header('Access-Control-Allow-Origin: *');
                  $return = array();
                  try {
                     $action = $this->app->input->get->get('action', '', 'RAW');
                     $data = AstroidFrameworkHelper::AstroidMedia($action);
                     $return["status"] = "success";
                     $return["code"] = 200;
                     $return["data"] = $data;
                  } catch (\Exception $e) {
                     $return["status"] = "error";
                     $return["code"] = $e->getCode();
                     $return["message"] = $e->getMessage();
                  }
                  echo \json_encode($return);
                  die();
                  break;
               case "google-fonts":
                  header('Content-Type: html');
                  header('Access-Control-Allow-Origin: *');
                  $return = '';
                  try {
                     $fonts = AstroidFrameworkHelper::getGoogleFonts();
                     $options = [];
                     foreach ($fonts as $font) {
                        $variants = [];
                        if (count($font['variants']) > 1) {
                           foreach ($font['variants'] as $v) {
                              if ($v == 'regular') {
                                 $variants[] = '400';
                              } else if ($v == 'italic') {
                                 $variants[] = '400i';
                              } else {
                                 $variants[] = str_replace('talic', '', $v);
                              }
                           }
                        }
                        $value = str_replace(' ', '+', $font['family']);
                        if (!empty($variants)) {
                           $value .= ':' . implode(',', $variants);
                        }
                        $options[$font['category']][$value] = $font['family'];
                     }
                     // $return .= '<div class="item" data-value="">Inherit</div>';
                     $return .= '<div class="ui horizontal divider">System Fonts</div>';
                     foreach (AstroidFrameworkConstants::$system_fonts as $name => $system_font) {
                        $return .= '<div class="item" data-value="' . $name . '">' . $system_font . '</div>';
                     }

                     $return .= '<div class="ui horizontal divider">Google Fonts</div>';
                     foreach ($options as $group => $fonts) {
                        foreach ($fonts as $fontValue => $font) {
                           $return .= '<div class="item" data-value="' . $fontValue . '">' . $font . '</div>';
                        }
                     }
                  } catch (\Exception $e) {
                     
                  }
                  echo $return;
                  die();
                  break;
               case "search":
                  header('Content-Type: application/json');
                  $search = $this->app->input->get('search', '');
                  switch ($search) {
                     case 'icon':
                        $return = ['success' => true];
                        $return['results'] = AstroidFrameworkHelper::getFAIcons(true);
                        echo \json_encode($return);
                        die();
                        break;
                     default:
                        $return = ['success' => false];
                        $return['results'] = "Invalid search request.";
                        echo \json_encode($return);
                        die();
                  }
                  break;
               case "manager":
                  if (!JFactory::getUser()->id) {
                     $uri = JFactory::getURI();
                     $return = $uri->toString();
                     JFactory::getApplication()->redirect(JRoute::_('index.php?ast=' . urlencode(base64_encode($return))));
                  }
                  require_once JPATH_LIBRARIES . '/' . 'astroid' . '/' . 'framework' . '/' . 'library' . '/' . 'scssphp' . '/' . 'scss.inc.php';
                  $id = $this->app->input->get('id', NULL, 'INT');
                  $template = AstroidFrameworkHelper::getTemplateById($id);
                  if (!defined('ASTROID_TEMPLATE_NAME')) {
                     define('ASTROID_TEMPLATE_NAME', $template->template);
                  }
                  // render manager scss | for developer use only

                  $scss_file = JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'scss' . '/' . 'bootstrap.scss';

                  if (file_exists($scss_file)) {
                     $cssversion = filemtime(JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'css' . '/' . 'astroid-framework.css');
                     $scssversion = filemtime(JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'scss' . '/' . 'bootstrap.scss');

                     if ($cssversion == $scssversion && COMPILE_SASS) {
                        AstroidFrameworkHelper::compileSass(JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'scss', JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'css', "bootstrap.scss", 'astroid-framework.css');
                     }
                  }

                  // render manager
                  $layout = new JLayoutFile('framework.manager', JPATH_LIBRARIES . '/astroid/framework/layouts');
                  echo $layout->render();

                  // stop application
                  die();
                  break;
               case 'clear-cache':
                  try {
                     $template = $this->app->input->get->get('template', '', 'RAW');
                     $styles = AstroidFrameworkHelper::clearCache($template);
                     echo \json_encode(['status' => 'success', 'code' => 200, 'message' => 'Cache successfully cleared.', 'styles' => $styles]);
                  } catch (\Exception $e) {
                     echo \json_encode(['status' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage()]);
                  }
                  die();
                  break;
            }
         }
      }
   }

   public function onContentPrepareForm($form, $data) {
      $astroid_dir = 'libraries' . '/' . 'astroid';
      \JForm::addFormPath(JPATH_SITE . '/' . $astroid_dir . '/framework/forms');
      if ($form->getName() == 'com_menus.item') {
         $form->loadFile('menu', false);
         $form->loadFile('banner', false);
      }
   }

   public function onAfterRender() {
      if ($this->app->isAdmin()) {
         $body = $this->app->getBody();
         $astroid_templates = $this->getAstroidTemplates();
         $body = preg_replace_callback('/(<a\s[^>]*href=")([^"]*)("[^>]*>)(.*)(<\/a>)/siU', function($matches) use($astroid_templates) {
            $html = $matches[0];
            if (strpos($matches[2], 'task=style.edit')) {
               $uri = new JUri($matches[2]);
               $id = (int) $uri->getVar('id');

               if ($id && in_array($uri->getVar('option'), array('com_templates')) && (in_array($id, $astroid_templates))) {
                  $html = $matches[1] . $uri . $matches[3] . $matches[4] . $matches[5];
                  $html .= ' <span class="label" style="background: linear-gradient(to right,#ff9966, #ff5e62); color:#fff;padding-left: 10px;padding-right: 10px;margin-left: 5px;">Astroid</span>';
               }
            }
            return $html;
         }, $body);
         $this->app->setBody($body);
      }
   }

   private function getAstroidTemplates() {
      $db = JFactory::getDbo();
      $query = $db
              ->getQuery(true)
              ->select('s.id, s.template')
              ->from('#__template_styles as s')
              ->where('s.client_id = 0')
              ->where('e.enabled = 1')
              ->leftJoin('#__extensions as e ON e.element=s.template AND e.type=' . $db->quote('template') . ' AND e.client_id=s.client_id');

      $db->setQuery($query);
      $templates = $db->loadObjectList();
      $return = [];
      foreach ($templates as $template) {
         if ($this->isAstroidTemplate($template->template)) {
            $return[] = $template->id;
         }
      }
      return $return;
   }

   private function isAstroidTemplate($name) {
      return file_exists(JPATH_SITE . "/templates/{$name}/frontend");
   }

}
