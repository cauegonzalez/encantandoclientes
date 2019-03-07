<?php

class ffMetaBoxPortfolio extends ffMetaBox {
	protected function _initMetaBox() {
		$this->_addPostType( 'portfolio' );
		$this->_setTitle('Portfolio Settings');
		$this->_setContext( ffMetaBox::CONTEXT_NORMAL);
		
		$this->_setParam( ffMetaBox::PARAM_NORMALIZE_OPTIONS, true);
	}
}