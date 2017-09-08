<section class="single-post-breadcrumbs breadcrumbs-v5 fg-text-light">
	<div class="container">
		<h2 class="breadcrumbs-v5-title">
			<?php

			if( is_singular() ){
				the_title();
			}else {
				if (is_404()) {
					echo ark_wp_kses(__('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ark'));
				} else if (is_category()) {
					echo ark_wp_kses(single_cat_title('', false));
				} else if (is_tag()) {
					echo ark_wp_kses(single_cat_title('', false));
				} else if (is_tax()) {
					echo ark_wp_kses(single_term_title('', false));
				} else if (is_author()) {
					if (!in_the_loop()) {
						the_post();
						rewind_posts();
					}
					echo ark_wp_kses( get_the_author() );
				} else if (is_search()) {
					echo ark_wp_kses( sprintf( __( 'Search Results for \'%s\'', 'ark' ), strip_tags( get_query_var( 's' ) ) ) );
				} else if (is_home()) {
					echo ark_wp_kses( get_option('blogname') );
				} else if (is_date()) {
					if (is_day()) {
						echo ark_wp_kses( get_the_time( get_option('date_format') ) );
					} else {
						$year = get_query_var( 'year' );
						if (is_month()) {
							$monthnum = get_query_var( 'monthnum' );
							global $wp_locale;
							$my_month = $wp_locale->get_month( $monthnum );

							echo ark_wp_kses( $my_month . ' ' . $year );
						} else if (is_year()) {
							echo ark_wp_kses( $year );
						}
					}
				} else if (function_exists('is_shop')) {
					if (is_shop()) {
						woocommerce_page_title();
					}
				} else {
					wp_title();
				}
			}
			?>
		</h2>
	</div>
</section>

<div class="bg-color-sky-light no-ff">
	<div class="content-md container">
		<div class="row">
			<div class="col-md-9 md-margin-b-30">
				<?php if(have_posts()) { ?>
					<?php while( have_posts() ){ ?>
						<?php the_post(); ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<article class="blog-grid margin-b-50">
								<?php
								ark_Featured_Area::setSizes( 0, 0, 0 );
								ark_Featured_Area::render( get_the_ID(), true );
								?>
								<div class="blog-grid-box-shadow">
									<div class="blog-grid-content">
										<h2 class="blog-grid-title-lg">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
										<div class="post-content ff-richtext">
											<?php
											if( ! post_password_required() ) {
												if (has_excerpt()) {
													the_excerpt();
													wp_link_pages();
												} else {
													if (get_option('rss_use_excerpt')) {
														the_excerpt();
														wp_link_pages();
													} else {
														ark_Featured_Area::the_content_without_featured_area();
														wp_link_pages();
													}
												}
											} else {
												echo '<div class="post-content ff-richtext">';
												the_content();
												echo '</div>';
											}
											?>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="blog-grid-separator"></div>
									<?php get_template_part('no-ff/fallbacks/blog-meta'); ?>
								</div>
							</article>
						</div>
					<?php } ?>
					<div class="blog-pagination-wrapper"><?php
							$pag = get_the_posts_pagination( array(
								'mid_size' => 2,
								'prev_text' => '&laquo;',
								'next_text' => '&raquo;',
								'type' => 'list'
							) );
							$pag = str_replace(
								"<ul class='page-numbers",
								"<div class='paginations-v3 text-center margin-b-30'><ul class='page-numbers paginations-v3-list",
								$pag);
							$pag = str_replace(
								"</ul>",
								"</ul></div>",
								$pag);
							// WP generated and modified pagination
							echo ( $pag );
					?></div>
				<?php }else{ ?>
					<article class="blog-grid margin-b-50">
						<div class="blog-grid-box-shadow">
							<div class="blog-grid-content">
								<h2 class="blog-grid-title-lg">
									<?php echo ark_wp_kses(__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ark')); ?>
								</h2>
								<div class="widget_search">
									<?php get_search_form(); ?>
								</div>
							</div>
						</div>
					</article>
				<?php } ?>
			</div>
			<div class="fg-text-dark ark-sidebar col-xs-12 col-md-3">
				<?php dynamic_sidebar('sidebar-content'); ?>
			</div>
		</div>
	</div>
</div>

