<?php

class ffComponent_LatestPostWidget_Printer extends ffBasicObject {
	public function printComponent( $args, ffOptionsQuery $query) {
/**********************************************************************************************************************/
/* DATA GATHERING
/**********************************************************************************************************************/
		$categories = $query->getMultipleSelect('latest-post categories');
		$title = $query->get('latest-post title');

		$postGetter = ffContainer()->getPostLayer()->getPostGetter();
		$posts = $postGetter
			->addArgHasFeatured()
			->setFilterRelation_OR()
			->setNumberOfPosts(1)
			->filterByCategory( $categories )
			->addArgHasFeatured()
			->getAllPosts();

		if( empty( $posts ) ){
			return;
		}
/**********************************************************************************************************************/
/* WIDGET PRINTING
/**********************************************************************************************************************/
		echo ( $args['before_widget'] );

			if( ! empty($title) ) {
				echo ($args['before_title']) . ark_wp_kses($title) . ($args['after_title']);
			}

			echo '<div>';

				foreach( $posts as $onePost ) {
					echo '<a class="featured-article" href="'.esc_url($onePost->getPermalink()).'">';
						$img = $onePost->getFeaturedImage();
						if( $img ) {
							$img = fImg::resize($img, 768, false, true);
							if( $img ) {
								echo '<img class="img-responsive" src="' . esc_url($img) . '" alt="">';
							}
						}
						echo '<div class="featured-article-content-wrap">';
							echo '<div class="featured-article-content">';
								echo '<p class="featured-article-content-title">';
									echo ark_wp_kses($onePost->getTitle());
								echo '</p>';
								echo '<small class="featured-article-content-time">';
									// escaped date
									echo ( $onePost->getDateFormated( $query->get('latest-post date-format') ) );
								echo '</small>';
							echo '</div>';
						echo '</div>';
					echo '</a>';
					}

			echo '</div>';

		echo ($args['after_widget']);
	}
}