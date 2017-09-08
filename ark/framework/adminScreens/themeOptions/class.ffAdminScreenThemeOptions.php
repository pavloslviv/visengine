<?php

class ffAdminScreenThemeOptions extends ffAdminScreen implements ffIAdminScreen {
	public function getMenu() {
		$menu = $this->_getMenuObject();
		$menu->pageTitle = ark_wp_kses( __( 'Theme Options', 'ark' ) );
		$menu->menuTitle = ark_wp_kses( __( 'Theme Options', 'ark' ) );
		$menu->type = ffMenu::TYPE_SUB_LEVEL;
		$menu->parentSlug = 'ThemeDashboard';
		$menu->capability = 'manage_options';
		$menu->position = 10;
		return $menu;
	}
}
