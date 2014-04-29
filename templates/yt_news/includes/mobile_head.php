<?php
$doc->addScript($yt->templateurl().'js/mobilepopup.js');
$doc->addCustomTag('
<script type="text/javascript">
	function MobileRedirectUrl(){
	  window.location.href = document.getElementById("yt-mobilemenu").value;
	}
</script>
');

?>

<div id="yt_mobile_tool">
	<div class="inline_logo">
    <?php if($this->countModules('top2')) : 
		define('YTLOGIN_MOBILE', 1);
		$user = JFactory::getUser(); 
		if (!$user->guest){		
	?>
    	<a href="#" id="btn_ogin">Hi <?php echo JFactory::getUser()->get('username'); ?></a>
    <?php
		}else{
	?>    
    	<a href="#" id="btn_login">Login</a>
        <a href="#" id="btn_regis">Register</a>
    <?php 
		}
	endif; ?>
    </div>
	<div class="inline_menu">
    <?php if($this->countModules('nav2')) : ?>    
    	<a href="#" id="btn_search">Search</a>
    <?php endif; ?>
    </div>
</div>    
<div id="yt_mobile_content">
	<?php if($this->countModules('top2')) : ?>    
        <jdoc:include type="modules" name="top2" style="xhtml" />
    <?php endif; ?>
    
    <?php if($this->countModules('nav2')) : ?>
    <div id="m_search" class="mod_wrap_inner" >
        <a href="#" class="close-popup" id="btn_search_closepop">close</a>
        <jdoc:include type="modules" name="nav2" style="ytmod" />
    </div>
    <?php endif; ?>
</div>




<script type="text/javascript" language="javascript">
	window.addEvent("load", function(){     
		new MobilePop('btn_search', {
			id: 'm_search'
		});
		new MobilePop('btn_login', {
			id: 'm_login'
		});
		new MobilePop('btn_regis', {
			id: 'm_regis'
		});
	});
</script>