<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
/**
 * Hello World Component Controller
 *
 * @since  0.0.1
 */
class HelloWorldController extends JControllerLegacy
{
	public function display($cachable = false, $urlparams = array())
	{
		$viewName = $this->input->get('view', '');
		$cachable = true;
		if ($viewName == 'form' || JFactory::getUser()->get('id'))
		{
			$cachable = false;
		}
		
		$safeurlparams = array(
			'id'               => 'ARRAY',
			'catid'            => 'ARRAY',
			'list'             => 'ARRAY',
			'limitstart'       => 'UINT',
			'Itemid'           => 'INT',
			'view'             => 'CMD',
			'lang'             => 'CMD',
		);
		
		parent::display($cachable, $safeurlparams);
	}
	
    public function mapsearch()
    {
//		if (!JSession::checkToken('get')) 
//		{
//			echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
//		}
//		else 
//		{
			parent::display();
//		}
    }
}