<?php

class ffMetaBoxPageSettings extends ffMetaBox {
	protected function _initMetaBox() {
		$this->_addPostType( 'page' );
		$this->_addPostType( 'portfolio' );
		$this->_setTitle( ark_wp_kses( __( 'Page Settings', 'ark' ) ) );
		$this->_setContext( ffMetaBox::CONTEXT_NORMAL);
		
		$this->_setParam( ffMetaBox::PARAM_NORMALIZE_OPTIONS, true);
		$this->_addVisibility( ffMetaBox::VISIBILITY_PAGE_TEMPLATE, 'default');
	}
}