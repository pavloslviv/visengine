(function($){
// Header Section Scroll
	var HeaderSectionScroll = function() {
		'use strict';

		// Handle Header Section Scroll Nav
		var handleHeaderSectionScrollNav = function() {

			if( 0 === $('.smoothscroll-sharplink').size() ) {
				// Smooth Scrolling Sections
				$('.ark-header-vertical .nav-item-child').on('click', function(event) {
					if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
						var target = $(this.hash);
						target = target.length ? target : $('[href' + this.hash.slice(1) +']');
						if (target.length) {
							$('html, body').stop(false,false).animate({
								scrollTop: target.offset().top - 0
							}, 1000);
							return false;
						}
					}
				});
			}

			if( 1 == $('.header-section-scroll').size() ){
				// Navbar Collapse On Scroll
				$(window).scroll(function() {
					if ($('.header-section-scroll .navbar').offset().top > 250) {
						$('.header-section-scroll .navbar-collapse.in').collapse('hide');
						$('.header-section-scroll .toggle-icon').addClass('is-clicked');
					} else {
						$('.header-section-scroll .navbar-collapse.in').collapse('show');
						$('.header-section-scroll .toggle-icon').removeClass('is-clicked');
					}
				});

				// Collapse Navbar When It's Clickicked
				$(window).scroll(function() {
					$('.header-section-scroll .navbar-collapse.in').collapse('hide');
				});
			}

			$(window).load(function() {
				$('body').scrollspy({
					target: '.ark-header-vertical'
					// , offset: navHeight
				});
			});
		};

		return {
			init: function() {
				handleHeaderSectionScrollNav(); // initial setup for header Section Scroll nav
			}
		}
	}();

	$(document).ready(function() {
		HeaderSectionScroll.init();
	});
})(jQuery);