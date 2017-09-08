(function($){
// Header Sticky
var HeaderSticky = function() {
	'use strict';

	// Handle Header Sticky
	var handleHeaderSticky = function() {
		if($('.header-sticky').length){
			// On loading, check to see if more than 15px, then add the class
			if ($('.header-sticky').offset().top > 15) {
				$('.header-sticky').addClass('header-shrink');
			}

			// On scrolling, check to see if more than 15px, then add the class
			$(window).on('scroll', function() {
				if ($('.header-sticky').offset().top > 15) {
					$('.header-sticky').addClass('header-shrink');
				} else {
					$('.header-sticky').removeClass('header-shrink');
				}
			});
		}
		if($('.ark-topbar').length){
			var ark_topbar_reinit = function(){
				$('.ark-topbar').each(function(){
					var $this = $(this);
					var hasVisibleWrapper = $this.parent('.ark-topbar-wrapper').is(':visible');
					if( ! hasVisibleWrapper ) {
						$this.parent('.ark-topbar-wrapper').css('height','1px').css('opacity','0').css('display','block');
					}

					var height = $this.height();
					if ($('body').hasClass('admin-bar')) {
						if( 783 <= $(window).width() ) {
							height = height + $('#wpadminbar').height();
						}
					}
					$this.parent('.ark-topbar-wrapper').css('height', height + 'px');
					$('.wrapper-topbar-top-space').css('height', height + 'px');
					$('.wrapper-topbar-top-space-xs').css('height', height + 'px');
					$this.parent('.ark-topbar-wrapper').addClass('ark-topbar-initialized');

					if( ! hasVisibleWrapper ) {
						$this.parent('.ark-topbar-wrapper').css('display','none').css('opacity','1');
					}

				});
			};
			$(document).ready(function(){
				ark_topbar_reinit();
			});
			$(window).load(function(){
				ark_topbar_reinit();
			});
			$(window).resize(function(){
				ark_topbar_reinit();
			});
		}
	};

	return {
		init: function() {
			handleHeaderSticky(); // initial setup for header sticky
		}
	}
}();

$(document).ready(function() {
	HeaderSticky.init();
});
})(jQuery);
