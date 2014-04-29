<?php
/*------------------------------------------------------------------------
 # SJ Basic News  - Version 1.0
 # Copyright (c) 2011 YouTech Company. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: YouTech Company
 # Websites: http://www.smartaddons.com
 -------------------------------------------------------------------------*/


defined( '_JEXEC' ) or die( 'Restricted access' );
class BasicNewsReader extends SjReader{		
	public function getList(&$params){	
		$arrcustom_url=array();	
		$categories = array();
		$list=array();			
		$user 		=&	JFactory::getUser();
		$app 		=&	JFactory::getApplication();
		$db   		=&	JFactory::getDBO();
		$jnow		=& 	JFactory::getDate();
		$now		= 	$jnow->toMySQL();
		$nullDate	=	$db->getNullDate();
		$noauth		= !	$app->getParams()->get('show_noauth');
		$aid = $user->get ( 'aid', 0 );
		$aid = 1;
		if (!isset($params['source']) || empty($params['source'])){
			$this->errors = "No selected or all selected is unpublished.";
		return array();
		}
		$category_ids = is_array($params['source']) ? $params['source'] : array($params['source']);		
		if ($noauth){
			$accessids 	= $user->getAuthorisedViewLevels();
			$access_set = implode(",", $accessids);
			$authorize	= "AND c.access IN ($access_set)";
		} else {
			$authorize 	= "";
		}						
		if ( isset($params['source_filter']) ){
				// frontpage filter.
			switch ($params['source_filter']){
					default:
					case '0':
						$join_filter = "";
						break;
					case '1':
						$join_filter = "LEFT JOIN #__content_frontpage as f ON a.id=f.content_id AND f.content_id IS NULL";
						break;
					case '2':
						$join_filter = "INNER JOIN #__content_frontpage as f ON a.id=f.content_id";
						break;
				}
			}				
			$query =
				"
				SELECT
					a.id, a.title, a.introtext, a.fulltext,
					a.created, a.modified, a.hits, a.alias, 
					DATEDIFF(NOW(), a.created) as datediff,
					c.id AS category_id, c.title as cat_name, c.access as cat_access
					
				FROM #__content AS a
					INNER JOIN #__categories AS c ON c.id = a.catid					
					$join_filter
				WHERE
					c.id IN (" . implode(",", $category_ids) . ")
					$authorize
					AND a.state >= 0
					AND ( a.publish_up = {$db->quote($nullDate)} OR a.publish_up <= {$db->quote($now)} )
					AND ( a.publish_down = {$db->quote($nullDate)} OR a.publish_down >= {$db->quote($now)} )
					AND a.language IN ( {$db->quote(JFactory::getLanguage()->getTag())} , {$db->quote('*')} )
				";
			if ( isset($params['source_order_by']) ){
				switch ($params['source_order_by']){
					default:
					case 'ordering':
						$query .= " ORDER BY a.ordering";
						break;
					case 'hits':
						$query .= " ORDER BY a.hits DESC";
						break;
					case 'created':
						$query .= " ORDER BY a.created DESC";
						break;
					case 'modified':
						$query .= " ORDER BY a.modified DESC";
						break;
					case 'title':
						$query .= " ORDER BY a.title";
						break;
					case 'random':
						$query .= " ORDER BY rand()";
						break;
				}
			}							   
			$query .=  $params['total'] ? ' LIMIT ' . $params['total'] : '';	
			$db->setQuery($query);
			$rows = $db->loadObjectList();		
			include_once JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php';
			if(!empty($rows)) {
			foreach ($rows as $key=>$item){							
				$temp = array();
				if($item->cat_access <= $aid ) {                       
					$item->category_link = JRoute::_(ContentHelperRoute::getCategoryRoute($item->category_id));												
				}								
				if (!isset($item->cat_name)){								
					$item->cat_name =$item->cattitle;
				}
					$item->introtext = trim($item->introtext);
					$item->text = $item->introtext;
					$item->thumb = YTools::extractImages($item->text);
				if ('none' == $params['item_thumbnail_mode']){					
					$item->image = (empty( $item->thumb) || !file_exists($item->thumb[0]) ) ? 'modules/mod_sj_basic_news/assets/images/nophoto.gif' : $item->thumb[0]  ;					
				} else {
					$item->image= (empty( $item->thumb ) || !file_exists($item->thumb[0])) ? 'modules/mod_sj_basic_news/assets/images/nophoto.gif' : $item->thumb[0];
					if (false != $item->image && !YTools::isUrl($item->image)){
						$item->image = YTools::resize($item->image, $params['item_thumbnail_width'], $params['item_thumbnail_height'], $params['item_thumbnail_mode']);
					}					
				}			
				if($item->cat_access <= $aid ) {
					if(array_key_exists($item->id, $arrcustom_url)){
						$item->link = $arrcustom_url[$item->id];
					}else{
						$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->category_id));
					}
				}	
						
					$item->sub_title = YTools::truncate($item->title, $params['limittitle']);
					$item->sub_content = YTools::truncate($item->text,$params['limit_description']);
					if ($params['description_keephtml'] == 0){
						$item->sub_content = strip_tags($item->sub_content);
					}	
					$temp['id'] = $item->id;
					$temp['category_link'] = $item->category_link;					
					$temp['cattitle']= $item->cat_name;	
					$temp['sub_title'] = $item->sub_title;
					$temp['title'] = $item->title;					
					$temp['link'] = $item->link;	 
					$temp['thumb'] = $item->image;						
					$temp['sub_content'] = $item->sub_content;
					$temp['date']=	$item->created;					
					$list[$key] = $temp;					
					}		
			return $list;
			}
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