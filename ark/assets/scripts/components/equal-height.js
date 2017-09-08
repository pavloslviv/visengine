(function($){
	// Equal Height
	var EqualHeight = function() {
		"use strict";

		// Handle Equal Height
		var handleEqualHeight = function() {
			$(function($) {
				$('.services-v2-equal-height').responsiveEqualHeightGrid();
				$('.services-v3-equal-height').responsiveEqualHeightGrid();
				$('.services-v4-equal-height').responsiveEqualHeightGrid();
				$('.services-v6-equal-height').responsiveEqualHeightGrid();
				$('.services-v8-equal-height').responsiveEqualHeightGrid();
				$('.services-v9-equal-height').responsiveEqualHeightGrid();
				$('.services-v10-equal-height').responsiveEqualHeightGrid();
				$('.services-v11-equal-height').responsiveEqualHeightGrid();
				$('.icon-box-v5-equal-height').responsiveEqualHeightGrid();
				$('.icon-box-v6-equal-height').responsiveEqualHeightGrid();
				$('.contact-us-equal-height').responsiveEqualHeightGrid();
				$('.team-section-equal-height').responsiveEqualHeightGrid();
				$('.news-v11-equal-height').responsiveEqualHeightGrid();
			});
		};

		return {
			init: function() {
				handleEqualHeight(); // initial setup for equal height
			}
		}
	}();

	// One Page Business Equal Height
	var OnePageBEqualHeight = function() {
		"use strict";

		// Handle One Page Business Equal Height
		var handleOnePageBEqualHeight = function() {
			$(function($) {
				$('.op-b-blog-equal-height').responsiveEqualHeightGrid();
			});
		}

		return {
			init: function() {
				handleOnePageBEqualHeight(); // initial setup for one page business equal height
			}
		}
	}();

	// Equal Height
	var LandingEqualHeight = function() {
		"use strict";

		// Handle Landing Equal Height
		var handleLandingEqualHeight = function() {
			$(function($) {
				$('.l-services-v1-equal-height').responsiveEqualHeightGrid();
				$('.l-services-v2-equal-height').responsiveEqualHeightGrid();
				$('.l-pricing-list-v2-equal-height').responsiveEqualHeightGrid();
			});
		}

		return {
			init: function() {
				handleLandingEqualHeight(); // initial setup for landing equal height
			}
		}
	}();

$(document).ready(function() {
	EqualHeight.init();
	OnePageBEqualHeight.init();
	LandingEqualHeight.init();
});
})(jQuery);