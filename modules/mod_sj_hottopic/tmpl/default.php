<?php
/**
 * @package Sj Hot Topic
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

$image_config = array(
		'output_width'  => $params->get('item_image_width'),
		'output_height' => $params->get('item_image_height'),
		'function'		=> $params->get('item_image_function'),
		'background'	=> $params->get('item_image_background')
);
$options=$params->toObject();
/* Ytools::dump($params); */

$doc = JFactory::getDocument();
$style = '.boxgrid{ width: '.$options->item_image_width.'px; height: '.$options->item_image_height.'px;float:left;}';
$style .= ' .boxcaption{ height: '.$options->box_text.'px; }';
$style .= ' .boxcaption1{ top: '.$options->item_image_height.'px;}';
$style .= ' .boxcaption5{ top: '.($options->item_image_height-$options->line_height).'px;}';
$doc->addStyleDeclaration($style);	
?>


<script type="text/javascript">


	$jsmart(document).ready(function($){

		<?php if($options->theme == 1){ ?>		
				$('.boxgrid').hover(function(){
					$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({top:'<?php echo ($options->item_image_height - $options->box_text).'px'; ?>'},{queue:false,duration:300});
				}, function() {
					$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({top:'<?php echo $options->item_image_height.'px'; ?>'},{queue:false,duration:300});
				});
		<?php } else if($options->theme  == 2) { ?>		
					$('.boxgrid').hover(function(){
						$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({top:'<?php echo $options->item_image_height.'px'; ?>', left:'<?php echo $options->item_image_width.'px'; ?>'},{queue:false,duration:300});
					}, function() {
						$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({top:'0px', left:'0px'},{queue:false,duration:300});
					});
		<?php } else if($options->theme  == 3) { ?>
  				
				$('.boxgrid').hover(function(){
					$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({left:'<?php echo $options->item_image_width.'px'; ?>'},{queue:false,duration:300});
				}, function() {
					$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({left:'0px'},{queue:false,duration:300});
				});
		
	    <?php } else if($options->theme  == 4) { ?>
			
				$('.boxgrid').hover(function(){
					$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({top:'<?php echo $options->box_text;?>px'},{queue:false,duration:160});
				}, function() {
					$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({top:'0px'},{queue:false,duration:160});
				});
		<?php } else if($options->theme  == 5) { ?>
				
				$('.boxgrid').hover(function(){
					$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({top:'<?php echo ($options->item_image_height - $options->box_text).'px'; ?>'},{queue:false,duration:160});
				}, function() {
					$(".cover<?php echo $options->theme.'-'.$module->id; ?>", this).stop().animate({top:'<?php echo ($options->item_image_height - $options->line_height).'px'; ?>'},{queue:false,duration:160});
				});
		<?php } ?>
			});
		</script>

<?php
if (sizeof($list) > 0){
	if((	$options->theme == 1) || (	$options->theme == 5)){
		foreach ($list as $item) :?>
		<div class="boxgrid captionfull boxgrid<?php echo $options->theme; ?>">
			<img title="<?php echo $item['title']?>" alt="<?php echo $item['title']?>" class="attachment-Mini Square" src="<?php echo YTools::resize($item['image'],$image_config)?>"/>
			<div class="cover<?php echo $options->theme.'-'.$module->id; ?> boxcaption boxcaption<?php echo $options->theme?>">
				<h3 class="title-tophit">
					<a title="<?php echo $item['title']?>" target="<?php echo $options->link_target; ?>" href="<?php echo $item['link']?>">
						<?php echo YTools::truncate($item['title'],$options->item_title_max_characs)?>
					</a>
				</h3>
				<p>
				<?php echo YTools::truncate($item['desc'],$options->item_desc_max_characs)?>
				</p>
			</div>		
		</div>
		<?php endforeach; ?>
<?php
     }else{
		 
		foreach ($list as $item) :?>
		<div class="boxgrid captionfull boxgrid<?php echo $options->theme; ?> ">
			<img class="cover<?php echo $options->theme.'-'.$module->id; ?> title="<?php echo $item['title']?>" alt="<?php echo $item['title']?>" class="attachment-Mini Square" src="<?php echo YTools::resize($item['image'],$image_config)?>">
			<div class="boxcaption boxcaption<?php echo $options->theme?>">
				<h3 class="title-tophit"><a title="<?php echo $item['title']?>" target="<?php echo $options->link_target; ?>" href="<?php echo $item['link']?>"><?php echo YTools::truncate($item['title'],$options->item_title_max_characs)?></a></h3>
				<p>
				<?php echo YTools::truncate($item['desc'],$options->item_desc_max_characs)?>
				</p>
			</div>		
		</div>
		<?php endforeach; ?> 
<?php
	 }
 }  
?>