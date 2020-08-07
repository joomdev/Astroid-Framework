<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_PLATFORM') or die;

/**
 * Color Form Field class for the Joomla Platform.
 * This implementation is designed to be compatible with HTML5's `<input type="color">`
 *
 * @link   https://www.w3.org/TR/html-markup/input.color.html
 * @since  11.3
 */
class JFormFieldAstroidColor extends JFormField {

   /**
    * The form field type.
    *
    * @var    string
    * @since  11.3
    */
   protected $type = 'AstroidColor';

   /**
    * The control.
    *
    * @var    mixed
    * @since  3.2
    */
   protected $control = 'hue';

   /**
    * The format.
    *
    * @var    string
    * @since  3.6.0
    */
   protected $format = 'hex';

   /**
    * The keywords (transparent,initial,inherit).
    *
    * @var    string
    * @since  3.6.0
    */
   protected $keywords = '';

   /**
    * The position.
    *
    * @var    mixed
    * @since  3.2
    */
   protected $position = 'default';

   /**
    * The colors.
    *
    * @var    mixed
    * @since  3.2
    */
   protected $colors;

   /**
    * The split.
    *
    * @var    integer
    * @since  3.2
    */
   protected $split = 3;

   /**
    * Name of the layout being used to render the field
    *
    * @var    string
    * @since  3.5
    */
   protected $layout = 'fields.text';

   /**
    * Method to get certain otherwise inaccessible properties from the form field object.
    *
    * @param   string  $name  The property name for which to get the value.
    *
    * @return  mixed  The property value or null.
    *
    * @since   3.2
    */
   public function __get($name) {
      switch ($name) {
         case 'control':
         case 'format':
         case 'keywords':
         case 'exclude':
         case 'colors':
         case 'split':
            return $this->$name;
      }

      return parent::__get($name);
   }

   /**
    * Method to set certain otherwise inaccessible properties of the form field object.
    *
    * @param   string  $name   The property name for which to set the value.
    * @param   mixed   $value  The value of the property.
    *
    * @return  void
    *
    * @since   3.2
    */
   public function __set($name, $value) {
      switch ($name) {
         case 'split':
            $value = (int) $value;
         case 'control':
         case 'format':
            $this->$name = (string) $value;
            break;
         case 'keywords':
            $this->$name = (string) $value;
            break;
         case 'exclude':
         case 'colors':
            $this->$name = (string) $value;
            break;

         default:
            parent::__set($name, $value);
      }
   }

   /**
    * Method to attach a JForm object to the field.
    *
    * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the `<field>` tag for the form field object.
    * @param   mixed             $value    The form field value to validate.
    * @param   string            $group    The field name group control value. This acts as an array container for the field.
    *                                      For example if the field has name="foo" and the group value is set to "bar" then the
    *                                      full field name would end up being "bar[foo]".
    *
    * @return  boolean  True on success.
    *
    * @see     JFormField::setup()
    * @since   3.2
    */
   public function setup(SimpleXMLElement $element, $value, $group = null) {
      $return = parent::setup($element, $value, $group);

      if ($return) {
         $this->control = isset($this->element['control']) ? (string) $this->element['control'] : 'hue';
         $this->format = isset($this->element['format']) ? (string) $this->element['format'] : 'hex';
         $this->keywords = isset($this->element['keywords']) ? (string) $this->element['keywords'] : '';
         $this->position = isset($this->element['position']) ? (string) $this->element['position'] : 'default';
         $this->colors = (string) $this->element['colors'];
         $this->split = isset($this->element['split']) ? (int) $this->element['split'] : 3;
      }

      return $return;
   }

   /**
    * Method to get the field input markup.
    *
    * @return  string  The field input markup.
    *
    * @since   11.3
    */
   protected function getInput() {
      $renderer = new JLayoutFile($this->layout, JPATH_LIBRARIES.'/astroid/framework/layouts');

      return $renderer->render($this->getLayoutData());
   }

   /**
    * Method to get the data to be passed to the layout for rendering.
    *
    * @return  array
    *
    * @since 3.5
    */
   protected function getLayoutData() {
      $lang = JFactory::getLanguage();
      $data = parent::getLayoutData();
      $color = strtolower($this->value);
      $color = !$color ? '' : $color;

      // Position of the panel can be: right (default), left, top or bottom (default RTL is left)
      $position = ' data-position="'.(($lang->isRTL() && $this->position == 'default') ? 'left' : $this->position).'"';

      if (!$color || in_array($color, array('none', 'transparent'))) {
         $color = 'none';
      } elseif ($color['0'] != '#' && $this->format == 'hex') {
         $color = '#'.$color;
      }

      // Assign data for simple/advanced mode
      $controlModeData = $this->control === 'simple' ? $this->getSimpleModeLayoutData() : $this->getAdvancedModeLayoutData($lang);

      $large = empty($this->element['large']) ? 'false' : (string) $this->element['large'];

      $large = $large === 'true' ? true : false;

      $extraData = array(
          'color' => $color,
          'format' => $this->format,
          'keywords' => $this->keywords,
          'position' => $position,
          'validate' => $this->validate,
          'ngShow' => AstroidFrameworkHelper::replaceRelationshipOperators($this->element['ngShow']),
          'ngHide' => AstroidFrameworkHelper::replaceRelationshipOperators($this->element['ngHide']),
          'colorpicker' => true,
          'sassVariable' => $this->element['astroid-scss-variable'],
          'ngRequired' => AstroidFrameworkHelper::replaceRelationshipOperators($this->element['ngRequired']),
          'isLarge' => $large,
          'fieldname' => $this->fieldname,
      );

      $data['class'] = empty($data['class']) ? 'astroid-color-picker'.($large ? ' color-picker-lg' : '') : $data['class'].' astroid-color-picker'.($large ? ' color-picker-lg' : '');

      return array_merge($data, $extraData, $controlModeData);
   }

   /**
    * Method to get the data for the simple mode to be passed to the layout for rendering.
    *
    * @return  array
    *
    * @since 3.5
    */
   protected function getSimpleModeLayoutData() {
      $colors = strtolower($this->colors);

      if (empty($colors)) {
         $colors = array(
             'none',
             '#049cdb',
             '#46a546',
             '#9d261d',
             '#ffc40d',
             '#f89406',
             '#c3325f',
             '#7a43b6',
             '#ffffff',
             '#999999',
             '#555555',
             '#000000',
         );
      } else {
         $colors = explode(',', $colors);
      }

      if (!$this->split) {
         $count = count($colors);
         if ($count % 5 == 0) {
            $split = 5;
         } else {
            if ($count % 4 == 0) {
               $split = 4;
            }
         }
      }

      $split = $this->split ? $this->split : 3;

      return array(
          'colors' => $colors,
          'split' => $split,
      );
   }

   /**
    * Method to get the data for the advanced mode to be passed to the layout for rendering.
    *
    * @param   object  $lang  The language object
    *
    * @return  array
    *
    * @since   3.5
    */
   protected function getAdvancedModeLayoutData($lang) {
      return array(
          'colors' => $this->colors,
          'control' => $this->control,
          'lang' => $lang,
      );
   }

}