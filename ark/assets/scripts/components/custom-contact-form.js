(function($) {
	$(document).ready(function() {
		"use strict";

		$('.ff-custom-form').each(function(){
			var $contactForm = $(this);

			// contains translations from element name attr to its real name what will be shown in email
			var nameToTitleMap = {};

			var rules = {};
			var messages = {};

            var customFormSettings = JSON.parse($contactForm.attr('data-custom-form-settings'));

			/*----------------------------------------------------------*/
			/* INITIALIZING NAMES
			/*----------------------------------------------------------*/

			$contactForm.find('.ff-form-input-item').each(function( index ) {
				var $input = $(this);
				var nameAttr = 'ff-contact-input-' + index;
				var inputNameInEmail = $input.attr('data-name');
				var inputType = $input.attr('data-input-type');

				nameToTitleMap[ nameAttr ] = inputNameInEmail;

				switch( inputType ) {
					case 'text':
					case 'textarea':
					case 'select':

						$input.attr('name', nameAttr);

						break;

					case 'checkbox':
						var $shadowInput = $('<input type="hidden" value="[0]">');
						$shadowInput.attr('name', nameAttr);
						$input.before( $shadowInput );
						$input.attr('name', nameAttr);
						break;

					case 'radio':

						$input.find('input').attr('name', nameAttr );

						break;

				}
			});

			/*----------------------------------------------------------*/
			/* INITIALIZING VALIDATION RULES
		 	/*----------------------------------------------------------*/

			$contactForm.find('.ff-form-input-item').each(function( index ) {
				var $input = $(this);
				var nameAttr = 'ff-contact-input-' + index;
				var inputType = $input.attr('data-input-type');

				var elementsWithValidationRules = ['text', 'textarea', 'checkbox'];
				if( elementsWithValidationRules.indexOf( inputType) == -1 ) {
					return;
				}

				var validationRulesJSON = $input.attr('data-validation');
				var validationRules = JSON.parse( validationRulesJSON );

				var message = {};
				var rule = {};



				switch( inputType ) {
					case 'text':
					case 'textarea':
						// console.log( validationRules );
						if( parseInt(validationRules['is-required']) == 1 ) {
							rule.required = true;
							message.required = validationRules['is-required-message'];
						}

						if( parseInt(validationRules['min-length-has']) == 1 ) {
							rule.minlength = parseInt(validationRules['min-length']);
							message.minlength = validationRules['min-length-message'];
						}

						switch( validationRules['validation-type'] ) {
							case 'email':
									rule.email = true;
									message.email = validationRules['validation-message'];
								break;

							case 'number':
									rule.number = true;
									message.number= validationRules['validation-message'];
								break;

							case 'regex':

									// adding custom method containing the regexp
									$.validator.addMethod(
										'regex-'+nameAttr,
										function(value, element, regexp) {
											var re = new RegExp( regexp );
											return this.optional(element) || re.test(value);
										},
										validationRules['validation-message']
									);

									rule['regex-'+nameAttr] = validationRules['validation-type-regex'];
								break;
							
							case 'custom-function':
								var customFunction = validationRules['validation-type-custom-function'];
								customFunction = 'customFunction = function(value, $element, $form){ ' + customFunction + '}';
								customFunction = eval( customFunction );

								$.validator.addMethod(
									'custom-function-'+nameAttr,
									function(value, element) {
										var $form = $(element).parents('form:first');
										return customFunction( value, $(element), $form );
									},
									validationRules['validation-message']
								);

								rule['custom-function-'+nameAttr] = true;

								break;
						}
						break;
					case 'checkbox':

						if( parseInt(validationRules['checkbox-validation']) == 1 ) {
							rule.required = true;
							message.required = validationRules['checkbox-validation-message'];
						}


						break;

				}

				// rules['g-recaptcha-response'].required = true;
				rules[nameAttr] = rule;
				messages[nameAttr] = message;
			});

			var resetContactFormValues = function() {
				$contactForm.find('.ff-form-input-item').each(function( index ) {
					var $input = $(this);
					var nameAttr = 'ff-contact-input-' + index;
					var inputType = $input.attr('data-input-type');



					switch( inputType ) {
						case 'text':
						case 'textarea':
							$input.val('');
							break;

						case 'checkbox':


							if( parseInt($input.attr('data-checked')) == 1 ) {
								$input.attr('checked', 'checked');
								$input.prop('checked', 'checked');
							} else {
								$input.attr('checked', '');
								$input.prop('checked', '');
							}

							break;

						case 'select':
							var originalValue = $input.find('option[selected="selected"]').val();
							$input.val( originalValue );

							break;

						case 'radio':
							$input.find('input').prop('checked', false);
							$input.find('input[data-checked]').prop('checked', true);
							break;

					}

				});
			};

			var $nameToTitleMap = $('<input type="hidden" name="ff-name-to-title-map">');
			$nameToTitleMap.attr('value', JSON.stringify( nameToTitleMap ) );
			$contactForm.append( $nameToTitleMap );

			var validator = $(this).validate({
				rules: rules,

				errorPlacement: function (error, element) {
					if (element.attr('type') == 'checkbox') {
						error.insertAfter($(element).closest('.ff-form-checkbox-wrapper')).hide().show(150);
					} else {
						error.insertAfter($(element)).hide().show(150);
					}
				},

				messages: messages,

				submitHandler: function() {
					if($contactForm.attr('data-trigger')){
						$('body').trigger($contactForm.attr('data-trigger'), [$contactForm]);
						$contactForm.triggerHandler($contactForm.attr('data-trigger'));
					}

					var serializedContent = $contactForm.serialize();

					var data = {};
					data.formInput = serializedContent;
					data.contactInfo = $contactForm.find('.ff-contact-info').html();


					frslib.ajax.frameworkRequest('contactform-send-ajax', null, data, function( response ) {

						console.log( response );

						if( response == 'true' ) {

							resetContactFormValues();

							$contactForm.find('.ff-message-send-ok-duplicate').hide(150, function(){ $(this).remove(); });

							$contactForm.find('.ff-message-send-ok').each(function(){
								var $clonnedMessage = $(this).clone();

								$clonnedMessage.removeClass('ff-message-send-ok').addClass('ff-message-send-ok-duplicate');
								$clonnedMessage.removeClass('hidden');
								$clonnedMessage.css('display', 'none');

								$(this).after( $clonnedMessage );

								$clonnedMessage.toggle(500);

								var hideAfter = $(this).attr('data-hide');

								if( hideAfter != undefined ) {
									hideAfter = parseInt( hideAfter );
									setTimeout(function(){

										$clonnedMessage.hide(500, function(){
											$(this).remove();
										});

									}, hideAfter);
								}

							});

							if($contactForm.attr('data-trigger')){
								$('body').trigger($contactForm.attr('data-trigger') + '-sent-ok', [$contactForm]);
								$contactForm.triggerHandler($contactForm.attr('data-trigger') + '-sent-ok');
							}


                            if( customFormSettings['redirect-to-url-ok'] ) {
                                window.location = customFormSettings['redirect-to-url-ok'];
                            }

						} else {

							$contactForm.find('.ff-message-send-wrong-duplicate').hide(150, function(){ $(this).remove(); });

							$contactForm.find('.ff-message-send-wrong').each(function(){
								var $clonnedMessage = $(this).clone();

								$clonnedMessage.removeClass('ff-message-send-wrong').addClass('ff-message-send-wrong-duplicate');
								$clonnedMessage.removeClass('hidden');
								$clonnedMessage.css('display', 'none');

								$(this).after( $clonnedMessage );

								$clonnedMessage.toggle(500);

								var hideAfter = $(this).attr('data-hide');

								if( hideAfter != undefined ) {
									hideAfter = parseInt( hideAfter );
									setTimeout(function(){

										$clonnedMessage.hide(500, function(){
											$(this).remove();
										});

									}, hideAfter);
								}

							});

							if($contactForm.attr('data-trigger')){
								$('body').trigger($contactForm.attr('data-trigger') + '-sent-wrong', [$contactForm]);
								$contactForm.triggerHandler($contactForm.attr('data-trigger') + '-sent-wrong');
							}

                            if( customFormSettings['redirect-to-url-wrong'] ) {
                                window.location = customFormSettings['redirect-to-url-wrong'];
                            }
						}

					});
				}
			});

			$contactForm.find('.ffb-contact-button-send').on('click', function(){

				var couldBeSend = true;
				$contactForm.find('.ffb-captcha-wrapper').each(function(){
					var $captchaWrapper = $(this);

					var $textarea = $(this).find('.g-recaptcha-response');
					var value = $textarea.val();

					if( value.length == 0 ) {
						couldBeSend = false;

						$captchaWrapper.find('.ff-contact-form-captcha-error').hide().removeClass('hidden').show(150);
					} else {
						couldBeSend = true;

						$captchaWrapper.find('.ff-contact-form-captcha-error').hide(150);
					}

				});


				if( couldBeSend ) {
					$contactForm.submit();
				} else {
					return false;
				}

			});


		});
	});
})(window.jQuery);