<?php
 /*------------------------------------------------------------------------
 # Yt News Ajax Tabs  - Version 1.0
 # Copyright (C) 2009-2010 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://joomla.ytcvn.com
 -------------------------------------------------------------------------*/
    
	defined('_JEXEC') or die('Restricted access');
    $count_product = count($items);
    $sumrows = floor($count_product/$numcols);
	$sumrows += (($count_product%$numcols)!=0)?1:0;
   
    $widthItem = $thumb_width + 10;
    $countWidth = $thumb_width * $countProductRow; 
    $countHeight = $thumb_height * 2;
    $countPadding1 = $countProductRow * 10;
    $countPadding2 = $countProductRow * 13;
    if($countProductRow == 1){
        $countPadding2 = $countProductRow * 20;
    }
    if($countProductRow == 2){
        $countPadding2 = $countProductRow * 15;
    }
    if($countProductRow == 3){
        $countPadding2 = $countProductRow * 13;
    }
    else{
        $countPadding2 = $countProductRow * 12;
    }
    
	$countpage = ($sumrows * 25) + 30;
 ?>
 
 <style type="text/css">
    #jCarouselLiteDemo .main<?php echo $module->id;?> {
       /* margin: 0px 5px 0px 25px;*/
		width: <?php echo $countWidth + $countPadding1 ?>px;
        padding-right: 10px;
    }   
     #jCarouselLiteDemo .main<?php echo $module->id;?> .primaryContent .jCarouselLite ul li{
        padding-left: 20px;
        padding-right: 20px;
        width: <?php echo $countWidth + $countPadding1 ?>px;
    }
    #jCarouselLiteDemo .main<?php echo $module->id;?> #jCarouselLiteDemo .vertical {
        width: <?php echo $countWidth + $countPadding1 ?>px;
        padding-right: 10px;
    }
    #jCarouselLiteDemo .main<?php echo $module->id;?> div .opacity{ 
        width:<?php echo $thumb_width; ?>px;
        height:60px;
    }   
    #jCarouselLiteDemo .main<?php echo $module->id;?> div #top-slide{
		float:right;
		width:<?php echo $countpage; ?>px;
		height: 27px;
		/*margin-right: -15px;*/
    }
    #jCarouselLiteDemo .main<?php echo $module->id;?> div #tabslider-text-pro{
        background-color:<?php echo $bgContent; ?>;
    }
   #jCarouselLiteDemo .main<?php echo $module->id;?> div .opacity{
        background-color:<?php echo $bgOpacity; ?>;
	}
/* CSS for layoutbottom */
	#layoutbottom_jCarouselLiteDemo .main<?php echo $module->id;?> {
       /* margin: 0px 5px 0px 25px;*/
		width: <?php echo $countWidth + $countPadding1 ?>px;
        padding-right: 10px;
    }   
     #layoutbottom_jCarouselLiteDemo .main<?php echo $module->id;?> .primaryContent .jCarouselLite ul li{
        padding-left: 20px;
        padding-right: 20px;
        width: <?php echo $countWidth + $countPadding1 ?>px;
    }
    #layoutbottom_jCarouselLiteDemo .main<?php echo $module->id;?> #layoutbottom_jCarouselLiteDemo .vertical {
        width: <?php echo $countWidth + $countPadding1 ?>px;
        padding-right: 10px;
    }
    #layoutbottom_jCarouselLiteDemo .main<?php echo $module->id;?> div .opacity{ 
        width:<?php echo $thumb_width; ?>px;
        height:60px;
    }   
    #layoutbottom_jCarouselLiteDemo .main<?php echo $module->id;?> div #top-slide{
		float:right;
		width:<?php echo $countpage; ?>px;
		height: 27px;
		/*margin-right: -15px;*/
    }
    #layoutbottom_jCarouselLiteDemo .main<?php echo $module->id;?> div #tabslider-text-pro{
        background-color:<?php echo $bgContent; ?>;
    }
   #layoutbottom_jCarouselLiteDemo .main<?php echo $module->id;?> div .opacity{
        background-color:<?php echo $bgOpacity; ?>;
	}	
	
	/* CSS for layoutleft */
	#layoutleft_jCarouselLiteDemo .main<?php echo $module->id;?> {
       /* margin: 0px 5px 0px 25px;*/
		width: <?php echo $countWidth + $countPadding1 ?>px;
        padding-right: 10px;
    }   
     #layoutleft_jCarouselLiteDemo .main<?php echo $module->id;?> .primaryContent .jCarouselLite ul li{
        padding-left: 20px;
        padding-right: 20px;
        width: <?php echo $countWidth + $countPadding1 ?>px;
    }
    #layoutleft_jCarouselLiteDemo .main<?php echo $module->id;?> #layoutleft_jCarouselLiteDemo .vertical {
        width: <?php echo $countWidth + $countPadding1 ?>px;
        padding-right: 10px;
    }
    #layoutleft_jCarouselLiteDemo .main<?php echo $module->id;?> div .opacity{ 
        width:<?php echo $thumb_width; ?>px;
        height:60px;
    }   
    #layoutleft_jCarouselLiteDemo .main<?php echo $module->id;?> div #top-slide{
		float:right;
		width:<?php echo $countpage; ?>px;
		height: 27px;
		/*margin-right: -15px;*/
    }
    #layoutleft_jCarouselLiteDemo .main<?php echo $module->id;?> div #tabslider-text-pro{
        background-color:<?php echo $bgContent; ?>;
    }
   #layoutleft_jCarouselLiteDemo .main<?php echo $module->id;?> div .opacity{
        background-color:<?php echo $bgOpacity; ?>;
	}	
	
</style>
<script type="text/javascript">
    var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

    };
    </script>

<script type="text/javascript">
//if(typeof(JYTC<?php echo $module->id; ?>)=='undefined') JYTC<?php echo $module->id; ?> = jQuery.noConflict();             
           	
    $jYtc(".main<?php echo $cate_id.$module->id;?> .jCarouselLite").jCarouselLite({
		numimage:<?php echo $cate_id; ?>,
        speed: <?php echo $slideshow_speed;?>,
        moduleId:<?php echo $module->id;?>,
        catId:<?php echo $category[$ci];?>,
        numberRow: <?php echo $number_rows_tab;?>,
        easing: "easeinout",
		visible: 1
    });


</script>

<?php if($StyleThemes == 'right'):?>
    
    <script type="text/javascript">
        //if(typeof(JYTC)=='undefined')
    	//JYTC = jQuery.noConflict();
        var tabHeight
    	$jYtc(document).ready(function($){
    		function css(el, prop) {
    	    	return parseInt($jYtc.css(el, prop)) || 0;
    		};
    		function width(el) {
    			return  el.offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
    		};
    		function height(el) {
    			
    			return el.offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
    		};
            
          
            var arrTabInnerRight = $('.inner_right_multi');
            var maxWidthTabInnerRight = 0;
            $.each(arrTabInnerRight,function(key, val){
                if(maxWidthTabInnerRight<$(val).width()){
                    maxWidthTabInnerRight = $(val).width(); 
                }
              
            });
            
            $.each(arrTabInnerRight,function(key,val){
                 $(val).css('width',maxWidthTabInnerRight);       
            });

            var arrImageTabLayout = $('#ytc-layoutright-tab-<?php echo $category[$ci].'_'.$module->id; ?>');
            
            
        
    		var arrImage = $('a.ytc-layoutright-tab-<?php echo $category[$ci].'_'.$module->id; ?>');
            var maxWidthTab = 0;
            $.each(arrImage,function(key, val){
                if(maxWidthTab<$(val).width()){
                    maxWidthTab = $(val).width(); 
                }
              
            });
            
            $.each(arrImage,function(key,val){
                 $(val).css('width',maxWidthTab);       
            });
            
            var arrImageWrapItems = $('div.wrap-items<?php echo $cate_id.$module->id;?>');
            BrowserDetect.init();
            if(BrowserDetect.browser=="Explorer")
            {
                var maxHeight = 0;
                $.each(arrImageWrapItems,function(key, val){
                    if(maxHeight<$(val).height()){
                        maxHeight = $(val).height(); 
                    }
                  
                });
                $.each(arrImageWrapItems,function(key,val){
                    $(val).css('height',maxHeight);       
                });
                var maxWidth = 0;
                $.each(arrImageWrapItems,function(key, val){
                    if(maxWidth<$(val).width()){
                        maxWidth = $(val).width(); 
                    }
                  
                });
    
                $.each(arrImageWrapItems,function(key,val){
                     $(val).css('width',maxWidth);       
                });
            }
            
            else{   
                var maxWidth = 0;
                $.each(arrImageWrapItems,function(key, val){
                    if(maxWidth<$(val).width()){
                        maxWidth = $(val).width(); 
                    }
                  
                });
    
                $.each(arrImageWrapItems,function(key,val){
                     $(val).css('width',maxWidth);       
                });
            }
            BrowserDetect.init();
            if(BrowserDetect.browser=="Explorer")
            {
                tabHeight = (maxHeight * <?php echo $number_rows_tab;?>) + 40;       
                var heightRow = maxHeight * 3;
                arrTabMod<?php echo $module->id; ?>['<?php echo "tab".$tabNumber;?>'] = tabHeight;    
                
                $('.tab_inner').css('height',tabHeight + 30 +'px');
                $('#layoutright_border_tab<?php echo $category[$ci].'_'.$module->id; ?>').css('height',(maxHeight * <?php echo $countcols ?>)+43 +'px');
                $('.jCarouselLite<?php echo $module->id;?>').css('height',(tabHeight - 20)+'px');
                $('.tab-inner-right_right').css('width',(maxWidthTabInnerRight) +'px');
                $('.tab-inner-right_left').css('height',((tabHeight + 25)+'px'));
                $('#ytc-layoutright-tab-<?php echo $category[$ci].'_'.$module->id; ?>').css('height',(maxHeight * <?php echo $countcols ?>)+43 +'px');                
              
            }
            else{
               arrTabMod<?php echo $module->id; ?>['<?php echo "tab".$tabNumber;?>'] = tabHeight;  
                $('.tab_inner').css('height',tabHeight +'px');
                $('.tab-inner-right_right').css('width',(maxWidthTabInnerRight) +'px');
                $('.tab-inner-right_left').css('height',((tabHeight - 5)+'px'));
            }
            
    	});
    </script>
<?php endif;?>

<?php if($StyleThemes == 'left'):?>   
    <script type="text/javascript">
        //if(typeof(JYTC)=='undefined')
    	//JYTC = jQuery.noConflict();
        var tabHeight
    	$jYtc(document).ready(function($){
    
            var arrTabInnerRight = $('.inner_left_multi');
            var maxWidthTabInnerRight = 0;
            $.each(arrTabInnerRight,function(key, val){//alert('123456');
                if(maxWidthTabInnerRight<$(val).width()){
                    maxWidthTabInnerRight = $(val).width(); 
                }
              
            }); 
            $.each(arrTabInnerRight,function(key,val){
                 $(val).css('width',maxWidthTabInnerRight);       
            });  
            var arrImageTabLayout = $('#ytc-layoutleft-tab-<?php echo $category[$ci].'_'.$module->id; ?>');
            var maxHeightLayout = 0;
            $.each(arrImageTabLayout,function(key, val){//alert('123456');
                if(maxHeightLayout<$(val).height()){
                    maxHeightLayout = $(val).height(); 
                }
              
            });
            
            $.each(arrImageTabLayout,function(key,val){
                 $(val).css('height',maxHeightLayout);       
            });

    		var arrImageWrapItems = $('div.wrap-items<?php echo $cate_id.$module->id;?>');
            
            BrowserDetect.init();
            if(BrowserDetect.browser=="Explorer")
            {
                var maxHeight = 0;
                $.each(arrImageWrapItems,function(key, val){
                    if(maxHeight<$(val).height()){
                        maxHeight = $(val).height(); 
                    }
                  
                });
                
                $.each(arrImageWrapItems,function(key,val){
                     $(val).css('height',maxHeight);       
                });
            }
            
           
            else{
                var maxWidth = 0;
                $.each(arrImageWrapItems,function(key, val){
                    if(maxWidth<$(val).width()){
                        maxWidth = $(val).width(); 
                    }
                  
                });
                $.each(arrImageWrapItems,function(key,val){
                     $(val).css('width',maxWidth);       
                });
            }
            BrowserDetect.init();
            if(BrowserDetect.browser=="Explorer")
            {
                tabHeight = (maxHeight * <?php echo $number_rows_tab ?>) + 40; //alert(tabHeight);
                var heightRow = maxHeight * 3;
                
                arrTabMod<?php echo $module->id; ?>['<?php echo "tab".$tabNumber;?>'] = tabHeight; 
                
                $('.tab_inner_left').css('height',tabHeight+'px');
                $('#layoutleft_border_tab<?php echo $category[$ci].'_'.$module->id; ?>').css('height',(maxHeight * <?php echo $countcols ?>)+30 +'px');
                $('.jCarouselLite<?php echo $module->id;?>').css('height',(tabHeight) - 35 +'px');
                
                $('.tab-inner-left').css('width',(maxWidthTabInnerRight) +'px');
                $('.tab-inner-right').css('height',((tabHeight)+'px'));
            }
            else
            {
                arrTabMod<?php echo $module->id; ?>['<?php echo "tab".$tabNumber;?>'] = tabHeight; 
                
                $('.tab_inner_left').css('height',tabHeight +'px');
                $('.jCarouselLite<?php echo $module->id;?>').css('height',(tabHeight) - 50 +'px');
                
                $('.tab-inner-left').css('width',(maxWidthTabInnerRight) +'px');
                $('.tab-inner-right').css('height',((tabHeight - 5)+'px'));
            }
           });
        
    </script>
<?php endif;?>