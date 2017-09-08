(function($){
// Header Vertical Dropdown
	var HeaderVerticalDropdown = function() {
		"use strict";

		var $wpml_li = $('.menu-item-language-current');
		if( 0 < $wpml_li.size() ){
			if( 1 == $('.header-vertical-menu').size() ) {
				$wpml_li.addClass('nav-item nav-main-item');
				$('.menu-item-language-current > a').removeAttr('onclick');
				$('.menu-item-language-current > a').addClass('nav-item-child nav-main-item-child nav-main-item-child-dropdown ffb-ark-first-level-menu ');
				$('.menu-item-language-current > ul').addClass('nav-dropdown-menu');
				$('.menu-item-language-current > ul > li').addClass('nav-dropdown-menu-item');
				$('.menu-item-language-current > ul > li > a').addClass('nav-dropdown-menu-link ffb-ark-sub-level-menu');
			}else{
				$wpml_li.addClass('nav-item nav-main-item');
				$('.menu-item-language-current > a').removeAttr('onclick');
				$('.menu-item-language-current > a').addClass('nav-item-child nav-main-item-child ffb-ark-first-level-menu ');
				$('.menu-item-language-current > ul > li > a').addClass('nav-dropdown-menu-link ffb-ark-sub-level-menu');
			}
		}

		// Handle Header Vertical Dropdown Toggle
		var handleHeaderVerticalDropdownToggle = function() {
			$('.header-vertical-menu li.menu-item').children('a').on('click', function(event) {
				var $dropdown = $(this).toggleClass('nav-item-open').next('.nav-dropdown-menu');
				if( 0 < $dropdown.size() ) {
					$dropdown.slideToggle(400).end().parent('li.menu-item').siblings('li.menu-item').children('a').removeClass('nav-item-open').next('.nav-dropdown-menu').slideUp(400);
					event.preventDefault();
					return false;
				}
			});
		};

		return {
			init: function() {
				handleHeaderVerticalDropdownToggle(); // initial setup for header vertical dropdown toggle
			}
		}
	}();

	$(document).ready(function() {
		HeaderVerticalDropdown.init();
	});
})(jQuery);
