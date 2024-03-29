<?php
/**
 * @package AkeebaBackup
 * @copyright Copyright (c)2009-2014 Nicholas K. Dionysopoulos
 * @license GNU General Public License version 3, or later
 *
 * @since 3.0
 */

// Protect from unauthorized access
defined('_JEXEC') or die();


/**
 * Regular expression based filesystem filters management View
 *
 */
class AkeebaViewRegexfsfilter extends FOFViewHtml
{
	/**
	 * Modified constructor to enable loading layouts from the plug-ins folder
	 * @param $config
	 */
	public function __construct( $config = array() )
	{
		parent::__construct( $config );
		$tmpl_path = dirname(__FILE__).'/tmpl';
		$this->addTemplatePath($tmpl_path);
	}

	public function onBrowse($tpl = null)
	{
		$media_folder = JURI::base().'../media/com_akeeba/';

		// Get the root URI for media files
		$this->mediadir =  AkeebaHelperEscape::escapeJS($media_folder.'theme/' );

		// Get a JSON representation of the available roots
		$filters = AEFactory::getFilters();
		$root_info = $filters->getInclusions('dir');
		$roots = array();
		$options = array();
		if(!empty($root_info))
		{
			// Loop all dir definitions
			foreach($root_info as $dir_definition)
			{
				if(is_null($dir_definition[1]))
				{
					// Site root definition has a null element 1. It is always pushed on top of the stack.
					array_unshift($roots, $dir_definition[0]);
				}
				else
				{
					$roots[] = $dir_definition[0];
				}

				$options[] = JHTML::_('select.option', $dir_definition[0], $dir_definition[0] );
			}
		}
		$site_root = $roots[0];
		$attribs = 'onchange="akeeba_active_root_changed();"';
		$this->root_select =  JHTML::_('select.genericlist', $options, 'root', $attribs, 'value', 'text', $site_root, 'active_root' );
		$this->roots =  $roots;

		$tpl = null;

		// Get a JSON representation of the directory data
		$model = $this->getModel();
		$json = json_encode($model->get_regex_filters($site_root));
		$this->json =  $json ;

		// Add live help
		AkeebaHelperIncludes::addHelp('regexfsfilter');

		// Get profile ID
		$profileid = AEPlatform::getInstance()->get_active_profile();
		$this->profileid =  $profileid;

		// Get profile name
		$pmodel = FOFModel::getAnInstance('Profiles', 'AkeebaModel');
		$pmodel->setId($profileid);
		$profile_data = $pmodel->getItem();
		$this->profilename =  $profile_data->description;

		return true;
	}

}