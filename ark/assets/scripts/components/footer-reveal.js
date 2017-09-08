(function($){
// Footer Reveal
var FooterReveal = function() {
    "use strict";

    // Handle Footer Reveal
    var handleFooterReveal = function() {
        $('body>.wrapper').css('background-color','#ffffff');
        $('.footer-reveal').footerReveal();
    }

    return {
        init: function() {
            handleFooterReveal(); // initial setup for footer reveal
        }
    }
}();

$(document).ready(function() {
    FooterReveal.init();
});
})(jQuery);
