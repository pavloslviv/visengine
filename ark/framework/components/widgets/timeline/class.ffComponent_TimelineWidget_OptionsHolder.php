<?php

class ffComponent_TimelineWidget_OptionsHolder extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'timeline-structure' );
		$s->startSection('timeline', ark_wp_kses( __( 'Timeline', 'ark' ) ) );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'title', ark_wp_kses( __( 'Title', 'ark' ) ), 'Timeline')
					->addParam('class','widefat');
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->startSection('height');
					$s->addOption(ffOneOption::TYPE_CHECKBOX, 'set-max-height', 'Set&nbsp;', '1');
					$s->addOption(ffOneOption::TYPE_TEXT, 'height', 'Max Content Height', '290')
						->addParam('class','tiny-text');
				$s->endSection();
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addElement( ffOneElement::TYPE_HTML,'', ark_wp_kses( __( 'Categories', 'ark' ) ));
				$s->addOption( ffOneOption::TYPE_TAXONOMY, 'categories', ark_wp_kses( __( 'Categories', 'ark' ) ), 'all')
					->addParam('tax_type', 'category')
					->addParam('type', 'multiple')
					;
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );


			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'number-of-posts', ark_wp_kses( __( 'Number of Posts', 'ark' ) ), '3')
					->addParam('class','widefat');
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'date-format', ark_wp_kses( __( 'Date Format', 'ark' ) ), 'j M, Y')
					->addParam('class','widefat');
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', ark_wp_kses( __('Available date formats: <a href="//php.net/manual/en/function.date.php" target="_blank">Date PHP function manual</a>', 'ark' ) ) );

		$s->endSection();
		return $s;
	}
}

