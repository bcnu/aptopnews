<?php
/**
* @package		IndicWriter
* @version		1.0.0
* @copyright	Copyright (C) 2008 - 2011 Soft 'N' Web
* @license		GPL 2.0
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$document = &JFactory::getDocument();

//load pramukh library
$document->addScript( JURI::root() . 'administrator/modules/mod_indicwriter/pramukh_lib/pramukhlib.js' );

//custom script
$customScript = '		function indicChange(lang)'."\n";
$customScript .= '		{'."\n";
$customScript .= '			pramukhHandler.setGlobalScript(lang);'."\n";
$customScript .= '			setIndicCookie(lang);'."\n";
$customScript .= '		}'."\n\n";

$customScript .= '		function initIndicWriter()'."\n";
$customScript .= '		{'."\n";
$customScript .= '			pramukhHandler  = new PramukhPhoneticHandler();'."\n";
$customScript .= '			indic_lang = getIndicCookie()!=null?getIndicCookie():indic_lang;'."\n";
$customScript .= '			lang = indic_lang!=null?indic_lang:"english";'."\n";
$customScript .= '			pramukhHandler.convertPageToIndicIME(lang);'."\n";
$customScript .= '			document.getElementById("indicselector").value = lang;'."\n";
$customScript .= '		}'."\n";

$customScript .= '		function setIndicCookie(lang)'."\n";
$customScript .= '		{'."\n";
$customScript .= '			var expiry = new Date();'."\n";
$customScript .= '			expiry.setDate(expiry.getDate()+1);'."\n";
$customScript .= '			document.cookie = "indicscript=" + escape(lang) + "; expires=" + expiry.toGMTString( ) + "; path=/"; '."\n";
$customScript .= '		}'."\n";

$customScript .= '		function getIndicCookie()'."\n";
$customScript .= '		{'."\n";
$customScript .= '		  c_start=document.cookie.indexOf("indicscript=");'."\n";
$customScript .= '		  	if (c_start!=-1)'."\n";
$customScript .= '		    {'."\n";
$customScript .= '		    	c_start=c_start + 12;'."\n";
$customScript .= '		    	c_end=document.cookie.indexOf(";",c_start);'."\n";
$customScript .= '		    	if (c_end==-1) c_end=document.cookie.length;'."\n";
$customScript .= '		    	return unescape(document.cookie.substring(c_start,c_end));'."\n";
$customScript .= '		    }'."\n";
$customScript .= '		}';

$document->addScriptDeclaration($customScript);
?>

<span>Type in: 
<select name="indicselector" id="indicselector" onchange="indicChange(this.options[this.selectedIndex].value);" >
    <?php if ($params->get( 'languagelist' )!="Full List"){ ?>
    	<option value="<?php echo $params->get( 'languagelist' ) ?>"><?php echo ucfirst($params->get( 'languagelist' )) ?></option>
    <?php } else { ?>
    	<option value="bengali">Bengali</option>
		<option value="devanagari">Devanagari</option>
		<option value="gujarati">Gujarati</option>
		<option value="gurmukhi">Gurmukhi</option>
		<option value="kannada">Kannada</option>
		<option value="malayalam">Malayalam</option>
		<option value="oriya">Oriya</option>
		<option value="tamil">Tamil</option>
		<option value="telugu">Telugu</option>
    <?php } ?>
    	<option value="english">English</option>
</select>
</span>

<script language="JavaScript" type="text/javascript">
	var pramukhHandler, indic_lang="<?php echo ($params->get( 'languagelist' )!="Full List")? $params->get( 'languagelist' ):"english"; ?>"; 
	initIndicWriter();
</script>