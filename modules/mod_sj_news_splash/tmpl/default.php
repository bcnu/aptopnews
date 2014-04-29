<?php
/**
 * @package Sj News Splash
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

$options=$params->toObject();
 ?>

<div class="yt-yttitleflash">
	<?php if($options->module_title_display == 1 ) : ?>
		<div id="breakingnews-title">
			<span class="title">
				<?php echo $options->module_title; ?>:
			</span>
		</div>
	<?php endif; ?>
	<div id="yttitleflash<?php echo $module->id; ?>" class="sliderwrapper">
		<?php foreach($list as $itemSubject) : ?>
			<div class="contentdiv">
				 <a href="<?php echo $itemSubject['link']; ?>" class="toc">
					<span>
						<?php echo Ytools::truncate($itemSubject['title'],$options->item_title_max_characs); ?>
					</span>
				 </a>
				 <?php if($options->item_desc_display == 1): ?>
					<span class="yt-titleflash-description">
						<?php echo Ytools::truncate($itemSubject['desc'],$options->item_desc_max_characs); ?>
					</span>
				  <?php endif; ?>
				 <?php if($options->item_date_display == 1): ?>
					 <span class="yt-titleflash-time">
					 <?php if($options->layout=='layout1') : ?> - <?php else : ?>(<?php endif; ?><?php echo JHTML::_('date', $itemSubject['created'], JText::_('DATE_FORMAT_LC2')) ?><?php if($options->layout=='layout2') : ?>)<?php endif; ?>
					 </span>
				 <?php endif; ?>

			</div>
		<?php endforeach; ?>
	</div>
    
    <div id="paginate-yttitleflash<?php echo $module->id; ?>" class="yt-titleflash-pagination">
    	<?php if($options->controls == 1) : ?>
		<ul>        
			<li><a href="#" class="prev"></a></li>
			<li><a href="#" class="next"></a></li>           
		</ul>
        <?php endif; ?>
	</div>
</div>
<script type="text/javascript">
<!--
/* <![CDATA[ */
	window.addEvent('domready',function(){
		featuredcontentslider.init({
			id: "yttitleflash<?php echo $module->id; ?>",  //id of main slider DIV
			contentsource: ["inline", ""],  //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
			toc: "markup",  //Valid values: "#increment", "markup", ["label1", "label2", etc]
			nextprev: ["Previous", "Next"],  //labels for "prev" and "next" links. Set to "" to hide.
			revealtype: "click", //Behavior of pagination links to reveal the slides: "click" or "mouseover"
			enablefade: [true, 0.1],  //[true/false, fadedegree]
			autorotate: [true, 5000],  //[true/false, pausetime]
			onChange: function(previndex, curindex){  //event handler fired whenever script changes slide
				//previndex holds index of last slide viewed b4 current (1=1st slide, 2nd=2nd etc)
				//curindex holds index of currently shown slide (1=1st slide, 2nd=2nd etc)
			}
		});
	});
/* ]]> */
-->
</script>