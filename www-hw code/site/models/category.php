<?php
/**
 * Model for displaying the helloworld messages in a given category
 */

defined('_JEXEC') or die;

class HelloworldModelCategory extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',
				'greeting',
				'alias',
				'lft',
			);
		}

		parent::__construct($config);
	}
    
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState($ordering, $direction);
        
		$app = JFactory::getApplication('site');
		$catid = $app->input->getInt('id');

		$this->setState('category.id', $catid);
	}
    
	protected function getListQuery()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		$catid = $this->getState('category.id'); 
		$query->select('id, greeting, alias, catid, access, description, image')
			->from($db->quoteName('#__helloworld'))
			->where('catid = ' . $catid);

        if (JLanguageMultilang::isEnabled())
        {
            $lang = JFactory::getLanguage()->getTag();
            $query->where('language IN ("*","' . $lang . '")');
        }
        
		$orderCol	= $this->state->get('list.ordering', 'lft');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

		return $query;	
	}
    
    public function getCategoryName()
    {
        $catid = $this->getState('category.id'); 
        $categories = JCategories::getInstance('Helloworld', array('access' => false));
        $categoryNode = $categories->get($catid);   
        return $categoryNode->title; 
    }
    
    public function getSubcategories()
    {
        $catid = $this->getState('category.id'); 
        $categories = JCategories::getInstance('Helloworld', array('access' => false));
        $categoryNode = $categories->get($catid);
        $subcats = $categoryNode->getChildren(); 
        
        $lang = JFactory::getLanguage()->getTag();
        if (JLanguageMultilang::isEnabled() && $lang)
        {
            $query_lang = "&lang={$lang}";
        }
        else
        {
            $query_lang = '';
        }
        
        foreach ($subcats as $subcat)
        {
            $subcat->url = JRoute::_("index.php?view=category&id=" . $subcat->id . $query_lang);
        }
        return $subcats;
    }
	
	public function getCategoryAccess()
	{
		$catid = $this->getState('category.id'); 
		$categories = JCategories::getInstance('Helloworld', array('access' => false));
		$categoryNode = $categories->get($catid);   
		return $categoryNode->access; 
	}
	
	public function getItems()
	{
		$items = parent::getItems();
		$user = JFactory::getUser();
		$loggedIn = $user->get('guest') != 1;

		if ($user->authorise('core.admin')) // ie superuser
		{
			return $items;
		}
		else
		{
			$userAccessLevels = $user->getAuthorisedViewLevels();
			$catAccess = $this->getCategoryAccess();
			
			if (!in_array($catAccess, $userAccessLevels))
			{  // the user hasn't access to the category
				if ($loggedIn)
				{	
					return array();
				}
				else
				{
					foreach ($items as $item)
					{
						$item->canAccess = false;
					}
					return $items;
				}
			}

			foreach ($items as $item) 
			{
				if (!in_array($item->access, $userAccessLevels))
				{
					if ($loggedIn)
					{
						unset($item);
					}
					else
					{
						$item->canAccess = false;
					}
				}
			}
		}
		return $items;
	}
	
	public function getCategory()
	{
		$categories = JCategories::getInstance('Helloworld', $options);
		$category = $categories->get($this->getState('category.id', 'root'));
		return $category;
	}
}