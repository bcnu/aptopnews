<?php
/**
 * @package Sj News Content
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

$image_config = array(
		'output_width'  => $params->get('item_image_width'),
		'output_height' => $params->get('item_image_height'),
		'function'		=> $params->get('item_image_function'),
		'background'	=> $params->get('item_image_background')
);
$options=$params->toObject();
$count_items=count($list);
$item0=array_shift($list);
?>    
<?php if(!empty($list)) { ?>
<div class="yt_news_content <?php echo $module->id; ?>" style="width:<?php echo $options->width_module; ?>px;">
    <?php
   /*      $count_items = 0;
        if($count_items == 0){ */
    ?>
        <div class="main_news_content">   
            <div class="main_images_news">
                <?php if($options->item_image_linkable == 1){?>
					<a href="<?php echo $item0['link']; ?>" target = "<?php echo $options->link_target;?>">
				<?php } ?>
					<img src="<?php echo YTools::resize($item0['image'],$image_config)?>" height="<?php echo $options->item_image_height ?>px" width="<?php echo $options->item_image_width ?>px" alt="<?php echo $item0['title']?>" title="<?php echo $item0['title']?>"/>
				<?php if($options->item_image_linkable  == 1){?></a>
					<?php }?>
            </div> 
            <div class="main_content_main" style="width: <?php echo $options->item_image_width; ?>px;">
                <?php if($options->item_title_linkable == 1){?>
                    <a href="<?php echo $item0['link']; ?>" title="<?php echo $item0['title']?>" target = "<?php echo $options->link_target;?>">                
                        <span><?php echo YTools::truncate($item0['title'],$options->item_title_max_chars);?></span>
                    </a>
                <?php } ?>
                
                <?php if($options->item_desc_display == 1){?>
                    <?php echo Ytools::truncate($item0['desc'],$options->item_desc_max_chars) ;?>
                <?php } ?>
                
            </div> 
        </div>
    <?php 
       /*  $count_items = 1;
        } */
     ?>
    <div class="normal_news_content">
        <div class="nomal_items" style="width:<?php echo $options->width_module-$options->item_image_width-50; ?>px;">
			<?php
                foreach($list as $key=>$item) { 
                 /*    if($key != 0){ */
            ?>
            <div style="padding-bottom: 10px; float: left; width:100%">
           
            <div class="nomal_content_normal" >
                <?php if($options->item_title_linkable == 1){?>
                    <a href="<?php echo $item['link']; ?>" title="<?php echo $item['title']?>" target = "<?php echo $options->link_target;?>">
                <?php } ?>
                        <?php echo Ytools::truncate($item['title'],$options->item_title_max_chars)?>
                    </a>
                <?php if($options->item_date_display == 1){?>
                    <span>(<?php echo $item['created']; ?>)</span>
                <?php } ?>
               
            </div>
            </div>
            <?php } ?>
        </div>
        
    </div>
</div>
<?php } else { echo JText::_('Has no content to show!');}  ?>
