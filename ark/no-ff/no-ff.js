(function($){

	'use strict';


	$('ul.nav.navbar-nav.no-ff > li').addClass('nav-item');
	$('ul.nav.navbar-nav.no-ff > li > a').addClass('nav-item-child');
	$('ul.nav.navbar-nav.no-ff > li.menu-item-has-children > a').addClass('dropdown-toggle');
	$('ul.nav.navbar-nav.no-ff > li.menu-item-has-children > a').attr('data-toggle', 'dropdown');
	$('ul.nav.navbar-nav.no-ff > li > ul').addClass('dropdown-menu');
	$('ul.nav.navbar-nav.no-ff > li > ul > li:not(.menu-item-has-children)').addClass('dropdown-menu-item');
	$('ul.nav.navbar-nav.no-ff > li > ul > li:not(.menu-item-has-children) > a').addClass('dropdown-menu-item-child');
	$('ul.nav.navbar-nav.no-ff > li > ul > li.menu-item-has-children').addClass('dropdown-submenu');
	$('ul.nav.navbar-nav.no-ff > li > ul > li.menu-item-has-children > a').addClass('dropdown-submenu-child');
	$('ul.nav.navbar-nav.no-ff > li > ul > li.menu-item-has-children > a').attr('data-toggle', 'dropdown');
	$('ul.nav.navbar-nav.no-ff > li > ul > li ul').addClass('dropdown-menu');
	$('ul.nav.navbar-nav.no-ff > li > ul > li ul li:not(.menu-item-has-children)').addClass('dropdown-menu-item');
	$('ul.nav.navbar-nav.no-ff > li > ul > li ul li:not(.menu-item-has-children) > a').addClass('dropdown-menu-item-child');
	$('ul.nav.navbar-nav.no-ff > li > ul > li ul li.menu-item-has-children').addClass('dropdown-submenu');
	$('ul.nav.navbar-nav.no-ff > li > ul > li ul li.menu-item-has-children > a').addClass('dropdown-submenu-child');
	$('ul.nav.navbar-nav.no-ff > li > ul > li ul li.menu-item-has-children > a').attr('data-toggle', 'dropdown');


})(jQuery);