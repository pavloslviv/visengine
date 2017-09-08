<?php

class ffAdminScreenSidebarManager extends ffAdminScreen implements ffIAdminScreen {
	public function getMenu() {
		$menu = $this->_getMenuObject();
		$menu->pageTitle = esc_attr( __( 'Sidebars', 'ark') );
		$menu->menuTitle = esc_attr( __( 'Sidebars', 'ark') );
		$menu->type = ffMenu::TYPE_SUB_LEVEL;
		$menu->parentSlug = 'ThemeDashboard';
		$menu->capability = 'manage_options';
		$menu->position = 2;
		return $menu;
	}
}
