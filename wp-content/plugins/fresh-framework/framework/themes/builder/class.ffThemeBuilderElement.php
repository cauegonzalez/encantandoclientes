<?php

abstract class ffThemeBuilderElement extends ffBasicObject {
    const DATA_ID = 'id';
    const DATA_NAME = 'name';
    const DATA_HAS_DROPZONE = 'has_dropzone';
    const DATA_CONNECT_WITH = 'connect_with';
    const DATA_HAS_CONTENT_PARAMS = 'has_content_params';
	const DATA_PICKER_MENU_ID = 'picker_menu_id';
	const DATA_PICKER_TAGS = 'picker_tags';
	const DATA_CAN_BE_CACHED = 'can_be_cached';

/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/
    /**
     * @var ffOptionsQueryDynamic
     */
    private $_queryDynamic = null;

    /**
     * @var ffWPLayer
     */
    private $_WPLayer = null;

    /**
     * @var ffThemeBuilderOptionsExtender
     */
    private $_optionsExtender = null;

    /**
     * @var ffThemeBuilderBlockManager
     */
    private $_themeBuilderBlockManager = null;

	/**
	 * @var ffThemeBuilderAssetsRenderer
	 */
	private $_assetsRenderer = null;

	/**
	 * @var ffThemeBuilderShortcodesStatusHolder
	 */
	protected $_statusHolder = null;

/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/
    /**
     * Settings like "name, id, has dropzone" are stored here. See the constants at the top of this file
     * @var array()
     */
    private $_data = array();

	/**
	 * @var callable
	 */
	private $_doShortcodeCallback = null;

	/**
	 * Is caching mode
	 * @var bool
	 */
	protected $_isCachingMode = false;

	/**
	 * List of elements which are declined in the dropzone
	 * @var null
	 */
	protected $_dropzoneElementBlacklist = array();

	/**
	 * List of elements, which are accepted in the dropzone
	 * @var null
	 */
	protected $_dropzoneElementWhitelist = array();

	/**
	 * List of elements, which could be parents of this element
	 * @var array
	 */
	protected $_parentElementWhitelist = array();

    /**
     * If the element is printed in backend builder or fronted (For user)
     * @var bool
     */
	protected $_isEditMode = false;

	protected $_defaultOptionsData = null;

    protected $_elementOptionsStructure = null;

	protected $_variationCounter = 0;

/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
    public function __construct(
		    ffThemeBuilderOptionsExtender $optionsExtender,
			ffOptionsQueryDynamic $query,
		    ffWPLayer $WPLayer,
			ffThemeBuilderBlockManager $themeBuilderBlockManager,
			ffThemeBuilderAssetsRenderer $assetsRenderer,
			ffThemeBuilderShortcodesStatusHolder $statusHolder
        )
    {
        $this->_setOptionsExtender( $optionsExtender );
        $this->_initData();

	    $query->setGetOptionsCallback( array($this, 'getElementOptionsStructure') );
	    $query->setIteratorValidationCallback( array( $this, 'queryIteratorValidation') );
	    $query->setIteratorStartCallback( array( $this, 'queryIteratorStart') );
	    $query->setIteratorEndCallback( array( $this, 'queryIteratorEnd') );

	    $query->setIteratorBeginningCallback( array( $this, 'queryIteratorBeginning'));
	    $query->setIteratorEndingCallback( array( $this, 'queryIteratorEnding'));

	    $query->setIsPrintingMode(true);


		$this->_setQueryDynamic($query);
        $this->_setWPLayer( $WPLayer );
        $this->_setThemeBuilderBlockManager( $themeBuilderBlockManager );
	    $this->_setAssetsRenderer( $assetsRenderer );
	    $this->_setStatusHolder( $statusHolder );
    }
/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/

	public function getCanBeCached() {
		return $this->_getData( ffThemeBuilderElement::DATA_CAN_BE_CACHED, true);
	}

    public function getPreviewImageUrl() {
        return $this->getBaseUrlOfElement() . '/preview.jpg';
    }

    public function getBaseUrlOfElement() {
        $className = get_class( $this );
        $classUrl = $this->_getClassLoader()->getClassUrl( $className );
        $toReturn = dirname( $classUrl );

        return $toReturn;
    }

	/**
	 * Get the element options as encoded json string
	 * @return string
	 */
    public function getElementOptionsJSONString() {
        return json_encode( $this->getElementOptionsJSON() );
    }

	public function getElementOptionsValues() {
		$structure = $this->getElementOptionsStructure();
		$arrayConvertor = $this->_getOptionsFactory()->createOptionsArrayConvertor(null, $structure );
		$data = $arrayConvertor->walk();
		return $data;
	}

    /**
     * get the options json (basic options, the default ones)
     * @return array
     */
    public function getElementOptionsJSON() {
        $structure = $this->getElementOptionsStructure();
        $jsonConvertor = $this->_getOptionsFactory()->createOptionsPrinterJSONConvertor( null, $structure );
        $json = $jsonConvertor->walk();
        return $json;
    }

	/**
	 * Return default options data. If its not presented anywhere, then we generate it from basic options structure
	 * @return array
	 */
    public function getElementOptionsData() {
        if( $this->_defaultOptionsData == null ) {
            $structure = $this->getElementOptionsStructure();
            $arrayConvertor = $this->_getOptionsFactory()->createOptionsArrayConvertor( null, $structure );

            $this->_defaultOptionsData = $arrayConvertor->walk();
        }
        return $this->_defaultOptionsData;
    }

    /**
     * get the options structure (Basic options, the default ones)
     * @return ffOneStructure
     */
    abstract public function getElementOptionsStructure();

    public function render( $data, $content = null, $uniqueId = null, $contentParams = null ) {
	    $this->_reset();

        $query = $this->_getQueryDynamic();
	    $this->_getAssetsRenderer()->addSelectorToCascade( $this->_getCssSelectorFromUniqueId( $uniqueId ) );

        $query->setData( $data );

	    /**
	     * Content params are stored in shortcodes and their value is in the content of the shortcode
	     */
        if( $this->hasContentParams() && $contentParams != null ) {
            foreach( $contentParams as $route => $value ) {
                $query->setDataValue( $route, $value );
            }
        }

	    // SET TEXT COLOR INHERITANCE
	    $textColor = $this->_getBlock( ffThemeBuilderBlock::COLORS)->returnOnlyTextColor()->get( $query->get('o') );
	    if( !empty($textColor) ) {
		    $this->_getStatusHolder()->addTextColorToStack( $textColor );
	    }



	    /**
	     * Printing of the element itself
	     */
        ob_start();
        if( $this->_isEditMode ) {
            $this->_renderAdmin( $query->get('o gen'), $content, $query->getOnlyData(), $uniqueId);
        } else {

            $this->_render( $query->get('o gen'), $content, $query->getOnlyData(), $uniqueId );
        }
        $content = ob_get_contents();
        ob_end_clean();

	    /**
	     * Applying the inline style options
	     */
        if( !$this->_isEditMode ) {
	        $elementHelper = $this->_getAssetsRenderer()->getElementHelper();
	        $elementHelper->addAttribute( 'class', $this->_getCssSelectorFromUniqueId( $uniqueId ) );
	        $elementHelper->parse( $content );

	        $this->_getBlock( ffThemeBuilderBlock::BOX_MODEL)->get( $query->get('o') );
	        $this->_getBlock(ffThemeBuilderBlock::ADVANCED_TOOLS)->get( $query->get('o') );
	        $this->_getBlock( ffThemeBuilderBlock::CUSTOM_CODES)->get( $query->get('o') );
	        $this->_getBlock( ffThemeBuilderBlock::COLORS)->get( $query->get('o') );

	        $content = $elementHelper->get();
        }

	    $this->_getAssetsRenderer()->removeSelectorFromCascade();

	    // REMOVE TEXT COLOR INHERITANCE
	    if( !empty($textColor) ) {
		    $this->_getStatusHolder()->removeTextColorFromStack();
	    }

        return $content;
    }


/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/
    public function setIsEditMode( $value ) {
        $this->_isEditMode = $value;
        $this->_getThemeBuilderBlockManager()->setIsEditMode( $value );
    }

    public function getIsEditMode() {
        return $this->_isEditMode;
    }

    public function getID() {
        return $this->_getData( ffThemeBuilderElement::DATA_ID );
    }

    public function getData() {
        return $this->_data;
    }

	/**
	 * Data json for the javascript side
	 * @return array
	 */
    public function getElementDataForBuilder() {

	    $className = get_class( $this );

        $data = array();
        $data['id'] = $this->_getData( ffThemeBuilderElement::DATA_ID );
        $data['name'] = $this->_getData( ffThemeBuilderElement::DATA_NAME );

        $data['optionsStructure'] = $this->getElementOptionsJSONString();

	    $data['picker'] = array();
	    $data['picker']['menuId'] = $this->_getData( ffThemeBuilderElement::DATA_PICKER_MENU_ID );
	    $data['picker']['tags'] = $this->_getData( ffThemeBuilderElement::DATA_PICKER_TAGS );

        $data['functions'] = array();
        $data['functions']['renderContentInfo_JS'] = $this->_getJSFunction('_renderContentInfo_JS');

        $data['defaultHtml'] = $this->_getDefaultHTML();

        $data['previewImage'] = $this->getPreviewImageUrl();

	    $data['dropzoneWhitelistedElements'] = $this->_dropzoneElementWhitelist;
	    $data['dropzoneBlacklistedElements'] = $this->_dropzoneElementBlacklist;

	    $data['parentWhitelistedElement'] = $this->_parentElementWhitelist;
//
        return $data;
    }

    public function hasContentParams() {
        return $this->_getData( ffThemeBuilderElement::DATA_HAS_CONTENT_PARAMS, false);
    }

	public function getAssetsRenderer() {
		return $this->_getAssetsRenderer();
	}

/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/
	protected function _reset() {
		$this->_variationCounter = 0;
	}

    protected function _getDefaultHTML() {
        $query = $this->_getQueryDynamic()->setData(null);
        $data = $this->getElementOptionsData();


        ob_start();
        $this->_renderAdmin( $query, '', $data, null );
        $defaultHTML = ob_get_contents();
        ob_end_clean();

        return $defaultHTML;
    }

	protected function _getCssSelectorFromUniqueId( $uniqueId ) {
		return 'ffb-id-'. $uniqueId;
	}
    protected abstract function _initData();

	/**
	 * @param $s ffOneStructure|ffThemeBuilderOptionsExtender
	 * @return mixed
	 */
    protected abstract function _getElementGeneralOptions( $s );
    protected abstract function _render( ffOptionsQueryDynamic $query, $content, $data, $uniqueId );
    protected abstract function _renderAdmin( ffOptionsQueryDynamic $query, $content, $data, $uniqueId );
    protected abstract function _beforeRenderingAdminWrapper( ffOptionsQueryDynamic $query, $content, ffMultiAttrHelper $multiAttrHelper, ffStdClass $otherData );
	public abstract function queryIteratorValidation( $query, $key );
	public abstract function queryIteratorStart( $query, $key );
	public abstract function queryIteratorEnd( $query, $key );

	public abstract function queryIteratorBeginning( $query );
	public abstract function queryIteratorEnding( $query );


    protected abstract function _renderContentInfo_JS();

    protected function _getJSFunction( $functionName ) {
        ob_start();
            call_user_func( array( $this, $functionName) );
        $content = ob_get_contents();
        ob_end_clean();

        $content = str_replace('<script data-type="ffscript">', '', $content);
        $content = str_replace('</script data-type="ffscript">', '', $content);

        return $content;
    }

    protected function _setData( $name, $value ) {
        $this->_data[ $name ] = $value;
    }

    protected function _doShortcode( $content ) {
	    if( $this->_doShortcodeCallback == null ) {
		    return null;
	    } else {
		    return call_user_func( $this->_doShortcodeCallback, $content );
	    }
    }

    protected function _getData( $name, $default = null ) {
        if( isset( $this->_data[ $name ] ) ) {
            return $this->_data[ $name ];
        } else {
            return $default;
        }
    }

    /**
     * @param $blockClassName
     * @return ffThemeBuilderBlock
     */
    protected function _getBlock( $blockClassName ) {
        $block = $this->_getThemeBuilderBlockManager()->getBlock( $blockClassName );
	    $block->setAssetsRenderer( $this->_getAssetsRenderer() );
	    $block->setStatusHolder( $this->_statusHolder );
        return $block;
    }


/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
    /**
     * @return ffOptionsQueryDynamic
     */
    private function _getQueryDynamic()
    {
        return $this->_queryDynamic;
    }

    /**
     * @param ffOptionsQueryDynamic $queryDynamic
     */
    private function _setQueryDynamic($queryDynamic)
    {
        $this->_queryDynamic = $queryDynamic;
    }

    /**
     * @return ffWPLayer
     */
    protected function _getWPLayer()
    {
        return $this->_WPLayer;
    }

    /**
     * @param ffWPLayer $WPLayer
     */
    private function _setWPLayer($WPLayer)
    {
        $this->_WPLayer = $WPLayer;
    }

    /**
     * @return ffThemeBuilderOptionsExtender
     */
    protected function _getOptionsExtender()
    {
        return $this->_optionsExtender;
    }

    /**
     * @param ffThemeBuilderOptionsExtender $optionsExtender
     */
    private function _setOptionsExtender($optionsExtender)
    {
        $this->_optionsExtender = $optionsExtender;
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
	 * @return ffClassLoader
	 */
	private function _getClassLoader() {
		return ffContainer()->getClassLoader();
	}

	/**
	 * @return ffOptions_Factory
	 */
	protected function _getOptionsFactory() {
		return ffContainer()->getOptionsFactory();
	}

	/**
	 * @return ffThemeBuilderAssetsRenderer
	 */
	protected function _getAssetsRenderer() {
		return $this->_assetsRenderer;
	}

	/**
	 * @param ffThemeBuilderAssetsRenderer $assetsRenderer
	 */
	protected function _setAssetsRenderer($assetsRenderer) {
		$this->_assetsRenderer = $assetsRenderer;
	}

	public function setDoShortcodeCallback( $callback ) {
		$this->_doShortcodeCallback = $callback;
	}

	/**
	 * @return boolean
	 */
	protected function _getIsCachingMode() {
		return $this->_isCachingMode;
	}

	/**
	 * @param boolean $isCachingMode
	 */
	public function setIsCachingMode($isCachingMode) {
		$this->_isCachingMode = $isCachingMode;
	}

	/**
	 * @return ffThemeBuilderShortcodesStatusHolder
	 */
	protected function _getStatusHolder() {
		return $this->_statusHolder;
	}

	/**
	 * @param ffThemeBuilderShortcodesStatusHolder $statusHolder
	 */
	private function _setStatusHolder($statusHolder) {
		$this->_statusHolder = $statusHolder;
	}


}