<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
// No direct access.
defined('_JEXEC') or die;
extract($displayData);
jimport('astroid.framework.menu');
$errorContent = $template->params->get('error_404_content', '');
$errorButton = $template->params->get('error_call_to_action', '');
?>
<html>
   <head>
      <?php
      // Astroid Assets
      $template->loadTemplateCSS('custom', true);


      //Font family
      $ast_fontfamily = array();
      // Body Font Styles
      $body_font = $template->params->get('body_typography_options', NULL);
      if ($body_font === NULL) {
         $body_font = new \stdClass();
      }

      $style = $menu_style = $submenu_style = "";
      $typography = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
      $style = 'body {';

      if (!isset($body_font->font_face)) {
         $body_font->font_face = 'Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i';
      }

      if (isset($body_font->font_face) && !empty($body_font->font_face)) {
         $bfontface = str_replace('+', ' ', explode(":", $body_font->font_face)[0]);
         if (isset($body_font->alt_font_face)) {
            $style .= 'font-family: ' . $bfontface . ', ' . $body_font->alt_font_face . ';';
         } else {
            $style .= 'font-family: ' . $bfontface . ';';
         }
         // Let's add the style sheet too 
         if (!AstroidFrameworkHelper::isSystemFont($bfontface)) {
            array_push($ast_fontfamily, $bfontface);
         }
      }
      if (isset($body_font->font_size)) {
         $style .= 'font-size: ' . $body_font->font_size . 'em;';
      }
      if (isset($body_font->font_color)) {
         $style .= 'color: ' . $body_font->font_color . ';';
      }
      if (isset($body_font->letter_spacing)) {
         $style .= 'letter-spacing: ' . $body_font->letter_spacing . 'em;';
      }
      if (isset($body_font->font_weight)) {
         $style .= 'font-weight: ' . $body_font->font_weight . ';';
      }
      if (isset($body_font->line_height)) {
         $style .= 'line-height: ' . $body_font->line_height . 'em;';
      }
      if (isset($body_font->text_transform)) {
         $style .= 'text-transform: ' . $body_font->text_transform . ';';
      }
      $style .= '}';

      // H1 - H6 font styles.
      foreach ($typography as $typo) {
         $typoType = $template->params->get($typo . '_typography');
         if (trim($typoType) == 'custom') {
            $typoOption = $typo . '_typography_options';
            $typoParams = $template->params->get($typoOption);
            $fontface = explode(":", $typoParams->font_face);
            $style .= $typo . ',.' . $typo . '{';
            if (isset($fontface[0]) && !empty($fontface[0])) {
               $style .= 'font-family: ' . $fontface[0] . ',' . $typoParams->alt_font_face . ';';
               if (!AstroidFrameworkHelper::isSystemFont($fontface[0])) {
                  array_push($ast_fontfamily, $fontface[0]);
               }
            }
            if (isset($typoParams->font_size)) {
               $style .= 'font-size: ' . $typoParams->font_size . 'em;';
            }
            if (isset($typoParams->font_color) && !empty($typoParams->font_color)) {
               $style .= 'color: ' . $typoParams->font_color . ';';
            }
            if (isset($typoParams->letter_spacing)) {
               $style .= 'letter-spacing: ' . $typoParams->letter_spacing . 'em;';
            }
            if (isset($typoParams->font_weight)) {
               $style .= 'font-weight: ' . $typoParams->font_weight . ';';
            }
            if (isset($typoParams->line_height)) {
               $style .= 'line-height: ' . $typoParams->line_height . 'em;';
            }
            if (isset($typoParams->text_transform)) {
               $style .= 'text-transform: ' . $typoParams->text_transform . ';';
            }
            $style .= '}';
         }
      }

      // Menu Font Styles
      $menuType = $template->params->get('menus_typography');
      if (trim($menuType) == 'custom') {
         $menu_font = $template->params->get('menu_typography_options');
         $menu_fontface = str_replace('+', ' ', explode(":", $menu_font->font_face));
         $menu_style = '.astroid-nav>li>a {';
         if (isset($menu_fontface[0]) && !empty($menu_fontface[0])) {
            $menu_style .= 'font-family: ' . $menu_fontface[0] . ', ' . $menu_font->alt_font_face . ';';
            if (!AstroidFrameworkHelper::isSystemFont($menu_fontface[0])) {
               array_push($ast_fontfamily, $bfontface);
            }
         }
         if (isset($menu_font->font_size)) {
            $menu_style .= 'font-size: ' . $menu_font->font_size . 'em;';
         }
         if (isset($menu_font->font_color) && !empty($typoParams->font_color)) {
            $menu_style .= 'color: ' . $menu_font->font_color . ';';
         }
         if (isset($menu_font->letter_spacing)) {
            $menu_style .= 'letter-spacing: ' . $menu_font->letter_spacing . 'em;';
         }
         if (isset($menu_font->font_weight)) {
            $menu_style .= 'font-weight: ' . $menu_font->font_weight . ';';
         }
         if (isset($menu_font->line_height)) {
            $menu_style .= 'line-height: ' . $menu_font->line_height . 'em;';
         }
         if (isset($menu_font->text_transform) && !empty($menu_font->text_transform)) {
            $menu_style .= 'text-transform: ' . $menu_font->text_transform . ';';
         }
         $menu_style .= '}';
      }

      // SubMenu Font Styles
      $submenuType = $template->params->get('submenus_typography');
      if (trim($submenuType) == 'custom') {
         $submenu_font = $template->params->get('submenu_typography_options');
         $submenu_fontface = str_replace('+', ' ', explode(":", $submenu_font->font_face));
         $submenu_style = '.megamenu-container ,  .astroid-nav li.has-subnav > .navbar-subnav > li {';
         if (isset($submenu_fontface[0]) && !empty($submenu_fontface[0])) {
            $submenu_style .= 'font-family: ' . $submenu_fontface[0] . ', ' . $submenu_font->alt_font_face . ';';
            if (!AstroidFrameworkHelper::isSystemFont($submenu_fontface[0])) {
               array_push($ast_fontfamily, $submenu_fontface[0]);
            }
         }
         if (isset($submenu_font->font_size)) {
            $submenu_style .= 'font-size: ' . $submenu_font->font_size . 'em;';
         }
         if (isset($submenu_font->font_color) && !empty($typoParams->font_color)) {
            $submenu_style .= 'color: ' . $submenu_font->font_color . ';';
         }
         if (isset($submenu_font->letter_spacing)) {
            $submenu_style .= 'letter-spacing: ' . $submenu_font->letter_spacing . 'em;';
         }
         if (isset($submenu_font->font_weight)) {
            $submenu_style .= 'font-weight: ' . $submenu_font->font_weight . ';';
         }
         if (isset($submenu_font->line_height)) {
            $submenu_style .= 'line-height: ' . $submenu_font->line_height . 'em;';
         }
         if (isset($submenu_font->text_transform) && !empty($submenu_font->text_transform)) {
            $submenu_style .= 'text-transform: ' . $submenu_font->text_transform . ';';
         }
         $submenu_style .= '}';
      }

      // Let's add combined style sheet here
      $ast_fontfamily_list = implode("|", str_replace(" ", "+", $ast_fontfamily));
      echo '<link href="' . 'https://fonts.googleapis.com/css?family=' . $ast_fontfamily_list . '" rel="stylesheet" type="text/css" />';
      ?>
      <style>
<?php echo $style; ?>
<?php echo $menu_style; ?>
<?php echo $submenu_style; ?>
      </style>
      <?php
      $favicon = $template->params->get('favicon', '');
      if (!empty($favicon = $template->params->get('favicon', ''))) {
         echo '<link href="' . JURI::root() . 'images/' . $favicon . '" rel="shortcut icon" type="" />';
      }
      ?>
   </head>
   <body>
      <section>
         <div class="container">
            <div class="row">
               <div class="col-12 text-center">
                  <?php echo $errorContent; ?>
                  <a class="btn btn-secondary" href="<?php echo JURI::root(); ?>" role="button"><?php echo $errorButton; ?></a>
               </div>
            </div>
         </div>
      </section>
   </body>
</html>