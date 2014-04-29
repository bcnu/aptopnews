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
 
Class YtRenderXML {		
	// layout array of xml
	var $layout = array();
	// array Tag Head
	var $arr_TH = array();
	// array Tag Body
	var $arr_TB = array();
	// array Group Info
	var $arr_GI = array();
	// width countLass ytmain
	var $ytmain_width = 0;
	// width type: px
	var $widthtype = '';
	// main body width type: px
	var $mbwidthtype = '';
	// layout type ex: left-main, main-right, ...
	var $layouttype ='';
	//
	var $cinfo = array();


function YtRenderXML($xmlfile, $templateWidth, $arrayColumn, $widthType, $mainBodyWidthType){	
	$dom = new DOMDocument();
	//load file layout
	if(!$dom->load(dirname(__FILE__).DS.'..'.DS.'layouts'.DS.$xmlfile)){
		echo '<h2>structure or name of file: <span style="color:red">'.$xmlfile.'</span> is not exactly</h2>'; die();
	}
	$this->layout = $dom->getElementsByTagName("layout");	
	$this->groupInfo(); 
	if(!isset($this->arr_GI['main']) ){ 
		$this->arr_GI = array_merge($arrayColumn, $this->arr_GI); 
		$this->mbwidthtype = $mainBodyWidthType;
	}else{
		if(strpos($this->arr_GI['main']['width'], 'px')){
			$this->mbwidthtype = substr($this->arr_GI['main']['width'], strpos($this->arr_GI['main']['width'], 'px'), strlen($this->arr_GI['main']['width']));
		}elseif(strpos($this->arr_GI['main']['width'], '%')){
			$this->mbwidthtype = substr($this->arr_GI['main']['width'], strpos($this->arr_GI['main']['width'], '%'), strlen($this->arr_GI['main']['width']));
		}
	}
	$this->widthtype = $widthType;
	$this->ytmain_width = $templateWidth.$widthType;
	foreach($this->layout as $layout):
		$this->layouttype = $layout->getAttribute('type');
	endforeach;
	$this->getTagHead(); 
	$this->getTagBody();
	$this->cinfo = $this->getContentInfo();
}	

function groupInfo(){
	$group_info = array();
	foreach($this->layout as $layout):
		foreach($layout->childNodes as $childLayout):
		  if($childLayout->nodeName=='groups'){ 
			  foreach($childLayout->childNodes as $group): if($group->nodeName!='#text'){
				  $group_i['name'] = $group->nodeValue;
				  $group_i['height'] = $group->getAttribute('height');
				  $group_i['width'] = $group->getAttribute('width');
				  $group_info[$group->nodeValue] = $group_i; $group_i =null;	
			  }
			  endforeach;		      
		  }
		endforeach;
	endforeach;
	return $this->arr_GI = $group_info;     
}
function getTagHead() {
	$arr_head = array();
	foreach($this->layout as $layout):
		foreach($layout->childNodes as $childLayout):
		  if($childLayout->nodeName=='head'){
			  foreach($childLayout->childNodes as $head): if($head->nodeName!='#text'){
					  $arr_head[$head->nodeName][] = $head->nodeValue;
			  }
			  endforeach;				      
		  }
		endforeach;
	endforeach;
	return $this->arr_TH = $arr_head;          
}

function getTagBody(){
	foreach($this->layout as $layout):
		foreach($layout->childNodes as $childLayout):
		  if($childLayout->nodeName=='blocks'){	 
			$this->getBlocks($childLayout);	      
		  }
		endforeach;
	endforeach;	
}
function getContentInfo(){
	$a = array();
	foreach($this->arr_TB as $tag):
		if($tag['name']=='content'){
			if($this->mbwidthtype == 'px'){
				if($tag['yt_col1-contain']=='l'){ // only left
					$a['w-yt_col1']= $tag['width_groupl'].'px';
					$a['w-yt_col2']= ($tag['width_groupm'] + $tag['width_groupr']).'px';
					$a['w-group-l'] = '100%';
					$a['w-group-r'] = $tag['width_groupl'].'px';
					$a['w-group-m'] = $tag['width_groupm'].'px';
				}elseif($tag['yt_col1-contain']=='m'){ // only main
					$a['w-yt_col1'] = $tag['width_groupm'].'px';
					$a['w-yt_col2'] = ($tag['width_groupl'] + $tag['width_groupr']).'px';
					$a['w-group-m'] = '100%';
					$a['w-group-l'] = $tag['width_groupl'].'px';
					$a['w-group-r'] = $tag['width_groupr'].'px';
				}elseif($tag['yt_col1-contain']=='lm' || $tag['yt_col1-contain']=='ml'){ // left & main
					$a['w-yt_col1'] = ($tag['width_groupl'] + $tag['width_groupm']).'px';
					$a['w-yt_col2'] = $tag['width_groupr'].'px';
					$a['w-group-r'] = '100%';
					$a['w-group-l'] = $tag['width_groupl'].'px';
					$a['w-group-m'] = $tag['width_groupm'].'px';
				}elseif($tag['yt_col1-contain']=='lr' || $tag['yt_col1-contain']=='rl'){ // left & right
					$a['w-yt_col1'] = ($tag['width_groupl'] + $tag['width_groupr']).'px';
					$a['w-yt_col2'] = $tag['width_groupm'].'px';
					$a['w-group-m'] = '100%';
					$a['w-group-l'] = $tag['width_groupl'].'px';
					$a['w-group-r'] = $tag['width_groupr'].'px';
				}
			}elseif($this->mbwidthtype == '%'){
				if($tag['yt_col1-contain']=='l'){ // only left
					$a['w-yt_col1']= $tag['width_groupl'].'%';
					$a['w-yt_col2']= ($tag['width_groupm'] + $tag['width_groupr']).'%';
					$a['w-group-l'] = '100%';
					$a['w-group-r'] = $this->ytDivision($tag['width_groupl']*100, ($tag['width_groupm'] + $tag['width_groupr']), '%', 1);
					$a['w-group-m'] = $this->ytDivision($tag['width_groupm']*100, ($tag['width_groupm'] + $tag['width_groupr']), '%', 1);
				}elseif($tag['yt_col1-contain']=='m'){ // only main
					$a['w-yt_col1'] = $tag['width_groupm'].'%';
					$a['w-yt_col2'] = ($tag['width_groupl'] + $tag['width_groupr']).'%';
					$a['w-group-m'] = '100%';
					$a['w-group-l'] = $this->ytDivision($tag['width_groupl']*100, ($tag['width_groupl'] + $tag['width_groupr']), '%', 1);
					$a['w-group-r'] = $this->ytDivision($tag['width_groupr']*100, ($tag['width_groupl'] + $tag['width_groupr']), '%', 1);
				}elseif($tag['yt_col1-contain']=='lm' || $tag['yt_col1-contain']=='ml'){ // left & main
					$a['w-yt_col1'] = ($tag['width_groupl'] + $tag['width_groupm']).'%';
					$a['w-yt_col2'] = $tag['width_groupr'].'%';
					$a['w-group-r'] = '100%';
					$a['w-group-l'] = $this->ytDivision($tag['width_groupl']*100, ($tag['width_groupl'] + $tag['width_groupm']), '%', 1);
					$a['w-group-m'] = $this->ytDivision($tag['width_groupm']*100, ($tag['width_groupl'] + $tag['width_groupm']), '%', 1);
				}elseif($tag['yt_col1-contain']=='lr' || $tag['yt_col1-contain']=='rl'){ // left & right
					$a['w-yt_col1'] = ($tag['width_groupl'] + $tag['width_groupr']).'%';
					$a['w-yt_col2'] = $tag['width_groupm'].'%';
					$a['w-group-m'] = '100%';
					$a['w-group-l'] = $this->ytDivision($tag['width_groupl']*100, ($tag['width_groupl'] + $tag['width_groupr']), '%', 1);
					$a['w-group-r'] = $this->ytDivision($tag['width_groupr']*100, ($tag['width_groupl'] + $tag['width_groupr']), '%', 1);
				}
			}
			if($a['w-yt_col1']=='0px' || $a['w-yt_col1']=='0%'){
				$a['display-yt_col1'] = ' display:none';
			}else{
				$a['display-yt_col1'] = '';
			}
			if($a['w-yt_col2']=='0px' || $a['w-yt_col2']=='0%'){
				$a['display-yt_col2'] = ' display:none';
			}else{
				$a['display-yt_col2'] = '';
			}
		}
	endforeach; 
	return $a;
}
function getBlocks($blocks){
	$doc = JFactory::getDocument();
	/* Array of block have field
		[name] => 
		[order] => 
		[id] => 
		[offset] =>
		[positions] => Array
		...
	*/
	$tagBody = array();
	foreach($blocks->childNodes as $block): if($block->nodeName != '#text'){
		$tagBody['name'] = $block->nodeName;
		$tagBody['order'] = (int)$block->getAttribute('order');
		$tagBody['id'] = $block->getAttribute('id');
		$tagBody['offset'] = $block->getAttribute('offset');
		// add div tag for block content(#content)
		if($block->nodeName == 'content'){
			$tagBody['showDivTop'] = $block->getAttribute('showDivTop');
			$tagBody['showDivBottom'] = $block->getAttribute('showDivBottom');
		}
		$tagBody['autosize'] = ($block->hasAttribute('autosize'))?$block->getAttribute('autosize'):'1';
		foreach($block->childNodes as $positions ): if($positions->nodeName!='#text'){
			$count = 0;
			foreach($positions->childNodes as $position):
				if($position->nodeName!='#text'){
					$posit['type'] = $position->getAttribute('type');
					$posit['style'] = $position->getAttribute('style');
					$posit['height'] = $position->getAttribute('height');
					$posit['width'] = $position->getAttribute('width');
					$posit['value'] = $position->nodeValue;					
					$posit['group'] = $position->getAttribute('group');						
					$posit['colspan'] = $position->getAttribute('colspan');					
					if($position->hasAttribute('column')){
						$posit['column'] = $position->getAttribute('column');
					}						
					if( $position->getAttribute('type') == 'html' || 
						$position->getAttribute('type') == 'feature' ||
						$position->getAttribute('type') == 'component' ||
						$doc->countModules($position->nodeValue) ){
							$count = $count+1; 
					}
					$arr_po[] = $posit; $posit = null;
					
				}
			endforeach; 
			// field countModules of tagBody array 
			$tagBody['countModules'] = $count;     
			// field positions of tagBody array
			$tagBody['positions'] = $arr_po; $arr_po = null;	
			
			$ytmain_width = 0;
			// offset width is not %
			if($this->widthtype!='%'){
				if($tagBody['offset']!=""){
					$ytmain_width = $this->ytmain_width - $this->ytSubStr($tagBody['offset'], $this->widthtype);
				}else{
					$ytmain_width = $this->ytmain_width;
				}		
			}else{
				$ytmain_width = $this->ytmain_width;
			}									 
			if($tagBody['name']!='content'){ // not content			
				$tagBody = $this->updateTagBodyNormal($tagBody, $ytmain_width);
			}else{ // is content
				$tagBody = $this->updateTagBodyContent($tagBody, $ytmain_width);									
			}											 
			$this->arr_TB[] = $tagBody; $tagBody = null;                               		 
		}
		endforeach;
	}
	endforeach;
	$this->arr_TB = $this->sortArr($this->arr_TB, 'order');		//echo '<pre>'; print_r($this->arr_TB);	 die();		
	return $this->arr_TB;
}
function updateTagBodyNormal($tagBody, $ytmain_width){
	$doc = JFactory::getDocument();
	$flag=''; $wf = 0; $cf = 0; $countPosTag=0; $hasGroup = 0;
	if( isset($tagBody['positions']) ){
		foreach($tagBody['positions'] as $atb):
			// none clearfix for yt-main-inner2 of menu
			if($atb['type']=='feature' && ($atb['value']=='@menu')){
				$tagBody['no-clearfix'] = '1';
			}
			if($atb['group']==''){ $countPosTag = $countPosTag + 1;
				if($atb['width'] != ''){									 
					$wf = $wf + $this->ytSubStr($atb['width'], $this->widthtype);
					$cf = $cf+1;
				}
			}elseif($atb['group']!='' && $atb['group']!=$flag){ $countPosTag = $countPosTag + 1;
				$hasGroup = 1;
				$flag = $atb['group'];
				if(isset($this->arr_GI[$flag]['width']) && $this->arr_GI[$flag]['width']!=''){
					$wf = $wf + $this->ytSubStr($this->arr_GI[$flag]['width'], $this->widthtype); 
					$cf = $cf+1;
				}
			}
		endforeach;  
	}
	if($hasGroup == 1){ $class_groupnormal = '';
		$tagBody['hasGroup'] = 1; 
		if($countPosTag <> $cf){
			for($i=0; $i<count($tagBody['positions']); $i++){
				if($tagBody['positions'][$i]['group']==''){ 
					if($tagBody['positions'][$i]['width']=="" && $tagBody['autosize']=='1'){
						if($this->widthtype!='%'){
							$tagBody['positions'][$i]['width'] = $this->ytDivision($ytmain_width-$wf, $countPosTag-$cf, $this->widthtype, 2);
						}
					}
				}
				else{
					if($doc->countModules($tagBody['positions'][$i]['value'])<=0 
						&& $tagBody['positions'][$i]['type']=='modules'){
						$class_groupnormal .= ' nopos-'.$tagBody['positions'][$i]['value'];
					}
					if( isset($this->arr_GI[$tagBody['positions'][$i]['group']]['width']) ){
						if($this->arr_GI[$tagBody['positions'][$i]['group']]['width']==''){										
							if($this->widthtype!='%' && $tagBody['autosize']=='1'){
								$tagBody['width-'.$tagBody['positions'][$i]['group']] = $this->ytDivision($ytmain_width-$wf, $countPosTag-$cf, $this->widthtype, 2);
							}
						}else{
							$tagBody['width-'.$tagBody['positions'][$i]['group']] = $this->arr_GI[$tagBody['positions'][$i]['group']]['width'];
						}		
					}
				}					
			} //end for
		}
		$tagBody['class_groupnormal'] = $class_groupnormal;
	}else{ // $hasGroup == 0
		if($wf > $ytmain_width && $this->widthtype!='%'){
			$tagBody['limited'] = 1; // width block is limited
		}else{
			$tagBody['limited']=0;
		}					
		if($tagBody['countModules'] <> $cf && $tagBody['countModules']>0){ 
			for($i=0; $i<count($tagBody['positions']); $i++){													
				if($this->widthtype!='%'){
					if($tagBody['positions'][$i]['width'] == '' && $tagBody['autosize']=='1' && $tagBody['autosize']=='1' && $wf < $ytmain_width){
						$tagBody['positions'][$i]['width'] = $this->ytDivision($ytmain_width-$wf, $tagBody['countModules']-$cf, $this->widthtype, 2);			
					}
				}else{
					if($cf == 0 && $tagBody['autosize']=='1'){ 																								
						$tagBody['positions'][$i]['width'] = $this->ytDivision(100, $tagBody['countModules'], $this->widthtype, 2);																
					}
				}					
			}
		}
	}
	return $tagBody;
}
function updateTagBodyContent($tagBody, $ytmain_width){
	$doc = JFactory::getDocument();
	// $countCL1: count yt_col1
	// $countCL2: count yt_col2
	// $countLP: count position in goup left
	// $countRP: count position in goup right
	// $countMP: count position in goup main
	// $countL: count position in group left - Enable
	// $countR: count position in group right - Enable
	// $countM: count position in group main - Enable
	// $maxWidthL: max width of positions in group left
	// $maxWidthR: max width of positions in group right
	// $widthTotalEnableL: width total of positions in group left - Enable
	// $widthTotalEnableR: width total of positions in group right - Enable
	// $tagBody['class_content']: class for div#content
	// $arr_group_nonespe array group is not:left, main, right
	$countL = $countR = $countM = 0; $countCL1 = $countCL2 = 0;
	$countLP = $countRP = $countMP = $countCT1P = $countCT2P = 0;
	$maxWidthL = $maxWidthR = 0;
	$widthTotalEnableL = $widthTotalEnableR =0;
	$tagBody['class_content'] = '';
	$tagBody['yt_col1-contain'] = '';
	$arr_group_nonespe = array();
	if($this->mbwidthtype=='%'){
		$tagBody['class_content'] .=' content-percentage';
	}
	foreach($tagBody['positions'] as $posi):
		if( isset($posi['column']) && $posi['column']!='' && $posi['column']=='yt_col1'){
			$countCL1 ++;
		}elseif(isset($posi['column']) && $posi['column']!='' && $posi['column']=='yt_col2'){
			$countCL2 ++;
		}
		
		if($posi['group']=='left'){ $countLP++;	
			if($posi['column']=='yt_col1' && $countLP==1) $tagBody['yt_col1-contain'] .='l';									
			if($doc->countModules($posi['value'])){ // case: position type=modules, module
				$countL++;
				if($posi['colspan']==1){
					$boolMaxWidthL = 1;
				}elseif($posi['colspan']==0 
						&& !isset($boolMaxWidthL) 
						&& $maxWidthL < $this->ytSubStr($posi['width'], $this->mbwidthtype))
				{
					$maxWidthL = $this->ytSubStr($posi['width'], $this->mbwidthtype);
				}
				if($posi['colspan']==0 && !isset($boolMaxWidthL)){
					$widthTotalEnableL += $this->ytSubStr($posi['width'], $this->mbwidthtype);
				}
			}else{
				$tagBody['class_content'] .=' nopos-'.$posi['value'];
			}
		}elseif($posi['group']=='right'){ $countRP++;
			if($posi['column']=='yt_col1' && $countRP==1) $tagBody['yt_col1-contain'] .='r';		
			if($doc->countModules($posi['value'])){ // case: position type=modules, module
				$countR++;
				if($posi['colspan']==1){
					$boolMaxWidthR = 1;
				}elseif($posi['colspan']==0 
						&& !isset($boolMaxWidthR) 
						&& $maxWidthR < $this->ytSubStr($posi['width'], 'px'))
				{
					$maxWidthR = $this->ytSubStr($posi['width'], 'px');	
				}
				
				if($posi['colspan']==0 && !isset($boolMaxWidthR)){
					$widthTotalEnableR += $this->ytSubStr($posi['width'], 'px');
				}	
			}else{
				$tagBody['class_content'] .=' nopos-'.$posi['value'];
			} 	
		}elseif($posi['group']=='main'){ $countMP++;
			if($posi['column']=='yt_col1' && $countMP==1) $tagBody['yt_col1-contain'] .='m';
			if($doc->countModules($posi['value'])){ // case: position type=modules, module
				$countM++;
			}
		}else{ // Group other in block content
			if( !isset($arr_group_nonespe[$posi['group']]) ){
				$arr_group_nonespe[$posi['group']] = 0;
			}
			$arr_group_nonespe[$posi['group']] ++;
		}
	endforeach;
	if(!empty($arr_group_nonespe)){
		foreach($arr_group_nonespe as $k => $v):
			$tagBody['count-'.$k]=$v;
		endforeach;
	}
	
	$tagBody['count-yt_col1'] = $countCL1;
	$tagBody['count-yt_col2'] = $countCL2;
	$tagBody['count-group-left'] = $countLP; 
	$tagBody['count-group-right'] = $countRP;
	$tagBody['count-group-main'] = $countMP;
	
	if( $countL==0){$tagBody['class_content'] .=' nogroup-left';}
	if( $countR==0){$tagBody['class_content'] .=' nogroup-right';}
	
	$tagBody['width_groupl'] = ($countL == 0)?0:$this->ytSubStr($this->arr_GI['left']['width'], $this->mbwidthtype);
	
	if($tagBody['width_groupl']>0 
		&& !isset($boolMaxWidthL) 
		&& $maxWidthL>0 
		&& $widthTotalEnableL>0){
		if($widthTotalEnableL>$maxWidthL){
			if($widthTotalEnableL<$tagBody['width_groupl']){
				$tagBody['width_groupl'] = $this->reCalculateW($tagBody['width_groupl'], $widthTotalEnableL);
			}elseif($widthTotalEnableL==$tagBody['width_groupl']){
				$tagBody['width_groupl'] = $tagBody['width_groupl']; 
			}else{
				if($this->mbwidthtype=='%'){
					$tagBody['width_groupl'] = $this->reCalculateW($tagBody['width_groupl'], $widthTotalEnableL);
				}else{
					$tagBody['width_groupl'] = $this->reCalculateW($tagBody['width_groupl'], $maxWidthL);
				}
			}								
		}elseif($widthTotalEnableL==$maxWidthL){
			$tagBody['width_groupl'] = $this->reCalculateW($tagBody['width_groupl'], $maxWidthL);
		}	
	}
	
	$tagBody['width_groupr'] = ($countR == 0)?0:$this->ytSubStr($this->arr_GI['right']['width'], $this->mbwidthtype);
	if($tagBody['width_groupr']>0 
		&& !isset($boolMaxWidthR) 
		&& $maxWidthR>0 
		&& $widthTotalEnableR>0){
		if($widthTotalEnableR>$maxWidthR){	
			if($widthTotalEnableR<$tagBody['width_groupr']){ 
				$tagBody['width_groupr'] = $this->reCalculateW($tagBody['width_groupr'], $widthTotalEnableR);
			}elseif($widthTotalEnableR==$tagBody['width_groupr']){
				$tagBody['width_groupr'] = $tagBody['width_groupr']; 
			}else{
				if($this->mbwidthtype=='%'){
					$tagBody['width_groupr'] = $this->reCalculateW($tagBody['width_groupr'], $widthTotalEnableR);
				}else{
					$tagBody['width_groupr'] = $this->reCalculateW($tagBody['width_groupr'], $maxWidthR);
				}
			}							
		}elseif($widthTotalEnableR==$maxWidthR){ 
			$tagBody['width_groupr'] = $this->reCalculateW($tagBody['width_groupr'], $maxWidthR);	
		}	
	}
	$tagBody['width_groupm'] = $this->ytSubStr($this->arr_GI['main']['width'], $this->mbwidthtype);
	
	if($tagBody['width_groupl']==0 && $countL == 0 && $countLP>0){
		 $tagBody['width_groupm'] =  $tagBody['width_groupm'] + $this->ytSubStr($this->arr_GI['left']['width'], $this->mbwidthtype);
	}
	if($tagBody['width_groupr']==0 && $countR == 0 && $countRP>0){
		 $tagBody['width_groupm'] =  $tagBody['width_groupm'] + $this->ytSubStr($this->arr_GI['right']['width'], $this->mbwidthtype);
	}	
	if($this->mbwidthtype=='%' 
	   && ($tagBody['width_groupm']+$tagBody['width_groupl']+$tagBody['width_groupr'])<100)
	{
		$tagBody['width_groupm'] = 100 - ($tagBody['width_groupl']+$tagBody['width_groupr']);
	}
	if($this->mbwidthtype=='px' 
	   && $this->widthtype=='px'
	   && ($tagBody['width_groupm']+$tagBody['width_groupl']+$tagBody['width_groupr'])< $ytmain_width)
	{
		   $tagBody['width_groupm'] = $ytmain_width - ($tagBody['width_groupl']+$tagBody['width_groupr']);
	}
	return $tagBody;
}
function sortArr($a = array(), $key){
	$tmp = array();
	foreach($a as &$ma) $tmp[] = &$ma[$key];
	array_multisort($tmp, $a); 
	return $a;
}
function reCalculateW($fw, $ew){	
	if($this->mbwidthtype == 'px'){
		return $ew;
	}elseif($this->mbwidthtype == '%' & $this->widthtype=='px'){
		return $this->ytDivision($ew*100, $this->ytSubStr($this->ytmain_width, 'px'), '');
	}else{
		return $fw;
	}
}
function ytSubStr($str, $key){
	return (int)substr($str, 0, strpos($str, $key));
}

function ytDivision($num, $divisor, $type, $precision=0){
	
	if($divisor>0){
		if((round($num/$divisor, $precision)-floor($num/$divisor)) >0 
			&& (round($num/$divisor, $precision)-floor($num/$divisor)) < 1
			&& (round($num/$divisor, $precision)-floor($num/$divisor)) != 0.5){
			return (round($num/$divisor, $precision)-1/pow(10, $precision)).$type;
		}else{
			return round($num/$divisor, $precision).$type;
		}
		
	}else{
		return '0'.$type;
	}
}
	
	
}
?>