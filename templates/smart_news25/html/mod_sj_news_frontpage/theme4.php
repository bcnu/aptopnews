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
<?php if(!empty($list)) :?>   
<!--Intro Text-->
<?php if($options->intro): ?>
<div style="text-align:left; width:<?php echo $options->width_module; ?>px">
	<?php  echo $options->intro;?>
</div>
<br/>
<?php endif;?>
<!--End Intro Text-->

<script type="text/javascript">
//<![CDATA[
	$jsmart(document).ready(function($){
    	// Setup HoverAccordion for Example 2 with some custom options
    	$('#yt_accordion<?php echo $module->id;?>').hoverAccordion({
    		activateitem: '1',
    		speed: 'fast',
			keepheight : 'false'
    	});
    	$('#yt_accordion<?php echo $module->id;?>').children('li:first').addClass('firstitem');
    	$('#yt_accordion<?php echo $module->id;?>').children('li:last').addClass('lastitem');
    });
 //]]>
</script>
<div class="yt_frontpage <?php echo $options->themes; ?>" style="width:<?php echo $options->width_module; ?>px;">
    <?php
        $count_list = 0;     
        if($count_list == 0){
    ?>
    <div class="main_frontpage" style="float: left; width: <?php echo ($options->item_thumbnail_width).'px'; ?>">   
        <?php if($options->show_main_image==1):?>
        <div class="main_images">
         <a href="<?php echo $list[0]['link']; ?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>"  target = "<?php echo $options->target;?>" style="border: none;background: none !important;"><img src="<?php  if($options->item_thumbnail_mode=='none'){echo  $list[0]['thumb'];} else {echo YTools::resize($list[0]['thumb'],$options->item_thumbnail_width, $options->item_thumbnail_height,$options->item_thumbnail_mode);}?>" alt="<?php Ytools::truncate($list[0]['title'],$options->limittitle) ;?>" title="<?php echo htmlspecialchars($list[0]['title']);?>"/></a>
        </div>
        <?php endif;?> 
        <div class="main_content" style="width: <?php echo $options->item_thumbnail_width;?>px;padding-right:2px;">
            <?php if($options->show_main_title == 1){?>
				<h3 style="color: <?php echo $options->color_main_title;?>;">
                <a href="<?php echo ($options->link_main_title)?$list[0]['link']:"#"; ?>" target = "<?php echo $options->target;?>" title="<?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>" style="background: none !important; text-decoration: none;">
                   <?php echo Ytools::truncate($list[0]['title'],$options->limittitle);?>
                </a>
				</h3>
            <?php } ?>

            <?php if($options->show_date == 1){?>

                <p style="color:#B7B7B7; font-size:11px; margin:0 !important;display: block !important;"><?php echo date("d F Y", strtotime($list[0]['publish'])); ?></p>

            <?php } ?>

            <?php if($options->show_description == 1){?>

                <div class="main-desc">

                   <?php echo Ytools::truncate($list[0]['sub_main_content'],$options->limit_main_description)?>

                </div>

            <?php } ?>
			<?php if($options->show_readmore  == 1){?>
            <p><a href="<?php echo $list[0]['link']; ?>" title="<?php echo $list[0]['title']?>" target = "<?php echo $options->target;?>" style="font-size:12px !important;background: none !important; text-decoration: none;color:#095197 !important;display: block !important;text-align:right;"><b><?php echo $options->readmore_text;?></b></a></p>
			<?php } ?>
        </div> 

    </div>

    <?php 

        $count_list = 1;

        }

     ?>

    <div class="normal_frontpage_theme4" style="float: left; width:<?php echo ($options->width_module - $options->item_thumbnail_width - 15).'px'; ?>">

      <ul id="yt_accordion<?php echo $module->id;?>" class="normal_content_theme4" style="width:<?php echo $width_content +30;?>px;float:right;right: auto;">

        <?php 

            foreach($list as $key=>$item) { 

                if($key != 0){

        ?>

        <li class="normal_items_theme4">

            <?php if($options->show_normal_title == 1){?>

                <a href="<?php echo ($options->link_normal_title)?$item['link']:"#"; ?>" target = "<?php echo $options->target;?>" style="text-shadow:none !important;background: none !important;text-decoration:none;font-size:13px !important;text-transform: none !important;">  

                    <strong style="color: <?php echo $options->color_normal_title;?>;" title="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>"><?php echo Ytools::truncate($item['title'],$options->limittitle);?></strong>

                </a>

            <?php } ?> 

              <ul class="normal_content_accor" style="position: relative;">

                    <?php if($options->show_main_image==1):?>

                    <li class="normal-image" style="float: right; margin-left: 3px; margin-top:5px; padding:0 0; background:none">

                        <a href="<?php echo ($options->link_normal_image)?$item['link']:"#"; ?>" target = "<?php echo $options->target;?>" style="background: none !important; text-transform: none;"><img src="<?php  if($options->item_thumbnail_mode=='none'){echo  $item['thumb'];} else { echo YTools::resize($item['thumb'],$options->small_thumb_width, $options->small_thumb_height,$options->item_thumbnail_mode);}?>" title="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>" border="none" alt="<?php echo Ytools::truncate($item['title'],$options->limittitle);?>" width="<?php echo $options->small_thumb_width;?>px;" height="<?php echo $options->small_thumb_height;?>px"/></a>

                    </li>

                    <?php endif;?>

                    <li class="normal_desc_theme4">

                    <?php if($options->show_date == 1){?>

                            <span><?php echo date("d F Y", strtotime($item['publish'])); ?></span>

                    <?php } ?>

                    <?php if($options->show_normal_description == 1){?>

                        <p style="margin: 0 !important;font-size:12px !important;padding: 0 !important;display:block !important;"><?php echo Ytools::truncate($item['sub_normal_content'],$options->limit_normal_description) ?></p>

                    <?php } ?> 

                    </li>

              </ul>

        </li>

        <?php }} ?>

      </ul>

  </div>

</div>

<?php else: echo JText::_('Has no content to show!');?>

    <?php endif;?>
<?php if($options->note): ?>
<br/>
<div style="text-align:left; width:<?php echo $options->width_module; ?>px">
	<p><?php  echo $options->note;?></p>
</div>
<?php endif;?>