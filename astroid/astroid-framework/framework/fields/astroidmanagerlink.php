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
      $url = JRoute::_('index.php?option=com_ajax&astroid=manager&id=' . $id);
      return '<a class="astroidlink" href="' . $url . '">' . JText::_('ASTROID_TEMPLATE_OPTIONS') . '</a><style>
a.astroidlink{
    background: linear-gradient(to right,#ff9966, #ff5e62);
    color: white;
    padding: 20px;
    margin-top: 22px;
	font-size: 15px;
    border-radius: 4px;
	display: inline-block;
	text-decoration:none;
}
a.astroidlink:hover {box-shadow:inset 0 0 1px 0 rgba(0,0,0,0.5), 0 8px 24px rgba(106,71,195,0.2);}
</style>';
   }

}
