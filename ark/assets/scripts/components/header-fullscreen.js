(function($){
// Header Vertical Dropdown
	var HeaderFullscreen = function() {
		"use strict";

		// Handle Header Vertical Dropdown Toggle
		var handleHeaderFullscreenToggle = function() {

			var $wpml_li = $('.menu-item-language-current');
			if( 0 < $wpml_li.size() ){
				$wpml_li.addClass('nav-item nav-main-item');
				$('.menu-item-language-current > a').removeAttr('onclick');
				$('.menu-item-language-current > a').addClass('nav-item-child nav-main-item-child nav-main-item-child-dropdown ffb-ark-first-level-menu');
				$('.menu-item-language-current > ul').addClass('sub-menu  nav-dropdown-menu');
				$('.menu-item-language-current > ul > li').addClass('nav-dropdown-menu-item');
				$('.menu-item-language-current > ul > li > a').addClass('nav-dropdown-menu-link ffb-ark-sub-level-menu');
				$wpml_li.find('img.iclflag').each(function(){
					var $this = $(this);
					var this_height = $this.height();
					var parent_line_height = parseInt( $this.parent().css('line-height') );
					var mb = parseInt( ( parent_line_height - this_height - 2 ) / 2 );
					$this.attr( 'style', 'margin-bottom:' + mb + 'px !important' );
				});
			}

			$('ul.header-fullscreen-menu a').on('click', function(event) {
				if( $(this).hasClass('nav-main-item-child-dropdown') || $(this).hasClass('nav-submenu-item-child-dropdown') ) {
					event.preventDefault();
					$(this).toggleClass('nav-item-open').next('.nav-dropdown-menu').slideToggle(400).end().parent('.nav-item').siblings('.nav-item').children('a').removeClass('nav-item-open').next('.nav-dropdown-menu').slideUp(400);
				}else{
					$('.header-fullscreen-nav-close').click();
				}
			});
		};

		return {
			init: function() {
				handleHeaderFullscreenToggle(); // initial setup for header vertical dropdown toggle
			}
		}
	}();

	$(document).ready(function() {
		HeaderFullscreen.init();
	});
})(jQuery);
