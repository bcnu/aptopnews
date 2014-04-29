<?php
/**
 * @package Sj Article Slider
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;
?>
<?php if(!empty($list)){
	@ob_start();
 	include JModuleHelper::getLayoutPath($module->module, 'styles');
	$stylesheet = @ob_get_contents();
	@ob_end_clean();
	$docs = JFactory::getDocument();
	$docs->addStyleDeclaration($stylesheet );
?>

<script type="text/javascript">
//<![CDATA[
$jsmart(document).ready(function($){
	    $("#sj_so_artilce_slider_<?php echo $module->id?><?php echo $uniqued;?>").Sj_So_Article_Slider({
			auto		: 	<?php echo $options->play?>,
            type		:   '<?php echo $options->theme?>',
            speed		: 	<?php echo $options->speed?>,
            visible		: 	<?php echo $options->num_element;?>,
            start		:	<?php echo $options->start?>,
			scroll		:   <?php echo $options->scroll?>,
            pause       :   1,
            <?php if($options->play ==0):?>
            circular    :   false,
            <?php endif;?>
			btnPrev		: 	'#<?php echo $uniqued.'_pre_' ?><?php echo $module->id?>',
			btnNext		: 	'#<?php echo $uniqued.'_next_'?><?php echo $module->id?>',
			btnPause	: 	'#<?php echo $uniqued.'_pause_'?><?php echo $module->id?>',
			navigation	:   '#<?php echo $uniqued.'_navigation_'?><?php echo $module->id?>'
		});	   
	  });	
//]]>
</script>
<?php $width_module_article =($options->item_image_width + 168) * $options->num_element;?>
<!--Intro Text-->
<?php if(!empty($options->pretext)): ?>
<div style="text-align:left; width:<?php echo $width_module_article + 45; ?>px">
	<?php  echo $options->pretext;?>
</div>
<br/>
<?php endif;?>
<!--End Intro Text-->
<!--Start Module-->
<div class="yt_article_slider yt_so_article_<?php echo $options->theme;?>" style="width:<?php echo $width_module_article+44;?>px;">
    <div class="title_slider_theme" style="padding:8px 0px 0px 10px;display:<?php echo ($options->slider_title_display)?"block":"none";?>;"><?php echo $options->slider_title_text ?></div>
    <div class="so_navigation_hor" style="display:<?php echo ($options->button_display)?"block":"none";?>;">
        <div style="top:<?php echo ($options->item_image_height)/2 - 10?>px;right: -1px ;" class="so_next_hor_theme5" id="<?php echo $uniqued.'_next_'?><?php echo $module->id?>"><a href="javascript:void(0)"><span><!--<?php echo JText::_("NEXT")?>--></span></a></div>
        <div style="top:<?php echo ($options->item_image_height)/2 -10?>px;left: -1px ;" class="so_pre_hor_theme5" id="<?php echo $uniqued.'_pre_' ?><?php echo $module->id?>"><a href="javascript:void(0)"><span><!--<?php echo JText::_("PRE")?>--></span></a></div>
     </div>
     <div class="so_slider_content" id="sj_so_artilce_slider_<?php echo $module->id?><?php echo $uniqued;?>" style="margin:0 auto; padding:14px 0; top:0px;width:<?php echo $width_module_article;?>px;">
		<?php if(!empty($list)) { ?>	
		<ul>
	     	<?php foreach ($list as $item): ?>
				       <li style="width: <?php echo ($options->item_image_width + 164);?>px; padding: 0px 2px ;">
				       		<div class="so_item">
								<div class="so_img" style="width:<?php echo $options->item_image_width + 10; ?>px; display:<?php echo ($options->item_image_display)?"block":"none";?>">
				       			     <?php if($options->item_image_linkable == 1){ ?>
										<a href="<?php echo $item['link'];?>" title="<?php echo $item['title'];?>" target="<?php echo $options->item_link_target;?>">									
											<img src="<?php  echo YTools::resize($item['image'],$image_config);?>" title="<?php echo $item['title'];?>" alt="<?php echo $item['title']?>" height="<?php echo $options->item_image_height; ?>px" width="<?php echo $options->item_image_width?>px"/>
										</a>
									<?php } else { ?>	
										<img src="<?php  echo YTools::resize($item['image'],$image_config);?>" title="<?php echo $item['title'];?>" alt="<?php echo $item['title']?>" height="<?php echo $options->item_image_height; ?>px" width="<?php echo $options->item_image_width?>px"/>
									<?php }?>
								</div>
			                    <div class="so_img_r" style="width:148px;">
									<h4 class="so_title" style="display:<?php echo ($options->item_title_display)?"block":"none";?>;">
									<?php if($options->item_title_linkable==1) { ?>
										<a href='<?php echo $item['link'];?>' target="<?php echo $options->item_link_target;?>" title="<?php echo $item['title'];?>" style="color:<?php echo $options->item_title_color;?> ;">
											<?php echo Ytools::truncate( $item['title'],$options->item_title_max_characs);?>
										</a>
										<?php } else {?>
										<a style="color:<?php echo $options->item_title_color;?> ;" >
											<?php echo Ytools::truncate( $item['title'],$options->item_title_max_characs);?>
										</a>
									<?php }?>
								</h4>
									<div class="so_content" style="display:<?php echo ($options->item_desc_display)?"display":"none";?>;">	       			
										<div class="so_description">
										<?php echo Ytools::truncate($item['desc'],$options->item_desc_max_characs);?>
										</div>
									</div>	
									<div class="so_readmore" style="display:<?php echo ($options->item_readmore_display)?"block":"none";?>;">
										<a href="<?php echo $item['link'];?>" title="<?php echo $item['title'];?>" target="<?php echo $options->item_link_target;?>" style="color: #1e1690 ;">
											<?php echo $options->item_readmore_text;?>
										</a>
									</div> 
								</div>
							</div>
				       </li> 
	       		<?php endforeach;?>          
	     </ul>
		<?php } else { echo JText::_('Has no article!');} ?> 
	 </div>
 </div>
<!--End Module-->
<!--Start Footer Text-->
<?php if(!empty($options->posttext)): ?>
<br/>
<div style="text-align:left; width:<?php echo $width_module_article + 45; ?>px">
	<?php  echo $options->posttext;?>
</div>
<?php endif;?>
<!--End Footer Text-->
<?php } else { echo JText::_('Has no content to show!');}?>




