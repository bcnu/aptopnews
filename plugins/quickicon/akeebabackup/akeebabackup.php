<?php
/**
 *  @package AdminTools
 *  @copyright Copyright (c)2010-2014 Nicholas K. Dionysopoulos
 *  @license GNU General Public License version 3, or later
 */

defined('_JEXEC') or die;

// Check for PHP4
if(defined('PHP_VERSION')) {
	$version = PHP_VERSION;
} elseif(function_exists('phpversion')) {
	$version = phpversion();
} else {
	// No version info. I'll lie and hope for the best.
	$version = '5.0.0';
}

// Old PHP version detected. EJECT! EJECT! EJECT!
if(!version_compare($version, '5.3.0', '>=')) return;

// Make sure Akeeba Backup is installed
if(!file_exists(JPATH_ADMINISTRATOR.'/components/com_akeeba')) {
	return;
}

// Joomla! version check
if(version_compare(JVERSION, '2.5', 'lt') && version_compare(JVERSION, '1.6.0', 'ge')) {
	// Joomla! 1.6.x and 1.7.x: sorry fellas, no go.
	return;
}

// Deactivate self
$db = JFactory::getDbo();
$query = $db->getQuery(true)
	->update($db->qn('#__extensions'))
	->set($db->qn('enabled').' = '.$db->q('0'))
	->where($db->qn('element').' = '.$db->q('akeebabackup'))
	->where($db->qn('folder').' = '.$db->q('quickicon'));
$db->setQuery($query);
$db->execute();

// Load FOF
if(!defined('FOF_INCLUDED')) {
	include_once JPATH_SITE.'/libraries/fof/include.php';
}
if(!defined('FOF_INCLUDED') || !class_exists('FOFLess', true))
{
	return;
}

// Timezone fix; avoids errors printed out by PHP 5.3.3+ (thanks Yannick!)
if(function_exists('date_default_timezone_get') && function_exists('date_default_timezone_set')) {
	if(function_exists('error_reporting')) {
		$oldLevel = error_reporting(0);
	}
	$serverTimezone = @date_default_timezone_get();
	if(empty($serverTimezone) || !is_string($serverTimezone)) $serverTimezone = 'UTC';
	if(function_exists('error_reporting')) {
		error_reporting($oldLevel);
	}
	@date_default_timezone_set( $serverTimezone);
}
/*
 * Hopefuly, if we are still here, the site is running on at least PHP5. This means that
 * including the Akeeba Backup factory class will not throw a White Screen of Death, locking
 * the administrator out of the back-end.
 */

// Make sure Akeeba Backup is installed, or quit
$akeeba_installed = @file_exists(JPATH_ADMINISTRATOR.'/components/com_akeeba/akeeba/factory.php');
if(!$akeeba_installed) return;

// Make sure Akeeba Backup is enabled
JLoader::import('joomla.application.component.helper');
if (!JComponentHelper::isEnabled('com_akeeba', true))
{
	//JError::raiseError('E_JPNOTENABLED', JText('MOD_AKADMIN_AKEEBA_NOT_ENABLED'));
	return;
}

// Joomla! 1.6 or later - check ACLs (and not display when the site is bricked,
// hopefully resulting in no stupid emails from users who think that somehow
// Akeeba Backup crashed their site). It also not displays the button to people
// who are not authorised to take backups - which makes perfect sense!
$continueLoadingIcon = true;
$user = JFactory::getUser();
if (!$user->authorise('akeeba.backup', 'com_akeeba')) {
	$continueLoadingIcon = false;
}

// Do we really, REALLY have Akeeba Engine?
if($continueLoadingIcon) {
	if(!defined('AKEEBAENGINE')) {
		define('AKEEBAENGINE', 1); // Required for accessing Akeeba Engine's factory class
	}
	try {
		@include_once JPATH_ADMINISTRATOR.'/components/com_akeeba/akeeba/factory.php';
		if(!class_exists('AEFactory', false)) {
			$continueLoadingIcon = false;
		}
	} catch(Exception $e) {
		$continueLoadingIcon = false;
	}
}

// Enable self if we have to bail out
if(!$continueLoadingIcon) {
	$db = JFactory::getDbo();
	$query = $db->getQuery(true)
		->update($db->qn('#__extensions'))
		->set($db->qn('enabled').' = '.$db->q('1'))
		->where($db->qn('element').' = '.$db->q('akeebabackup'))
		->where($db->qn('folder').' = '.$db->q('quickicon'));
	$db->setQuery($query);
	$db->execute();

	return;
}
unset($continueLoadingIcon);

/**
 * Joomla! udpate notification plugin
 *
 * @package     Joomla.Plugin
 * @subpackage  Quickicon.Joomlaupdate
 * @since       2.5
 */
class plgQuickiconAkeebabackup extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 *
	 * @since       2.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	 * This method is called when the Quick Icons module is constructing its set
	 * of icons. You can return an array which defines a single icon and it will
	 * be rendered right after the stock Quick Icons.
	 *
	 * @param  $context  The calling context
	 *
	 * @return array A list of icon definition associative arrays, consisting of the
	 *				 keys link, image, text and access.
	 *
	 * @since       2.5
	 */
	public function onGetIcons($context)
	{
		if ($context != $this->params->get('context', 'mod_quickicon') || !JFactory::getUser()->authorise('core.manage', 'com_installer')) {
			return;
		}

		$url = JURI::base();
		$url = rtrim($url, '/');

		$ret = array(
			'link' => 'index.php?option=com_akeeba&view=backup',
			'image' => 'briefcase',
			'text' => JText::_('PLG_QUICKICON_AKEEBABACKUP_OK'),
			'id' => 'plg_quickicon_akeebabackup',
			'group' => 'MOD_QUICKICON_MAINTENANCE',
		);

		if(version_compare(JVERSION, '3.0', 'lt')) {
			$ret['image'] = $url.'/../media/com_akeeba/icons/akeeba-48.png';
		}


		if( $this->params->get('enablewarning', 0) == 0 )
		{
			// Process warnings
			$warning = false;

			$aeconfig = AEFactory::getConfiguration();
			AEPlatform::getInstance()->load_configuration();

			// Get latest non-SRP backup ID
			$filters = array(
				array(
					'field'			=> 'tag',
					'operand'		=> '<>',
					'value'			=> 'restorepoint'
				)
			);
			$ordering = array(
				'by'		=> 'backupstart',
				'order'		=> 'DESC'
			);
			require_once JPATH_ADMINISTRATOR.'/components/com_akeeba/models/statistics.php';
			$model = new AkeebaModelStatistics();
			$list = $model->getStatisticsListWithMeta(false, $filters, $ordering);

			if(!empty($list)) {
				$record = (object)array_shift($list);
			} else {
				$record = null;
			}

			// Process "failed backup" warnings, if specified
			if( $this->params->get('warnfailed', 0) == 0 )
			{
				if(!is_null($record))
				{
					$warning = (($record->status == 'fail') || ($record->status == 'run'));
				}
			}

			// Process "stale backup" warnings, if specified
			if(is_null($record))
			{
				$warning = true;
			}
			else
			{
				$maxperiod = $this->params->get('maxbackupperiod', 24);
				JLoader::import('joomla.utilities.date');
				$lastBackupRaw = $record->backupstart;
				$lastBackupObject = new JDate($lastBackupRaw);
				$lastBackup = $lastBackupObject->toUnix(false);
				$maxBackup = time() - $maxperiod * 3600;
				if(!$warning) $warning = ($lastBackup < $maxBackup);
			}

			if($warning)
			{
				$ret['image'] = 'health';
				$ret['text'] = JText::_('PLG_QUICKICON_AKEEBABACKUP_BACKUPREQUIRED');
				if(version_compare(JVERSION, '3.0', 'lt')) {
					$ret['image'] = $url.'/../media/com_akeeba/icons/akeeba-warning-48.png';
				}
			}
		}

		// Re-enable self
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->update($db->qn('#__extensions'))
			->set($db->qn('enabled').' = '.$db->q('1'))
			->where($db->qn('element').' = '.$db->q('akeebabackup'))
			->where($db->qn('folder').' = '.$db->q('quickicon'));
		$db->setQuery($query);
		$db->execute();

		return array($ret);
	}
}
