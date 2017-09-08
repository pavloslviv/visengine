<?php

class ffComponent_TimelineWidget_Printer extends ffBasicObject {
	public function printComponent( $args, ffOptionsQuery $query) {
/**********************************************************************************************************************/
/* DATA GATHERING
/**********************************************************************************************************************/
		$categories = $query->getMultipleSelect('timeline categories');
		$numberOfPosts = $query->get('timeline number-of-posts');
		$title = $query->get('timeline title');

		$postGetter = ffContainer()->getPostLayer()->getPostGetter();
		$posts = $postGetter->setFilterRelation_OR()->setNumberOfPosts($numberOfPosts)->filterByCategory( $categories )->getAllPosts();

		if( empty( $posts ) ){
			return;
		}
/**********************************************************************************************************************/
/* WIDGET PRINTING
/**********************************************************************************************************************/
/**********************************************************************************************************************/

		wp_enqueue_script('ark-scrollbar');

		echo ( $args['before_widget'] );

			echo ( $args['before_title'] ) . ark_wp_kses($title) . ( $args['after_title'] );

			echo '<div';
			if( $query->get('timeline height set-max-height') ){
				wp_enqueue_script( 'scrollbar' );
				echo ' class="blog-sidebar-content-height scrollbar"';
				$height = absint($query->get('timeline height height'));
				if( $height < 50 ){
					$height = 50;
				}
				echo ' style="max-height:'.$height.'px"';
			}
			echo '>';
			echo '<ul class="timeline-v2">';
				foreach( $posts as $onePost ) {
					echo '<li class="timeline-v2-list-item">';
					echo '<i class="timeline-v2-badge-icon radius-circle fa fa-calendar"></i>';
					echo '<small class="timeline-v2-news-date">'.$onePost->getDateFormated( $query->get('timeline date-format') ).'</small>';
					echo '<h5 class="timeline-v2-news-title"><a href="'.esc_url($onePost->getPermalink()).'">'.ark_wp_kses($onePost->getTitle()).'</a></h5>';
					echo '</li>';
				}
			echo '</ul>';
			echo '</div>';
		echo ($args['after_widget']);
	}
}