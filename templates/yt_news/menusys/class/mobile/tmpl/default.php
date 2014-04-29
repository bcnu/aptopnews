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

?>
<?php 
if ($this->isRoot()){
	echo "<select id=\"yt-mobilemenu\" name=\"menu\" onchange=\"MobileRedirectUrl()\">";
	if($this->haveChild()){
		$idx = 0;
		foreach($this->getChild() as $child){
			++$idx;
			$child->getContent();
		}
	}
	echo "</select>";

} else if ( $this->canAccess() ){
	$haveChild = $this->haveChild();
?>
        <?php echo $this->getLinkInMobile($this->get('level',1)); ?>
        <?php
            if($haveChild){
                $cidx = 0;
                foreach($this->getChild() as $child){
                    ++$cidx;	
                    $child->getContent();
                }
            }
        ?>
<?php 
}
?>