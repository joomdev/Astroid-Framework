<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
defined('_JEXEC') or die;

class AstroidFrameworkConstants {

   public static $astroid_version = '1.0.2';
   public static $fontawesome_version = '5.1.0';
   public static $animatecss_version = '3.6';
   public static $animations = [
       '' => ['' => 'None'],
       'Attention Seekers' => [
           'bounce' => 'bounce',
           'flash' => 'flash',
           'pulse' => 'pulse',
           'rubberBand' => 'rubberBand',
           'shake' => 'shake',
           'swing' => 'swing',
           'tada' => 'tada',
           'wobble' => 'wobble',
           'jello' => 'jello'
       ],
       'Bouncing Entrances' => [
           'bounceIn' => 'bounceIn',
           'bounceInDown' => 'bounceInDown',
           'bounceInLeft' => 'bounceInLeft',
           'bounceInRight' => 'bounceInRight',
           'bounceInUp' => 'bounceInUp',
       ],
       'Bouncing Exits' => [
           'bounceOut' => 'bounceOut',
           'bounceOutDown' => 'bounceOutDown',
           'bounceOutLeft' => 'bounceOutLeft',
           'bounceOutRight' => 'bounceOutRight',
           'bounceOutUp' => 'bounceOutUp',
       ],
       'Fading Entrances' => [
           'fadeIn' => 'fadeIn',
           'fadeInDown' => 'fadeInDown',
           'fadeInDownBig' => 'fadeInDownBig',
           'fadeInLeft' => 'fadeInLeft',
           'fadeInLeftBig' => 'fadeInLeftBig',
           'fadeInRight' => 'fadeInRight',
           'fadeInRightBig' => 'fadeInRightBig',
           'fadeInUp' => 'fadeInUp',
           'fadeInUpBig' => 'fadeInUpBig',
       ],
       'Fading Exits' => [
           'fadeOut' => 'fadeOut',
           'fadeOutDown' => 'fadeOutDown',
           'fadeOutDownBig' => 'fadeOutDownBig',
           'fadeOutLeft' => 'fadeOutLeft',
           'fadeOutLeftBig' => 'fadeOutLeftBig',
           'fadeOutRight' => 'fadeOutRight',
           'fadeOutRightBig' => 'fadeOutRightBig',
           'fadeOutUp' => 'fadeOutUp',
           'fadeOutUpBig' => 'fadeOutUpBig',
       ],
       'Flippers' => [
           'flip' => 'flip',
           'flipInX' => 'flipInX',
           'flipInY' => 'flipInY',
           'flipOutX' => 'flipOutX',
           'flipOutY' => 'flipOutY',
       ],
       'Lightspeed' => [
           'lightSpeedIn' => 'lightSpeedIn',
           'lightSpeedOut' => 'lightSpeedOut',
       ],
       'Rotating Entrances' => [
           'rotateIn' => 'rotateIn',
           'rotateInDownLeft' => 'rotateInDownLeft',
           'rotateInDownRight' => 'rotateInDownRight',
           'rotateInUpLeft' => 'rotateInUpLeft',
           'rotateInUpRight' => 'rotateInUpRight',
       ],
       'Rotating Exits' => [
           'rotateOut' => 'rotateOut',
           'rotateOutDownLeft' => 'rotateOutDownLeft',
           'rotateOutDownRight' => 'rotateOutDownRight',
           'rotateOutUpLeft' => 'rotateOutUpLeft',
           'rotateOutUpRight' => 'rotateOutUpRight',
       ],
       'Sliding Entrances' => [
           'slideInUp' => 'slideInUp',
           'slideInDown' => 'slideInDown',
           'slideInLeft' => 'slideInLeft',
           'slideInRight' => 'slideInRight',
       ],
       'Sliding Exits' => [
           'slideOutUp' => 'slideOutUp',
           'slideOutDown' => 'slideOutDown',
           'slideOutLeft' => 'slideOutLeft',
           'slideOutRight' => 'slideOutRight',
       ],
       'Zoom Entrances' => [
           'zoomIn' => 'zoomIn',
           'zoomInDown' => 'zoomInDown',
           'zoomInLeft' => 'zoomInLeft',
           'zoomInRight' => 'zoomInRight',
           'zoomInUp' => 'zoomInUp',
       ],
       'Zoom Exits' => [
           'zoomOut' => 'zoomOut',
           'zoomOutDown' => 'zoomOutDown',
           'zoomOutLeft' => 'zoomOutLeft',
           'zoomOutUp' => 'zoomOutUp',
       ],
       'Specials' => [
           'hinge' => 'hinge',
           'jackInTheBox' => 'jackInTheBox',
           'rollIn' => 'rollIn',
           'rollOut' => 'rollOut'
       ],
   ];
   public static $menu_animations = [
       '' => ['' => 'None'],
       'Bouncing Entrances' => [
           'bounceIn' => 'bounceIn',
           'bounceInDown' => 'bounceInDown',
           'bounceInLeft' => 'bounceInLeft',
           'bounceInRight' => 'bounceInRight',
           'bounceInUp' => 'bounceInUp',
       ],
       'Fading Entrances' => [
           'fadeIn' => 'fadeIn',
           'fadeInDown' => 'fadeInDown',
           'fadeInDownBig' => 'fadeInDownBig',
           'fadeInLeft' => 'fadeInLeft',
           'fadeInLeftBig' => 'fadeInLeftBig',
           'fadeInRight' => 'fadeInRight',
           'fadeInRightBig' => 'fadeInRightBig',
           'fadeInUp' => 'fadeInUp',
           'fadeInUpBig' => 'fadeInUpBig',
       ],
       'Rotating Entrances' => [
           'rotateIn' => 'rotateIn',
           'rotateInDownLeft' => 'rotateInDownLeft',
           'rotateInDownRight' => 'rotateInDownRight',
           'rotateInUpLeft' => 'rotateInUpLeft',
           'rotateInUpRight' => 'rotateInUpRight',
       ],
       'Sliding Entrances' => [
           'slideInUp' => 'slideInUp',
           'slideInDown' => 'slideInDown',
           'slideInLeft' => 'slideInLeft',
           'slideInRight' => 'slideInRight',
       ],
       'Zoom Entrances' => [
           'zoomIn' => 'zoomIn',
           'zoomInDown' => 'zoomInDown',
           'zoomInLeft' => 'zoomInLeft',
           'zoomInRight' => 'zoomInRight',
           'zoomInUp' => 'zoomInUp',
       ],
       'Specials' => [
           'hinge' => 'hinge',
           'jackInTheBox' => 'jackInTheBox',
           'rollIn' => 'rollIn',
           'rollOut' => 'rollOut'
       ],
   ];
   public static $icons = [
       [
           'fas fa-long-arrow-alt-up' => 'Alternate Long Arrow Up',
           'fas fa-arrow-up' => 'arrow-up',
           'fas fa-arrow-circle-up' => 'Arrow Circle Up',
           'fas fa-arrow-alt-circle-up' => 'Alternate Arrow Circle Up',
           'fas fa-angle-double-up' => 'Angle Double Up',
           'fas fa-sort-up' => 'Sort Up (Ascending)',
           'fas fa-level-up-alt' => 'Level Up Alternate',
           'fas fa-cloud-upload-alt' => 'Cloud Upload Alternate',
           'fas fa-chevron-up' => 'chevron-up',
           'fas fa-chevron-circle-up' => 'Chevron Circle Up',
           'fas fa-hand-point-up' => 'Hand Pointing Up',
           'far fa-hand-point-up' => 'Hand Pointing Up',
           'fas fa-caret-square-up' => 'Caret Square Up',
           'far fa-caret-square-up' => 'Caret Square Up',
       ]
   ];
   public static $preloder_animations = [
       [
           'audio' => ['label' => 'Audio', 'image' => 'preloader/audio.svg'],
           'ball_triangle' => ['label' => 'Ball Triangle', 'image' => 'preloader/ball-triangle.svg'],
           'bars' => ['label' => 'Bars', 'image' => 'preloader/bars.svg'],
           'circles' => ['label' => 'Circles', 'image' => 'preloader/circles.svg'],
           'grid' => ['label' => 'Grid', 'image' => 'preloader/grid.svg'],
           'oval' => ['label' => 'Oval', 'image' => 'preloader/oval.svg'],
           'puff' => ['label' => 'Puff', 'image' => 'preloader/puff.svg'],
           'rings' => ['label' => 'Rings', 'image' => 'preloader/rings.svg'],
           'spinning_circles' => ['label' => 'Spinning Circles', 'image' => 'preloader/spinning-circles.svg'],
           'tail_spin' => ['label' => 'Tail Spin', 'image' => 'preloader/tail-spin.svg'],
           'three_dots' => ['label' => 'Three Dots', 'image' => 'preloader/three-dots.svg'],
       ]
   ];
   public static $social_profiles = [
       ['title' => 'Facebook', 'link' => '', 'icons' => ['fab fa-facebook-f', 'fab fa-facebook'], 'color' => '#39539E', 'enabled' => false, 'icon' => 'fab fa-facebook-f'],
       ['title' => 'Messenger', 'link' => '', 'icons' => ['fab fa-facebook-messenger'], 'color' => '#3876C4', 'enabled' => false, 'icon' => 'fab fa-facebook-messenger'],
       ['title' => 'Twitter', 'link' => '', 'icons' => ['fab fa-twitter', 'fab fa-twitter-square'], 'color' => '#3DA9F6', 'enabled' => false, 'icon' => 'fab fa-twitter'],
       ['title' => 'Youtube', 'link' => '', 'icons' => ['fab fa-youtube', 'fab fa-youtube-square'], 'color' => '#DE0000', 'enabled' => false, 'icon' => 'fab fa-youtube'],
       ['title' => 'LinkedIn', 'link' => '', 'icons' => ['fab fa-linkedin-in', 'fab fa-linkedin'], 'color' => '#006FB8', 'enabled' => false, 'icon' => 'fab fa-linkedin-in'],
       ['title' => 'Instagram', 'link' => '', 'icons' => ['fab fa-instagram'], 'color' => '#467FAA', 'enabled' => false, 'icon' => 'fab fa-instagram'],
       ['title' => 'Whatsapp', 'link' => '', 'icons' => ['fab fa-whatsapp', 'fab fa-whatsapp-square'], 'color' => '#00C033', 'enabled' => false, 'icon' => 'fab fa-whatsapp'],
       ['title' => 'Pinterest', 'link' => '', 'icons' => ['fab fa-pinterest', 'fab fa-pinterest-square', 'fab fa-pinterest-p'], 'color' => '#DB0000', 'enabled' => false, 'icon' => 'fab fa-pinterest'],
       ['title' => 'Google +', 'link' => '', 'icons' => ['fab fa-google-plus-g', 'fab fa-google-plus-square', 'fab fa-google-plus', 'fab fa-google'], 'color' => '#EE381C', 'enabled' => false, 'icon' => 'fab fa-google-plus-g'],
       ['title' => 'Github', 'link' => '', 'icons' => ['fab fa-github', 'fab fa-github-square', 'fab fa-github-alt'], 'color' => '#171515', 'enabled' => false, 'icon' => 'fab fa-github'],
       ['title' => 'Tumblr', 'link' => '', 'icons' => ['fab fa-tumblr'], 'color' => '#00263C', 'enabled' => false, 'icon' => 'fab fa-tumblr'],
       ['title' => 'Reddit', 'link' => '', 'icons' => ['fab fa-reddit', 'fab fa-reddit-square', 'fab fa-reddit-alien'], 'color' => '#FF2400', 'enabled' => false, 'icon' => 'fab fa-reddit'],
       ['title' => 'Telegram', 'link' => '', 'icons' => ['fab fa-telegram-plane'], 'color' => '#004056', 'enabled' => false, 'icon' => 'fab fa-telegram-plane'],
       ['title' => 'Skype', 'link' => '', 'icons' => ['fab fa-skype'], 'color' => '#00A6F7', 'enabled' => false, 'icon' => 'fab fa-skype'],
       ['title' => 'Slack', 'link' => '', 'icons' => ['fab fa-slack'], 'color' => '#50364C', 'enabled' => false, 'icon' => 'fab fa-slack'],
       ['title' => 'Soundcloud', 'link' => '', 'icons' => ['fab fa-soundcloud'], 'color' => '#FF0000', 'enabled' => false, 'icon' => 'fab fa-soundcloud'],
       ['title' => 'Behance', 'link' => '', 'icons' => ['fab fa-behance'], 'color' => '#2252FF', 'enabled' => false, 'icon' => 'fab fa-behance'],
       ['title' => 'Dribbble', 'link' => '', 'icons' => ['fab fa-dribbble', 'fab fa-dribbble-square'], 'color' => '#F10A77', 'enabled' => false, 'icon' => 'fab fa-dribbble'],
       ['title' => 'Spotify', 'link' => '', 'icons' => ['fab fa-spotify'], 'color' => '#00E155', 'enabled' => false, 'icon' => 'fab fa-spotify'],
   ];
   public static $system_fonts = [
       "Arial, Helvetica, sans-serif" => 'Arial, Helvetica',
       "Arial Black, Gadget, sans-serif" => 'Arial Black, Gadget',
       "Bookman Old Style, serif" => 'Bookman Old Style',
       "Comic Sans MS, cursive" => 'Comic Sans MS',
       "Courier, monospace" => 'Courier',
       "Garamond, serif" => 'Garamond',
       "Georgia, serif" => 'Georgia',
       "Impact, Charcoal, sans-serif" => 'Impact, Charcoal',
       "Lucida Console, Monaco, monospace" => 'Lucida Console, Monaco',
       "Lucida Sans Unicode, sans-serif" => 'Lucida Sans Unicode',
       "MS Sans Serif, Geneva, sans-serif" => 'MS Sans Serif, Geneva',
       "MS Serif, New York, sans-serif" => 'MS Serif, New York',
       "Palatino Linotype, Book Antiqua, Palatino, serif" => 'Palatino Linotype, Book Antiqua, Palatino',
       "Tahoma, Geneva, sans-serif" => 'Tahoma, Geneva',
       "Times New Roman, Times, serif" => 'Times New Roman, Times',
       "Trebuchet MS, Helvetica, sans-serif" => 'Trebuchet MS, Helvetica',
       "Verdana, Geneva, sans-serif" => 'Verdana, Geneva'
   ];
   public static $preloaders = [
       'rotating-plane' => [
           'name' => 'rotating-plane',
           'code' => '<div class="sk-rotating-plane"></div>',
       ],
       'fading-circle' => [
           'name' => 'fading-circle',
           'code' => '<div class="sk-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>',
       ],
       'folding-cube' => [
           'name' => 'folding-cube',
           'code' => '<div class="sk-folding-cube"><div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div>',
       ],
       'double-bounce' => [
           'name' => 'double-bounce',
           'code' => '<div class="sk-double-bounce"><div class="sk-child sk-double-bounce1"></div><div class="sk-child sk-double-bounce2"></div></div>',
       ],
       'wave' => [
           'name' => 'wave',
           'code' => '<div class="sk-wave"><div class="sk-rect sk-rect1"></div><div class="sk-rect sk-rect2"></div><div class="sk-rect sk-rect3"></div><div class="sk-rect sk-rect4"></div><div class="sk-rect sk-rect5"></div></div>',
       ],
       'wandering-cubes' => [
           'name' => 'wandering-cubes',
           'code' => '<div class="sk-wandering-cubes"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div></div>',
       ],
       'pulse' => [
           'name' => 'pulse',
           'code' => '<div class="sk-spinner sk-spinner-pulse"></div>',
       ],
       'chasing-dots' => [
           'name' => 'chasing-dots',
           'code' => '<div class="sk-chasing-dots"><div class="sk-child sk-dot1"></div><div class="sk-child sk-dot2"></div></div>',
       ],
       'three-bounce' => [
           'name' => 'three-bounce',
           'code' => '<div class="sk-three-bounce"><div class="sk-child sk-bounce1"></div><div class="sk-child sk-bounce2"></div><div class="sk-child sk-bounce3"></div></div>',
       ],
       'circle' => [
           'name' => 'circle',
           'code' => '<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>',
       ],
       'cube-grid' => [
           'name' => 'cube-grid',
           'code' => '<div class="sk-cube-grid"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>',
       ],
   ];

}
