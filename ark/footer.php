		<?php ark_footer(); ?>
			<?php if( class_exists('ffStopWatch') and defined( 'FF_DEVELOPER_MODE' ) && FF_DEVELOPER_MODE == true ) {  ffStopWatch::dumpVariables(); } ?>
		</div>
	</div>
	<?php if( ! class_exists('ffThemeOptions') or ffThemeOptions::getQuery('layout enable-scrolltop') ){ ?>
		<a href="javascript:void(0);" class="js-back-to-top back-to-top-theme"></a>
	<?php } ?>
	<?php if( class_exists('ffThemeOptions') and ffThemeOptions::getQuery('layout')->getWithoutComparationDefault('enable-animation-sharplink', true) ){ ?>
		<div
			class="hidden smoothscroll-sharplink"
			data-speed="<?php echo absint( ffThemeOptions::getQuery('layout')->getWithoutComparationDefault('smoothscroll-sharplink-speed', 1000) ); ?>"
			data-offset="<?php echo ceil( ffThemeOptions::getQuery('layout')->getWithoutComparationDefault('smoothscroll-sharplink-offset', 0) ); ?>"
		></div>
	<?php } ?>
	<?php wp_footer(); ?>
	<?php ark_boxed_wrapper_end(); ?>
</body>
</html>