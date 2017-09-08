<?php

class ffMetaBoxPortfolio extends ffMetaBox {
	protected function _initMetaBox() {
		$this->_addPostType( 'portfolio' );
		$this->_setTitle( ark_wp_kses( __( 'Portfolio Category (Archive) View', 'ark' ) ) );
		$this->_setContext( ffMetaBox::CONTEXT_NORMAL);

		$this->_setParam( ffMetaBox::PARAM_NORMALIZE_OPTIONS, true);
	}
}