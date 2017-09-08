/**
 * Created by thomas on 18.10.16.
 */
(function($){

	$(document).ready(function(){
		var $optionsHolder = $('.ff-options-2-holder');
		var $options = $optionsHolder.find('.ff-options2');

		var initScreen = function(){

			var menuItems = '';
			var hash = window.location.hash.substr(1);

			var counter = 0;

			// console.log( hash );
			// creating menu

			var $originalToolbar = $('.ffb-builder-toolbar-fixed-wrapper');

			$options.find('.ff-collection-content-area').each(function(){
				var name = $(this).attr('data-name');
				var id = frslib.stringToId( name );

				var isActive = (hash == id);
				
				if( counter == 0 && hash == '' ){
					isActive = true;
				}

				var newClass = 'ff-switcher-' + id;
				$(this).addClass( newClass );


				var activeClass = '';
				if( isActive) {
					activeClass = 'ff-one-item-active';
				}

				menuItems += '<div data-item-id="'+id+'" class="ff-one-item '+activeClass+'">';
				menuItems += '<a href="#' + id+'">' + name + '</a>';
				menuItems += '</div>';

				if( isActive ) {
					$(this).css('display', 'block');
				} else {
					$(this).css('display', 'none');
				}

				$(this).append( $originalToolbar.clone() );
				counter++;
			});

			$originalToolbar.remove();

			$('.ff-items-wrapper').html( menuItems );

			$('.ff-items-wrapper').find('.ff-one-item').click(function(){
				var id = $(this).attr('data-item-id');
				var newActiveClass = '.ff-switcher-' + id;

				$('.ff-collection-content-area').css('display', 'none');
				$( newActiveClass ).css('display', 'block');

				$('.ff-one-item').removeClass('ff-one-item-active');
				$(this).addClass('ff-one-item-active');
				// return false;
			});

			$('.ffb-main-save-ajax-btn').click(function(){

				var specification = {
					adminScreenName : 'ThemeOptions',
					adminViewName: 'Default',
					// settings : settings,
				};

				$('.ff-options-2-holder').trigger('ff-get-form-data', function( data ){
					frslib.options2.dataManager.saveColorLibrary();

					frslib.ajax.frameworkRequest( 'ffAdminScreenManager', specification, {action: 'saveOptions', form: data}, function( response ){
						// console.log( response )
						frslib.environment.notificationMamanger.addNotification('success', 'Saved');
					});

					// console.log( data );
					// frslib.ajax.frameworkRequest( 'ffAdminScreenManager', specification, {action: 'saveOptions', form: data}, function( response ){
					// 	console.log( response )
					// });
				});

				return false;

			});

		};

		if( $optionsHolder.hasClass('ff-options-2-holder__init') ) {
			initScreen();
		} else {
			$optionsHolder.on('afterInit', initScreen);
		}
		// alert('sd');
		// console.log( 'hooking');
		// 	$('.ff-options-2-holder').on('afterInit', function(e){

				// alert('ss');

			// });



		// $('.ff-options-2-holder').trigger('afterInit');

	});

})(jQuery);