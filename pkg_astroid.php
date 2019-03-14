<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license   GNU/GPLv2 and later
 */
// no direct access
defined('_JEXEC') or die;

class pkg_astroidInstallerScript {

   /**
    * 
    * Function to run before installing the component	 
    */
   public function preflight($type, $parent) {
      
   }

   /**
    *
    * Function to run when installing the component
    * @return void
    */
   public function install($parent) {
      $this->getJoomlaVersion();
      $this->displayAstroidWelcome($parent);
   }

   /**
    *
    * Function to run when un-installing the component
    * @return void
    */
   public function uninstall($parent) {
      
   }

   /**
    * 
    * Function to run when updating the component
    * @return void
    */
   function update($parent) {
      $this->displayAstroidWelcome($parent);
   }

   /**
    * 
    * Function to update database schema
    */
   public function updateDatabaseSchema($update) {
      
   }

   public function getJoomlaVersion() {
      $version = new \JVersion;
      $version = $version->getShortVersion();
      $version = substr($version, 0, 1);
      define('ASTROID_JOOMLA_VERSION', $version);
   }

   /**
    * 
    * Function to display welcome page after installing
    */
   public function displayAstroidWelcome($parent) {
      ?>
      <style>
         .astroid-install {
            margin: 20px 0;
            padding: 40px 0;
            text-align: center;
            border-radius: 0px;
            position: relative;
            border: 1px solid #f8f8f8;
            background:#fff url(<?php echo JURI::root(); ?>media/astroid/assets/images/moon-surface.png); 
            background-repeat: no-repeat; 
            background-position: bottom;
         }
         .astroid-install p {
            margin: 0;
            font-size: 16px;
            line-height: 1.5;
         }
         .astroid-install .install-message {
            width: 90%;
            max-width: 800px;
            margin: 50px auto;
         }
         .astroid-install .install-message h3 {
            display: block;
            font-size: 20px;
            line-height: 27px;
            margin: 25px 0;
         }
         .astroid-install .install-message h3 span {
            display: block;
            color: #7f7f7f;
            font-size: 13px;
            font-weight: 600;
            line-height: normal;
         }
         .astroid-install-actions .btn {
            color: #fff;
            overflow: hidden;
            font-size: 18px;
            box-shadow: none;
            font-weight: 400;
            padding: 15px 50px;
            border-radius: 50px;
            background: transparent linear-gradient(to right, #8E2DE2, #4A00E0) repeat scroll 0 0 !important;
            line-height: normal;
            border: none;
            font-weight: bold;
            position: relative;
            box-shadow:0px 0px 30px #b0b7e2;
            transition: linear 0.1s;
         }
         .astroid-install-actions .btn:after{
            top: 50%;
            width: 20px;
            opacity: 0;
            content:"";
            right: 80px;
            height: 17px;
            display: block;
            position: absolute;
            transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAARCAYAAADdRIy+AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OERDRjlBMjY0OTIzMTFFODkyQTI4MzYzN0ZGQ0Y1NTMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OERDRjlBMjc0OTIzMTFFODkyQTI4MzYzN0ZGQ0Y1NTMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo4RENGOUEyNDQ5MjMxMUU4OTJBMjgzNjM3RkZDRjU1MyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo4RENGOUEyNTQ5MjMxMUU4OTJBMjgzNjM3RkZDRjU1MyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PvXGU3IAAADpSURBVHjarNShCsJAHMfxO1iyyEw+gsFoEIMKA5uoxSfwKQSjYWASq4JVEKPggwgmi2ASFcMUdefvj3/QsMEdd3/4lO32Zey2SaWU0JwsLOEGndRVFNTkw0N9Z562ziRIAog4OnMRJDV4c3TsIki6EHM0dBEkbfWbgYsgqcKRo3065mGjm1CHM0ihP084wA7yMIRIokonPOFoKNjjO4zptTS4ltZuoQUVPhbaPsMC7PkZjmw3pQx3jk1sdzn4i01t38MiXDi2sP1SSnDl2Mr2W87BiWNryCStkwb/Qx82/D9swCtp0UeAAQDi4gvA12LkbAAAAABJRU5ErkJggg==') no-repeat;
            -webkit-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
         }
         .astroid-install-actions .btn:hover{
            transition: linear 0.1s;
            box-shadow:0px 0px 30px #4b57d9;
         }
         .astroid-install-actions .btn:hover:after{
            opacity: 1;
            right: 20px;
            margin-left: 0;
         }
         .astroid-support-link{
            color: #8E2DE2;
            padding: 30px 0 10px;
         }
         .astroid-support-link a{
            color: #8E2DE2;
            text-decoration: none;
         }
         .astroid-support-link a:hover {
            text-decoration: underline;
         }
         .astroid-poweredby{
            right: 20px;
            width: 150px;
            height: 25px;
            bottom: 20px;
            position: absolute;
            background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAAZCAYAAADT59fvAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NjBBMzcwNEU0N0YzMTFFOEE0ODFCNkJDMkNBMDVFNDIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NjBBMzcwNEY0N0YzMTFFOEE0ODFCNkJDMkNBMDVFNDIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2MEEzNzA0QzQ3RjMxMUU4QTQ4MUI2QkMyQ0EwNUU0MiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo2MEEzNzA0RDQ3RjMxMUU4QTQ4MUI2QkMyQ0EwNUU0MiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgETteYAAA5xSURBVHja7Ft5eBRV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') no-repeat 0 0;
         }
         .astroid-poweredby a{
            bottom: 0;
            display: block;
            font-size: 0;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
         }
         .astroid-poweredby span{
            font-size: 0;
         }
      </style>
      <div class="astroid-install">
         <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAABVCAYAAADzJ9nIAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NDhCODY4RkQ0NTM3MTFFODgxN0JBMjc4MzQyQUQwQkIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NDhCODY4RkU0NTM3MTFFODgxN0JBMjc4MzQyQUQwQkIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo0OEI4NjhGQjQ1MzcxMUU4ODE3QkEyNzgzNDJBRDBCQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo0OEI4NjhGQzQ1MzcxMUU4ODE3QkEyNzgzNDJBRDBCQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PridLaUAADZfSURBVHja7H0JfGRl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" alt="astroid-logo" />
         <div class="install-message">
            <h3>Astroid Framework for Joomla!
               <span>v <?php echo $parent->get('manifest')->version; ?></span>
            </h3>
            <p>Astroid is a powerful & flexible Joomla! framework that let's you kickstart your site's development process, while providing a simple and intuitive layout for the end users.</p>

         </div>
         <div class="astroid-install-actions">
            <a href="index.php?option=com_templates" class="btn btn-default">Get started</a>
         </div>
         <div class="astroid-support-link">
            <a href="https://www.joomdev.com/documentation/astroid-framework" target="_blank">Documentation</a> <span>|</span> <a href="https://github.com/joomdev/Astroid-Framework/releases" target="_blank">Changelog</a> <span>|</span> <a href="https://www.joomdev.com/forum/astroid-framework" target="_blank">Forum</a> <span>|</span> <a href="https://www.youtube.com/playlist?list=PLv9TlpLcSZTBBVpJqe3SdJ34A6VvicXqM" target="_blank">Tutorials</a> <span>|</span> <a href="https://www.joomdev.com/about-us" target="_blank">Credits</a>
         </div>
         <div class="astroid-poweredby">
            <a href="https://www.joomdev.com" target="_blank">
               <span>JoomDev</span>
            </a>
         </div>
      </div>
      <?php
   }

   /**
    * 
    * Function to run after installing the component	 
    */
   public function postflight($type, $parent) {
      
   }

}
