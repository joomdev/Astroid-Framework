<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_PLATFORM') or die;
jimport('astroid.framework.helper');

/**
 * Form Field class for the Joomla Platform.
 * Supports a generic list of options.
 *
 * @since  11.1
 */
class JFormFieldAstroidpartial extends JFormField {

   /**
    * The form field type.
    *
    * @var    string
    * @since  11.1
    */
   protected $type = 'astroidpartial';

   /**
    * Method to get the field input markup for a generic list.
    * Use the multiple attribute to enable multiselect.
    *
    * @return  string  The field input markup.
    *
    * @since   3.7.0
    */
   protected function getInput() {
      $id = JFactory::getApplication()->input->get->get('id', 0, 'INT');
      $html = '<div class="ui fluid search selection dropdown" select-ui-div><input type="hidden" value="' . $this->value . '" name="' . $this->name . '"><i class="dropdown icon"></i><div class="default text">Choose Partial</div><div class="menu">';
      $template = AstroidFrameworkHelper::getTemplateById($id);
      if (!empty($template)) {
         $partials = AstroidFrameworkHelper::getTemplatePartials($template->template);
      } else {
         $partials = [];
      }
      $html .= '<div class="item" data-value="">None</div>';
      foreach ($partials as $partial) {
         $html .= '<div class="item" data-value="' . $partial . '">' . $partial . '</div>';
      }
      $html .= '</div></div>';
      return $html;
   }

}
