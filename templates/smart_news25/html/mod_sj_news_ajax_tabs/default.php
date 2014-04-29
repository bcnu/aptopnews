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

$uniqueid = 'ajaxtabs_'.rand().time();

$css_posiotion = $params->get('position', 'top') . '-position';
$module_width  = (int)$params->get('module_width',  750);
$tabs_width    = (int)$params->get('tabs_width',    170);
$tabs_height   = (int)$params->get('tabs_height', 	40);

// check category loaded.
foreach ($list as $first_category){
	$category_preload = $first_category->id;
	break;
}

$preload_cookie = $module->module . '_' . $module->id;
if( JRequest::getInt($preload_cookie, -1, 'cookie') != -1){
	$preload_cookie_value = JRequest::getInt($preload_cookie, -1, 'cookie');
	if (isset($list[$preload_cookie_value])){
		$category_preload = $preload_cookie_value;
	}
} else if( (int)$params->get('category_preload') && isset($list[ (int)$params->get('category_preload') ])) {
	$category_preload = (int)$params->get('category_preload');
}

// get $tabs_markup
include JModuleHelper::getLayoutPath($module->module, 'tabs');
include JModuleHelper::getLayoutPath($module->module, 'css');

if ($params->get('pretext', '')!=''): ?>
<div style="width: <?php echo $module_width; ?>px;"><?php echo $params->get('pretext'); ?></div>
<?php 
endif; ?>

<div id="<?php echo $uniqueid; ?>" class="sj-ajax-tabs <?php echo $css_posiotion?>" style="width: <?php echo $module_width; ?>px;">
<?php
	// show tabs here if (top, left);
	if (in_array($params->get('position', 'top'), array('top', 'left'))){
		echo $tabs_markup;
	}
	
	$tabs_content_style = 'style="';
	if ( in_array( $params->get('position', 'top'), array('top', 'bottom') ) ){
		$tabs_content_style .= 'width: '  . ($module_width - 2 - 2*14) . 'px;';
	} else {
		$tabs_content_style .= 'width: '  . ($module_width - $tabs_width + 3) . 'px;';
	}
	$tabs_content_style .= '"'; ?>
	
	<div class="tabs-content" <?php echo $tabs_content_style; ?>>
		<div class="tabs-content-inner">
		<?php
		foreach($list as $category):
			// test category is preload
			$is_preload = $category->id == $category_preload;
			$css_selected = $is_preload ? "tab-content category-id-{$category->id} selected" : "tab-content category-id-{$category->id}"; ?>
			<div class="<?php echo $css_selected; ?>">
			<?php 
				if ($is_preload){
					$category_items =& $category->child;				
					include JModuleHelper::getLayoutPath($module->module, 'items');
				} else { ?>
					<div class="clear"></div>
					<div class="ajax-loader"></div>
			<?php 
				} ?>
				<div class="clear"></div>
			</div>
		<?php 
		endforeach; ?>
		<div class="clear"></div>
		</div>
	</div>
	
<?php
	// show tabs here if (right, bottom);
	if (in_array($params->get('position', 'top'), array('right', 'bottom'))){
		echo $tabs_markup;
	} 
?>
</div>

<?php
if ($params->get('pretext', '')!=''): ?>
<div style="width: <?php echo $module_width; ?>px;"><?php echo $params->get('pretext'); ?></div>
<?php 
endif; ?>
<script type="text/javascript">
	//<![CDATA[
	$jsmart(document).ready(function($){
		$('<?php echo "#$uniqueid"; ?>').jsmart_ajaxtabs({
			sj_module: '<?php echo $module->module; ?>',
			sj_module_id: '<?php echo $module->id; ?>',
			ajax_url : '<?php echo (string)JURI::getInstance(); ?>',
			ajaxUpdate: function(element, options){
				var loading = $('.ajax-loader', element);
				if (loading.length){
					// show ajax indicator
					loading = loading.first();
					var loading_top = ($(element).parent().height() - loading.height())/2;
					var loading_left = ($(element).parent().width() - loading.width())/2;
					loading.css('padding', loading_top + 'px 0 0 ' + loading_left + 'px');
					
					var category_id = $(element).attr('class');
					category_id = category_id.replace('selected', '');
					category_id = category_id.replace('tab-content', '');
					category_id = category_id.replace('category-id-', '');
					category_id = $.trim(category_id);
					
					ajax_options = {
						sj_category_id:	category_id,
						sj_module_id:	options.sj_module_id,
						sj_module:		options.sj_module,
						sj_module_ajax_request: 1
					};
					$.ajax({
						type: 'POST',
						url : options.ajax_url,
						data: ajax_options,
						success: function(data, textStatus, jqXHR){
							// save this for cookie.
							// console.log(ajax_options);
							var cookie_name = ajax_options.sj_module + '_' + ajax_options.sj_module_id;
							var cookie_value = ajax_options.sj_category_id;
							$.fn.cookie(cookie_name, cookie_value, 1);

							$(element).html(data).attr('title', null);
							$(element).jsmart_slider(options);
						}
					});
				}
			},
			event: '<?php echo $params->get('pager_event', 'click'); ?>',
			duration: <?php echo (int)$params->get('slide_speed', 400); ?>
		});
		$('<?php echo "#$uniqueid"; ?> .tabs-content-inner .tab-content').filter('.selected').jsmart_slider({
			event: '<?php echo $params->get('pager_event', 'click'); ?>',
			duration: <?php echo (int)$params->get('slide_speed', 400); ?>
		});
	});
	//]]>
</script>