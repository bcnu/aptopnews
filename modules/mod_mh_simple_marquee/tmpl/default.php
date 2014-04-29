<?php
/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (C) 2011 - 2014 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

JHtml::_('behavior.framework');

JFactory::getDocument()->addScript(JUri::base(true) . '/modules/' . $module->module . '/tmpl/' . $params->get('lib') . '.marquee.js');
JFactory::getDocument()->addStyleSheet(JUri::base(true) . '/modules/' . $module->module . '/tmpl/default.css');
?>
<div class="mod_simple_marquee" id="mod_simple_marquee_<?php echo $module->id; ?>">
    <a name="marqueeconfig" rel="<?php echo implode('|', $options); ?>"></a>

    <div class="mod_simple_marquee_content"><?php echo $marquee; ?></div>
</div>