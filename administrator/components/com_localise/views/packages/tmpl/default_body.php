<?php
/*------------------------------------------------------------------------
# com_localise - Localise
# ------------------------------------------------------------------------
# author    Mohammad Hasani Eghtedar <m.h.eghtedar@gmail.com>
# copyright Copyright (C) 2010 http://joomlacode.org/gf/project/com_localise/. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://joomlacode.org/gf/project/com_localise/
# Technical Support:  Forum - http://joomlacode.org/gf/project/com_localise/forum/
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$user = JFactory::getUser();
$canAdmin = $user->authorise('core.admin', 'com_localise');
?>
<?php foreach($this->items as $i => $item): ?>
<?php $canEdit = $user->authorise('localise.edit', 'com_localise.'.$item->id);?>

<tr class="row<?php echo $i % 2; ?>">
  <td width="20" align="right"><?php echo $i + 1; ?></td>
  <td width="20" align="center"><?php if (empty($item->checked_out)) : ?>
    <?php echo JHtml::_('grid.id', $i, $item->name);?>
    <?php else:?>
    <?php echo JHtml::_('jgrid.checkedout', $item->editor, $item->checked_out_time); ?>
    <?php endif; ?></td>
  <td><?php LocaliseHelper::loadLanguage($item->manifest, $item->client);?>
    <span title="<?php echo JText::_($item->title);?>::<?php echo JText::_($item->description);?>" class="hasTip localise-icon " style="background-image:url(<?php echo JURI::root(true).$item->icon;?>);"></span>
    <?php if (!$canAdmin): ?>
    <span title="<?php echo JText::_('COM_LOCALISE_TOOLTIP_PACKAGES_READONLY'); ?>"  class="hasTip localise-icon icon-16-warning"> <?php echo JText::sprintf('COM_LOCALISE_TEXT_PACKAGES_TITLE',JText::_($item->title),$item->name); ?> </span>
    <?php elseif ($item->writable && $canEdit): ?>
    <span title="" class="localise-icon"> <a href="<?php echo JRoute::_('index.php?option=com_localise&task=package.edit&cid[]=' . $item->name); ?>" title="<?php echo JText::_('COM_LOCALISE_TOOLTIP_PACKAGES_EDIT'); ?>"><?php echo JText::sprintf('COM_LOCALISE_TEXT_PACKAGES_TITLE',JText::_($item->title),$item->name); ?></a> </span>
    <?php else: ?>
    <span title="<?php echo JText::sprintf($canEdit ? 'COM_LOCALISE_TOOLTIP_PACKAGES_NOTWRITABLE':'COM_LOCALISE_TOOLTIP_PACKAGES_NOTEDITABLE', substr($item->path, strlen(JPATH_ROOT) + 1)); ?>"  class="hasTip localise-icon icon-16-warning"> <?php echo JText::sprintf('COM_LOCALISE_TEXT_PACKAGES_TITLE',$item->title,$item->name); ?> </span>
    <?php endif; ?></td>
</tr>
<?php endforeach; ?>
