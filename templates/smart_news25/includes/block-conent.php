<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if($position['group'] == ''){ // position none group

	echo $yt->renPosition($position);
	
}elseif( ($position['group'] != 'left')
	   &&($position['group'] != 'right')
	   &&($position['group'] != 'main') ){ // position has group's user created
	   
	if(!isset($countGSpe)){
		$countGSpe = 0;
	}
	$countGSpe ++;
	$width=($yt_render->arr_GI[$position['group']]['width']!="")?$yt_render->arr_GI[$position['group']]['width']:"";
	$height=($yt_render->arr_GI[$position['group']]['height']!="")?$yt_render->arr_GI[$position['group']]['height']:"";
	$style = 'float:left;';
	if($width!=""){
		if($style!=""){
			$style .= " width:".$width.";";
		}else{
			$style .= "width:".$width.";";
		}
	}
	if($height!=""){
		if($style!=""){
			$style .= " height:".$height.";";
		}else{
			$style .= "height:".$height.";";
		}
	}
	if($countGSpe ==1){
?>
	<div class="group-<?php echo $position['group'];?>" <?php if($style!=""){echo 'style="'.$style.'"';}?>>
	<?php 
		echo $yt->renPositionGroup($position);	  
		$width=$height=$style="";
		if($tagBD['count-'.$position['group']] == 1){
			$countGSpe = null;
		?>
	</div>
		<?php	
		}
	}elseif( $countGSpe == $tagBD['count-'.$position['group']] && $tagBD['count-'.$position['group']]>1 ){
		echo $yt->renPositionGroup($position);	  
		$width=$height=$style="";
		$countGSpe = null;
	?>
	</div>
	<?php
	}else{
		echo $yt->renPositionGroup($position);	  
		$width=$height=$style="";
	}
// Begin position has group's framework fixed	
		
}elseif( ($position['group'] == 'left')
	   ||($position['group'] == 'right')
	   ||($position['group'] == 'main') ){
	
	if($position['group'] == 'left'){
		$countL ++;
		if($countL==1){
		?>                    	
		<div id="content-left" style="width:<?php echo $tagBD["width_coll"].$yt_render->widthtype; ?>; float:left" class="clearfix">
		<?php		
			echo $yt->renPositionGroup($position, 'column-content');
			if($tagBD['count-group-left']==1){
			?>
		</div>
			<?php
			}
		}elseif($tagBD['count-group-left'] == $countL && $tagBD['count-group-left']>1){
			echo $yt->renPositionGroup($position, 'column-content');
			?>
		</div>
			<?php	
		}else{
			echo $yt->renPositionGroup($position, 'column-content');
		}			
	}elseif($position['group'] == 'main'){
		$countM++;
		if($countM==1){ 
		?>           	
		<div id="content-main" style="width:<?php echo $tagBD["width_colm"].$yt_render->widthtype; ?>; float:left">
			<div class="content-main-inner">
		<?php		
			echo $yt->renPositionGroup($position, 'main');
			if($tagBD['count-group-main']==1){
			?>
			</div>
		</div>
			<?php
			}
		}elseif( ($tagBD['count-group-main'] == $countM) && ($tagBD['count-group-main']>1) ){ 
			echo $yt->renPositionGroup($position, 'main');
		?>
			</div>
		</div>
		<?php
		}else{
			echo $yt->renPositionGroup($position, 'main');
		}
	}elseif($position['group'] == 'right'){
		$countR ++;
		if($countR==1){
		?>            	
		<div id="content-right" style="width:<?php echo $tagBD["width_colr"].$yt_render->widthtype; ?>; float:right">
		<?php
			echo $yt->renPositionGroup($position, 'column-content');
			if($tagBD['count-group-right']==1){
			?>
		</div>
			<?php
			}
		}elseif($countR==$tagBD['count-group-right'] && $tagBD['count-group-right']>1){
			echo $yt->renPositionGroup($position, 'column-content');
		?>
		</div>
		<?php
		}else{
			echo $yt->renPositionGroup($position, 'column-content');
		}				
	}
}
// End position has group's framework fixed			
?> 