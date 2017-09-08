<?php

if ( is_admin() ) {
	if( !function_exists('ark_plugin_fresh_framework_notification') ) {
		function ark_plugin_fresh_framework_notification() {
			echo '<div class="error"><p>';
			echo ark_wp_kses( __( 'It is strongly recommended to install and activate <strong>Fresh Framework</strong> plugin and <strong>Ark Theme Core Plugin</strong> to use 100% theme options and settings.' , 'ark' ) ) ;
			echo '</p></div>';
		}
		add_action( 'admin_notices', 'ark_plugin_fresh_framework_notification' );
	}
}
