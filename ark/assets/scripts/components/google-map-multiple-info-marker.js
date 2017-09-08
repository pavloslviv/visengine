jQuery(function($) {

	function initialize() {

		$('.ff-map').each(function (index) {
			var $ffmap = $(this);
			// var lat = $ffmap.attr('data-lat');
			// var long = $ffmap.attr('data-long');
			$ffmap.attr("id","map-"+index);

			var settings = $ffmap.data('ff-settings');



			// Specify features and elements to define styles.
			var styledefault = [{ /* default = no styles */ }];

			var stylemuted = [{
				featureType: "all",
				stylers: [{
					saturation: -80
				}]
			}, {
				featureType: "road.arterial",
				elementType: "geometry",
				stylers: [{
					hue: "#00ffee"
				}, {
					saturation: 50
				}]
			}, {
				featureType: "poi.business",
				elementType: "labels",
				stylers: [{
					visibility: "off"
				}]
			}];

			var currentStyle;
			var styleAttr = $ffmap.attr('data-style');
			if ( 'stylemuted' == styleAttr ){
				currentStyle = stylemuted;
			} else if( styleAttr == 'stylecustom') {
				try {
					currentStyle = JSON.parse( settings.custom_style_json );

					console.log( settings );

				} catch (e ) {
					currentStyle = styledefault;
				}
			}
			else {
				currentStyle = styledefault;
			}

			var gmapSettings = {};
			gmapSettings.mapTypeId = google.maps.MapTypeId.ROADMAP;
			gmapSettings.styles = currentStyle;

			if( settings.zoom_mouse_wheel == 0 ) {
				gmapSettings.scrollwheel = false;
			}

			if( settings.zoom_double_click == 0 ) {
				gmapSettings.disableDoubleClickZoom = true;
			}

			if( settings.draggable == 0 ) {
				gmapSettings.draggable = false;
			}
			if( settings.disable_default_ui == 1 ) {
				gmapSettings.disableDefaultUI = true;
			}







		    var map = new google.maps.Map(document.getElementById('map-'+index), gmapSettings);

		    var infowindow = new google.maps.InfoWindow();

		    var bounds = new google.maps.LatLngBounds();

		    var i;

		    for (i = 1; i <= parseInt($ffmap.attr("data-label-count")); i++){

				var coordinates = $ffmap.attr("data-label-coordinates-"+i);
				coordinates = coordinates.split(';');

				var markerImage = $ffmap.attr("data-label-map-marker-"+i);
				if( markerImage ){
					markerImage = JSON.parse(markerImage);
					markerImage = markerImage.url;
				}else{
					markerImage = null;
				}

		        var marker = new google.maps.Marker({
		            position: new google.maps.LatLng(coordinates[0], coordinates[1]),
		            map: map,
					ffMarkerId: i,
			        icon: markerImage
		        });

		        bounds.extend(marker.position);

		        google.maps.event.addListener(marker, 'click', (function (marker, i) {
		            return function () {
						var markerId = marker.ffMarkerId;
						$ffmap.attr("data-label-text-"+i)
						var labelText = $ffmap.attr("data-label-text-"+markerId);
		                infowindow.setContent(labelText);
		                infowindow.open(map, marker);
		            }
		        })(marker, i));
		    }

		    map.fitBounds(bounds);

		    var listener = google.maps.event.addListener(map, "idle", function () {
		        map.setZoom(parseInt($ffmap.attr('data-zoom')));
		        google.maps.event.removeListener(listener);
		    });

			var TILE_SIZE = 256;


			if( 0 != settings.zoom_mouse_wheel ) {

				$ffmap.children('div').css("pointer-events", "none");

				$ffmap.click(function () {
					$ffmap.children('div').css("pointer-events", "auto");
				});

				$ffmap.mouseleave(function() {
					$ffmap.children('div').css("pointer-events", "none");
				});
			}

		});
	}

	$(window).load(function(){
		setTimeout(function(){initialize();}, 500);
	});

});