<?php
/**
 * @package YTools
 * @version $Id: yloader.php 762 2011-12-14 11:09:56Z tuyenlb $
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 * @author YouTech Company
 *
 */

defined('_JEXEC') or die;

define('_YTOOLS', 1);
define('_YTOOLS_VERSION', '1.0.0.20111207');
define('_YTOOLS_BASE', dirname(__FILE__) . DS . 'ytools');
define('_SJ_CLASSES', dirname(__FILE__) . DS . 'sjclass');

include_once _YTOOLS_BASE .DS . 'ytools.php';
include_once _SJ_CLASSES . DS . 'sjmodule.php';
include_once _SJ_CLASSES . DS . 'sjreader.php';
include_once _SJ_CLASSES . DS . 'sjtools.php';
