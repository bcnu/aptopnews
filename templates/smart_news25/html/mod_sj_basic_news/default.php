<?php
/*------------------------------------------------------------------------
 # YT News Basic - Version 1.0
 # ------------------------------------------------------------------------
 # Copyright (C) 2009-2010 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://addon.ytcvn.com
 -------------------------------------------------------------------------*/
?>
<?php
	if (sizeof($list) > 0) :
	$count = 0;
?>

<div class="widget-wrap">
 <?php foreach ($list as $item) { 
 $count++; 
 if($count == sizeof($list)){
	 $iditem = ' last-item';
 }else if($count == 1){
	 $iditem = ' first-item';
 }else{
	 $iditem = '';
 }
 ?>
  <div class="post <?php if($params->get('showline')){ echo 'showlinebottom'.$iditem; } ?>">
        <div class="post-inner">
        <?php if ($params->get('show_image')==1 && $item['thumb'] != ''):?>
        <a style="min-width:<?php echo $params->get('item_thumbnail_width').'px'; ?>; width:<?php echo $params->get('item_thumbnail_width').'px'; ?>; height:<?php echo $params->get('item_thumbnail_height').'px'; ?>" class="alignleft" title="<?php echo $item['sub_title']?>" href="<?php echo $item['link']?>"><img style="width:<?php echo $params->get('item_thumbnail_width').'px'; ?>; height:<?php echo $params->get('item_thumbnail_height').'px'; ?>" title="<?php echo $item['sub_title']?>" alt="<?php echo $item['sub_title']?>" class="attachment-Mini Square" src="<?php echo $item['thumb']?>"/></a>
        <?php endif; ?>
        <h2><a title="<?php echo $item['sub_title']?>" href="<?php echo $item['link']?>"><?php echo $item['sub_title']?></a></h2>
        <?php if ($params->get('show_description') == 1 && $item['sub_content'] !=""):?>
            <p><?php echo $item['sub_content']?></p>
        <?php endif; ?>
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
		
        <?php 
		if($params->get('show_readmore')==1){
		?>
        <a class="readmore" title="<?php echo $item['title']?>" href="<?php echo $item['link']?>">++ readmore</a>
        <?php
		}
		?>
        </div>
  </div> 
  <?php } ?>
</div>
<?php endif; ?>
