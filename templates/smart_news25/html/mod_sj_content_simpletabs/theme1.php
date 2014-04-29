<?php
/**
 * @package Sj Content Simple Tabs
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die; ?>

 <?php
	$image_config = array(
		'output_width'  => $params->get('item_image_width',  200),
		'output_height' => $params->get('item_image_height', 200),
		'function'		=> $params->get('item_image_function', 'resize_none'),
		'background'	=> $params->get('item_image_background', null)
	);
	
	$options=$params->toObject();

	//Ytools::dump(($list))

?>
        <div id="ytc_tabs<?php echo $options->theme.$module->id;?>" class="<?php echo $options->theme;?>" style="position:relative; overflow: hidden">
            <ul class="tabs" >
            <?php  foreach ($list as $key=>$cat_menu) {
					   ?>
                <li>
					<a href="#<?php echo $options->theme.$module->id;?><?php echo $key;?>" style="color:<?php echo $options->cat_title_color;?>">						
						<?php echo Ytools::truncate($cat_menu['title'], $options->cat_title_max_characters);?>
					</a>
				</li>			
            <?php }  ?>
            </ul>
			<?php //Ytools::dump(($item)); ?>
            <div class="box-wrapper" style="width:<?php echo $options->module_width;?>px;">
					<?php 
					$j=1; 	foreach($list as $key=>$items){
							$item0=array_shift($items['child']);
							$list_child=& $items['child'];	
					?>
					 
                    <div id="<?php echo $options->theme.$module->id;?><?php echo $key;?>" class="content-box <?php if($j==1) echo "current";?>">
					<?php if(!empty($item0)) {	?>
                        <?php  if ($options->item_image_display == 1){?>
                        <div class="col-one col">
                            <?php  if($options->item_image_linkable ==1) {?>
                                <a href="<?php echo $item0['link'];?>" target="<?php echo $options->item_link_target;?>">
                                    <img src="<?php  echo YTools::resize($item0['image'],$image_config);?>" title="<?php echo $item0['title'];?>" alt="<?php echo $item0['title']?>" height="<?php echo $options->item_image_height; ?>px" width="<?php echo $options->item_image_width?>px"/>
                                </a>
                            <?php  } 
                            else 
                            {?>
                                   <img src="<?php  echo YTools::resize($item0['image'],$image_config);?>" title="<?php echo $item0['title'];?>" alt="<?php echo $item0['title']?>" height="<?php echo $options->item_image_height; ?>px" width="<?php echo $options->item_image_width?>px"/>
                            <?php }?>            
                        </div>
                        <?php }?>
						
                        <div class="col-two col" style="<?php if(($options->item_image_display==0) && (count($item0) > 1)){?>width: <?php echo floor(($options->module_width -22)/2);?>px <?php } elseif(($options->item_image_display==1) && (count($item0) == 1)){?>width: <?php echo ($options->module_width - $options->item_image_width -20 - 22);?>px;<?php }else {?>width:<?php echo floor(($options->module_width - $options->item_image_width -20 - 22)/2)?>px; <?php }?>">
                          
						   <div class="item_wrapper" style="padding: 0 10px;">
							<?php if($options->item_title_display ==1){?>
                                <div class="art_title">
								 <?php if($options->item_title_linkable == 1){?>
                                 <a href="<?php echo $item0['link'];?>" target="<?php echo $options->item_link_target;?>"><?php }?>
								   <span style="">
									<?php echo Ytools::truncate($item0['title'], $options->item_title_max_characters);?>
								   </span>
								 <?php if($options->item_title_linkable == 1){?>
								 </a>  					
								 <?php }?>
                                </div><!--end art_title-->
                             <?php }?>
						
                            <?php if ($options->item_description_display == 1) {?>
                                <div class="art_desc" style="color:<?php echo $options->item_description_color;?>; float:left; width:100%;">
                                  <?php echo Ytools::truncate($item0['desc'],$options->item_description_max_characters);?>
                                </div><!--end art_desc-->
                            <?php }?>
                            <?php if ($options->item_readmore_display == 1) {?>   
                                <div class="read_more"> 
									<a href="<?php echo $item0['link'];?>" target="<?php echo $options->item_link_target;?>"><?php echo $options->item_readmore_text;?></a>
                                </div>
                            <?php }?>
                          </div>
						 
						</div>						
                        <div class="col-three col" style="<?php if($options->item_image_display==0){?>width: <?php echo floor(($options->module_width/2) -22);?>px<?php } else {?>width:<?php echo floor(($options->module_width - $options->item_image_width - 20 - 22)/2)?>px; <?php }?>">
                           <div class="item_wrapper" style="padding: 0 10px;"> 
						   <?php  if(!empty($list_child)) {?>
							<ul style="line-height: 1.5;" class="articles"> 
							  <?php $i=0; foreach ($list_child as $key=>$item){ if($i>=0){?>
                                <li class="arrow_articles" style="overflow: hidden;">
										<?php if($options->normal_title_display ==1){?>										
											<div class="normal_title" style="font-weight: normal">
												<?php if($options->item_title_linkable == 1){?>		
												<a href="<?php echo $item['link']?>" target="<?php echo $options->item_link_target; ?>" style=" font-weight: normal"> <?php } ?>
														<?php echo Ytools::truncate($item['title'], $options->item_title_max_characters);?>
												 <?php if($options->item_title_linkable == 1){?>
												 </a>  					
												 <?php }?>
											</div><!--normal_title_price-->
										<?php }?>
								</li>
                              <?php } $i++;}?>                        
                            </ul>
							<?php if ($options->item_viewall_display ==1) { ?>
                            <div class="link_category" style="float:right;">                               
								<div class="arrow1"> &nbsp;</div>                                
								<a href="<?php echo $item['link'];?>" target="<?php echo $options->item_link_target;?>">
								<?php echo $options->item_viewall_text;?>
								</a>  	                                              
                            </div>
                            <?php }?> 
						<?php } ?>	
						   </div>
                        </div>
						<?php } else { echo JText::_('Have no items! Please recheck module config!');} ?>						
                    </div>  
				
                <?php $j++; }?>
            </div> <!-- END Box Wrapper -->
        </div> <!-- END ytc_tabs -->     
  
