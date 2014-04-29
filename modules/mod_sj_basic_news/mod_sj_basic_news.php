<?php
/*------------------------------------------------------------------------
 # SJ Basic News  - Version 1.0
 # Copyright (c) 2011 YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: YouTech Company
 # Websites: http://www.smartaddons.com
 -------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');
defined('_YTOOLS') or include_once 'core' . DS . 'sjimport.php';

// set current module for working
YTools::setModule($module);
// import jQuery
if (!defined('SMART_JQUERY') && (int)$params->get('include_jquery', '1')){
	YTools::script('jquery-1.5.min.js');
	define('SMART_JQUERY', 1);
	
}

if (!defined('SMART_NOCONFLICT')){
	YTools::script('jsmart.noconflict.js');
	define('SMART_NOCONFLICT', 1);
}

YTools::stylesheet('style.css');

include_once   "core" . DS . 'basicnews.php';

$params->def('reader', 'Reader');
$layout_name = $params->get('theme', 'default');
$cacheid = md5(serialize(array ($layout_name, $module->module)));
$cacheparams = new stdClass;
$cacheparams->cachemode = 'id';
$cacheparams->class = 'BasicNews';
$cacheparams->method = 'getList';
$cacheparams->methodparams = $params;
$cacheparams->modeparams = $cacheid;
$list = JModuleHelper::moduleCache ($module, $params, $cacheparams);
$layouts = YTools::layout($layout_name);
if (count($layouts)){
	foreach ($layouts as $layout) {
		include $layout;
	}
}
?>