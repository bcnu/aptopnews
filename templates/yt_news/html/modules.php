<?php
function modChrome_ytbox($module, &$params, &$attribs)
{ ?>
		<div class="clearfix moduletable<?php echo $params->get('moduleclass_sfx'); ?>" id="Mod<?php echo $module->id; ?>">
			<?php if ($module->showtitle != 0) : ?>           
			<h3 class=""><?php echo $module->title; ?></h3>            
			<?php endif; ?>
			<div class="yt-mod-tl">
            	<div class="yt-mod-tr">	
					<div class="yt-mod-tm"></div>
				</div>
            </div> 
			<div class="yt-main-box">
                <div class="yt-main-box-inc clearfix">
                <?php echo $module->content; ?>
                </div>
			</div>
			<div class="yt-mod-bl">
            	<div class="yt-mod-br">	
					<div class="yt-mod-bm">
					</div>
				</div>
            </div> 
		</div>
	<?php
}
function modChrome_ytmenubasic($module, &$params, &$attribs)
{ ?>
		<div class="clearfix moduletable<?php echo $params->get('moduleclass_sfx'); ?>" id="Mod<?php echo $module->id; ?>">
			<?php if ($module->showtitle != 0) : ?>           
			<h3 class=""><?php echo $module->title; ?></h3>            
			<?php endif; ?>
			
			<div class="yt-main-box">
                <div class="yt-main-box-inc clearfix">
                <?php echo $module->content; ?>
                </div>
			</div>
			
		</div>
	<?php
}
?>
