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
      var arritemId_<?php echo $module->id?> = [];
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
        var showtitle = <?php echo $options->item_title_display;?>;
        var items = $jsmart(".so_title_<?php echo $module->id?>");
		var cssPaneContent = $jsmart(".so_content_<?php echo $module->id?>");
		for(i = 0; i < items.length; i++) {
			if(showtitle == 0){
                var paneHeightCap = height(items[i]) - 8;
            }else{
                var paneHeightCap = height(items[i]) + 6;
            }
			$jsmart(cssPaneContent[i]).css("top", <?php echo $options->item_image_height?> - paneHeightCap);	
		}
        $jsmart('.so_item_<?php echo $module->id?>').hover(function(){
            var capDesc = $jsmart(this).find(".so_content_<?php echo $module->id?>");
			var paneHeightDesc = $jsmart(capDesc).height() + 5;
			$jsmart(".so_content_<?php echo $module->id?>", this).stop().animate({top:<?php echo $options->item_image_height?> - paneHeightDesc},{queue:false,duration:160});
		}, function() {
            var capTitleOut = $jsmart(this).find(".so_title_<?php echo $module->id?>");
            var paneHeightTitleOut = $jsmart(capTitleOut).height()+ 10;
            if(showtitle == 0){
                paneHeightTitleOut = 0;
            }
            $jsmart(".so_content_<?php echo $module->id?>", this).stop().animate({top:<?php echo $options->item_image_height?> - paneHeightTitleOut},{queue:false,duration:160});
		});
           
	  });	

//]]>	  
</script>
<?php $width_module_article =($options->item_image_width + 26) * $options->num_element;?>
<!--Start Module-->
<div class="yt_article_slider yt_so_article_<?php echo $options->theme?>" style="width:<?php echo $width_module_article + 76;?>px;">
    <div class="title_slider_theme" style="display:<?php echo ($options->slider_title_display)?"block":"none";?>;"><?php echo $options->slider_title_text?></div>
    <div class="so_navigation_hor" id="<?php echo $uniqued.'_navigation_'?><?php echo $module->id?>" style="display:<?php echo ($options->button_display)?"block":"none";?>;">
        <div style="top:<?php echo $options->item_image_height/2?>px;" class="so_next_hor_theme6" id="<?php echo $uniqued.'_next_'?><?php echo $module->id?>"><a href="javascript:void(0)"><span><!--<?php echo JText::_("NEXT")?>--></span></a></div>
        <div style="top:<?php echo $options->item_image_height/2?>px;" class="so_pre_hor_theme6" id="<?php echo $uniqued.'_pre_' ?><?php echo $module->id?>"><a href="javascript:void(0)"><span><!--<?php echo JText::_("PRE")?>--></span></a></div>
    </div>
    <div class="so_slider_content" id="sj_so_artilce_slider_<?php echo $module->id?><?php echo $uniqued;?>" style="width:<?php echo $width_module_article;?>px;top:0px;margin:0 auto; padding:15px 0 0">
	     <ul>
	     <?php foreach ($list as $item):?>
			       <li style="width: <?php echo ($options->item_image_width + 16);?>px; padding: 0px 5px ;">
			       		<div class="so_item_theme3 so_item_<?php echo $module->id?>" style="overflow: hidden;position: relative;">
		                    <div style="height:<?php echo $options->item_image_height;?>px; position: relative;overflow: hidden;">
		    					<div class="so_img" style="width:<?php echo $options->item_image_width; ?>px; display:<?php echo ($options->item_image_display)?"block":"none";?>">
		    	       			    <?php if($options->item_image_linkable == 1){ ?>
												<a href="<?php echo $item['link'];?>" title="<?php echo $item['title'];?>" target="<?php echo $options->item_link_target;?>">									
													<img src="<?php  echo YTools::resize($item['image'],$image_config);?>" title="<?php echo $item['title'];?>" alt="<?php echo $item['title']?>" height="<?php echo $options->item_image_height; ?>px" width="<?php echo $options->item_image_width?>px"/>
												</a>
											<?php } else { ?>	
													<img src="<?php  echo YTools::resize($item['image'],$image_config);?>" title="<?php echo $item['title'];?>" alt="<?php echo $item['title']?>" height="<?php echo $options->item_image_height; ?>px" width="<?php echo $options->item_image_width?>px"/>
									<?php }?>	
		    					</div>
		    	       			<div class="so_content so_content_<?php echo $module->id?>" style="left:0px;width:<?php echo $options->item_image_width;?>px;top:135px;overflow: hidden;">
		                            <h4 class="so_title so_title_<?php echo $module->id?>" style="display:<?php echo ($options->item_title_display)?"block":"none";?>" >
										<?php if($options->item_title_linkable==1) { ?>
											<a href='<?php echo $item['link'];?>' target="<?php echo $options->item_link_target;?>" title="<?php echo $item['title'];?>" style="color:<?php echo $options->item_title_color;?> ;z-index:99999;">
												<?php echo Ytools::truncate( $item['title'],$options->item_title_max_characs);?>
											</a>
											<?php } else {?>
											<a style="color:<?php echo $options->item_title_color;?> ;z-index:99999;" >
												<?php echo Ytools::truncate( $item['title'],$options->item_title_max_characs);?>
											</a>
										<?php }?>
									</h4>
		        	       			<div class="so_description" style="padding:5px 5px 0 5px;display:<?php echo ($options->item_desc_display)?"display":"none";?>;color:<?php echo $options->item_desc_color; ?> ;">
										<?php echo Ytools::truncate($item['desc'],$options->item_desc_max_characs);?>
									</div>
		        					<div class="so_readmore" style="display:<?php echo ($options->item_readmore_display)?"block":"none";?>;">
		        						<a href="<?php echo $item['link'];?>" title="<?php echo $item['title'];?>" target="<?php echo $options->item_link_target;?>" style="color: #FFFFFF ;text-align:right;padding-right:5px;">
											<?php echo $options->item_readmore_text;?>
										</a>
		        					</div> 
		    	       			</div>
		                    </div>
			       		</div>  
			       </li> 
	       		<?php endforeach;?>         
	     </ul>
	 </div>
 </div>
<!--End Module-->
<!--Start Footer Text-->
<?php if(!empty($options->posttext)): ?>
<br/>
<div style="text-align:left; width:<?php echo $width_module_article + 50; ?>px">
	<?php  echo $options->posttext;?>
</div>
<?php endif;?>
<!--End Footer Text-->
<?php } else { echo JText::_('Has no content to show!');}?>
