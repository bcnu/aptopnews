<?php
/**
 * @package Sj News AjaxTabs
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die; ?>
<div class="item-wrap<?php echo $item_last_css; ?>" style="width: <?php echo ((int)$params->get('item_image_autofit', 1))?($params->get('item_image_width')+2):($width_item_wrap+2) ;?>px;">
	<?php 
	if( (int)$params->get('item_image_display', 1) ): ?>
		<div class="item-image">
		<?php
		if( (int)$params->get('item_image_linkable', 1) ): ?>
			<a href="<?php echo $item['link']; ?>"
				<?php echo YTools::parseTarget($params->get('item_link_target')); ?>
			>
		<?php
		endif; // open anchor tag ?>
			<img
				src="<?php echo Ytools::resize($item['image'], $image_config); ?>"
				alt="<?php echo $item['title']; ?>"
				title="<?php echo $item['title']; ?>"	
				style="max-width: <?php echo ((int)$params->get('item_image_autofit', 1))?($params->get('item_image_width')):($width_item_wrap) ;?>px;"				
			/>
		<?php
		if( (int)$params->get('item_image_linkable', 1) ): ?>
			</a>
		<?php
		endif; // close anchor tag ?>
		</div>
	<?php
	endif; // image display ?>
	<div id="tabslider-text-pro" class="content">
	<?php
	if( (int)$params->get('item_title_display', 1) ): ?>
		<div class="item-title">
		<?php
		if( (int)$params->get('item_title_linkable', 1) ): ?>
			<a href="<?php echo $item['link']; ?>"
				<?php echo YTools::parseTarget($params->get('item_link_target')); ?>
			>
		<?php
		endif; 
		
		echo YTools::truncate($item['title'], (int)$params->get('item_title_max_characters'));
		
		if( (int)$params->get('item_title_linkable', 1) ): ?>
			</a>
		<?php
		endif; // close anchor tag ?>
		</div>
	<?php
	endif; // title display ?>
	
	<?php
	if( (int)$params->get('item_description_display', 1) ): ?>
		<div class="item-description">
		<?php
		if ( (int)$params->get('item_description_keephtml', 1) ){
			echo YTools::truncate($item['description'], (int)$params->get('item_description_max_characters')); 
		} else {			
			$tmp_desc = strip_tags($item['description']);
			echo YTools::truncate($tmp_desc, (int)$params->get('item_description_max_characters')); 
		} ?>
		</div>
	<?php
	endif; // description display ?>
	</div>
	
	<?php
	if( (int)$params->get('item_readmore_display', 1) ): ?>
		<div class="item-readmore">
			<a href="<?php echo $item['link']; ?>"
				<?php echo YTools::parseTarget($params->get('item_link_target')); ?>
			>
			<?php
			echo $params->get('item_readmore_text', 'Read mored'); ?>
			</a>		
		</div>
	<?php
	endif; // readmore display ?>
</div>