<?php

get_header();

if ( FF_ARK_ENVIRONMENT_READY ) {
	the_post();

	global $post;
	?>
	<script>
		jQuery(document).ready(function ($) {
			var currentPageId = <?php the_ID(); ?>;
			frslib.messages.addListener(function (message) {
				if (message.command == 'refresh' && parseInt(message.post_id) == parseInt(currentPageId)) {
					location.reload();
				}
			});
		});
	</script>
	<?php
	$themebuildermanager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
	$postContent = str_repeat($post->post_content, 1);
	ffStopWatch::timeStart();
	$final = $themebuildermanager->renderButNotPrint($post->post_content);
	echo do_shortcode( $final );




	$renderedCss = $themebuildermanager->getRenderedCss();

	if( isset( $post->post_content_css ) ) {

	}

	echo '<style>' .  PHP_EOL . $themebuildermanager->getRenderedCss() . '</style>';
	echo '<script>' .  PHP_EOL . $themebuildermanager->getRenderedJs() . '</script>';
	echo '<div class="smazat" style="position: fixed;bottom: 0;left: 0;min-height: 30px;width: 250px;background: rgba(200,200,200,0.7);z-index: 99999">';
	ffStopWatch::timeEndDump();
	ffStopWatch::dumpVariables();
	echo '</div>';
}else{
	get_template_part('single');
}

get_footer();
