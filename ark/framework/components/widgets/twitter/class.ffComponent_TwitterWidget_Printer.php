<?php

class ffComponent_TwitterWidget_Printer extends ffBasicObject {
	public function printComponent( $args, ffOptionsQuery $query) {

		wp_enqueue_script('ark-scrollbar');
		
		extract( $args );

		$twitterFeeder = ffContainer::getInstance()->getLibManager()->createTwitterFeeder();
		ffContainer::getInstance()->getClassLoader()->loadClass('ffOptionsHolder_Twitter');

		$tweetsCollection = ($twitterFeeder->getTwitterFeed( $query->get('twitter fw_twitter')  ));

		echo  $before_widget;

		$title = trim( $query->get('twitter title') );
		if( !empty($title) ){

			// Default WP text
			echo  $before_title . ark_wp_kses( $title ) .  $after_title;

		}

		if( ! $tweetsCollection->valid() ){
			echo '<p>';
			echo ark_wp_kses(__('Bad Twitter account data!','ark'));
			echo '</p>';
		}else{
			echo '<div';
			if( $query->get('twitter height set-max-height') ){
				wp_enqueue_script( 'scrollbar' );
				echo ' class="blog-sidebar-content-height scrollbar"';
				$height = absint($query->get('twitter height height'));
				if( $height < 50 ){
					$height = 50;
				}
				echo ' style="max-height:'.$height.'px"';
			}
			echo '>';
				echo '<ul class="list-unstyled twitter-feed">';
				foreach( $tweetsCollection as $oneTweet ) {

					$profileImage = $oneTweet->profileImage;
					if( is_ssl() ){ // is HTTPS
						if( 0 === strpos($profileImage, 'http://') ){
							$profileImage = 'https'.substr( $profileImage, 4 );
						}
					}else{ // is HTTP
						if( 0 === strpos($profileImage, 'https://') ){
							$profileImage = 'http' . substr( $profileImage, 5 );
						}
					}

					echo '<li class="twitter-feed-item">';
						echo '<div class="twitter-feed-media">';
							echo '<img class="twitter-feed-media-img radius-circle mCS_img_loaded" src="'.esc_url($profileImage).'" alt="">';
						echo '</div>';

						echo '<div class="twitter-feed-content">';
							echo '<div class="twitter-feed-info clearfix">';

								echo '<div class="twitter-feed-profile">';
									echo '<strong class="twitter-feed-profile-name">'.$oneTweet->profileName.'</strong> ';
									echo '<span class="twitter-feed-profile-nickname">';
									echo '<a class="twitter-feed-profile-nickname-link" href="'.esc_url( 'http://twitter.com/'.( $query->get('twitter fw_twitter username') ) ).'">';
									echo '@'.$oneTweet->profileScreenName;
									echo '</a>';
									echo '</span>';
								echo '</div>';

								echo '<span class="twitter-feed-posted-time">';
								echo human_time_diff( get_the_time('U'), strtotime($oneTweet->date) );
								echo '</span>';

							echo '</div>';

							echo '<p class="twitter-feed-paragraph clearfix">'.$oneTweet->textWithLinks.'</p>';
						echo '</div>';
					echo '</li>';
				}
				echo '</ul>';
			echo '</div>';
		}

		echo  $after_widget;


	}
}