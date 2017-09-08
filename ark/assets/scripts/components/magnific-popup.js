(function($){
// Magnific Popup

	window.ffHandleMagnificPopup = function( $parent ) {
		// image popup;
		$parent.find('.image-popup-vertical-fit').each(function(){
			var $opener = $(this);
			var settings = {
				type: 'image',
				closeOnContentClick: true,
				mainClass: 'mfp-img-mobile',
				image: {
					verticalFit: true
				}
			};
			$opener.magnificPopup( settings );
		});

		// lightbox popup
		$parent.find('.freshframework-lightbox-image, .image-popup-up').each(function(){
			var $opener = $(this);
			var settings = {
				type: 'image',
				closeOnContentClick: true,
				mainClass: 'mfp-img-mobile',
				image: {
					verticalFit: true
				}
			};
			if( $opener.attr('data-freshframework-internal-html') ){
				settings.image.markup = $opener.attr('data-freshframework-internal-html');
			}
			$opener.magnificPopup( settings );
		});

		// Popup gallery
		$parent.find('.popup-gallery').each(function(){
			var $opener = $(this);
			var settings = {
				delegate: 'a.popup-gallery-child',
				type: 'image',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
				}
			};
			$opener.magnificPopup( settings );
		});

		// Multiple Galleries with a single popup
		$parent.find('.popup-multiple-image').each(function(){
			var $opener = $(this);
			var settings = {
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				fixedContentPos: true,
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				}
			};
			$opener.magnificPopup( settings );
		});

		// Video iframes
		$parent.find('.freshframework-lightbox-external-video, .popup-youtube, .popup-vimeo').each(function(){
			var $opener = $(this);
			var settings = {
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade mfp-zoom-out-cur',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: true,
				iframe: {}
			};

			if( $opener.attr('data-freshframework-internal-html') ){
				settings.iframe.markup = $opener.attr('data-freshframework-internal-html');
			}

			$opener.magnificPopup( settings );
		});

		// freshframework-internal-video
		$parent.find('.freshframework-internal-html').each(function(){
			var $opener = $(this);
			var settings = {
				items: {
					src: $opener.attr('data-freshframework-internal-html'), // can be a HTML string, jQuery object, or CSS selector
					type: 'inline'
				},
				mainClass: 'freshframework-internal-html-mpf mfp-zoom-out-cur'
			};
			$opener.magnificPopup( settings );
		});

		// Link Block iframes
		$parent.find('.freshframework-lightbox-page, .link-block-open-lightbox').each(function(){
			var $opener = $(this);
			var settings = {
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade mfp-zoom-out-cur',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: true,
				iframe: {}
			};
			if( $opener.attr('data-freshframework-internal-html') ){
				settings.iframe.markup = $opener.attr('data-freshframework-internal-html');
			}
			$opener.magnificPopup( settings );
		});

	};

	$(document).ready(function(){
		ffHandleMagnificPopup( $('body') );
	});
})(jQuery);
