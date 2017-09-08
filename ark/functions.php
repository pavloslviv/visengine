<?php

/**
 * Welcome to "ark" theme!
 *
 * thank you for purchasing. This is a functions.php file. Here you can find any
 * theme specific functions ( for example custom post types and
 * other things ). Most of the other functions are located in our plugin
 * Fresh Framework, which has to be activated in order to run this template
 * without any problems.
 *
 */

if( defined('FF_FRAMEWORK_PLUGIN_ACTIVE') && FF_FRAMEWORK_PLUGIN_ACTIVE == true && defined('FF_ARK_CORE_PLUGIN_ACTIVE') && FF_ARK_CORE_PLUGIN_ACTIVE == true ) {
	define('FF_ARK_ENVIRONMENT_READY', true);
} else {
	define('FF_ARK_ENVIRONMENT_READY', false);
}

define('FF_ARK_THEME_VERSION', '1.19.0');

if( !function_exists('ark_environment_check') ) {
	function ark_environment_check() {
		$requiredPhpVersion = '5.4';
		$currentPhpVersion = phpversion();

		if( version_compare( $requiredPhpVersion, $currentPhpVersion, '<=') == false ) {
			if( is_admin() ) {
				add_action( 'admin_notices', 'ark_low_php_version' );
			} else {
				echo '<div style="padding-top:80px; font-size:25px; max-width:980px; margin: 0 auto;">';
					echo '<p><strong style="font-size:35px;">You need PHP 5.4 and higher version to run The Ark properly</strong></p>';
					echo '<p>Your version is: ' . phpversion() . '</p>';
					echo '<p>Currently, 99% of servers offer 5.4 version of PHP or higher';
					echo '<br><br>';
					echo '<p>You have these options:</p>';
					echo '<p>- contact your hosting support and ask them about upgrading the PHP version</p>';
					echo '<p>- update your PHP version by yourself, in your hosting interface (cPanel, etc)</p>';
					echo '<p>- update your PHP version by yourself, php.ini</p>';
					echo '<br><br>';
					echo '<p>If you struggle with anything, ask for help here:<p>';
					echo '<p>- <a href="http://support.freshface.net/forums/forum/community-forums/ark/">Support Forum</a></p>';
					echo '<p>- <a href="https://www.facebook.com/groups/1827105637579063/">Facebook Group</a></p>';
				echo '</div>';
				die();
			}

		}
	}
	ark_environment_check();

	function ark_low_php_version() {
		echo '<div class="error"><p>';
//		$message = '<strong>You need PHP 5.4+ version</strong> to run The Ark <a target="_blank" href="'.get_home_url().'">More Info</a>';
		echo '</p></div>';
		$string = __(  '<strong>You need PHP 5.4+ version</strong> to run The Ark <a target="_blank" href="%%%">More Info</a>', 'ark' );
		$string = str_replace( '%%%', get_home_url(), $string);
		echo ark_wp_kses(
			$string
		) ;
	}
}

if( ! function_exists('ark_wp_kses') ) {
	/**
	 * Theme global escaping function
	 *
	 * @param $html string
	 * @return string
	 */
	function ark_wp_kses( $html ){
		// Static variable, but we want to call this function just once
		static $allowed_html = null;
		if( empty($allowed_html) ){
			$allowed_html = wp_kses_allowed_html('post');
		}
		return wp_kses( $html, $allowed_html );
	}
}

// Filter, that strips evil scripts from comments
add_filter('comment_text', 'ark_wp_kses');

// TGM plugin installer
if( is_admin() ) {
	require get_template_directory() . '/install/install-plugins-by-tgm.php';
}


if ( ! function_exists( 'ark_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own ark_setup() function to override in a child theme.
	 */
	function ark_setup(){

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ark, use a find and replace
		 * to change 'ark' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'ark', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-nav' => __( 'Main Navigation', 'ark' ),
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'gallery',
			'image',
			'quote',
			'video',
			'audio',
		) );

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Woocommerce lightbox / zoom & stuff
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
add_action( 'after_setup_theme', 'ark_setup' );

if( ! function_exists('ark_widgets_init') ) {
	/**
	 * Registers a widget area.
	 */
	function ark_widgets_init() {

		register_sidebar(array(
			'name' => ark_wp_kses(__('Content Sidebar', 'ark')),
			'id' => 'sidebar-content',
			'before_widget' => '<div id="%1$s" class="widget ffb-widget %2$s"><div class="blog-sidebar widget-body">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widget-title ffb-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => ark_wp_kses(__('Content Sidebar 2', 'ark')),
			'id' => 'sidebar-content-2',
			'before_widget' => '<div id="%1$s" class="widget ffb-widget %2$s"><div class="blog-sidebar widget-body">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widget-title ffb-widget-title">',
			'after_title' => '</h4>'
		));

		if (class_exists('WooCommerce')) {
			register_sidebar(array(
				'name' => 'Shop Sidebar',
				'id' => 'shop-sidebar',
				'before_widget' => '<div id="%1$s" class="widget ffb-widget %2$s"><div class="blog-sidebar widget-body">',
				'after_widget' => '</div></div>',
				'before_title' => '<h4 class="widget-title ffb-widget-title">',
				'after_title' => '</h4>'
			));
		}

		for ($i = 1; $i <= 4; $i++) {
			register_sidebar(array(
				'name' => ark_wp_kses(__('Footer Sidebar', 'ark')) . ' #' . $i,
				'id' => 'sidebar-footer-' . $i,
				'before_widget' => '<div id="%1$s" class="widget ffb-widget %2$s"><div class="widget-body">',
				'after_widget' => '</div></div>',
				'before_title' => '<h3 class="footer-title widget-title ffb-widget-title">',
				'after_title' => '</h3>'
			));
		}

		if (class_exists('ffSidebarManager')) {
			$sidebarsThemeOptions = ffSidebarManager::getQuery('sidebars');
			if( !empty($sidebarsThemeOptions) ) {
				foreach ($sidebarsThemeOptions->get('sidebars') as $key => $sidebar) {
					register_sidebar(array(
						'name' => strip_tags($sidebar->get('title')),
						'id' => 'ark-custom-sidebar-' . sanitize_title($sidebar->get('slug')),
						'description' => strip_tags($sidebar->get('description')),
						'before_widget' => '<div id="%1$s" class="widget ffb-widget %2$s"><div class="blog-sidebar widget-body">',
						'after_widget' => '</div></div>',
						'before_title' => '<h4 class="widget-title ffb-widget-title">',
						'after_title' => '</h4>'
					));
				}
			}
		}
	}

}
add_action( 'widgets_init', 'ark_widgets_init' );


if( ! function_exists('ark_content_width') ) {
	/**
	 * Sets the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function ark_content_width() {
		$GLOBALS['content_width'] = apply_filters('ark_content_width', 1140);
	}
}
add_action( 'after_setup_theme', 'ark_content_width', 0 );

if( FF_ARK_ENVIRONMENT_READY && is_admin() && get_option('ff-ark-first-run') != 'noxt' ) {

	$adminUrl = get_admin_url(null, 'admin.php?page=Dashboard');
	update_option('ff-ark-first-run', 'noxt');
	header('Location: ' . $adminUrl  );
//	var_dump( $adminUrl );
//	die();
}

/**********************************************************************************************************************/
/* JAVASCRIPT INCLUDING
/**********************************************************************************************************************/
if( ! function_exists('ark_register_scripts') ) {
	add_action('wp_enqueue_scripts', 'ark_register_scripts');
	/**
	 * Enqueues scripts.
	 */
	function ark_register_scripts() {
		wp_enqueue_script( 'jquery-effects-core');

		if ( FF_ARK_ENVIRONMENT_READY ) {
			ffContainer()->getFrameworkScriptLoader()->requireFrsLib();
		} else{
			wp_enqueue_script( 'ark-no-ff', get_template_directory_uri() . '/no-ff/no-ff.js', array('jquery'), null, true);
		}


		// [if lt IE 9] - internet explorer fallback
		wp_enqueue_script( 'ie_html5shiv', get_template_directory_uri() . '/assets/plugins/html5shiv.js', null, '3.7.3');
		wp_script_add_data( 'ie_html5shiv', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'respond', get_template_directory_uri() . '/assets/plugins/respond.min.js', null, '1.1.0');
		wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );


		// Bootstrap
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.6', true);

		// touchSwipe
		wp_enqueue_script( 'touch-swipe', get_template_directory_uri() . '/assets/plugins/jquery.touchSwipe.min.js', array('jquery'), false, true);

		// Comments
		if( is_singular() and comments_open() and ( 0 < get_comments_number()) ) {
			wp_enqueue_script( 'comment-reply' );
		}


		// Scroll top button - enabled by default
		if( ! class_exists('ffThemeOptions') or  ffThemeOptions::getQuery('layout enable-scrolltop') ){
			wp_enqueue_script('ark-jquery.back-to-top', get_template_directory_uri() . '/assets/plugins/jquery.back-to-top.js', array('jquery'), false, true);
		}


		// Smooth scroll script - disabled by default
		if( FF_ARK_ENVIRONMENT_READY ) {
			if ( ffThemeOptions::getQuery('layout enable-smoothscroll') ) {
				wp_enqueue_script('jquery.smooth-scroll', get_template_directory_uri() . '/assets/plugins/jquery.smooth-scroll.js', array('jquery'), '1.2.1', true);
			}
		}


		// Pre-loader - disabled by default
		if( FF_ARK_ENVIRONMENT_READY && ffThemeOptions::getQuery('layout enable-pageloader' ) ) {
			wp_enqueue_script( 'jquery.animsition', get_template_directory_uri() . '/assets/plugins/jquery.animsition.min.js', array('jquery'), '4.0.1', true);
			wp_enqueue_script( 'ark-animsition', get_template_directory_uri() . '/assets/scripts/components/animsition.js', array('jquery.animsition'), false, true);
		}


		// You need Google API key to include this script
		$g_api_key = '';
		if( FF_ARK_ENVIRONMENT_READY ) {
			$g_api_key = ffThemeOptions::getQuery('gapi key');
		}
		if( !empty($g_api_key) ){
			// May be enqueued in el Map
			wp_register_script( 'maps.googleapis.com', '//maps.googleapis.com/maps/api/js?v=3&key='.esc_attr($g_api_key).'', null, false, true );
			wp_register_script( 'ark-google-map.js', get_template_directory_uri() . '/assets/plugins/google-map.js', array('jquery','maps.googleapis.com'), '0.4.21', true );
			wp_register_script( 'ark-google-map-multiple-info-marker', get_template_directory_uri() . '/assets/scripts/components/google-map-multiple-info-marker.js', array('ark-google-map.js'), false, true );
		}


		// Contact forms
		wp_register_script( 'recaptcha', '//www.google.com/recaptcha/api.js', null, false, true);
		wp_register_script( 'jquery.validate', get_template_directory_uri() . '/assets/plugins/validation/jquery.validate.min.js', array('jquery'), '1.14.0', true);
		wp_register_script( 'jquery.validate.additional', get_template_directory_uri() . '/assets/plugins/validation/additional-methods.min.js', array('jquery.validate'), '1.14.0', true);

		// May be included in el Contact Form1
		wp_register_script( 'ark-contact-form', get_template_directory_uri() . '/assets/scripts/components/contact-form.js', array('jquery.validate.additional', 'recaptcha' ), false, true);

		// May be included in el Contact Form Wrapper
		wp_register_script( 'ark-custom-contact-form', get_template_directory_uri() . '/assets/scripts/components/custom-contact-form.js', array('jquery.validate.additional' ), false, true);


		// May be included everywhere
		wp_enqueue_script( 'jquery.magnific-popup', get_template_directory_uri() . '/assets/plugins/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), false, true);
		wp_enqueue_script( 'ark-magnific-popup', get_template_directory_uri() . '/assets/scripts/components/magnific-popup.js', null, false, true);


		/*
		 * Progress bar
		 * May be included in Progress Bar 1+2+3, Team 3+5
		 */
		wp_register_script( 'jquery.appear', get_template_directory_uri() . '/assets/plugins/jquery.appear.js', array('jquery'), '1.0', true);
		wp_register_script( 'ark-progress-bar', get_template_directory_uri() . '/assets/scripts/components/progress-bar.js', array('jquery.appear'), false, true);


		/*
		 * Countdown
		 * May be included in el Countdown
		 */
		wp_register_script( 'jquery.countdown', get_template_directory_uri() . '/assets/plugins/jquery.countdown.js', array('jquery'), '1.6.2', true);
		wp_register_script( 'ark-countdown', get_template_directory_uri() . '/assets/scripts/components/countdown.js', array('jquery.countdown'), false, true);


		/*
		 * Animated headline
		 * May be included in el Animated Heading 1+2
		 */
		wp_register_script( 'ark-animated-headline', get_template_directory_uri() . '/assets/scripts/components/animated-headline.js', array('jquery'), false, true);


		// For Get in touch in Menu
		wp_enqueue_script( 'ark-form-modal', get_template_directory_uri() . '/assets/scripts/components/form-modal.js', array('jquery'), false, true);


		/*
		 * Counter
		 * May be included in el Counters 1-6
		 */
		wp_register_script( 'waypoints', get_template_directory_uri() . '/assets/plugins/counter/waypoints.min.js', array('jquery'), '2.0.4', true);
		wp_register_script( 'jquery.counterup', get_template_directory_uri() . '/assets/plugins/counter/jquery.counterup.min.js', array( 'waypoints', 'jquery'), '1.0', true);
		wp_register_script( 'ark-counters', get_template_directory_uri() . '/assets/scripts/components/counters.js', array('jquery.counterup'), false, true);


		/*
		 * Scroll bar wrapper
		 * May be included in the Vertical Menu and Ark custom Widgets
		 */
		wp_register_script( 'jquery.mCustomScrollbar.concat', get_template_directory_uri() . '/assets/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '3.1.12', true);
		wp_register_script( 'ark-scrollbar', get_template_directory_uri() . '/assets/scripts/components/scrollbar.js', array('jquery.mCustomScrollbar.concat'), false, true);


		/*
		 * Animations
		 * May be included everywhere
		 */
		wp_register_script( 'jquery.wow', get_template_directory_uri() . '/assets/plugins/jquery.wow.min.js', array('jquery'), '1.0.1', true);
		wp_enqueue_script( 'ark-wow', get_template_directory_uri() . '/assets/scripts/components/wow.js', array('jquery.wow'), false, true);


		/*
		 * Carousel
		 * Is included everywhere
		 */
		wp_enqueue_script( 'jquery.imagesloaded', get_template_directory_uri() . '/assets/plugins/jquery.imagesloaded.pkgd.min.js', array('jquery'), '3.2.0', true);
		wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/plugins/owl-carousel/owl.carousel.min.js', array('jquery', 'jquery.imagesloaded'), '1.3.2', true);
		wp_enqueue_script( 'ark-carousel', get_template_directory_uri() . '/assets/scripts/components/owl-carousel.js', array('owl.carousel'), false, true);
		wp_register_script( 'ark-custom-owl-carousel', get_template_directory_uri() . '/assets/scripts/components/custom-owl-carousel.js', array('owl.carousel'), false, true);


		/*
		 * Pie chart script
		 * Used in Circle 1+2
		 */
		wp_register_script( 'circles', get_template_directory_uri() . '/assets/plugins/circles-master/circles.min.js', null, false, true);
		wp_register_script( 'ark-pie-charts', get_template_directory_uri() . '/assets/scripts/components/piecharts.js', array('jquery', 'circles'), false, true);


		// Pricing list 7
		wp_register_script( 'ark-pricing-list-7' , get_template_directory_uri() . '/assets/scripts/components/landing.js', null, false, true);


		// Portfolio Scripts
		wp_register_script( 'jquery.cubeportfolio', get_template_directory_uri() . '/assets/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js', array('jquery'), '3.6.0', true);
		wp_register_script( 'ark-portfolio', get_template_directory_uri() . '/assets/scripts/components/portfolio.js', array('jquery','jquery.cubeportfolio'), false, true);
		wp_register_script( 'ark-portfolio-slider', get_template_directory_uri() . '/assets/scripts/components/portfolio-slider.js', array('jquery','jquery.cubeportfolio'), false, true);


		// Blog Masonry
		wp_register_script( 'jquery.masonry', get_template_directory_uri() . '/assets/plugins/jquery.masonry.pkgd.min.js', array('jquery'), '3.3.1', true);
		wp_register_script( 'ark-masonry', get_template_directory_uri() . '/assets/scripts/components/masonry.js', array('jquery','jquery.masonry'), false, true);


		// Equal height script
		wp_register_script( 'jquery.equal-height', get_template_directory_uri() . '/assets/plugins/jquery.equal-height.js', array('jquery'), '1.0', true);
		wp_register_script( 'ark-equal-height', get_template_directory_uri() . '/assets/scripts/components/equal-height.js', array('jquery.equal-height'), false, true);


		// Page header
		// special case "Static Position with animation" and header class: navbar-fixed-top auto-hiding-navbar
		wp_enqueue_script( 'auto-hiding-navbar', get_template_directory_uri() . '/assets/scripts/components/auto-hiding-navbar.js', null, false, true);
		wp_register_script( 'ark-header-vertical-dropdown-toggle', get_template_directory_uri() . '/assets/scripts/components/header-vertical-dropdown-toggle.js', null, false, true);
		wp_register_script( 'ark-header-section-scroll', get_template_directory_uri() . '/assets/scripts/components/header-section-scroll.js', null, false, true);
		wp_register_script( 'ark-header-fullscreen', get_template_directory_uri() . '/assets/scripts/components/header-fullscreen.js', null, false, true);
		wp_enqueue_script( 'header-sticky', get_template_directory_uri() . '/assets/scripts/components/header-sticky.js', null, false, true);

		// Page Footer
		wp_register_script( 'ark-jquery-footer-reveal', get_template_directory_uri() . '/assets/plugins/jquery.footer-reveal.js', array('jquery'), false, true);
		wp_register_script( 'ark-footer-reveal', get_template_directory_uri() . '/assets/scripts/components/footer-reveal.js', array('ark-jquery-footer-reveal'), false, true);


		// TwentyTwenty
		wp_register_script( 'jquery.event.move', get_template_directory_uri() . '/assets/plugins/twentytwenty/js/jquery.event.move.js', array('jquery'), '1.3.6', true);
		wp_register_script( 'jquery.twentytwenty', get_template_directory_uri() . '/assets/plugins/twentytwenty/js/jquery.twentytwenty.js', array('jquery.event.move'), false, true);
		wp_register_script( 'ark-twentytwenty', get_template_directory_uri() . '/assets/scripts/components/twentytwenty.js', array('jquery.twentytwenty'), false, true);


	}
}

if( ! function_exists('ark_register_main_app_script') ) {
	add_action('wp_footer', 'ark_register_main_app_script');
	/**
	 * Enqueues scripts.
	 */
	function ark_register_main_app_script() {

		// Others scripts
		wp_enqueue_script( 'ark-app', get_template_directory_uri() . '/assets/scripts/app.js', array('jquery'), false, true);

	}

}

if( !function_exists('ark_get_custom_color_css_url') ) {
	function ark_get_custom_color_css_url() {
		if( FF_ARK_ENVIRONMENT_READY ) {
			$colorLibrary = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderColorLibrary();
			$color1 = $colorLibrary->getColor(1);
			$color2 = $colorLibrary->getColor(2);

			$colorFilePath = get_template_directory() .'/assets/css/colors.css';
			$color1Old = '#00bcd4';
			$color2Old = 'rgba(0, 188, 212, 0.7)';

			$colorFileContent = ffContainer()->getFileSystem()->getContents( $colorFilePath );
			$colorFileContent = str_replace($color1Old, $color1, $colorFileContent );
			$colorFileContent = str_replace($color2Old, $color2, $colorFileContent );

			$dataStorageCache = ffContainer()->getDataStorageCache();

			$dataStorageCache->setOption('css', 'colors', $colorFileContent, 'css');

			$url = $dataStorageCache->getOptionUrl('css', 'colors', 'css');

			return $url;
		} else {
			return get_template_directory_uri().'/assets/css/colors.css';
		}

	}
}

/**********************************************************************************************************************/
/* STYLESHEET INCLUDING
/**********************************************************************************************************************/

if( ! function_exists('ark_register_styles') ) {
	add_action('wp_enqueue_scripts', 'ark_register_styles');
	/**
	 * Enqueues styles.
	 */
	function ark_register_styles() {

		// Bootstrap
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/css/bootstrap.min.css', array(), '3.3.6' );

		// Theme javascript plugins
		wp_enqueue_style('jquery.mCustomScrollbar', get_template_directory_uri() . '/assets/plugins/scrollbar/jquery.mCustomScrollbar.css', array(), '3.1.12' );
		wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/assets/plugins/owl-carousel/assets/owl.carousel.css', array(), '1.3.2' );
		wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.5.1' );
		wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/plugins/magnific-popup/magnific-popup.css', array(), '1.1.0' );
		wp_enqueue_style('cubeportfolio', get_template_directory_uri() . '/assets/plugins/cubeportfolio/css/cubeportfolio.min.css', array(), '3.8.0' );

		// Icon Fonts
		if ( FF_ARK_ENVIRONMENT_READY ) {
			ark_wp_enqueue_framework_icon_fonts_styles();
		}else{
			wp_enqueue_style('ark-modified-font-awesome', get_template_directory_uri() . '/no-ff/iconfonts/ff-font-awesome4/ff-font-awesome4.css' );
			wp_enqueue_style('ark-modified-font-et-line', get_template_directory_uri() . '/no-ff/iconfonts/ff-font-et-line/ff-font-et-line.css' );
		}

		// Theme Styles
		wp_enqueue_style('ark-one-page-business', get_template_directory_uri() . '/assets/css/one-page-business.css' );
		wp_enqueue_style('ark-landing', get_template_directory_uri() . '/assets/css/landing.css' );
		wp_enqueue_style('ark-style', get_stylesheet_uri() ); // Proper way to enqueue style.css

		if ( FF_ARK_ENVIRONMENT_READY ) {
			ark_wp_enqueue_theme_google_fonts_styles();
		}else{
			wp_enqueue_style( 'ark-fonts', ark_fonts_url(), array(), null );
			wp_enqueue_style( 'ark-fonts-family', get_template_directory_uri() . '/no-ff/no-ff-fonts.css' );
		}

		if( class_exists('WooCommerce') ) {
			wp_enqueue_style('ark-woocommerce', get_template_directory_uri() . '/woocommerce/woocommerce.css');
		}
		$url = ark_get_custom_color_css_url();
		wp_enqueue_style('ark-colors', $url );

		//newheaderheight
		//wp_enqueue_style('newheaderheight', get_template_directory_uri() . '/newheaderheight.php');

		// TwentyTwenty
		wp_enqueue_style('twentytwenty', get_template_directory_uri() . '/assets/plugins/twentytwenty/css/twentytwenty.css', array() );
	}
}


if ( ! function_exists( 'ark_fonts_url' ) ) {
	/**
	 * Register Google fonts for Twenty Sixteen.
	 *
	 * Create your own ark_fonts_url() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function ark_fonts_url(){
		$fonts_url = '';
		$fonts = array();
		$subsets = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x('on', 'Roboto font: on or off', 'ark')) {
			$fonts[] = 'Roboto:300,400,500,600,700,300italic,400italic,700italic';
		}

		/* translators: If there are characters in your language that are not supported by Droid Serif, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x('on', 'Droid Serif font: on or off', 'ark')) {
			$fonts[] = 'Droid Serif:300,400,700,400italic,700italic';
		}

		if ($fonts) {
			$fonts_url = add_query_arg(array(
				'family' => urlencode(implode('|', $fonts)),
				'subset' => urlencode($subsets),
			), 'https://fonts.googleapis.com/css');
		}

		return $fonts_url;
	}
}



if( ! function_exists( 'ark_wp_enqueue_framework_icon_fonts_styles') ) {
	function ark_wp_enqueue_framework_icon_fonts_styles() {

		$framework_url = ffContainer()->getWPLayer()->getFrameworkUrl();

		if( 0 === strpos( $framework_url, 'https://' ) ){
			$framework_url = $framework_url . '//';
		}

		wp_enqueue_style('freshframework-font-awesome4', $framework_url . 'framework/extern/iconfonts/ff-font-awesome4/ff-font-awesome4.css' );
		wp_enqueue_style('freshframework-font-et-line', $framework_url . 'framework/extern/iconfonts/ff-font-et-line/ff-font-et-line.css' );
		wp_enqueue_style('freshframework-simple-line-icons', $framework_url . 'framework/extern/iconfonts/ff-font-simple-line-icons/ff-font-simple-line-icons.css' );

		$iconfont_types = array(
			'brandico'    => 'framework/extern/iconfonts/ff-font-brandico/ff-font-brandico.css',
			'elusive'     => 'framework/extern/iconfonts/ff-font-elusive/ff-font-elusive.css',
			'entypo'      => 'framework/extern/iconfonts/ff-font-entypo/ff-font-entypo.css',
			'fontelico'   => 'framework/extern/iconfonts/ff-font-fontelico/ff-font-fontelico.css',
			'iconic'      => 'framework/extern/iconfonts/ff-font-iconic/ff-font-iconic.css',
			'linecons'    => 'framework/extern/iconfonts/ff-font-linecons/ff-font-linecons.css',
			'maki'        => 'framework/extern/iconfonts/ff-font-maki/ff-font-maki.css',
			'meteocons'   => 'framework/extern/iconfonts/ff-font-meteocons/ff-font-meteocons.css',
			'mfglabs'     => 'framework/extern/iconfonts/ff-font-mfglabs/ff-font-mfglabs.css',
			'modernpics'  => 'framework/extern/iconfonts/ff-font-modernpics/ff-font-modernpics.css',
			'typicons'    => 'framework/extern/iconfonts/ff-font-typicons/ff-font-typicons.css',
			'weathercons' => 'framework/extern/iconfonts/ff-font-weathercons/ff-font-weathercons.css',
			'websymbols'  => 'framework/extern/iconfonts/ff-font-websymbols/ff-font-websymbols.css',
			'zocial'      => 'framework/extern/iconfonts/ff-font-zocial/ff-font-zocial.css',
		);

		$iconfontQuery = ffThemeOptions::getQuery('iconfont');
		foreach ($iconfont_types as $name => $path) {
			if( $iconfontQuery == null ) {
				continue;
			}
			if( $iconfontQuery->get( str_replace(' ', '_', $name) ) ){
				wp_enqueue_style('freshframework-' . str_replace(' ', '_', $name), $framework_url . $path );
			}
		}

		$index = 1;

		$custom_icon_fonts_query = ffThemeOptions::getQuery('iconfont');
		if (  is_object($custom_icon_fonts_query) &&$custom_icon_fonts_query->exists('custom-icon-fonts') ){
			$custom_icon_fonts = ffThemeOptions::getQuery('iconfont custom-icon-fonts');
			foreach( $custom_icon_fonts as $iconfont ){
				$slug = 'custom-icon-font-'.$index.'-'.sanitize_title( $iconfont->get('slug') );
				$path = trim( $iconfont->get('path') );
				if( empty($path) ){
					continue;
				}
				$path = get_site_url() . '/' . $path;
				wp_enqueue_style( $slug, $path );
				$index ++;
			}
		}
	}
}

if( ! function_exists('ark_add_font_files') ){
	add_filter( 'ff_font_files', 'ark_add_font_files' );
	function ark_add_font_files( $fonts ){
		$index = 1;

		$custom_icon_fonts_query = ffThemeOptions::getQuery('iconfont');
		if ( is_object($custom_icon_fonts_query) && $custom_icon_fonts_query->exists('custom-icon-fonts') ){
			$custom_icon_fonts = ffThemeOptions::getQuery('iconfont custom-icon-fonts');
			foreach( $custom_icon_fonts as $iconfont ){
				$slug = 'custom-icon-font-'.$index.'-'.sanitize_title( $iconfont->get('slug') );
				$path = trim( $iconfont->get('path') );
				if( empty($path) ){
					continue;
				}
				$path = ABSPATH . $path;
				$fonts[ $slug ] = $path;
				$index ++;
			}
		}

		return $fonts;
	}
}

if( ! function_exists('ark_add_font_uris') ){
	add_filter( 'ff_font_uris', 'ark_add_font_uris' );
	function ark_add_font_uris( $fonts ){
		$index = 1;

		$custom_icon_fonts_query = ffThemeOptions::getQuery('iconfont');
		if ( is_object( $custom_icon_fonts_query) && $custom_icon_fonts_query->exists('custom-icon-fonts') ){
			$custom_icon_fonts = ffThemeOptions::getQuery('iconfont custom-icon-fonts');
			foreach( $custom_icon_fonts as $iconfont ){
				$slug = 'custom-icon-font-'.$index.'-'.sanitize_title( $iconfont->get('slug') );
				$path = trim( $iconfont->get('path') );
				if( empty($path) ){
					continue;
				}
				$path = get_site_url() . '/' . $path;
				$fonts[ $slug ] = $path;

				$index ++;
			}
		}
		return $fonts;
	}
}

if( ! function_exists('ark_get_custom_font_family') ){
	function ark_get_custom_font_family( $index ){
		$fontQuery = ffThemeOptions::getQuery('font');
		if( $fontQuery == null ) {
			return;
		}
		$custom_font = $fontQuery->get('custom-font-family-'.$index);
		$name  = $custom_font->get('font-name');
		$eot   = $custom_font->get('eot');
		$woff2 = $custom_font->get('woff2');
		$woff  = $custom_font->get('woff');
		$ttf   = $custom_font->get('ttf');
		$svg   = $custom_font->get('svg');

		$inline_css = '';
		if( ! empty( $eot ) or ! empty( $woff2 ) or ! empty( $woff ) or ! empty( $ttf ) or ! empty( $svg ) ){
			$inline_css .= "@font-face {\n";
			$inline_css .= "/* ".$name." */\n";
			$inline_css .= "font-family: 'custom-font-family-".$index."';\n";
			if( ! empty( $eot ) ) {
				$inline_css .= "src: url('".esc_url( $eot )."'); /* IE9 Compat Modes */\n";
			}
			$inline_css .= "src:\n";
			$font_files = array();
			if( ! empty( $eot ) ) { $font_files[] = "url('".esc_url( $eot )."?#iefix') format('embedded-opentype')"; }
			if( ! empty( $woff2)) { $font_files[] = "url('".esc_url( $woff2)."') format('woff2')"; }
			if( ! empty( $woff) ) { $font_files[] = "url('".esc_url( $woff)."') format('woff')"; }
			if( ! empty( $ttf ) ) { $font_files[] = "url('".esc_url( $ttf )."') format('truetype')"; }
			if( ! empty( $svg ) ) { $font_files[] = "url('".esc_url( $svg )."') format('svg')"; }
			$inline_css .= implode(",\n",$font_files);
			$inline_css .= "\n;\n}\n\n";
		}
		return $inline_css;
	}
}

if( ! function_exists( 'ark_wp_enqueue_theme_google_fonts_styles') ) {
	function ark_wp_enqueue_theme_google_fonts_styles() {
		$styleEnqueuer = ffContainer()->getStyleEnqueuer();
		$wpLayer = ffContainer()->getWPLayer();
		$fontQuery = ffThemeOptions::getQuery('font');

		$fonts_url = ark_ff_fonts_url();
		if( !empty( $fonts_url ) ){
			$styleEnqueuer->addStyle('ark-google-fonts', $fonts_url);
		}
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

		$inline_css = '';

		for($i=1;$i<=5;$i++){
			$inline_css .= ark_get_custom_font_family($i);
		}

		foreach ($all_font_selectors as $font_selector) {
			if( $fontQuery == null ) {
				continue;
			}
			$font_family = $fontQuery->get($font_selector);
			if( FALSE !== strpos($font_family, 'custom-font-family-') ){
				$inline_css .= ark_get_font_selectors($font_selector).'{font-family:';
				$inline_css .= "'".strip_tags($font_family) . "'" ;
				$inline_css .= '/* ' . ark_wp_kses( $fontQuery->get( $font_family )->get('name') ) . ' */ ,';
				$inline_css .= ark_wp_kses( $fontQuery->get( $font_family )->get('fallback-1') ) . ',';
				$inline_css .= ark_wp_kses( $fontQuery->get( $font_family )->get('fallback-2') ) . ',';
				$inline_css .= 'sans-serif}'."\n\n";
				continue;
			}
			$inline_css .= ark_get_font_selectors($font_selector).'{font-family:'.strip_tags($font_family).',Arial,sans-serif}'."\n\n";
		}

		/* CONTAINER SIZES */
		$globalLayoutQuery = ffThemeOptions::getQuery()->getWithoutComparationDefault('theme_options global-layout', null);
		if ( $globalLayoutQuery != null ){
			if ( $globalLayoutQuery->getWithoutComparationDefault('custom-container-sizes allow-custom-container-sizes', false) ){
				$inline_css .= ark_get_theme_options_container_sizes( $globalLayoutQuery->get('custom-container-sizes') );
			}
		}

		$wpLayer->wp_add_inline_style( 'ark-style' , $inline_css );
	}
}

if( ! function_exists( 'ark_ff_fonts_url') ) {
	function ark_ff_fonts_url() {
		$fontQuery = ffThemeOptions::getQuery('font');

		$font_weight = array();

		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-100', 0 ) ) $font_weight[] = '100';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-200', 0 ) ) $font_weight[] = '200';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-300', 1 ) ) $font_weight[] = '300';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-400', 1 ) ) $font_weight[] = '400';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-500', 1 ) ) $font_weight[] = '500';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-600', 1 ) ) $font_weight[] = '600';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-700', 1 ) ) $font_weight[] = '700';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-800', 0 ) ) $font_weight[] = '800';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-900', 0 ) ) $font_weight[] = '900';

		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-100i', 0 ) ) $font_weight[] = '100i';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-200i', 0 ) ) $font_weight[] = '200i';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-300i', 1 ) ) $font_weight[] = '300i';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-400i', 1 ) ) $font_weight[] = '400i';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-500i', 0 ) ) $font_weight[] = '500i';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-600i', 0 ) ) $font_weight[] = '600i';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-700i', 1 ) ) $font_weight[] = '700i';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-800i', 0 ) ) $font_weight[] = '800i';
		if( $fontQuery->getWithoutComparationDefault( 'google-font-settings font-weight-900i', 0 ) ) $font_weight[] = '900i';

		$font_weight = implode( ',', $font_weight );

		$font_family = array();

		// Check if it is google font
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
		foreach ($all_font_selectors as $font_selector) {
			if( $fontQuery == null ) {
				continue;
			}
			$font_name = $fontQuery->get($font_selector);

			if (FALSE !== strpos($font_name, ',')) {
				// THIS IS NOT GOOGLE FONT - it is web safe font
				continue;
			}
			if( FALSE !== strpos($font_name, 'custom-font-family-') ){
				// THIS IS NOT GOOGLE FONT - it is custom family font
				continue;
			}
			$font_name = str_replace("'", "", $font_name);
			$font_family[ $font_name ] = $font_name;
		}

		// Create google font CSS uri if possible
		$fonts_url = '';

		if (!empty($font_family)) {

			$font_family_with_sizes = array();
			foreach( $font_family as $font ){
				$font_family_with_sizes[] = $font . ':' . $font_weight;
			}
			$font_family = implode('|', $font_family_with_sizes);

			$query_args = array(
				'family' => urlencode( $font_family ),
				// Fix for: MS Edge + Google Fonts + Font Weight 300 + not - latin font
				'subset' => urlencode( 'cyrillic,cyrillic-ext,greek,greek-ext,latin,latin-ext,vietnamese' ),
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw($fonts_url);
	}
}

if (!function_exists('ark_get_boxed_full_width_elements_selector') ) {
	function ark_get_boxed_full_width_elements_selector(){
		return '.fg-container-fluid, .ark-boxed__boxed-wrapper, .ark-boxed__boxed-wrapper .ark-header';
	}
}

if (!function_exists('ark_get_theme_options_container_sizes') ) {
	function ark_get_theme_options_container_sizes($query){

		// ALL VALUES BELOW SHOULD CORRESPOND WITH FRESHGRID.CSS VALUES!!

		$ret = '';

		$breakpoints = array(
			'xs' => false,
			'sm' => '768',
			'md' => '992',
			'lg' => '1200',
		);

		$container_types  = array(
			'small',
			'medium',
			'large',
			'fluid',
		);

		$container_selectors  = array(
			'.fg-container-small',
			'.fg-container-medium',
			'.fg-container-large',
			ark_get_boxed_full_width_elements_selector()
		);

		$widths = array(
			'inherit' => array('100%','100%','100%','100%'), // nothing in this line cannot be null, must be something!
			'xs' => array('100%','100%','100%','100%'),
			'sm' => array('750','750','750',null),
			'md' => array(null,'970','970',null),
			'lg' => array(null,null,'1170',null),
		);

		$paddings = array(
			'inherit' => array('15','15','15','15'), // nothing in this line cannot be null, must be something!
			'xs' => array('15','15','15','15'),
			'sm' => array(null,null,null,null),
			'md' => array(null,null,null,null),
			'lg' => array(null,null,null,null),
		);

		foreach( $breakpoints as $bp => $bp_width ){
			if ( $bp_width ){
				$ret .= "\n".'@media (min-width: '.$bp_width.'px){'."\n";
			}

			foreach ($container_types as $cont_key => $cont_type) {

				/* WIDTH */

				$width = $query->getWithoutComparationDefault('container-width '.$bp.' '.$cont_type, null );
				if ( empty($width) and ( "0" !== $width) ){
					$width = $widths[$bp][$cont_key];
				}

				if ( is_numeric($width) ){
					$width = $width.'px';
				}

				if ( empty($width) ){
					$width = $widths['inherit'][$cont_key];
				}
				$widths['inherit'][$cont_key] = $width;

				/* PADDING */

				$padding = $query->getWithoutComparationDefault('container-padding '.$bp.' '.$cont_type, null );
				if ( empty($padding) and ( "0" !== $padding) ){
					$padding = $paddings[$bp][$cont_key];
				}

				if ( is_numeric($padding) ){
					$padding = $padding.'px';
				}

				if ( empty($padding) ){
					$padding = $paddings['inherit'][$cont_key];
				}
				$paddings['inherit'][$cont_key] = $padding;

				/* RENDER */

				$ret .= $container_selectors[$cont_key].' { ';
				$ret .= 'width: '.$width."; ";
				$ret .= 'padding-left: '.$padding."; ";
				$ret .= 'padding-right: '.$padding."; ";

				$ret .= '}'."\n";
			}

			if ( $bp_width ){
				$ret .= '}'."\n";
			}
		}

		return $ret;
	}
}

if ( FF_ARK_ENVIRONMENT_READY ) {
	require get_template_directory() . '/framework/init.php';
}else{
	require get_template_directory() . '/no-ff/theme-no-ff-fallback.php';
}

//if( !class_exists('ffFrameworkVersionManager' ) ) {
//	require get_template_directory().'/framework/adminScreens/themeDashboardLight/themeDashboardLight.php';
//}

if( FF_ARK_ENVIRONMENT_READY ) {
	if (!function_exists('ff_configure_environment') ) {
		function ff_configure_environment()
		{
			$env = ffContainer()->getEnvironment();
			$env->setIsOurTheme(true);
			$env->setThemeVariable(ffEnvironment::THEME_NAME, 'ark');
			$env->setThemeVariable(ffEnvironment::THEME_USE_LICENSED_UPGRADER, true);
			$sysEnv = ffContainer()->getThemeFrameworkFactory()->getSystemEnvironment();
//			$sysEnv->enableThemeBuilder( array('post', 'page', 'portfolio', 'product'), ffThemeContainer::getInstance()->getElementsCollection() );
			$sysEnv->enableSitePreferencies();
			$sysEnv->enableDashboard();
			$sysEnv->enableDummy();
		}
		ff_configure_environment();
	}
}


if ( FF_ARK_ENVIRONMENT_READY && is_admin() ) {

	// builder cache
	if( !function_exists('ff_mute_admin_colors') ) {
		function ff_delete_builder_cache_when_update() {


			$cache = ffContainer()->getDataStorageCache();
			$currentThemeVersion = ffContainer()->getEnvironment()->getThemeVersion();

			$lastVersion = $cache->getOption('freshbuilder', 'themeVersion');
			if (empty($lastVersion)) {
				$lastVersion = '1.0.0';
			}

			$deleteCache = false;

			if (version_compare($currentThemeVersion, $lastVersion) == 1) {
				$deleteCache = true;

				$cache->setOption('freshbuilder', 'themeVersion', $currentThemeVersion);
			}

			$arkCoreVersion = '1.0.0';
			if( defined('FF_ARK_CORE_PLUGIN_VERSION') ) {
				$arkCoreVersion = FF_ARK_CORE_PLUGIN_VERSION;
			}

			$lastCoreVersion = $cache->getOption('freshbuilder', 'coreVersion');
			if (version_compare($arkCoreVersion, $lastCoreVersion) == 1) {
				$deleteCache = true;
			}

			if( $deleteCache ) {
				$cache->deleteNamespace('freshbuilder');
				$cache->deleteNamespace('elementsCache');
				$cache->deleteNamespace('css');
				$cache->deleteNamespace('assetsmin');
			}

			$cache->setOption('freshbuilder', 'coreVersion', $arkCoreVersion);
			$cache->setOption('freshbuilder', 'themeVersion', $currentThemeVersion);

		}

		ff_delete_builder_cache_when_update();
	}
	if( !function_exists('ff_mute_admin_colors') ) {
		function ff_mute_admin_colors() {
			$query = ffThemeOptions::getQuery('colors');

			if( !is_object($query )  ){
				return;
			}
			$result = $query->getWithoutComparationDefault('muted-admin-ui-colors', 0);

			if( $result && !defined('FF_VIDEO_RECORDING') ) {
				define('FF_VIDEO_RECORDING', true);
			}
		}
		ff_mute_admin_colors();
	}

}

if( !function_exists( 'check_assembled_query' ) ) {
	function check_assembled_query($post)
	{
		$postMeta = ffContainer()->getDataStorageFactory()->createDataStorageWPPostMetas();

		$contentCached = $postMeta->getOption($post->ID, 'ffb-content-cached');

		if ($contentCached != null) {
			$post->post_content = $contentCached;
			$post->post_content_css = $postMeta->getOption($post->ID, 'ffb-content-css');
			$post->post_content_js = $postMeta->getOption($post->ID, 'ffb-content-js');
		}

		return $post;
	}
}

if( !function_exists('ff_init_new_global_styles') ) {
	function ff_init_new_global_styles() {
		if( is_admin() && FF_ARK_ENVIRONMENT_READY ) {
			$globalStyles = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderGlobalStyles();
		}
	}
	ff_init_new_global_styles();
}

if( !function_exists('ff_builder_add_custom_post_types') ) {
	function ff_builder_add_custom_post_types() {
		if( FF_ARK_ENVIRONMENT_READY ) {
			$supportedPostTypesString = ffThemeOptions::getQuery()->getWithoutComparationDefault('theme_options layout freshbuilder-post-types');
			if( !empty( $supportedPostTypesString ) ) {
				$themeBuilderManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
				$supportedPostTypes = explode("\n", $supportedPostTypesString );

				foreach( $supportedPostTypes as $onePostType ) {
					$themeBuilderManager->addSupportedPostType( $onePostType );
				}
			}
		}
	}

	ff_builder_add_custom_post_types();

//	$themeBuilderManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
//		foreach( $supportedPostTypesArray as $onePost ) {
//			$themeBuilderManager->addSupportedPostType( $onePost );
//		}

//	$themeBuilderManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
//	foreach( $supportedPostTypesArray as $onePost ) {
//		$themeBuilderManager->addSupportedPostType( $onePost );
//	}
}


// SELECTORS FOR (GOOGLE) FONTS
require get_template_directory() . '/functions/customizable/font-selectors.php';

// CLASS FOR FEATURED AREAS
require get_template_directory() . '/builder/helpers/ark_Featured_Area.php';

// NAVIGATION AND ITS FALLBACK
require get_template_directory() . '/builder/helpers/ark_boxed_wrapper.php';

// NAVIGATION AND ITS FALLBACK
require get_template_directory() . '/builder/helpers/ark_navigation.php';

// FOOTER AND ITS FALLBACK
require get_template_directory() . '/builder/helpers/ark_footer.php';

// FUNCTIONS FOR FALLBACK NAVIGATION, FOOTER AND COMMENTS
require get_template_directory() . '/builder/helpers/ark_comments.php';

// ADD THEME SUPPORT AND OTHER STUFF
require get_template_directory() . '/functions/customizable/theme-setup.php';

// WOOCOMMERCE
require get_template_directory() . '/functions/customizable/woocommerce.php';

if ( FF_ARK_ENVIRONMENT_READY ) {

	// GLOBAL DATA
	require get_template_directory() . '/functions/internal/wordpress-globals.php';

	// AJAX CONTACT FORM
	require get_template_directory() . '/functions/customizable/contact-form.php';

	// MENU OPTIONS - internal
	require get_template_directory() . '/functions/internal/menu-options.php';

	// JAVASCRIPT CONSTANTS - internal
	require get_template_directory() . '/functions/internal/javascript-constants.php';

	// FONTS AND ICONS
	require get_template_directory() . '/functions/internal/fonts-and-icons.php';

	// THEME SPECIFIC STUFF
	require get_template_directory() . '/functions/internal/theme-specific.php';
}

// REMOVE DEFAULT MAILCHIMP PLUGIN BY YIKES CSS STYLES
define( 'YIKES_MAILCHIMP_EXCLUDE_STYLES', true );
