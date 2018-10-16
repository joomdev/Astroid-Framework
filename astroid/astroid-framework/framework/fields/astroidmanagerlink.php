<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_PLATFORM') or die;
jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Platform.
 *
 * Provides a pop up date picker linked to a button.
 * Optionally may be filtered to use user's or server's time zone.
 *
 * @since  11.1
 */
class JFormFieldAstroidManagerLink extends JFormField {

   /**
    * The form field type.
    *
    * @var    string
    * @since  11.1
    */
   protected $type = 'AstroidManagerLink';

   protected function getLabel() {
      return FALSE;
   }

   /**
    * Method to get the field input markup.
    *
    * @return  string  The field input markup.
    *
    * @since   11.1
    */
   protected function getInput() {
      $app = JFactory::getApplication();
      $id = (int) $app->input->get('id', 0, 'INT');
      $option = $app->input->get('option', '');
      $params = [];
      $params[] = "option=com_ajax";
      $params[] = "astroid=manager";
      $params[] = "id=" . $id;
      if ($option == 'com_advancedtemplates') {
         $params[] = "atm=1";
      }
      $url = JRoute::_('index.php?' . implode('&', $params));

      $document = JFactory::getDocument();
      $document->addStyleDeclaration('.item:hover,ul.item-list li a{color:#000;text-decoration:none}.main-container{display:block;width:100%}.astroid-banner-wrap{margin:0 auto;width:100%;overflow:hidden;padding:5rem;box-sizing: border-box;}.astroid-banner-intro{float:left;width:60%}.astroid-banner-img{float:left;width:40%}.astroid-banner-img .img-fluid{max-width:100%;height:100%;width:100%}.intro-wrap .w-100{padding-top:2rem}.item{color:#000}ul.item-list{margin:0;padding:0;}ul.item-list li{display:inline-block;margin-right:10px}ul.item-list li a:hover{color: #8E2DE2}a.astroidlink{background: rgba(0, 0, 0, 0) linear-gradient(to right, #8E2DE2, #4A00E0) repeat scroll 0 0; transition: linear 0.1s; color:#fff;padding:20px 40px;margin-top:22px;font-size:15px;border-radius:50px;font-weight: bold;display:inline-block;text-decoration:none;box-shadow:0px 0px 30px #b0b7e2;}a.astroidlink:hover{transition: linear 0.1s;box-shadow:0px 0px 30px #4b57d9;}@media screen and (max-width:1300px){.astroid-banner-img{display:none}.astroid-banner-wrap{padding:20px;width:auto}.astroid-banner-intro{width:100%}}.form-horizontal .controls{ margin-left: 0px;}hr{display: none;}');


      return '<div style="border: 1px solid #f8f8f8;background:url(' . JURI::root() . 'media/astroid/assets/images/moon-surface.png); background-repeat: no-repeat; background-position: bottom;" class="main-container"><div class="astroid-banner-wrap"><div class="astroid-banner-intro"><h1 style="font-size: 30px;line-height: 1.5;margin-bottom: 18px;">' . JText::_('ASTROID_TEMPLATE_OPTIONS_TITLE') . '</h1><p style="font-size: 16px;line-height: 1.7;font-weight: normal;">' . JText::_('ASTROID_TEMPLATE_OPTIONS_DESC') . '</p><div class="intro-wrap"><div class="w-100"><div class="control-group"><div class="controls"><a class="astroidlink" href="' . $url . '">' . JText::_('ASTROID_TEMPLATE_OPTIONS') . '</a><input value="19" name="jform[params][astroid]" type="hidden"></div></div></div><div class="w-100"><ul class="item-list p-0 my-5 my-md-0 my-lg-0"><li><a class="item" target="_blank" href="' . AstroidFrameworkConstants::$forum_link . '">' . JText::_('ASTROID_SUPPORT_LBL') . '</a></li><li style="vertical-align: text-bottom;line-height: 25px;font-size: 20px;"><strong>.</strong></li><li><a class="item" target="_blank" href="' . AstroidFrameworkConstants::$documentation_link . '">' . JText::_('ASTROID_DOCUMENTATION_LBL') . '</a></li><li style="vertical-align: text-bottom;line-height: 25px;font-size: 20px;"><strong>.</strong></li><li><a class="item" target="_blank" href="' . AstroidFrameworkConstants::$joomdev_templates_link . '">' . JText::_('ASTROID_TEMPLATES_LBL') . '</a></li></ul></div></div></div><div class="astroid-banner-img"><img class="img-fluid" src="' . JURI::root() . 'media/astroid/assets/images/astronaut.png"></div></div></div><input type="hidden" value="' . $id . '" name="' . $this->name . '" />';
   }

}
