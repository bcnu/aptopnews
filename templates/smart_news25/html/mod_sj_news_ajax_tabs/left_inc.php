<?php
/*------------------------------------------------------------------------
 # Yt News Ajax Tabs  - Version 1.0
 # Copyright (C) 2009-2010 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://joomla.ytcvn.com
 -------------------------------------------------------------------------*/
 

defined('_JEXEC') or die('Restricted access');
$cate_id = $category[$ci];
$mainframe = JFactory::getApplication();
if(is_file(JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.$module->module.DS.'lib-general.php')){
	require( JPATH_BASE .DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.$module->module.DS.'lib-general.php' );
}else{
	require( JPATH_BASE .DS.'modules'.DS.'mod_yt_news_ajax_tabs'.DS.'assets'.DS.'lib-general.php' );
}

?>
 
 <?php if(count($items) >0){ ?>
			
            
 <div id="layoutleft_border_tab<?php echo $category[$ci].'_'.$module->id; ?>" style="width: 100%; height:100%">

    <div id="layoutleft_jCarouselLiteDemo" class="cEnd vmk2_tabslider" style="height:100%">

	   <div class="carousel mainDiv main<?php echo $cate_id.$module->id;?>" style="height:100%"><!--vertical-->
       	
            
            <div class="jCarouselLite jCarouselLite<?php echo $module->id;?>" style="width: <?php echo ($thumb_width + 14 + 6) * $countProductRow?>px !important;">
                <ul style="text-align: left !important;">              
                 <?php
                    $count = 0;
                    $itemrows = 0;
                    foreach($items as $item) { 
                        if($count==0){
                 ?>
                            <li style="height:auto !important; height:100%">    
                        <?php } ?>                           
                        <?php if($itemrows==0) { ?>
                            <div class="wrap-items<?php echo $cate_id.$module->id;?>" style="width: <?php echo (($thumb_width + 14 + 6) * $countProductRow)?>px !important; float:left; padding-bottom: 8px;"> <?php } ?>
                            <div style="float: left; width:<?php echo $thumb_width + 6;?>px; padding: 10px 7px 0 7px;" class="main-item-left">                                
                                <div>
                                <?php if($show_image =='1'):?>
                                   <div style="z-index: 1;" class="title">
                                   	<?php if($link_image =='1'):?>	
                                   		<a href="<?php  echo $item['link'];?>" target = "<?php echo $target;?>">
                                    <?php endif; ?>
                                    	<img src="<?php echo $item['thumb']?>" alt="No Image" title="<?php echo htmlspecialchars($item['title']);?>" />
                                    <?php if($link_image =='1'):?>
                                        </a>
                                    <?php endif; ?>
                                   </div>
                                <?php endif; ?>
                                   <div id="tabslider-text-pro" class="content" style="z-index: 2; width:<?php echo $thumb_width?>px !important  ">
                                        <div class="title1">
                                         <?php if($showtitle =='1'):?>	
                                            <a style="font-weight: bold" href="<?php echo $item['link']; ?>" target = "<?php echo $target;?>" title="<?php echo htmlspecialchars($item['title']);?>" ><?php echo $item['sub_title']; ?></a>
                                         <?php endif; ?>
                                        </div>                                           
                                        <?php if($showdescription =='1'):?>                                          
                                        <div class="content"><?php if($intro_text == 0){echo $item['sub_content'];} else{echo $item['content'];}?></div>                           
                                        <?php endif; ?>
                                        
                                        <?php if($more_info =='1'){?>
                                        <div class="more-info-left">
                                            <a style="font-weight: bold; color:<?php echo $read_color; ?> !important;" href="<?php echo $item['link'];?>" target = "<?php echo $target;?>" title="<?php echo htmlspecialchars($item['title']);?>" ><?php echo  $textreadmore; ?></a>
                                        </div>
                                        <?php } ?>                                           
                                    </div> 
                                </div>

                            </div>

                    <?php 

                        $itemrows++;

                        if($itemrows == $countProductRow)

                        { 
                            echo '</div>';

                            $itemrows = 0;
                        }   
                    ?>   
                 <?php 

                        $count++;
                        if($count == $numcols)
                        {
                            echo '</li>';
                            $count = 0;
                        }   
                 ?>   
                <?php } ?>	
                </ul>
            </div>
            
            <div id="layoutleft_num_button" style="padding-right: 0;display:<?php echo ($prenext_show)?'block':'none'?>">
                <ul id="tabslider_image_button<?php echo $cate_id.$module->id;?>" style="margin: 0px;position: relative;">
                    <?php
                        $ii = 0;
                        for($ii==0; $ii< $sumrows; $ii++){ ?>
                            <li class="<?php echo ($ii==0)?"tabslider_button_img_selected{$module->id}":"tabslider_button_img{$module->id}";?> pointer_bt" ><span><?php echo $ii+1;?></span></li>
                    <?php } ?>
                </ul>     
            </div>
            
            <!--</div>-->
        </div>
    </div>

</div>


<?php }else{ ?>
	<div id="layoutleft_border_tab" style="width: <?php echo ($countWidth + $countPadding2) + 12; ?>px;">
		<div style="padding:20px;">No Items</div>
    </div>
<?php } ?>
