<?php

abstract class ffThemeBuilderElementBasic extends ffThemeBuilderElement {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/
    /**
     * List of other potential tabs
     * @var array
     */
    protected $_tabs = array();


/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/
    /*----------------------------------------------------------*/
    /* DROPZONES
    /*----------------------------------------------------------*/
    protected function _addDropzoneBlacklistedElement( $elementId ) {
        $this->_dropzoneElementBlacklist[] = $elementId;
    }

    protected function _addDropzoneWhitelistedElement( $elementId ) {
        $this->_dropzoneElementWhitelist[] = $elementId;
    }

	protected function _addParentWhitelistedElement( $elementId ) {
		$this->_parentElementWhitelist[] = $elementId;
	}

    protected function _getBlacklistedElements() {
        $toReturn = null;
        if( !empty( $this->_dropzoneElementBlacklist ) ) {
            $toReturn = htmlspecialchars(json_encode($this->_dropzoneElementBlacklist));
        }

        return $toReturn;
    }

    protected function _getWhitelistedElements() {
        $toReturn = null;
        if( !empty( $this->_dropzoneElementWhitelist ) ) {
            $toReturn = htmlspecialchars(json_encode($this->_dropzoneElementWhitelist));
        }

        return $toReturn;
    }

/**********************************************************************************************************************/
/* RENDER ADMIN
/**********************************************************************************************************************/
    protected function _renderAdmin_getClasses( ffMultiAttrHelper $multiAttrHelper ) {
        $hasDropzone = $this->_getData( ffThemeBuilderElement::DATA_HAS_DROPZONE, false);
        $multiAttrHelper->addParam('class', 'ffb-element');
        $multiAttrHelper->addParam('class', 'ffb-element-'. $this->getID() );
        if( $hasDropzone ) {
            $multiAttrHelper->addParam('class', 'ffb-element-dropzone-yes');
        } else {
            $multiAttrHelper->addParam('class', 'ffb-element-dropzone-no');
        }
    }

    protected function _renderAdmin_getParams( ffMultiAttrHelper $multiAttrHelper, ffOptionsQueryDynamic $query, $content, $data, $uniqueId ) {
        $dataCoded = htmlspecialchars(json_encode( $data ));
        $multiAttrHelper->setParam('data-options', $dataCoded);
        $multiAttrHelper->setParam('data-element-id', $this->getID());
        $multiAttrHelper->setParam('data-unique-id', $uniqueId);

        $blacklistedElements = $this->_getBlacklistedElements();
        $whitelistedElements = $this->_getWhitelistedElements();

        if( $blacklistedElements != null ) {
            $multiAttrHelper->setParam('data-dropzone-mode', 'blacklist');
            $multiAttrHelper->setParam('data-dropzone-list', $blacklistedElements);
        } else if( $whitelistedElements != null ) {
            $multiAttrHelper->setParam('data-dropzone-mode', 'whitelist');
            $multiAttrHelper->setParam('data-dropzone-list', $whitelistedElements);
        }

    }

    protected function _renderAdmin( ffOptionsQueryDynamic $query, $content, $data, $uniqueId ) {
        $name = $this->_getData( ffThemeBuilderElement::DATA_NAME);
        $multiAttrHelper = ffContainer()->getMultiAttrHelper();

        $this->_renderAdmin_getClasses( $multiAttrHelper );
        $this->_renderAdmin_getParams( $multiAttrHelper, $query, $content, $data, $uniqueId );

        $otherData = new ffStdClass();
        $otherData->uniqueId = $uniqueId;
        $this->_beforeRenderingAdminWrapper( $query, $content, $multiAttrHelper, $otherData );

        $hasDropzone = $this->_getData( ffThemeBuilderElement::DATA_HAS_DROPZONE, false);

        echo '<div ' . $multiAttrHelper->getAttrString() . '>';
            echo '<div class="ffb-header clearfix">';
                echo '<div class="ffb-header__button ffb-header__button-left action-toggle-collapse"></div>';
                echo '<div class="ffb-header__button ffb-header__button-left action-column-smaller" data-ffb-tooltip="Make Narrower"></div>';
                echo '<div class="ffb-header__button ffb-header__button-left action-column-bigger" data-ffb-tooltip="Make Wider"></div>';
                echo '<a class="ffb-header-name" title="'.$name.'">'.$name.'</a>';
                echo '<div class="ffb-header__button ffb-header__button-right action-toggle-context-menu" data-ffb-tooltip="Actions"></div>';
                echo '<div class="ffb-header__button ffb-header__button-right action-edit-element" data-ffb-tooltip="Edit Element"></div>';
                if( !$hasDropzone ) {
                    echo '<div class="ffb-header__button ffb-header__button-right action-preview-element">';
                        echo '<div class="ffb-header__button-preview-content">';
                            echo '<img src="'; echo ffContainer()->getWPLayer()->getFrameworkUrl(); echo '/framework/themes/builder/metaBoxThemeBuilder/assets/images/element-preview-example.jpg">';
                        echo '</div>';
                    echo '</div>';
                }
                if( $hasDropzone ) {
                    echo '<div class="ffb-header__button ffb-header__button-right action-add-element" data-ffb-tooltip="Insert Element"></div>';
                }
            echo '</div>';
            echo '<div class="ffb-element-preview action-edit-element">';

            echo '</div>';
            if( $hasDropzone ) {
                echo '<div class="ffb-dropzone ffb-dropzone-'.$this->getID().' clearfix">';
                echo $this->_doShortcode($content);
                echo '</div>';
            }
        echo '</div>';
    }

	/*----------------------------------------------------------*/
	/* RENDER CONTENT
	/*----------------------------------------------------------*/
    protected function _renderContentInfo_JS() {
        ?>
            <script data-type="ffscript">
                function ( query, options, $elementInfo, $element ) {

                }
            </script data-type="ffscript">
        <?php
    }


    /**
     * get the options structure (Basic options, the default ones)
     * @return ffOneStructure
     */
    public function getElementOptionsStructure() {
        if( $this->_elementOptionsStructure == null ) {
            $structure = $this->_getOptionsFactory()->createStructure();
            $s = $this->_getOptionsExtender();

            $s->setStructure( $structure );

            $s->startSection('o');

	            $s->startTabs();

	                $s->startSection('gen');

	                    $s->startTab('General', true);
                            $this->_getElementGeneralOptions($s);
	                    $s->endTab();

				        foreach( $this->_tabs as $oneTab ) {
					        $s->startTab( $oneTab->name );
					        call_user_func( $oneTab->callback, $s );
					        $s->endTab();
				        }



	                $s->endSection();

			        $s->startTab( 'Box Model');
			            $this->_getBlock( ffThemeBuilderBlock::BOX_MODEL )->injectOptions( $s );
			        $s->endTab();

                    $s->startTab( 'Colors');
                        $this->_getBlock( ffThemeBuilderBlock::COLORS )->injectOptions( $s );
                    $s->endTab();

	                $s->startTab( 'Extras');
                        $this->_getBlock( ffThemeBuilderBlock::ADVANCED_TOOLS )->injectOptions( $s );
	                $s->endTab();

	                $s->startTab('Custom Code');
                        $this->_getBlock( ffThemeBuilderBlock::CUSTOM_CODES )->injectOptions( $s );
	                $s->endTab();

	            $s->endTabs();

            $s->endSection();

            $this->_elementOptionsStructure = $s->getStructure();
        }

        return $this->_elementOptionsStructure;
    }



/**********************************************************************************************************************/
/* QUERY PART
/**********************************************************************************************************************/
    /**
     * When iterating trough repeatable, here we catch system repeatable items
     * @param ffOptionsQueryDynamic $query
     * @return bool;
     */
    public function queryIteratorValidation( $query, $key ) {

        $variation = $query->getVariationType();
        if( $variation == 'html' ) {
            $this->_getBlock(ffThemeBuilderBlock::HTML)->render($query);
	        return false;
        }
        return true;
    }

	private $_queryLevel = 0;

	private $_counters = array();

	/**
	 * @param $query ffOptionsQueryDynamic
	 */
	public function queryIteratorBeginning( $query ) {
		$this->_queryLevel++;
	}

	public function queryIteratorEnding( $query ) {
		$this->_queryLevel--;
	}

	/**
	 * @param $query ffOptionsQueryDynamic
	 * @param $key
	 */
	protected function _getRepeatableVariationSelector( $query, $key ) {
		$level = $this->_queryLevel;
		$this->_counters[ $level ] = $key + 1;

		foreach( $this->_counters as $key => $value ) {
			if( $key > $level ) {
				unset( $this->_counters[ $key ]);
			}
		}

		$potentialClass = implode('-', $this->_counters);
		return 'ffb-'.$query->getVariationType() . '-' . $potentialClass;
	}


	private $_storedSelectors = array();
    /**
     * It's called before every options query iteration
     * @param $query ffOptionsQueryDynamic
     */
    public function queryIteratorStart( $query, $key ) {
	    $this->_variationCounter++;

	    $repeatableVariationCssSelector = $this->_getRepeatableVariationSelector( $query, $key );
	    $this->_storeSelector( $repeatableVariationCssSelector );

	    // SET TEXT COLOR INHERITANCE
	    $textColor = $this->_getBlock( ffThemeBuilderBlock::COLORS)->returnOnlyTextColor()->get( $query );
	    if( !empty($textColor) ) {
		    $this->_getStatusHolder()->addTextColorToStack( $textColor );
	    }

	    $this->_getAssetsRenderer()->addSelectorToCascade( $repeatableVariationCssSelector );
		
        ob_start();
    }
    /**
     * It's called after every options query iteration
     * @param $query ffOptionsQueryDynamic
     */
    public function queryIteratorEnd( $query, $key ) {
	    $content = ob_get_contents();
	    ob_end_clean();

	    $repeatableVariationCssSelector = $this->_getSelectorFromStorage();
	    $helper = $this->_getAssetsRenderer()->getElementHelper();
	    $helper->parse( $content );

	    $this->_getBlock( ffThemeBuilderBlock::BOX_MODEL)->get( $query );
	    $this->_getBlock(ffThemeBuilderBlock::ADVANCED_TOOLS)->get( $query );
	    $this->_getBlock( ffThemeBuilderBlock::CUSTOM_CODES)->render( $query );
	    $this->_getBlock( ffThemeBuilderBlock::COLORS)->get( $query );

	    $helper->addAttribute('class', $repeatableVariationCssSelector );

	    // SET TEXT COLOR INHERITANCE
	    $textColor = $this->_getBlock( ffThemeBuilderBlock::COLORS)->returnOnlyTextColor()->get( $query );
	    if( !empty($textColor) ) {
		    $this->_getStatusHolder()->removeTextColorFromStack( $textColor );
	    }


	    $helper->render();


	    $this->_getAssetsRenderer()->removeSelectorFromCascade();
    }



	protected function _storeSelector( $selector ) {
		$this->_storedSelectors[] = $selector;
	}

	protected function _getSelectorFromStorage() {
		return array_pop( $this->_storedSelectors );
	}

/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
	protected function _addTab( $name, $callbackFunction, $position = null ) {
		$newTab = new ffStdClass();
		$newTab->name = $name;
		$newTab->callback = $callbackFunction;

		$this->_tabs[] = $newTab;
	}
}