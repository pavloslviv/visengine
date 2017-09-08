<?php

class ffComponent_LatestNewsWidget_OptionsHolder extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'latest-news-structure' );
		$s->startSection('latest-news', ark_wp_kses( __( 'Latest News', 'ark' ) ) );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'title',  ark_wp_kses( __( 'Title', 'ark' ) ), 'Latest News')
					->addParam('class','widefat');;
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->startSection('height');
					$s->addOption(ffOneOption::TYPE_CHECKBOX, 'set-max-height', 'Set&nbsp;', '1');
					$s->addOption(ffOneOption::TYPE_TEXT, 'height',  ark_wp_kses( __( 'Max Content Height', 'ark' ) ), '290')
						->addParam('class','tiny-text');
				$s->endSection();
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addElement( ffOneElement::TYPE_HTML,'', ark_wp_kses( __( 'Categories', 'ark' ) ));
				$s->addOption( ffOneOption::TYPE_TAXONOMY, 'categories',  ark_wp_kses( __( 'Categories', 'ark' ) ), 'all')
					->addParam('tax_type', 'category')
					->addParam('type', 'multiple')
					;
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );


			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'number-of-posts',  ark_wp_kses( __( 'Number of Posts', 'ark' ) ), '3')
					->addParam('class','tiny-text');
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'date-format',  ark_wp_kses( __( 'Date Format', 'ark' ) ), 'j M y')
					->addParam('class','widefat');;
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', ark_wp_kses( __('Available date formats: <a href="//php.net/manual/en/function.date.php" target="_blank">Date PHP function manual</a>', 'ark' ) ) );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'post-meta',  ark_wp_kses( __( 'Post meta', 'ark' ) ), 'Posted by %author% %date%')
					->addParam('class','widefat');;
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', ark_wp_kses( __('In format: <code>Posted by %author% %date%</code>', 'ark' ) ) );

		$s->endSection();
		return $s;
	}
}

