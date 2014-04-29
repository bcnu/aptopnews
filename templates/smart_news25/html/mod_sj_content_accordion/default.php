<?php
/**
 * @package Sj Content Accordion
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

$options = $params->toObject();

	@ob_start();
	include JModuleHelper::getLayoutPath($module->module, 'styles');
	$stylesheet = @ob_get_contents();
	@ob_end_clean();
	$docs = JFactory::getDocument();
	$docs->addStyleDeclaration($stylesheet );
	
	$image_config = array(
		'output_width'  => $params->get('item_image_width',  200),
		'output_height' => $params->get('item_image_height', 200),
		'function'		=> $params->get('item_image_function', 'resize_none'),
		'background'	=> $params->get('item_image_background', '#FFFFFF')
	);
	
?>



<?php if (!empty($list)){ ?>
<script type="text/javascript">
//<![CDATA[
    window.addEvent('load', function() {
        $$("#yt-accordion-<?php echo $module->id;?>").each( function( item ){
           new Accordion( item, '.yt-toggler-<?php echo $module->id;?>', '.yt-element-<?php echo $module->id; ?>', {
                opacity: false,
                alwaysHide:false,
                display:<?php echo $options->item_first_display;?>,
                onActive: function(toggler, element){
                    toggler.addClass('open');
                },
                onBackground: function(toggler, element){
                    toggler.removeClass('open');
                }
            });
            <?php if($options->accmouseenter == 'mouseenter'){?>
            $$('.yt-toggler-<?php echo $module->id;?>').addEvent('<?php echo $options->accmouseenter; ?>', function() { this.fireEvent('click'); });
            <?php } ?>                               
        } );                                 
    });
//]]>	
</script>


<div id="yt-vm-accordion-<?php echo $module->id; ?>" class="bd-accordion">
	<?php if (!empty($options->pretext)) { ?>
        <div class="yt_vm_introtext">
			<?php echo $options->pretext; ?>
		</div>
    <?php } ?>    
	     <div id="yt-accordion-<?php echo $module->id;?>" class="yt-accordion">    
            <?php 
			$i = 0;
			foreach( $list as $item ) { ?>
				<?php 
					$i++;
					if($i==1){
						$class=" first";
					}elseif($i == count($list)){
						$class=" last";
					}else{
						$class="";
					}
					?>
                <h3 class="yt-toggler-<?php echo $module->id;?> yt-toggler<?php echo $class; ?>">
                    <span>
                          <?php echo Ytools::truncate($item['title'],$options->item_title_max_characters);?>
                    </span>
                </h3>
                <div class="yt-element-<?php echo $module->id;?> yt-element<?php echo $class; ?> yt-element">
                    <?php if(($options->item_image_display == 1)&& !empty($item['image'])):?> 
                    <div class="yt-accordion-image">                 
                        <div class="item_title" title="<?php echo $item['title'];?>">
                            <?php if($options->item_image_linkable == 1):?><a href="<?php echo $item['link'];?>" target="<?php echo $options->item_link_target;?>"><?php endif;?>
                               <img src="<?php  echo YTools::resize($item['image'],$image_config);?>" title="<?php echo $item['title'];?>" alt="<?php echo $item['title']?>" height="<?php echo $options->item_image_height; ?>px" width="<?php echo $options->item_image_width?>px"/>
                            <?php if($options->item_image_linkable == 1):?></a><?php endif;?>
                        </div>                 
                    </div>
                    <?php endif;?>    
                    <div class="yt-accordion-content">                        
                        <?php if($options->item_description_display == 1){?>
                              <div class="yt_item_desc">
                                    <?php echo Ytools::truncate($item['desc'],$options->item_description_max_characters) ?>
                              </div>                              
                        <?php }?>                       						
                        <?php if($options->item_readmore_display == 1){?>
								<span class="yt-accordion-readmore" title="<?php echo $item['title'];?>" style="float:left; ">
									<a href="<?php echo $item['link'];?>" target="<?php echo $options->item_link_target;?>">
										 <?php echo $options->item_readmore_text;?>
									</a>
								</span>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>            
         </div><!--end yt-accordion-->
 
   	<?php if ( !empty($options->posttext)){ ?>
          <div class="yt_vm_footertext"><?php echo $options->posttext; ?></div>
    <?php } ?>

</div>
<?php } else { ?>
<p>There are no product matching selection!</p>
<?php } ?>
