<?php

class ffComponent_Theme_MetaboxHeaderSettingsView extends ffOptionsHolder {

	/**
	 * @return ffOneStructure
	 */
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure('HeaderSettings');
		$this->setStructure($s);
		return $s;
	}

	/**
	 * @param ffOneStructure $s
	 * @return ffOneStructure
	 */
	public function setStructure( $s ){
		ark_get_navigation_options($s);
	}


}

