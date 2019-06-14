<?php
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$data = $doc->getBuffer('component');
$sPattern = '/\s*/m';
$sReplace = '';
$ndata = preg_replace($sPattern, $sReplace, $data);
if (empty($ndata)) {
   return;
}
?>
<div class="astroid-component-area">
   <jdoc:include type="component" />
</div>