<?php
	if( !FF_ARK_ENVIRONMENT_READY ) {
		?>

		<section class="single-post-breadcrumbs breadcrumbs-v5 fg-text-light"<?php
		$url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
		if (!empty($url)) {
			echo ' style="background-image: url(\'' . $url . '\');"';
		}
		?>>
			<div class="container">
				<h1 class="breadcrumbs-v5-title">
					<?php the_title(); ?>
				</h1>
			</div>
		</section>
		<?php
	}
?>
<div class="bg-color-sky-light">
	<div class="content-sm container">
		<div class="row">
			<div class="md-margin-b-50 col-xs-12 col-md-9">
				<div id="post-<?php the_ID(); ?>" <?php post_class('post-wrapper'); ?>>
					<article class="blog-grid margin-b-30 bg-color-white">
						<?php
						ark_Featured_Area::render();
						?>
						<div class="blog-grid-content">
							<h2 class="blog-grid-title-lg">
								<span class="blog-grid-title-link">
									<?php the_title(); ?>
								</span>
							</h2>

							<div class="post-content ff-richtext">
								<?php ark_Featured_Area::the_content_without_featured_area(); ?>
								<?php wp_link_pages(); ?>
							</div>

							<div class="clearfix"></div>

							<?php the_tags('<ul class="list-inline blog-sidebar-tags"><li>', '</li><li>', '</li></ul>'); ?>

							<div class="clearfix"></div>
						</div>
						<?php
						if( !is_page() ){
							get_template_part('no-ff/fallbacks/blog-meta');
						}
						?>
					</article>
				</div>
				<?php comments_template(); ?>
			</div>
			<div class="fg-text-dark ark-sidebar col-xs-12 col-md-3">
				<?php dynamic_sidebar('sidebar-content'); ?>
			</div>
		</div>
	</div>
</div>

