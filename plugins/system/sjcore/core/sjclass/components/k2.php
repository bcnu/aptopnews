<?php
/**
 * @package SjClass
 * @subpackage SjK2Reader
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 * @author YouTech Company
 *
 */

defined('_YTOOLS') or die;
if (!class_exists('SjK2Reader')){
	class SjK2Reader extends SjAbstractReader{

		public function __construct(){

			$this->addItemFieldToSelect('id');
			$this->addItemFieldToSelect('title');
			$this->addItemFieldToSelect('alias');
			$this->addItemFieldToSelect(array('introtext'=>'description'));
			$this->addItemFieldToSelect('created');
			$this->addItemFieldToSelect('modified');
			$this->addItemFieldToSelect('hits');
			$this->addItemFieldToSelect('featured');
			$this->addItemFieldToSelect(array('catid'=>'catid'));
			$this->addItemFieldToSelect(array('created_by'=>'author_id'));
			$this->addItemFieldToSelect('catid');

			$this->addCategoryFieldToSelect('id');
			$this->addCategoryFieldToSelect('name');
			$this->addCategoryFieldToSelect('alias');
			$this->addCategoryFieldToSelect('description');
			$this->addCategoryFieldToSelect('params');
			$this->addCategoryFieldToSelect(array('image'=>'images'));
			$this->addCategoryFieldToSelect('parent');
			$this->addCategoryFieldToSelect(array('(SELECT COUNT(count_table.id) FROM #__k2_items AS count_table WHERE e.id=count_table.catid)' => 'news_count'));

		}

		public function getItemsFromDb($ids, $overload = false){
			if (!is_array($ids)){
				$ids = array((int)$ids);
			}

			$db = &JFactory::getDbo();
			$query = "SELECT " . $this->getItemFields() . " FROM #__k2_items AS e WHERE e.id IN (" . implode(',', $ids)  . ") GROUP BY e.id;";
			// YTools::dump($query);
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			$item_count = 0;
			if ( !is_null($rows) ){
				foreach($rows as $item){
					if ($overload || !isset($this->_items[$item->id])){
						$this->_items[$item->id] = $item;
						$item_count++;
					}
				}
			}

			return $item_count;
		}

		public function getItemsIn($cids, $params){
			$db = &JFactory::getDbo();
			$now = JFactory::getDate()->toMySQL();
			$nulldate = $db->getNullDate();

			if (is_array($cids)){
				$category_filter_set = implode(',', $cids);
			}

			$query = "
			SELECT e.id
			FROM #__k2_items AS e
			WHERE
			e.published IN (1)
			AND e.trash IN (0)
			AND e.catid IN ($category_filter_set)
			" . ($this->_getContentAccessFilter() ? 'AND '.$this->_getContentAccessFilter() : '') . " -- Access condition
			AND (e.publish_up   = {$db->quote($nulldate)} OR e.publish_up   <= {$db->quote($now)})
			AND (e.publish_down = {$db->quote($nulldate)} OR e.publish_down >= {$db->quote($now)})
			AND e.language IN ({$db->quote(JFactory::getLanguage()->getTag())} , {$db->quote('*')}) 
            {$this->_itemFilter($params)} 
			GROUP BY e.id
			ORDER BY {$this->_itemOrders($params)}
			{$this->_queryLimit($params)}
			";
			//var_dump($query); die('abcbcb');
			$db->setQuery($query);
			$ids = $db->loadResultArray();
			return $ids;
		}

		public function getCategoriesFromDb(){
			if (is_null($this->_categories)){
				$db = &JFactory::getDbo();
				$query = "
				SELECT " . $this->getCategoryFields() . "
				FROM #__k2_categories AS e
				WHERE
				e.published IN (1)
				AND e.trash IN (0)
				AND e.parent >= 0
				" . ($this->_getContentAccessFilter() ? 'AND '.$this->_getContentAccessFilter() : '') . " -- Access condition
				AND e.language IN ({$db->quote(JFactory::getLanguage()->getTag())} , {$db->quote('*')})
				GROUP BY e.id 
				";
				$db->setQuery($query);
				$rows = $db->loadObjectList();
				if ( !is_null($rows) ){
					foreach($rows as $category){
						$category->child_category = array();
						$this->_categories[$category->id] = $category;
					}
					$this->buildCategoriesTree();
				}
			}
			return $this->_categories;
		}
        
		protected function _itemFilter($params, $alias='e'){
			$join_filter="";
			if ( isset($params['source_filter']) ){
				// frontpage filter.
				switch ($params['source_filter']){
					default:
					case '0':
						$join_filter = "";
					break;
					case '1':
						$join_filter = "AND $alias.featured=0";
						break;
					case '2':
						$join_filter = "AND $alias.featured=1";
						break;
				}
			}
			return $join_filter;
		} 
        
		public function buildCategoriesTree(){
			if(count($this->_categories)){
				foreach ($this->_categories as $cid => $category) {
					if (isset($this->_categories[$category->parent])){
						$parent_category = &$this->_categories[$category->parent];
						if (!isset($parent_category->child_category[$category->id])){
							$parent_category->child_category[$category->id] = $category;
						}
					}
					//$title = $category->title . ' <b style="color:red">(' . $category->id . ')</b> <b style="color:blue">[' . $category->parent_id . ']</b>  <b style="color:green">[' . $category->news_count . ']</b>';
					//$title = str_repeat('- - ', $category->level) . $title;
					//echo "<br>$title";
				}
			}
		}

		protected function _itemOrders($params, $alias='e'){
			// set order by default
			$item_order_by = "$alias.ordering";

			if ( isset($params['source_order_by']) ){
				$string_order_by = trim($params['source_order_by']);
				switch ($string_order_by){
					default:
					case 'ordering':
						$item_order_by = "$alias.ordering";
					break;
					case 'mostview':
					case 'hits':
						$item_order_by = "$alias.hits DESC";
						break;
					case 'recently_add':
					case 'created':
						$item_order_by = "$alias.created DESC";
						break;
					case 'recently_mod':
					case 'modified':
						$item_order_by = "$alias.modified DESC";
						break;
					case 'title':
						$item_order_by = "$alias.title";
						break;
					case 'random':
						$item_order_by = 'rand()';
						break;
				}
			}
			return $item_order_by;
		}

		protected function _queryLimit($params){
			$source_limit = '';
            $source_limit_start = 0;
			if (isset($params['source_limit']) && (int)$params['source_limit']){
				//$source_limit_start = 0;
				if (isset($params['source_limit_start']) && (int)$params['source_limit_start']){
					$source_limit_start = (int)$params['source_limit_start'];
				}
				$source_limit_total = (int)$params['source_limit'];
				$source_limit = "LIMIT $source_limit_start, $source_limit_total";
			}
            if(isset($params['nb_cols']) && isset($params['nb_rows'])){
                $source_limit_total = (int)$params['nb_cols']*(int)$params['nb_rows'];
                $source_limit = "LIMIT $source_limit_start, $source_limit_total";
            } 
			return $source_limit;
		}

		protected function _getContentAccessFilter($alias='e'){
			$condition = false;
			$app  = &JFactory::getApplication();
			$params = $app->getParams();
			if ($params instanceof JRegistry && !$params->get('show_noauth', 0)){
				$user = &JFactory::getUser();
				$condition = $alias . '.access IN (' . implode(',', $user->getAuthorisedViewLevels()) . ')';
			}
			return $condition;
		}
        

	}
}