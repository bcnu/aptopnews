<?php
/**
 * @package Sj Multi Video
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;
//Get modules helper
require_once(dirname(__FILE__).DS.'helper.php');
//Get parameter
$preview = '';
$logo = '';
$link = '';
$autostart = '';

if($params->get('playlist_url')){
	$playlistPos = $params->get('playlist_position');
	if($params->get('playlist_size')){
		$playlist_size = $params->get('playlist_size', '');
		$playlist_size = '&amp;playlistsize='.$playlist_size;
	}
	$video = 'http://gdata.youtube.com/feeds/api/playlists/'.$params->get('playlist_url').'&amp;playlist='.$playlistPos.$playlist_size;
}


// controlbar
$controlbar= '';
if ($params->get('controlbar')){
	$controlbar = "&amp;controlbar=over";
}

//Skin url
$skin = '';

if($params->get('select_skin')) {
	$skinName = JURI::base().'modules/mod_sj_multivideo/assets/skin/'.$params->get('select_skin').'/'.$params->get('select_skin').'.xml&amp;dock=false';
	$skin = '&amp;skin='.$skinName;
}
	
//Auto start
if ($params->get('autostart')){
	$autostart = "&amp;autostart=true";
}
// repeat
$repeat = ''; 
if ($params->get('playlist_repeat')){
	$playlist_repeat = $params->get('playlist_repeat', '');
	$repeat = '&amp;'.$playlist_repeat;
}
// shuffel
$shuffle ='';
if ($params->get('playlist_shuffle')){
	$playlist_shuffle = $params->get('playlist_shuffle', '');
	$shuffle = '&amp;'.$playlist_shuffle;
}
require(JModuleHelper::getLayoutPath('mod_sj_multivideo','multi_video'));
//}
?>


