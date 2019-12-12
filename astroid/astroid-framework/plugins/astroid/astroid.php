<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
define('COMPILE_SASS', 0);
jimport('astroid.framework.helper');
jimport('astroid.framework.template');
jimport('astroid.framework.article');

use Leafo\ScssPhp\Compiler;

/**
 * Astroid system plugin
 *
 * @since  1.0
 */
class plgSystemAstroid extends JPlugin
{

   protected $app;

   public function onBeforeRender()
   {
      if ($this->app->isAdmin()) {
         if (JFactory::getUser()->id) {
            $astroid_redirect = $this->app->input->get->get('ast', '', 'RAW');
            if (!empty($astroid_redirect)) {
               $this->app->redirect(base64_decode(urldecode($astroid_redirect)));
            }
         }
      }
   }

   public function onExtensionAfterSave($context, $table, $isNew)
   {
      if ($this->app->isAdmin() && $context == "com_templates.style" && $isNew && $this->isAstroidTemplate($table->template)) {
         $params = \json_decode($table->params, TRUE);
         $parent_id = $params['astroid'];
         AstroidFrameworkHelper::setTemplateDefaults($table->template, $table->id, $parent_id);
      }
   }

   public function onAfterRoute()
   {
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
                        throw new \Exception(\JText::_('ASTROID_AJAX_ERROR'));
                     }
                     $params = $this->app->input->post->get('params', array(), 'RAW');
                     $export_settings = $this->app->input->post->get('export_settings', 0, 'INT');
                     if ($export_settings) {
                        $return["status"] = "success";
                        $return["code"] = 200;
                        $return["data"] = $params;
                     } else {
                        $template_id = $this->app->input->get('id', NULL, 'INT');
                        $template_name = $this->app->input->get('template', NULL, 'RAW');
                        $params = \json_encode($params);
                        file_put_contents(JPATH_SITE . "/templates/{$template_name}/params" . '/' . $template_id . '.json', $params);
                        $return["status"] = "success";
                        $return["code"] = 200;
                        $version = new \JVersion;
                        $version->refreshMediaVersion();
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
                     $return .= '<div class="ui horizontal divider">' . JText::_('TPL_ASTROID_TYPOGRAPHY_SYSTEM') . '</div>';
                     foreach (AstroidFrameworkConstants::$system_fonts as $name => $system_font) {
                        $return .= '<div class="item" data-value="' . $name . '">' . $system_font . '</div>';
                     }

                     $template = $this->app->input->get('template', '', 'RAW');

                     $uploadedFonts = AstroidFrameworkHelper::getUploadedFonts($template);

                     if (!empty($uploadedFonts)) {
                        $return .= '<div class="ui horizontal divider">' . JText::_('TPL_ASTROID_TYPOGRAPHY_CUSTOM') . '</div>';
                        foreach ($uploadedFonts as $uploaded_font) {
                           $return .= '<div class="item" data-value="' . $uploaded_font['id'] . '">' . $uploaded_font['name'] . '</div>';
                        }
                     }

                     $return .= '<div class="ui horizontal divider">' . JText::_('TPL_ASTROID_TYPOGRAPHY_GOOGLE') . '</div>';
                     foreach ($options as $group => $fonts) {
                        foreach ($fonts as $fontValue => $font) {
                           $return .= '<div class="item" data-value="' . $fontValue . '">' . $font . '</div>';
                        }
                     }
                  } catch (\Exception $e) { }
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
                  $id = $this->app->input->get('id', NULL, 'INT');
                  $template = AstroidFrameworkHelper::getTemplateById($id);
                  AstroidFramework::setTemplate($template);
                  if (!defined('ASTROID_TEMPLATE_NAME')) {
                     define('ASTROID_TEMPLATE_NAME', $template->template);
                  }
                  $lang->load('tpl_' . ASTROID_TEMPLATE_NAME, JPATH_SITE);
                  $lang->load(ASTROID_TEMPLATE_NAME, JPATH_SITE);
                  $lang->load('mod_menu', JPATH_SITE);

                  // render manager
                  $layout = new JLayoutFile('framework.manager', JPATH_LIBRARIES . '/astroid/framework/layouts');
                  JPluginHelper::importPlugin('astroid');
                  $dispatcher = JDispatcher::getInstance();
                  $dispatcher->trigger('onBeforeAstroidAdminRender', [&$template]);

                  echo $layout->render(['template' => $template, 'id' => $id]);

                  // stop application
                  die();
                  break;
               case 'clear-cache':
                  try {
                     $template = $this->app->input->get->get('template', '', 'RAW');
                     AstroidFrameworkHelper::clearCache($template, ['style', 'custom', 'astroid', 'preset']);
                     echo \json_encode(['status' => 'success', 'code' => 200, 'message' => JText::_('TPL_ASTROID_SYSTEM_MESSAGES_CACHE')]);
                  } catch (\Exception $e) {
                     echo \json_encode(['status' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage()]);
                  }
                  die();
                  break;
               case 'clear-joomla-cache':
                  try {
                     AstroidFrameworkHelper::clearJoomlaCache();
                     echo \json_encode(['status' => 'success', 'code' => 200, 'message' => JText::_('TPL_ASTROID_SYSTEM_MESSAGES_JCACHE')]);
                  } catch (\Exception $e) {
                     echo \json_encode(['status' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage()]);
                  }
                  die();
                  break;
            }
         }
      }

      if ($this->app->isSite()) {
         if ($option == 'com_ajax') {
            switch ($astroid) {
               case "rate":
                  header('Content-Type: application/json');
                  header('Access-Control-Allow-Origin: *');
                  $lang = JFactory::getLanguage();
                  $lang->load("com_content", JPATH_SITE);
                  $return = array();
                  try {
                     if (!JSession::checkToken()) {
                        throw new \Exception(\JText::_('ASTROID_AJAX_ERROR'));
                     }
                     $id = $this->app->input->post->get('id', 0, 'INT');
                     $vote = $this->app->input->post->get('vote', 0, 'INT');
                     if (empty($id)) {
                        throw new \Exception(\JText::_('ASTROID_ARTICLE_NOT_FOUND'), 404);
                     }
                     if ($vote < 0 || $vote > 5) {
                        throw new \Exception(\JText::_('ASTROID_INVALID_RATING'), 0);
                     }
                     jimport('joomla.application.component.model');
                     JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');
                     $model = JModelLegacy::getInstance('Article', 'ContentModel');
                     if ($model->storeVote($id, $vote)) {
                        $return["status"] = "success";
                        $return["code"] = 200;
                        $return["message"] = JText::_('COM_CONTENT_ARTICLE_VOTE_SUCCESS');
                        $return["rating"] = AstroidFrameworkArticle::getArticleRating($id);
                     } else {
                        throw new \Exception('COM_CONTENT_ARTICLE_VOTE_FAILURE', 0);
                     }
                  } catch (\Exception $e) {
                     $return["status"] = "error";
                     $return["code"] = $e->getCode();
                     $return["message"] = JText::_($e->getMessage());
                  }
                  echo \json_encode($return);
                  die();
                  break;
            }
         }
      }
   }

   public function onContentPrepareForm($form, $data)
   {
      $astroid_dir = 'libraries' . '/' . 'astroid';
      \JForm::addFormPath(JPATH_SITE . '/' . $astroid_dir . '/framework/forms');
      if ($form->getName() == 'com_menus.item') {
         $form->loadFile('menu', false);
         $form->loadFile('banner', false);
         $form->loadFile('og', false);
      }

      if ($form->getName() == 'com_content.article') {
         $form->loadFile('article', false);
         $form->loadFile('blog', false);
         $form->loadFile('opengraph', false);
      }

      if ($form->getName() == 'com_menus.item' && (isset($data->request['option']) && $data->request['option'] == 'com_content') && (isset($data->request['view']) && $data->request['view'] == 'category') && (isset($data->request['layout']) && $data->request['layout'] == 'blog')) {
         $form->loadFile('menu_blog', false);
      }
      if ($form->getName() == 'com_menus.item' && (isset($data->request['option']) && $data->request['option'] == 'com_content') && (isset($data->request['view']) && $data->request['view'] == 'featured')) {
         $form->loadFile('menu_blog', false);
      }

      if ($form->getName() == 'com_users.user' || $form->getName() == 'com_admin.profile') {
         $form->loadFile('author', false);
      }
   }

   public function onAfterRender()
   {
      if ($this->app->isAdmin()) {
         $body = $this->app->getBody();
         $astroid_templates = $this->getAstroidTemplates();
         $body = preg_replace_callback('/(<a\s[^>]*href=")([^"]*)("[^>]*>)(.*)(<\/a>)/siU', function ($matches) use ($astroid_templates) {
            $html = $matches[0];
            if (strpos($matches[2], 'task=style.edit')) {
               $uri = new JUri($matches[2]);
               $id = (int) $uri->getVar('id');

               if ($id && in_array($uri->getVar('option'), array('com_templates')) && (in_array($id, $astroid_templates))) {
                  $html = $matches[1] . $uri . $matches[3] . $matches[4] . $matches[5];
                  $html .= ' <span class="label" style="background: rgba(0, 0, 0, 0) linear-gradient(to right, #8E2DE2, #4A00E0) repeat scroll 0 0; color:#fff;padding-left: 10px;padding-right: 10px;margin-left: 5px;border-radius: 30px;box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.20);">Astroid</span>';
               }
            }
            return $html;
         }, $body);
         $this->app->setBody($body);
      }
   }

   private function getAstroidTemplates()
   {
      if (!file_exists(JPATH_LIBRARIES . '/astroid/framework/helper.php')) {
         return [];
      }
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
            AstroidFrameworkHelper::setTemplateDefaults($template->template, $template->id);
            // AstroidFrameworkHelper::setTemplateTypography($template->template, $template->id);
            $return[] = $template->id;
         }
      }
      return $return;
   }

   private function isAstroidTemplate($name)
   {
      return file_exists(JPATH_SITE . "/templates/{$name}/frontend");
   }

   public function onAfterGetMenuTypeOptions(&$list)
   {
      //      $types = [];
      //      $o = new JObject;
      //      $o->title = 'ASTROID_LINKS_ONEPAGE_TITLE';
      //      $o->type = 'astroid_onepage';
      //      $o->description = 'ASTROID_LINKS_ONEPAGE_DESC';
      //      $o->request = ['astroid_onepage' => 1];
      //      $types[] = $o;
      //
      //      $list['ASTROID_LINKS'] = $types;
      //      return $list;
   }

   public function onAfterAstroidFormLoad($template, $form)
   {
      if (!count($template->presets)) {
         $form->removeField('template_preset', 'params');
         $form->removeField('presets', 'params');
      }
   }
}
