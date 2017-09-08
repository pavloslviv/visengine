<?php

if( !class_exists( 'ffTemporaryQueryHolder' ) ) {
	class ffTemporaryQueryHolder
	{
		private static $_queries = array();

		public static function setQuery($name, $query)
		{
			self::$_queries[$name] = $query;
		}

		public static function getQuery($name)
		{
			if (isset(self::$_queries[$name])) {
				return self::$_queries[$name];
			} else {
				return null;
			}
		}

		public static function deleteQuery($name)
		{
			unset(self::$_queries[$name]);
		}
	}
}

if( !function_exists('ff_get_all_portfolio_tags')) {
	function ff_get_all_portfolio_tags($numberOfPosts = 0)
	{
		$args = array();
		$args['post_type'] = 'portfolio';
		$wpQuery =  new WP_Query( $args );


		$portfolioTagsArray = array();

		$postCounter = 0;
		if ($wpQuery->have_posts()) {
			while ($wpQuery->have_posts()) {
				$wpQuery->the_post();
				$postCounter++;

				if ($numberOfPosts > 0 && $postCounter > $numberOfPosts) {
					break;
				}


				$post = ark_get_post_data();
				$t = wp_get_post_terms($post->ID, 'ff-portfolio-tag');
				if (!empty($t)) foreach ($t as $onePortfolioTag) {
					$portfolioTagsArray[$onePortfolioTag->slug] = $onePortfolioTag;
				}
			}
		}
		rewind_posts();
		// Escaped HTML with tags
		return $portfolioTagsArray;
	}
}

if( !function_exists('ff_get_all_tags_for_one_portfolio_item')) {
	function ff_get_all_tags_for_one_portfolio_item()
	{
		$post = ark_get_post_data();

		return wp_get_post_terms($post->ID, 'ff-portfolio-tag');
	}
}

add_action('admin_footer', 'ff_import_notice');

function ff_import_notice() {

	if( ffContainer()->getRequest()->get('import') == 'wordpress' ){
		$listOfActivePlugins = ffContainer()->getPluginLoader()->getActivePluginClasses();

		if( !isset( $listOfActivePlugins['p-ark-core'] ) && !isset( $listOfActivePlugins['ark-core'] )  ) {
			?>
			<script>
				jQuery(document).ready(function($){
					var htmlToInsert = '';

					htmlToInsert += '<div class="notice notice-error"><p>';
					htmlToInsert += '<?php echo ark_wp_kses( __( 'Before you can start using the <strong>Ark theme</strong>, you need to activate the <strong>Ark Theme Core plugin</strong> first.', 'ark') ); ?>';
					htmlToInsert += '</p><div>';


					$('.wrap h2').after( htmlToInsert );

					$('#import-upload-form').hide();
					$('.narrow').hide();
				});
			</script>
		<?php
		}

	}
}

/**********************************************************************************************************************/
/* ENABLE ANIMATIONS TO THE BODY
/**********************************************************************************************************************/
add_filter( 'body_class', 'ark_body_class' );
if( !function_exists('ark_body_class') ) {
	function ark_body_class( $classes ) {
		$classes[] = "appear-animate";
		return $classes;
	}
}
