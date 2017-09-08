(function($){
	var Portfolio = function () {
		"use strict";

		// Handle Portfolio
		var handlePortfolio = function () {

			$('.ff-portfolio-columns-js').each(function(index) {
				var $portfolioFull = $(this);
				var $portfolioGrid = $(this).find('.ff-portfolio-grid');
				var jsonAttr = JSON.parse($portfolioFull.attr('data-settings'));
				var customLightboxCounter = '<div class="cbp-popup-lightbox-counter">' + jsonAttr['lightbox-counter'] + '</div>';
				// var customOverlayCounter = '<div class="cbp-popup-singlePage-counter">' + jsonAttr['overlay-counter'] + '</div>';

				$(this).on('click', '.ff-portfolio-item-filter', function(){


					var filterAttribute = $(this).attr('data-filter');

					$portfolioFull.find('.ff-portfolio-filter').children().each(function () {
						var currentFilterAttribute = $(this).attr('data-filter');

						if( filterAttribute == currentFilterAttribute.replace('.','') ) {
							$(this).trigger('click');
						}
					});

					return false;

				});

                var classes = $portfolioFull.attr('class');
                var currentPortfolioId = '';
                $.each( classes.split(' '), function( index, value ) {
                    if( value.indexOf('ffb-id') != -1 ) {
                        currentPortfolioId =  value;
                    }

                });

                $(this).on('click', '.cbp-filter-item', function(){
                    var currentFilter = $(this).attr('data-filter');
                    var hash = currentPortfolioId + '-' + currentFilter;
                    window.location.hash = hash;
                });

                if( window.location.hash.indexOf( currentPortfolioId) != -1 ) {
                    var uncleanHash = window.location.hash;
                    var selectedId = uncleanHash.replace('#' + currentPortfolioId + '-', '');
                    if( jsonAttr['enable-deep-linking'] ) {
                        jsonAttr['default-filter'] = selectedId;
                    }

                }

				// $(this).find('.ff-portfolio-item-filter').on

				setTimeout(function(){ // helps when using site loading overlay, there is a delay and this is a compensation for it


					$portfolioGrid.cubeportfolio({
						filters: $portfolioFull.find('.ff-portfolio-filter'),
						//loadMore: '#portfolio-grid-load-more-button',
						//loadMoreAction: 'click', //auto = infinite scrolling
						layoutMode: jsonAttr['portfolio-type'], //grid,mosaic
						defaultFilter: jsonAttr['default-filter'],
						animationType: jsonAttr['filter-animation'], //typ animace filtru
						gapHorizontal: parseInt(jsonAttr['vertical-gap']), // plugin author made a mistake here...
						gapVertical: parseInt(jsonAttr['horizontal-gap']), // plugin author made a mistake here...
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