<?php

class ffThemeBuilderBlock_HTML extends ffThemeBuilderBlock {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/

/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
	protected function _init() {
		$this->_setInfo( ffThemeBuilderBlock::INFO_ID, 'html');
		$this->_setInfo( ffThemeBuilderBlock::INFO_WRAPPING_ID, 'html');
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
			return '';
		}

		$htmlValue = htmlspecialchars_decode($query->get('html'));

		if( $query->getWithoutComparationDefault('use-as-php') ) {
			eval( $htmlValue );
		} else {
			echo $htmlValue;
		}


	}

	protected function _injectOptions( ffThemeBuilderOptionsExtender $s ) {
		$s->addElement(ffOneElement::TYPE_DESCRIPTION, '', 'Here you can insert your HTML code. If you enable the PHP interpretation, then your code will be executed as a PHP.');
		$s->addOption( ffOneOption::TYPE_TEXTAREA, 'html', '', '');
		$s->addOption( ffOneOption::TYPE_CHECKBOX, 'use-as-php', 'Use as a PHP code instead of HTML', 0);
	}
/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
}