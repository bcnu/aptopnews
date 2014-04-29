<?php 
/**
 * @package Sj Content Category
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;

$image_config = array(
		'output_width'  => $params->get('cat_image_width'),
		'output_height' => $params->get('cat_image_height'),
		'function'		=> $params->get('cat_image_function'),
		'background'	=> $params->get('cat_image_background')
	);
	$options=$params->toObject();?>

    #yt_accordion<?php echo $module->id;?> a{
        display: block;
    }
