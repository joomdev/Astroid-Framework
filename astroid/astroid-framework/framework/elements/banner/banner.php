<?php
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$jinput = $app->input;
$menuId = $jinput->get('Itemid', 0, 'INT');

$menu = $app->getMenu();
$item = $menu->getItem($menuId);
if (empty($item)) {
   return;
}

$params = new JRegistry();
$params->loadString($item->params);

$astroid_banner_visibility = $params->get('astroid_banner_visibility',"currentPage");
if($astroid_banner_visibility =="currentPage"){
   if ((isset($item->query['option']) && $item->query['option'] != $jinput->get('option', '')) || (isset($item->query['view']) && $item->query['view'] != $jinput->get('view', '')) || (isset($item->query['layout']) && $item->query['layout'] != $jinput->get('layout', ''))) {
      return;
   }
}

$astroid_banner_enabled = $params->get('astroid_banner_enabled');
if ($astroid_banner_enabled) {
   $astroid_banner_title_enabled = $params->get('astroid_banner_title_enabled', 1);
   if ($astroid_banner_title_enabled) {
      $astroid_banner_title = $params->get('astroid_banner_title', '');
      $astroid_banner_subtitle = $params->get('astroid_banner_subtitle', '');
      $astroid_banner_title = empty($astroid_banner_title) ? $item->title : $astroid_banner_title;
      $astroid_banner_title_tag = $params->get('astroid_banner_title_tag', 'h3');
   }
   $astroid_banner_bgcolor = $params->get('astroid_banner_bgcolor', '');
   $astroid_banner_bgimage = $params->get('astroid_banner_bgimage', '');
   $astroid_banner_class = $params->get('astroid_banner_class', '');
   $astroid_banner_wrapper = $params->get('astroid_banner_wrapper', '');
   $astroid_banner_textcolor = $params->get('astroid_banner_textcolor', '');




   $style = [];
   if (!empty($astroid_banner_bgcolor)) {
      $style[] = 'background-color:' . $astroid_banner_bgcolor;
   }
   if (!empty($astroid_banner_bgimage)) {
      $style[] = 'background-image:url(' . $astroid_banner_bgimage . ')';
   }
   $style = !empty($style) ? 'style="' . implode(';', $style) . '"' : '';

   $styletext[] = 'color:' . $astroid_banner_textcolor;
   $styletext = !empty($styletext) ? 'style="' . implode(';', $styletext) . '"' : '';
   ?>
   <div <?php echo $style; ?> class="astroid-banner-inner <?php echo!empty($astroid_banner_class) ? ' ' . $astroid_banner_class : ''; ?>">
      <?php
      if (!empty($astroid_banner_wrapper)) {
         echo '<div class="' . $astroid_banner_wrapper . '">';
      }
      if ($astroid_banner_title_enabled) {
         echo '<' . $astroid_banner_title_tag . ' class="astroid-banner-title"' . $styletext . '>' . $astroid_banner_title . '</' . $astroid_banner_title_tag . '>';
         if (!empty($astroid_banner_subtitle)) {
            echo '<span class="astroid-banner-subtitle"' . $styletext . '>' . $astroid_banner_subtitle . '</span>';
         }
      }
      if (!empty($astroid_banner_wrapper)) {
         echo '</div>';
      }
      ?>
   </div>
   <?php
}
?>