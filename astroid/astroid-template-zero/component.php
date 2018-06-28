<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2018 JoomDev.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */
 
defined('_JEXEC') or die;

// Output as HTML5
$this->setHtml5(true);

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

JHtml::_('stylesheet', 'templates/system/css/system.css', array('version' => 'auto'));

if ($this->direction === 'rtl') {
   
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
   <head>
   <jdoc:include type="head" />
</head>
<body>
   <div>
      <div>
         <jdoc:include type="message" />
         <jdoc:include type="component" />
      </div>
   </div>
</body>
</html>
