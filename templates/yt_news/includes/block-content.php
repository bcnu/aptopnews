<?php
/*
 * ------------------------------------------------------------------------
 * Yt FrameWork for Joomla 2.5
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2012 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/

 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
if ($position['group'] == '') { // Position none group
	echo $yt->renPositionsContentNoGroup($position);	
} elseif ( ($position['group'] != 'left') && ($position['group'] != 'right') && ($position['group'] != 'main') ) { 	// Position has group's user created	
	if (!isset($countGSpe)) {
		$countGSpe = 0;
	}
	$countGSpe ++;
	$width = ($yt_render->arr_GI[$position['group']]['width'] != "") ? $yt_render->arr_GI[$position['group']]['width'] : "";
	$height = ($yt_render->arr_GI[$position['group']]['height'] != "") ? $yt_render->arr_GI[$position['group']]['height'] : "";
	$style = 'float:left;';
	if ($width != "" ) {
		if($style != "") {
			$style .= " width:".$width.";";
		} else {
			$style .= "width:".$width.";";
		}
	}
	if ($height != ""){
		if ($style != "") {
			$style .= " height:".$height.";";
		} else {
			$style .= "height:".$height.";";
		}
	}
	if($countGSpe == 1) {
		echo '<div class="group-' . $position['group'] . '" ' . ($style != '' ? 'style="'.$style.'"' : '') .'>';	
		echo $yt->renPositionsGroup($position);	  
		$width = $height = $style = "";
		if($tagBD['count-'.$position['group']] == 1) {
			$countGSpe = null;
			echo '</div>';	
		}
	} elseif ( $countGSpe == $tagBD['count-'.$position['group']] && $tagBD['count-'.$position['group']] > 1 ) {
		echo $yt->renPositionsGroup($position);	  
		$width = $height = $style = "";
		$countGSpe = null;
		echo '</div>';	
	} else {
		echo $yt->renPositionsGroup($position);	  
		$width=$height=$style="";
	}		
} elseif ( ($position['group'] == 'left')
	   ||($position['group'] == 'right')
	   ||($position['group'] == 'main') ) { // Position has group's framework fixed	- left, main, right
	
	if($yt_render->mbwidthtype == 'px' && $yt_render->widthtype == '%') {
		$doc->addStyleDeclaration('#content .yt-main{width:'.($tagBD['width_groupl'] + $tagBD['width_groupm'] + $tagBD['width_groupr']).'px}');
	}
	if($position['group'] == 'left') {
		$countL ++;
		if($countL == 1) {		                	
			echo '<div id="content_left" style="width:' . $yt_render->cinfo['w-group-l'] . ';float:left">';				
			echo $yt->renPositionsGroup($position, 'block-content');
			if($tagBD['count-group-left'] == 1) {
				echo '</div>';
			}
		} elseif ($tagBD['count-group-left'] == $countL && $tagBD['count-group-left'] > 1) {
			echo $yt->renPositionsGroup($position, 'block-content');
			echo '</div>';			
		} else {
			echo $yt->renPositionsGroup($position, 'block-content');
		}			
	} elseif ($position['group'] == 'main') {
		$countM++;
		if ($countM == 1) {		       	
			echo '<div id="content_main" style="width:' . $yt_render->cinfo['w-group-m'] . ';float:left">' ;
			echo '		<div class="content-main-inner">';			
			echo $yt->renPositionsGroup($position, 'main');
			if($tagBD['count-group-main'] == 1 ) {
				echo '	</div>';
				echo '</div>';		
			}
		} elseif ( ($tagBD['count-group-main'] == $countM) && ($tagBD['count-group-main'] > 1) ){ 
			echo $yt->renPositionsGroup($position, 'main');		
			echo ' </div>';
			echo '</div>';		
		} else {
			echo $yt->renPositionsGroup($position, 'main');
		}
	} elseif ($position['group'] == 'right') {
		$countR ++;
		if($countR == 1) {		       	
			echo '<div id="content_right" style="width:' . $yt_render->cinfo['w-group-r'] . ';float:left">';
			echo $yt->renPositionsGroup($position, 'block-content');
			if($tagBD['count-group-right'] == 1) {
				echo '</div>';			
			}
		} elseif ($countR == $tagBD['count-group-right'] && $tagBD['count-group-right'] > 1) {
			echo $yt->renPositionsGroup($position, 'block-content');
			echo '</div>';
		} else {
			echo $yt->renPositionsGroup($position, 'block-content');
		}				
	}
}		
?> 