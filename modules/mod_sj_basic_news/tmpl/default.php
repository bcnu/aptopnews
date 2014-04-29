<?php
/*------------------------------------------------------------------------
 # SJ Basic News  - Version 1.0
 # Copyright (c) 2011 YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: YouTech Company
 # Websites: http://www.smartaddons.com
 -------------------------------------------------------------------------*/
?>
<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
	if (!empty($list)) {
	$count = 0;
?>
<div class="widget-wrap">
 <?php foreach ($list as $item) { 
 $count++; 
 if($count == count($list)){
	 $iditem = ' last-item';
 }else if($count == 1){
	 $iditem = ' first-item';
 }else{
	 $iditem = '';
 }
 ?>
  <div class="<?php echo $module->id; ?> post <?php if($params->get('showline')){ echo 'showlinebottom'.$iditem; } ?>">
        <div class="post-inner">
	        <?php if ($params->get('show_image')==1 && $item['thumb'] != ''){?>
	        	<a class="alignleft" title="<?php echo $item['sub_title']?>" href="<?php echo $item['link']?>">
	        		<img  title="<?php echo $item['sub_title']?>" alt="<?php echo $item['sub_title']?>" class="attachment-Mini Square" src="<?php echo $item['thumb']?>" width="<?php echo $params->get('item_thumbnail_width');?>px" height="<?php echo $params->get('item_thumbnail_height');?>px"/>
	        	</a>
	        <?php } ?>
		        <h2>
		        	<a title="<?php echo $item['title']?>" href="<?php echo $item['link']?>"><?php echo $item['sub_title']?></a>
		        </h2>
		   <?php if ($params->get('show_description') == 1 && $item['sub_content'] !=""){?>
	            <p class="basicnews-desc"><?php echo $item['sub_content']?></p>
	       <?php } ?>
		   <?php if( ($params->get('show_cattitle')==1)||($params->get('show_date') == 1) ){?>
	        <p>
		       <?php if($params->get('show_cattitle')==1) {?>
		            <span class="cattitle"><?php echo $item['cattitle']; ?> </span>
		       <?php } ?>
		       <?php if ($params->get('show_date') == 1):?>
		       		<span class="basic-date"><?php echo $item['date']?></span>
		        <?php endif; ?>
	        </p>       	
	        <?php } ?>
        </div>
  </div>  
  <?php } ?>
</div>
<?php } ?>

