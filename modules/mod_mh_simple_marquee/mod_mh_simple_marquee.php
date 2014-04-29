<?php
/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (C) 2011 - 2014 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

$options = mod_mh_simple_marquee::_($params, $module);

$marquee = $params->get('marquee');

if ($params->get('random')) {
    $marquee = explode(PHP_EOL, $marquee);
    shuffle($marquee);
    $marquee = implode(PHP_EOL, $marquee);
}

$marquee = JString::str_ireplace(PHP_EOL, ' ' . $params->get('spacer') . ' ', $marquee);

if ($params->get('plugins')) {
    $marquee = JHtml::_('content.prepare', $marquee);
}

require JModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default'));