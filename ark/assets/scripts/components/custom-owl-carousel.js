(function($) {
	$(window).load(function(){
		"use strict";

		/* FF SLIDER */

		$('.ff-owl-carousel').each(function() {

			var $wholeSlider = $(this);
			
			$wholeSlider.find('.ff-one-owl-carousel').each(function(){
				var $slider =  $(this);

				var sliderData = JSON.parse($($slider).attr('data-slider'));

				var loop = sliderData["loop"];
				if ( 1 == loop ){
					loop = $slider.children().length > 1;
				}

				var autoplay = sliderData["autoplay"];
				var dots = sliderData["dots"];
				var speed = sliderData["speed"];
				var smartSpeed = sliderData['smartSpeed'];
				var autoHeight = sliderData['autoHeight'];


				var $xs = parseInt(sliderData["xs"]);
				var $sm = parseInt(sliderData["sm"]);
				var $md = parseInt(sliderData["md"]);
				var $lg = parseInt(sliderData["lg"]);

				var stagePadding = parseInt(sliderData['stagePadding']);


				$slider.owlCarousel({
					items: $lg,
					loop: loop,
					dots: dots,
    				autoHeight: autoHeight,

					nav: true,
					navText: ['', ''],
					navContainer: '.ff-owl-controls',
					margin: 30,
					autoplay: autoplay,
					smartSpeed: smartSpeed,
					autoplaySpeed: smartSpeed,
					autoplayTimeout: speed,
					stagePadding: stagePadding,
					autoplayHoverPause: true,
					onInitialized: function(){

						var $clonnedItems = $slider.find('.owl-item.cloned');

						if( $clonnedItems.length > 0 ) {
							ffHandleMagnificPopup($clonnedItems);
						}

					},
					responsive: {
						// breakpoint from 0 up 
						0: {
							items: $xs
						},
						// breakpoint from 768 up
						768: {
							items: $sm
						},
						// breakpoint from 992 up
						992: {
							items: $md
						},
						// breakpoint from 1199 up
						1200: {
							items: $lg
						}
					}
				});

				$wholeSlider.find('.ff-owl-controls-item-next').on('click', function () {
					$slider.trigger('next.owl.carousel');
					$slider.trigger('stop.owl.autoplay');
				});

				$wholeSlider.find('.ff-owl-controls-item-prev').on('click', function () {
					$slider.trigger('prev.owl.carousel');
					$slider.trigger('stop.owl.autoplay');
				});

				$wholeSlider.find('.owl-dots').on('click', function() {
					$slider.trigger('stop.owl.autoplay');
				})



			});
		});

	});
})(window.jQuery);
