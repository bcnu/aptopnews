<?php
/**
 * @version		$Id: p3p.php 21097 2011-04-07 15:38:03Z dextercowley $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Joomla! P3P Header Plugin
 *
 * @package		Joomla.Plugin
 * @subpackage	System.p3p
 */
class plgSystemSjCore extends JPlugin {
	function onAfterInitialise() {
		defined('_YTOOLS') or include_once dirname(__FILE__) . DS . 'core' . DS . 'sjimport.php';
	}
}
