<?php
/*
 * View file for the view which displays a list of helloworld messages in a given category
 */
 
defined('_JEXEC') or die;

class HelloworldViewCategory extends JViewCategory
{
	public function display($tpl = null)
	{
        $this->categoryName = $this->get("CategoryName");
        
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');
        
        $this->subcategories = $this->get('Subcategories');
		
		$this->params = JFactory::getApplication()->getParams();

		parent::display($tpl);
	}
	
	protected function prepareDocument()
	{
		parent::prepareDocument();
		parent::addFeed();
	}
}