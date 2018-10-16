<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;
?>
<div class="latestnews menu list-inline<?php echo $moduleclass_sfx; ?>">
	<ul class="menu list-inline">
		<?php foreach ($list as $item) : $image = json_decode($item->images); ?>
			<li>
				<a class="article-title" href="<?php echo $item->link; ?>" class="">
					<?php echo $item->title; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>