<?php

/**
 * @link http://demo.freshface.net/html/h-ark/HTML/index.html
 * @link http://demo.freshface.net/html/h-ark/HTML/index_business_1.html
 * @link http://demo.freshface.net/html/h-ark/HTML/index_vertical_menu_creative.html
 * @link http://demo.freshface.net/html/h-ark/HTML/index_vertical_menu_one_page.html
 */

function Walker_Nav_Menu_Ark_fallback( $args ){
	echo '<li class="nav-item">';
	echo '<a href="';
	echo get_site_url();
	echo '/wp-admin/nav-menus.php" target="_blank" class="nav-item-child">';
	echo ark_wp_kses(__('No menu selected. Create menu in the WP Admin menu &raquo; Appearance &raquo; Menu.', 'ark'));
	echo '</a>';
	echo '</li>';
}

function ark_render_navigation_fallback(){
	?>
<div class="wrapper wrapper-top-space ff-boxed-wrapper">
	<div class="wrapper-top-space"></div>
	<header class="ark-header header header-sticky navbar-fixed-top">
		<nav class="navbar mega-menu" role="navigation">
			<div class="container">
				<div class="menu-container">
					<div class="navbar-actions">
						<?php
						if( class_exists('WooCommerce') ){
							echo ark_woocommerce_get__cart_menu_item__content();
						}
						?>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
							<span class="sr-only"><?php echo ark_wp_kses( __('Toggle navigation', 'ark') ) ?></span>
							<span class="toggle-icon"></span>
						</button>
					</div>

					<div class="navbar-logo">
						<a class="navbar-logo-wrap" href="<?php echo esc_attr( get_site_url() ); ?>">
							<img
								src="<?php echo get_template_directory_uri().'/assets/img/logo-default.png'; ?>"
								alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
								class="navbar-logo-img navbar-logo-img-normal"
							>
							<img
								src="<?php echo get_template_directory_uri().'/assets/img/logo-default.png'; ?>"
								alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
								class="navbar-logo-img navbar-logo-img-fixed"
							>
							<img
								src="<?php echo get_template_directory_uri().'/assets/img/logo-default.png'; ?>"
								alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
								class="navbar-logo-img navbar-logo-img-mobile"
							>
						</a>
					</div>
				</div>

				<div class="collapse navbar-collapse nav-collapse">
					<div class="menu-container">
						<ul class="nav navbar-nav no-ff">
							<?php
							$locations = get_nav_menu_locations();
							if( isSet( $locations[ 'main-nav' ] ) and ! empty( $locations[ 'main-nav' ]  ) ) {
								$menu_id = $locations['main-nav'];
							}
							if( ! empty($menu_id) ) {
								wp_nav_menu(array(
									'menu' => $menu_id,
									'depth' => 0,
									'container' => false,
									'items_wrap' => '%3$s',
									'fallback_cb' => 'Walker_Nav_Menu_Ark_fallback',
								));
							}else{
								Walker_Nav_Menu_Ark_fallback(null);
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<div class="page-wrapper">
	<?php
}

function ark_navigation(){
	have_posts();
	if( FF_ARK_ENVIRONMENT_READY ){
		ark_render_navigation_framework();
		ark_render_titlebar_framework();
	} else {
		ark_render_navigation_fallback();
	}
}


function ark_render_navigation_framework() {
	$vdm = ffContainer()->getThemeFrameworkFactory()->getSitePreferencesFactory()->getViewDataManager();
	$currentHeader = $vdm->getCurrentHeader();

	if ($currentHeader == 'none') {
		return false;
	}

	$walker = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderShortcodesWalker();
	$shortcodePrinter = $walker->renderSpecificElement('header', $currentHeader->get('options'), 'navigation-header');
	// Escaped Nav
	echo ( $shortcodePrinter );
	$themeBuilderManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
	$themeBuilderManager->addRenderdCssToStack( $walker->getRenderedCss() );
	$themeBuilderManager->addRenderedJsToStack( $walker->getRenderedJs() );


}

function ark_render_titlebar_framework() {
	$vdm = ffContainer()->getThemeFrameworkFactory()->getSitePreferencesFactory()->getViewDataManager();
	$currentTitleBar = $vdm->getCurrentTitleBar();

	if( $currentTitleBar == 'none' ) {
		return false;
	}

	$themebuildermanager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();

	$shortcodes = $currentTitleBar->get('builder');
	$themebuildermanager->render($shortcodes);

	$themebuildermanager->addRenderdCssToStack();
	$themebuildermanager->addRenderedJsToStack();
}


