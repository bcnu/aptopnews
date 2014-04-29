<?php
/**
 * @package Sj News Scrollbar
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

		$options=$params->toObject();
		$uniqueid = 'vmscrollbar'.rand().time();
        $instance	= rand().time();
        $count_items = count($list);
        $limit_items = $options->nb_rows*$options->nb_cols;
        
        if($options->theme == 'theme1' || $options->theme == 'theme2' || $options->theme == 'theme3'){
            if($limit_items <= $count_items){
                $options->nb_rows= ceil($limit_items/$options->nb_cols);
                if($options->item_per_page > $options->nb_cols){
                    $options->item_per_page = $options->nb_cols;
                }
            }
            if($limit_items > $count_items){
                $limit_items = $count_items;
                $options->nb_rows= ceil($limit_items/$options->nb_cols);
                if($options->item_per_page > $options->nb_cols){
                    $options->item_per_page = $options->nb_cols;
                }
            }
        }

        if($options->theme == 'theme4' || $options->theme == 'theme5' || $options->theme == 'theme6'){
            if($limit_items <= $count_items){
                $options->nb_rows= ceil($limit_items/$options->nb_cols);
                if($options->item_per_page > $options->nb_rows){
                    $options->item_per_page = $options->nb_rows;
                }
            }
            if($limit_items > $count_items){
                $limit_items = $count_items;
                $options->nb_rows= ceil($limit_items/$options->nb_cols);
                if($options->item_per_page > $options->nb_rows){
                    $options->item_per_page = $options->nb_rows;
                }
            }
        }
        if($options->nb_cols>$count_items){
            $options->nb_cols = $count_items;
        }
        //$wid = $count_items_row * $options->item_image_width;
        $width_module = ($options->item_image_width + 11) * $options->nb_cols +2;
		$height_module = ($options->item_image_height ) * $options->nb_cols;
		$width_page = ($options->item_image_width + 11) * $options->item_per_page +2;
		$options->height_page = ($options->item_image_height) * $options->nb_rows;
		$options->height_page_ver = ($options->item_image_height ) * $options->item_per_page;
		$thumWidth = ($options->item_image_width + 11) * $options->nb_cols;
		
        $full_width = $width_module;
     	$image_config = array(
		'output_width'  => $params->get('item_image_width',  200),
		'output_height' => $params->get('item_image_height', 200),
		'function'		=> $params->get('item_image_function', 'resize_none'),
		'background'	=> $params->get('item_image_background','#FFFFFF')
	);

?>

<?php ob_start(); ?>
<?php if(($options->theme == 'theme1') || ($options->theme == 'theme2') || ($options->theme == 'theme3')){?>

#yt-vm-scrollbar-<?php echo $module->id; ?>, #yt-vm-scrollbar-<?php echo $module->id; ?> .yt_vm_introtext, #yt-vm-scrollbar-<?php echo $module->id; ?> .yt_vm_footertext{
   overflow: hidden;
}
<?php }?>
<?php if($options->theme == 'theme4'){?>

#yt-vm-scrollbar-<?php echo $module->id; ?>, #yt-vm-scrollbar-<?php echo $module->id; ?> .yt_vm_introtext, #yt-vm-scrollbar-<?php echo $module->id; ?> .yt_vm_footertext{
   width:<?php echo (($options->width_item + 35)*$options->nb_cols + 15); ?>px;
   overflow: hidden;
}
<?php }?>

<?php if(($options->theme == 'theme5') || ($options->theme == 'theme6')){?>
#yt-vm-scrollbar-<?php echo $module->id; ?>, #yt-vm-scrollbar-<?php echo $module->id; ?> .yt_vm_introtext, #yt-vm-scrollbar-<?php echo $module->id; ?> .yt_vm_footertext{
   width:<?php echo (($options->item_image_width + 40)*$options->nb_cols); ?>px;
   overflow: hidden;
}
<?php }?>
#yt-vm-scrollbar-<?php echo $module->id; ?> .theme4 .pane4<?php echo $module->id;?> {
        height: <?php echo $options->height_page;?>px;
    }
#yt-vm-scrollbar-<?php echo $module->id; ?> .theme4 .yt_scrollbar .yt_scrollbar_bd .item_scrollbar_vert_theme4{
        width: <?php echo $options->width_item;?>px !important;
    }


<?php $style_theme1 = ob_get_contents(); 
@ob_end_clean();
$document = &JFactory::getDocument();
$document->addStyleDeclaration($style_theme1);?>

<?php if($options->theme == 'theme1'){?>
<script type="text/javascript">
$jsmart(document).ready(function($) {

        $('.scroll-pane<?php echo $module->id;?>').jScrollPane({
        
              showArrows: true, 
              rownumber: <?php echo $options->nb_rows;?>, 
              width_module: <?php echo $width_module; ?> ,
              width_page: <?php echo $width_page ?>,
              thumWidth:<?php echo $thumWidth; ?>
             });
          
          });

</script>
<?php }?>
    
<?php if($options->theme == 'theme3'){?>    
<script type="text/javascript">
$jsmart(document).ready(function($){
        $('.scroll-pane<?php echo $module->id;?>').jScrollPane({
          
           showArrows: true, 
           rownumber: <?php echo $options->nb_rows?>,          
           width_module: <?php echo $width_module ?> ,
           width_page: <?php echo $width_page ?>,
           thumWidth:<?php echo $thumWidth ?>
          
          });
          
        function css(el, prop) {
            return parseInt($.css(el, prop)) || 0;
        };
        function width(el) {
            return  el.offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
        };
        function height(el) {
            
            return el.offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
        };
        
           
        
    });
</script>
<?php }?>

<?php if($options->theme == 'theme2'){?>  
<script type="text/javascript">
$jsmart(document).ready(function($) {   
    $('.scroll-pane<?php echo $module->id;?>').jScrollPane({  
          showArrows: true, 
          rownumber: <?php echo $options->nb_rows?>,
          item_per_page: <?php echo $options->item_per_page ?>, 
          width_module: <?php echo $width_module ?> ,
          width_page: <?php echo $width_page ?>,
          thumWidth:<?php echo $thumWidth ?>
        });
        function css(el, prop) {
            return parseInt($.css(el, prop)) || 0;
        };
        function width(el) {
            return  el.offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
        };
        function height(el) {
            
            return el.offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
        };
        
	 var items = $(".opacity_item_title_theme2<?php echo $module->id;?>");
        var scrollbar = $(".opacity_content_scrollbar_theme2<?php echo $module->id;?>");
        
        
		
            $(scrollbar).css("top", <?php echo $options->item_image_height?> - 24);    
       
        $('.yt_opacity_scroll').hover(function(){            
            var desc = $(this).find(".opacity_content_scrollbar_theme2<?php echo $module->id;?>");
            var tt = $(desc).height()-8;
			
            $(".cover<?php echo $module->id;?>", this).stop().animate({top: <?php echo $options->item_image_height?> - tt},{queue:false,duration:160});
        }, function() {
            var title_out = $(this).find(".opacity_item_title_theme2<?php echo $module->id;?>");
            var out_tt = $(title_out).height()+5;
            $(".cover<?php echo $module->id;?>", this).stop().animate({top:<?php echo $options->item_image_height?> - out_tt},{queue:false,duration:160});
        });   
       
});
</script>
<?php }?>
    
<?php if($options->theme == 'theme4'){?>
<script type="text/javascript">
$jsmart(document).ready(function($) {
        $('.pane4<?php echo $module->id;?>').jScrollPaneVert({
          showArrows:true, 
          scrollbarWidth: 15, 
          arrowSize: 16,
          item_per_page: <?php echo $options->item_per_page;?>,
          colsnumber: <?php echo $options->nb_cols;?>,
          rowsnumber: <?php echo $options->nb_rows?>
        });
    
});
</script>
<?php }?>


<?php if($options->theme == 'theme5'){?>
<script type="text/javascript">
$jsmart(document).ready(function($) {
        $('#pane5<?php echo $module->id;?>').jScrollPaneVert({
            showArrows:true, 
            scrollbarWidth: 15, 
            arrowSize: 16,
            item_per_page: <?php echo $options->item_per_page?>,
            colsnumber: <?php echo $options->nb_cols?>,
            rowsnumber: <?php echo $options->nb_rows?>
        });
        
        function css(el, prop) {
               return parseInt($.css(el, prop)) || 0;
        };
        function width(el) {
            return  el.offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
        };
        function height(el) {
            
            return el.offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
        };
        
        var items = $(".item_content_title_vert_theme5");
        var scrollbar = $(".opacity_content_scrollbar_theme5<?php echo $module->id;?>");
        
       

			//alert(ht)
            $(scrollbar).css("top", <?php echo $options->item_image_height?> - 22);    
       
        
        $('.item_scrollbar_vert_theme5').hover(function(){
            var desc = $(this).find(".opacity_content_scrollbar_theme5<?php echo $module->id;?>");
            var tt = $(desc).height()- 5;
            $(".cover<?php echo $module->id;?>", this).stop().animate({top: <?php echo $options->item_image_height?> - tt},{queue:false,duration:160});
        }, function() {
            var title_out = $(this).find(".item_content_title_vert_theme5");
            
            <?php if($options->item_title_display == 1):?>
                var out_tt = $(title_out).height() + 3;
             <?php endif; ?>
             <?php if($options->item_title_display == 0):?>
                 var out_tt = $(title_out).height() - 10;
            <?php endif; ?>
            $(".cover<?php echo $module->id;?>", this).stop().animate({top:<?php echo $options->item_image_height?> - out_tt},{queue:false,duration:160});
        });
    
});
</script>
<?php }?>

<?php if($options->theme == 'theme6'){?>
<script type="text/javascript">
$jsmart(document).ready(function($) {
        $('.pane6<?php echo $module->id;?>').jScrollPaneVert({
              showArrows:true, 
              scrollbarWidth: 15, 
              arrowSize: 16,
              item_per_page: <?php echo $options->item_per_page;?>,
              colsnumber: <?php echo $options->nb_cols;?>,
              rowsnumber: <?php echo $options->nb_rows?>
        });
          
    
            
});
</script>
<?php }?>

<?php if (!empty($list)){?>
	<div id="yt-vm-scrollbar-<?php echo $module->id; ?>">
		 <?php if (!empty($options->pretext)){ ?>
			<div class="yt_vm_introtext" style=" padding-bottom:20px;" ><?php echo $options->pretext; ?></div>
		<?php } ?>
			<div class="yt_vm_scrollbar <?php echo $options->theme; ?>">	
				<?php 	include JModuleHelper::getLayoutPath($module->module, $params->get('theme', 'theme1')) ;?>
			</div>
		<?php if (!empty($options->posttext)){ ?>
			<div class="yt_vm_footertext"  ><?php echo $options->posttext; ?></div>
		<?php } ?>

	</div>
<?php }else{ ?>
<p>There are no product matching selection!</p>
<?php } ?>
