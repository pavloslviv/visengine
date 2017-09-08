<?php

class ffSidebarManager{

	/**
	 * @var ffSidebarManager
	 */
	private static $_instance = null;

	const SIDEBARS_NAMESPACE = ffThemeContainer::SIDEBARS_NAMESPACE ;
	const SIDEBARS_NAME      = ffThemeContainer::SIDEBARS_NAME;

	private $_options = null;
	private $_html_to_remove = array();
	private $_optionsHasBeenInitialised = false;
	private $_query = null;

	private $_currentOptions = array();
	/**
	 * @return ffSidebarManager
	 */
	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new ffSidebarManager();
		}
		return self::$_instance;
	}

	/**
	 * @param null|string $path
	 * @return ffOptionsQuery
	 */
	public static function getQuery( $path = null  ) {
		$query =  self::getInstance()->_getQuery();

		if( $path == null ) {
			return $query;
		} else {
			$path = ffThemeContainer::SIDEBARS_NAME .' '.  $path;

			if( !$query->exists( $path ) ){
				return null;
			}

			return $query->get( $path );
		}
	}

	public static function get( $name, $default = null ){
		return self::getInstance()->_get( $name, $default );
	}

	public static function addFeaturedAreaToRemoveFromContent( $html ){
		return self::getInstance()->_addFeaturedAreaToRemoveFromContent( $html );
	}

	public static function removeFeaturedAreaToRemoveFromContent( $html ){
		return self::getInstance()->_removeFeaturedAreaToRemoveFromContent( $html );
	}

	public static function getCurrentOption( $name ) {
		return self::getInstance()->_getCurrentOption($name);
	}

	public static function setCurrentOption( $name, $value ) {
		return self::getInstance()->_setCurrentOption($name, $value);
	}

	protected function _setCurrentOption( $name, $value ) {
		$this->_currentOptions[ $name ] = $value;
	}

	protected function _getCurrentOption( $name ) {
		if( isset( $this->_currentOptions[ $name ] ) ) {
			return $this->_currentOptions[ $name ];
		} else {
			return null;
		}
	}

	protected function _getQuery() {
		$this->_initOptions();
		return $this->_query;
	}

	public function getData() {

		$data = ffContainer::getInstance()
			->getDataStorageFactory()
			->createDataStorageWPOptionsNamespace( ffSidebarManager::SIDEBARS_NAMESPACE )
			->getOption( ffSidebarManager::SIDEBARS_NAME );

		if( $data == null ) {

			$dataPath = get_template_directory() . '/default/sidebars.json';
			$dataJSON = ffContainer()->getFileSystem()->getContents( $dataPath );
			$data = json_decode( $dataJSON, true );


			ffContainer::getInstance()
				->getDataStorageFactory()
				->createDataStorageWPOptionsNamespace( ffSidebarManager::SIDEBARS_NAMESPACE )
				->setOptionCodedJson( ffSidebarManager::SIDEBARS_NAME, $data );

		}

		return $data;
	}

	protected function _initOptions() {
		if( $this->_optionsHasBeenInitialised == true ) {
			return;

		}

		if( null === $this->_options ){
			$data = $this->getData();

			if( $data === null ) {

			}

			if( null === $data ){
				$this->_options = array();
			}else if( empty( $data[ ffSidebarManager::SIDEBARS_NAME ] ) ){
				$this->_options = array();
			}else{
				$this->_options = $data[ ffSidebarManager::SIDEBARS_NAME ];
			}

			$query = ffContainer::getInstance()->getOptionsFactory()->createQuery($data, 'ffSidebarManagerHolder' );

			$this->_query = $query;
		}
	} 

	protected function _get($name, $default){
		if( !FF_ARK_ENVIRONMENT_READY ){
			return $default;
		}

		$this->_initOptions();


		return isSet( $this->_options[ $name ] )
				? $this->_options[ $name ]
				: $default
				;
	}

	protected function _addFeaturedAreaToRemoveFromContent( $html ){
		$this->_html_to_remove[] = $html;
	}

	protected function _removeFeaturedAreaToRemoveFromContent( $html ){
		foreach ($this->_html_to_remove as $remove) {
			$html = str_replace( $remove , '' , $html );
		}
		$html = str_replace('<p><ifr'.'ame ', '<p class="embed-responsive embed-responsive-16by9"><ifr'.'ame class="embed-responsive-item" ', $html);
		$html = str_replace('<p><embeded ', '<p class="embed-responsive embed-responsive-16by9"><embeded class="embed-responsive-item" ', $html);
		return $html;
	}

}