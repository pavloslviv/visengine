<?php

function Walker_Nav_Menu_Ark_Vertical_fallback( $args ){
	echo '<li class="nav-item">';
	echo '<a href="';
	echo get_site_url();
	echo '/wp-admin/nav-menus.php" target="_blank" class="nav-item-child radius-3">';
	echo ark_wp_kses(__('No menu selected. Create menu in the WP Admin menu &raquo; Appearance &raquo; Menu.', 'ark'));
	echo '</a>';
	echo '</li>';
}

class Walker_Nav_Menu_Ark_Vertical extends ffNavMenuWalker {

/**********************************************************************************************************************/
/* DECIDING PARTS
/**********************************************************************************************************************/

	// LVL 0

	protected function _start_el_depth_0( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item->classes[] = 'nav-item nav-main-item';
		$item->css_class_link .= ' nav-item-child nav-main-item-child ffb-ark-first-level-menu ';
		if( $args->has_children ) {
			$item->css_class_link .= ' nav-main-item-child-dropdown ';
		}

		$this->_start_el_fallback( $output, $item, $depth, $args, $id);
	}

	// LVL 1

	protected function _start_el_depth_1( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item->classes[] = 'nav-item';
		$item->css_class_link .= ' nav-item-child nav-submenu-item-child ffb-ark-sub-level-menu ';
		if( $args->has_children ) {
			$item->css_class_link .= ' nav-submenu-item-child-dropdown ';
		}

		$this->_start_el_fallback( $output, $item, $depth, $args, $id);
	}

/**********************************************************************************************************************/
/* FALLBACK
/**********************************************************************************************************************/

	// LI + A
	protected function _start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item->classes[] = 'nav-dropdown-menu-item';
		$item->css_class_link .= ' nav-dropdown-menu-child ';
		if( $args->has_children ) {
			$item->css_class_link .= ' nav-submenu-item-child-dropdown ';
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

