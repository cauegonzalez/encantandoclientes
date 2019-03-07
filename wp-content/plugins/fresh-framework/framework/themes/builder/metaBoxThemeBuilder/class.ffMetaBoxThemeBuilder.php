<?php

class ffMetaBoxThemeBuilder extends ffMetaBox {
	protected function _initMetaBox() {

		$this->_addPostType( 'page' );
		 $this->_addPostType( ffTheme::CONTENT_BLOCK_ADMIN_POST_TYPE_SLUG );
		$this->_addPostType( 'portfolio' );
		$this->_addPostType( ffTheme::CONTENT_BLOCK_POST_TYPE_SLUG );
		$this->_setTitle('PAGE BUILDER');
		$this->_setContext( ffMetaBox::CONTEXT_NORMAL);
        $this->_setPriority( ffMetaBox::PRIORITY_HIGH );
		
//		$this->_setParam( ffMetaBox::PARAM_NORMALIZE_OPTIONS, true);
//        $this->_setParam( ffMetaBox::PARAM_NORMALIZE_OPTIONS_TO_ONE_INPUT, true );
//		$this->_addVisibility( ffMetaBox::VISIBILITY_PAGE_TEMPLATE, 'page-onepage.php');
	}
}