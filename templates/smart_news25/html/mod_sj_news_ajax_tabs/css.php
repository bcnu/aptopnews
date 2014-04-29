<?php
/**
 * @package Sj News AjaxTabs
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

ob_start();
$options = $params->toObject();

if ((int)$params->get('item_image_autofit', 1) && !isset($item_image_autofit) ){
	$nb_column	= (int)$params->get('nb_column', 3);
	if (in_array($params->get('position', 'top'), array('top', 'bottom'))){
		$size = (int)$params->get('module_width',  750) - 30;
		$size = $size - 12 * ($nb_column-1);
		$size = floor(1.0*$size/$nb_column)-2;
		$params->set('item_image_width', $size);
	} else {
		$size = (int)$params->get('module_width',  750) - 30 - $tabs_width;
		$size = $size - 12 * ($nb_column-1);
		$size = floor(1.0*$size/$nb_column)-2;
		$params->set('item_image_width', $size);
	}
	$item_image_autofit=true;
}

if ( (int)$params->get('item_image_width',  100) ): ?>
	#<?php echo $uniqueid; ?> .item-wrap .item-image img {
		width: <?php echo (int)$params->get('item_image_width',  100); ?>px;
		<?php
		if ( (int)$params->get('item_image_height',100) ){ ?>
		height: <?php echo (int)$params->get('item_image_height',  100); ?>px;
		<?php
		} ?>
	}
<?php
endif;
if ( !empty($options->item_title_color) ): ?>
	#<?php echo $uniqueid; ?> .item-wrap .item-readmore a,
	#<?php echo $uniqueid; ?> .item-wrap .item-title,
	#<?php echo $uniqueid; ?> .item-wrap .item-title a{
		<!--color: <?php //echo $options->item_title_color; ?>;-->
	}
<?php
endif;

if ( !empty($options->item_description_color) ): ?>
	#<?php echo $uniqueid; ?> .item-wrap .item-description{
		<!--color: <?php //echo $options->item_description_color; ?>;-->
	}
<?php
endif;

if ( !empty($options->tab_background) ): ?>
	#<?php echo $uniqueid; ?> .tabs-container ul.tabs li .tab{
		<!--background-color: <?php //echo $options->tab_background; ?>;-->
	}	
<?php 
endif;
if ( !empty($options->tab_active_background) ): ?>
	#<?php echo $uniqueid; ?> .tabs-container ul.tabs li.selected .tab{
		
	}
	#<?php echo $uniqueid; ?> .tabs-content{
		border-color: <?php echo $options->tab_active_background; ?>;
	}
	#<?php echo $uniqueid; ?> .pager-container ul.pages li .page{
		<!--border-color: <?php //echo $options->tab_active_background; ?>;-->
		color: <?php echo $options->tab_active_background; ?>;
	}
	#<?php echo $uniqueid; ?> .pager-container ul.pages li .page.active{
		<!--background-color: <?php //echo $options->tab_active_background; ?>;-->
	}	
<?php 
endif;

if ( !empty($options->tab_text_color) ): ?>
	#<?php echo $uniqueid; ?> .tabs-container ul.tabs li .tab{
		
	}
	#<?php echo $uniqueid; ?> .pager-container ul.pages li .page.active{
		color: <?php echo $options->tab_text_color; ?>;
	}
<?php 
endif;

if (in_array($params->get('position', 'top'), array('left', 'right'))): ?>
	#<?php echo $uniqueid; ?> .tabs-container ul.tabs li .tab{
		color: <?php echo $options->tab_text_color; ?>;
		width: <?php echo (-24+$params->get('tabs_width', 170)); ?>px;
	}
<?php
endif;

$item_stylesheet_config = @ob_get_contents(); 
@ob_end_clean();
$document = &JFactory::getDocument();
$document->addStyleDeclaration($item_stylesheet_config);
?>