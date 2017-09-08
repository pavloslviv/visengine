<?php
class ffThemeAssetsIncluder extends ffThemeAssetsIncluderAbstract {
	public function isAdmin() {
		$styleEnqueuer = $this->_getStyleEnqueuer();
		$scriptEnqueuer = $this->_getScriptEnqueuer();

		$styleEnqueuer->addStyleTheme( 'wp-color-picker' );
		$scriptEnqueuer->addScript( 'wp-color-picker');

//		$scriptEnqueuer->addScriptTheme('ff-vc_iconpicker','/js/vc_iconpicker.js', null, null, true);
	}

	private function _includeJs() {
		$scriptEnqueuer = $this->_getScriptEnqueuer();

		$scriptEnqueuer->addScriptFramework(
			'ff-frslib',
			'/framework/frslib/src/frslib.js',
			array( 'jquery' ),
			null,
			true
		);
	}

	public function isNotAdmin() {
		$this->_includeJs();
	}
}




