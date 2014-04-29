<?php
/**
 * @package Sj Content Simple Tabs
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_JEXEC') or die;
   $options=$params->toObject();
?>
<?php ob_start(); ?>
#yt-vm-simpletabs-<?php echo $module->id;?>, #yt-vm-simpletabs-<?php echo $module->id;?> .yt_vm_introtext, #yt-vm-simpletabs-<?php echo $module->id;?> .yt_vm_footertext {
    width: <?php echo $options->module_width;?>px;   
    overflow: hidden; 
}
<?php 
 $style_theme=ob_get_contents();
 @ob_clean();
 $document=&JFactory::getDocument();
 $document->addStyleDeclaration($style_theme);
 ?>


<?php if (!empty($list) ){ ?>
<script type="text/javascript">

$jsmart(document).ready(function($){
  $("#ytc_tabs<?php echo $options->theme.$module->id;?>").jSimpleTabs({        
        }        
    );
});
</script>


<div id="yt-vm-simpletabs-<?php echo $module->id;?>">
     <?php if (!empty($options->pretext)){ ?>
    <div class="yt_vm_introtext"><?php echo $options->pretext; ?></div>
    <?php } ?>
		<div class="yt_vm_simpletabs">
			  <?php include JModuleHelper::getLayoutPath($module->module, $options->theme); ?>        
		</div>
    <?php if (!empty($options->posttext)){ ?>
    <div class="yt_vm_footertext"><?php echo $options->posttext; ?></div>
    <?php } ?>

    </div>
<?php }else{ ?>
<p>Have no items! Please recheck module config!</p>
<?php } ?>
