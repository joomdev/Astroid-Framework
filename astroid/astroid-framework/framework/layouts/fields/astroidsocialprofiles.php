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
if (empty($value)) {
   $value = json_encode([]);
}
?>
<script>
   var AstroidSocialProfiles = <?php echo json_encode(AstroidFrameworkConstants::$social_profiles); ?>;
   var AstroidSocialProfilesSelected = <?php echo $value; ?>;
</script>
<div class="astroidsocialprofiles" astroidsocialprofiles>
   <textarea class="d-none" name="<?php echo $name; ?>">{{ profiles}}</textarea>
   <div class="row">
      <div class="col-sm-9">
         <h2 ng-hide="profiles.length" class="text-center my-5">No Profile Selected</h2>

         <div ng-show="profiles.length" ng-sortable="{draggable: '.social-profile-item',animation: 100}">
            <div ng-repeat="profile in profiles track by $index" class="card mb-2 social-profile-item" ng-init="profileIndex = $index">
               <div class="card-header">
                  <span style="font-size: 18px;"><i ng-style="{'color':profile.color}" class="{{ profile.icon}}"></i> {{ profile.title}}</span>
                  <span ng-click="removeSocialProfile(profileIndex)" class="text-danger float-right" style="cursor: pointer"><i class="fa fa-trash"></i></span>
                  <div class="clearfix"></div>
               </div>
               <div class="card-body">
                  <div class="row" ng-class="{'mb-2':profile.icons.length > 1}">
                     <div class="col-sm-3">
                        <label class="astroid-label" ng-show="profile.id != 'whatsapp' && profile.id != 'skype' && profile.id != 'telegram'">Link</label>
                        <label class="astroid-label" ng-show="profile.id == 'whatsapp'">Mobile Number</label>
                        <label class="astroid-label" ng-show="profile.id == 'telegram'">Mobile or Username</label>
                        <label class="astroid-label" ng-show="profile.id == 'skype'">Skype ID</label>
                     </div>
                     <div class="col-sm-9">
                        <input type="text" ng-model="profile.link" class="form-control" autocomplete="off">
                     </div>
                  </div>
                  <div class="row" ng-show="profile.icons.length > 1">
                     <div class="col-sm-3">
                        <label class="astroid-label">Icon</label>
                     </div>
                     <div class="col-sm-9">
                        <ul class="list-inline m-0">
                           <li class="select-icon" ng-click="profile.icon = icon" ng-class="{'active':icon == profile.icon}" ng-repeat="icon in profile.icons"><i class="{{ icon}}"></i></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <div class="col-sm-3">
         <h3>Social Brands</h3>
         <input type="text" ng-model="searchSocialProfile" placeholder="Search Brand" class="form-control mb-3" />
         <small><em class="mb-3 d-block text-center text-info">Click to Add Profile</em></small>
         <div ng-click="selectSocialProfile(profile)" ng-repeat="profile in astroidsocialprofiles| filter:searchSocialProfile track by $index" class="card mb-2 social-profile-item" style="cursor: pointer">
            <div class="border radius p-2"><i class="{{ profile.icon}}"></i> {{ profile.title}}</div>
         </div>
      </div>
   </div>
</div>