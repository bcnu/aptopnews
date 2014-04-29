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
/*
 * $list (categories)
 * $category_preload
 */

$tabs_container_style = '';
if ( in_array( $params->get('position', 'top'), array('left', 'right') ) ){
	$tabs_container_style .= 'style="';
	$tabs_container_style .= 'width: '  . ($tabs_width-15) . 'px;';
	$tabs_container_style .= '"';
}


ob_start(); ?>
<div class="tabs-container" <?php echo $tabs_container_style; ?>>
	<ul class="tabs">
		<?php 
	foreach($list as $category) {
		$css_selected = $category->id == $category_preload ? ' class="selected"' : ''; ?>
		<li<?php echo $css_selected; ?>><a><span><?php echo $category->title ?></span></a></li>
	<?php
	} ?>
	</ul>
</div>
<?php $tabs_markup = ob_get_contents(); ?>
<?php ob_end_clean(); ?>