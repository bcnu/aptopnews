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


defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.html.parameter' );
class TemplateParams
{
   /**
    * TemplateParams
    * @param $object - where to append the template parameters
    */
   function TemplateParams($object) {
	  // Create a new JParameter object
	  $app =& JFactory::getApplication();
	  $str_tpl = '';
      $object->templateParams = new JParameter('');
	  $db = & JFactory::getDBO ();
	  $query = "SELECT t.params FROM #__template_styles as t WHERE t.template = '". $app->getTemplate() ."'";
	  $db->setQuery ( $query );			
	  $odb_tpl = $db->loadObjectList ();	  
	  $str_tpl = $odb_tpl['0']->params;
	  $str_tpl = substr($str_tpl, 2);  
	  $str_tpl = substr($str_tpl, 0, strlen($str_tpl) -2); 
	  $arr_tpl = explode('","', $str_tpl);
	  foreach($arr_tpl as $arr_tpl){
		  $array = explode('":"', $arr_tpl);
		  $name = $array[0];
		  $value = $array[1];
		  $object->templateParams->set( $array[0], $array[1] );
	  }
   }
}