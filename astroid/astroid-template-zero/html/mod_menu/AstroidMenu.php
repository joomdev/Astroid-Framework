<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use nav instead
?>
<ul class="nav astroidmenu menu menu-module list-inline d-block<?php echo $class_sfx; ?>"<?php echo $id; ?>>
<?php foreach ($list as $i => &$item)
{
	$astroid_menu_options = $item->params->get('astroid_menu_options', []);
	$astroid_menu_options = (array) $astroid_menu_options;

	$class = 'item-' . $item->id;

	if ($item->id == $default_id)
	{
		$class .= ' default';
	}

	if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type === 'separator')
	{
		$class .= ' divider';
	}

	if ($item->deeper)
	{
		$class .= ' deeper';
	}

	if ($item->parent)
	{
		$class .= ' parent';
	}
	if($astroid_menu_options['badge']){
		$badgeHtml = '<span class="menu-item-badge" style="background:'.$astroid_menu_options['badge_bgcolor'].';color:'.$astroid_menu_options['badge_color'].'">'.$astroid_menu_options['badge_text'].'</span>';
	}else{
		$badgeHtml="";
	}
	$astroid_menu_options['showtitle'];
	if(!$astroid_menu_options['showtitle']){
		$title = $astroid_menu_options['subtitle'];
	}else{
		$title="";
	}

	if(!empty($astroid_menu_options['icon'])){}
	echo '<li class="' . $class . '">'.'<span class="'.$astroid_menu_options['icon'].'">'.$title.'</span>';

	switch ($item->type) :
		case 'separator':
		case 'component':
		case 'heading':
		case 'url':
			if(!($astroid_menu_options['showtitle']) && !$astroid_menu_options['showtitle']) {
				require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
			}
			echo $badgeHtml;
			break;

		default:
			if(!($astroid_menu_options['showtitle']) && !$astroid_menu_options['showtitle']) {
				require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			}
			echo $badgeHtml;
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="nav-child unstyled">';
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else
	{
		echo '</li>';
	}
}
?></ul>