<div class="blog-grid-supplemental">
	<div class="entry-meta">
		<div class="blog-grid-supplemental-title">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>">
				<?php the_author(); ?>
			</a>
			-
			<a href="<?php the_permalink(); ?>">
				<?php echo get_the_date();?>
			</a>
			-
			<?php if( 'post' == get_post_type() ){ ?>
					<?php the_category( ', ' ); ?>
				-
			<?php } ?>
			<?php $tags = get_the_tag_list('', ', '); ?>
			<?php if( !empty($tags) ){ ?>
					<?php echo ark_wp_kses($tags); ?>
				-
			<?php } ?>
			<a href="<?php comments_link(); ?>">
				<?php comments_number(
					  ark_wp_kses( __( 'No Comments', 'ark' ) )
					, ark_wp_kses( __( '1 Comment', 'ark' ) )
					, ark_wp_kses( __('% Comments', 'ark') )
				); ?>
			</a>
		</div>
	</div>
</div>