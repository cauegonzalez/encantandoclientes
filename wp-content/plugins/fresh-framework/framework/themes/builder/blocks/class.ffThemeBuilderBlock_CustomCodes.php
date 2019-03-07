<?php

class ffThemeBuilderBlock_CustomCodes extends ffThemeBuilderBlock {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/
    const PARAM_RETURN_AS_STRING = 'return_as_string';
/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
    protected function _init() {
        $this->_setInfo( ffThemeBuilderBlock::INFO_ID, 'custom-codes');
        $this->_setInfo( ffThemeBuilderBlock::INFO_WRAPPING_ID, 'cc');
        $this->_setInfo( ffThemeBuilderBlock::INFO_WRAP_AUTOMATICALLY, true);
        $this->_setInfo( ffThemeBuilderBlock::INFO_IS_REFERENCE_SECTION, true);
        $this->_setInfo( ffThemeBuilderBlock::INFO_SAVE_ONLY_DIFFERENCE, true);
    }
/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/
    protected function _render( $query ) {

	    if( $this->_queryIsEmpty() ) {
		    return null;
	    }

	    if( $query->queryExists('grp') ) {

		    /**
		     * @var $oneGroup ffOptionsQuery
		     */
	        foreach( $query->get('grp') as $oneGroup ) {
		        $type = $oneGroup->getVariationType();

		        /*----------------------------------------------------------*/
		        /* CSS RULE
		        /*----------------------------------------------------------*/
		        if( $type == 'css' ) {
			        $styles = $oneGroup->getWithoutComparationDefault( 'styles', '');

			        $selector = $oneGroup->getWithoutComparationDefault('slct', '');
			        $cssRule = $this->_getAssetsRenderer()->createCssRule();


			        /**
			         * Media Query Min
			         */
			        $mediaQueryMin = $oneGroup->getWithoutComparationDefault('min', '');

			        if( !empty( $mediaQueryMin ) ) {
				        switch( $mediaQueryMin ) {
					        case 'xs':
									$cssRule->addBreakpointXsMin();
						        break;

					        case 'sm':
									$cssRule->addBreakpointSmMin();
						        break;

					        case 'md':
									$cssRule->addBreakpointMdMin();
						        break;

					        case 'lg':
									$cssRule->addBreakpointLGMin();
						        break;
				        }
			        }

			        /**
			         * Media Query Max
			         */
			        $mediaQueryMax = $oneGroup->getWithoutComparationDefault('max', '');

			        if( !empty( $mediaQueryMax ) ) {
				        switch( $mediaQueryMax ) {
					        case 'xs':
						        $cssRule->addBreakpointXsMax();
						        break;

					        case 'sm':
						        $cssRule->addBreakpointSmMax();
						        break;

					        case 'md':
						        $cssRule->addBreakpointMdMax();
						        break;

//					        case 'lg':
//						        $cssRule->addBreakpointLGMax();
//						        break;
				        }
			        }

			        /**
			         * States
			         */
			        $stateArray = Array();

			        if( $oneGroup->getWithoutComparationDefault('state1', null) != null ) {
				        $stateArray[] = $oneGroup->getWithoutComparationDefault('state1', null);
			        }

			        if( $oneGroup->getWithoutComparationDefault('state2', null) != null ) {
				        $stateArray[] = $oneGroup->getWithoutComparationDefault('state2', null);
			        }

					if( !empty( $stateArray ) ) {
						$state = implode( ':', $stateArray );
						$cssRule->setState( $state );
					}


			        /**
			         * Extra selector, like #someIdBro
			         */
			        if( !empty( $selector ) ){
				        $cssRule->addSelector( $selector );
			        }

			        /**
			         * the style sitself
			         */
			        if( !empty( $styles) ) {
				        $cssRule->addParamsString( $styles );
			        }
		        }
		        /*----------------------------------------------------------*/
		        /* JAVASCRIPT CODE
		        /*----------------------------------------------------------*/
		        else if ($type == 'js' ) {
			        $jsCode = $cssRule = $this->_getAssetsRenderer()->createJavascriptCode();

			        $wrapByAnonymousFn = $oneGroup->getWithoutComparationDefault('wrap-by-anonymous-fn', 1);
			        $wrapByDocumentReady = $oneGroup->getWithoutComparationDefault('wrap-by-document-ready', 1);
			        $code = $oneGroup->getWithoutComparationDefault('javascript', '');

			        $jsCode->setWrapByAnonymousFunction( $wrapByAnonymousFn );
			        $jsCode->setWrapByDocumentReady( $wrapByDocumentReady );
			        $jsCode->setCode( $code );

		        }
	        }
	    }
    }

    protected function _injectOptions( ffThemeBuilderOptionsExtender $s ) {

        $s->addElement( ffOneElement::TYPE_TABLE_START );

            $s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Info');

                $s->addElement(ffOneElement::TYPE_DESCRIPTION,'', 'Here you can add your custom CSS and JS codes. Every element has unique css class, so you can bound your CSS and JS to this class. CSS and JS will be printed at the very bottom of the page');

//                $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ff-insert-unique-id">UNIQUE ID</div>');
                $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ff-insert-unique-css-class">UNIQUE CSS CLASS</div>');
//                $s->addElement(ffOneElement::TYPE_HTML,'', '<input type="text" class="ff-insert-unique-css-selector">');
//
            $s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

            $s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'CSS');


	            $s->startSection('grp', ffOneSection::TYPE_REPEATABLE_VARIABLE )
		            ->addParam('can-be-empty', true)
		            ->addParam('work-as-accordion', true)
		            ->addParam('all-items-opened', true)
	            ;

					/*----------------------------------------------------------*/
					/* CSS
					/*----------------------------------------------------------*/
	                $s->startSection('css', ffOneSection::TYPE_REPEATABLE_VARIATION)
		                ->addParam('section-name', 'Css Group');

	                    $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ff-insert-unique-css-class">UNIQUE CSS CLASS</div>');

	                    $s->addOptionNL( ffOneOption::TYPE_SELECT, 'min', 'Min', '')
		                    ->addSelectValue('', '')
		                    ->addSelectValue('Mobile (xs)', 'xs')
		                    ->addSelectValue('Tablet (sm)', 'sm')
		                    ->addSelectValue('Laptop (md)', 'md')
		                    ->addSelectValue('Desktop (lg)', 'lg')
	                    ;

					    $s->addOptionNL( ffOneOption::TYPE_SELECT, 'max', 'Max', '')
						    ->addSelectValue('', '')
						    ->addSelectValue('Mobile (xs)', 'xs')
						    ->addSelectValue('Tablet (sm)', 'sm')
						    ->addSelectValue('Laptop (md)', 'md')
//						    ->addSelectValue('Desktop (lg)', 'lg')
					    ;

                        $s->addOptionNL( ffOneOption::TYPE_TEXT, 'slct', 'Selector', '');

					    $s->addOptionNL( ffOneOption::TYPE_SELECT, 'state1', 'State 1', '')
						    ->addSelectValue('', '')
						    ->addSelectValue('Active', 'active')
						    ->addSelectValue('Hover', 'hover')
						    ->addSelectValue('Focus', 'focus')
						    ->addSelectValue('Visited', 'visited')
						    ->addSelectValue('Before', 'before')
						    ->addSelectValue('After', 'after')
					    ;

					    $s->addOptionNL( ffOneOption::TYPE_SELECT, 'state2', 'State 2', '')
						    ->addSelectValue('', '')
						    ->addSelectValue('Active', 'active')
						    ->addSelectValue('Hover', 'hover')
						    ->addSelectValue('Focus', 'focus')
						    ->addSelectValue('Visited', 'visited')
						    ->addSelectValue('Before', 'before')
						    ->addSelectValue('After', 'after')
					    ;

					    $s->addOptionNL(ffOneOption::TYPE_TEXTAREA, 'styles', 'Styles', '');

	                $s->endSection();

	                /*----------------------------------------------------------*/
	                /* JS
	                /*----------------------------------------------------------*/
				    $s->startSection('js', ffOneSection::TYPE_REPEATABLE_VARIATION)
					    ->addParam('section-name', 'JavaScript Group');

					    $s->addElement(ffOneElement::TYPE_HTML,'', '<div class="ff-insert-unique-css-class">UNIQUE CSS CLASS</div>');

	                    $s->addOptionNL(ffOneOption::TYPE_CHECKBOX, 'wrap-by-anonymous-fn', 'Wrap by anonymous function with $ as jQuery Param', 1);

	                    $text = 'In WordPress, jQuery is in no-conflict mode, so you cant use the $ sign, but only the jQuery Sign. ';
	                    $text .= 'This could be avoided, if we wrap your code with anonymous function, where we set the $ as a parameter, so it will look like this : ';
	                    $text .= '(function($){ YOUR CODE })(jQuery);';
	                    $s->addElement(ffOneElement::TYPE_DESCRIPTION,'', $text);

					    $s->addOptionNL(ffOneOption::TYPE_CHECKBOX, 'wrap-by-document-ready', 'Wrap by $(document).ready(function(){});', 1);

					    $text = '';
					    $text .= '<strong>any string "!selector!" (not with the quotes) will be replaced with <span class="ff-insert-unique-css-class"></span> when printing code</strong>';
					    $text .= '<br>So you can use $(\'!selector!\') in your codes';
					    $s->addElement(ffOneElement::TYPE_DESCRIPTION,'', $text);

					    $s->addOptionNL(ffOneOption::TYPE_TEXTAREA, 'javascript', 'Scripts', '');

				    $s->endSection();


	            $s->endSection();

            $s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

        $s->addElement( ffOneElement::TYPE_TABLE_END );
    }
/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
}