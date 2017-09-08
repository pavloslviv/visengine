<?php

class Walker_Nav_Menu_Ark extends ffNavMenuWalker {

	private $_isMultiLevel = false;
	private $_typeMultiLevel = '';

	private $_splitAfter = 0;

	/**
	 * @param $index int
	 */
	public function setSplitAfter( $index ){
		$this->_splitAfter = absint($index);
		if( 0 < $this->_splitAfter ){
			$this->_splitAfter ++;
		}
	}


/**********************************************************************************************************************/
/* DECIDING PARTS
/**********************************************************************************************************************/

	/*----------------------------------------------------------*/
	/* LEVEL 0
	/*----------------------------------------------------------*/
	protected function _start_el_depth_0( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$query = $this->_getMenuItemQuery( $args->menu, $item->ID);

		$this->_splitAfter --;
		if( 0 == $this->_splitAfter ) {
			$output .= '</ul><ul class="nav navbar-nav navbar-nav-right">';
		}

		if( is_object($query) and $query->get('general megamenu') != '') {
			$this->_isMultiLevel = true;
			$this->_typeMultiLevel = $query->get('general megamenu');

			$this->_start_el_depth_0_multilevel( $output, $item, $depth, $args, $id);
		} else {
			$this->_start_el_depth_0_normal( $output, $item, $depth, $args, $id);
		}
	}

	protected function _end_el_depth_0( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$this->_isMultiLevel = false;
		$this->_end_el_fallback($output, $item, $depth, $args, $id );
	}

	protected function _start_lvl_depth_0( &$output, $depth = 0, $args = array(), $id = 0 ) {
		if( $this->_isMultiLevel ) {
			$this->_start_lvl_depth_0_multilevel( $output, $depth, $args, $id );
		} else {
			$this->_start_lvl_depth_0_normal( $output, $depth, $args, $id );
		}
	}

	protected function _end_lvl_depth_0( &$output, $depth = 0, $args = array() ) {
		if( $this->_isMultiLevel ) {
			$this->_end_lvl_depth_0_multilevel( $output, $depth, $args );
		} else {
			$this->_end_lvl_fallback( $output, $depth, $args );
		}
	}

	/*----------------------------------------------------------*/
	/* LEVEL 1
	/*----------------------------------------------------------*/
	protected function _start_el_depth_1( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if( $this->_isMultiLevel ) {
			$this->_start_el_depth_1_multilevel( $output, $item, $depth, $args, $id);
		} else {
			$this->_start_el_depth_1_normal( $output, $item, $depth, $args, $id);
		}
	}

	protected function _end_el_depth_1( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if( $this->_isMultiLevel ) {
			$this->_end_el_depth_1_multilevel($output, $item, $depth, $args, $id );
		} else {
			$this->_end_el_fallback($output, $item, $depth, $args, $id );
		}
	}

	protected function _start_lvl_depth_1( &$output, $depth = 0, $args = array(), $id = 0 ) {
		if( $this->_isMultiLevel ) {
			$this->_start_lvl_depth_1_multilevel( $output, $depth, $args, $id );
		} else {
			$this->_start_lvl_depth_1_normal( $output, $depth, $args, $id );
		}
	}

	protected function _end_lvl_depth_1( &$output, $depth = 0, $args = array() ) {
		if( $this->_isMultiLevel ) {
			$this->_end_lvl_depth_1_multilevel( $output, $depth, $args );
		} else {
			$this->_end_lvl_fallback( $output, $depth, $args );
		}
	}

	/*----------------------------------------------------------*/
	/* LEVEL 2
	/*----------------------------------------------------------*/

	protected function _start_el_depth_2( &$output, $depth = 0, $args = array(), $id = 0 ) {
		if( $this->_isMultiLevel ) {
			$this->_start_el_depth_2_multilevel( $output, $depth, $args, $id );
		} else {
			$this->_start_el( $output, $depth, $args, $id );
		}
	}

/**********************************************************************************************************************/
/* MULTILEVEL
/**********************************************************************************************************************/
	/*----------------------------------------------------------*/
	/* LEVEL 0
	/*----------------------------------------------------------*/
	protected function _start_el_depth_0_multilevel( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item->classes[] = 'nav-item ';
		$item->css_class_link .= ' nav-item-child ffb-ark-first-level-menu ';
		if( $args->has_children ) {
			$item->classes[] = 'dropdown mega-menu-fullwidth';
			$item->css_class_link .= ' dropdown-toggle ';
		}

		$this->_start_el_fallback( $output, $item, $depth, $args, $id);
	}

	protected function _start_lvl_depth_0_multilevel( &$output, $depth = 0, $args = array() ) {
		$output .= '<ul class="dropdown-menu"><li class="mega-menu-content"><div class="row">';
	}

	protected function _end_lvl_depth_0_multilevel( &$output, $depth = 0, $args = array() ) {
		$output .= '</div></li></ul>';
	}

	/*----------------------------------------------------------*/
	/* LEVEL 1
	/*----------------------------------------------------------*/

	// LI + A
	protected function _start_el_depth_1_multilevel( &$output, $item, $depth = 0, $args = array(), $id = 0) {
		$output .= '<div class="'.$this->_typeMultiLevel.'">';
		$output .= '<ul class="list-unstyled mega-menu-list">';
		$output .= '<li id="'.$this->_getLiId( $item, $depth, $args, $id ).'" class="'.$this->_getLiClassNames( $item, $depth, $args, $id ).'">';
		$output .= '<span class="mega-menu-title ffb-ark-sub-level-menu">';
		$output .= ''.$item->title. '';
		$output .= '</span>';
		$output .= '</li>';
	}

	// UL
	protected function _end_el_depth_1_multilevel( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= '</ul></div>';
	}

	protected function _start_lvl_depth_1_multilevel( &$output, $depth = 0, $args = array() ) {
	}

	protected function _end_lvl_depth_1_multilevel( &$output, $depth = 0, $args = array() ) {
	}

	/*----------------------------------------------------------*/
	/* LEVEL 2
	/*----------------------------------------------------------*/

	protected function _start_el_depth_2_multilevel( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item->classes[] = ' mega-menu-item ';
		$item->css_class_link .= ' mega-menu-child ffb-ark-sub-level-menu ';

		$this->_start_el_fallback( $output, $item, $depth, $args, $id);
	}

	/**********************************************************************************************************************/
/* NORMAL
/**********************************************************************************************************************/

	// LI + A
	protected function _start_el_depth_0_normal( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item->classes[] = 'nav-item ';
		$item->css_class_link .= ' nav-item-child ffb-ark-first-level-menu ';
		if( $args->has_children ) {
			$item->classes[] = 'dropdown';
			$item->css_class_link .= ' dropdown-toggle ';
		}


		$this->_start_el_fallback( $output, $item, $depth, $args, $id);
	}

	// UL
	protected function _start_lvl_depth_0_normal( &$output, $depth = 0, $args = array() ) {
		$add_ul_classes = '';
		if( is_object( $args ) and !empty( $args->has_children ) ){
			$add_ul_classes = ' dropdown-menu ';
		}
		$this->_start_lvl_fallback( $output, $depth, $args, $add_ul_classes );
	}


	// LI + A
	protected function _start_el_depth_1_normal( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$this->_start_el( $output, $item, $depth, $args, $id);
	}

	// UL
	protected function _start_lvl_depth_1_normal( &$output, $depth = 0, $args = array() ) {
		$this->_start_lvl( $output, $depth, $args );
	}


/**********************************************************************************************************************/
/* FALLBACK
/**********************************************************************************************************************/

	// LI + A
	protected function _start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if( $args->has_children ) {
			$item->classes[] = 'dropdown-submenu';
			$item->css_class_link .= ' dropdown-submenu-child ';
		}else{
			$item->classes[] = 'dropdown-menu-item';
			$item->css_class_link .= ' dropdown-menu-item-child ';
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
			$add_ul_classes = ' dropdown-menu ';
		}
		$this->_start_lvl_fallback( $output, $depth, $args, $add_ul_classes );
	}

	protected function _start_el_fallback( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$liClasses = $this->_getLiClassNames( $item, $depth, $args, $id );
		$liId = $this->_getLiId( $item, $depth, $args, $id );
		$linkAttributes = $this->_getLinkAttributes( $item, $depth, $args, $id );

		$output .= '<li id="'.$liId.'" class="'.$liClasses.'">';

		$item_output = $args->before;
		$item_output .= '<a';

		$has_toggle = false;
		if( FALSE !== strpos( $linkAttributes, 'dropdown-toggle' ) ){
			$item_output .= str_replace('dropdown-toggle', 'dropdown-link', $linkAttributes);
			$has_toggle = true;
		}else{
			$item_output .= $linkAttributes;
		}

		$item_output .= '>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . $item->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $item->link_after . $args->link_after;
		$item_output .= '</a>';
		if($has_toggle){
			$item_output .= '<a data-toggle="dropdown" href="#" '.$linkAttributes.'>&nbsp;</a>';
			$item_output .= '<span class="clearfix"></span>';
		}
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	protected function _end_el_fallback( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$output .= "</li>";
	}
}

