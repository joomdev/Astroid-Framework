<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_BASE') or die;
extract($displayData);
jimport('astroid.framework.helper');
jimport('astroid.framework.template');
jimport('astroid.framework.element');
jimport('astroid.framework.constants');

$application = JFactory::getApplication();
$document = JFactory::getDocument();
$config = JFactory::getConfig();

$atm = $application->input->get('atm', 0, 'INT');

if($atm){
   $joomla_url = JRoute::_('index.php?option=com_advancedtemplates&view=style&layout=edit&id=' . $id);
}else{
   $joomla_url = JRoute::_('index.php?option=com_templates&view=style&layout=edit&id=' . $id);
}
$save_url = JRoute::_('index.php?option=com_ajax&astroid=save&id=' . $id . '&template=' . $template->template);

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


$plugin = JPluginHelper::getPlugin('system', 'astroid');
$plugin_params = new JRegistry($plugin->params);
$astroid_manager_loader = $plugin_params->get('astroid_manager_loader', 1);
$astroid_shortcut_enable = $plugin_params->get('astroid_shortcut_enable', 1);
?>
<!DOCTYPE html>
<html lang="<?php echo strtolower($lang->getTag()); ?>" dir="<?php echo $langdir; ?>">
   <head>
      <meta charset="utf-8" />
      <meta name="generator" content="Astroid Framework | Template Manager" />
      <title><?php echo $template->title; ?></title>
      <link href="<?php echo $assets . 'images' . '/' . 'favicon.png'; ?>" rel="shortcut icon" type="image/vnd.microsoft.icon" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!--[if IE]><script src="<?php echo JURI::root(); ?>media/system/js/html5fallback.js?<?php echo $document->getMediaVersion(); ?>"></script><![endif]-->
      <!--[if IE]><script src="<?php echo JURI::root(); ?>media/system/js/polyfill.filter.js?<?php echo $document->getMediaVersion(); ?>"></script><![endif]-->
      <!--[if IE]><script src="<?php echo JURI::root(); ?>media/jui/js/html5.js?<?php echo $document->getMediaVersion(); ?>"></script><![endif]-->
      <script>
         var ASTROID_GRIDS = <?php echo \json_encode(AstroidFrameworkConstants::$layout_grids); ?>;
      </script>
      <script>
         var SITE_URL = '<?php echo JURI::root(); ?>';
         var BASE_URL = '<?php echo JURI::root(); ?>administrator/';
         var TEMPLATE_NAME = '<?php echo $template->template; ?>';
         var SYSTEM_FONTS = <?php echo json_encode(array_keys(AstroidFrameworkConstants::$system_fonts)); ?>;
         var LIBRARY_FONTS = <?php echo json_encode(array_keys(AstroidFrameworkHelper::getUploadedFonts($template->template))); ?>;
      </script>
      <style>
        .falling-astroid-container{position:fixed;width:100%;height:100%;top:0;left:0;background:rgba(0,0,0,.7)!important;z-index:9999999;transition:.2s linear}.falling-astroid{position:absolute;width:100%;height:100%;top:0;left:0;transform:rotate(-45deg)}.falling-astroid span{position:absolute;height:20%;width:2px;background:#999}.falling-astroid span:nth-child(1){left:20%;animation:lf .6s linear infinite;animation-delay:-5s}.falling-astroid span:nth-child(2){left:40%;animation:lf2 .8s linear infinite;animation-delay:-1s}.falling-astroid span:nth-child(3){left:60%;animation:lf3 .6s linear infinite}.falling-astroid span:nth-child(4){left:80%;animation:lf4 .5s linear infinite;animation-delay:-3s}@keyframes lf{0%{top:200%}to{top:-200%;opacity:0}}@keyframes lf2{0%{top:200%}to{top:-200%;opacity:0}}@keyframes lf3{0%{top:200%}to{top:-100%;opacity:0}}@keyframes lf4{0%{top:200%}to{top:-100%;opacity:0}}@keyframes fazer1{0%{top:0}to{top:-120px;opacity:0;transform:scale(.5)}}@keyframes fazer2{0%{top:0}to{top:-150px;opacity:0;transform:scale(.4)}}@keyframes fazer3{0%{top:0}to{top:-100px;opacity:0;transform:scale(.3)}}@keyframes fazer4{0%{top:0}to{top:-200px;opacity:0;transform:scale(.2)}}@keyframes speeder{0%,90%{transform:translate(2px,1px) rotate(0)}10%{transform:translate(-1px,-3px) rotate(-1deg)}20%{transform:translate(-2px) rotate(1deg)}30%{transform:translate(1px,2px) rotate(0)}40%{transform:translate(1px,-1px) rotate(1deg)}50%{transform:translate(-1px,3px) rotate(-1deg)}60%{transform:translate(-1px,1px) rotate(0)}70%{transform:translate(3px,1px) rotate(-1deg)}80%{transform:translate(-2px,-1px) rotate(1deg)}to{transform:translate(1px,-2px) rotate(-1deg)}}.falling-astroid-imgs{transform:rotate(-45deg);position:absolute;z-index:1;top:30px;left:10px}.falling-astroid-img{background:url(<?php echo JURI::root(); ?>media/astroid/assets/images/astroid/1.png) center no-repeat;background-size:contain!important;width:90px;height:90px}.falling-astroid-logo{animation:speeder .4s linear infinite;width:100px;height:100px;position:absolute;top:50%;left:50%;margin-left:-75px;margin-top:-75px}.falling-astroid-imgs span{position:absolute;background-size:contain!important}.falling-astroid-imgs span:nth-child(1){background:url(<?php echo JURI::root(); ?>media/astroid/assets/images/astroid/2.png) center no-repeat;width:40px;height:40px;left:-50px;animation:fazer1 .6s linear infinite}.falling-astroid-imgs span:nth-child(2){background:url(<?php echo JURI::root(); ?>media/astroid/assets/images/astroid/3.png) center no-repeat;width:35px;height:35px;left:40px;top:-40px;animation:fazer2 .4s linear infinite}.falling-astroid-imgs span:nth-child(3){background:url(<?php echo JURI::root(); ?>media/astroid/assets/images/astroid/4.png) center no-repeat;width:30px;height:30px;left:-10px;top:-40px;animation:fazer3 .4s linear infinite;animation-delay:-1s}.falling-astroid-imgs span:nth-child(4){background:url(<?php echo JURI::root(); ?>media/astroid/assets/images/astroid/3.png) center no-repeat;width:20px;height:20px;left:0;top:-80px;animation:fazer4 1s linear infinite;animation-delay:-1s}.falling-astroid-imgs span:nth-child(5){background:url(<?php echo JURI::root(); ?>media/astroid/assets/images/astroid/4.png) center no-repeat;width:20px;height:20px;left:-30px;top:-25px;animation:fazer1 .2s linear infinite}.falling-astroid-imgs span:nth-child(6){background:url(<?php echo JURI::root(); ?>media/astroid/assets/images/astroid/3.png) center no-repeat;width:10px;height:10px;left:-50px;top:-90px;animation:fazer4 1s linear infinite;animation-delay:-1s}.falling-astroid-imgs span:nth-child(7){background:url(<?php echo JURI::root(); ?>media/astroid/assets/images/astroid/4.png) center no-repeat;width:15px;height:15px;left:25px;top:-25px;transform:rotate(-45deg);animation:fazer2 .4s linear infinite}.falling-astroid-imgs span:nth-child(8){background:url(<?php echo JURI::root(); ?>media/astroid/assets/images/astroid/9.png) center no-repeat;width:10px;height:15px;left:-50px;top:-60px;animation:fazer3 .4s linear infinite;animation-delay:-1s}
      <?php
      foreach (AstroidFramework::$styles as $style) {
         echo $style;
      }
      ?>
      </style>
      <?php
      foreach ($stylesheets as $stylesheet) {
         echo '<link href="' . $stylesheet . '?' . $document->getMediaVersion() . '" type="text/css" rel="stylesheet" />';
      }
      foreach (AstroidFramework::$stylesheets as $stylesheet) {
         echo '<link href="' . $stylesheet . '?' . $document->getMediaVersion() . '" type="text/css" rel="stylesheet" />';
      }
      ?>
      <script>
         var TPL_ASTROID_NEW_FOLDER_NAME_LBL = "<?php echo JText::_('TPL_ASTROID_NEW_FOLDER_NAME_LBL'); ?>";
         var TPL_ASTROID_NEW_FOLDER_NAME_INVALID = "<?php echo JText::_('TPL_ASTROID_NEW_FOLDER_NAME_INVALID'); ?>";
      </script>
      <?php
      foreach (AstroidFramework::$javascripts['head'] as $script) {
         echo '<script src="' . $script . '?' . $document->getMediaVersion() . '"></script>';
      }
      ?>
      <script>
      <?php
         foreach (AstroidFramework::$scripts['head'] as $js) {
            echo $js;
         }
         ?>
      </script>
   </head>
   <body ng-app="astroid-framework" id="astroid-framework" ng-controller="astroidController">
      <input type="hidden" id="astroid-admin-token" value="<?php echo JSession::getFormToken(); ?>" />
      <?php if ($astroid_manager_loader) { ?>
         <div class="astroid-loading falling-astroid-container">
            <div class="falling-astroid-logo">
               <div class="falling-astroid-imgs">
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
               <div class="falling-astroid-img"></div>
            </div>
            <div class="falling-astroid">
               <span></span>
               <span></span>
               <span></span>
               <span></span>
            </div>
         </div>
      <?php } ?>
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
                     <!--<img width="80" src="<?php echo $assets . 'images' . '/' . 'icon-logo-dark.png'; ?>" /><div class="clearfix"></div>-->
                     <img style="vertical-align: baseline;" width="150" src="<?php echo $assets . 'images' . '/' . 'logo-dark-wide.png'; ?>" /> <span style="color: #8E2DE2;"><?php echo AstroidFrameworkConstants::$astroid_version; ?></span>
                  </div>
                  <!--<div class="astroid-version" style="text-align: center;width: 100%;">version <?php echo AstroidFrameworkConstants::$astroid_version; ?></div>-->
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
                        <i class="fa fa-download"></i>&nbsp;<?php echo JText::_('TPL_ASTROID_EXPORT'); ?>
                     </a>
                  </li>
                  <li class="nav-item row">
                     <a id="import-options" class="nav-link col-12" href="javascript:void(0);">
                        <i class="fa fa-upload"></i>&nbsp;<?php echo JText::_('TPL_ASTROID_IMPORT'); ?>
                     </a>
                  </li>
                  <li class="nav-item row showin-live-preview">
                     <a class="nav-link col-12" href="javascript:void(0);" onclick="Admin.closeLivePreview()">
                        <i class="fa fa-eye"></i>&nbsp;<?php echo JText::_('TPL_ASTROID_CLOSE_LIVEPREVIEW'); ?>
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
               <!--<nav class="astroid-manager-navbar navbar navbar-expand-lg navbar-light bg-white justify-content-between">
                  <div class="hidein-live-preview form-inline">
                     <a href="<?php echo $joomla_url; ?>" class="btn btn-white my-2 my-sm-0 btn-round"><i class="fab fa-joomla"></i> <?php echo JText::_('TPL_ASTROID_BACK_TO_JOOMLA'); ?></a>
                  </div>
                  <p class="hidein-live-preview navbar-brand m-0"><?php echo $template->title; ?></p>
                  <div class="form-inline">
                     <a href="javascript:void(0);" onclick="Admin.livePreview()" class="btn-live-preview btn btn-white my-2 mr-2 my-sm-0 btn-round hidein-live-preview d-none"><i class="fas fa-eye"></i>&nbsp;<?php echo JText::_('TPL_ASTROID_LIVEPREVIEW'); ?></a>
                  </div>
               </nav>-->
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
                                       echo '<h3 class="'.(!empty($group['description']) ? 'mb-0' : '').'">' . (!empty($group['icon']) ? '<i class="' . $group['icon'] . '"></i>&nbsp;' : '') . JText::_($group['title']) . '</h3>';
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
                                                         <?php echo str_replace('ng-media-class', 'ng-class', $field->input); ?>
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
            <div class="astroid-manager-navbar fixed-top m-0 row">
               <ul class="list-unstyled m-0 col-auto p-0">
                  <li class="float-left">
                     <button id="save-options" class="astroid-sidebar-btn align-items-center text-white" type="button"><div><i class="fa fa-save"></i><span><?php echo JText::_('JSAVE'); ?></span></div></button>
                     <a href="javascript:void(0);" id="saving-options" class="astroid-sidebar-btn align-items-center d-none"><div><i class="fa fa-circle-notch fa-spin"></i><span><?php echo JText::_('ASTROID_TEMPLATE_SAVING'); ?></span></div></a>
                  </li>
                  <li class="float-left">
                     <a id="clear-cache" href="javascript:void(0);" class="astroid-sidebar-btn align-items-center bg-light text-dark">
                        <div>
                           <i class="fa fa-eraser"></i>
                           <span><?php echo JText::_('ASTROID_TEMPLATE_CLEAR_CACHE'); ?></span>
                        </div>
                     </a>
                     <a id="clearing-cache" href="javascript:void(0);" class="astroid-sidebar-btn align-items-center bg-light text-dark d-none">
                        <div>
                           <i class="fa fa-circle-notch fa-spin"></i>
                           <span><?php echo JText::_('ASTROID_TEMPLATE_CLEARING_CACHE'); ?></span>
                        </div>
                     </a>
                  </li>
                  <li class="float-left">
                     <a href="<?php echo JURI::root(); ?>" target="_blank" class="astroid-sidebar-btn d-flex align-items-center bg-light text-dark"><div><i class="fa fa-external-link-alt"></i><span><?php echo JText::_('ASTROID_TEMPLATE_PREVIEW'); ?></span></div></a>
                  </li>
               </ul>
               <div class="col p-0 template-title"><?php echo $template->title; ?></div>
               <ul class="list-inline m-0 col-auto p-0">
                  <li class="float-left"><a title="<?php echo JText::_('TPL_ASTROID_BACK_TO_JOOMLA'); ?>" href="<?php echo $joomla_url; ?>" class="astroid-sidebar-btn astroid-back-btn d-flex align-items-center"><div><i class="fa fa-times"></i><span><?php echo JText::_('ASTROID_TEMPLATE_CLOSE'); ?></span></div></a></li>
               </ul>
               
            </div>
            <div id="astroid-preview-wrapper" class="col showin-live-preview">
               <div class="d-flex justify-content-center" style="margin: 10px 0px;">
                  <ul class="list-inline viewport-options">
                     <li class="list-inline-item"><a onclick="Admin.setPreviewViewport('desktop', this)" href="javascript:void(0);"><i class="fa fa-desktop"></i></a></li>
                     <li class="list-inline-item"><a onclick="Admin.setPreviewViewport('tablet portrait', this)" href="javascript:void(0);"><i class="fa fa-tablet-alt"></i></a></li>
                     <li class="list-inline-item"><a onclick="Admin.setPreviewViewport('mobile portrait', this)" href="javascript:void(0);"><i class="fa fa-mobile-alt"></i></a></li>
                  </ul>
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
               <button type="button" id="element-settings-save" class="btn btn-lg btn-wide btn-round btn-astroid"><?php echo JText::_('JSAVE'); ?></button>
            </div>
         </div>
      </div>
      <!-- Getting value from astroid plugin then JS is using to enable and disable Keyboard shortcut  -->
         <input type="hidden" id="astroid_shortcut_enable" value="<?php echo $astroid_shortcut_enable == '1'? 'true': 'false'; ?>">
       <!-- End  -->
      <?php
      $scripts = [];
      $scripts[] = $assets . 'vendor' . '/' . 'jquery' . '/' . 'jquery-3.2.1.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'jquery' . '/' . 'jquery.cookie.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'bootstrap' . '/' . 'popper.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'bootstrap' . '/' . 'bootstrap.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'spectrum' . '/' . 'spectrum.js?v=' . $document->getMediaVersion();
      $scripts[] = 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'dropzone' . '/' . 'dropzone.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'moment.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'moment-timezone.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'moment-timezone-with-data-2012-2022.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'bootstrap-datetimepicker.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'bootstrap-slider' . '/' . 'js' . '/' . 'bootstrap-slider.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'angular' . '/' . 'angular.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'angular' . '/' . 'angular-animate.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'angular' . '/' . 'sortable.min.js?v=' . $document->getMediaVersion();
      $scripts[] = $assets . 'vendor' . '/' . 'angular' . '/' . 'angular-legacy-sortable.js?v=' . $document->getMediaVersion();
      foreach ($scripts as $script) {
         echo "<script src='" . $script . "'></script>";
      }
      ?>
      <script>
         var TIMEZONE = '<?php echo $config = JFactory::getConfig()->get('offset'); ?>';
         moment.tz.setDefault('<?php echo $config = JFactory::getConfig()->get('offset'); ?>');
      </script>
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
      <script src="<?php echo $assets . 'js' . '/' . 'astroid.min.js?v=' . $document->getMediaVersion(); ?>"></script>
      <?php
$screen_sizes = [
    'xs' => [
        'label' => 'Extra small',
        'info' => '<576px'
    ],
    'sm' => [
        'label' => 'Small',
        'info' => '&#8805;576px'
    ],
    'md' => [
        'label' => 'Medium',
        'info' => '&#8805;768px'
    ],
    'lg' => [
        'label' => 'Large',
        'info' => '&#8805;992px'
    ],
    'xl' => [
        'label' => 'Extra large',
        'info' => '&#8805;1200px'
    ],
];

$column_sizes = ['inherit', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
?>
<script type="text/ng-template" id="column-responsive-field-template">
   <table class="table table-bordered"><tr><th width="30%"></th><th class="" width="30%"><?php echo JText::_('ASTROID_COLUMN_SIZE_LABEL'); ?></th><th class="" width="30%"><?php echo JText::_('TPL_ASTROID_VISIBILITY_LABEL'); ?></th></tr><?php foreach ($screen_sizes as $key => $screen_size) { ?><tr><td class=""><p class="mb-0 h4 font-weight-normal"><strong><?php echo $screen_size['label']; ?></strong></p><p class="text-muted mb-0"><code><?php echo $screen_size['info']; ?></code></p></td><td class="align-middle"><select <?php echo ($key=="lg" ? 'readonly disabled' : ''); ?> data-name="size_<?php echo $key; ?>" class="responsive-field form-control"><?php foreach ($column_sizes as $column_size) { ?><option<?php echo $column_size == 'inherit' ? ' selected' : ''; ?> value="<?php echo $column_size; ?>"><?php echo (($column_size == 'inherit' || $column_size == 'col') ? '' : 'col-'.$key.'-' ) . $column_size; ?></option><?php } ?></select></td><td class="align-middle"><div class="jd-ui"><div class="d-inline-block"><input checked type="checkbox" data-name="hide_<?php echo $key; ?>" id="visible-<?php echo $key; ?>" class="responsive-field jd-switch" /><label class="jd-switch-btn m-0" for="visible-<?php echo $key; ?>"></label></div></div></td></tr><?php } ?></table>
</script>
   
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
      <?php
      foreach (AstroidFramework::$javascripts['body'] as $script) {
         echo '<script src="' . $script . '?' . $document->getMediaVersion() . '"></script>';
      }
      ?>
      <script>
         <?php
         foreach (AstroidFramework::$scripts['body'] as $js) {
            echo $js;
         }
         ?>
      </script>
      <a href="#" class="d-none" data-template-name="<?php echo JFilterOutput::stringURLSafe($template->title); ?>" id="export-link">Export Settings</a>
   </body>
</html>