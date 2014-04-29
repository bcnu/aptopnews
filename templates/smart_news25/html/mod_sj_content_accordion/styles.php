<?php
/**
 * @package Sj Content Accordion
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;
?>

#yt-vm-accordion-<?php echo $module->id; ?> {
    width: <?php echo $options->width_module;?>px;      
}
#yt-vm-accordion-<?php echo $module->id; ?> .yt_vm_introtext, #yt-vm-accordion-<?php echo $module->id; ?> .yt_vm_footertext {
    width: <?php echo $options->width_module;?>px;      
    overflow: hidden;
}

#yt-accordion-<?php echo $module->id;?> {
    background-color: <?php echo $options->module_bg;?>;    
}

#yt-accordion-<?php echo $module->id;?> h3.yt-toggler{   
}
#yt-accordion-<?php echo $module->id;?> .yt_item_desc, #yt-accordion-<?php echo $module->id;?> .yt-accordion-readmore{
   <!-- color: <?php //echo $options->item_description_color;?>;    -->
}
#yt-accordion-<?php echo $module->id;?> .yt_vm_price{
    color: <?php // echo $options->item_sale_price_color;?>;    
}

