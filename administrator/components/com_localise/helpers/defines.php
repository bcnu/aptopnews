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

// Define constant
$params = JComponentHelper::getParams('com_localise');
define('LOCALISEPATH_SITE', JPATH_SITE);
define('LOCALISEPATH_ADMINISTRATOR', JPATH_ADMINISTRATOR);
define('LOCALISEPATH_INSTALLATION', JPATH_ROOT . '/' . $params->get('installation', 'installation'));
