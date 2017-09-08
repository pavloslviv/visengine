<?php

class ffAdminScreenThemeOptionsViewDefault extends ffAdminScreenView {

	public function actionSave( ffRequest $request ) {

		if( ! $request->postEmpty() ){
			flush_rewrite_rules( false );
		}

	}
	public function newAjaxRequest( ffAjaxRequest $ajaxRequest ) {
//		var_dump( $ajaxRequest );
		$data = $ajaxRequest->getDataStripped('form');

		$cont = ffContainer();
		$dataStorage = $cont->getDataStorageFactory()->createDataStorageWPOptionsNamespace( ffThemeContainer::OPTIONS_NAMESPACE );

		$dataStorage->setOptionCodedJson(ffThemeContainer::OPTIONS_NAME, $data );

		// Refresh portfolio slugs in .htaccess
		flush_rewrite_rules( false );
	}
	
	protected function _render() {

		ffContainer()->getWPLayer()->add_action('admin_footer', array($this,'requireModalWindows'), 1);

		echo '<div class="ff-collection">';
			echo '<div class="ff-collection-sidebar">';
				echo '<div class="ff-collection-sidebar-title">Theme Options</div>';

				/// MENU
				echo '<div class="ff-items-wrapper">';

					echo '<div data-item-id="page" class="ff-one-item ff-one-item-active">';
						echo '<a href="http://localhost/framework/ark-default-sections/wp-admin/admin.php?page=SitePreferences&amp;view_name=Page&amp;view_id=page">Page</a>';
					echo '</div>';

				echo '</div>';
				/// MENU

			echo '</div>';

			echo '<div class="ff-collection-content">';


		$cont = ffContainer::getInstance();
		$struct = $cont->getOptionsHolderFactory()->createOptionsHolder( ffThemeContainer::OPTIONS_HOLDER )->getOptions();

		$dataStorage = $cont->getDataStorageFactory()->createDataStorageWPOptionsNamespace( ffThemeContainer::OPTIONS_NAMESPACE );

		$data = $dataStorage->getOptionCodedJson( ffThemeContainer::OPTIONS_NAME );

		$printer = $cont->getOptionsFactory()->createOptionsPrinter2( $data, $struct );
		$printer->setName( ffThemeContainer::OPTIONS_PREFIX );
		echo '<div class="ffb-builder-wrapper clearfix">';
			$printer->printOptions();

					echo '<div class="ffb-builder-toolbar-fixed-wrapper">';
						echo '<div class="ffb-builder-toolbar-fixed clearfix">';
							echo '<div class="ffb-builder-toolbar-fixed-left">';
								echo '<input type="submit" value="Quick Save" class="ff-save-ajax ffb-main-save-ajax-btn ffb-builder-toolbar-fixed-btn">';
							echo '</div>';
							echo '<div class="ffb-builder-toolbar-fixed-right">';
							echo '</div>';
						echo '</div>';
					echo '</div>';

				echo '</div>';


				echo '<div class="clear clearfix"></div>';

			echo '</div>';

		echo '</div>';
	}

	protected function _requireAssets() {


		$styleEnqueuer = $this->_getStyleEnqueuer();
		$scriptEnqueuer = $this->_getScriptEnqueuer();

		$styleEnqueuer->addStyleTheme( 'wp-color-picker' );
		$scriptEnqueuer->addScript( 'wp-color-picker');

		$iconfont_types = array(
			'bootstrap glyphicons'
			              => '/framework/extern/iconfonts/glyphicon/glyphicon.css',
			'brandico'    => '/framework/extern/iconfonts/ff-font-brandico/ff-font-brandico.css',
			'elusive'     => '/framework/extern/iconfonts/ff-font-elusive/ff-font-elusive.css',
			'entypo'      => '/framework/extern/iconfonts/ff-font-entypo/ff-font-entypo.css',
			'fontelico'   => '/framework/extern/iconfonts/ff-font-fontelico/ff-font-fontelico.css',
			'iconic'      => '/framework/extern/iconfonts/ff-font-iconic/ff-font-iconic.css',
			'linecons'    => '/framework/extern/iconfonts/ff-font-linecons/ff-font-linecons.css',
			'maki'        => '/framework/extern/iconfonts/ff-font-maki/ff-font-maki.css',
			'meteocons'   => '/framework/extern/iconfonts/ff-font-meteocons/ff-font-meteocons.css',
			'mfglabs'     => '/framework/extern/iconfonts/ff-font-mfglabs/ff-font-mfglabs.css',
			'modernpics'  => '/framework/extern/iconfonts/ff-font-modernpics/ff-font-modernpics.css',
			'typicons'    => '/framework/extern/iconfonts/ff-font-typicons/ff-font-typicons.css',
			'simple line icons'
			              => '/framework/extern/iconfonts/ff-font-simple-line-icons/ff-font-simple-line-icons.css',
			'weathercons' => '/framework/extern/iconfonts/ff-font-weathercons/ff-font-weathercons.css',
			'websymbols'  => '/framework/extern/iconfonts/ff-font-websymbols/ff-font-websymbols.css',
			'zocial'      => '/framework/extern/iconfonts/ff-font-zocial/ff-font-zocial.css',
		);

		foreach ($iconfont_types as $name => $path) {
			$styleEnqueuer->addStyleFramework( 'icon-option-font-' . str_replace(' ', '_', $name), $path);
		}

		ffContainer()->getFrameworkScriptLoader()->requireFrsLib()->requireFrsLibOptions2();

		$styleEnqueuer->addStyleTheme('ff-theme-options-style', '/framework/adminScreens/themeOptions/style.css');
		$styleEnqueuer->addStyleFramework('ffb-builder-style', '/framework/themes/builder/metaBoxThemeBuilder/assets/style.css');

//		ffContainer()->getThemeFrameworkFactory()->getThemeBuilder()->requireBuilderScriptsAndStyles();

		$scriptEnqueuer->addScriptTheme('ff-theme-options-script', '/framework/adminScreens/themeOptions/script.js');
	}

	protected function _setDependencies() {

	}

	public function ajaxRequest( ffAdminScreenAjax $ajax ) {

	}

	public function requireModalWindows() {
		$fwc = ffContainer();

		$fwc->getModalWindowFactory()->printModalWindowManagerLibraryColor();
		$fwc->getModalWindowFactory()->printModalWindowManagerLibraryIcon();
	}
}