<?php
/*------------------------------------------------------------------------
 # Yt News Ajax Tabs  - Version 1.0
 # Copyright (C) 2009-2010 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://joomla.ytcvn.com
 -------------------------------------------------------------------------*/
 
 
    defined('_JEXEC') or die('Restricted access');
    //echo "This is theme".$StyleThemes;die;
 if($StyleThemes == 'top' || $StyleThemes == 'bottom'){
        
    $ads =& JFactory::getURI();
    $check_ads = $ads->toString(); 
    if( strpos($check_ads,"&") > 0){	
    }elseif(strpos($check_ads,"?")==false){ 
    	$check_ads = $check_ads.'?index.php';
    }
    $path = array();
    for($ci=0; $ci<count($category); $ci++){
    	$path[$ci] = JRoute::_($check_ads.'\u0026tstype=tabslider_ajax\u0026tabslider=tab'.$category[$ci].'_'.$module->id ); 
    }
    if($tab!=''){
    	$path_first = JRoute::_($check_ads.'\u0026tstype=tabslider_ajax\u0026tabslider='.$tab.'_'.$module->id);
    	}else{
    	$path_first = JRoute::_($check_ads.'\u0026tstype=tabslider_ajax\u0026tabslider=tab'.$select_tab_display.'_'.$module->id);
    }
}
elseif($StyleThemes == 'right' || $StyleThemes == 'left'){
    $ads =& JFactory::getURI();
    $check_ads = $ads->toString(); 
    
    if( strpos($check_ads,"&") > 0){
    	
    }elseif(strpos($check_ads,"?")==false){ 
    	$check_ads = $check_ads.'?index.php';
    }
    
    $path = array();
    for($ci=0; $ci<count($category); $ci++){
    	$path[$ci] = JRoute::_($check_ads.'\u0026tstype=tabslider_ajax\u0026tabslider=tab'.$category[$ci].'_'.$module->id.'\u0026tabNumber='.$category[$ci]);
    }
    
    if($tab!=''){
    	$path_first = JRoute::_($check_ads.'\u0026tstype=tabslider_ajax\u0026tabslider='.$tab.'_'.$module->id.'\u0026tabNumber=0') ;
    	}else{
    	$path_first = JRoute::_($check_ads.'\u0026tstype=tabslider_ajax\u0026tabslider=tab'.$select_tab_display .'_'.$module->id.'\u0026tabNumber='.$select_tab_display);
    }
}
?>
<?php if($StyleThemes == 'top'):?>
<style>
    #tabtop-container ul.tabs-tabs li.active{
	background:<?php echo $module_bg_color;?> !important;
	color:#2E2D2A;
	margin-bottom:0px;
	border-bottom: none !important;
    }
    #tabtop-container ul.tabs-tabs li.active a{ color:#FFFFFF;}
    
    .tabslider_button_img<?php echo $module->id;?>{
        cursor: pointer;
    	margin:3px 2px 10px !important;
    	height:16px;
    	width:18px;
        color: <?php echo $module_bg_color ?> !important;
        background:none; 
        line-height: normal !important;
    }
    #tabtop-container ul.tabs-tabs_multi<?php echo $module->id;?> li{ 
    	background:<?php echo $cat_bg_none?> !important;
    }
    .tabslider_button_img_selected<?php echo $module->id;?>{
    	margin:3px 2px 10px !important;
    	height:16px;
    	width:18px;
        color:<?php echo $color_text_tabs;?> !important;
        background:<?php echo $module_bg_color ?> !important;
        line-height: normal !important;
    }
    
    
	#tabtop-container ul.tabs-tabs li {
		border-bottom:1px solid <?php echo $color_text_tabs ?> !important;
	}
    #tabtop-container ul.tabs-tabs li.active{
		border-bottom:<?php echo $module_bg_color ?> 1px solid !important;
	}
	
    #tabtop-container ul.tabs-tabs li a {
        color:<?php echo $color_text_tabs ?> !important;
    	font-weight:bold;    	
    }
    #tabtop-container ul.tabs-tabs li a span{
        color:<?php echo $color_text_tabs ?> !important;
    	font-weight:bold;    	
    }
</style>
<script type="text/javascript">
	//if(typeof(JYTC<?php echo $module->id; ?>)=='undefined') JYTC<?php echo $module->id; ?> = jQuery.noConflict();  
	$jYtc(document).ready(function($) {
        $(".load_ajax").html('<img id="loading" style="padding:50px 0px 50px <?php echo (($thumb_width) * ($countProductRow) )/2?>px;" src="<?php echo JURI::base() ."modules/mod_yt_news_ajax_tabs/image/loader_a.gif"; ?>" />');
		//Hide all content ex: class = .tabs-content74
		$(".tabs-content-top<?php echo $module->id; ?>").hide();
		// Add class to tag li width ex: li#li-tab1_74
		$("ul.tabs-tabs_multi<?php echo $module->id;?> li#li-<?php if($tab!=''){ echo $tab.'_'.$module->id; } else{ echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").addClass("active clicked").show(); 
		// Show content width ex: li#li-tab1_74
		$(".tabs-content-<?php if($tab!=''){ echo $tab.'_'.$module->id;} else{echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").show(); 
		// put data to div ex: .tabs-content-tab1_74
		$.post("<?php echo $path_first ?>", function(data){
			$(".tabs-content-<?php if($tab!=''){ echo $tab.'_'.$module->id;} else{echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").html(data);
		 });
	
		//On Click Event
		$("ul.tabs-tabs_multi<?php echo $module->id;?> li").click(function() {
			$("ul.tabs-tabs_multi<?php echo $module->id;?> li").removeClass("active"); //Remove any "active" class
			
		var clicked = $(this).attr("class");
		if(clicked=='clicked'){ 
		
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".tabs-content-top<?php echo $module->id; ?>").hide(); //Hide all tab content
			var activeTab = $(this).find("a").attr("class");
		
			$("#"+activeTab).show();
		
		}else{
			
			$(this).addClass("active clicked"); //Add "active" class to selected tab
			$(".tabs-content-top<?php echo $module->id; ?>").hide(); //Hide all tab content
			
			var activeTab = $(this).find("a").attr("class");
		
			$("#"+activeTab).show();
			$("#"+activeTab).html('<img id="loading" style="padding:50px 0px 50px <?php echo (($thumb_width) * ($countProductRow) )/2?>px;" src="<?php echo JURI::base() ."modules/mod_yt_news_ajax_tabs/image/loader_a.gif"; ?>" />');
			<?php for($ci=0; $ci<count($category); $ci++){ ?>
				if(activeTab == 'tab-<?php echo $category[$ci].'_'.$module->id; ?>'){ 			
					$.post("<?php echo $path[$ci]; ?>", function(data){
						//put data to div width id: #tab-1_74
						$('#tab-<?php echo $category[$ci].'_'.$module->id; ?>').html(data);
					});	
				}
			<?php } ?>
				
			
		}
		});	
		
	});
</script>
<?php endif;?>

<?php if($StyleThemes == 'bottom'):?>
<style>
    
    
    #ytc-layoutbottom-tab-container ul.layoutbottom_tabs-tabs<?php echo $module->id;?> li{ 
    	background:<?php echo $cat_bg_none?> !important;
    }
    
    .tabslider_button_img_selected<?php echo $module->id;?>{
    	margin:3px 2px 5px !important;
    	height:16px;
    	width:18px;
        background:<?php echo $module_bg_color ?> !important; 
        color:<?php echo $color_text_tabs;?> !important;
    }
    .tabslider_button_img<?php echo $module->id;?>{
        cursor: pointer;
    	margin:3px 2px 5px !important;
    	height:16px;
    	width:18px;
        background: none !important;
        color: <?php echo $module_bg_color ?> !important;
    }
    #ytc-layoutbottom-tab-container ul.layoutbottom_tabs-tabs li{ 
   	     border-top:1px solid <?php echo $color_text_tabs ?> !important;
    }
    #ytc-layoutbottom-tab-container ul.layoutbottom_tabs-tabs li.active{
    	background:<?php echo $module_bg_color ?> !important;
        border-top:1px solid <?php echo $module_bg_color ?> !important;
    	color:#2E2D2A;
    } 
    #ytc-layoutbottom-tab-container ul.layoutbottom_tabs-tabs li a { 
    	color:<?php echo $color_text_tabs ?> !important;
    	font-weight:bold;
        background: none !important;
    }    
</style>
   
<script type="text/javascript">
	//if(typeof(JYTC<?php echo $module->id; ?>)=='undefined')
	//JYTC<?php echo $module->id; ?> = jQuery.noConflict();	
	$jYtc(document).ready(function($) {
		
		//When page loads...
		$(".load_ajax").html('<img id="loading" style="padding:50px 0px 50px <?php echo (($thumb_width) * ($countProductRow) )/2?>px;" src="<?php echo JURI::base() ."modules/mod_yt_news_ajax_tabs/image/loader_a.gif"; ?>" alt="loadding" />');
		$(".tabs-content-bottom<?php echo $module->id; ?>").hide(); //Hide all content
		$("ul.layoutbottom_tabs-tabs<?php echo $module->id;?> li#li-<?php if($tab!=''){ echo $tab.'_'.$module->id; } else{ echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").addClass("active clicked").show(); 
		$(".ytc-layoutbottom-tabs-content-<?php if($tab!=''){ echo $tab.'_'.$module->id;} else{echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").show(); 
		$.post("<?php echo $path_first ?>", function(data){
		  
			$(".ytc-layoutbottom-tabs-content-<?php if($tab!=''){ echo $tab.'_'.$module->id;} else{echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").html(data);
            
		 });
	
		//On Click Event
		$("ul.layoutbottom_tabs-tabs<?php echo $module->id;?> li").click(function() {
			$("ul.layoutbottom_tabs-tabs<?php echo $module->id;?> li").removeClass("active"); //Remove any "active" class
			
			var clicked = $(this).attr("class");
			if(clicked=='clicked'){
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tabs-content-bottom<?php echo $module->id; ?>").hide(); //Hide all tab content		
				var activeTab = $(this).find("a").attr("class");		
				$("#"+activeTab).show();
				
			}else{
				$(this).addClass("active clicked"); //Add "active" class to selected tab
				$(".tabs-content-bottom<?php echo $module->id; ?>").hide(); //Hide all tab content			
				var activeTab = $(this).find("a").attr("class");			
				$("#"+activeTab).show();
				$("#"+activeTab).html('<img id="loading" style="padding:50px 0px 50px <?php echo (($thumb_width) * ($countProductRow ) )/2?>px;" src="<?php echo JURI::base() ."modules/mod_yt_news_ajax_tabs/image/loader_a.gif"; ?>" alt="loadding" />');
				<?php for($ci=0; $ci<count($category); $ci++){ ?>
					if(activeTab == 'ytc-layoutbottom-tab-<?php echo $category[$ci].'_'.$module->id; ?>'){			
						$.post("<?php echo $path[$ci]; ?>", function(data){
							$('#ytc-layoutbottom-tab-<?php echo $category[$ci].'_'.$module->id; ?>').html(data); 
						});	
						
					}
				<?php } ?>
			}
			
		});
		
	});
</script>
<?php endif;?>

<?php if($StyleThemes == 'right'):?>
    <style>
        #ytc-layoutright-tab-container #inner_tab_right{
        	background:<?php echo $module_bg_color?> !important;
        	margin:0;
        	/*height:330px;*/
    	}
        #ytc-layoutright-tab-container .tab-inner-right_left{
        	float:left;
        	background:#FFFFFF;
        	padding:0 10px 0 0 !important;
        	/*height:323px;*/
        	border-top: 5px solid <?php echo $module_bg_color?> !important;
        	border-left:1px solid <?php echo $module_bg_color?> !important;
        }
        #ytc-layoutright-tab-container .tab-inner-right_right{
    	   background: <?php echo $module_bg_color?> !important;
        }
        #ytc-layoutright-tab-container ul.layoutright_tabs-tabs li.active{
        	background:<?php echo $module_bg_color?> !important;
        	color:#2E2D2A;
        }
        #ytc-layoutright-tab-container ul.layoutright_tabs-tabs_right<?php echo $module->id;?> li{ 
        	background:<?php echo $cat_bg_none?> !important;
        }
        .tabslider_button_img_selected<?php echo $module->id;?>{
        	margin:3px 2px 10px !important;
        	height:16px;
        	width:18px;
            color:<?php echo $color_text_tabs;?> !important;
            background:<?php echo $module_bg_color ?> !important; 
        }
        .tabslider_button_img<?php echo $module->id;?>{
            cursor: pointer;
        	margin:3px 2px 10px !important;
        	height:16px;
        	width:18px;
            color: <?php echo $module_bg_color ?> !important;
            background:none !important; 
        }
    </style>

    <script type="text/javascript">
        var maxHeightTabInner = 0;
    	//if(typeof(JYTC<?php echo $module->id; ?>)=='undefined')
    		//JYTC<?php echo $module->id; ?> = jQuery.noConflict();  
    		
    	$jYtc(document).ready(function($) {
    		//When page loads...
    		$(".load_ajax").html('<img id="loading" style="padding:50px 0px 50px <?php echo (($thumb_width) * ($countProductRow) )/2?>px;" src="<?php echo JURI::base() ."modules/mod_yt_news_ajax_tabs/image/loader_a.gif"; ?>" />');
    		$(".tabs-content<?php echo $module->id; ?>").hide(); //Hide all content
    		$("ul.layoutright_tabs-tabs_right<?php echo $module->id;?> li#li-<?php if($tab!=''){ echo $tab.'_'.$module->id; } else{ echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").addClass("active clicked").show(); 
    		$(".ytc-layoutright-tabs-content-<?php if($tab!=''){ echo $tab.'_'.$module->id;} else{echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").show(); 
    		
    		$.post("<?php echo $path_first ?>", function(data){
    			$(".ytc-layoutright-tabs-content-<?php if($tab!=''){ echo $tab.'_'.$module->id;} else{echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").html(data);
    		 });
    	
    		//On Click Event
    		$("ul.layoutright_tabs-tabs_right<?php echo $module->id;?> li").click(function() {
    			$("ul.layoutright_tabs-tabs_right<?php echo $module->id;?> li").removeClass("active"); //Remove any "active" class
                var arrid = this.id.split("-");
                var tabId =  arrid[1].split("_");
                var clicked = $(this).attr("class");
    			if(clicked=='clicked'){ 
                    if(tabId[0])
                    {
						
                        $('.tab_inner').css('height',arrTabMod<?php echo $module->id; ?>[tabId[0]] + 30 +'px');
                        $('.jCarouselLite<?php echo $module->id;?>').css('height',(arrTabMod<?php echo $module->id; ?>[tabId[0]]) - 20 +'px');
                        $('.tab-inner-right_left').css('height',((arrTabMod<?php echo $module->id; ?>[tabId[0]] + 25)+'px'));
                    }
    			    
    				$(this).addClass("active"); //Add "active" class to selected tab
    				$(".tabs-content<?php echo $module->id; ?>").hide(); //Hide all tab content			
    				var activeTab = $(this).find("a").attr("class");		
    				$("#"+activeTab).show();
    			
    			}else{
    				$(this).addClass("active clicked"); //Add "active" class to selected tab
    				$(".tabs-content<?php echo $module->id; ?>").hide(); //Hide all tab content				
    				var activeTab = $(this).find("a").attr("class");			
    				$("#"+activeTab).show();
    				$("#"+activeTab).html('<img id="loading" style="padding:50px 0px 50px <?php echo (($thumb_width) * ($countProductRow) )/2?>px;; margin:10px;" src="<?php echo JURI::base() ."modules/mod_yt_news_ajax_tabs/image/loader_a.gif"; ?>" />');
    				<?php for($ci=0; $ci<count($category); $ci++){ ?>
    					if(activeTab == 'ytc-layoutright-tab-<?php echo $category[$ci].'_'.$module->id; ?>'){ 			
    						$.post("<?php echo $path[$ci]; ?>", function(data){
    							
    							$('#ytc-layoutright-tab-<?php echo $category[$ci].'_'.$module->id; ?>').html(data);
    						});	
    					}
    				<?php } ?>
    			}
    		});
    		
    	});
    
        var arrTabMod<?php echo $module->id; ?> = {};
    </script>
<?php endif;?>

<?php if($StyleThemes == 'left'):?>
<?php 
	$mainframe = JFactory::getApplication();
	$doc = JFactory::getDocument();
	$style ="";
	$style .='
		#ytc-layoutleft-tab-container ul.layoutleft_tabs-tabs'.$module->id.' li.active{	
        	background: url("'.JURI::base().'templates/'.$mainframe->getTemplate().'/images/tab-ajax-active.gif") no-repeat top left;
			background-color:transparent !important;
			height:37px;
			width:'.$width_layout_tab.'px;
        }
		.rtl #ytc-layoutleft-tab-container ul.layoutleft_tabs-tabs'.$module->id.' li.active{	
        	background:url("'.JURI::base().'templates/'.$mainframe->getTemplate().'/images/tab-ajax-active_rtl.gif") no-repeat top right;
			background-color:transparent !important;
        }
        #ytc-layoutleft-tab-container ul.layoutleft_tabs-tabs'.$module->id.' li{ 
        	height:37px;
			background:#f3f5ff;
			line-height:37px;
			width:'.($width_layout_tab -15).'px;
        }
		.black #ytc-layoutleft-tab-container ul.layoutleft_tabs-tabs'.$module->id.' li{ 
			background-color:#F0F0F0;
        }
        .tabslider_button_img_selected'.$module->id.'{
			background:url("'.JURI::base().'templates/'.$mainframe->getTemplate().'/images/paging-button-ajaxtab.png") no-repeat 0 0 !important;          
        }
		.black .tabslider_button_img_selected'.$module->id.'{
			background:url("'.JURI::base().'templates/'.$mainframe->getTemplate().'/images/black/paging-button-ajaxtab.png") no-repeat 0 -6px !important;          
        }
	';
	$doc->addStyleDeclaration($style);
?>
    
    <script type="text/javascript">
		// <![CDATA[
    	//if(typeof(JYTC<?php echo $module->id; ?>)=='undefined')
    		//JYTC<?php echo $module->id; ?> = jQuery.noConflict();  
            $jYtc(document).ready(function($) {
    		
    		//When page loads...
    		$(".load_ajax").html('<img id="loading" style="padding:50px 0px 50px <?php echo (($thumb_width) * ($countProductRow) )/2?>px;" src="<?php echo JURI::base() ."modules/mod_yt_news_ajax_tabs/image/loader_a.gif"; ?>" alt="loadding" />');
    		$(".tabs-content<?php echo $module->id; ?>").hide(); //Hide all content
    		$("ul.layoutleft_tabs-tabs<?php echo $module->id; ?> li#li-<?php if($tab!=''){ echo $tab.'_'.$module->id; } else{ echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").addClass("active clicked").show(); 
    		$(".ytc-layoutleft-tabs-content-<?php if($tab!=''){ echo $tab.'_'.$module->id;} else{echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").show(); 
    		
    		$.post("<?php echo $path_first ?>", function(data){
    			$(".ytc-layoutleft-tabs-content-<?php if($tab!=''){ echo $tab.'_'.$module->id;} else{echo 'tab'.$select_tab_display.'_'.$module->id;} ?>").html(data);
    		 });
    	
    		//On Click Event
    		$("ul.layoutleft_tabs-tabs<?php echo $module->id; ?> li").click(function() {
    			$("ul.layoutleft_tabs-tabs<?php echo $module->id; ?> li").removeClass("active"); //Remove any "active" class
                var arrid = this.id.split("-");
                var tabId =  arrid[1].split("_");
                var clicked = $(this).attr("class");
    			var clicked = $(this).attr("class");
    			if(clicked=='clicked'){
                    if(tabId[0])
                    {                
                        $('.tab_inner_left').css('height',arrTabMod<?php echo $module->id; ?>[tabId[0]] + 30 +'px');
                        $('.jCarouselLite<?php echo $module->id;?>').css('height',(arrTabMod<?php echo $module->id; ?>[tabId[0]]) - 20 +'px');
                        $('.tab-inner-right').css('height',((arrTabMod<?php echo $module->id; ?>[tabId[0]] + 25)+'px'));
                    }
    				$(this).addClass("active"); //Add "active" class to selected tab
    				$(".tabs-content<?php echo $module->id; ?>").hide(); //Hide all tab content			
    				var activeTab = $(this).find("a").attr("class");
    				$("#"+activeTab).show();
    				
    			}else{
    				$(this).addClass("active clicked"); //Add "active" class to selected tab
    				$(".tabs-content<?php echo $module->id; ?>").hide(); //Hide all tab content
    				
    				var activeTab = $(this).find("a").attr("class"); 
    			
    				$("#"+activeTab).show();
    				$("#"+activeTab).html('<img id="loading" style="padding:50px 0px 50px <?php echo (($thumb_width) * ($countProductRow) )/2?>px; margin:10px;" src="<?php echo JURI::base() ."modules/mod_yt_news_ajax_tabs/image/loader_a.gif"; ?>" alt="loadding" />');
    				<?php for($ci=0; $ci<count($category); $ci++){ ?>
    					if(activeTab == 'ytc-layoutleft-tab-<?php echo $category[$ci].'_'.$module->id; ?>'){ 			
    						$.post("<?php echo $path[$ci]; ?>", function(data){
    							
    							$('#ytc-layoutleft-tab-<?php echo $category[$ci].'_'.$module->id; ?>').html(data);
    						});	
    					}
    				<?php } ?>
    			}
    			
    		});
    		
    	});
        var arrTabMod<?php echo $module->id; ?> = {};
		// ]]> 
    </script>
<?php endif;?>