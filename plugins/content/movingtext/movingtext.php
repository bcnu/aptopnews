<?php
/**
 * @package	Joomla.Plugin 
 * moving text Plugin
 * @author Sakis Terzis @ breakDesigns.net
 * @copyright	Copyright (C) 2008-2012 breakDesigns.net
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 * Updated version by Martin Rose - toughtomato.com
 */


defined('_JEXEC') or die ('restricted access');

class plgContentMovingtext extends JPlugin{
    //joomla 2.5
	function onContentPrepare($context,&$row,&$params,$page=0){
		$live_site = JURI::base();

		if (preg_match_all("/{text=.+?}/", $row->text, $matches, PREG_PATTERN_ORDER) > 0) {
			foreach ($matches[0] as $match) {
				$match = str_replace("{text=", "", $match);
				$match = str_replace("}", "", $match);
				$row->text = str_replace( "{text=".$match."}", "<div id=\"maskBlock\"><span class=\"movingObj\">".$match."</span></div>", $row->text );
				$row->text = str_replace( "{/text}", "", $row->text );
				//$row->text = str_replace("&nbsp;","",$row->text);
			}

			$mskWidth=$this->params->get('mskWidth', '300'); 
			$speed=$this->params->get('speed', '2');
			$time=$this->params->get('time', '80');

			//add scripts and styles
			$script="var maskwidth='$mskWidth';
			var speed='$speed';
			var time='$time';";
			JHtml::_('behavior.framework'); //load the mootools framework before other scripts
			$doc=JFactory::getDocument();
			$doc->addScriptDeclaration($script);
			$doc->addScript($live_site."plugins/content/movingtext/movingtextassets/moveText.js");
			$doc->addStyleSheet($live_site."plugins/content/movingtext/movingtextassets/moveText.css");
			return true;
		}
	}

        //joomla 1.5
    	function onPrepareContent(&$row,&$params,$page=0){       
		$live_site = JURI::base();

		if (preg_match_all("/{text=.+?}/", $row->text, $matches, PREG_PATTERN_ORDER) > 0) {
			foreach ($matches[0] as $match) {
				$match = str_replace("{text=", "", $match);
				$match = str_replace("}", "", $match);
				$row->text = str_replace( "{text=".$match."}", "<div id=\"maskBlock\"><span class=\"movingObj\">".$match."</span></div>", $row->text );
				$row->text = str_replace( "{/text}", "", $row->text );
				//$row->text = str_replace("&nbsp;","",$row->text);
			}

			$mskWidth=$this->params->get('mskWidth', '300'); 
			$speed=$this->params->get('speed', '2');
			$time=$this->params->get('time', '80');
			
			//add scripts and styles
			$script="var maskwidth='$mskWidth';
			var speed='$speed';
			var time='$time';";

			$doc=JFactory::getDocument();
			$doc->addScriptDeclaration($script);
			$doc->addScript($live_site."plugins/content/movingtextassets/moveText.js");
			$doc->addStyleSheet($live_site."plugins/content/movingtextassets/moveText.css");
			return true;
		}
	}
}
?>