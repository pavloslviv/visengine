<?php

class Walker_Nav_Menu_Ark_Fullscreen extends ffNavMenuWalker {

/**********************************************************************************************************************/
/* DECIDING PARTS
/**********************************************************************************************************************/

	/*----------------------------------------------------------*/
	/* LEVEL 0
	/*----------------------------------------------------------*/
	protected function _start_el_depth_0( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item->classes[] = ' nav-item nav-main-item ';
		$item->css_class_link .= ' nav-item-child nav-main-item-child ffb-ark-first-level-menu';
		if( $args->has_children ) {
			$item->css_class_link .= ' nav-main-item-child-dropdown ';
		}
		$this->_start_el_fallback( $output, $item, $depth, $args, $id);
	}

	protected function _start_lvl_depth_0( &$output, $depth = 0, $args = array(), $id = 0 ) {
		$add_ul_classes = '';
		if( is_object( $args ) and !empty( $args->has_children ) ){
			$add_ul_classes = ' nav-dropdown-menu ';
		}
		$this->_start_lvl_fallback( $output, $depth, $args, $add_ul_classes );
	}

/**********************************************************************************************************************/
/* FALLBACK
/**********************************************************************************************************************/

	// LI + A
	protected function _start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		if( $args->has_children ) {
			$item->classes[] = ' nav-item ';
			$item->css_class_link .= ' nav-item-child nav-submenu-item-child nav-submenu-item-child-dropdown ';
		}else{
			$item->classes[] = 'nav-dropdown-menu-item';
			$item->css_class_link .= ' nav-dropdown-menu-link ';
		}
		if( 0 != $depth ){
			$item->css_class_link .= ' ffb-ark-sub-level-menu ';
		}

		$this->_start_el_fallback( $output, $item, $depth, $args, $id);
	}

	// UL
	protected function _start_lvl( &$output, $depth = 0, $args = array(), $additionalUlClasses = '' ) {
		$add_ul_classes = '';

		if( is_object( $args ) and !empty( $args->has_children ) ){
			$add_ul_classes = ' nav-dropdown-menu ';
		}
		$this->_start_lvl_fallback( $output, $depth, $args, $add_ul_classes );
	}

}

