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
	
    defined('_JEXEC') or die('Restricted access');
    $options=$params->toObject();
    $width_content = $options->width_module - $options->item_thumbnail_width - 50;
//Ytools::dump($options->item_thumbnail_mode);die();
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


<div class="yt_frontpage <?php echo $options->themes; ?>" style="width:<?php echo $options->width_module; ?>px;background: #FFFFFF !important;">
    <?php
        $count_list = 0;
        if($count_list == 0){
    ?>
        <div class="main_frontpage">
            <?php if($options->show_main_image == 1){?>   
            <div class="main_images">
                <?php if($options->link_main_image == 1):?>
                <a href="<?php echo $list[0]['link']; ?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" target = "<?php echo $options->target;?>" style="background: none;">
                <?php endif;?>    
                    <img src="<?php  if($options->item_thumbnail_mode=='none'){echo  $list[0]['thumb'];} else {echo YTools::resize($list[0]['thumb'],$options->item_thumbnail_width, $options->item_thumbnail_height,$options->item_thumbnail_mode);}?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" border="none" alt="<?php Ytools::truncate($list[0]['title'],$options->limittitle) ;?>" height="<?php echo $options->item_thumbnail_height ;?>px" width="<?php echo $options->item_thumbnail_width;?>px"/>
                 <?php if($options->link_main_image == 1):?>
                </a>
                <?php endif;?>
            </div>
            <?php } ?> 
            <div class="main_content" style="width: <?php echo $options->item_thumbnail_width; ?>px;font-size:12px;padding-right:2px;">
                <?php if($options->show_main_title == 1){?>
                    <?php if($options->link_main_title == 1):?>
                    <a href="<?php echo $list[0]['link']; ?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" target = "<?php echo $options->target;?>" style="text-align: left; text-decoration: none;background: none !important;">
                    <?php endif;?>
                        <span style="color: <?php echo $options->color_main_title;?> !important;font-size:18px;font-weight:bold;padding-top:10px;"> <?php echo Ytools::truncate($list[0]['title'],$options->limittitle)?></span>
                    <?php if($options->link_main_title == 1):?>
                    </a>
                    <?php endif;?>
                <?php } ?>
                <?php if($options->show_date == 1){?>
                    <p class="yt_date" style="margin: 0 0 3px 0 !important;line-height: normal !important;"><?php echo date("d F Y", strtotime($list[0]['publish'])); ?></p>
                <?php } ?>
                <?php if($options->show_description == 1){?>
                    <?php echo Ytools::truncate($list[0]['sub_main_content'],$options->limit_main_description) ?>
                <?php } ?>
                <?php if($options->show_readmore == 1){?>
                <p class="redmore_main_frontpage"><a href="<?php echo $list[0]['link']; ?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" target = "<?php echo $options->target;?>" style="background: none !important;text-decoration: none;color:#135CAE !important"><b><?php echo $options->readmore_text;?></b></a></p>
                <?php } ?>
            </div> 
        </div>
    <?php 
        $count_list = 1;
        }
     ?>
    <div class="nomal_frontpage">
        <div class="nomal_list" style="width:<?php echo $width_content; ?>px;">
            <?php 
                foreach($list as $key=>$item) { 	
                    if($key != 0){
            ?>
            <div style="padding-bottom: 10px; float: left;width:<?php echo $width_content; ?>px;">
                <?php if($options->show_normal_image == 1):?>
                <div class="nomal_images" style="float: right;" title="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>">
                 <?php if($options->link_normal_image == 1):?>
                 <a href="<?php echo $item['link']; ?>" target = "<?php echo $options->target;?>" title="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>" style="background: none;">
                 <?php endif;?>
					 <img src="<?php if($options->item_thumbnail_mode=='none')  {echo  $item['thumb'];} else {  echo YTools::resize($item['thumb'],$options->small_thumb_width, $options->small_thumb_height,$options->item_thumbnail_mode);}?>" title="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>" border="none" alt="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>" width="<?php echo $options->small_thumb_width;?>px;" height="<?php echo $options->small_thumb_height;?>px"/>					
				<?php if($options->link_normal_image == 1):?>
                 </a>
                 <?php endif;?>
                </div>
                <?php endif;?>
                <div class="nomal_content" >
                    <?php if($options->show_normal_title == 1){?>
                        <?php if($options->link_normal_title == 1):?>
                        <a href="<?php echo $item['link']; ?>" title="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>"  target = "<?php echo $options->target;?>" style="background: none  !important; text-decoration: none;right:0px;">
                        <?php endif;?>
                            <strong style="color: <?php echo $options->color_normal_title;?>;font-size:13px;" title="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>" ><?php echo Ytools::truncate($item['title'],$options->limittitle)?></strong><br />
                        <?php if($options->link_normal_title == 1):?>
                        </a>
                        <?php endif;?>
                    <?php } ?>
                    <?php if($options->show_date == 1){?>
                        <span class="yt_date" style="padding-top: 5px !important;"><?php echo date("d F Y", strtotime($item['publish'])); ?></span>
                    <?php } ?>
                    <?php if($options->show_normal_description == 1){?>
                    <div style="font-size:12px;padding:0px !important"><?php echo Ytools::truncate($item['sub_normal_content'],$options->limit_normal_description) ?></div>
                    <?php } ?>
                </div>
            </div>
            <?php }} ?>
        </div>
        
    </div>
</div>
<?php if($options->note): ?>
<br/>
<div style="text-align:left; width:<?php echo $options->width_module; ?>px">
	<p><?php  echo $options->note;?></p>
</div>
<?php endif;?>
 <?php } else { echo JText::_('Has no content to show!'); }?>   