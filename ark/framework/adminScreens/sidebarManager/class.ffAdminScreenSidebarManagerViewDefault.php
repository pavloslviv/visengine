<?php

class ffAdminScreenSidebarManagerViewDefault extends ffAdminScreenView {

	public function actionSave( ffRequest $request ) {

		if( ! $request->postEmpty() ){
			flush_rewrite_rules( false );
		}

	}
	
	protected function _render() {

		ffContainer::getInstance()->getModalWindowFactory()->printModalWindowSectionPicker();

		echo '<div class="wrap">';
		echo '<form method="post">';

		echo '<h1>'. ark_wp_kses( __( 'Sidebars', 'ark' ) ).'</h1>';

		$this->_renderOptions(
			  ffThemeContainer::SIDEBARS_HOLDER
			, ffThemeContainer::SIDEBARS_PREFIX
			, ffThemeContainer::SIDEBARS_NAMESPACE
			, ffThemeContainer::SIDEBARS_NAME
		);

		echo '</form>';
		echo '</div>';
	}

	protected function _requireAssets() {
	}

	protected function _setDependencies() {

	}

	public function ajaxRequest( ffAdminScreenAjax $ajax ) {

	}
}