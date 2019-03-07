<?php

class ffThemeBuilderBlock_Colors extends ffThemeBuilderBlock {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/
	private $_returnOnlyTextColor = false;
/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
	protected function _init() {
		$this->_setInfo( ffThemeBuilderBlock::INFO_ID, 'colors');
		$this->_setInfo( ffThemeBuilderBlock::INFO_WRAPPING_ID, 'clrs');
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
	public function returnOnlyTextColor() {
		$this->_returnOnlyTextColor = true;

		return $this;
	}
/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/

	protected function _render( $query ) {

		if( $this->_returnOnlyTextColor ) {
			$this->_returnOnlyTextColor = false;

			return $query->getWithoutComparationDefault('color-type', '');
		}

		$textColor = $query->getWithoutComparationDefault('color-type', '');

		if( empty( $textColor ) ) {
			$textColor = $this->_getStatusHolder()->getCurrentTextColor();
		}

		$textColor = apply_filters('ffb-text-color', $textColor);

		if( !empty( $textColor ) ) {
			$this->_getAssetsRenderer()->getElementHelper()->addAttribute('class', $textColor );
		}


	}

	protected function _injectOptions( ffThemeBuilderOptionsExtender $s ) {

		$s->addElement( ffOneElement::TYPE_TABLE_START );

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Text Color Palette');
				$s->addOptionNL( ffOneOption::TYPE_SELECT, 'color-type', '', '')
					->addSelectValue('Inherit', '')
					->addSelectValue('Dark', 'fg-text-dark')
					->addSelectValue('Light', 'fg-text-light')
				;

				$s->addOptionNL( ffOneOption::TYPE_COLOR_PICKER_WITH_LIB, 'test-color', 'Testovaci Color Lib Kurvo');

				$s->addOptionNL( ffOneOption::TYPE_SELECT, 'asds', '', '');

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

		$s->addElement( ffOneElement::TYPE_TABLE_END );


	}
/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
}