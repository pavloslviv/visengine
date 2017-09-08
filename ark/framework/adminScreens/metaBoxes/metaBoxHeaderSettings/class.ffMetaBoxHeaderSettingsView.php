<?php

class ffMetaBoxHeaderSettingsView extends ffMetaBoxView {

	private function _getMetaboxSlug(){
		return 'HeaderSettings';
	}

	protected function _requireAssets() {
		ffContainer::getInstance()->getScriptEnqueuer()->getFrameworkScriptLoader()->requireFfAdmin();
	}

	public function requireModalWindows() {
		$fwc = ffContainer();
//		$fwc->getModalWindowFactory()->printModalWindowManagerLibraryColor();
		$fwc->getModalWindowFactory()->printModalWindowManagerLibraryIcon();
	}

	protected function _render( $post ) {

		$fwc = ffContainer::getInstance();
		$structure = $fwc->getOptionsFactory()->createOptionsHolder('ffComponent_Theme_Metabox'.$this->_getMetaboxSlug().'View')->getOptions();
		$data = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade(  $post->ID )->getOptionCodedJSON( $this->_getMetaboxSlug() );
		

		$printer2 = $fwc->getOptionsFactory()->createOptionsPrinter2($data, $structure);
		$printer2->getSubmittedOptions();
		$printer2->printOptions();

		
	}

	protected function _save( $postId ) {
		$fwc = ffContainer::getInstance();

		$printer2 = $fwc->getOptionsFactory()->createOptionsPrinter2();

		$data = $printer2->getSubmittedOptions();

		$saver = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( $postId );

		$saver->setOptionCodedJSON( $this->_getMetaboxSlug() , $data );
	}
}

