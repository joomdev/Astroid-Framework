<?php
jimport('astroid.framework.helper');
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldAstroidRadio extends JFormFieldList {

   /**
    * The form field type.
    *
    * @var    string
    * @since  11.1
    */
   protected $type = 'AstroidRadio';

   /**
    * Name of the layout being used to render the field
    *
    * @var    string
    * @since  3.5
    */
   protected $layout = 'fields.astroidradio';

   /**
    * Method to get the radio button field input markup.
    *
    * @return  string  The field input markup.
    *
    * @since   11.1
    */
   protected function getInput() {
      if (empty($this->layout)) {
         throw new UnexpectedValueException(sprintf('%s has no layout assigned.', $this->name));
      }

      $renderer = new JLayoutFile($this->layout, JPATH_LIBRARIES . '/astroid/framework/layouts');

      return $renderer->render($this->getLayoutData());
   }

   /**
    * Method to get the data to be passed to the layout for rendering.
    *
    * @return  array
    *
    * @since   3.5
    */
   protected function getLayoutData() {
      $data = parent::getLayoutData();

      $extraData = array(
          'options' => $this->getOptions(),
          'value' => (string) $this->value,
          'fieldname' => $this->fieldname,
          'ngShow' => AstroidFrameworkHelper::replaceRelationshipOperators($this->element['ngShow']),
          'ngHide' => AstroidFrameworkHelper::replaceRelationshipOperators($this->element['ngHide']),
          'ngRequired' => AstroidFrameworkHelper::replaceRelationshipOperators($this->element['ngRequired']),
          'images' => $this->element['radio-image'],
          'imageWidth' => $this->element['image-width'],
      );

      $data = array_merge($data, $extraData);
      return $data;
   }

}
