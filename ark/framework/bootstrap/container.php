<?php

class ffThemeContainer extends ffThemeContainerAbstract {

	const OPTIONS_HOLDER    = 'ffThemeOptionsHolder';
	const OPTIONS_PREFIX    = 'ff_options';
	const OPTIONS_NAMESPACE = 'theme_Ark';
	const OPTIONS_NAME      = 'theme_options';
	const THEME_NAME_LOW = 'ark';

	const SIDEBARS_HOLDER    = 'ffSidebarManagerHolder';
	const SIDEBARS_PREFIX    = 'ff_sidebars_manager';
	const SIDEBARS_NAMESPACE = 'sidebars_manager_Ark';
	const SIDEBARS_NAME      = 'sidebars_manager_options';

	

	/**
	 * @var ffCollection
	 */
	protected $_writepanelsCollection = null;

	/**
	 * @var ffCollection
	 */
	protected $_widgetsCollection = null;

	/**
	 * @var ffThemeContainer
	 */
	private static $_instance = null;

	/**
	 * @param ffContainer $container
	 * @param string $pluginDir
	 * @return ffThemeContainer
	 */
	public static function getInstance( ffContainer $container = null, $pluginDir = null ) {
		if( self::$_instance == null ) {
			self::$_instance = new ffThemeContainer($container, $pluginDir);
		}
		return self::$_instance;
	}

	/**
	 * @return ffCollection
	 */
	public function getWidgetsCollection(){
		if( null != $this->_widgetsCollection ){
			return $this->_widgetsCollection;
		}

		$this->_widgetsCollection = ffContainer()->createNewCollection();

		$this->_widgetsCollection->addItem( '/framework/components/widgets/latestNews', 'LatestNews' );
		$this->_widgetsCollection->addItem( '/framework/components/widgets/twitter', 'Twitter' );
		$this->_widgetsCollection->addItem( '/framework/components/widgets/timeline', 'Timeline' );
		$this->_widgetsCollection->addItem( '/framework/components/widgets/latestPost', 'LatestPost' );

		return $this->_widgetsCollection;
	}

	/**
	 * @return ffCollection
	 */
	public function getWritepanelsCollection(){
		if( null != $this->_writepanelsCollection ){
			return $this->_writepanelsCollection;
		}
		$this->_writepanelsCollection = ffContainer()->createNewCollection();
//		$this->_writepanelsCollection->addItem( '/framework/adminScreens/metaBoxes/metaBoxHeaderSettings', 'ffMetaBoxHeaderSettings' );
//		$this->_writepanelsCollection->addItem( '/framework/adminScreens/metaBoxes/metaBoxPageSettings', 'ffMetaBoxPageSettings' );
		$this->_writepanelsCollection->addItem( '/framework/adminScreens/metaBoxes/metaBoxPortfolio', 'ffMetaBoxPortfolio' );
//		$this->_writepanelsCollection->addItem( '/framework/adminScreens/metaBoxes/metaBoxFooter', 'ffMetaBoxFooter' );
		return $this->_writepanelsCollection;
	}

	
	protected function _registerFiles()
	{
		$this->_registerThemeBuilderElements();


		/**********************************************************************************************************************/
		/* Dashboard
		/**********************************************************************************************************************/
		$this->_registerThemeFile('ffAdminScreenThemeDashboard', '/framework/adminScreens/themeDashboard/class.ffAdminScreenThemeDashboard.php');
		$this->_registerThemeFile('ffAdminScreenThemeDashboardViewDefault', '/framework/adminScreens/themeDashboard/class.ffAdminScreenThemeDashboardViewDefault.php');

		/**********************************************************************************************************************/
		/* THEME OPTIONS
		/**********************************************************************************************************************/
		$this->_registerThemeFile('ffAdminScreenGeneralOptions', '/framework/adminScreens/generalOptions/class.ffAdminScreenGeneralOptions.php');
		$this->_registerThemeFile('ffAdminScreenGeneralOptionsViewDefault', '/framework/adminScreens/generalOptions/class.ffAdminScreenGeneralOptionsViewDefault.php');

		$this->_registerThemeFile('ffAdminScreenThemeOptions', '/framework/adminScreens/themeOptions/class.ffAdminScreenThemeOptions.php');
		$this->_registerThemeFile('ffAdminScreenThemeOptionsViewDefault', '/framework/adminScreens/themeOptions/class.ffAdminScreenThemeOptionsViewDefault.php');

		$this->_registerThemeFile('ffThemeOptionsHolder', '/framework/core/class.ffThemeOptionsHolder.php');
		$this->_registerThemeFile('ffThemeOptions', '/framework/core/class.ffThemeOptions.php');


		/**********************************************************************************************************************/
		/* SIDEBAR MANAGER
		/**********************************************************************************************************************/

		$this->_registerThemeFile('ffAdminScreenSidebarManager', '/framework/adminScreens/sidebarManager/class.ffAdminScreenSidebarManager.php');
		$this->_registerThemeFile('ffAdminScreenSidebarManagerViewDefault', '/framework/adminScreens/sidebarManager/class.ffAdminScreenSidebarManagerViewDefault.php');

		$this->_registerThemeFile('ffSidebarManagerHolder', '/framework/core/class.ffSidebarManagerHolder.php');
		$this->_registerThemeFile('ffSidebarManager', '/framework/core/class.ffSidebarManager.php');


		/**********************************************************************************************************************/
		/* META BOXES
		/**********************************************************************************************************************/
		$this->_registerThemeFile('ffThemeAssetsIncluder', '/framework/theme/class.ffThemeAssetsIncluder.php');

		foreach( $this->getWritepanelsCollection() as $metaboxName => $metaboxDir ){

			$metaboxName = str_replace('ffMetaBox', '', $metaboxName );

			$this->_registerThemeFile('ffComponent_Theme_Metabox'.$metaboxName.'View', $metaboxDir.'/class.ffComponent_Theme_Metabox'.$metaboxName.'View.php');
			$this->_registerThemeFile('ffMetaBox'.$metaboxName.'', $metaboxDir.'/class.ffMetaBox'.$metaboxName.'.php');
			$this->_registerThemeFile('ffMetaBox'.$metaboxName.'View', $metaboxDir.'/class.ffMetaBox'.$metaboxName.'View.php');
		}

		/**********************************************************************************************************************/
		/* WIDGETS
		/**********************************************************************************************************************/
		foreach( $this->getWidgetsCollection() as $widgetName => $widgetDir ){
			$this->_registerThemeFile('ffComponent_'.$widgetName.'Widget_OptionsHolder', $widgetDir.'/class.ffComponent_'.$widgetName.'Widget_OptionsHolder.php');
			$this->_registerThemeFile('ffComponent_'.$widgetName.'Widget_Printer', $widgetDir.'/class.ffComponent_'.$widgetName.'Widget_Printer.php');
			$this->_registerThemeFile('ffWidget'.$widgetName, $widgetDir.'/class.ffWidget'.$widgetName.'.php');
		}

		$this->_registerThemeFile('ffComponent_Theme_MenuOptions', '/framework/components/class.ffComponent_Theme_MenuOptions.php');

		$this->getFrameworkContainer()->getClassLoader()->loadClass('ffThemeOptions');
		$this->getFrameworkContainer()->getClassLoader()->loadClass('ffSidebarManager');

	}

	public function registerBuilderFiles() {
		$themeBuilderManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();

		foreach( $this->getElementsCollection() as $key=>$el ){
			$themeBuilderManager->addElement( $key );
		}
	}

	private function _registerThemeBuilderElements() {
//		$this->_registerThemeBuilderMenus();

		return;
		$cl = $this->_getClassLoader();

		$this->_registerThemeFile('ffThemeBlConst', '/builder/const/class.ffThemeBlConst.php');
		$this->_registerThemeFile('ffThemeElConst', '/builder/const/class.ffThemeElConst.php');
		$this->getFrameworkContainer()->getClassLoader()->loadClass( 'externFreshizer' );


		$cl->loadClass('ffThemeBlConst');
		$cl->loadClass('ffThemeElConst');

		/*----------------------------------------------------------*/
		/* BLOCKS
		/*----------------------------------------------------------*/

		$this->_registerThemeFile('ffBlAnimation', '/builder/blocks/class.ffBlAnimation.php');
		$this->_registerThemeFile('ffBlBlogContent', '/builder/blocks/class.ffBlBlogContent.php');
		$this->_registerThemeFile('ffBlButton', '/builder/blocks/class.ffBlButton.php');
		$this->_registerThemeFile('ffBlComments', '/builder/blocks/class.ffBlComments.php');
		$this->_registerThemeFile('ffBlFeaturedImage', '/builder/blocks/class.ffBlFeaturedImage.php');
		$this->_registerThemeFile('ffBlImage', '/builder/blocks/class.ffBlImage.php');
		$this->_registerThemeFile('ffBlIcons', '/builder/blocks/class.ffBlIcons.php');
		$this->_registerThemeFile('ffBlList', '/builder/blocks/class.ffBlList.php');
		$this->_registerThemeFile('ffBlPageTitle', '/builder/blocks/class.ffBlPageTitle.php');
		$this->_registerThemeFile('ffBlPagination', '/builder/blocks/class.ffBlPagination.php');
		$this->_registerThemeFile('ffBlProgressBar', '/builder/blocks/class.ffBlProgressBar.php');

//		foreach( $this->getElementsCollection() as $key=>$el ){
//			$this->_registerThemeFile( $key, $el);
//		}

	}

	

}