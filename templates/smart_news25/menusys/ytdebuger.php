<?php
/** 
 * YouTech utilities script file.
 * 
 * @author YouTech Company
 * @package menusys
 * @filesource ytdebuger.php
 * @license Copyright (c) 2011 YouTech Company. All Rights Reserved.
 * @tutorial http://www.ytcvn.com
 */

if (!function_exists('p')){
	define('YTDEBUG', 1);
	function p($var, $usedie=null){	
		if(!defined('YTDEBUG') || YTDEBUG==0) return false;
		if (isset($usedie) && !$usedie) return false;
		echo "<pre>";
		switch(gettype($var)){
			case 'number':
			case 'string': echo "$var<br>"; break;
			case 'array': print_r($var); break;
			default: 
				var_dump($var);
		}
		echo "</pre>";
		if (isset($usedie) && $usedie) die();
	}
}