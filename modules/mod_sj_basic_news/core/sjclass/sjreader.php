<?php
/**
 * @package SjClass
 * @subpackage SjReader
 * @version $Id: sjreader.php 650 2011-12-07 09:38:02Z tuyenlb $
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 * @author YouTech Company
 *
 */

defined('_YTOOLS') or die;

abstract class SjReader {
	abstract function getList(&$params);
}