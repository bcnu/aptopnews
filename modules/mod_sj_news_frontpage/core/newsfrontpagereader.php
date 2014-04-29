<?php
/**
 * @package Sj News Frontpage
 * @version 2.5
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 * 
 */
defined('_JEXEC') or die;

class NewsFrontPageReader extends SjReader{		
	public function getList(&$params){	
		$arrcustom_url=array();
		$arrcustom_url = $this->_getCustomUrl($params['custom_url']);		
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
						//$join_filter = "LEFT JOIN #__content_frontpage as f ON a.id=f.content_id AND f.content_id IS NULL";
						$join_filter =" AND a.id not in (SELECT content_id FROM #__content_frontpage )";
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
					AND a.state > 0
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

			$total=$params['total'];				   
			$query .=  $total ? ' LIMIT ' . $total : '';	
			$db->setQuery($query);
			$rows = $db->loadObjectList();	
			$imgResizeConfig = array(
			                'background' => $params['item_thumbnail_background'],
			                'thumbnail_mode' => $params['item_thumbnail_mode']);							
			YTools::getImageResizerHelper($imgResizeConfig);
			
			if(!empty($rows)){
			include_once JPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php';
			foreach ($rows as $key=>$item){							
				$temp = array();				
				$item->introtext = trim($item->introtext);
				$item->text = $item->introtext;
				$item->image_urls = YTools::extractImages($item->text);
				$item->thumb = (empty( $item->image_urls) || !file_exists($item->image_urls[0]) ) ? 'modules/'.YTools::getModule()->module.'/assets/images/nophoto.gif' : $item->image_urls[0]  ;
					/*  if(empty($item->image_urls)){
						$item->image_urls[]='modules/'.YTools::getModule()->module.'/assets/images/nophoto.gif';
					} else{
					$item->image_urls[]=$item->image_urls[0];
					}   */
					
				if($item->cat_access <= $aid ) {
					if(array_key_exists($item->id, $arrcustom_url)){
						$item->link = $arrcustom_url[$item->id];
					}else{
						$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->category_id));
					}
				}							
					$temp['id'] = $item->id;						    
					$temp['title'] = $item->title;		
					$temp['link'] = $item->link;	 
					$temp['thumb'] = $item->thumb;
					
					//$temp['small_thumb'] = $item->small_thumb;
					$temp['sub_main_content'] = $item->text; 
					$temp['sub_normal_content'] = $item->text;
					$temp['publish']=$item->created;
				$list[$key] = $temp;					
			}
		}
//Ytools::dump($list);	die();
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