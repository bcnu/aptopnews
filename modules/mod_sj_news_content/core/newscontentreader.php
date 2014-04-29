<?php
/**
 * @package Sj News Content
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

if (!class_exists('NewsContentReader')){
	class NewsContentReader extends SjReader{
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
				 $arrcustom_url=array();
				 $arrcustom_url = $this->_getCustomUrl($params['custom_url']);
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
					if(array_key_exists($item->id, $arrcustom_url)){
								$temp['link'] = $arrcustom_url[$item->id];
					}else{
						if (!isset($item->url)){
								$item->url = JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->category_id));
						}
						$temp['link'] = $item->url;
					}									
					if ((int)$params['item_desc_keephtml'] == 0){
						$temp['desc'] = strip_tags($item->description);
					} else {
						$temp['desc'] = ($item->description);
					}
					$temp['created']=JHTML::_('date',$item->created,JText::_('d/m/Y'));
				$list[] = $temp;
			}
		 }		
/*   Ytools::dump($list);	 */
			return $list;
		}
		private function _getCustomUrl($custom_url) {
			$arrUrl = array();
			$tmp = explode("\n", trim($custom_url));
			foreach( $tmp as $strTmp){
				$pos = strpos($strTmp, ":");
				if($pos >=0){
					$tmpKey = substr($strTmp, 0, $pos);
					$key = trim($tmpKey);
					$tmpLink = substr($strTmp, $pos+1, strlen($strTmp)-$pos);
					$haveHttp =  strpos(trim($tmpLink), "http://");
					if($haveHttp<0 || ($haveHttp !== false) ){
						$link = trim($tmpLink);
					}else{
						$link = "http://" . trim($tmpLink);
					}
					$arrUrl[$key] = $link;
				}
			}
			return $arrUrl;
		}	
		
	}
}