<?php
/**
 * @package Sj News AjaxTabs
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die; 

$nb_column	= (int)$params->get('nb_column', 3);
$nb_row 	= (int)$params->get('nb_row', 1);
$nb_items	= count($category_items);
$nb_pages	= $nb_items*1.0 / ($nb_column*$nb_row);
if (intval($nb_pages)<$nb_pages){
	$nb_pages = intval($nb_pages) + 1;
} else {
	$nb_pages = intval($nb_pages);
}
$i = 0;

if ($nb_items>0){
	if ((int)$params->get('item_image_autofit', 1) && !isset($item_image_autofit) ){
		$nb_column	= (int)$params->get('nb_column', 3);
		if (in_array($params->get('position', 'top'), array('top', 'bottom'))){
			$size = (int)$params->get('module_width',  750) - 30;
			$size = $size - 12 * ($nb_column-1);
			$size = floor(1.0*$size/$nb_column)-2;
			$params->set('item_image_width', $size);
		} else {
			$size = (int)$params->get('module_width',  750) - 30 - (int)$params->get('tabs_width', 170);
			$size = $size - 12 * ($nb_column-1);
			$size = floor(1.0*$size/$nb_column)-2;
			$params->set('item_image_width', $size);
		}
		$item_image_autofit=true;
	} else{
		if (in_array($params->get('position', 'top'), array('top', 'bottom'))){
			$width_item_wrap = (int)$params->get('module_width',  750) - 30;
			$width_item_wrap = $width_item_wrap - 12 * ($nb_column-1);
			$width_item_wrap = floor(1.0*$width_item_wrap/$nb_column)-2;
			
		}else {
			$width_item_wrap = (int)$params->get('module_width',  750) - 30 - (int)$params->get('tabs_width', 170);
			$width_item_wrap = $width_item_wrap - 12 * ($nb_column-1);
			$width_item_wrap = floor(1.0*$width_item_wrap/$nb_column)-2;
			
			}
	
	}
	
	$image_config = array(
		'output_width'  => $params->get('item_image_width'),
		'output_height' => $params->get('item_image_height'),
		'function'		=> $params->get('item_image_function'),
		'background'	=> $params->get('item_image_background')
	);
	
	
	if ((int)$params->get('pager_display', 1)){
		@ob_start(); ?>
		<div class="pager-container">
			<ul class="pages">
			<?php
			for ($j=0; $j<$nb_pages; $j++) {
				$page_class_active = $j==0 ? "page active" : "page";
				echo "<li class=\"$page_class_active\"><div>" . ($j+1) . '</div></li>';
			} ?>
			</ul>
		</div>
		<?php
		$pages_markup = @ob_get_contents();
		@ob_end_clean();
	} else {
		$pages_markup = '';
	}

		// show tabs here if (bottom, left);
		if (in_array($params->get('position'), array('bottom'))){
			echo $pages_markup;
		} 
	?>
		
	<div class="items-container">
	<div class="items-container-inner">
	<?php foreach ($category_items as $item) {
		// index item.
		$i++;
		if ($nb_column*$nb_row==1 || $i % ($nb_column*$nb_row)==1 ){
			// if start group		
			echo '<div class="items-grid">';
		}
		if ($i % $nb_column == 0){
			$item_last_css = ' last';
		} else {
			$item_last_css = '';
		}

		include JModuleHelper::getLayoutPath($module->module, 'item');;
		
		if ($i % $nb_column == 0 && $i < $nb_items && $i % ($nb_column*$nb_row) > 0){
			echo '<div class="item-separator"></div>';
		}	
		if ($i % ($nb_column*$nb_row) == 0 || $i == $nb_items){
			// close item-grid
			echo "</div>";
		}
	}?>
	</div>
	</div>

	<?php
	// show tabs here if (bottom, left);
	if (in_array($params->get('position'), array('top', 'right', 'left'))){
		echo $pages_markup;
	}
		 
} else {
	?><div class="noitem"><?php echo JText::_('There are no items matching the selection.'); ?></div><?php
}?>