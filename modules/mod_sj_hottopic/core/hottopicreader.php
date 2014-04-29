<?php
/**
 * @package Sj Hot Topic
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

if (!class_exists('HotTopicReader')){
	class HotTopicReader extends SjReader{
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
					
					// image extract
					if (!isset($item->image_extracted)){
						$item_images = YTools::extractImages($item->description);
						$item->image_extracted = true;
					}
					
					if (!isset($item->image)){
						// get first exists image
						foreach ($item_images as $i => $image_url) {
							if (YTools::isUrl($image_url) || file_exists($image_url)){
								$item->image = $image_url;
								break;
							}
						}
					}
					// final check image exists
					if (!isset($item->image) || (!YTools::isUrl($item->image) && !file_exists($item->image))){
						$item->image = 'modules/'.Ytools::getModule()->module . '/assets/images/nophoto.gif';
					}
								
					$temp['id'] = $item->id;
					$temp['title'] = $item->title;
					$temp['image'] = $item->image;
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
/* 		 Ytools::dump($list); */
			return $list;
		}
	}
}
