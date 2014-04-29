<?php
/**
 * @package Sj Mega News II
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

$options	= $params->toObject();
$instance	= rand().time();
$tooltips	= array();
$image_config = array(
		'output_width'  => $params->get('item_image_width',  200),
		'output_height' => $params->get('item_image_height', 200),
		'function'		=> $params->get('item_image_function', 'resize_none'),
		'background'	=> $params->get('item_image_background', null)
	);
?>

<?php if (!empty($list)): ?>
<?php ob_start(); ?>
	<?php if (!empty($options->module_width)): ?>
	#megaii_<?php echo $instance; ?> div.yt_introtex,
	#megaii_<?php echo $instance; ?> div.yt_footertext{
		width: <?php echo $options->module_width; ?>px;
	}
	<?php endif; ?>
	<?php if (!empty($options->item_thumbnail_width) && !empty($options->item_thumbnail_height)): ?>
	#megaii_<?php echo $instance; ?> div.yt_item_image{
		width: <?php echo $options->item_thumbnail_width ?>px;
		height: <?php echo $options->item_thumbnail_height ?>px;
	}
	#megaii_<?php echo $instance; ?> div.yt_item_image img{
		width: <?php echo $options->item_thumbnail_width ?>px;
		height: <?php echo $options->item_thumbnail_height ?>px;
	}
	<?php endif; ?>
	<?php if (!empty($options->item_title_color)): ?>
	#megaii_<?php echo $instance; ?> div.yt_item_title span,
	#megaii_<?php echo $instance; ?> div.yt_item_image > div.yt_item_title span {
		color: <?php echo $options->item_title_color; ?>;
	}
	<?php endif; ?>
	<?php if (!empty($options->item_description_color)): ?>
	#megaii_<?php echo $instance; ?> div.yt_item_description,
	#megaii_<?php echo $instance; ?> div.yt_item_description *{
		color: <?php echo $options->item_description_color; ?>;
	}
	<?php endif; ?>
<?php $style_theme1 = ob_get_contents(); 
@ob_end_clean();
$document = &JFactory::getDocument();
$document->addStyleDeclaration($style_theme1);?>
<?php
$mod_width = intval($options->module_width);
$mod_style_width = $mod_width>0 ? "style=\"width:{$mod_width}px;\"" : ""
?>
<?php if (!empty( $options->pretext )): ?>
<div class="yt_introtext" <?php echo $mod_style_width; ?>><?php echo JText::_($options->pretext); ?></div>
<?php endif; ?>

<div id="megaii_<?php echo $instance; ?>" class="yt_megaii <?php echo $options->theme; ?>" <?php echo $mod_style_width; ?>>
	<div class="yt_module_inner">
		<?php foreach ($list as $i => $section):
		if(!isset($section['child_category']) || count($section['child_category'])==0) {
						continue;
					} 
		?>
		<div class="yt_section_wrap">
			<div class="yt_section_inner">
				<?php require JModuleHelper::getLayoutPath( $module->module, $options->theme ); ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php else: ?>
<p><?php echo JText::_('There are no articles matching the selection. Empty category will not display!'); ?></p>
<?php endif; ?>

<?php if (count($tooltips)>0){ ?>
<div id="tooltip_megaii_<?php echo $instance; ?>" style="position: absolute; width: 1px; height: 1px; top: -999em; visibility: hidden; float: none;">
	<?php
	$tooltip_width = $options->tooltip_width > 0 ? $options->tooltip_width : "400";
	$tooltip_image_width = intval($options->tooltip_image_maxwidth);
	$tooltip_image_width = $tooltip_image_width>0 ? $tooltip_image_width : '100';
	$tooltip_image_style = " style=\"width: {$tooltip_image_width}px;\"";
	foreach ($tooltips as $tip){
		$attrs = "style=\"width:{$tooltip_width}px;\" class=\"yt_tooltip_element megaii__{$tip['id']}\"";
	?>
		<div <?php echo $attrs; ?>>
			<div class="yt_item_wrap">
				<div class="yt_item_inner yt_clearfix">
					<div class="yt_item_title">
						<span><?php echo YTools::truncate($tip['item']['title'],$options->item_title_maxchars); ?></span>
					</div>
					<?php if ($tip['item']['image_urls']): ?>
					<div class="yt_item_image yt_clearfix">
						<img src="<?php echo $tip['item']['image_urls']; ?>" alt="<?php echo $tip['item']['title']; ?>" <?php echo $tooltip_image_style; ?>/>
					</div>
					<?php endif; ?>
					<div class="yt_item_description"><?php echo YTools::truncate($tip['item']['description'],$options->item_description_max_characters); ?></div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<?php } ?>
<?php if (!empty( $options->posttext )): ?>
<div class="yt_footertext" <?php echo $mod_style_width; ?>><?php echo JText::_($options->posttext); ?></div>
<?php endif; ?>
<script type="text/javascript">
	$jsmart(document).ready(function($){
		$('#megaii_<?php echo $instance; ?>').megaii();
	});
</script>
