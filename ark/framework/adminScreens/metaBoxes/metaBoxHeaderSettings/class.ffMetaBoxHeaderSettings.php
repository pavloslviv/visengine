<?php

class ffMetaBoxHeaderSettings extends ffMetaBox {
	protected function _initMetaBox() {
		$this->_addPostType( ffTheme::HEADER_POST_TYPE_SLUG );
		$this->_setTitle( ark_wp_kses( __( 'Logo and Navigation Settings', 'ark' ) ) );
		$this->_setContext( ffMetaBox::CONTEXT_NORMAL);
		
		$this->_setParam( ffMetaBox::PARAM_NORMALIZE_OPTIONS, true);
		$this->_addVisibility( ffMetaBox::VISIBILITY_PAGE_TEMPLATE, 'default');
	}
}