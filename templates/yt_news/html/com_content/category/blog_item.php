<?php
/**
 * @version		$Id: blog_item.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::core();


$app =& JFactory::getApplication();

JLoader::register( 'TemplateParams', JPATH_THEMES . DS . $app->getTemplate() . DS . 'includes'. DS . 'params.class.php');
$templateParams = new TemplateParams($this); 
if($this->templateParams->get('thumbnail') == 1  && class_exists('YtUtils') ){
	include_once(JPATH_SITE . DS.'templates'.DS . $app->getTemplate() . DS . 'includes'. DS .'image.class.php');
	$yti = new YtImageJoomlaContent();
	$yti->thumbnail_mode = $this->templateParams->get('thumbnail_mode', 'stretch');
	$yti->thumbnail_background = $this->templateParams->get('thumbnail_background', '#FFF');

	if($this->leading_or_intro =='leading'){
		$yti->width = $this->templateParams->get('leading_width', '200');
		$yti->height = $this->templateParams->get('leading_height', '200');
		
		if (isset($images->image_intro) and !empty($images->image_intro)){
			$this->item->introtext = trim(preg_replace ( "/\<img[^\>]*>/", '', $this->item->introtext ));
			$this->item->introtext = preg_replace("/<p><\/p>/", '' , $this->item->introtext);
			$imgResizeConfig = array(
				'background' => $yti->thumbnail_background,
				'thumbnail_mode' => $yti->thumbnail_mode
			);					
			YtUtils::getImageResizerHelper($imgResizeConfig);
			$src = YtUtils::resize($images->image_intro, $yti->width, $yti->height, $yti->thumbnail_mode); 
			$img_resize = '<img src="'.$src.'" alt="'.htmlspecialchars($images->image_intro_alt).'"';
			if ($images->image_intro_caption):
				$img_resize .='class="caption" title="' .htmlspecialchars($images->image_intro_caption).'"';
			endif;
			$img_resize .='/>';
		}else{
			$img_resize = $yti->processImage($this->item);
		}
					
	}else{
		$yti->width = $this->templateParams->get('intro_width', '200');
		$yti->height = $this->templateParams->get('intro_height', '200');
		if (isset($images->image_intro) and !empty($images->image_intro)){
			$this->item->introtext = trim(preg_replace ( "/\<img[^\>]*>/", '', $this->item->introtext ));
			$this->item->introtext = preg_replace("/<p><\/p>/", '' , $this->item->introtext);
			$imgResizeConfig = array(
				'background' => $yti->thumbnail_background,
				'thumbnail_mode' => $yti->thumbnail_mode
			);	
			YtUtils::getImageResizerHelper($imgResizeConfig);
			$src = YtUtils::resize($images->image_intro, $yti->width, $yti->height, $yti->thumbnail_mode); 
			$img_resize = '<img src="'.$src.'" alt="'.htmlspecialchars($images->image_intro_alt).'"';
			if ($images->image_intro_caption):
				$img_resize .=' class="caption" title="' .htmlspecialchars($images->image_intro_caption).'"';
			endif;
			$img_resize .='/>';
		}else{
			$img_resize = $yti->processImage($this->item);
		}
	}
}

?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>
<?php if ($params->get('show_title')) : ?>
	<h2 class="contentheading">
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
<?php endif; ?>
<div class="info-head-blog">
	<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
        <ul class="actions">
            <?php if ($params->get('show_print_icon')) : ?>
            <li class="print-icon">
                <?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
            </li>
            <?php endif; ?>
            <?php if ($params->get('show_email_icon')) : ?>
            <li class="email-icon">
                <?php echo JHtml::_('icon.email', $this->item, $params); ?>
            </li>
            <?php endif; ?>
            <?php if ($canEdit) : ?>
            <li class="edit-icon">
                <?php echo JHtml::_('icon.edit', $this->item, $params); ?>
            </li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
    
    <?php if (!$params->get('show_intro')) : ?>
        <?php echo $this->item->event->afterDisplayTitle; ?>
    <?php endif; ?>
    
    <?php echo $this->item->event->beforeDisplayContent; ?>
    
    <?php // to do not that elegant would be nice to group the params ?>
    
    <?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) : ?>
     <dl class="article-info">
     <!--<dt class="article-info-term"><?php //echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>-->
    <?php endif; ?>
    <?php if ($params->get('show_parent_category')) : ?>
            <dd class="parent-category-name">
                <?php $title = $this->escape($this->item->parent_title);
                    $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
                <?php if ($params->get('link_parent_category')) : ?>
                    <?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
                    <?php else : ?>
                    <?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
                <?php endif; ?>
            </dd>
    <?php endif; ?>
    <?php if ($params->get('show_category')) : ?>
            <dd class="category-name">
                <?php $title = $this->escape($this->item->category_title);
                        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)) . '">' . $title . '</a>'; ?>
                <?php if ($params->get('link_category')) : ?>
                    <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
                    <?php else : ?>
                    <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
                <?php endif; ?>
            </dd>
    <?php endif; ?>
    <?php if ($params->get('show_create_date')) : ?>
            <dd class="create">
            <?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
            </dd>
    <?php endif; ?>
    <?php if ($params->get('show_modify_date')) : ?>
            <dd class="modified">
            <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
            </dd>
    <?php endif; ?>
    <?php if ($params->get('show_publish_date')) : ?>
            <dd class="published">
            <?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
            </dd>
    <?php endif; ?>
    <?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
        <dd class="createdby"> 
            <?php $author =  $this->item->author; ?>
            <?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>
    
                <?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
                    <?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' , 
                     JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author)); ?>
    
                <?php else :?>
                    <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
                <?php endif; ?>
        </dd>
    <?php endif; ?>	
    <?php if ($params->get('show_hits')) : ?>
            <dd class="hits">
            <?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
            </dd>
    <?php endif; ?>
    <?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits'))) :?>
        </dl>
    <?php endif; ?>
	<div class="clear"></div>
</div>
<?php 
// ------------ BEGIN: yt - customation ----------//
if($this->templateParams->get('thumbnail') == 1){
	if (isset($images->image_intro) and !empty($images->image_intro)){
		$imgfloat = (empty($images->float_intro)) ? '-'.$params->get('float_intro') : '-'.$images->float_intro;
	}else{
		$imgfloat ='';
	}
	if ($this->leading_or_intro == 'leading' && $img_resize!=''){
	?>
	<div id="image-content leading ifloat<?php echo htmlspecialchars($imgfloat); ?>">
		<?php echo $img_resize; ?>
	</div>
	<?php	
	}else if($this->leading_or_intro == 'intro' && $img_resize!=''){
	?>
	<div id="image-content intro ifloat<?php echo htmlspecialchars($imgfloat); ?>">
		<?php echo $img_resize; ?>
	</div>
	<?php
	}
	// ------------ END: yt - customation ----------//
}
?>

<?php echo $this->item->introtext; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
		<p class="readmore">
				<a href="<?php echo $link; ?>">
					<?php if (!$params->get('access-view')) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?></a>
		</p>
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<?php
if($this->leading_or_intro == 'leading' ){
	echo "<div class='leading_separator'>&nbsp;</div>";
}else{
	echo "<div class='item-separator'></div>";
}
?>
<?php echo $this->item->event->afterDisplayContent; ?>