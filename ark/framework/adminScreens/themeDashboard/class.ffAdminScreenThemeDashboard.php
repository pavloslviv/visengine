<?php

class ffAdminScreenThemeDashboard extends ffAdminScreen implements ffIAdminScreen {
	public function getMenu() {
		$menu = $this->_getMenuObject();
		$menu->pageTitle = 'Ark';
		$menu->menuTitle = 'Ark';
		$menu->type = ffMenu::TYPE_UNI_LEVEL;
		$menu->capability = 'manage_options';
		$menu->position = 2;
		return $menu;
	}
}
