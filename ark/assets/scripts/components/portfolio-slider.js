(function($){
	var Portfolio = function () {
		"use strict";

		// Handle Portfolio
		var handlePortfolio = function () {

			$('.ff-portfolio-slider').each(function(index) {
				var $portfolioFull = $(this);
				var $portfolioGrid = $(this).find('.ff-portfolio-grid');
				var jsonAttr = JSON.parse($portfolioFull.attr('data-settings'));
				var customLightboxCounter = '<div class="cbp-popup-lightbox-counter">' + jsonAttr['lightbox-counter'] + '</div>';
				// var customOverlayCounter = '<div class="cbp-popup-singlePage-counter">' + jsonAttr['overlay-counter'] + '</div>';

				setTimeout(function(){ // helps when using site loading overlay, there is a delay and this is a compensation for it
					$portfolioGrid.cubeportfolio({
						layoutMode: 'slider',
						gapHorizontal: 0,
						gapVertical: parseInt(jsonAttr['horizontal-gap']), // plugin author made a mistake here...
						drag: jsonAttr['enable-drag'],
						auto: jsonAttr['enable-auto'],
						autoTimeout: jsonAttr['speed-auto'],
						autoPauseOnHover: jsonAttr['enable-pause'],
						showNavigation: jsonAttr['show-nav'],
						showPagination: jsonAttr['show-pag'],
						rewindNav: jsonAttr['enable-loop'],

						scrollByPage: jsonAttr['scroll-by-page'],
						gridAdjustment: 'responsive',
						mediaQueries: [{
			                width: 1500,
							cols: parseInt(jsonAttr['columns-lg'])
			            }, {
			                width: 1100,
							cols: parseInt(jsonAttr['columns-lg'])
			            }, {
			                width: 800,
							cols: parseInt(jsonAttr['columns-md'])
			            }, {
			                width: 550,
							cols: parseInt(jsonAttr['columns-sm'])
			            }, {
			                width: 320,
							cols: parseInt(jsonAttr['columns-xs'])
			            }],
						caption: ' ',
						displayType: jsonAttr['portfolio-animation'],
						displayTypeSpeed: parseInt(jsonAttr['display-type-speed']),

						// lightbox
						lightboxDelegate: '.cbp-lightbox',
						lightboxGallery: jsonAttr['lightbox-gallery'],
						lightboxTitleSrc: 'data-title',
						lightboxCounter: customLightboxCounter,

						//singlePage
						// singlePageDelegate: '.cbp-singlePage',
						// singlePageDeeplinking: true,
						// singlePageStickyNavigation: true,
						// singlePageCounter: customOverlayCounter,
						// singlePageAnimation: jsonAttr['single-page-animation'],
						// singlePageCallback: function(url, element) {
						// 	// to update singlePage content use the following method: this.updateSinglePage(yourContent)
						// 	var t = this;

						// 	$.ajax({
						// 		url: url,
						// 		type: 'GET',
						// 		dataType: 'html',
						// 		timeout: 20000
						// 	})
						// 		.done(function(result) {
						// 			t.updateSinglePage(result);
						// 		})
						// 		.fail(function() {
						// 			t.updateSinglePage('AJAX Error! Please refresh the page!');
						// 		});
						// }
					});
				}, 100);

			});

		};

		return {
			init: function () {
				handlePortfolio();
			}
		}
	}();

	$(window).load(function () {
		Portfolio.init();

	});
})(jQuery);