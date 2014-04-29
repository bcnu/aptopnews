<?php 
/*------------------------------------------------------------------------
 # Yt News Ajax Tabs  - Version 1.0
 # Copyright (C) 2009-2010 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://joomla.ytcvn.com
 -------------------------------------------------------------------------*/
 
defined('_JEXEC') or die('Restricted access');


$mainframe = JFactory::getApplication();
if(is_file(JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.$module->module.DS.'libs-ajax.php')){
	require( JPATH_BASE .DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.$module->module.DS.'libs-ajax.php' );
}else{
	require( JPATH_BASE .DS.'modules'.DS.'mod_yt_news_ajax_tabs'.DS.'assets'.DS.'libs-ajax.php' );
}

	
?>



<!--Intro Text-->
<?php if($intro): ?>
<div style="text-align:left;font-size:12px; width:<?php echo $width_page; ?>px">
	<?php  echo $intro;?>
</div>
<?php endif;?>
<!--End Intro Text--> 

<div id="ytc-layoutleft-tab-container">
	<div id="tab_inner_left" class="tab_inner_l" style="width: <?php echo (($thumb_width + 20) * $countProductRow + ($width_layout_tab + 12));?>px !important;">
    
	<div class="tab-inner-left inner_left_multi">
    
    	<ul class="layoutleft_tabs-tabs layoutleft_tabs-tabs<?php echo $module->id;?>">
   		<?php for($ci=0; $ci<count($category); $ci++){ ?>	
            <li id="li-tab<?php echo $category[$ci].'_'.$module->id; ?>">
                <a style="background: none;" class="ytc-layoutleft-tab-<?php echo $category[$ci].'_'.$module->id; ?>">
                	<span><?php echo $cat_name[$ci]; ?></span>
                </a>
            </li>
		<?php } ?>
        </ul>
        
    </div>
    
    <div class="tab-inner-right" style="width: <?php echo (($thumb_width + 20) * $countProductRow)+16;?>px;">
        <?php for($ci=0; $ci<count($category); $ci++){ ?> <script type="text/javascript">arrTabMod<?php echo $module->id; ?>['<?php echo "tab".$category[$ci];?>']=0;</script>	
        
        <div id="ytc-layoutleft-tab-<?php echo $category[$ci].'_'.$module->id; ?>" style="border-color: <?php echo $module_bg_color ?>; color:<?php echo $color_text_tabs;?> !important;" class="tabs-content tabs-content<?php echo $module->id; ?> ytc-layoutleft-tabs-content-tab<?php echo $category[$ci].'_'.$module->id; ?>">
            <div class="load_ajax">&nbsp;</div>
        </div>
   		<?php } ?>
        
    </div>   
    
    <div class="clear" style="clear:both; line-height:0px;"></div>
	</div>
</div>     

<!--Start Footer Text-->
<?php if($note): ?>
<div style="text-align:left;font-size:12px; width:<?php echo $width_page; ?>px">
	<?php  echo $note;?>
</div>
<?php endif;?>
<!--End Footer Text-->
