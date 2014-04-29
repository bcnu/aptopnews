<?php
$clayout = $_GET['clayout'];
if($clayout=='left-main'){
	$widthType='px';
	$mainBodyWidthType='px';
	$templateWidth = '1000';
	$mainWidth='690';
	$leftWidth='310';
	$rightWidth='0';
}elseif($clayout=='main-right'){
	$widthType='px';
	$mainBodyWidthType='px';
	$templateWidth = '1000';
	$mainWidth='690';
	$leftWidth='0';
	$rightWidth='310';
}elseif($clayout=='full'){
	$widthType='px';
	$mainBodyWidthType='px';
	$templateWidth = '1000';
	$mainWidth='1000';
	$leftWidth='0';
	$rightWidth='0';
}elseif($clayout=='left-main-right' || $clayout=='left-right-main' || $clayout=='main-left-right'){
	$widthType='px';
	$mainBodyWidthType='px';
	$templateWidth = '1000';
	$mainWidth='500';
	$leftWidth='190';
	$rightWidth='310';
}else{
	$widthType='px';
	$mainBodyWidthType='px';
	$templateWidth = '0';
	$mainWidth='0';
	$leftWidth='0';
	$rightWidth='0';
}
?>
<h3>Template Widths</h3>
<div class="field">
    <label>Template Width Type</label>
    <input type="radio" name="ytcpanel_widthType" id="ytcpanel_px_widthtype" class="cp_radio" value="px" <?php echo ($widthType=='px')?'checked="checked"':''; ?>/>px&nbsp;
    <input type="radio" name="ytcpanel_widthType" id="ytcpanel_percent_widthtype" class="cp_radio" value="%" <?php echo ($widthType=='%')?'checked="checked"':''; ?>/>%
</div>
<div class="field">
    <label for="ytcpanel_templateWidth">Template width</label>
    <input type="text" name="ytcpanel_templateWidth" id="ytcpanel_templateWidth" class="cp_text" value="<?php echo $templateWidth; ?>"  size="5" /> <br/>
</div>
<div class="field">
    <label >MainBody Width Type</label>
    <input type="radio" name="ytcpanel_mainBodyWidthType" id="ytcpanel_px_mainwidthtype" class="cp_radio" value="px" <?php echo ($mainBodyWidthType=='px')?'checked="checked"':''; ?>/>px&nbsp;
    <input type="radio" name="ytcpanel_mainBodyWidthType" id="ytcpanel_percent_mainwidthtype" class="cp_radio" value="%" <?php echo ($mainBodyWidthType=='%')?'checked="checked"':''; ?>/>% <br/>
</div>
<div class="field">
    <label for="ytcpanel_mainWidth">Main Column Width</label>
    <input type="text" name="ytcpanel_mainWidth" id="ytcpanel_mainWidth" class="cp_text" value="<?php echo $mainWidth ?>" size="5" /> <br/>
</div>
<div class="field">
    <label for="ytcpanel_leftWidth">Left Column Width</label>
    <input type="text" name="ytcpanel_leftWidth" id="ytcpanel_leftWidth" class="cp_text" value="<?php echo $leftWidth ?>" size="5" /> <br/>
</div>
<div class="field">
    <label for="ytcpanel_rightWidth">Right Column Width</label>
    <input type="text" name="ytcpanel_rightWidth" id="ytcpanel_rightWidth" class="cp_text" value="<?php echo $rightWidth ?>" size="5" /> <br/>
</div>