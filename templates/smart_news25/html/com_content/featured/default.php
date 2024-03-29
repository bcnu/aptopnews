<?php
/**
 * @version		$Id: default.php 20985 2011-03-17 18:34:35Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
$leading_or_intro = '';

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>
<div class="blog blog-featured<?php echo $this->pageclass_sfx;?>">
<?php if ( $this->params->get('show_page_heading')!=0) : ?>
	<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
<?php endif; ?>

<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="leading items-leading">
	<?php foreach ($this->lead_items as &$item) : 
	$this->leading_or_intro = 'leading';
	?>
		<div class="leading-content leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
			<?php
				$this->item = &$item;
				echo $this->loadTemplate('item');
			?>
		</div>
        <?php
		if($this->leading_or_intro == 'leading' ){
			echo "<span class='leading_separator'>&nbsp;</span>";
		}else{
			echo "<div class='item-separator'></div>";
		}
		?>
		<?php
			$leadingcount++;
		?>
	<?php 
	$this->leading_or_intro = '';
	endforeach; ?>
</div>
<?php endif; ?>
<?php
	$introcount=(count($this->intro_items));
	$counter=0;
?>
<?php if (!empty($this->intro_items)) : ?>
	<?php 
	$i=0;
	foreach ($this->intro_items as $key => &$item) : 
	$this->leading_or_intro = 'intro';
	$i++;
	?>

	<?php
		$key= ($key-$leadingcount)+1;
		$rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
		$row = $counter / $this->columns ;
		
		if($i==1){
			$isFL = ' colfirst';
		}elseif($i==$this->columns){
			$isFL = ' collast';
			$i = 0;
		}else{
			$isFL = '';
		}
		
		if ($rowcount==1) : ?>

			<div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?> clearfix">
		<?php endif; ?>
		<div class="item column<?php echo $rowcount.$isFL;?><?php echo $item->state == 0 ? ' system-unpublished"' : null; ?>"  style="width: <?php echo round(100/$this->columns, 1); ?>%;">
        	<div class="item_pad">
			<?php
					$this->item = &$item;
					echo $this->loadTemplate('item');
			?>
            </div>
		</div>
		<?php $counter++; ?>
			<?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
				<span class="row_separator"></span>
				</div>

			<?php endif; ?>
	<?php 
	$this->leading_or_intro = '';
	endforeach; 
	?>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
	<div class="items-more">
	<?php echo $this->loadTemplate('links'); ?>
	</div>
<?php endif; ?>

<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php  endif; ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
<?php endif; ?>

</div>

