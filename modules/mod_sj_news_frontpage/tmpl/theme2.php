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
 
<div class="yt_frontpage <?php echo $options->themes; ?>" style="width:<?php echo $options->width_module; ?>px;">
    <div class="normal_yt">
        <?php
            $count_list = 0;   
            if($count_list == 0){
        ?>
        <div class="main_frontpage" style="height: <?php echo $options->item_thumbnail_height ?>px;">   
            <?php if($options->show_main_image == 1){?>
            <div class="main_images">
                <?php if($options->link_main_image == 1):?>
                <a href="<?php echo $list[0]['link']; ?>" target = "<?php echo $options->target;?>" style="background: none;">
                <?php endif;?>
                    <img src="<?php  if($options->item_thumbnail_mode=='none'){echo  $list[0]['thumb'];} else {echo YTools::resize($list[0]['thumb'],$options->item_thumbnail_width, $options->item_thumbnail_height,$options->item_thumbnail_mode);}?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" border="none" alt="<?php Ytools::truncate($list[0]['title'],$options->limittitle) ;?>" height="<?php echo $options->item_thumbnail_height ;?>px" width="<?php echo $options->item_thumbnail_width;?>px"/>
                <?php if($options->link_main_image == 1):?>
                </a>
                <?php endif;?>
            </div>
            <?php } ?> 
        </div>
        <?php 
            $count_list = 1;
            }
         ?>
        <div class="normal_frontpage_theme2" style="width:<?php echo $width_content;?>px; float: left;">
            <ul class="normal_list_theme2" style="text-align: left !important;position: relative !important;">
            <?php 
				
				
                foreach($list as $key=>$item) { 
                    if($key != 0){
            ?>
                <li>
                    <?php if($options->show_normal_title == 1){?>
                    <div class="normal_title_theme2" style="left: 0px;">
                        <?php if($options->link_normal_title == 1):?>
                        <a style="color: <?php echo $options->color_normal_title;?>;font-size:13px;background: none  !important; text-decoration: none;" href="<?php echo $item['link']; ?>" title="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>" target = "<?php echo $options->target;?>">
                        <?php endif;?> 
                           <span style="color: <?php echo $options->color_normal_title;?>;font-size: 13px; font-weight:bold; " title="<?php echo Ytools::truncate($item['title'],$options->limittitle)?>"><?php echo Ytools::truncate($item['title'],$options->limittitle)?></span>
                        <?php if($options->link_normal_title == 1):?>
                        </a>
                        <?php endif;?>
                    </div>
                    <?php } ?> 
                    <?php if($options->show_date == 1){?>
                        <div class="yt_date">
                            <span style="color: #B7B7B7 !important;"><?php echo date("d F Y", strtotime($item['publish'])); ?></span>
                        </div>
                    <?php } ?>
                    <?php if($options->show_normal_description == 1){?>
                    <div class="normal_desc_theme2" style="font-size: 12px;"><?php echo Ytools::truncate($item['sub_normal_content'],$options->limit_normal_description) ?></div>
                    <?php } ?>
                </li>
             <?php }} ?>   
            </ul>
        </div>
    </div>

    <div class="main_content_theme2">
        <?php if($options->show_main_title == 1){?>
            <?php if($options->link_main_title == 1):?>
            <a href="<?php echo $list[0]['link']; ?>" target = "<?php echo $options->target;?>" style="text-align: left; text-decoration: none;background: none;">
            <?php endif;?>
                <span style="color: <?php echo $options->color_main_title;?>;font-size: 18px;font-weight:bold;" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>"><?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?></span>
            <?php if($options->link_main_title == 1):?>
            </a>
            <?php endif;?>
        <?php } ?>
            <?php if($options->show_date == 1){?>
                <p class="yt_date"><?php echo date("d F Y", strtotime($list[0]['publish'])); ?></p>
             <?php } ?>
            <?php if($options->show_description == 1){?>            
                <div class="main_desc"  style="font-size: 12px; text-align:left; float:left;"><?php echo Ytools::truncate($list[0]['sub_main_content'],$options->limit_main_description) ?></div><br />
            <?php } ?>                
            <?php if($options->show_readmore == 1){?>
            <p class="redmore_main_frontpage"><a href="<?php echo $list[0]['link']; ?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" target = "<?php echo $options->target;?>" style="font-size: 12px !important;background: none !important;text-decoration: none;color:#135CAE !important"><b><?php echo $options->readmore_text;?></b></a></p>
            <?php } ?>
    </div>

</div>
<?php if($options->note): ?>
<br/>
<div style="text-align:left; width:<?php echo $options->width_module; ?>px">
	<p><?php  echo $options->note;?></p>
</div>
<?php endif;?>
 <?php } else { echo JText::_('Has no content to show!'); }?>   