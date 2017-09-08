<?php

class ffComponent_LatestPostWidget_OptionsHolder extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'latest-post-structure' );
		$s->startSection('latest-post', ark_wp_kses( __( 'Latest Post', 'ark' ) ) );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'title',  ark_wp_kses( __( 'Title', 'ark' ) ), 'From the Blog')
					->addParam('class','widefat');;
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addElement( ffOneElement::TYPE_HTML,'', ark_wp_kses( __( 'From category', 'ark' ) ) );
				$s->addOption( ffOneOption::TYPE_TAXONOMY, 'categories',  ark_wp_kses( __( 'Categories', 'ark' ) ), 'all')
					->addParam('tax_type', 'category')
					->addParam('type', 'multiple')
					;
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<p>' );
				$s->addOption(ffOneOption::TYPE_TEXT, 'date-format',  ark_wp_kses( __( 'Date Format', 'ark' ) ), 'j M, Y')
					->addParam('class','widefat');;
			$s->addElement( ffOneElement::TYPE_HTML, '', '</p>' );

			$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', ark_wp_kses( __('Available date formats: <a href="//php.net/manual/en/function.date.php" target="_blank">Date PHP function manual</a>', 'ark' ) ) );


		$s->endSection();
		return $s;
	}
}

