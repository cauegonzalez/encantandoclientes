<?php

/**
 * Class ffThemeBuilderColorLibrary
 *
 * Color Library,
 */
class ffThemeBuilderColorLibrary extends ffBasicObject {
/**********************************************************************************************************************/
/* OBJECTS
/**********************************************************************************************************************/


/**********************************************************************************************************************/
/* PRIVATE VARIABLES
/**********************************************************************************************************************/
	private $_colorLibrary = null;

/**********************************************************************************************************************/
/* CONSTRUCT
/**********************************************************************************************************************/
	public function __construct() {

	}
/**********************************************************************************************************************/
/* PUBLIC FUNCTIONS
/**********************************************************************************************************************/
	public function getLibrary() {
		$this->_initLibrary();

		return $this->_colorLibrary;
	}

	public function setLibrary( $library ) {
		$this->_colorLibrary = $library;
		return $this;
	}

	public function setColor( $position, $color, $name = null ) {
		$this->_initLibrary();

		$this->_colorLibrary[ $position ][ 'color' ] = $color;
		if( $name != null ) {
			$this->_colorLibrary[ $position ]['name'] = $name;
 		}
	}

	public function getColor( $position ) {
		$this->_initLibrary();

		return $this->_colorLibrary[ $position ]['color'];
	}

	public function saveLibrary() {
		$this->_saveColorLibrary();
	}

/**********************************************************************************************************************/
/* PUBLIC PROPERTIES
/**********************************************************************************************************************/


/**********************************************************************************************************************/
/* PRIVATE FUNCTIONS
/**********************************************************************************************************************/
	private function _initLibrary() {
		if( $this->_colorLibrary == null ) {
			$this->_loadColorLibrary();

			if( $this->_colorLibrary == null ) {
				$this->_createColorLibrary();
			}
		}
	}

	private function _createColorLibrary() {
		$this->_colorLibrary = array();
		$defaultColor = $this->_getDefaultColor();
		for( $i = 1; $i <= 50; $i ++  ) {
			$oneColor = array();
			$oneColor['color'] = $defaultColor;
			$oneColor['name'] = $i;
			$this->_colorLibrary[ $i ] = $oneColor;
		}
	}

	private function _getDefaultColor() {
		return '#ffffff';
	}

	private function _loadColorLibrary() {
		$this->_colorLibrary = get_option('ff-color-library', null);
		if( $this->_colorLibrary != null ) {
			$this->_colorLibrary = json_decode( $this->_colorLibrary, true );
		}
	}

	private function _saveColorLibrary() {
		$data = $this->_colorLibrary;
		$dataJSON = json_encode( $data );

		update_option('ff-color-library',$dataJSON );
	}

/**********************************************************************************************************************/
/* ABSTRACT FUNCTIONS
/**********************************************************************************************************************/


/**********************************************************************************************************************/
/* PRIVATE GETTERS & SETTERS
/**********************************************************************************************************************/
}