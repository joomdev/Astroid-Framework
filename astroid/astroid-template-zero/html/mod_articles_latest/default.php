<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;
?>
<div class="latestnews menu list-inline">
	<ul class="menu list-inline">
		<?php foreach ($list as $item) : $image = json_decode($item->images); ?>
		<li itemscope itemtype="https://schema.org/Article">
			<a class="article-title" href="<?php echo $item->link; ?>" itemprop="url" class="">
				<span itemprop="name">
					<?php echo $item->title; ?>
				</span>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
</div>