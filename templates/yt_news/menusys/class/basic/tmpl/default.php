<?php
/** 
 * YouTech menu template file.
 * 
 * @author YouTech Company
 * @package menusys
 * @filesource default.php
 * @license Copyright (c) 2011 YouTech Company. All Rights Reserved.
 * @tutorial http://www.ytcvn.com
 */

if ($this->isRoot()){
	$menucssid = $this->params->get('menustyle') . 'navigator' . $this->params->get('cssidsuffix');
	$addCssRight = $this->params->get('direction', 'ltr')=='rtl' ? "rtl" : "";
	echo "<ul id=\"$menucssid\" class=\"navi$addCssRight\">";
	if($this->haveChild()){
		$idx = 0;
		foreach($this->getChild() as $child){
			$child->addClass('level'.$child->get('level',1));
			++$idx;
			if ($idx==1){
				$child->addClass('first');
			} else if ($idx==$this->countChild()){
				$child->addClass('last');
			}
			if ($child->haveChild()){
				$child->addClass('havechild');
			}
			$child->getContent();
		}
	}
	echo "</ul>";
	
	// import assets
	$this->addStylesheet(array('cssmenu.css'));

} else if ( $this->canAccess() ){
	$haveChild = $this->haveChild();
	$liClass = $this->haveClass() ? "class=\"{$this->getClass()}\"" : "";
?>

<li <?php echo $liClass; ?>>
	<?php echo $this->getLink(); ?>
	<?php
		if($haveChild){
			$levelClassName = 'level'.($this->get('level',1)+1);
			$subStyleWidth = $this->getSubmenuWidth();
			
			echo "<ul class=\"{$levelClassName} subnavi\" $subStyleWidth>";			
			$cidx = 0;
			foreach($this->getChild() as $child){
				$child->addClass($levelClassName);
				++$cidx;
				if ($cidx==1){
					$child->addClass('first');
				} else if ($cidx==$this->countChild()){
					$child->addClass('last');
				}
				if ($child->haveChild()){
					$child->addClass('havechild');
				}
				$child->getContent();
			}
			echo "</ul>";
		}
	?>
</li>

<?php 
}
?>