<?php

require get_template_directory() . '/install/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'Ark_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function Ark_theme_register_required_plugins() {
	require get_template_directory() . '/install/pluginVersions.php';

	$frameworkVersion = $versions['fresh-framework'];
	$coreVersion = $versions['ark-core'];

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name' => esc_html( __('Fresh Framework', 'ark' ) ),
			'slug' => 'fresh-framework',
			'version' => $frameworkVersion,
			'source' => get_template_directory() . '/install/zips/fresh-framework.zip',
			'required' => true,
		),
		array(
			'name' => esc_html( __('Ark Theme Core Plugin', 'ark' ) ),
			'slug' => 'ark-core',
			'version' => $coreVersion,
			'source' => get_template_directory() . '/install/zips/ark-core.zip',
			'required' => true,
		),
		array(
			'name' => esc_html( __('Revolution Slider', 'ark' ) ),
			'slug' => 'revslider',
			'version' => '5.4',
			'source' => get_template_directory() . '/install/zips/revslider.zip',
			'required' => false,
		),

		array(
			'name' => esc_html( __('Fresh Performance Cache', 'ark' ) ),
			'slug' => 'fresh-performance-cache',
			'version'=>'1.2.0',
			'source' => get_template_directory() . '/install/zips/fresh-performance-cache.zip',
			'required' => false,
		),

		array(
			'name' => esc_html( __('Fresh Custom Code', 'ark' ) ),
			'slug' => 'fresh-custom-code',
			'version'=>'1.3.2',
			'source' => get_template_directory() . '/install/zips/fresh-custom-code.zip',
			'required' => false,
		),

		array(
			'name' => esc_html( __('Fresh File Editor', 'ark' ) ),
			'slug' => 'fresh-file-editor',
			'version'=>'1.0.1',
			'source' => get_template_directory() . '/install/zips/fresh-file-editor.zip',
			'required' => false,
		),

		array(
			'name' => esc_html( __('Fresh Favicon', 'ark' ) ),
			'slug' => 'fresh-favicon',
			'version'=>'1.1.2',
			'source' => get_template_directory() . '/install/zips/fresh-favicon.zip',
			'required' => false,
		),

		array(
			'name' => esc_html( __('Fresh Menu Item Limit Fix', 'ark' ) ),
			'slug' => 'fresh-menu-item-limit-fix',
			'version'=>'1.0.0',
			'source' => get_template_directory() . '/install/zips/fresh-menu-item-limit-fix.zip',
			'required' => false,
		),


	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}