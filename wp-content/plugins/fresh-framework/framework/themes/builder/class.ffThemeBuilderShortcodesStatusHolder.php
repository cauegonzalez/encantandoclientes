<?php

/**
 * Class ffThemeBuilderShortcodesStatusHolder
 */
class ffThemeBuilderShortcodesStatusHolder extends ffBasicObject {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/


/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/
	private $_textColorStack = array();

/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/


/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/
	public function addTextColorToStack( $textColor ) {
		$this->_textColorStack[] = $textColor;
	}

	public function removeTextColorFromStack() {
		return array_pop( $this->_textColorStack );
	}

	public function getCurrentTextColor() {
		if( empty( $this->_textColorStack ) ) {
			return null;
		} else {
			return end( $this->_textColorStack );
		}
	}

/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/


/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/


/**********************************************************************************************************************/
/* ABSTRACT FUNCTIONS
/**********************************************************************************************************************/


/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
}