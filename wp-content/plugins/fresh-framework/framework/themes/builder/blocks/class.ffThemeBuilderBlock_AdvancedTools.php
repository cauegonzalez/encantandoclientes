<?php

class ffThemeBuilderBlock_AdvancedTools extends ffThemeBuilderBlock {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/
	const PARAM_RETURN_AS_STRING = 'return_as_string';
	const PARAM_WRAP_BY_MODAL = 'wrap_by_modal';
	const PARAM_CSS_CLASS = 'css_class';
	const PARAM_ATTRIBUTE ='attribute';
/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/
	protected $_attributes = array();
/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
	protected function _init() {
		$this->_setInfo( ffThemeBuilderBlock::INFO_ID, 'advanced-tools');
		$this->_setInfo( ffThemeBuilderBlock::INFO_WRAPPING_ID, 'a-t');
		$this->_setInfo( ffThemeBuilderBlock::INFO_WRAP_AUTOMATICALLY, true);
		$this->_setInfo( ffThemeBuilderBlock::INFO_IS_REFERENCE_SECTION, true);
		$this->_setInfo( ffThemeBuilderBlock::INFO_SAVE_ONLY_DIFFERENCE, true);
	}
/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/
	public function wrapByModal() {
		$this->setParam( ffThemeBuilderBlock_AdvancedTools::PARAM_WRAP_BY_MODAL, true );
		return $this;
	}

/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/
	protected function _reset() {
		$this->_attributes = array();
	}

	protected function _setInlineAttributes( $options, $query ) {

		$element = $this->_getAssetsRenderer()->getElementHelper();


		foreach ($options as $oneOption) {
			$value = $query->getWithoutComparationDefault($oneOption, '');

			if (!empty($value)) {
				$style = $oneOption . ':' . $value . '; ';
				$element->addAttribute('style', $style);
			}
		}
	}

	protected function _render( $query ) {
		$element = $this->_getAssetsRenderer()->getElementHelper();

		/*----------------------------------------------------------*/
		/* ID
		/*----------------------------------------------------------*/
		$id = $query->getWithoutComparationDefault('id', '');

		if( !empty( $id ) ) {
			$element->setAttribute('id', $id );
		}

		/*----------------------------------------------------------*/
		/* CLASS
		/*----------------------------------------------------------*/
		$id = $query->getWithoutComparationDefault('cls', '');

		if( !empty( $id ) ) {
			$element->addAttribute('class', $id );
		}

		/*----------------------------------------------------------*/
		/* TYPOGRAPHY
		/*----------------------------------------------------------*/
		if( $query->exists('typography') ) {
			$subQuery = $query->get('typography');

			$options = array();

			$options[] = 'font-size';
			$options[] = 'line-height';
			$options[] = 'font-weight';
			$options[] = 'font-style';
			$options[] = 'font-family';
			$options[] = 'text-align';
			$options[] = 'text-decoration';

			$this->_setInlineAttributes( $options, $subQuery );
		}


		/*----------------------------------------------------------*/
		/* ELEMENT
		/*----------------------------------------------------------*/
		if( $query->exists('element') ) {
			$subQuery = $query->get('element');

			$options = array();

			$options[] = 'display';
			$options[] = 'opacity';
			$options[] = 'float';
			$options[] = 'overflow';
			$options[] = 'overflow-x';
			$options[] = 'overflow-y';
			$options[] = 'z-index';

			$this->_setInlineAttributes( $options, $subQuery );
		}

		/*----------------------------------------------------------*/
		/* POSITION
		/*----------------------------------------------------------*/
		if( $query->exists('position') ) {
			$subQuery = $query->get('position');

			$options = array();

			$options[] = 'position';
			$options[] = 'top';
			$options[] = 'right';
			$options[] = 'bottom';
			$options[] = 'left';
			
			$this->_setInlineAttributes( $options, $subQuery );
		}


		/*----------------------------------------------------------*/
		/* SIZE
		/*----------------------------------------------------------*/
		if( $query->exists('size') ) {
			$subQuery = $query->get('size');

			$options = array();

			$options[] = 'width';
			$options[] = 'height';
			$options[] = 'min-width';
			$options[] = 'min-height';
			$options[] = 'max-width';
			$options[] = 'max-height';

			$this->_setInlineAttributes( $options, $subQuery );
		}

		/*----------------------------------------------------------*/
		/* CUSTOM STYLE
		/*----------------------------------------------------------*/
		if( $query->exists('custom-style') ) {
			$element->addAttribute('style', $query->get('custom-style') );
		}

		/*----------------------------------------------------------*/
		/* CUSTOM ATTRIBUTTES
		/*----------------------------------------------------------*/
		if( $query->exists('custom-attr') ) {
			$element->addStringAtEnd( $query->get('custom-attr') );
		}
	}




	protected function _renderContentInfo_JS() {
		?>
		<script data-type="ffscript">
			function ( query ) {
				console.log('advancedToolsBlock');
			}
		</script data-type="ffscript">
		<?php
	}


	protected function _injectOptions( ffThemeBuilderOptionsExtender $s ) {

		$wrapByModal = $this->getParam( ffThemeBuilderBlock_AdvancedTools::PARAM_WRAP_BY_MODAL, false );

		if( $wrapByModal ) {
			$s->startModal(  'Advanced Options', 'ff-advanced-options' );
		}

		$s->addElement( ffOneElement::TYPE_TABLE_START );

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Info');

				$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', 'This is advanced options tab. These settings will be printed as inline settings on first the wrapper, where they are applied');

			//    $s->addOption(ffOneOption::TYPE_TEXT,'advanced-tools', 'Advanced Tools', 'ssss');
			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Identification');
				$s->addOptionNL( ffOneOption::TYPE_TEXT, 'id', '', '')
					->addParam( ffOneOption::PARAM_TITLE_AFTER, 'ID (attribute)');
				$s->addOptionNL( ffOneOption::TYPE_TEXT, 'cls', '', '')
					->addParam( ffOneOption::PARAM_TITLE_AFTER, 'CSS class');
			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Typography');
				$s->startSection('typography');

					$s->addOptionNL(ffOneOption::TYPE_TEXT, 'font-size', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'font-size');

					$s->addOptionNL(ffOneOption::TYPE_TEXT, 'line-height', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'line-height');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'font-weight', '', '')
						->addSelectValue('', '')
						->addSelectValue('normal', 'normal')
						->addSelectValue('bold', 'bold')
						->addSelectNumberRange(100, 900, 100)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'font-weight');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'font-style', '', '')
						->addSelectValue('', '')
						->addSelectValue('normal', 'normal')
						->addSelectValue('italic', 'italic')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'font-style');

					$s->addOptionNL(ffOneOption::TYPE_TEXT, 'font-family', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'font-family');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'text-align', '', '')
						->addSelectValue('', '')
						->addSelectValue('center', 'center')
						->addSelectValue('left', 'left')
						->addSelectValue('right', 'right')
						->addSelectValue('justify', 'justify')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'text-align');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'text-decoration', '', '')
						->addSelectValue('', '')
						->addSelectValue('none', 'none')
						->addSelectValue('underline', 'underline')
						->addSelectValue('overline', 'overline')
						->addSelectValue('line-through', 'line-through')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'text-decoration');

				$s->endSection();
			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Element');

				$s->startSection('element');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'display', '', '')
						->addSelectValue('', '')
						->addSelectValue('none', 'none')
						->addSelectValue('block', 'block')
						->addSelectValue('inline-block', 'inline-block')
						->addSelectValue('inline', 'inline')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'display');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'opacity', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'opacity');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'float', '', '')
						->addSelectValue('', '')
						->addSelectValue('none', 'none')
						->addSelectValue('left', 'left')
						->addSelectValue('right', 'right')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'float');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'overflow', '', '')
						->addSelectValue('', '')
						->addSelectValue('hidden', 'hidden')
						->addSelectValue('scroll', 'scroll')
						->addSelectValue('visible', 'visible')
						->addSelectValue('auto', 'auto')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'overflow');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'overflow-x', '', '')
						->addSelectValue('', '')
						->addSelectValue('hidden', 'hidden')
						->addSelectValue('scroll', 'scroll')
						->addSelectValue('visible', 'visible')
						->addSelectValue('auto', 'auto')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'overflow-x');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'overflow-y', '', '')
						->addSelectValue('', '')
						->addSelectValue('hidden', 'hidden')
						->addSelectValue('scroll', 'scroll')
						->addSelectValue('visible', 'visible')
						->addSelectValue('auto', 'auto')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'overflow-y');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'z-index', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'z-index');

				$s->endSection();

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Position');

				$s->startSection('position');

					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'position', '', '')
						->addSelectValue('', '')
						->addSelectValue('relative', 'relative')
						->addSelectValue('absolute', 'absolute')
						->addSelectValue('fixed', 'fixed')
						->addSelectValue('inline', 'inline')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'position');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'top', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'top');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'right', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'right');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'bottom', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'bottom');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'left', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'left');

				$s->endSection();

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Size');

				$s->startSection('size');
	
					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'width', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'width');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'height', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'height');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'min-width', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'min-width');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'min-height', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'min-height');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'max-with', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'max-width');

					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'max-height', '', '')
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'max-height');

				$s->endSection();

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Custom Style');

				$s->addOptionNL( ffOneOption::TYPE_TEXTAREA, 'custom-style', '', '');
				$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', 'Example: <code>transition: 1s all ease; transition-duration: 1s; word-wrap: break-word;</code>');

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Custom HTML Attributes');

				$s->addOptionNL( ffOneOption::TYPE_TEXTAREA, 'custom-attr', '', '');
				$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', 'Example: <code>data-my-color="green" data-my-name="Tay" onfocus="myFunction()"</code>');

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

		$s->addElement( ffOneElement::TYPE_TABLE_END );

		if( $wrapByModal ) {
			$s->endModal();
		}

	}

/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
}