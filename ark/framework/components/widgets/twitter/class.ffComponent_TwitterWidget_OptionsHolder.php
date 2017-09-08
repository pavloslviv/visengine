<?php

class ffComponent_TwitterWidget_OptionsHolder extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'twitter-structure' );
		$s->startSection('twitter', ark_wp_kses( __( 'Twitter', 'ark' ) ) );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'title',  ark_wp_kses( __( 'Title', 'ark' ) ), 'Twitter Feeds')
					->addParam('class','widefat');
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->startSection('height');
					$s->addOption(ffOneOption::TYPE_CHECKBOX, 'set-max-height',  ark_wp_kses( __( 'Set', 'ark' ) ) .'&nbsp;', '1');
					$s->addOption(ffOneOption::TYPE_TEXT, 'height',  ark_wp_kses( __( 'Max Content Height', 'ark' ) ), '290')
						->addParam('class','tiny-text');;
				$s->endSection();
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );


			$s->startSection('fw_twitter');

				$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
					$s->addOption(ffOneOption::TYPE_TEXT, 'username',  ark_wp_kses( __( 'Username', 'ark' ) ), '_freshface')
						->addParam('class','widefat');
				$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

				$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
					$s->addOption(ffOneOption::TYPE_TEXT, 'number-of-tweets',  ark_wp_kses( __( 'Number of Tweets', 'ark' ) ), '5')
						->addParam('class','tiny-text');
				$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

				$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
					$s->addOption(ffOneOption::TYPE_TEXT, 'caching-time-in-minutes',  ark_wp_kses( __( 'Caching time in minutes', 'ark' ) ), '60')
						->addParam('class','tiny-text');
				$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

				$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
					$s->addOption(ffOneOption::TYPE_TEXT, 'consumer-key',  ark_wp_kses( __( 'Consumer Key', 'ark' ) ) )
						->addParam('class','widefat');
				$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

				$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
					$s->addOption(ffOneOption::TYPE_TEXT, 'consumer-secret',  ark_wp_kses( __( 'Consumer Secret', 'ark' ) ) )
						->addParam('class','widefat');
				$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

				$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
					$s->addOption(ffOneOption::TYPE_TEXT, 'access-token',  ark_wp_kses( __( 'Access Token', 'ark' ) ) )
						->addParam('class','widefat');
				$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

				$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
					$s->addOption(ffOneOption::TYPE_TEXT, 'access-token-secret',  ark_wp_kses( __( 'Access Token Secret', 'ark' ) ) )
						->addParam('class','widefat');
				$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

				$s->addElement(ffOneElement::TYPE_HTML, '', ''
					. '<p class="description">' . ark_wp_kses( __('How to create twitter access token?', 'ark' ) ) . '</p>'
					. '<ol>'
					. '<li><p class="description">' . ark_wp_kses( __('Go to site <a href="//apps.twitter.com/app/new" target="_blank">Create an application | Twitter Application Management</a> and log in.', 'ark' ) ) . '</p></li>'
					. '<li><p class="description">' . ark_wp_kses( __('Into fields Name, Description, Website insert your website.', 'ark' ) ) . '</p></li>'
					. '<li><p class="description">' . ark_wp_kses( __('Check "Yes, I agree".', 'ark' ) ) . '</p></li>'
					. '<li><p class="description">' . ark_wp_kses( __('Click on button "Create your Twitter application".', 'ark' ) ) . '</p></li>'
					. '<li><p class="description">' . ark_wp_kses( __('Find and click on Button "Test Oauth".', 'ark' ) ) . '</p></li>'
					. '<li><p class="description">' . ark_wp_kses( __('Log in again.', 'ark' ) ) . '</p></li>'
					. '<li><p class="description">' . ark_wp_kses( __('Use inputs here - you may put anything in "Access Token" and "Access Token Secret".', 'ark' ) ) . '</p></li>'
					. '</ul>'
				);

			$s->endSection();
		$s->endSection();
		return $s;
	}
}

