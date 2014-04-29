<?php
/*
 * ------------------------------------------------------------------------
 * Yt FrameWork for Joomla 2.5
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2012 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
include_once (dirname(__FILE__).DS.'includes'.DS.'yt_template.class.php');
include_once (dirname(__FILE__).DS.'includes'.DS.'frame_inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $ytrtl; ?>">
<head>
	<jdoc:include type="head" />
	<link rel="stylesheet" href="templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />

<?php if($ytrtl == 'rtl') : ?>
	<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/template_rtl.css" type="text/css" />
<?php endif; ?>
	<?php 
	$arr_style = $yt->getStyleSite();
	if(!empty($arr_style)){ ?>
		<link rel="stylesheet" href="<?php echo $yt->templateurl().'css/color/'.$arr_style['filestyle'].'.css'; ?>",'text/css'" type="text/css" />
    <?php
	}
	?>
</head>
<?php 
//
	$cls_body = '';
	//render a class for home page
	$cls_body .= $yt->isHomePage() ? 'homepage ' : '';
	//add a class for each component
	$cls_body .= (JRequest::getVar('option')!= null) ? JRequest::getVar('option') .' ' : '';
	//add a view class which helps you easy to style
	$cls_body .= (JRequest::getVar('view')!= null) ? 'view-' . JRequest::getVar('view') . ' ' : '';
	//for stype. With each style, we will use one class
	$cls_body .= $yt->getParam('sitestyle').' ';
	//for RTL direction
	$cls_body .= ($ytrtl == 'rtl') ? 'rtl' . ' ' : '';
	//check type of template width. There are two types: percentage and pixel
	$cls_body .= ($yt_render->widthtype == '%') ? 'body-percentage ' : '';
	//add a class according to the template name
	$cls_body .= $yt->template. ' ';
	//add a class for fontsize
	$cls_body .=  'fs' . $yt->getParam('fontsize');;
?>
<body id="<?php echo $yt->template; ?>" class="<?php echo 'contentpane '.$cls_body; ?>">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
