<?php

/**
 * Class ffThemeBuilderElementManager
 */
class ffThemeBuilderElementManager extends ffBasicObject {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/
    /**
     * @var ffCollection[ffThemeBuilderElement]
     */
    private $_elementCollection = null;

    /**
     * @var ffThemeBuilderElementFactory
     */
    private $_themeBuilderElementFactory = null;

    /**
     * @var ffThemeBuilderBlockManager
     */
    private $_themeBuilderBlockManager = null;

	/**
	 * @var ffThemeBuilderShortcodesStatusHolder
	 */
	private $_statusHolder = null;

    /**
     * @var ffCollection
     */
    private $_menuItemCollection = null;

	/**
	 * @var ffThemeBuilderColorLibrary
	 */
	private $_colorLibrary;

/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/

    private $_isEditMode = false;
/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
    public function __construct( ffCollection $elementCollection,
                                 ffCollection $menuItemCollection,
                                 ffThemeBuilderElementFactory $elementFactory,
                                 ffThemeBuilderShortcodesStatusHolder $statusHolder,
                                 ffThemeBuilderColorLibrary $colorLibrary ) {

        $this->_setElementCollection( $elementCollection );
        $this->_setMenuItemCollection( $menuItemCollection );
        $this->_setThemeBuilderElementFactory( $elementFactory );
        $this->_setThemeBuilderBlockManager( ffContainer()->getThemeFrameworkFactory()->getThemeBuilderBlockManager() ) ;
	    $this->_setStatusHolder( $statusHolder );
	    $this->_setColorLibrary( $colorLibrary );
    }

    public function addOverloadedElement( $elementClassName, $overloadedElementClassName ) {

        $this->_getThemeBuilderElementFactory()->loadElement( $overloadedElementClassName );
        $this->addElement( $elementClassName );
    }

    public function addElement( $elementClassName ) {


        $element = $this->_getThemeBuilderElementFactory()->createElement( $elementClassName );
        $element->setIsEditMode( $this->_isEditMode );
        $this->_getElementCollection()->addItem( $element, $element->getID() );
    }

    public function addMenuItem( $name, $id ) {
        $menuItem = new ffStdClass();
        $menuItem->name = $name;
        $menuItem->id = $id;

        $menuItemArray = $menuItem->getArray();

        $this->_getMenuItemCollection()->addItem( $menuItemArray, $id );
    }

    public function getAllElementsIds() {
        $toReturn = [];

        foreach( $this->_getElementCollection() as $key => $value ) {
            $toReturn[] = $key;
        }

        return $toReturn;
    }

    public function setIsEditMode( $value ) {
        $this->_isEditMode = $value;
        foreach( $this->_getElementCollection() as $oneItem ) {
            $oneItem->setIsEditMode( $value );
        }
    }

	public function getNonCacheableElements() {
		/**
		 * @var $oneElement ffThemeBuilderElement
		 */
		$nonCacheableElements = array();
		foreach( $this->_getElementCollection() as $oneElement ) {
			if( !$oneElement->getCanBeCached() ) {
				$nonCacheableElements[] = $oneElement->getID();
			}
		}

		return $nonCacheableElements;
	}

    public function getElementsData() {
	    $cache = ffContainer()->getDataStorageCache();
	    $data = null;
//	    $data = $cache->getOption('ffbuilder', 'all' );
//
	    if( empty( $data ) ) {

	        $data = array();
	        $data['elements'] = array();
	        foreach( $this->_getElementCollection() as $id => $element ) {
	            $data['elements'][$id ] = $element->getElementDataForBuilder();
	        }

	        $data['menuItems'] = array();
	        foreach( $this->_getMenuItemCollection() as $id => $menuItem ) {
	            $data['menuItems'][$id] = $menuItem;
	        }

	        $data['blocks'] = $this->_getThemeBuilderBlockManager()->getBlocksData();
	        $data['blocks_functions'] = $this->_getThemeBuilderBlockManager()->getBlocksJSFunctions();

//		    $data['color_library'] = $this->_getColorLibrary()->getLibrary();

		    $cache->setOption('ffbuilder', 'all', json_encode($data));

	    } else {
			    $data = json_decode( $data, true );
	    }


        return $data;
    }

	/**
	 * @param $id
	 * @return ffThemeBuilderElement
	 */
    public function getElementById( $id ) {
        return $this->_getElementCollection()->getItemById( $id );
    }
/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/
	public function getElementsCollection() {
		return $this->_getElementCollection();
	}
/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
    /**
     * @return ffCollection
     */
    private function _getElementCollection()
    {
        return $this->_elementCollection;
    }

    /**
     * @param ffCollection $elementCollection
     */
    private function _setElementCollection($elementCollection)
    {
        $this->_elementCollection = $elementCollection;
    }

    /**
     * @return ffThemeBuilderElementFactory
     */
    private function _getThemeBuilderElementFactory()
    {
        return $this->_themeBuilderElementFactory;
    }

    /**
     * @param ffThemeBuilderElementFactory $themeBuilderElementFactory
     */
    private function _setThemeBuilderElementFactory($themeBuilderElementFactory)
    {
        $this->_themeBuilderElementFactory = $themeBuilderElementFactory;
    }

    /**
     * @return ffCollection
     */
    private function _getMenuItemCollection()
    {
        return $this->_menuItemCollection;
    }

    /**
     * @param ffCollection $menuItemCollection
     */
    private function _setMenuItemCollection($menuItemCollection)
    {
        $this->_menuItemCollection = $menuItemCollection;
    }

    /**
     * @return ffThemeBuilderBlockManager
     */
    private function _getThemeBuilderBlockManager() {
        return $this->_themeBuilderBlockManager;
    }

    /**
     * @param ffThemeBuilderBlockManager $themeBuilderBlockManager
     */
    private function _setThemeBuilderBlockManager($themeBuilderBlockManager) {
        $this->_themeBuilderBlockManager = $themeBuilderBlockManager;
    }

	/**
	 * @return ffThemeBuilderShortcodesStatusHolder
	 */
	public function getStatusHolder() {
		return $this->_statusHolder;
	}

	/**
	 * @param ffThemeBuilderShortcodesStatusHolder $statusHolder
	 */
	private function _setStatusHolder($statusHolder) {
		$this->_statusHolder = $statusHolder;
	}

	/**
	 * @return ffThemeBuilderColorLibrary
	 */
	private function _getColorLibrary() {
		return $this->_colorLibrary;
	}

	/**
	 * @param ffThemeBuilderColorLibrary $colorLibrary
	 */
	private function _setColorLibrary($colorLibrary) {
		$this->_colorLibrary = $colorLibrary;
	}

}