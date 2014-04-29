<?php
/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (C) 2011 - 2014 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

abstract class mod_mh_simple_marquee
{

    public static function _(JRegistry &$params, stdClass $module)
    {
        if (JVERSION >= 3) {
            $params->set('lib', 'jquery');

            $data['pauseOnHover'] = $params->get('pauseOnOver', true);

            switch ($params->get('direction', 'left')) {
                case 'bottom':
                    $data['direction'] = 'down';
                    break;

                case 'top':
                    $data['direction'] = 'up';
                    break;

                default:
                    $data['direction'] = $params->get('direction', 'left');
                    break;
            }

            $data['duration'] = $params->get('speed', 40) * 200;

            if ($params->get('width')) {
                $css[] = '#mod_simple_marquee_' . $module->id . ' .mod_simple_marquee_content{width:' . (is_numeric($params->get('width')) ? $params->get('width') . 'px' : $params->get('width')) . ';}';
            }

            if ($params->get('height')) {
                $css[] = '#mod_simple_marquee_' . $module->id . ' .mod_simple_marquee_content{height:' . (is_numeric($params->get('height')) ? $params->get('height') . 'px' : $params->get('height')) . ';}';
            }
        } else {
            $params->set('lib', 'mootools');

            $data['pauseOnOver'] = $params->get('pauseOnOver', 1);
            $data['speed'] = $params->get('speed', 40);
            $data['direction'] = $params->get('direction', 'left');

            if ($params->get('width')) {
                $data['marWidth'] = JString::str_ireplace('px', '', $params->get('width'));
            }

            if ($params->get('height')) {
                $data['marHeight'] = JString::str_ireplace('px', '', $params->get('height'));
            }
        }

        foreach ($data as $option => $value) {
            $options[] = $option . '=' . $value;
        }

        if (isset($css)) {
            JFactory::getDocument()->addStyleDeclaration(implode($css));
        }

        return $options;
    }
}