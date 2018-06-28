<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_BASE') or die;
jimport('astroid.framework.constants');

extract($displayData);

$value = array_merge($defaults, $value);

$fonts = AstroidFrameworkHelper::getGoogleFonts();

$font_face = (string) $value['font_face'];
$alt_font_face = (string) $value['alt_font_face'];
$font_unit = (string) $value['font_unit'];
$font_size = (string) $value['font_size'];
$font_color = (string) $value['font_color'];
$letter_spacing = (string) $value['letter_spacing'];
$line_height = (string) $value['line_height'];
$font_style = (array) $value['font_style'];
$font_weight = (string) $value['font_weight'];
$text_transform = (string) $value['text_transform'];

$options = [];

foreach ($fonts as $font) {

   $variants = [];
   if (count($font['variants']) > 1) {
      foreach ($font['variants'] as $v) {
         if ($v == 'regular') {
            $variants[] = '400';
         } else if ($v == 'italic') {
            $variants[] = '400i';
         } else {
            $variants[] = str_replace('talic', '', $v);
         }
      }
   }
   $value = str_replace(' ', '+', $font['family']);
   if (!empty($variants)) {
      $value .= ':' . implode(',', $variants);
   }
   $options[$font['category']][$value] = $font['family'];
}
?>
<div class="row">
   <div class="col-12">
      <div class="row">
         <div class="col-4">
            <?php if ($fontpicker) { ?>
               <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_FONT_FAMILY_LABEL'); ?></label>

               <div data-preview="<?php echo $id; ?>-astroid-typography-preview" data-value="<?php echo $font_face; ?>" class="ui selection dropdown search optgroup astroid-font-selector form-control">
                  <input type="hidden" name="<?php echo $name; ?>[font_face]" ng-model="<?php echo $id; ?>_font_face" value="<?php echo $font_face; ?>" />
                  <div class="text">Inherit</div>
                  <i class="dropdown icon"></i>
                  <div class="menu"></div>
               </div>

               <div class="clearfix"></div>
               <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_ALT_FONT_FAMILY_LABEL'); ?></label>

               <select data-placeholder="Inherit" name="<?php echo $name; ?>[alt_font_face]" ng-model="<?php echo $id; ?>_alt_font_face" ng-init="<?php echo $id; ?>_alt_font_face = '<?php echo $alt_font_face; ?>'" class="form-control" select-ui>
                  <?php foreach (AstroidFrameworkConstants::$system_fonts as $s_font_value => $s_font_title) { ?>
                     <option value="<?php echo $s_font_value; ?>"><?php echo $s_font_title; ?></option>
                  <?php } ?>
               </select>


               <div class="clearfix"></div>
            <?php } ?>
            <?php if ($weightpicker) { ?>
               <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_FONT_WEIGHT_LABEL'); ?></label>
               <select data-typography-field="<?php echo $id; ?>" data-typography-property="font-weight" name="<?php echo $name; ?>[font_weight]" class="form-control" select-ui-div>
                  <option <?php echo ($font_weight == '' ? ' selected' : ''); ?> value="">Default</option>
                  <?php
                  foreach (array(100, 200, 300, 400, 500, 600, 700, 800, 900) as $weight) {
                     echo '<option ' . ($font_weight == $weight ? ' selected' : '') . ' value="' . $weight . '">' . $weight . '</option>';
                  }
                  ?>
               </select>
            <?php } ?>
         </div>
         <div class="col-4">
            <?php if ($sizepicker) { ?>
               <div>
                  <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_FONT_SIZE_LABEL'); ?></label>
                  <span class="range-slider-value"></span>
                  <input data-typography-field="<?php echo $id; ?>" data-typography-property="font-size" name="<?php echo $name; ?>[font_size]" data-slider-min="0" data-slider-step="<?php echo $font_unit == 'px' ? 1 : '0.1'; ?>" data-unit="<?php echo $font_unit; ?>" data-slider-max="<?php echo $font_unit == 'px' ? 160 : 10; ?>" data-prefix="" data-postfix=" <?php echo $font_unit; ?>" type="text" data-slider-value="<?php echo $font_size; ?>" value="<?php echo $font_size; ?>" id="<?php echo $id; ?>_font_size" data-slider-id="<?php echo $id; ?>_font_size" range-slider ng-model="<?php echo $id; ?>_font_size">
               </div>
               <div class="clearfix"></div>
            <?php } ?>
            <?php if ($letterspacingpicker) { ?>
               <div>
                  <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_LETTER_SPACING_LABEL'); ?></label>
                  <span class="range-slider-value"></span>
                  <input data-typography-field="<?php echo $id; ?>" data-typography-property="letter-spacing" name="<?php echo $name; ?>[letter_spacing]" data-slider-min="0" data-slider-step="0.1" data-slider-max="10" data-prefix="" data-postfix=" <?php echo $font_unit; ?>" data-unit="<?php echo $font_unit; ?>" type="text" data-slider-value="<?php echo $letter_spacing; ?>" value="<?php echo $letter_spacing; ?>" id="<?php echo $id; ?>_letter_spacing" data-slider-id="<?php echo $id; ?>_letter_spacing" range-slider ng-model="<?php echo $id; ?>_letter_spacing">
               </div>
               <div class="clearfix"></div>
            <?php } ?>
            <?php if ($lineheightpicker) { ?>
               <div>
                  <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_LINE_HEIGHT_LABEL'); ?></label>
                  <span class="range-slider-value"></span>
                  <input data-typography-field="<?php echo $id; ?>" data-typography-property="line-height" name="<?php echo $name; ?>[line_height]" data-slider-min="0" data-slider-step="0.1" data-slider-max="5" data-prefix="" data-postfix=" <?php echo $font_unit; ?>" data-unit="<?php echo $font_unit; ?>" type="text" data-slider-value="<?php echo $line_height; ?>" value="<?php echo $line_height; ?>" id="<?php echo $id; ?>_line_height" data-slider-id="<?php echo $id; ?>_line_height" range-slider ng-model="<?php echo $id; ?>_line_height">
               </div>
            <?php } ?>
         </div>
         <div class="col-4">
            <?php if ($colorpicker) { ?>
               <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_FONT_COLOR_LABEL'); ?></label>
               <input color-picker data-typography-field="<?php echo $id; ?>" data-typography-property="color" type="text" name="<?php echo $name; ?>[font_color]" id="<?php echo $id; ?>_font_color" ng-model="<?php echo $id; ?>_font_color" data-value="<?php echo $font_color; ?>" value="<?php echo $font_color; ?>" class="form-control astroid-color-picker" />
               <div class="clearfix"></div>
            <?php } ?>
            <?php if ($stylepicker) { ?>
               <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_FONT_STYLE_LABEL'); ?></label>
               <fieldset class="astroid-font-style-selector checkboxes">
                  <?php foreach (array('italic', 'underline') as $style) { ?>
                     <label for="<?php echo $id; ?>_font_style_<?php echo $style; ?>" class="checkbox">
                        <input data-typography-field="<?php echo $id; ?>" data-typography-property="font-style" type="checkbox" id="<?php echo $id; ?>_font_style_<?php echo $style; ?>" name="<?php echo $name; ?>[font_style][]" value="<?php echo $style; ?>" <?php echo in_array($style, $font_style) ? ' checked' : ''; ?>  /><span class="fa fa-<?php echo $style; ?>"></span></label>
                  <?php } ?>
               </fieldset>
               <div class="clearfix"></div>
            <?php } ?>
            <?php if ($transformpicker) { ?>
               <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_TEXT_TRANSFORM_LABEL'); ?></label>
               <select data-typography-field="<?php echo $id; ?>" data-typography-property="text-transform" ng-model="<?php echo $id; ?>_text_transform" name="<?php echo $name; ?>[text_transform]" class="form-control" select-ui>
                  <option <?php echo ($text_transform == '' ? ' selected' : ''); ?> value="">None</option>
                  <?php
                  foreach (array('uppercase' => 'UPPERCASE', 'lowercase' => 'lowercase', 'capitalize' => 'Capitalize') as $transform => $transform_title) {
                     echo '<option ' . ($text_transform == $transform ? ' selected' : '') . ' value="' . $transform . '">' . $transform_title . '</option>';
                  }
                  ?>
               </select>
            <?php } ?>
         </div>
      </div>
   </div>
</div>
<br/>
<div class="row">
   <div class="col-12">
      <label class="astroid-label"><?php echo JText::_('TPL_ASTROID_TYPOGRAPHY_PREVIEW_LABEL'); ?></label>
      <?php
      $alphas = range('A', 'Z');

      $speciman = '';
      foreach ($alphas as $alpha) {
         $speciman .= '<span>' . $alpha . strtolower($alpha) . '</span>';
      }
      $speciman .= '<div class="clearfix"></div>';
      for ($i = 0; $i <= 9; $i++) {
         $speciman .= '<span>' . $i . '</span>';
      }
      ?>
      <div class="astroid-typography-preview-container">
         <div class="astroid-typography-preview <?php echo $id; ?>-astroid-typography-preview">
            <?php echo $speciman; ?>
         </div>
         {{ <?php echo $id; ?>_font_style}}
      </div>
   </div>
</div>