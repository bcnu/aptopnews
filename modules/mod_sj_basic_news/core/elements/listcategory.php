<?php
/*------------------------------------------------------------------------
 # Yt Mega News II - Version 1.1
 # Copyright (C) 2009-2011 The YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: The YouTech Company
 # Websites: http://www.smartaddons.com
 -------------------------------------------------------------------------*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

if (!class_exists('JFormFieldListCategory') && class_exists('JFormField')){
	class JFormFieldListCategory extends JFormField {
		var	$_name = 'YouTech Category Listing';
		function getInput(){
			$db =& JFactory::getDBO();
			$query = "
				SELECT c.id, c.title, c.parent_id, c.level
				FROM #__categories c
				WHERE c.extension='com_content' AND c.published IN (0, 1);"; // publish and unpublish. no trash or archive
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			$cateogries = array();
			foreach($rows as $category){
				$cateogries[$category->id] = $category;
			}
			foreach ($cateogries as $cid => $category){
				if (isset($cateogries[$category->parent_id])){
					$parent =& $cateogries[$category->parent_id];
					if (!isset($parent->child)){
						$parent->child = array();
					}
					$parent->child[$cid] =& $cateogries[$cid];
				}
			}
			$select = array();
			foreach ($cateogries as $cid => $category){
				if (!isset($cateogries[$category->parent_id])){
					$stack = array( $cateogries[$cid] );
					while( count($stack)>0 ){
						$option = array_pop($stack);
						$select[] = array(
							'value' => $option->id,
							'level' => $option->level,
							'label' => ($option->level>1 ? str_repeat('- - ', $option->level-1) : '') . $option->title
						);
						if (isset($option->child) && count($option->child)){
							foreach(array_reverse($option->child) as $child){
								array_push($stack, $child);
							}
						}
					}
				}
			}
			if (!is_array($this->value)){
				$this->value = array($this->value);
			}
			//class_exists('YTools') or include_once dirname(dirname(__FILE__))  . DS . 'yloader.php';
			$html = '<select class="inputbox" multiple="multiple" size="15" style="min-width: 200px;" id="' . $this->id .'" name="' . $this->name . '[]">';
			foreach ($select as $option){
				$selected = in_array($option['value'], $this->value) ? 'selected="selected"' : '';
				$html .= '<option class="level-' . $option['level'] . '" value="' . $option['value'] . '" ' . $selected . '>' .$option['label'].'</option>';
			}
			$html .= "</select>";
			return $html;			
		}
	}
}