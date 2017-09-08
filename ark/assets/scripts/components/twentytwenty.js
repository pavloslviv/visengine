(function($){
	$(window).load(function() {
		$(".ark-twentytwenty").each(function(){
			var $this = $(this);
			var _orientation = $this.attr('data-orientation');
			var _default_offset_pct = parseFloat( $this.attr('data-offset-pct') );
			$this.twentytwenty({
				default_offset_pct: _default_offset_pct
				, orientation: _orientation
			});
		});
	});
})(jQuery);
