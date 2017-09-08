<?php

class ffMetaBoxFooter extends ffMetaBox {
	protected function _initMetaBox() {
		$this->_addPostType( 'ff-footer' );
		$this->_setTitle( ark_wp_kses( __( 'Footer Settings', 'ark' ) ) );
		$this->_setContext( ffMetaBox::CONTEXT_NORMAL);
		
		$this->_setParam( ffMetaBox::PARAM_NORMALIZE_OPTIONS, true);
		$this->_addVisibility( ffMetaBox::VISIBILITY_PAGE_TEMPLATE, 'default');
	}
}