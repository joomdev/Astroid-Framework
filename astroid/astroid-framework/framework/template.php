<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;
jimport('astroid.framework.helper');
jimport('astroid.framework.element');

class AstroidFrameworkTemplate {

   public $template;
   public $params;
   public $language;
   public $direction;
   protected $logs;
   protected $debug = false;

   public function __construct($template) {
      if (!defined('ASTROID_TEMPLATE_NAME')) {
         define('ASTROID_TEMPLATE_NAME', $template->template);
      }
      $this->template = $template->template;
      $this->params = $template->params;
      if (isset($template->language)) {
         $this->language = $template->language;
      }
      if (isset($template->direction)) {
         $this->direction = $template->direction;
      }
      $this->initAgent();
   }

   public function head() {
      
   }

   public function initAgent() {
//      $agent = new Mobile_Detect;
//      if ($agent->isMobile() || $agent->isTablet()) {
//         $agent_environment = 'wap';
//         if ($agent->isTablet()) {
//            $agent_device = 'tablet';
//         } else {
//            $agent_device = 'mobile';
//         }
//         $agent_name = $agent->device();
//         $agent_browser = $agent->browser();
//      } else if ($agent->isDesktop()) {
//         $agent_environment = 'web';
//         $agent_device = 'desktop';
//         $agent_name = $agent->device();
//         $agent_browser = $agent->browser();
//      } else if ($agent->isRobot()) {
//         config(['agent.environment' => 'robot']);
//         $agent_device = strtolower($agent->robot());
//         $agent_name = $agent->robot();
//      } else {
//         $agent_environment = 'desktop';
//         $agent_device = 'undefined';
//         $agent_name = $agent->device();
//         $agent_browser = $agent->browser();
//      }

      /*
        var ASTROID_TEMPLATE = [];
        ASTROID_TEMPLATE.DEVICE_ENV = "<?php echo config('agent.environment'); ?>";
        ASTROID_TEMPLATE.DEVICE_TYPE = "<?php echo config('agent.device'); ?>";
        ASTROID_TEMPLATE.DEVICE_NAME = "<?php echo config('agent.name'); ?>";
        ASTROID_TEMPLATE.DEVICE_BROWSER = "<?php echo config('agent.browser'); ?>";
        ASTROID_TEMPLATE.BASE_URL = "<?php echo url('/'); ?>";
       */
   }

   public function body() {
      $this->loadLayout('custom');
      if ($this->debug) {
         $this->renderLogs();
      }
   }

   public function renderLayout() {
      $params = $this->params;
      $layout = $params->get("layout", NULL);
      if ($layout === NULL) {
         $value = file_get_contents(JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'json' . '/' . 'layouts' . '/' . 'default.json');
         $layout = \json_decode($value, true);
      } else {
         $layout = \json_decode($layout, true);
      }
      $this->setLog("Rending Layout");
      $template_layout = $this->params->get('template_layout', 'wide');
      echo '<div class="astroid-container">';
      $this->loadLayout('offcanvas');
      $this->loadLayout('mobilemenu');
      echo '<div class="astroid-content">';
      echo '<div style="' . $this->getLayoutStyles() . '" class="astroid-layout astroid-layout-' . $template_layout . '">';
      echo '<div class="astroid-wrapper">';
      foreach ($layout['sections'] as $section) {
         $sectionObject = new AstroidElement($section['type'], $section, $this);
         $sectionHTML = '';
         $this->setLog("Rending Section : " . $sectionObject->getValue('title'));
         $rowHTML = '';
         foreach ($section['rows'] as $rowIndex => $row) {
            $columnHTML = '';

            $columnSizes = [];
            $bufferSize = 0;
            foreach ($row['cols'] as $col) {
               $renderedHTML = '';
               foreach ($col['elements'] as $element) {
                  $el = new AstroidElement($element['type'], $element, $this);
                  $renderedHTML .= $el->render();
               }
               if (!empty($renderedHTML)) {
                  $columnSizes[] = $bufferSize + $col['size'];
                  $bufferSize = 0;
               } else {
                  $bufferSize = $bufferSize + $col['size'];
               }
            }
            if ($bufferSize > 0 && !empty($columnSizes)) {
               $lastIndex = count($columnSizes) - 1;
               $columnSizes[$lastIndex] = $columnSizes[$lastIndex] + $bufferSize;
            }

            $sizeIndex = 0;
            foreach ($row['cols'] as $col) {
               $renderedHTML = '';
               foreach ($col['elements'] as $element) {
                  $el = new AstroidElement($element['type'], $element, $this);
                  $this->setLog("Rending Element : " . $el->getValue('title'));
                  if (@$_GET['wf'] == 1) {
                     $renderedHTML .= $el->renderWireframe();
                  } else {
                     $renderedHTML .= $el->render();
                  }
               }
               if (!empty($renderedHTML)) {
                  $columnSize = $columnSizes[$sizeIndex];
                  $sizeIndex++;
                  $columnHTML .= '<div class="col-lg-' . $columnSize . '">';
                  $columnHTML .= $renderedHTML;
                  $columnHTML .= '</div>';
               }
            }
            if (!empty($columnHTML)) {
               $rowHTML .= '<div class="row">';
               $rowHTML .= $columnHTML;
               $rowHTML .= '</div>';
            }
         }
         if (!empty($rowHTML)) {
            $sectionHTML .= "<section id='" . $sectionObject->getID() . "' class='" . $sectionObject->getClass() . "' style='" . $sectionObject->getStyles() . "' data-animation='" . $sectionObject->getAnimation() . "' " . $sectionObject->getAttributes() . "><div class='" . $sectionObject->getSectionLayoutType() . "'>";
            $sectionHTML .= $rowHTML;
            $sectionHTML .= '</div></section>';
         }
         echo $sectionHTML;
      }
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      $this->setLog("Rending Complete!", "success");
   }

   public function getLayoutStyles() {
      $styles = [];
      $template_layout = $this->params->get('template_layout', 'wide');
      if ($template_layout != 'boxed') {
         return false;
      }
      $layout_background_image = $this->params->get('layout_background_image', '');
      if (!empty($layout_background_image)) {
         $styles[] = 'background-image:url(' . JURI::root() . 'images/' . $layout_background_image . ')';
         $styles[] = 'background-repeat:' . $this->params->get('layout_background_repeat', 'inherit');
         $styles[] = 'background-size:' . $this->params->get('layout_background_size', 'inherit');
         $styles[] = 'background-position:' . $this->params->get('layout_background_position', 'inherit');
         $styles[] = 'background-attachment:' . $this->params->get('layout_background_attachment', 'inherit');
      }
      return implode(';', $styles);
   }

   public function renderErrorLayout() {
      $params = $this->params;
      $template_layout = $this->params->get('template_layout', 'wide');
      echo '<div style="' . $this->getLayoutStyles() . '" class="astroid-layout astroid-layout-' . $template_layout . '">';
      echo '<div class="astroid-wrapper">';
      $this->loadLayout('error');
      echo '</div>';
      echo '</div>';
      $this->setLog("Rending Complete!", "success");
   }

   static public function slugify($text) {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);
      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);
      // trim
      $text = trim($text, '-');
      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);
      // lowercase
      $text = strtolower($text);
      if (empty($text)) {
         return 'n-a';
      }
      return $text;
   }

   public function renderLayoutOld() {
      // Load Astroid elements classes
      AstroidFrameworkHelper::loadAstroidElements();
      $params = $this->params;
      $layout = $params->get("layout", NULL);
      if ($layout === NULL) {
         $value = file_get_contents(JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'json' . '/' . 'layouts' . '/' . 'default.json');
         $layout = \json_decode($value, true);
      } else {
         $layout = \json_decode($layout, true);
      }
      $element = new AstroidElement($layout, $this);
      echo $element->render();
   }

   public function modulePosition($position = '', $style = 'none') {
      if (empty($position)) {
         return '';
      }
      $this->setLog("Rending Module Position : " . $position);
      $return = '';
      $return .= '<jdoc:include type="modules" name="' . $position . '" style="' . $style . '" />';
      return $return;
   }

   public function renderModulePosition($position, $style = 'none') {
      if (empty($position)) {
         return '';
      }
      $return = '';
      $beforeContent = $this->getAstroidContent($position, 'before');
      if (!empty($beforeContent)) {
         $return .= $beforeContent;
      }
      if (!empty(JModuleHelper::getModules($position))) {
         $return .= $this->modulePosition($position, $style);
      }
      $afterContent = $this->getAstroidContent($position, 'after');
      if (!empty($afterContent)) {
         $return .= $afterContent;
      }
      return $return;
   }

   public function getAstroidContent($position, $load = 'after') {
      $contents = $this->getAstroidPositionLayouts();
      $return = '';
      if (isset($contents[$position]) && !empty($contents[$position])) {
         foreach ($contents[$position] as $layout) {
            $layout = explode(':', $layout);
            if ($layout[1] == $load) {
               $return .= $this->loadLayout($layout[0], false);
            }
         }
      }
      return $return;
   }

   public function getAstroidPositionLayouts() {
      $astroidcontentlayouts = $this->params->get('astroidcontentlayouts', 'social:astroid-top-social:after,contactinfo:astroid-top-contact:after');
      $return = [];
      if (!empty($astroidcontentlayouts)) {
         $astroidcontentlayouts = explode(',', $astroidcontentlayouts);
         foreach ($astroidcontentlayouts as $astroidcontentlayout) {
            $astroidcontentlayout = explode(':', $astroidcontentlayout);
            if (isset($return[$astroidcontentlayout[1]])) {
               $return[$astroidcontentlayout[1]][] = $astroidcontentlayout[0] . ':' . $astroidcontentlayout[2];
            } else {
               $return[$astroidcontentlayout[1]] = [];
               $return[$astroidcontentlayout[1]][] = $astroidcontentlayout[0] . ':' . $astroidcontentlayout[2];
            }
         }
      }
      return $return;
   }

   public function getStyleName($template_directory) {
      $scss_files = $this->getDir($template_directory . 'scss', 'scss');
      $name = '';
      foreach ($scss_files as $scss) {
         $name .= md5_file($scss['basepath']);
      }
      $cssname = 'style-' . md5($name);
      if (!file_exists($template_directory . 'css/' . $cssname . '.css')) {
         //ini_set('xdebug.max_nesting_level', 3000);
         AstroidFrameworkHelper::compileSass($template_directory . 'scss', $template_directory . 'css', 'style.scss', $cssname . '.css');
      }
      return $cssname . '.css';
   }

   public function getColors() {
      $colors = [];
      $variables = $this->params->get('sass_variables', []);
      foreach ($variables as $key => $variable) {
         $colors[$key] = $this->params->get($variable, '');
      }
      return $colors;
   }

   public function getDir($dir, $extension = null, &$results = array()) {
      $files = scandir($dir);

      foreach ($files as $key => $value) {
         $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
         if (!is_dir($path)) {
            $pathinfo = pathinfo($path);
            if ($extension !== null && $pathinfo['extension'] == $extension) {
               $include_path = str_replace(JPATH_THEMES, '', $path);
               $component_name = str_replace('.min', '', $pathinfo['filename']);
               $results[$component_name] = ['component_name' => $component_name, 'name' => $pathinfo['basename'], 'path' => $include_path, 'basepath' => $path];
            } elseif ($extension === null) {
               $include_path = str_replace(JPATH_THEMES, '', $path);
               $results[] = ['name' => $pathinfo['basename'], 'path' => $include_path];
            }
         } else if ($value != "." && $value != "..") {
            $this->getDir($path, $extension, $results);
         }
      }

      return $results;
   }

   public function loadTemplateCSS($components = '', $error = false) {
      $this->setLog("Loading Stylesheets");
      $components = explode(',', $components);
      $template_directory = JPATH_THEMES . "/" . $this->template . "/css/";
      $compiled_css = $this->getStyleName(JPATH_THEMES . "/" . $this->template . '/');
      array_unshift($components, $compiled_css);
      $document = JFactory::getDocument();
      foreach ($components as $component) {
         if (file_exists($template_directory . $component)) {
            if ($error) {
               echo '<link href="' . JURI::root() . 'templates/' . $this->template . "/css/" . $component . '?' . $document->getMediaVersion() . '" rel="stylesheet" />';
            } else {
               $document->addStyleSheet(JURI::root() . 'templates/' . $this->template . "/css/" . $component . '?' . $document->getMediaVersion());
            }
         }
      }
      if ($error) {
         echo '<link href="' . JURI::root() . 'media/astroid/assets/css/animate.min.css?' . $document->getMediaVersion() . '" rel="stylesheet" />';
      } else {
         $document->addStyleSheet(JURI::root() . 'media/astroid/assets/css/animate.min.css?' . $document->getMediaVersion());
      }
      $this->setLog("Stylesheet Loaded!", "success");
   }

   public function loadTemplateJS($components = '') {
      $this->setLog("Loading Javascripts");
      $components = explode(',', $components);
      $template_directory = JPATH_THEMES . "/" . $this->template . "/js/";
      $document = JFactory::getDocument();
      foreach ($components as $component) {
         if (file_exists($template_directory . $component)) {
            JHtml::_('script', JURI::root() . 'templates/' . $this->template . "/js/" . $component, array('version' => $document->getMediaVersion(), 'relative' => true));
         }
      }
      $this->setLog("Javascripts Loaded!", "success");
   }

   public function bodyClass($body_class, $language = '', $direction = '') {
      $class = [];
      $app = JFactory::getApplication();
      $menu = $app->getMenu()->getActive();

      $class[] = "site";
      $class[] = "astroid-framework";

      $option = $app->input->get('option', '', 'STRING');
      $view = $app->input->get('view', '', 'STRING');
      $layout = $app->input->get('layout', 'default', 'STRING');
      $task = $app->input->get('task', '', 'STRING');
      $itemid = $app->input->get('itemid', '', 'INT');

      if (!empty($option)) {
         $class[] = htmlspecialchars(str_replace('_', '-', $option));
      }
      if (!empty($view)) {
         $class[] = 'view-' . $view;
      }
      if (!empty($layout)) {
         $class[] = 'layout-' . $layout;
      }
      if (!empty($task)) {
         $class[] = 'task-' . $task;
      }
      if (!empty($itemid)) {
         $class[] = 'itemid-' . $itemid;
      }

      if (isset($menu) && $menu) {
         if ($menu->params->get('pageclass_sfx')) {
            $class[] = $menu->params->get('pageclass_sfx');
         }
      }

      if (!empty($language)) {
         $class[] = $language;
      }

      if (!empty($direction)) {
         $class[] = $direction;
      }

      if (!empty($body_class)) {
         $class[] = $body_class;
      }

      return implode(' ', $class);
   }

   public function loadLayout($partial = '', $display = true) {
      $this->setLog("Rending template partial : " . $partial);
      $layout = new JLayoutFile($partial, JPATH_SITE . '/templates/' . $this->template . '/frontend');
      if ($display) {
         echo $layout->render(['template' => $this]);
      } else {
         return $layout->render(['template' => $this]);
      }
      $this->setLog("Template partial rendered!: " . $partial, 'success');
   }

   public function setLog($message, $type = 'info', $data = []) {
      $this->logs[] = new AstroidLog($type, $message, $data);
   }

   public function renderLogs() {
      echo '<div id="astroid-debug" class="p-4 border" style="position: fixed;left: 0;bottom: 0;height: 50vh;width: 300px;background: #fff;overflow-y: auto;">';
      foreach ($this->logs as $log) {
         echo $log->render();
      }
      echo '</div>';
   }

}

class AstroidLog {

   protected $type;
   protected $message;
   protected $data;

   public function __construct($type, $message, $data) {
      $this->type = $type;
      $this->message = $message;
      $this->data = $data;
      $this->created = time();
   }

   public function render() {
      $class = $this->type == 'error' ? 'danger' : $this->type;
      echo '<p class="text-' . $class . '">' . $this->message . '</p>';
   }

}
