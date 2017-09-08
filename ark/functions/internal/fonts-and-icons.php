<?php

################################################################################
# FONT CSS SELECTORS
################################################################################

add_filter( ffConstActions::FILTER_QUERY_GET_ICON, 'ff_filter_query_get_icon');
function ff_filter_query_get_icon( $value ) {
	$replaced = str_replace('ff-font-awesome4 icon-', 'fa fa-', $value);
	return $replaced;
}

// enable just few fonts.
add_filter( 'ff_fonts', ffConstActions::FILTER_GET_FONTS );
function ff_filter_get_fonts( $fonts ){

	$iconfont = ffThemeOptions::getQuery('iconfont');


	foreach ($fonts as $key => $value) {

		if( 'awesome4' == $key ){
			continue;
		}

		if( 'et-line' == $key ){
			continue;
		}

		if( 'simple line icons' == $key ){
			continue;
		}

		if( 'awesome' == $key ){
			unset( $fonts[$key] );
			continue;
		}

		$_name_ = str_replace(' ', '_', $key );
		if( is_object( $iconfont ) && ! $iconfont->queryExists( $_name_ ) ){
			unset( $fonts[$_name_] );
			continue;
		}

		if( is_object( $iconfont ) &&  $iconfont->get( str_replace(' ', '_', $key ) ) ){
			continue;
		}

		unset( $fonts[$key] );

	}
	return $fonts;
}

/**
 * Gets all available google fonts. In current situation its from slot mode, but it might be in repeatables
 */
if( !function_exists('ff_theme_get_available_google_fonts') ) {
	ffContainer()->getWPLayer()->getHookManager()->addAjaxRequestOwner('theme-get-available-google-fonts', 'ff_theme_get_available_google_fonts');

	function ff_theme_get_available_google_fonts( ffAjaxRequest $ajaxRequest ) {

		$fontArray = array();

		$fontQuery = ffThemeOptions::getQuery('font');
		for($index=1;$index<=5;$index++){
			$custom_font = $fontQuery->get('custom-font-family-'.$index);
			$name  = $custom_font->get('font-name');
			$eot   = $custom_font->get('eot');
			$woff2 = $custom_font->get('woff2');
			$woff  = $custom_font->get('woff');
			$ttf   = $custom_font->get('ttf');
			$svg   = $custom_font->get('svg');
			if( ! empty( $eot ) or ! empty( $woff2 ) or ! empty( $woff ) or ! empty( $ttf ) or ! empty( $svg ) ){
				$fontArray[] = array (
					'name'=> $name,
					'value'=> 'custom-font-family-' . $index
				);
			}
		}


		$google_font_families = array();

		$all_font_selectors = array(
			'body',
			'body-alt' ,
			'code',
			'custom-font-1',
			'custom-font-2',
			'custom-font-3',
			'custom-font-4',
			'custom-font-5',
			'custom-font-6',
			'custom-font-7',
			'custom-font-8',
		);

		// Check if it is google font
		foreach ($all_font_selectors as $font_selector) {
			$font_name = $fontQuery->get($font_selector);
			if (FALSE !== strpos($font_name, ',')) {
				// THIS IS NOT GOOGLE FONT - it is web safe font
				continue;
			}
			if( FALSE !== strpos($font_name, 'custom-font-family-') ){
				// THIS IS NOT GOOGLE FONT - it is custom family font
				continue;
			}
			$google_font_families[$font_name] = $font_name;
		}

		foreach($google_font_families as $font){
			$fontArray[] = array (
				'name'=> str_replace( "'", '', $font ),
				'value'=> $font
			);
		}

		$web_safe_fonts = array(
			"Arial"               => "Arial, Helvetica, sans-serif",
			"Arial Black"         => "'Arial Black', Gadget, sans-serif",
			"Comic Sans MS"       => "'Comic Sans MS', cursive, sans-serif",
			"Courier New"         => "'Courier New', Courier, monospace",
			"Georgia"             => "Georgia, serif",
			"Helvetica"           => "Helvetica, sans-serif",
			"Impact"              => "Impact, Charcoal, sans-serif",
			"Lucida Console"      => "'Lucida Console', Monaco, monospace",
			"Lucida Sans Unicode" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"Palatino Linotype"   => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			"Times New Roman"     => "'Times New Roman', Times, serif",
			"Tahoma"              => "Tahoma, Geneva, sans-serif",
			"Trebuchet MS"        => "'Trebuchet MS', Helvetica, sans-serif",
			"Verdana"             => "Verdana, Geneva, sans-serif",
		);
		foreach($web_safe_fonts  as $title => $value ) {
			$fontArray[] = array (
				'name' => $title,
				'value' => $value
			);
		}

		echo json_encode( $fontArray );
	}
}

