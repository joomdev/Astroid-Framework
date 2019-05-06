<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('JPATH_BASE') or die;
jimport('astroid.framework.constants');
extract($displayData);
if (empty($value)) {
   $value = json_encode([]);
}
?>
<script>
   var AstroidSassOverrideVariables = <?php echo $value; ?>;
</script>
<div class="astroidsocialprofiles" astroidsassoverrides>
   <textarea class="d-none" name="<?php echo $name; ?>">{{ overrides}}</textarea>
   <div class="row">
      <div ng-if="overrides.length" class="col-12">
         <table class="table table-bordered table-striped">
            <tr>
               <th>Variable</th>
               <th>Value</th>
               <th width="20"></th>
            </tr>
            <tr ng-repeat="override in overrides track by $index" ng-init="overrideIndex = $index">
               <td>
                  <input ng-model="override.variable" type="text" class="form-control mw-100" />
               </td>
               <td>
                  <input ng-model="override.value" type="text" class="form-control mw-100" />
               </td>
               <td>
                  <button ng-click="removeOverride(overrideIndex)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
               </td>
            </tr>
         </table>
      </div>
      <div class="col-12 text-center">
         <button class="btn btn-primary" type="button" ng-click="addOverride()">Add</button>
      </div>
   </div>
</div>