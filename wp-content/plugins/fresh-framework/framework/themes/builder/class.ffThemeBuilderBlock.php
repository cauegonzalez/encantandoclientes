<?php

abstract class ffThemeBuilderBlock extends ffBasicObject {
    const INFO_ID = 'id';
    const INFO_WRAPPING_ID = 'wrapping_id';
    const INFO_WRAP_AUTOMATICALLY = 'wrap_automatically';
    const INFO_IS_REFERENCE_SECTION = 'is_reference_section';
    const INFO_SAVE_ONLY_DIFFERENCE = 'save_only_difference';

    const HTML = 'ffThemeBuilderBlock_HTML';
	const BOOTSTRAP_COLUMNS = 'ffThemeBuilderBlock_BootstrapColumns';
	const BACKGROUNDS = 'ffThemeBuilderBlock_Backgrounds';
	const PADDING_MARGIN = 'ffThemeBuilderBlock_PaddingMargin';
	const BOX_MODEL = 'ffThemeBuilderBlock_BoxModel';
	const COLORS = 'ffThemeBuilderBlock_Colors';
    const ADVANCED_TOOLS = 'ffThemeBuilderBlock_AdvancedTools';
    const CUSTOM_CODES = 'ffThemeBuilderBlock_CustomCodes';
	const LINK = 'ffThemeBuilderBlock_Link';
	const LOOP = 'ffThemeBuilderBlock_Loop';



/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/
	protected $_timesRendered = 0;

	/**
	 * @var ffThemeBuilderBlockManager
	 */
	protected $_blockManager = null;

	/**
	 * @var ffThemeBuilderAssetsRenderer
	 */
	protected $_AssetsRenderer = null;

	/**
	 * @var ffThemeBuilderOptionsExtender
	 */
	protected $_optionsExtender = null;

	/**
	 * @var ffThemeBuilderShortcodesStatusHolder
	 */
	protected $_statusHolder = null;
/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/
    /**
     * Informations - id, wrapping ID and other stuff
     * @var array
     */
    protected $_info = array();

    /**
     * @var params for printing the block
     */
    protected $_param = array();



	protected $_queryHasBeenFilled = true;

    protected $_isEditMode = false;

	protected $_cssClasses = array();


/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
    public function __construct( ffThemeBuilderOptionsExtender $optionsExtender ) {
        $this->_setOptionsExtender( $optionsExtender );
        $this->_init();

    }
/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/
	/*----------------------------------------------------------*/
	/* PARAMS
	/*----------------------------------------------------------*/
    public function setParam( $name, $value ) {
        $this->_param[ $name ] = $value;

        return $this;
    }

    public function getParam( $name, $default = null ) {
        if( isset( $this->_param[ $name ] ) ) {
            return $this->_param[ $name ];
        } else {
            return $default;
        }
    }
/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/
	/**
	 * @param $s ffOneStructure|ffThemeBuilderOptionsExtender
	 */
    public function injectOptions( $s ) {

	    if( !$this->_getIsEditMode() ) {
		    return;
	    }

	    // is reference and are we printing options for editor
	    if( $this->_getInfo( ffThemeBuilderBlock::INFO_IS_REFERENCE_SECTION, false ) && $this->_getIsEditMode() ) {
		    $uniqueHash = $this->_getParamHash();

		    $s->startSection( $this->getWrappingId() )
			    ->addParam('is-block', true)
			    ->addParam('unique-hash',  $uniqueHash )
		    ;
		    $s->endSection();

		    // if the structure does not exists, we have to create it
		    if( !$this->_getBlockManager()->blockOptionsStructureExists( $uniqueHash ) ) {
				$structure= $this->_getOptionsFactory()->createStructure();
				$s2 = $this->_getNewOptionsExtender();
			    $s2->setStructure( $structure );

			    $section = $s2->startSection( $this->getWrappingId() );

			    if( $this->_getInfo( ffThemeBuilderBlock::INFO_SAVE_ONLY_DIFFERENCE, false) ) {
				    $section->addParam('save-only-difference', true);
			    }

			    $this->_injectOptions( $s2 );

			    $s2->endSection();

			    $this->_getBlockManager()->addBlockOptionsStructure( $uniqueHash, $s2->getStructure() );
		    }
	    } else {

		    if( $this->getWrapAutomatically() ) {

			    if( $this->_getInfo( ffThemeBuilderBlock::INFO_IS_REFERENCE_SECTION, false ) ) {
				    $section = $s->startReferenceSection( $this->getWrappingId() );
			    } else {
				    $section =  $s->startSection( $this->getWrappingId() );
			    }

			    if( $this->_getInfo( ffThemeBuilderBlock::INFO_SAVE_ONLY_DIFFERENCE, false) ) {
				    $section->addParam('save-only-difference', true);
			    }
		    }

		    $this->_injectOptions( $s );

		    if( $this->getWrapAutomatically() ) {
			    if( $this->_getInfo( ffThemeBuilderBlock::INFO_IS_REFERENCE_SECTION, false ) ) {
				    $s->endReferenceSection();
			    } else {
				    $s->endSection();
			    }
		    }

	    }
    }


    public function getWrapAutomatically() {
        return $this->_getInfo( ffThemeBuilderBlock::INFO_WRAP_AUTOMATICALLY, true );
    }

    public function getId() {
        return $this->_getInfo( ffThemeBuilderBlock::INFO_ID);
    }

    public function getWrappingId() {
        return $this->_getInfo( ffThemeBuilderBlock::INFO_WRAPPING_ID );
    }

    public function setWrappingId( $wrappingId ) {
        $this->_setInfo( ffThemeBuilderBlock::INFO_WRAPPING_ID, $wrappingId );

	    return $this;
    }

/**********************************************************************************************************************/
/* RENDERING
/**********************************************************************************************************************/
	public function get( ffOptionsQueryDynamic $query ) {
		ob_start();
			$returnFromRendered = $this->render( $query );
			$toReturn = ob_get_contents();
		ob_end_clean();

		if( !empty( $returnFromRendered ) ) {
			return $returnFromRendered;
		} else {
			return $toReturn;
		}
	}

    public function render( ffOptionsQueryDynamic $query ) {
	    $this->_timesRendered++;
        if( $this->getWrapAutomatically() ) {
            $wrappingId = $this->getWrappingId();

			if( $query->queryExists( $wrappingId ) ) {
				return $this->_render( $query->getWithoutCallbacks( $wrappingId ) );
			} else {
				$this->_queryHasBeenFilled = false;
				$rendered = $this->_render( $query );
				$this->_queryHasBeenFilled = true;

				return $rendered;
			}
        } else {
            return $this->_render( $query );
        }
    }

	public function addCssClass( $class ) {
		$this->_cssClasses[] = $class;
	}

	public function reset() {
		$this->_param = array();
		$this->_cssRenderer = null;
		$this->_cssClasses = null;

		$this->_reset();

		return $this;
	}

	public function getJSFunction() {
		return $this->_getJSFunction('_renderContentInfo_JS');
	}




/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/

	protected function _getCssString( $wrapByAttr = false ) {
		if( empty( $this->_cssClasses ) ) {
			return '';
		}

		$classes = implode(' ', $this->_cssClasses );

		if( $wrapByAttr ) {
			$classes = 'class="' . $classes .'"';
		}

		return $classes;
	}

    protected function _setInfo( $name, $value ) {
        $this->_info[ $name ] = $value;
    }

    protected function _getInfo( $name, $default = null ) {
        if( isset( $this->_info[ $name ] ) ) {
            return $this->_info[ $name ];
        } else {
            return $default;
        }
    }

	protected function _queryIsEmpty() {
		return !$this->_queryHasBeenFilled;
	}

	private function _getParamHash() {
		$md5 = '';
		if( !empty( $this->_param ) ) {
			$md5 = md5( $this->getWrappingId() . json_encode( $this->_param ) );
		}

		return $this->getWrappingId() . '-' . $md5;
	}


	/*----------------------------------------------------------*/
	/* RENDER CONTENT
	/*----------------------------------------------------------*/
	protected function _renderContentInfo_JS() {
		?>
		<script data-type="ffscript">
			function ( query ) {

			}
		</script data-type="ffscript">
		<?php
	}

	protected function _getJSFunction( $functionName ) {
		ob_start();
		call_user_func( array( $this, $functionName) );
		$content = ob_get_contents();
		ob_end_clean();

		$content = str_replace('<script data-type="ffscript">', '', $content);
		$content = str_replace('</script data-type="ffscript">', '', $content);

		if( $this->getWrapAutomatically() ) {
			$toReplace = '{ query = query.get("'.$this->getWrappingId().'"); ';
			$content = preg_replace('/\{/', $toReplace, $content, 1 );
		}

		return $content;
	}

	protected function _reset() {

	}

    abstract protected function _injectOptions( ffThemeBuilderOptionsExtender $s );
    abstract protected function _init();

	/**
	 * @param $query ffOptionsQueryDynamic
	 * @return mixed
	 */
    abstract protected function _render( $query );

	protected function _getUniqueCssClass() {
		$class = 'ffb-block-' . $this->getId() . '-' . $this->_getTimesRendered();

		return $class;
	}

/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
	protected function _getBlock( $blockClassName ) {
		$block = $this->_getBlockManager()->getBlock( $blockClassName );
		$block->setAssetsRenderer( $this->_getAssetsRenderer() );
		return $block;
	}


	/**
	 * @return ffThemeBuilderBlockManager
	 */
	private function _getBlockManager() {
		return $this->_blockManager;
	}

	/**
	 * @param ffThemeBuilderBlockManager $blockManager
	 */
	public function setBlockManager($blockManager) {
		$this->_blockManager = $blockManager;
	}



    protected function _setId( $id ) {
        $this->_id = $id;
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
	 * @return boolean
	 */
	private function _getIsEditMode() {
		return $this->_isEditMode;
	}

	/**
	 * @param boolean $isEditMode
	 */
	public function setIsEditMode($isEditMode) {
		$this->_isEditMode = $isEditMode;
	}

	protected function _getOptionsFactory() {
		return ffContainer()->getOptionsFactory();
	}

	/**
	 * @return ffThemeBuilderOptionsExtender
	 */
	protected function _getNewOptionsExtender() {
		return new ffThemeBuilderOptionsExtender();
	}

	/**
	 * @return ffThemeBuilderAssetsRenderer
	 */
	protected function _getAssetsRenderer() {
		return $this->_AssetsRenderer;
	}

	protected function _getTimesRendered() {
		return $this->_timesRendered;
	}

	/**
	 * @param ffThemeBuilderAssetsRenderer $AssetsRenderer
	 */
	public function setAssetsRenderer($AssetsRenderer) {
		$this->_AssetsRenderer = $AssetsRenderer;
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
	public function setStatusHolder($statusHolder) {
		$this->_statusHolder = $statusHolder;
	}




	
}