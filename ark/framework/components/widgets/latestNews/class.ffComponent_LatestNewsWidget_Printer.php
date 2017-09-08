<?php

class ffComponent_LatestNewsWidget_Printer extends ffBasicObject {
	public function printComponent( $args, ffOptionsQuery $query) {
/**********************************************************************************************************************/
/* DATA GATHERING
/**********************************************************************************************************************/
		$categories = $query->getMultipleSelect('latest-news categories');
		$numberOfPosts = $query->get('latest-news number-of-posts');
		$title = $query->get('latest-news title');

		$postGetter = ffContainer()->getPostLayer()->getPostGetter();
		$posts = $postGetter->addArgHasFeatured()->setFilterRelation_OR()->setNumberOfPosts($numberOfPosts)->filterByCategory( $categories )->getAllPosts();

		if( empty( $posts ) ){
			return;
		}
		
/**********************************************************************************************************************/
/* WIDGET PRINTING
/**********************************************************************************************************************/
		wp_enqueue_script('ark-scrollbar');

		echo ( $args['before_widget'] );

			if( ! empty($title) ) {
				echo ($args['before_title']) . ark_wp_kses($title) . ($args['after_title']);
			}

			echo '<div';
			if( $query->get('latest-news height set-max-height') ){
				wp_enqueue_script( 'scrollbar' );
				echo ' class="blog-sidebar-content-height scrollbar"';
				$height = absint($query->get('latest-news height height'));
				if( $height < 50 ){
					$height = 50;
				}
				echo ' style="max-height:'.$height.'px"';
			}
			echo '>';

				foreach( $posts as $onePost ) {
					echo '<article class="latest-tuts">';
					echo '<div class="latest-tuts-media">';

					$img = $onePost->getFeaturedImage();
					if( $img ) {
						$img = fImg::resize($img, 45, 45, true);
						if( $img ) {
							echo '<img class="latest-tuts-media-img radius-circle" src="' . esc_url($img) . '" alt="">';
						}
					}
					echo '</div>';
					echo '<div class="latest-tuts-content">';
					echo '<h5 class="latest-tuts-content-title"><a href="'.esc_url($onePost->getPermalink()).'">'.ark_wp_kses($onePost->getTitle()).'</a></h5>';
					echo '<small class="latest-tuts-content-time">' . $onePost->getDateFormated( $query->get('latest-news date-format') ) . '</small>';
					echo '</div>';
					echo '</article>';
					}

			echo '</div>';

		echo ($args['after_widget']);
	}
}