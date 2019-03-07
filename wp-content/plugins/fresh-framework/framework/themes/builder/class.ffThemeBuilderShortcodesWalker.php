<?php

class ffThemeBuilderShortcodesWalker extends ffBasicObject {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/
    /**
     * @var ffThemeBuilderElementManager
     */
    private $_themeBuilderElementManager = null;

    /**
     * @var ffWPLayer
     */
    private $_WPLayer = null;

/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/
    private $_isEditMode = false;

	private $_isCachingMode = false;

    private $_shortcodesRegistered = false;

    private $_contentParams = array();

    private $_renderedCss = '';

	private $_renderedJs = '';

	private $_usedTags = null;

	private $_regex = null;

	private $_noncacheableElements = null;

	private $_shortcodeDataFilter = null;

/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/

    public function __construct( ffThemeBuilderElementManager $themeBuilderElementManager ) {
        $this->_setThemeBuilderElementManager( $themeBuilderElementManager );
        $this->_setWPLayer( ffContainer()->getWPLayer() );
    }

/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/
	public function render( $content ) {
		echo $this->get( $content );
	}

	public function get( $content ) {
		$this->_reset();
		return $this->doShortcode( $content );
	}

/**********************************************************************************************************************/
/* SHORTCODES BRO
/**********************************************************************************************************************/
	/**
	 * Main shortcodes function
	 * @param $content
	 * @return mixed
	 */
	public function doShortcode( $content ) {
//		$usedTags = $this->_getUsedTags();
//		$shortcodeRegex = $this->_getRegex();
//
//		if( $usedTags == null ) {
			// TODO rozpoznat content blocks
			$usedTags  = $this->_findUsedTags( $content );
			$this->_setUsedTags( $usedTags );

			$shortcodeRegex = $this->_getShortcodeRegexp( $usedTags );
			$this->_setRegex( $shortcodeRegex );

//		}

		$content = preg_replace_callback( "/$shortcodeRegex/", array($this,'_ourShortcodeCalback'), $content );
		return $content;
	}

	private function _getShortcodeRegexp( $tagNames ) {

		$tagregexp = join( '|', array_map('preg_quote', $tagNames) );

		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
			'\\['                              // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			.     '(?:'
			.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
			.     ')*?'
			. ')'
			. '(?:'
			.     '(\\/)'                        // 4: Self closing tag ...
			.     '\\]'                          // ... and closing bracket
			. '|'
			.     '\\]'                          // Closing bracket
			.     '(?:'
			.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			.             '[^\\[]*+'             // Not an opening bracket
			.             '(?:'
			.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			.                 '[^\\[]*+'         // Not an opening bracket
			.             ')*+'
			.         ')'
			.         '\\[\\/\\2\\]'             // Closing shortcode tag
			.     ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}

	/**
	 * Parse shortcodes - function directly from wordpress core
	 * @param $m
	 * @return mixed|string
	 */
	private function _ourShortcodeCalback( $m ) {

		if ( $m[1] == '[' && $m[6] == ']' ) {
			return substr($m[0], 1, -1);
		}

		$tag = $m[2];
		$atts = shortcode_parse_atts( $m[3] );
		$content = null;
		if( isset( $m[5] ) ) {
			$content = $m[5];
		}
		return call_user_func( array($this, 'shortcodesCallback'), $atts, $content, $tag, $m[0] );
	}

	/**
	 * Function which handle parsed shortcode
	 * @param $atts
	 * @param $content
	 * @param $shortcodeNameWithDepth
	 * @return string|void
	 */
	public function shortcodesCallback( $atts, $content, $shortcodeNameWithDepth, $originalCode ) {
		if( $shortcodeNameWithDepth == 'ffb_param' ) {
			return $this->getContentsParamCallback( $atts, $content, $shortcodeNameWithDepth, $originalCode );
		} else {
			return $this->_printShortcode( $atts, $content, $shortcodeNameWithDepth, $originalCode );
		}
	}

	/**
	 * Find which shortcode tags are used, which starts with ffb_
	 * @param $content
	 * @return array
	 */
	private function _findUsedTags( $content ) {
		preg_match_all( '@\[([^<>&/\[\]\x00-\x20]++)@', $content, $allTags );

//		$nonCacheableElements = array();

//		if( $this->_getIsCachingMode() ) {
//			$nonCacheableElements = $this->_getThemeBuilderElementManager()->getNonCacheableElements();
//		}

		$allowedTagsKeys = array();
		if( !empty( $allTags ) ) {
			foreach( $allTags[1] as $oneTagName ) {
				$firstLetters = substr( $oneTagName, 0, 4 );

				if( $firstLetters == 'ffb_' ) {
					$allowedTagsKeys[ $oneTagName ] = true;
				}
			}
		}
		$allowedTags = array_keys( $allowedTagsKeys );

		return $allowedTags;
	}

	/**
	 * Its backend / front end
	 * @param $value
	 */
    public function setIsEditMode( $value ) {
        $this->_isEditMode = $value;
        $this->_getThemeBuilderElementManager()->setIsEditMode( $value );
    }

	/**
	 * Content params are stored here
	 * @param $atts
	 * @param $content
	 * @param $shortcodeName
	 */
    public function getContentsParamCallback( $atts, $content, $shortcodeName ) {
        $route = $atts['route'];
        $this->_contentParams[ $route ] = $content;
    }

	/**
	 * Extract shortocde name from ffb_section_0 to "section"
	 * @param $shortcodeNameWithDepth
	 * @return string
	 */
    private function _getOriginalShortcodeName( $shortcodeNameWithDepth ) {
        $lastStr = strrpos( $shortcodeNameWithDepth, '_');
        $shortcodeName = substr($shortcodeNameWithDepth, 0, $lastStr );
        return $shortcodeName;
    }

	/**
	 * Extract shortcode depth from ffb_section_5 to "5"
	 * @param $shortcodeNameWithDepth
	 * @return string
	 */
    private function _getShortcodeDepth( $shortcodeNameWithDepth ) {
        $lastStr = strrpos( $shortcodeNameWithDepth, '_');
        $strLen = strlen( $shortcodeNameWithDepth );
        $shortcodeDepth = substr( $shortcodeNameWithDepth, $lastStr + 1, $strLen - $lastStr );

        return $shortcodeDepth;
    }


	private function _printShortcode( $atts, $content, $shortcodeNameWithDepth, $originalShortcodeContent ){
		$shortcodeName = $this->_getOriginalShortcodeName( $shortcodeNameWithDepth );
		$elementId = $this->_getElementIdFromShortcodeName( $shortcodeName );

		if( !$this->_canBeElementCached( $elementId, $atts ) ) {
			return $originalShortcodeContent;
		}


		$data = null;

		if( isset( $atts['data'] ) ) {
			$data = $this->_decodeDataAttrFromShortcode( $atts['data'] );
		}

		$uniqueId = null;
		if( isset( $atts['unique_id'] ) ) {
			$uniqueId = $atts['unique_id'];
		} else {
			$uniqueId = rand();
		}

		$element = $this->_getThemeBuilderElementManager()->getElementById( $elementId );

		if( $element != null ) {
			$element->setDoShortcodeCallback( array( $this, 'doShortcode') );
		}

		$this->_contentParams = null;
		if( $element->hasContentParams() ) {
			$this->_contentParams = array();
			$this->doShortcode( $content );
		}

		if( $this->_getIsCachingMode() ) {
			$element->setIsCachingMode( true );
		}

		if( $data == null ) {
			$data = $element->getElementOptionsData();
		}

		if( $this->_getShortcodeDataFilter() != null ) {
			$data = call_user_func( $this->_getShortcodeDataFilter(), $data, $elementId );
		}

		$result = $element->render( $data, $content, $uniqueId, $this->_contentParams );
		$css = $element->getAssetsRenderer()->getCssAsString();
		$js = $element->getAssetsRenderer()->getJavascriptAsString();

		$this->_addRenderedCss( $css );
		$this->_addRenderedJs( $js );

		$element->getAssetsRenderer()->reset();

		if( $this->_getIsCachingMode() ) {
			$element->setIsCachingMode( false );
		}

		return $result;
	}

    private function _decodeDataAttrFromShortcode( $data ) {
        $data = urldecode( $data );

        return json_decode($data, true);
    }

    public function registerShortcodes() {
	    throw new ffException('Dont use this yet');
        return $this->_registerShortcodes();
    }

/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/
	private function _reset() {
		$this->_setUsedTags( null );
		$this->_setRegex( null );
		$this->_renderedCss = null;
	}

	/**
	 * Register shortcodes in wordpress
	 * @return bool
	 */
    private function _registerShortcodes() {
        if( $this->_shortcodesRegistered == true ) {
            return false;
        }

        $shortcodesId = $this->_getThemeBuilderElementManager()->getAllElementsIds();
        $WPLayer = $this->_getWPLayer();

        foreach( $shortcodesId as $oneId ) {
            $shortcodeName = $this->_getShortcodeNameFromElementId( $oneId );

            $WPLayer->add_shortcode( $shortcodeName, array( $this, 'shortcodesCallback' ) );

            for( $i = 0; $i < 10; $i++ ) {
                $WPLayer->add_shortcode( $shortcodeName.'_'.$i, array( $this, 'shortcodesCallback' ) );
            }
        }

        $WPLayer->add_shortcode('ffb_param', array( $this, 'getContentsParamCallback'));
    }

    private function _renderEditor( $content ) {

    }

    private function _getShortcodeNameFromElementId( $elementId ) {
        return 'ffb_' . $elementId;
    }

    private function _getElementIdFromShortcodeName( $elementId ) {
        return str_replace( 'ffb_', '', $elementId );
    }

/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
	private function _canBeElementCached( $elementId, $elementAtts ) {
		if( $this->_getIsCachingMode() == false ) {
			return true;
		}

		if( isset( $elementAtts['data'] ) && strpos( $elementAtts['data'], 'use-as-php') !== false ) {
			return false;
		}
//		if( strpos( $elementAtts))

		if( in_array( $elementId, $this->_getNoncacheableElements() ) ) {
			return false;
		} else {
			return true;
		}
	}


	private function _getNoncacheableElements() {
		if( $this->_noncacheableElements == null ) {
			$this->_noncacheableElements = $this->_getThemeBuilderElementManager()->getNonCacheableElements();
		}

		return $this->_noncacheableElements;
	}

    /**
     * @return ffThemeBuilderElementManager
     */
    private function _getThemeBuilderElementManager()
    {
        return $this->_themeBuilderElementManager;
    }

    /**
     * @param ffThemeBuilderElementManager $themeBuilderElementManager
     */
    private function _setThemeBuilderElementManager($themeBuilderElementManager)
    {
        $this->_themeBuilderElementManager = $themeBuilderElementManager;
    }

    /**
     * @return ffWPLayer
     */
    private function _getWPLayer()
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
	 * @return null
	 */
	private function _getUsedTags() {
		return $this->_usedTags;
	}

	/**
	 * @param null $usedTags
	 */
	private function _setUsedTags($usedTags) {
		$this->_usedTags = $usedTags;
	}

	/**
	 * @return null
	 */
	private function _getRegex() {
		return $this->_regex;
	}

	/**
	 * @param null $regex
	 */
	private function _setRegex($regex) {
		$this->_regex = $regex;
	}

	private function _addRenderedCss( $css ) {
		if( !empty( $css ) ) {
			$this->_renderedCss .= PHP_EOL;
			$this->_renderedCss .= $css;
		}
	}

	private function _addRenderedJs( $js ) {
		if( !empty( $js ) ) {
			$this->_renderedJs .= PHP_EOL;
			$this->_renderedJs .= $js;
		}
	}

	public function getRenderedCss() {
		return $this->_renderedCss;
	}

	public function getRenderedJs() {
		return $this->_renderedJs;
	}

	/**
	 * @return boolean
	 */
	private function _getIsCachingMode() {
		return $this->_isCachingMode;
	}

	private function _getStatusHolder() {
		return $this->_getThemeBuilderElementManager()->getStatusHolder();
	}

	/**
	 * @param boolean $isCachingMode
	 */
	public function setIsCachingMode($isCachingMode) {
		$this->_isCachingMode = $isCachingMode;
		return $this;
	}

	public function setShortcodeDataFilter( $callback ) {
		$this->_shortcodeDataFilter = $callback;
	}

	private function _getShortcodeDataFilter() {
		return $this->_shortcodeDataFilter;
	}
}