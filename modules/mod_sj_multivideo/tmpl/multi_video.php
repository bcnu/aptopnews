<?php
/**
 * @package Sj Multi Video
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

JHTML::_('behavior.mootools');
JHTML::_('script','swfobject.js','modules/mod_sj_multivideo/assets/js/');
?>

<div class="yt_video_wrap">
	<div id="video_player<?php echo $module->id; ?>">		
	</div>
</div>
<script type="text/javascript">
	window.addEvent('domready',function(){
		var ytVideo<?php echo $module->id; ?> = new SWFObject(
		"<?php echo JURI::base()?>modules/mod_sj_multivideo/assets/images/player.swf",
		"video<?php echo $module->id; ?>",
		"<?php echo $params->get('video_width'); ?>",
		"<?php echo $params->get('video_height'); ?>",
		"<?php echo $params->get('flash_version'); ?>"	
		);
		ytVideo<?php echo $module->id; ?>.addParam("allowfullscreen","true");
		ytVideo<?php echo $module->id; ?>.addParam("allowscriptaccess","always");
		ytVideo<?php echo $module->id; ?>.addParam("wmode","opaque");
		ytVideo<?php echo $module->id; ?>.addVariable("width");  
		ytVideo<?php echo $module->id; ?>.addVariable("height");
		ytVideo<?php echo $module->id; ?>.addParam("flashvars","file=<?php echo $video; ?><?php echo $preview; ?><?php echo $logo; ?><?php echo $link; ?><?php echo $repeat; ?><?php echo $shuffle; ?><?php echo $autostart; ?><?php echo $controlbar; ?><?php echo $skin; ?>");
		ytVideo<?php echo $module->id; ?>.write("video_player<?php echo $module->id; ?>");  		
	});
</script>