(function($) {
	$(document).ready(function() {
		"use strict";

		$('.ff-cform').each(function(){

			var $messages = $(this).find('.ff-contact-messages');
			var $contactForm = $(this);

			var rules = {};
			var messages = {};

			$contactForm.find('input, textarea').each(function(){
				var isRequired = ( $(this).hasClass('contact-form-required') );
				var name = $(this).attr('name');

				rules[ name ] = {};
				rules[ name ]. required = isRequired;

				messages[ name ] = {};
				messages[ name ]. required = $(this).attr('data-required-text');

				if( $(this).attr('data-type') == 'email' ) {
					rules[ name ].email = true;
					messages[ name ].email = $(this).attr('data-required-email-text');
				}

			});

			$contactForm.find('.ff-submit-button-wrapper').click(function () {
				$contactForm.submit();

				return false;
			});

			$(this).validate({
				rules: rules,
				messages: messages,

				submitHandler: function() {

					var serializedContent = $contactForm.serialize();


					var data = {};
					data.formInput = serializedContent;
					data.contactInfo = $contactForm.find('.ff-contact-info').html();

					frslib.ajax.frameworkRequest('contactform-send-ajax-small', null, data, function( response ) {

						console.log( response );

						var result = '';
						if( response == 'true' ) {
							result = $messages.find('.ff-message-send-ok').html();
							$contactForm.find('input, textarea').val('');
							result = '<div class="alert-area-message alert-area-message-success">' + result + '</div>';
						} else {
							result = $messages.find('.ff-message-send-wrong').html();
							result = '<div class="alert-area-message alert-area-message-error">' + result + '</div>';
						}

						$contactForm.find(".alert-area").hide(0).html(result).show(250);

						setTimeout(function(){
							$contactForm.find(".alert-area").hide(250, function(){

								$(this).html('');

							});


						}, 4000);

					});
				}
			});

		});
	});
})(window.jQuery);