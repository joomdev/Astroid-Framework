<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_BASE') or die;
jimport('astroid.framework.helper');
jimport('astroid.framework.template');
jimport('astroid.framework.element');
jimport('astroid.framework.constants');

$application = JFactory::getApplication();
$document = JFactory::getDocument();
$config = JFactory::getConfig();

$id = $application->input->get('id', NULL, 'INT');

$joomla_url = JRoute::_('index.php?option=com_templates&view=style&layout=edit&id=' . $id);
$save_url = JRoute::_('index.php?option=com_ajax&astroid=save&id=' . $id);

$template = AstroidFrameworkHelper::getTemplateById($id);

if (empty($template)) {
   $application->redirect('index.php?option=com_templates');
}

$params = \json_decode($template->params);

if (empty($params)) {
   $params = [];
}

$lang = JFactory::getLanguage();
$langdir = $lang->get('rtl') ? 'rtl' : 'ltr';
$assets = JURI::root() . 'media' . '/' . 'astroid' . '/' . 'assets' . '/';
$semanticComponents = ['icon', 'transition', 'api', 'dropdown'];


// adding styles
$stylesheets = [];
$stylesheets[] = 'https://fonts.googleapis.com/css?family=Nunito:300,400,600';
$stylesheets[] = 'https://use.fontawesome.com/releases/v' . AstroidFrameworkConstants::$fontawesome_version . '/css/all.css';

foreach ($semanticComponents as $semanticComponent) {
   $semanticComponentPath = 'vendor' . '/' . 'semantic-ui' . '/' . 'components' . '/' . $semanticComponent . '.min.css';
   if (file_exists(JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . $semanticComponentPath)) {
      $stylesheets[] = $assets . $semanticComponentPath . '?v=' . $document->getMediaVersion();
   }
}

$stylesheets[] = $assets . 'css' . '/' . 'astroid-framework.css?v=' . $document->getMediaVersion();
$stylesheets[] = $assets . 'css' . '/' . 'admin.css?v=' . $document->getMediaVersion();
$stylesheets[] = $assets . 'css' . '/' . 'animate.min.css?v=' . $document->getMediaVersion();
// getting form

$form = new JForm('template');
$form_dir = JPATH_LIBRARIES . '/' . 'astroid' . '/' . 'framework' . '/' . 'options';
$forms = array_filter(glob($form_dir . '/' . '*.xml'), 'is_file');
JForm::addFormPath($form_dir);
foreach ($forms as $fname) {
   $fname = pathinfo($fname)['filename'];
   $form->loadFile($fname, false);
}

$template_form_dir = JPATH_SITE . '/' . 'templates' . '/' . $template->template . '/' . 'astroid' . '/' . 'options';
$template_forms = array_filter(glob($template_form_dir . '/' . '*.xml'), 'is_file');
JForm::addFormPath($template_form_dir);
foreach ($template_forms as $fname) {
   $fname = pathinfo($fname)['filename'];
   $form->loadFile($fname, false);
}


$fieldsets = AstroidFrameworkHelper::getAstroidFieldsets($form);

foreach ($params as $key => $value) {
   $form->setValue($key, 'params', $value);
}
?>
<!DOCTYPE html>
<html lang="<?php echo strtolower($lang->getTag()); ?>" dir="<?php echo $langdir; ?>">
   <head>
      <meta charset="utf-8" />
      <meta name="generator" content="Astroid Framework | Template Manager" />
      <title><?php echo $template->title; ?></title>
      <link href="<?php echo $assets . 'images' . '/' . 'favicon.png'; ?>" rel="shortcut icon" type="image/vnd.microsoft.icon" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script>
         var ASTROID_GRIDS = <?php echo \json_encode(AstroidFrameworkConstants::$layout_grids); ?>;
      </script>
      <?php
      foreach ($stylesheets as $stylesheet) {
         echo '<link href="' . $stylesheet . '" type="text/css" rel="stylesheet" />';
      }
      ?>
      <?php
      $scripts = [];
      $scripts[] = $assets . 'vendor' . '/' . 'jquery' . '/' . 'jquery-3.2.1.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'jquery' . '/' . 'jquery.cookie.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'bootstrap' . '/' . 'popper.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'bootstrap' . '/' . 'bootstrap.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'spectrum' . '/' . 'spectrum.js?v=' . $document->getMediaVersion();
      $scripts[] = 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'dropzone' . '/' . 'dropzone.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'js' . '/' . 'bootstrap-datepicker.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'bootstrap-slider' . '/' . 'js' . '/' . 'bootstrap-slider.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'angular' . '/' . 'angular.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'angular' . '/' . 'angular-animate.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'angular' . '/' . 'sortable.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'angular' . '/' . 'angular-legacy-sortable.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'js' . '/' . 'astroid-framework.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'angular' . '/' . 'ezlb.js?v=' . $document->getMediaVersion();
      foreach ($scripts as $script) {
         echo "<script src='" . $script . "'></script>";
      }
      ?>
      <script>
         var SITE_URL = '<?php echo JURI::root(); ?>';
         var BASE_URL = '<?php echo JURI::root(); ?>administrator/';
         var TEMPLATE_NAME = '<?php echo $template->template; ?>';
         var SYSTEM_FONTS = <?php echo json_encode(array_keys(AstroidFrameworkConstants::$system_fonts)); ?>;
      </script>
   </head>
   <body ng-app="astroid-framework" ng-controller="astroidController">
      <input type="hidden" id="astroid-admin-token" value="<?php echo JSession::getFormToken(); ?>" />
      <div class="astroid-loading" style="position: fixed;width: 100%;height: 100%;background: rgba(195, 195, 195, 0.9) url('<?php echo JURI::root() . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'images' . '/' . 'astroid.gif'; ?>') no-repeat center;z-index: 9999999;top: 0;left: 0;"></div>
      <!--<nav class="astroid-manager-navbar navbar fixed-top navbar-expand-lg navbar-light bg-white justify-content-between">
         <a class="navbar-brand" href="#"><img src="<?php echo JURI::root() . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . 'images' . '/' . 'favicon.png'; ?>" width="28" height="28" class="d-inline-block align-top" alt=""> Astroid Framework</a>
         <div class="form-inline">
            <button id="save-options" class="btn btn-success my-2 my-sm-0" type="button"><i class="fa fa-save"></i>&nbsp;<?php echo JText::_('JSAVE'); ?></button>
            <button id="saving-options" class="btn btn-blue disabled my-2 my-sm-0 d-none" type="button"><i class="fa fa-circle-notch fa-spin"></i>&nbsp;<?php echo JText::_('ASTROID_TEMPLATE_SAVING'); ?></button>
            <a href="<?php echo $joomla_url; ?>" class="btn btn-link my-2 my-sm-0 text-white"><i class="fab fa-joomla"></i></a>
         </div>
      </nav>-->
      <div id="astroid-wrapper" class="container-fluid">
         <div id="astroid-manager-disabled"></div>
         <div class="row">
            <div id="astroid-sidebar-wrapper" class="col">
               <div class="astroid-logo text-center row">
                  <div class="logo-image">
                     <img width="80" src="<?php echo $assets . 'images' . '/' . 'icon-logo-dark.png'; ?>" /><div class="clearfix"></div>
                     <img width="110" src="<?php echo $assets . 'images' . '/' . 'logo-dark-wide.png'; ?>" />
                  </div>
                  <div class="astroid-version" style="text-align: center;width: 100%;">version <?php echo AstroidFrameworkConstants::$astroid_version; ?></div>
               </div>
               <div class="astroid-logo text-center row d-none">
                  <div class="logo-image">
                     <img width="40" src="<?php echo $assets . 'images' . '/' . 'icon-logo-dark.png'; ?>" />
                     <div class="d-inline ml-2">
                     <img width="110" src="<?php echo $assets . 'images' . '/' . 'logo-dark-wide.png'; ?>" />
                     <div class="clearfix"></div>
                     <small style="position: relative;top: -12px;margin-left: 128px;" class="astroid-version">v <?php echo AstroidFrameworkConstants::$astroid_version; ?></small>
                     </div>
                  </div>
               </div>
               <ul id="astroid-menu" class="nav flex-column sidebar-nav" role="tablist">
                  <?php $active = false; ?>
                  <?php foreach ($fieldsets as $key => $fieldset) { ?>
                     <?php $fields = $form->getFieldset($key); ?>
                     <?php
                     $groups = [];
                     foreach ($fields as $key => $field) {
                        if ($field->type == 'astroidgroup') {
                           $groups[$field->fieldname] = ['title' => JText::_($field->getAttribute('title', '')), 'icon' => $field->getAttribute('icon', '')];
                        }
                     }
                     ?>
                     <li class="nav-item row<?php echo!empty($groups) ? ' has-child' : ''; ?>">
                        <a data-toggle="tab" id="<?php echo $fieldset->name; ?>-astroid-tab" class="nav-link<?php echo $active ? ' active' : ''; ?> col-12" data-target="#astroid-tab-<?php echo $fieldset->name; ?>" href="javascript:void(0);" role="tab" aria-controls="astroid-tab-<?php echo $fieldset->name; ?>" aria-selected="<?php echo $active ? 'true' : 'false'; ?>">
                           <?php if (!empty($fieldset->icon)) { ?>
                              <i class="<?php echo $fieldset->icon; ?>"></i>&nbsp;
                           <?php } ?>
                           <?php echo JText::_($fieldset->label); ?>
                        </a>
                        <?php if (!empty($groups)) { ?>
                           <ul id="fieldset-groupmenu-<?php echo $fieldset->name; ?>" class="nav flex-column sidebar-submenu">
                              <?php foreach ($groups as $groupname => $group) { ?>
                                 <li class="nav-item"><a class="nav-link hash-link" href="#astroid-form-fieldset-section-<?php echo $groupname; ?>"><?php echo!empty($group['icon']) ? '<i class="' . $group['icon'] . '"></i>&nbsp;' : ''; ?><?php echo $group['title']; ?></a></li>
                              <?php } ?>
                           </ul>
                        <?php } ?>
                     </li>
                     <?php $active = false; ?>
                  <?php } ?>
                     <li class="nav-item row">
                        <a id="export-options" class="nav-link col-12" href="javascript:void(0);">
                           <i class="fa fa-download"></i>&nbsp;<?php echo JText::_('Export'); ?>
                        </a>
                     </li>
                     <li class="nav-item row">
                        <a id="import-options" class="nav-link col-12" href="javascript:void(0);">
                           <i class="fa fa-upload"></i>&nbsp;<?php echo JText::_('Import'); ?>
                        </a>
                     </li>
                     <li class="nav-item row showin-live-preview">
                        <a class="nav-link col-12" href="javascript:void(0);" onclick="Admin.closeLivePreview()">
                           <i class="fa fa-eye"></i>&nbsp;<?php echo JText::_('Close Live Preview'); ?>
                        </a>
                     </li>
                     <li class="nav-item row showin-live-preview">
                        <a class="nav-link col-12" href="<?php echo $joomla_url; ?>">
                           <i class="fab fa-joomla"></i>&nbsp;<?php echo JText::_('TPL_ASTROID_BACK_TO_JOOMLA'); ?>
                        </a>
                     </li>
               </ul>
            </div>
            <div id="astroid-content-wrapper" class="col">
               <nav class="astroid-manager-navbar navbar navbar-expand-lg navbar-light bg-white justify-content-between">
                  <div class="hidein-live-preview form-inline">
                     <a href="<?php echo $joomla_url; ?>" class="btn btn-white my-2 my-sm-0 btn-round"><i class="fab fa-joomla"></i> <?php echo JText::_('TPL_ASTROID_BACK_TO_JOOMLA'); ?></a>
                  </div>
                  <p class="hidein-live-preview navbar-brand m-0"><?php echo $template->title; ?></p>
                  <div class="form-inline">
                     <a href="javascript:void(0);" onclick="Admin.livePreview()" class="btn-live-preview btn btn-white my-2 mr-2 my-sm-0 btn-round hidein-live-preview d-none"><i class="fas fa-eye"></i>&nbsp;<?php echo JText::_('Live Preview'); ?></a>
                     <a href="<?php echo JURI::root(); ?>" target="_blank" class="btn btn-white my-2 mr-2 my-sm-0 btn-round hidein-live-preview"><i class="fas fa-external-link-alt"></i>&nbsp;<?php echo JText::_('ASTROID_TEMPLATE_PREVIEW'); ?></a>
                     <button id="clear-cache" class="btn btn-secondary my-2 mr-2 my-sm-0 btn-round btn-wide" type="button"><i class="fa fa-eraser"></i>&nbsp;<?php echo JText::_('ASTROID_TEMPLATE_CLEAR_CACHE'); ?></button>
                     <button id="clearing-cache" class="btn disabled btn-secondary my-2 mr-2 my-sm-0 btn-round btn-wide d-none" type="button"><i class="fa fa-circle-notch fa-spin"></i>&nbsp;<?php echo JText::_('ASTROID_TEMPLATE_CLEARING_CACHE'); ?></button>
                     <button id="save-options" class="btn btn-success my-2 my-sm-0 btn-round btn-wide" type="button"><i class="fa fa-save"></i>&nbsp;<?php echo JText::_('JSAVE'); ?></button>
                     <button id="saving-options" class="btn btn-blue disabled my-2 my-sm-0 btn-round btn-wide d-none" type="button"><i class="fa fa-circle-notch fa-spin"></i>&nbsp;<?php echo JText::_('ASTROID_TEMPLATE_SAVING'); ?></button>
                  </div>
               </nav>
               <div class="container-fluid">
                  <input type="file" accept=".json" id="astroid-settings-import" class="d-none" />
                  <form id="astroid-form" action="<?php echo $save_url; ?>" method="POST">
                     <?php echo JHtml::_('form.token'); ?>
                     <input type="hidden" id="export-form" name="export_settings" value="0" />
                     <div class="tab-content">
                        <div class="live-preview-toolbar">
                           <span onclick="Admin.showOptions()" class="btn btn-round btn-wide btn-white"><i class="fa fa-chevron-left"></i> Back</span>
                        </div>
                        <?php $active = false; ?>
                        <?php foreach ($fieldsets as $key => $fieldset) { ?>
                           <div class="astroid-tab-pane tab-pane<?php echo $active ? ' active' : ''; ?>" id="astroid-tab-<?php echo $fieldset->name; ?>" role="tabpanel" aria-labelledby="<?php echo $fieldset->name; ?>-astroid-tab" astroid-type="<?php echo isset($fieldset->astroidtype) ? $fieldset->astroidtype : ''; ?>">
                              <?php $fields = $form->getFieldset($key); ?>
                              <?php
                              $groups = [];
                              foreach ($fields as $key => $field) {
                                 if ($field->type == 'astroidgroup') {
                                    $groups[$field->fieldname] = ['title' => $field->getAttribute('title', ''), 'icon' => $field->getAttribute('icon', ''), 'description' => $field->getAttribute('description', ''), 'fields' => []];
                                 }
                              }
                              $groups['none'] = ['fields' => []];


                              foreach ($fields as $key => $field) {
                                 if ($field->type == 'astroidgroup') {
                                    continue;
                                 }
                                 $field_group = $field->getAttribute('astroidgroup', 'none');
                                 $groups[$field_group]['fields'][] = $field;
                              }

                              foreach ($groups as $groupname => $group) {
                                 if (empty($group['fields'])) {
                                    continue;
                                 }
                                 ?>
                                 <div style="padding-top:20px" id="astroid-form-fieldset-section-<?php echo $groupname; ?>">
                                    <?php
                                    if (!empty($group['title']) && !empty($group['fields'])) {
                                       echo '<h3>' . (!empty($group['icon']) ? '<i class="' . $group['icon'] . '"></i>&nbsp;' : '') . JText::_($group['title']) . '</h3>';
                                       if (!empty($group['description'])) {
                                          echo '<p><small>' . JText::_($group['description']) . '</small></p>';
                                       }
                                    }
                                    ?>
                                    <div class="astroid-form-fieldset-section<?php echo!empty($group['title']) ? ' labeled' : ' non-labeled'; ?>">
                                       <?php
                                       foreach ($group['fields'] as $field) {
                                          if ($field->type == 'astroidgroup') {
                                             continue;
                                          }
                                          if ($field->type == 'layout' || $field->type == 'astroidheading' || $field->type == 'Hidden') {
                                             echo $field->input;
                                          } else {
                                             $ngHide = AstroidFrameworkHelper::replaceRelationshipOperators($field->getAttribute('ngHide'));
                                             $ngShow = AstroidFrameworkHelper::replaceRelationshipOperators($field->getAttribute('ngShow'));
                                             ?>
                                             <div<?php echo!empty($ngHide) ? ' ng-hide="' . $ngHide . '"' : ''; ?><?php echo!empty($ngShow) ? ' ng-show="' . $ngShow . '"' : ''; ?> class="form-group">
                                                <div class="row">
                                                   <?php if ($field->label !== false) { ?>
                                                      <div class="col-sm-5">
                                                         <label for="<?php echo $field->id; ?>" class="astroid-label"><?php echo strip_tags($field->label); ?></label>
                                                         <?php if (!empty($field->getAttribute('description'))) { ?>
                                                            <div class="help-block">
                                                               <?php echo JText::_($field->getAttribute('description')); ?>
                                                            </div>
                                                         <?php } ?>
                                                      </div>
                                                      <div class="col-sm-7" data-fieldset="astroid-tab-<?php echo $fieldset->name; ?>">
                                                         <?php echo $field->input; ?>
                                                      </div>
                                                   <?php } else { ?>
                                                      <div class="col-sm-12" data-fieldset="astroid-tab-<?php echo $fieldset->name; ?>">
                                                         <?php echo $field->input; ?>
                                                      </div>
                                                      <div class="col-sm-12">
                                                         <?php if (!empty($field->getAttribute('description'))) { ?>
                                                            <div class="help-block">
                                                               <?php echo JText::_($field->getAttribute('description')); ?>
                                                            </div>
                                                         <?php } ?>
                                                      </div>
                                                   <?php } ?>
                                                </div>
                                             </div>
                                          <?php } ?>
                                       <?php } ?>
                                    </div>
                                 </div>
                              <?php } ?>
                           </div>
                           <?php $active = false; ?>
                        <?php } ?>
                     </div>
                  </form>
               </div>
            </div>
            <div id="astroid-preview-wrapper" class="col showin-live-preview">
               <div class="d-flex justify-content-center" style="margin: 10px 0px;">
                  <ul class="list-inline viewport-options">
                     <li class="list-inline-item"><a onclick="Admin.setPreviewViewport('desktop', this)" href="javascript:void(0);"><i class="fa fa-desktop"></i></a></li>
                     <li class="list-inline-item"><a onclick="Admin.setPreviewViewport('tablet portrait', this)" href="javascript:void(0);"><i class="fa fa-tablet-alt"></i></a></li>
                     <li class="list-inline-item"><a onclick="Admin.setPreviewViewport('mobile portrait', this)" href="javascript:void(0);"><i class="fa fa-mobile-alt"></i></a></li>
                  </ul>
               </div>
               <div class="d-flex justify-content-center" style="height: calc(100% - (56px + 1rem));">
                  <div id="live-preview-viewport" class="desktop">
                     <iframe id="live-preview" src="<?php echo JURI::root(); ?>"></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="ezlb-pop" id="element-settings">
         <div class="ezlb-pop-overlay"></div>
         <div class="ezlb-pop-body">
            <div class="astroid-ring-loading"></div>
            <div id="element-settings-form" ng-bind-html="elementFormContent"></div>
            <div class="ezlb-pop-footer text-right">
               <button type="button" id="element-settings-save" class="btn btn-dark"><?php echo JText::_('JSAVE'); ?></button>
            </div>
         </div>
      </div>

      <script src="<?php echo $assets . 'js' . '/' . 'parsley.min.js?v=' . $document->getMediaVersion(); ?>"></script>
      <script src="<?php echo $assets . 'js' . '/' . 'notify.min.js?v=' . $document->getMediaVersion(); ?>"></script>
      <script src="<?php echo $assets . 'js' . '/' . 'jquery.hotkeys.js?v=' . $document->getMediaVersion(); ?>"></script>
      <script src="<?php echo $assets . 'js' . '/' . 'jquery.nicescroll.min.js?v=' . $document->getMediaVersion(); ?>"></script>
      <?php
      foreach ($semanticComponents as $semanticComponent) {
         $semanticComponentPath = 'vendor' . '/' . 'semantic-ui' . '/' . 'components' . '/' . $semanticComponent . '.min.js';
         if (file_exists(JPATH_SITE . '/' . 'media' . '/' . 'astroid' . '/' . 'assets' . '/' . $semanticComponentPath)) {
            echo "<script src='" . $assets . $semanticComponentPath . '?v=' . $document->getMediaVersion() . "'></script>";
         }
      }
      ?>
      <script src="<?php echo $assets . 'js' . '/' . 'astroid.js?v=' . $document->getMediaVersion(); ?>"></script>
      <script type="text/javascript">
      astroidFramework.controller('astroidController', function ($scope) {
            <?php foreach ($fieldsets as $key => $fieldset) { ?>
                  <?php $fields = $form->getFieldset($key); ?>
                  <?php
                  foreach ($fields as $key => $field) {
                        if (strtolower($field->type) == "astroidtextarea" || $field->type == "astroidheading") {
                        continue;
                        }
                        if (is_string($field->value)) {
                        $value = "'" . addslashes($field->value) . "'";
                        } elseif (is_array($field->value)) {
                        $value = \json_encode($value);
                        } elseif (is_object($field->value)) {
                        $value = \json_encode($field->value);
                        } else {
                        $value = $field->value;
                        }
                        echo '$scope.' . $field->fieldname . ' = ' . $value . ';';
                        if ($field->type == "layout") {
                        echo '$scope.layoutfield = "' . $field->fieldname . '";';
                        }
                  }
                  ?>
            <?php } ?>
      });
      </script>
   </body>
</html>