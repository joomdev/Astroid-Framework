<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

if ($width)
{
	$moduleclass_sfx .= ' ' . 'mod_search' . $module->id;
	$css = 'div.mod_search' . $module->id . ' input[type="search"]{ width:auto; }';
	JFactory::getDocument()->addStyleDeclaration($css);
	$width = ' size="' . $width . '"';
}
else
{
	$width = '';
}
?>

<div class="search<?php echo $moduleclass_sfx; ?> input-group mb-3">
	<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-inline w-100">
		<?php
		    $output = '<div class="input-group w-100">
		    <input type="text" class="form-control p-1" name="searchword" id="mod-search-searchword' . $module->id . '">';

		    if (!$button) :
		    $output .= '
            <div class="input-group-append">
            <span class="input-group-text p-2"><i class="fas fa-search"></i></span>
            </div></div>';
			endif;			

			if ($button) :
				if ($imagebutton) :
					$btn_output = '<div class="input-group-append"><input type="image" alt="' . $button_text . '" class="button" src="' . $img . '" onclick="this.form.searchword.focus();"/></div></div>';
				else :
					$btn_output = '<div class="input-group-append"><button class="button btn btn-primary p-1" onclick="this.form.searchword.focus();">' . $button_text . '</button></div></div>';
				endif;

				switch ($button_pos) :
					case 'top' :
						$output = $btn_output . '<br />' . $output;
						break;

					case 'bottom' :
						$output .= '<br />' . $btn_output;
						break;

					case 'right' :
						$output .= $btn_output;
						break;

					case 'left' :
					default :
						$output = $btn_output . $output;
						break;
				endswitch;
			endif;

			echo $output;
		?>
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</form>
</div>