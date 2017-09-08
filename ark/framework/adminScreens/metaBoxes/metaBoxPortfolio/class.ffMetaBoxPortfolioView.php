<?php

class ffMetaBoxPortfolioView extends ffMetaBoxView {

	protected function _requireAssets() {
		ffContainer::getInstance()->getScriptEnqueuer()->getFrameworkScriptLoader()->requireFfAdmin();
	}

	public function requireModalWindows() {
		ffContainer::getInstance()->getModalWindowFactory()->printModalWindowManagerLibraryIcon();
	}

	protected function _render( $post ) {

		$fwc = ffContainer::getInstance();
		$structure = $fwc->getOptionsFactory()->createOptionsHolder('ffComponent_Theme_MetaboxPortfolioView')->getOptions();
		$data = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade(  $post->ID )->getOptionCodedJSON('portfolio_category_options');


		$printer2 = $fwc->getOptionsFactory()->createOptionsPrinter2($data, $structure);
		$printer2->setName('portfolio_category_options');
		$printer2->getSubmittedOptions();
		echo '<div class="ff-metabox-options">';
			$printer2->printOptions();
		echo '</div>';

	}


	protected function _save( $postId ) {
		$fwc = ffContainer::getInstance();

		$printer2 = $fwc->getOptionsFactory()->createOptionsPrinter2();
		$printer2->setName('portfolio_category_options');

		$data = $printer2->getSubmittedOptions();

		$saver = $fwc->getDataStorageFactory()->createDataStorageWPPostMetas_NamespaceFacade( $postId );

		$saver->setOptionCodedJSON( 'portfolio_category_options' , $data );


	}
}