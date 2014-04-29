<?php
/**
 * @package Sj News Frontpage
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;
?>
<?php
    $options=$params->toObject();
    $width_content = $options->width_module - $options->item_thumbnail_width - 50;
	if($options->total > 1){
		$widthpage_theme3 = ($options->width_module-16)/($options->total - 1);
    }
	elseif($options->total<=1 && $options->themes != 'theme3'){
		$options->width_module = $options->item_thumbnail_width + 23;
	}

	?>
<?php if(!empty($list)) {?>   
<!--Intro Text-->
<?php if($options->intro): ?>
<div style="text-align:left; width:<?php echo $options->width_module; ?>px">
	<?php  echo $options->intro;?>
</div>
<br/>
<?php endif;?>
<!--End Intro Text-->
  
<div class="yt_frontpage yt_frontpage_theme3" style="width:<?php echo $options->width_module; ?>px;padding:8px;">
    <?php
        $count_list = 0;
        foreach($list as $key=>$item) {      
        if($count_list == 0){
    ?>
    <div class="ytc main_frontpage_theme3" style="width:<?php echo $options->width_module; ?>px; height:<?php echo $options->item_thumbnail_height;?>px;">
        <?php if($options->show_main_image == 1):?>
        <div class="main_img_theme3" style="float: left; position: relative;">
             <?php if($options->link_main_image == 1):?>
             <a href="<?php echo ($options->link_main_image)?$list[0]['link']:"#"; ?>" target = "<?php echo $options->target;?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" style="background: none;">
             <?php endif;?>
                <img src="<?php  if($options->item_thumbnail_mode=='none'){echo  $list[0]['thumb'];} else {echo YTools::resize($list[0]['thumb'],$options->item_thumbnail_width, $options->item_thumbnail_height,$options->item_thumbnail_mode);}?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" border="none" alt="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" height="<?php echo $options->item_thumbnail_height ;?>px" width="<?php echo $options->item_thumbnail_width;?>px"/>
             <?php if($options->link_main_image == 1):?>
             </a>
             <?php endif;?>
        </div>
        <?php endif;?>
        <div class="main_content_theme3" style="position: relative; overflow: hidden;padding-left: 10px;">
            <?php if($options->show_main_title == 1){?>
                <?php if($options->link_main_title == 1):?>
                <a href="<?php echo $list[0]['link']; ?>" target = "<?php echo $options->target;?>" style="text-align: left; text-decoration: none;font-size: 18px !important;background: none;">
                <?php endif;?>    
                    <span style="color: <?php echo $options->color_main_title;?>;font-size: 18px;font-weight:bold;" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle) ;?>"><?php echo Ytools::truncate($list[0]['title'],$options->limittitle) ;?></span>
                <?php if($options->link_main_title == 1):?>
                </a>
                <?php endif;?> 
            <?php } ?> 
             <?php if($options->show_date == 1){?>
                <span class="yt_date"><?php echo date("d F Y", strtotime($list[0]['publish'])); ?></span>
             <?php } ?>
            <?php if($options->show_description == 1){?>
                <div style="font-size: 12px !important; display: block !important;margin:0px;padding:0px;padding-top:5px;"><?php echo Ytools::truncate($list[0]['sub_main_content'],$options->limit_main_description) ?></div>
            <?php } ?>
            <?php if($options->show_readmore == 1){?>
            <span><a href="<?php echo $list[0]['link']; ?>" title="<?php Ytools::truncate($list[0]['title'],$options->limittitle) ;?>" target = "<?php echo $options->target;?>" style="font-size: 12px !important; background: none !important; text-decoration: none;"><b><?php echo $options->readmore_text;?></b></a></span>
            <?php } ?>
        </div>
    </div>
    
    <div  style="position: relative;float: left !important;">
    <?php 
        $count_list = 1;
        }elseif($count_list == 1){
     ?>
        <div class="nomal_frontpage_theme3"  style="float: left;width:<?php echo $widthpage_theme3;?>px;">
            <div class="nomal_content_theme3">
                <?php if($options->show_normal_image == 1):?>
               <div style="float: left;">
                    <?php if($options->link_normal_image == 1):?>
                    <a href="<?php echo $item['link']; ?>" target = "<?php echo $options->target;?>" style="background: none !important;">
                    <?php endif;?>
                        <img src="<?php  if($options->item_thumbnail_mode=='none'){echo  $item['thumb'];} else { echo YTools::resize($item['thumb'],$options->small_thumb_width, $options->small_thumb_height,$options->item_thumbnail_mode);}?>" title="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>" border="none" alt="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>" width="<?php echo $options->small_thumb_width;?>px;" height="<?php echo $options->small_thumb_height;?>px"/>
                    <?php if($options->link_normal_image == 1):?>
                    </a>
                    <?php endif;?>
                </div>
                <?php endif;?>
                <?php if($options->show_normal_title == 1){?>
                <div class="normal_des" >
                    <?php if($options->link_normal_title == 1):?>
                    <a href="<?php echo $item['link']; ?>" target = "<?php echo $options->target;?>" style="text-decoration: none;background: none !important;font-size: 13px !important;">
                    <?php endif;?>
                        <span style="color: <?php echo $options->color_normal_title;?>;font-size: 13px; font-weight:bold; " title="<?php echo Ytools::truncate($item['title'],$options->limittitle)?>"><?php echo Ytools::truncate($item['title'],$options->limittitle)?></span>
                    <?php if($options->link_normal_title == 1):?>
                    </a>
                    <?php endif;?>
                </div>
                <?php } ?> 
                <?php if($options->show_date == 1){?>
                    <div class="yt_date">
                        <span style="padding-left: 10px;color:#B7B7B7 !important" ><?php echo date("d F Y", strtotime($item['publish'])); ?></span>
                    </div>
                <?php } ?>
                <?php if($options->show_normal_description == 1){?>
                    <div class="normal_des_theme3" style="font-size:12px !important; position: relative; padding: 0px 5px 0px 9px;"><?php echo Ytools::truncate($item['sub_normal_content'],$options->limit_normal_description) ?></div>
                <?php } ?>
            </div>
        </div>
    <?php }} ?>
    </div>
</div>
<?php if($options->note): ?>
<br/>
<div style="text-align:left; width:<?php echo $options->width_module; ?>px">
	<p><?php  echo $options->note;?></p>
</div>
<?php endif;?>
 <?php } else { echo JText::_('Has no content to show!'); }?>   