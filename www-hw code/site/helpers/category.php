<?php
/**
 * Class definition for HelloworldCategories
 */

defined('_JEXEC') or die;

class HelloworldCategories extends JCategories
{
	public function __construct($options = array())
	{
		$options['table'] = '#__helloworld';
		$options['extension'] = 'com_helloworld';

		parent::__construct($options);
	}
}