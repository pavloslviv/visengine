(function($){
	$(document).ready(function () {
		$('.ff-piechart').each(function(index) {
			var $pie = $(this);

			$pie.attr("id","circles-"+index);

			if(1 == parseInt($pie.attr('data-chart-type'))){

				if( $pie.attr('data-color-1') ){
					var $color1 = $pie.attr('data-color-1');
				} else {
					var $color1 = '#ffffff';
				}

				if( $pie.attr('data-color-2') ){
					var $color2 = $pie.attr('data-color-2');
				} else {
					var $color2 = 'rgb(0, 188, 212)';
				}

				// Circles 1
				Circles.create({
					id: 'circles-'+index,
					radius: 55,
					value: parseInt($pie.attr('data-value')),
					width: 5,
					textClass: 'circles-text-v1',
					text: function (value) {
						return value + $pie.attr('data-unit');
					},
					colors: [$color1, $color2],
					duration: 1500
				});
			}else{

				if( $pie.attr('data-color-1') ){
					var $color1 = $pie.attr('data-color-1');
				} else {
					var $color1 = 'rgba(0, 188, 212, 0.6)';
				}

				if( $pie.attr('data-color-2') ){
					var $color2 = $pie.attr('data-color-2');
				} else {
					var $color2 = 'rgb(0, 188, 212)';
				}

				// Circles 4
				Circles.create({
					id: 'circles-'+index,
					radius: 65,
					value: parseInt($pie.attr('data-value')),
					width: 65,
					textClass: 'circles-text-v2',
					text: function(value) {
						return value + $pie.attr('data-unit');
					},
					colors: [$color1, $color2],
					duration: 1500
				});
				$pie.find('.circles-text-v2').css('color',$pie.attr('data-text-color'));
			}

		});
	});
})(jQuery);
