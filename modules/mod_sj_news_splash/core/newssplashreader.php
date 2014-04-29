<?php
/**
 * @package Sj News Splash
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

if (!class_exists('NewsSplashReader')){
	class NewsSplashReader extends SjReader{
		public function getList(&$params){
			$list =array();
			$items=array();				
			if (!isset($params['source']) || empty($params['source'])){
				$this->errors = "No selected or all selected is unpublished.";
				return array();
			}				
			$items = $this->content->getCategoryItems($params['source'], $params);
				
			if(!empty($items)) {
				include_once JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php';
				foreach($items as $key => $item){
					$temp = array();												
					$temp['id'] = $item->id;
					$temp['title'] = $item->title;				
					if (!isset($item->url)){
						$item->url = JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->category_id));
					}
					$temp['link'] = $item->url;
					if ((int)$params['item_desc_keephtml'] == 0){
						$temp['desc'] = strip_tags($item->description);
					} else {
						$temp['desc'] = ($item->description);
					}
					$temp['created']=$item->created;
				$list[] = $temp;
			}
		 }			
	/* 	 Ytools::dump($list); */
			return $list;
		}
	}
}
