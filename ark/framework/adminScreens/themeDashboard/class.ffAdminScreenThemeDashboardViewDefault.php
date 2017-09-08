<?php

class ffAdminScreenThemeDashboardViewDefault extends ffAdminScreenView {

	public function actionSave( ffRequest $request ) {
	}
	
	protected function _render() {

//		$licensing = ffContainer()->getLicensing();

//		$licensing->setLicenseKey( 'e2bf8d6d-1710-429a-8ea0-7f900735f0c7' );

//		var_Dump( $licensing->getLicenseKey() );

//		$info = $licensing->getUpdateInfo();

//		$info = $licensing->registerThisSite();

//		var_dump( $info );

//		$licensing->getInformationsForLicenseKey( 'fsfc-7yb3-vw8w-cab2-5wn87g' );
//e2bf8d6d-1710-429a-8ea0-7f900735f0c7
//		var_dump($licensing->registerThisSite( 'fsfc-7yb3-vw8w-cab2-5wn87g' ));


//		$dummyManager = ffContainer()->getThemeFrameworkFactory()->getDummyContentManager();
//		var_dump( $dummyManager->getAllInstalledDemos() );

//		$dummyManager->removeInstalledDemo( 'General' );

//		$importManager = ffContainer()->getThemeFrameworkFactory()->getImportManager();
//		$importManager->importFileInSteps( get_template_directory().'/dummy/general/config.json');
//
//		var_dump( $importManager->getStatusMessage() );
		$themeOptionsUrl = admin_url('admin.php?page=ThemeOptions');
		echo '<script> setTimeout(function(){ window.location="'.$themeOptionsUrl.'" }, 1000 )</script>';
//		die();
	}

	protected function _requireAssets() {
	}

	protected function _setDependencies() {
	}

	public function ajaxRequest( ffAdminScreenAjax $ajax ) {
	}
}