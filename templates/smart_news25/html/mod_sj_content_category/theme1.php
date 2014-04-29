<?php
/**
 * @package Sj Content Category
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;

 ?>
<?php $image_config = array(
		'output_width'  => $params->get('cat_image_width'),
		'output_height' => $params->get('cat_image_height'),
		'function'		=> $params->get('cat_image_function'),
		'background'	=> $params->get('cat_image_background')
	);
	$options=$params->toObject();?>
    <?php if(!empty($list)){?> 
	<div id="page-wrap<?php echo $module->id; ?>" class="yt-contentcategory">
    <!--<div class="intro_text" style="width:<?php //echo $options->width_module;?>px;"><?php //echo $options->pretext;?></div>-->
        <div id="ytc_tabs<?php echo $module->id;?>" class="theme1" style="overflow: hidden">  
            <div class="box-wrapper" style="width:<?php echo $options->width_module;?>px;" >
                <?php  $j=1; $ij=1;	$count_items = count($list);  
                       foreach ($list as $key=>$items){ $cat_child = $items['child'];							 
								   if($ij==1) {?>										
                       <div class="content-box <?php if($j==1) echo "current";?>" style="max-width:<?php echo $options->width_module;?>px !important;width:<?php echo $options->width_module;?>px !important; overflow: hidden"> <?php }?>						
						  <div class="sub_content" style="width:<?php echo (($options->width_module/$options->category_columns)-20);?>px !important; overflow: hidden" >     					  
									<?php if ($options->cat_title_display == 1){ ?>
									<div class="title" style="color:<?php echo $options->cat_title_color;?>; font-weight: bold;"> 
									<?php if($options->cat_title_linkable ==1) {?>		
										<a style="color:<?php echo $options->cat_title_color;?>; font-weight: bold" href="<?php echo $items['link'];?>" target = "<?php echo $options->cat_link_target;?>" >
											<?php echo  Ytools::truncate($items['title'],$options->cat_title_max_characs);?> 
										</a>                                  							
									<?php } else { ?>
										<?php echo  Ytools::truncate($items['title'],$options->cat_title_max_characs);?> 
									<?php 	}?> 									
									</div>
									<?php } ?>	
									<div class="sub-category" style="overflow: hidden">
									<?php if(!empty($cat_child)) { foreach ($cat_child as $key1=>$item) {?>							
									<?php if ($options->cat_sub_title_display == 1){ ?>
									<div style="overflow: hidden">	
									<div class="sub_category" style="color:<?php echo $options->cat_sub_title_color;?>;"> 
										<?php if($options->cat_sub_title_linkable ==1) {?>		
											<a style="color:<?php echo $options->cat_sub_title_color;?>" href="<?php echo $item['link'];?>" target = "<?php echo $options->cat_link_target;?>"> 
												<?php echo Ytools::truncate($item['title'],$options->cat_sub_title_max_characs);?>
											</a>                                     									
										<?php } else { ?>
												<?php echo Ytools::truncate($item['title'],$options->cat_sub_title_max_characs);?>
										<?php  }?> 									
									</div>
									<?php if ($options->cat_all_article ==1) {?>
									<div class="num_items"><?php echo '('.$item['count_item'].')';?></div>
									<?php } ?>
									</div>							
								<?php	}}}  else {echo JText::_('No sub-categories to show!'); } ?>	
								</div>	<!--end sub-category-->								
						    </div> <!-- END sub_content -->
						   	 <?php if(($count_items) == $ij){?>
							</div><?php } else {?>
							<?php if($ij%$options->category_columns ==0) {?> </div><div class="content-box" style="width:<?php echo $options->width_module;?>px; margin-bottom: 10px; overflow: hidden"> <?php }?>
							<?php }?>    
							<?php $ij++;?>  					
				<?php  $j++;}?>
            </div> <!-- END Box Wrapper -->
        </div> <!-- END ytc_tabs -->
       <div class="footer_text" style="width:<?php echo $options->width_module;?>px; overflow: hidden"><?php echo $options->posttext; ?></div>
    </div>
<?php } else { echo JText::_('Has no content to show!');}?>