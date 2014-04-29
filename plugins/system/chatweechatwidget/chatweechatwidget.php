<?php

/*
 * @version;   						1.0
 * @category;						widget
 * @copyright;   					Copyright (C) 2014 Chatwee Team. All rights reserved.
 * @license;   						GNU GPLv3 http://www.gnu.org/licenses/gpl.html
 * @link ;   						http://www.chatwee.com/
 */

defined( '_JEXEC' ) or die( 'Direct Access Denied' );

jimport( 'joomla.plugin.plugin');

jimport( 'joomla.html.parameter');

class plgSystemChatweechatwidget extends JPlugin
{
	function plgSystemChatweechatwidget(&$subject, $config)
	{ 
		parent::__construct($subject, $config);
		
		$this->_plugin = JPluginHelper::getPlugin( 'system', 'chatweechatwidget' );
		
		$this->_params = new JRegistry( $this->_plugin->params );
	}
	
	function onAfterRender()
	{
		$panel_admin = &JFactory::getApplication();
		
		$widget_code = $this->params->get('widget_code');
		
		if($widget_code == '' || $panel_admin->isAdmin() || strpos($_SERVER["PHP_SELF"], "index.php") === false)
		{
			return;
		}

		$document = JFactory::getDocument();
		
		$widget_codea = $this->params->get('widget_code');
	
		$block = JResponse::getBody();
		
		$block = str_replace("</body>", $widget_codea."</body>", $block);
		
		JResponse::setBody($block);
		
		return true;
	}
}

?>