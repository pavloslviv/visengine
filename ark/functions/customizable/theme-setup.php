<?php

if( !function_exists('ff_menu_saving') ) {
	function ff_menu_saving(){

		if( defined('ICL_SITEPRESS_VERSION') ){

			// WPML breaks whole script

			return;

		}

		// Main menu item max number fix
		if (ffContainer()->getWPLayer()->is_admin()) {
			if (FALSE !== strpos($_SERVER['REQUEST_URI'], 'nav-menus.php')) {
				ffContainer()->getThemeFrameworkFactory()->getMenuJavascriptSaver()->enableMenuJavascriptSave();
			}
		}
	}
	if ( FF_ARK_ENVIRONMENT_READY ) {
		add_action( 'admin_init', 'ff_menu_saving' );
	}
}
if ( !FF_ARK_ENVIRONMENT_READY ) {
	add_action('the_post', array('ark_Featured_Area', 'addFeaturedAreasHooks'));
}


add_action('post_class', 'ark_post_class');
if( ! function_exists('ark_post_class') ){
	/**
	 * Add post-wrapper class to the classes for the post content wrapper.
	 *
	 * @param array $classes An array of post classes.
	 * @param array $class   An array of additional classes added to the post.
	 * @param int   $post_ID The post ID.
	 * @return array Array of classes.
	 */
	function ark_post_class( $classes, $class = null, $post_ID = null){
		$classes[] = 'post-wrapper';
		return $classes;
	}
}

// Resolve conflict Fresh Performance Cache vs WooCommerce

if( !function_exists('ark_WPML_theme_banned_js_minification') ) {

	function ark_WPML_theme_banned_js_minification( $bannedFiles ) {

		if( !is_array( $bannedFiles ) ) {
			$bannedFiles = array();
		}

		$wc_files_slugs = array(
			'sitepress',
		);

		$bannedFiles = array_merge( $wc_files_slugs, $bannedFiles);

		return( $bannedFiles );
	}

	add_action('ff_performance_cache_banned_js', 'ark_WPML_theme_banned_js_minification');

}