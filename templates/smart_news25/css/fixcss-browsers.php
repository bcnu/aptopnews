<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$fixcss ='';

if($yt->browser == 'OPE'){ // Opera
		
}elseif($yt->browser == 'SAFAR'){ // Safari
	
}elseif($yt->browser=="CHRO"){ // Chrome
	
}elseif($yt->isIE ()){ // IE
	
}
$doc->addStyleDeclaration($fixcss);
?>