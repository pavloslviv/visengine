<?php

function ark_theme_options_footer_fallback(){

	$print_this = false;
	$print_this = ( $print_this or is_active_sidebar('sidebar-footer-1') );
	$print_this = ( $print_this or is_active_sidebar('sidebar-footer-2') );
	$print_this = ( $print_this or is_active_sidebar('sidebar-footer-3') );
	$print_this = ( $print_this or is_active_sidebar('sidebar-footer-4') );

	if( ! $print_this ){
		return;
	}

	?>
	<footer class="footer fg-text-light">
		<div class="container">
			<div class="row">
				<?php if( is_active_sidebar('sidebar-footer-1')) { ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="fg-text-light ark-sidebar widget-title-big">
							<?php dynamic_sidebar('sidebar-footer-1'); ?>
						</div>
					</div>
				<?php } ?>
				<?php if( is_active_sidebar('sidebar-footer-2')) { ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="fg-text-light ark-sidebar widget-title-big">
							<?php dynamic_sidebar('sidebar-footer-2'); ?>
						</div>
					</div>
				<?php } ?>
				<div class="clearfix visible-sm-block"></div>
				<?php if( is_active_sidebar('sidebar-footer-3')) { ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="fg-text-light ark-sidebar widget-title-big">
							<?php dynamic_sidebar('sidebar-footer-3'); ?>
						</div>
					</div>
				<?php } ?>
				<?php if( is_active_sidebar('sidebar-footer-4')) { ?>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<div class="fg-text-light ark-sidebar widget-title-big">
							<?php dynamic_sidebar('sidebar-footer-4'); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</footer>
	<?php
}

function ark_footer(){
	if( FF_ARK_ENVIRONMENT_READY ){
		ark_render_footer_framework();
	} else {
		ark_theme_options_footer_fallback();
	}
}


function ark_render_footer_framework() {
	$vdm = ffContainer()->getThemeFrameworkFactory()->getSitePreferencesFactory()->getViewDataManager();
	$currentFooter = $vdm->getCurrentFooter();

	if( $currentFooter == 'none' ) {
		return false;
	}

	$themebuildermanager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();




		// wp_enqueue_script( 'ark-footer-reveal');






	$shortcodes = $currentFooter->get('builder');
	// echo '<div class="footer-reveal-spacer"></div>';
	// echo '<div class="ark-footer-reveal-wrapper footer-reveal">';
		$themebuildermanager->render($shortcodes);
	// echo '</div>';

	$themebuildermanager->addRenderdCssToStack();
	$themebuildermanager->addRenderedJsToStack();

}