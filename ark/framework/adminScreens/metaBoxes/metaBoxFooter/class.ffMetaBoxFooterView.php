<?php

class ffMetaBoxFooterView extends ffMetaBoxView {

	private function _getMetaboxSlug(){
		return 'Footer';
	}

	protected function _requireAssets() {
		ffContainer::getInstance()->getScriptEnqueuer()->getFrameworkScriptLoader()->requireFfAdmin();
	}

	public function requireModalWindows() {
	}

	protected function _render( $post ) {
		ffContainer::getInstance()->getWPLayer()->add_action('admin_footer', array($this,'requireModalWindows'), 1);
		$fwc = ffContainer::getInstance();
		$s = $fwc->getOptionsFactory()->createOptionsHolder('ffComponent_Theme_Metabox'.$this->_getMetaboxSlug().'View')->getOptions();
		$value = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade(  $post->ID )->getOptionCoded( $this->_getMetaboxSlug() );

		$printer = $fwc->getOptionsFactory()->createOptionsPrinterJavascriptConvertor( $value, $s );

		$printer->setPrintCopyAndPaste(false);

//		$printer = $fwc->getOptionsFactory()->createOptionsPrinterBoxed( $value, $s );
		$printer->setNameprefix( $this->_getMetaboxSlug() );
		// Escaped footer
		echo ( $printer->walk() );
	}

	protected function _save( $postId ) {
		$fwc = ffContainer::getInstance();
		$saver = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( $postId );
		$s = $fwc->getOptionsFactory()->createOptionsHolder('ffComponent_Theme_Metabox'.$this->_getMetaboxSlug().'View')->getOptions();
		$postReader = $fwc->getOptionsFactory()->createOptionsPostReader($s);
		$valueNew = $postReader->getData( $this->_getMetaboxSlug() );
		$saver->setOptionCoded( $this->_getMetaboxSlug() , $valueNew );
	}
}

