<?php
/*------------------------------------------------------------------------
 # Yt News Scroller  - Version 1.0
 # Copyright (C) 2009-2010 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://joomla.ytcvn.com
 -------------------------------------------------------------------------*/
?>
<?php defined('_JEXEC') or die('Restricted access');?>
<!--Start Module-->    
<div class="yt_container_horz" style="height: auto !important; width: <?php echo $width_page; ?>px;">
	<div class="scroll-pane<?php echo $module->id;?> yt_scroll_pane" style="overflow: hidden; position: relative;"> 
		<p class="technical" style="width: <?php echo $width_module ?>px;padding-top:0px !important;margin-top:0px !important;"></p>
        <?php foreach($list as $key=>$item) { ?>
		    <div class="item_scrollbar item_scrollbar_<?php echo $module->id?>" style="width: <?php echo $options->item_image_width; ?>px !important;">
                <?php if($item['image'] != ""){?>
                <div class="item_scrollbar_img" style="width:<?php echo $options->item_image_width; ?>px;height: <?php echo $options->item_image_height; ?>px !important;">
                    <?php if($options->item_image_linkable == 1):?>
                    <a href="<?php echo $item['link']; ?>" target = "<?php echo $options->item_link_target;?>">
                    <?php endif; ?>
                    <?php if($options->item_image_display == 1):?>
                        <img src="<?php  echo YTools::resize($item['image'],$image_config);?>" title="<?php echo $item['title'];?>" alt="<?php echo $item['title']?>" height="<?php echo $options->item_image_height; ?>px" width="<?php echo $options->item_image_width?>px"/>
                        <?php if($options->item_image_linkable == 1):?>
                    </a>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php } ?>
                <?php if($options->item_title_display == 1):?>
                <div class="item_scrollbar_title">
                    <?php if($options->item_title_linkable == 1):?>
                    <a href="<?php echo $item['link']; ?>" target = "<?php echo $options->item_link_target;?>" title="<?php echo $item['title']?>" >
                    <?php endif; ?>
                        <span style="color:<?php echo $title_color; ?>;" title="<?php echo $item['title']?>"><?php echo Ytools::truncate($item['title'],$options->item_title_max_characters);?></span>
                    </a>
                </div>
                <?php endif; ?>
                <?php if($options->item_description_display):?>
						<div class="item_scrollbar_desc">
								<?php echo Ytools::truncate($item['desc'],$options->item_description_max_characters);?>
						</div>
                 <?php endif; ?>
                <?php if($options->item_readmore_display == 1):?>
                <div class="item_scrollbar_readmore"><a href="<?php echo $item['link']; ?>" target = "<?php echo $options->item_link_target;?>" title="<?php echo htmlspecialchars($item['title'])?>" style="text-decoration: none;"><span><?php echo $options->item_readmore_text; ?></span></a></div>
                <?php endif; ?>
            </div>            
        <?php } ?>                
		<p></p>  
	</div>
</div>
<!--End Module-->
