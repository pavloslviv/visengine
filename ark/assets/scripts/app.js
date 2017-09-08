(function($){

	$(document).ready(function(){

		if( 0 != $('.header-vertical').size() ){
			return;
		}

		if( $('.ark-header').hasClass('header-fullscreen') ){
			return;
		}

		if( 1 == $('.header-vertical-menu').size() ) {
			return;
		}

		if( 1 == $('.header-section-scroll-menu').size() ) {
			return;
		}

		var $wpml_li = $('.menu-item-language-current');
		if( 0 < $wpml_li.size() ){
			$wpml_li.addClass('nav-item dropdown');
			$('.menu-item-language-current > a').removeAttr('onclick');
			$('.menu-item-language-current > a').attr('data-toggle','dropdown');
			$('.menu-item-language-current > a').addClass('nav-item-child dropdown-toggle ffb-ark-first-level-menu');
			$('.menu-item-language-current > ul').addClass('dropdown-menu');
			$('.menu-item-language-current > ul > li').addClass('dropdown-menu-item');
			$('.menu-item-language-current > ul > li > a').addClass('dropdown-menu-item-child');

			if( $('.ark-header').hasClass('header-center-aligned') || $('.ark-header').hasClass('header-center-aligned-transparent')  ){
				$parent = $wpml_li.parent('.navbar-nav-left');
				if( 0 != $parent.size() ){
					var split_after = parseInt( $parent.attr('data-split-after') );
					var $wpml_index = 0;
					$parent.children('li').each(function(index){
						if( $(this).hasClass('menu-item-language') ){
							$wpml_index = index;
						}
					});
					if( $wpml_index == split_after ){
						$parent.after('<ul class="nav navbar-nav navbar-nav-right"></ul>');
						var $new_parent = $parent.next();
						$new_parent.append($wpml_li.clone());
						$wpml_li.remove();
					}
				}
			}
		}
	});


	// Core Javascript Initialization
	var App = function() {
		'use strict';

		// Bootstra Components
		var handleBootstrapComponents = function() {
			// Bootstrap Carousel
			$('.carousel').each(function(){
				var $this = $(this);
				if( $this.hasClass('ff-carousel-initialized') ){
					return
				}
				$this.carousel({
					interval: 5000,
					pause: 'hover'
				});
				$this.addClass('ff-carousel-initialized')
			});

			// Tooltips
			$('.tooltips').tooltip();
			$('.tooltips-show').tooltip('show');
			$('.tooltips-hide').tooltip('hide');
			$('.tooltips-toggle').tooltip('toggle');
			$('.tooltips-destroy').tooltip('destroy');

			// Popovers
			$('.popovers').popover();
			$('.popovers-show').popover('show');
			$('.popovers-hide').popover('hide');
			$('.popovers-toggle').popover('toggle');
			$('.popovers-destroy').popover('destroy');
		}

		// Bootstrap Navbar Trigger
		var handleNavbarToggle = function() {
			$('.navbar-toggle').on('click', function(event) {
				if ($('.toggle-icon').hasClass('is-clicked')) {
					$('.toggle-icon').removeClass('is-clicked');
				} else {
					$('.toggle-icon').addClass('is-clicked');
				}
			});
		}

		// Handle Sidebar Menu
		var handleSidebarMenu = function() {
			$(document).ready(function($) {
				var $sidebar_trigger = $('.sidebar-trigger'),
					$sidebar_content_overlay = $('.sidebar-content-overlay');

				// open-close sidebar menu clicking on the menu icon
				$sidebar_trigger.on('click', function(event){
					event.preventDefault();

					$sidebar_trigger.toggleClass('is-clicked');
					$sidebar_content_overlay.toggleClass('sidebar-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend');
					$('.sidebar-nav').toggleClass('sidebar-menu-is-open');

					// check if transitions are not supported - i.e. in IE9
					if($('html').hasClass('no-csstransitions')) {
						$('body').toggleClass('overflow-hidden');
					}
				});

				// close lateral menu clicking outside the menu itself
				$sidebar_content_overlay.on('click', function(event){
					if( !$(event.target).is('.sidebar-trigger') ) {
						$sidebar_trigger.removeClass('is-clicked');
						$sidebar_content_overlay.removeClass('sidebar-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
							$('body').removeClass('overflow-hidden');
						});
						$('.sidebar-nav').removeClass('sidebar-menu-is-open');
						// check if transitions are not supported
						if($('html').hasClass('no-csstransitions')) {
							$('body').removeClass('overflow-hidden');
						}

					}
				});

				// close sidebar menu scrolling on the content
				// $(window).scroll(function() {
				// 	if ($(this).scrollTop() > 200) {
				// 		$('.sidebar-content-overlay, .sidebar-nav').removeClass('sidebar-menu-is-open');
				// 		$('.sidebar-trigger').removeClass('is-clicked');
				// 	}
				// });
			});
		}

		// Services v1 Collapse
		var handleServicesV7 = function() {
			$('.services-v7-collapsed').hide();
			$('.services-v7').on('hover', function() {
				$(this).find('.services-v7-collapsed').stop(false,false).slideToggle(300);
			});
		}

		// Work v1 Collapse
		var handleWorkV1 = function() {
			$('.work-v1-collapse').hide();
			$('.work-v1').on('hover', function() {
				$(this).find('.work-v1-collapse').stop(false,false).slideToggle(400);
			});
		}

		// Topbar Transparent Dropdown
		var handleTopbarTDropdown = function() {
			$('.topbar-t-dropdown-menu').hide();
			$('.topbar-t-list-item').on('click', function() {
				$(this).find('.topbar-t-dropdown-menu').stop(false,false).slideToggle(400);
			});
		}

		// Topbar transparent Shopping Dropdown
		var handleTopbarTShoppingDropdown = function() {
			$('.topbar-t-dropdown-menu').hide();
			$('.topbar-t-shopping-window').on('click', function() {
				$(this).find('.topbar-t-dropdown-menu').stop(false,false).slideToggle(400);
			});
		}

		// Topbar e-Commerce Dropdown
		var handleTopbarEDropdown = function() {
			$('.topbar-e-dropdown-menu').hide();
			$('.topbar-e-list-item').on('click', function() {
				$(this).find('.topbar-e-dropdown-menu').stop(false,false).slideToggle(400);
			});
		}

		// Topbar e-Commerce Shopping Dropdown
		var handleTopbarEShoppingDropdown = function() {
			$('.topbar-e-dropdown-menu').hide();
			$('.topbar-e-shopping-window').on('click', function() {
				$(this).find('.topbar-e-dropdown-menu').stop(false,false).slideToggle(400);
			});
		}

		// Language Dropdown
		var handleLanguageBarDropdown = function() {
			$('.js-language-trigger').on('click', function() {
				$('.js-language-dropdown').stop(false,false).toggle();
			});
		}

		// Language Push
		var handleLanguagePush = function() {
			$('.language-push-btn').on('click', function() {
				$('.language-push-open').stop(false,false).slideToggle(400);
			});

			$(window).scroll(function(){
				if ($(this).scrollTop() > 1) $('.language-push-open').stop(false,false).slideUp();
			});
		}

		// Team v7 Collapse
		var handleTeamV7 = function() {
			$('.team-v7-collapse').hide();
			$('.team-v7').on('click', function() {
				$(this).find('.team-v7-trigger').toggleClass('is-clicked');
				$(this).find('.team-v7-collapse').stop(false,false).slideToggle(300);
			});
		}

		// var handleTeamV7 = function() {
		//     $('.team-v7-collapse').hide();
		//     $('.team-v7-trigger').on('click', function(event) {
		//         event.preventDefault();

		//         $(this).toggleClass('is-clicked');
		//         $('.team-v7-collapse').slideToggle(300);
		//     });
		// }

		// Footer Toggle Expand
		var handleFooterToggleExpand = function() {
			$('.footer-toggle-collapse').hide();
			$('.footer-toggle-trigger').on('click', function(event) {
				event.preventDefault();

				$(this).toggleClass('is-open');
				$('.footer-toggle-collapse').stop(false,false).slideToggle(500);

				$('html, body').animate({
					scrollTop: $(document).height()
				}, 500);
			});
		}

		// Scroll To Section
		var handleScrollToSection = function() {
			$(function() {
				$("a[href*='#scroll_']:not([href='#scroll_'])").on('click', function() {
					if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {

						var target = $(this.hash);
						target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
						if (target.length) {
							$('html,body').animate({
								scrollTop: target.offset().top - 70
							}, 1000);
							return false;
						}
					}
				});
			});
		}

		// Handle Equal Height Interactive Banner
		var handleEqualIBannerBg = function() {
			$('.equal-height-ib-bg-img').each(function() {
				$(this).css('background-image', 'url(' + $(this).children('img').attr('src') + ')');
				$(this).children('img').hide();
			});
		}

		// Fullheight
		var handleFullheight = function() {
			var WindowHeight = $(window).height(),
				HeaderHeight;

			if ($(document.body).hasClass('promo-top-offset')) {
				HeaderHeight = $('.fullheight-header-offset').height();
			} else {
				HeaderHeight = 0;
			}

			$('.fullheight').css('height', WindowHeight - HeaderHeight);

			$(window).resize(function() {
				var WindowHeight = $(window).height();
				$('.fullheight').css('height', WindowHeight - HeaderHeight);
			});
		}

		// Vertical Center Aligned
		// Note! This works only with promo block and background image via CSS.
		var handleVerticalCenterAligned = function() {
			$('.vertical-center-aligned').each(function() {
				$(this).css('padding-top', $(this).parent().height() / 2 - $(this).height() / 2);
			});
			$(window).resize(function() {
				$('.vertical-center-aligned').each(function() {
					$(this).css('padding-top', $(this).parent().height() / 2 - $(this).height() / 2);
				});
			});
		};

		// Handle Toggle Collapse Box
		var handleToggleCollapseBox = function() {
			$('.theme-toggle-trigger').on('click', function(event) {
				$(this).toggleClass('.theme-toggle-content').hide();
				$(this).toggleClass('is-open').show();
				if( 992 <= $(window).width() ) {
					$('.theme-toggle-content').slideToggle(400);
				}else{
					$('.theme-toggle-content').slideToggle(0);
				}
			});
		};

		// Handle Header Fullscreen Navigation Overlay
		var handleHeaderFullscreenOverlay = function() {
			var overlay = $('.header-fullscreen-nav-bg-overlay'),
				close = $('.header-fullscreen-nav-close'),
				trigger = $('.header-fullscreen-nav-trigger'),
				HeaderNavigation = $('.header-fullscreen-nav-overlay');

			trigger.on('click', function() {
				HeaderNavigation.removeClass('header-fullscreen-nav-overlay-show');
				HeaderNavigation.addClass('header-fullscreen-nav-overlay-show');
			});

			close.on('click', function(e) {
				e.stopPropagation();
				HeaderNavigation.removeClass('header-fullscreen-nav-overlay-show');
			});
		};

		// Handle Search
		var handleSearch = function() {
			var SearchTrigger = $('.search-btn');
			SearchTrigger.on('click', function() {
				SearchTrigger.toggleClass('is-clicked');
				$('.ark-search-field').fadeToggle(400, function(){
					$('.ark-search-field-input').focus();
				});
			});
		}

		// Handle Search Classic
		var handleSearchClassic = function() {
			var SearchTrigger = $('.search-classic-btn');
			SearchTrigger.on('click', function() {
				SearchTrigger.toggleClass('is-clicked');
				$('.search-classic-field').fadeToggle(400, function(){
					$('.search-classic-input').focus();
				});
			});
		}

		// Handle Search Fullscreen
		var handleSearchFullscreen = function() {
			var overlay = $('.search-fullscreen-bg-overlay'),
				close = $('.search-fullscreen-close'),
				trigger = $('.search-fullscreen-trigger'),
				SearchFullscreen = $('.search-fullscreen-overlay');

			trigger.on('click', function() {
				SearchFullscreen.removeClass('search-fullscreen-overlay-show');
				SearchFullscreen.addClass('search-fullscreen-overlay-show');
				window.setTimeout(function(){
					$('.search-fullscreen-input').focus();
				},400);
			});

			close.on('click', function(e) {
				e.stopPropagation();
				SearchFullscreen.removeClass('search-fullscreen-overlay-show');
			});
		}

		// Handle Search On Header
		var handleSearchOnHeader = function() {
			var SearchTrigger = $('.search-on-header-btn');
			SearchTrigger.on('click', function() {
				SearchTrigger.toggleClass('is-clicked');
				$('.search-on-header-field').fadeToggle(400, function(){
					$('.search-on-header-input').focus();
				});
			});
		}

		// Handle Search Push
		var handleSearchPush = function() {
			var SearchPushTrigger = $('.search-push-btn');
			SearchPushTrigger.on('click', function() {
				SearchPushTrigger.toggleClass('is-clicked');
				$('.search-push-open').slideToggle(400,function(){
					$('.search-push-input').focus();
				});
			});

			$(window).scroll(function(){
				if ($(this).scrollTop() > 1) $('.search-push-open').slideUp(); {
					SearchPushTrigger.removeClass('is-clicked');
				};
			});
		}


		// ScrollTo Element Animated Scrolling
		var handleScrollToAnimatedScroll = function() {
			if( 0 < $('.smoothscroll-sharplink').size() ) {
				return;
			}
			$('.ffb-scrollto-link').on('click', function() {
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

		return {
			init: function() {
				handleBootstrapComponents(); // initial setup for bootstrap components
				handleNavbarToggle(); // initial setup for navbar toggle
				handleSidebarMenu(); // initial setup for sidebar menu
				handleServicesV7(); // initial setup for services v7 collapse
				handleWorkV1(); // initial setup for work v1
				handleTopbarTDropdown(); // initial setup for topbar transparent dropdown
				handleTopbarTShoppingDropdown(); // initial setup for topbar transparent shopping dropdown
				handleTopbarEDropdown(); // initial setup for topbar e-commerce dropdown
				handleTopbarEShoppingDropdown(); // initial setup for topbar e-commerce shopping dropdown
				handleLanguageBarDropdown(); // initial setup for language dropdown
				handleLanguagePush(); // initial setup for language piush
				handleTeamV7(); // initial setup for team v7
				handleFooterToggleExpand(); // initial setup for footer toggle expand
				handleScrollToSection(); // initial setup for scroll to section
				handleEqualIBannerBg(); // initial setup for equal height interactive banner
				handleFullheight(); // initial setup for fullheight
				handleVerticalCenterAligned(); // initial setup for vertical center aligned
				handleToggleCollapseBox(); // initial setup for toggle collapse box
				handleHeaderFullscreenOverlay(); // initial setup for header fullscreen navigation overlay
				handleSearch(); // initial setup for search
				handleSearchClassic(); // initial setup for search classic
				handleSearchFullscreen(); // initial setup for search fullscreen
				handleSearchOnHeader(); // initial setup for search on header
				handleSearchPush(); // initial setup for search push
				handleScrollToAnimatedScroll(); // nitial setup for scrollto element
			}
		}
	}();

	$(document).ready(function() {
		App.init();
	});

	$(document).ready(function(){

		/* FF SLIDER */
		$('.ff-slider').each(function() {
			var $slider = $(this);

			if($slider.hasClass('ff-carousel-initialized')){
				return;
			}

			$slider.find('.item').first().addClass('active');
			//slideSpeed
			var sliderData = JSON.parse($(this).attr('data-slider'));
			var interval = 0;
			var hover = '';
			var wrap = sliderData["loop"];


			if(sliderData["auto"]){
				interval = sliderData["speed"];
			}

			if(sliderData["hover"]){
				hover = 'hover';
			}

			$slider.carousel({
				interval: interval,
				pause: hover,
				wrap: wrap,
				slideSpeed: 5000
			});

			$slider.addClass('ff-carousel-initialized carousel');

			/* pri kliknuti na levou sipku pri slidovani zustal predchozi slider (ukazaly se 2 slidy nad sebou), pravy funguje vzdy*/
			var slider_is_stopped = false;
			$slider.find('.left').on('click', function () {
				if(!slider_is_stopped) {
					$slider.find('.right').click();
					slider_is_stopped = true;
				}
			});

			$slider.find('.right').on('click', function () {
				$slider.carousel('pause').removeData();
				$slider.carousel({interval: 0});
			});

			$slider.swipe({
				swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
					if (direction == 'left') $(this).carousel('next');
					if (direction == 'right') $(this).carousel('prev');
				},
				allowPageScroll:"vertical"
			});

		});

	});

})(jQuery);

/*
 * BLOG TIMELINE v1
 */
(function($){

	$(window).load(function(){

		$('.timeline-v3').each(function(){

			var left = 0;
			var right = 0;


			/**
			 * 0 - first left
			 * 1 - first right
			 * 2 - all left
			 * 3 - all right
			 * @type {number}
			 */
			var typeOfOrdering = $(this).attr('data-grid-layout');

			$(this).find('.timeline-v3-list-item').each(function(){
				var $this = $(this);

				if(left <= right) {
					left = left + $this.height();

					if( typeOfOrdering == 1 ) {
						$this.addClass('timeline-v3-right-wing');
					}

				} else {
					right = right + $this.height();

					if( typeOfOrdering == 0 ) {
						$this.addClass('timeline-v3-right-wing');
					}
				}

			});

			if( typeOfOrdering == 3 ) {
				$(this).find('.timeline-v3-list-item').addClass('timeline-v3-right-wing');
			}
		});
	});
})(jQuery);

/*
 * BLOG TIMELINE v2
 */
(function($){

	$(window).load(function(){

		$('.timeline-v4').each(function(){

			var left = 0;
			var right = 0;

			/**
			 * 0 - first left
			 * 1 - first right
			 * 2 - all left
			 * 3 - all right
			 * @type {number}
			 */
			var typeOfOrdering = $(this).attr('data-grid-layout');
			// var typeOfOrdering = 2;

			var addLeftClass = function( $item ) {
				var $innerClass = $item.find('.timeline-v4-panel');

				$innerClass.addClass('timeline-v4-panel-left text-right');
			}

			var addRightClass = function( $item ) {
				var $innerClass = $item.find('.timeline-v4-panel');

				$innerClass.addClass('timeline-v4-panel-right');
				$item.addClass('timeline-v4-right-wing');
			}

			$(this).find('.timeline-v4-list-item').each(function(){
				var $this = $(this);

				if(left <= right) {
					left = left + $this.height();

					if( typeOfOrdering == 0 ) {
						addLeftClass( $this );
					} else if ( typeOfOrdering == 1 ) {
						addRightClass( $this );
					}

				} else {
					right = right + $this.height();

					if( typeOfOrdering == 1 ) {
						addLeftClass( $this );
					} else if ( typeOfOrdering == 0 ) {
						addRightClass( $this );
					}

				}

				if( typeOfOrdering == 2 ) {
					addLeftClass( $this );
				} else if ( typeOfOrdering == 3 ) {
					addRightClass( $this );
				}

			});
		});
	});
})(jQuery);


/*
 * Header
 */
(function($){

	// For scrollspy

	var location_no_hash = document.location.href.split('#')[0];

	if( '/' != location_no_hash.substr(-1) ){
		location_no_hash = location_no_hash + '/';
	}

	var offset_top = 0;

	if( $('.ark-header').size() ) {
		var $header_wrapper = $('.ffb-id-navigation-header');
		offset_top += parseInt($header_wrapper.css('margin-top'));
		if (!$header_wrapper.hasClass('wrapper-top-space')) {
			offset_top += parseInt($('.ark-header').height());
		}
	}
	var animation_offset = parseInt( $('.smoothscroll-sharplink').attr('data-offset') );
	offset_top = offset_top - 23 - animation_offset; // 23 = bulgarian constant

	$('a[href*="#"]').each(function () {
		var $_a = $(this);
		var href = $_a.attr('href');
		var href_no_hash = href.split('#')[0];

		if( $_a.attr('data-toggle') ){
			return;
		}

		if( $_a.attr('aria-controls') ) {
			return;
		}

		if( $_a.attr('data-slide') ) {
			return;
		}


		if ('' != href_no_hash) {
			if ('/' != href_no_hash.substr(-1)) {
				href_no_hash = href_no_hash + '/';
			}
		}
		if (( '' == href_no_hash ) || ( href_no_hash == location_no_hash )) {
			$_a.parents().removeClass('current-menu-item').removeClass('current-menu-ancestor');

			href = '#' + href.split('#')[1].replace(/[^a-z0-9_\-]/gi,'');
			$_a.attr('href', href );

			href = '#' + href.split('#')[1].replace(/[^a-z0-9_\-]/gi,'');
			$_a.attr('href', href );

			$_a.on('click', function (event) {
				var $_target = $(this.hash);
				if ($_target.length) {
					if( $_target.is(':visible') ) {
						if (1 === $('.smoothscroll-sharplink').size()) {
							var animation_speed = parseInt($('.smoothscroll-sharplink').attr('data-speed'));
							var animation_offset = parseInt($('.smoothscroll-sharplink').attr('data-offset'));
							$('html, body').stop(false, false).animate({
								scrollTop: $_target.offset().top - offset_top - animation_offset
							}, animation_speed);

							if( $('header .navbar-collapse.in').size() ){
								$('header .navbar-toggle').click();
							}

							return false;
						}
					}
				}
			});
		}
	});

	var possible_headers = 'header.header, header.header-transparent, header.header-center-aligned, header.header-center-aligned-transparent';

	$(possible_headers).each(function () {

		var $_header = $(this);
		var maybe_one_page_menu = false;

		$_header.find('a[href*=#]').each(function(){
			maybe_one_page_menu = true;
		});

		$(window).load(function() {
			if( maybe_one_page_menu ) {
				$('body').scrollspy({
					target: '.ark-header'
					, offset: offset_top
				});
			}
		});

	});
})(jQuery);


/*
	Header - sub menus that overflow right border of page
*/
(function($){

	var possible_headers = 'header.header, header.header-transparent, header.header-center-aligned, header.header-center-aligned-transparent';

	$(possible_headers).each(function () {

		var window_width = $(window).width();
		$(window).resize(function(){
			window_width = $(window).width();
		});

		var $header = $( this );
		$header.find('ul.nav > li').hover(function(){
			var $li = $( this );
			var $ul = $li.children('ul');
			if( $ul.size() ) {
				var _left = $li.offset().left;
				if( _left + $ul.width() > window_width ){
					$ul.addClass('dropdown-menu-left');
					$ul.find('ul').addClass('dropdown-menu-left');
				}
			}
		});
		$header.find('ul.nav li ul li').hover(function(){
			var $li = $( this );
			var $ul = $li.children('ul');
			if( $ul.size() ) {
				var _left = $li.offset().left + $li.width();
				if( _left + $ul.width() > window_width ){
					$ul.addClass('dropdown-menu-left');
					$ul.css('left', '-' + $ul.width() + 'px');
					$ul.find('ul').each(function(){
						var $sub_ul = $(this);
						$sub_ul.addClass('dropdown-menu-left');
						$sub_ul.css('left', '-' + $sub_ul.width() + 'px');
					})
				}
			}
		});
	});

})(jQuery);

/* IOS iPad / iPhone - Safari bug */
(function($){

	function is_iOS() {

		var iDevices = [
			'iPad Simulator',
			'iPhone Simulator',
			'iPod Simulator',
			'iPad',
			'iPhone',
			'iPod'
		];

		if (!!navigator.platform) {
			while (iDevices.length) {
				if (navigator.platform === iDevices.pop()){ return true; }
			}
		}

		return false;
	}

	if( is_iOS() ){
		$('.ark-header .navbar-nav .menu-item-has-children a.dropdown-toggle').on({'touchstart':function(){
			var $this = $(this);
			var wasOpen = $this.parent().hasClass('open');
			window.setTimeout(function(){
				var isOpenNow = $this.parent().hasClass('open');
				if( wasOpen == isOpenNow ){
					$this.click();
				}
			},300)
		}});
	}

})(jQuery);

/* Woocommerce menu */

(function($){
	$('body').on('click', 'a.shopping-cart-icon-container', function(){
		$('.shopping-cart-wrapper').toggleClass('open');
	});
	$('body').on('click', 'a.menu-cart-close', function(){
		$('.shopping-cart-wrapper').toggleClass('open');
	});
})(jQuery);
