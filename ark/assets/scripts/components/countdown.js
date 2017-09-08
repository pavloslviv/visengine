(function($){
// Countdown
var Countdown = function() {
    "use strict";

    // Handle Countdown
    var handleCountdown = function() {

		$('.ffb-countdown-wrapper').each(function(){
			var settings = JSON.parse( $(this).attr('data-settings') );
			var layout = $(this).find('.ffb-countdown-layout').html();

			// var newYear = new Date();
			// newYear = new Date(newYear.getFullYear() + 1, 1 - 1, 1);

			var countdownDate = new Date( settings.date * 1000 );

			var settingsObject = {};
			settingsObject[ settings.type ] = countdownDate;
			settingsObject.layout = layout;
			settingsObject.format = settings.format;

			$(this).find('.ffb-countdown').countdown(settingsObject);
		});
    };

    return {
        init: function() {
            handleCountdown(); // initial setup for countdown
        }
    }
}();

$(document).ready(function() {
    Countdown.init();
});
})(jQuery);


