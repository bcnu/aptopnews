<?php
/**
 * @package Sj Article Slider
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

$options=$params->toObject();
$image_config = array(
		'output_width'  => $options->item_image_width,
		'output_height' => $options->item_image_height,
		'function'		=> $options->item_image_function,
		'background'	=> $options->item_image_background
	);
$uniqued='sj_article_slider'.rand().time();
