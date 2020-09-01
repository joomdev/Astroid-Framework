<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license   GNU/GPLv2 and later
 */
// no direct access
defined('_JEXEC') or die;

class pkg_astroidInstallerScript
{

   /**
    * 
    * Function to run before installing the component	 
    */
   public function preflight($type, $parent)
   {
   }

   /**
    *
    * Function to run when installing the component
    * @return void
    */
   public function install($parent)
   {
      $this->getJoomlaVersion();
      $this->displayAstroidWelcome($parent);
   }

   /**
    *
    * Function to run when un-installing the component
    * @return void
    */
   public function uninstall($parent)
   {
   }

   /**
    * 
    * Function to run when updating the component
    * @return void
    */
   function update($parent)
   {
      $this->displayAstroidWelcome($parent);
   }

   /**
    * 
    * Function to update database schema
    */
   public function updateDatabaseSchema($update)
   {
   }

   public function getJoomlaVersion()
   {
      $version = new \JVersion;
      $version = $version->getShortVersion();
      $version = substr($version, 0, 1);
      define('ASTROID_JOOMLA_VERSION', $version);
   }

   /**
    * 
    * Function to display welcome page after installing
    */
   public function displayAstroidWelcome($parent)
   {
?>
      <style>
         .astroid-install {
            margin: 0 0 30px 0;
            padding: 40px 0;
            text-align: center;
            border-radius: 0;
            position: relative;
            border: 1px solid #f8f8f8;
            background: #fff url(<?php echo JURI::root(); ?>media/astroid/assets/images/moon-surface.png);
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
            box-shadow: 0 0 30px #b0b7e2;
            transition: linear .1s;
         }

         .astroid-install-actions .btn:after {
            top: 50%;
            width: 20px;
            opacity: 0;
            content: "";
            right: 80px;
            height: 17px;
            display: block;
            position: absolute;
            transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            background: url('<?php echo JURI::root(); ?>media/astroid/assets/images/arrow-right.png') no-repeat;
            -webkit-transition: all .4s;
            -moz-transition: all .4s;
            transition: all .4s;
         }

         .astroid-install-actions .btn:hover {
            transition: linear .1s;
            box-shadow: 0 0 30px #4b57d9;
         }

         .astroid-install-actions .btn:hover:after {
            opacity: 1;
            right: 20px;
            margin-left: 0;
         }

         .astroid-support-link {
            color: #8E2DE2;
            padding: 30px 0 10px;
         }

         .astroid-support-link a {
            color: #8E2DE2;
            text-decoration: none;
            margin: 0 5px;
         }

         .astroid-support-link a:hover {
            text-decoration: underline;
         }

         .astroid-support-link span {
            color: #9e9e9e;
         }

         .astroid-poweredby {
            right: 20px;
            width: 150px;
            height: 25px;
            bottom: 20px;
            position: absolute;
            background: url('<?php echo JURI::root(); ?>media/astroid/assets/images/joomdev-logo.png') no-repeat 0 0;
         }

         .astroid-poweredby a {
            bottom: 0;
            display: block;
            font-size: 0;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
         }

         .astroid-poweredby span {
            font-size: 0;
         }
      </style>
      <div class="astroid-install">
         <img src="<?php echo JURI::root(); ?>media/astroid/assets/images/astroid-logo.png" alt="astroid-logo" />
         <div class="install-message">
            <h3>Astroid Framework for Joomla!
               <span>v <?php echo $parent->manifest->version; ?></span>
            </h3>
            <p>Astroid is a powerful & flexible Joomla! framework that let's you kickstart your site's development process, while providing a simple and intuitive layout for the end users.</p>

         </div>
         <div class="astroid-install-actions">
            <a href="index.php?option=com_templates" class="btn btn-default">Get started</a>
         </div>
         <div class="astroid-support-link shake-trigger">
            <a href="https://docs.joomdev.com/category/astroid-user-manual/" target="_blank">Documentation</a> <span>|</span> <a href="https://github.com/joomdev/Astroid-Framework/releases" target="_blank">Changelog</a> <span>|</span> <a href="https://www.joomdev.com/forum/astroid-framework" target="_blank">Forum</a> <span>|</span> <a href="https://www.youtube.com/playlist?list=PLv9TlpLcSZTBBVpJqe3SdJ34A6VvicXqM" target="_blank">Tutorials</a> <span>|</span> <a href="https://www.joomdev.com/about-us" target="_blank">Credits</a> <span>|</span> <a class="shake" href="https://www.joomdev.com/jd-builder?utm_campaign=astroid_install_screen" target="_blank"><img src="<?php echo JURI::root(); ?>media/astroid/assets/images/jdb-logo.jpeg" style="width:16px;margin-top:-4px;margin-right:3px;"> Builder</a>
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
   public function postflight($type, $parent)
   {
   }
}
