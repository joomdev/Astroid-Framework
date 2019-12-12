<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
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

   public function getJoomlaVersion() {
      $version = new \JVersion;
      $version = $version->getShortVersion();
      $version = substr($version, 0, 1);
      define('ASTROID_JOOMLA_VERSION', $version);
   }
   /*
   * Function to parse the current template XML and get all the info
   * We are just using date and version for now but can use the rest of the info as well if needed.
   */
   public function getTemplateVersion() {
	   $input = JFactory::getApplication()->input;
	   if($input->getCmd('option') == 'com_templates' &&
		   (preg_match('/style\./', $input->getCmd('task')) || $input->getCmd('view') == 'style' || $input->getCmd('view') == 'template')
	   ){
		   $db = JFactory::getDBO();
		   $query = $db->getQuery(true);
		   $id = $input->getInt('id');

		   //when in POST the view parameter does not set
		   if ($input->getCmd('view') == 'template') {
			   $query
				   ->select('element')
				   ->from('#__extensions')
				   ->where('extension_id='.(int)$id . ' AND type=' . $db->quote('template'));
		   } else {
			   $query
				   ->select('template')
				   ->from('#__template_styles')
				   ->where('id='.(int)$id);
		   }

		   $db->setQuery($query);
		   $tplname = $db->loadResult();
	   } else {
		   return null;
	   }
	   if ($tplname) {
		   // parse xml
		   $filePath = JPath::clean(JPATH_ROOT.'/templates/'.$tplname.'/templateDetails.xml');
		   if (file_exists($filePath)) return JFactory::getXML($filePath);
	   } else {
	   	   return null;
	   }
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
	  $xml  =   $this->getTemplateVersion();
      $document = JFactory::getDocument();
      $document->addStyleDeclaration('.item:hover,ul.item-list li a{color:#000;text-decoration:none}.main-container{display:block;width:100%}.astroid-banner-wrap{margin:0 auto;width:100%;overflow:hidden;padding:5rem;box-sizing: border-box;}.astroid-banner-intro{float:left;width:60%}.astroid-banner-img{float:left;width:40%}.astroid-banner-img .img-fluid{max-width:100%;height:100%;width:100%}.intro-wrap .w-100{padding-top:2rem}.item{color:#000}ul.item-list{margin:0;padding:0;}ul.item-list li{display:inline-block;margin-right:10px}ul.item-list li a:hover{color: #8E2DE2}a.astroidlink{background: rgba(0, 0, 0, 0) linear-gradient(to right, #8E2DE2, #4A00E0) repeat scroll 0 0; transition: linear 0.1s; color:#fff;padding:20px 40px;margin-top:22px;font-size:15px;border-radius:50px;font-weight: bold;display:inline-block;text-decoration:none;box-shadow:0px 0px 30px #b0b7e2;}a.astroidlink:hover{transition: linear 0.1s;box-shadow:0px 0px 30px #4b57d9;}@media screen and (max-width:1300px){.astroid-banner-img{display:none}.astroid-banner-wrap{padding:20px;width:auto}.astroid-banner-intro{width:100%}}.form-horizontal .controls{ margin-left: 0px;}.control-group .controls{ margin-left: 0px;}hr{display: none;}');


      return '<div style="border: 1px solid #f8f8f8;background:url(' . JURI::root() . 'media/astroid/assets/images/moon-surface.png); background-repeat: no-repeat; background-position: bottom;" class="main-container"><div class="astroid-banner-wrap"><div class="astroid-banner-intro"><h1 style="font-size: 30px;line-height: 1.5;margin-bottom: 18px;">' . JText::_('ASTROID_TEMPLATE_OPTIONS_TITLE') . '</h1><p>Version <strong>'.$xml->version.'</strong><br> Last Updated: <strong>'.$xml->creationDate.'</strong></p><p style="font-size: 16px;line-height: 1.7;font-weight: normal;">' . JText::_('ASTROID_TEMPLATE_OPTIONS_DESC') . '</p><div class="intro-wrap"><div class="w-100"><div class="control-group"><div class="controls"><a class="astroidlink" href="' . $url . '">' . JText::_('ASTROID_TEMPLATE_OPTIONS') . '</a><input value="19" name="jform[params][astroid]" type="hidden"></div></div></div><div class="w-100"><ul class="item-list p-0 my-5 my-md-0 my-lg-0"><li><a class="item" target="_blank" href="' . AstroidFrameworkConstants::$forum_link . '">' . JText::_('ASTROID_SUPPORT_LBL') . '</a></li><li style="vertical-align: text-bottom;line-height: 25px;font-size: 20px;"><strong>.</strong></li><li><a class="item" target="_blank" href="' . AstroidFrameworkConstants::$documentation_link . '">' . JText::_('ASTROID_DOCUMENTATION_LBL') . '</a></li><li style="vertical-align: text-bottom;line-height: 25px;font-size: 20px;"><strong>.</strong></li><li><a class="item" target="_blank" href="' . AstroidFrameworkConstants::$video_tutorial_link . '">' . JText::_('ASTROID_VIDEO_TUTORIAL') . '</a></li><li style="vertical-align: text-bottom;line-height: 25px;font-size: 20px;"><strong>.</strong></li><li><a class="item" target="_blank" href="' . AstroidFrameworkConstants::$joomdev_templates_link . '">' . JText::_('ASTROID_TEMPLATES_LBL') . '</a></li><li style="vertical-align: text-bottom;line-height: 25px;font-size: 20px;"><strong>.</strong></li><li><a class="item" target="_blank" href="' . AstroidFrameworkConstants::$jd_builder_link . '"> <img src="data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABkAAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkRERDU1MzI1QUM2RTExRTlCMjE1RDY2MDk3RjU1NjJBIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkRERDU1MzI2QUM2RTExRTlCMjE1RDY2MDk3RjU1NjJBIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6RERENTUzMjNBQzZFMTFFOUIyMTVENjYwOTdGNTU2MkEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6RERENTUzMjRBQzZFMTFFOUIyMTVENjYwOTdGNTU2MkEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAABAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAgICAgICAgICAgIDAwMDAwMDAwMDAQEBAQEBAQIBAQICAgECAgMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwP/wAARCAAdAB4DAREAAhEBAxEB/8QAaAABAAMBAAAAAAAAAAAAAAAACwgJCgcBAQAAAAAAAAAAAAAAAAAAAAAQAAAGAQIFAgUFAQAAAAAAAAECAwQFBgcVCAAREhMJIxQhIhYZCkEnGLg5eREBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A38cBgzomyXzasvPcjl+YZ5oTpye6Fe3WbPjqek1cETO1D66UlHtLYSRpF3XVYOUxOfSY+nkAH7B0okiKLVRAXKIcq3vMvyO1N5m7A2Bj+RoMIn3HZoHEAUt/d0qYGMjZEsI0YKgWJcljiVUKyLbTwTAOTPtgb5urgKfGPks8wS1/mMRG3lbxgyo1syWPE6CGTLea0DkI10i6aNPGKUdHeEntecmZ9gnQt7n0+fITFEFpOAO9295mzG6/J/n8cu8vZUeY/Jv93OsSUh5ka5O6kSPaKZYXZxhK85mlYkkUxMimVBqCQN0UkyJkIVMpSgCIXAEgxn+wdh/6NIf3Fg+ARQ21+cPxxbr8wr4LxJmiS+v20VYZhZC9Ua145hCM6uqilLEGxXSNhogHiZ1g7aAq95QAMJSj0m5BjX2ySEfLflRykpEv2UpGSO/zc4+j5KNdt3zB8zdIZbWbO2bxqoq2ct10jgYhyGMUwDzAeARMf5nw9FP3kVKZXxrGykc6WYyEa/vVXZv2L1soZFwzeM3Eom4bOkFiiU6ZylOUwCAgA8AUHGPY/wC7xYZHU4rSvuJIPdZ1WP0PT/5gwa+p637nSdK9t6vuu97fs+p19HzcBAe/N66F7uoLTE0ZULbY+6ZOtsSJmU1h51imU1qOYpBNz5AIiIB+o8BaN4HEIIvly2SGZycsq5DJFhFNNzBs26B/20vPWU66VhcqJcyc+Qgmf48vhwEdfKA3rQ+SXf6JpaRKoO8zcuZcjCvsDtk3Jsx3EXSRVDWYhllUnAmKocSkFRUDGEhBHpAIVx7au+0neiZmgKEUiKoGrTExjJ63DABUxC1lBM/dEo8xAwdICHLmICAf/9k=" style="width: 16px;margin-top: -4px;margin-right: 3px;">' . JText::_('ASTROID_JD_BUILDER') . '</a></li></ul></div></div></div><div class="astroid-banner-img"><img class="img-fluid" src="' . JURI::root() . 'media/astroid/assets/images/astronaut.png"></div></div></div><input type="hidden" value="' . $id . '" name="' . $this->name . '" />';
   }

}
