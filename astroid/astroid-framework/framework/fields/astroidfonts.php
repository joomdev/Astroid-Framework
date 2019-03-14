<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_PLATFORM') or die;
jimport('astroid.framework.constants');

/**
 * Form Field class for the Joomla Platform.
 * Supports a generic list of options.
 *
 * @since  11.1
 */
class JFormFieldAstroidfonts extends JFormField {

   /**
    * The form field type.
    *
    * @var    string
    * @since  11.1
    */
   protected $type = 'astroidfonts';

   /**
    * Method to get the field input markup for a generic list.
    * Use the multiple attribute to enable multiselect.
    *
    * @return  string  The field input markup.
    *
    * @since   3.7.0
    */
   protected function getInput() {
      $html = array();
      $attr = '';

      // Initialize some field attributes.
      $attr .= !empty($this->class) ? ' class="astroid-font-selector ' . $this->class . '"' : ' class="astroid-font-selector"';
      $attr .= !empty($this->size) ? ' size="' . $this->size . '"' : '';
      $attr .= $this->multiple ? ' multiple' : '';
      $attr .= $this->required ? ' required aria-required="true"' : '';
      $attr .= $this->autofocus ? ' autofocus' : '';

      // To avoid user's confusion, readonly="true" should imply disabled="true".
      if ((string) $this->readonly == '1' || (string) $this->readonly == 'true' || (string) $this->disabled == '1' || (string) $this->disabled == 'true') {
         $attr .= ' disabled="disabled"';
      }

      // Initialize JavaScript field attributes.
      $attr .= $this->onchange ? ' onchange="' . $this->onchange . '"' : '';

      $html = '<select data-preview="astroid-font-preview-' . $this->fieldname . '" ' . $attr . ' name="' . $this->name . '">';
      $fonts = AstroidFrameworkHelper::getGoogleFonts();

      $options = [];

      foreach ($fonts as $font) {
         $options[$font['category']][] = $font['family'];
      }

      $html .= '<option ' . ($this->value == '' ? ' selected' : '') . ' value="">Default</option>';

      //$options = array();
      foreach ($options as $group => $fonts) {
         if (!empty($group)) {
            $html .= '<optgroup label="' . $group . '">';
         }
         foreach ($fonts as $value) {
            $html .= '<option ' . ($this->value == $value ? ' selected' : '') . ' value="' . $value . '">' . $value . '</option>';
         }
         if (!empty($group)) {
            $html .= '</optgroup>';
         }
      }

      $alphas = range('A', 'Z');

      $speciman = '';
      foreach ($alphas as $alpha) {
         $speciman .= '<span>' . $alpha . strtolower($alpha) . '</span>';
      }
      $speciman .= '<div class="clearfix"></div>';
      for ($i = 0; $i <= 9; $i++) {
         $speciman .= '<span>' . $i . '</span>';
      }

      $html .= '</select><div class="astroid-font-preview inline astroid-font-preview-' . $this->fieldname . '"><div class="light"><span>Aa</span></div><div class="dark"><span>Aa</span></div><div data-target="astroid-font-preview-' . $this->fieldname . '" class="more" title="' . JText::_('ASTROID_FIELDS_FONTS_PREVIEW_TOGGLE') . '"><span class="fa fa-caret-square-down"></span></div><div title="' . JText::_('ASTROID_FIELDS_FONTS_PREVIEW_TOGGLE') . '" data-target="astroid-font-preview-' . $this->fieldname . '" class="less"><span class="fa fa-caret-square-up"></span></div></div><div class="clearfix"></div><div class="astroid-font-preview astroid-font-preview-' . $this->fieldname . '"><div class="light">' . $speciman . '</div><div class="dark">' . $speciman . '</div></div>';

      return $html;
   }

   /**
    * Method to add an option to the list field.
    *
    * @param   string  $text        Text/Language variable of the option.
    * @param   array   $attributes  Array of attributes ('name' => 'value' format)
    *
    * @return  JFormFieldList  For chaining.
    *
    * @since   3.7.0
    */
   public function addOption($text, $attributes = array()) {
      if ($text && $this->element instanceof SimpleXMLElement) {
         $child = $this->element->addChild('option', $text);

         foreach ($attributes as $name => $value) {
            $child->addAttribute($name, $value);
         }
      }

      return $this;
   }

   /**
    * Method to get certain otherwise inaccessible properties from the form field object.
    *
    * @param   string  $name  The property name for which to get the value.
    *
    * @return  mixed  The property value or null.
    *
    * @since   3.7.0
    */
   public function __get($name) {
      if ($name == 'options') {
         return $this->getOptions();
      }

      return parent::__get($name);
   }

}
