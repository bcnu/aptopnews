<?php
/**
 * @package Sj News Splash
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

defined('_YTOOLS') or include_once 'core' . DS . 'sjimport.php';

// set current module for working
YTools::setModule($module);
// import jQuery

YTools::script('sj_news_splash.js');

YTools::stylesheet('sj_news_splash.css'); 

include_once   "core" . DS . 'newssplash.php';

$params->def('reader', 'Reader');
$layout_name = 'default';
$cacheid = md5(serialize(array ($layout_name, $module->module)));
$cacheparams = new stdClass;
$cacheparams->cachemode = 'id';
$cacheparams->class = 'NewsSplash';
$cacheparams->method = 'getList';
$cacheparams->methodparams = $params;
$cacheparams->modeparams = $cacheid;
$list = JModuleHelper::moduleCache ($module, $params, $cacheparams);
include JModuleHelper::getLayoutPath($module->module);
?>