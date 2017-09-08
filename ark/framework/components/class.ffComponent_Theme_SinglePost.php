<?php

class ffComponent_Theme_SinglePost extends ffOptionsHolder {
	public function getOptions() {

		$s = $this->_getOnestructurefactory()->createOneStructure('layout');

		$s->startSection('general');
			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->startSection('blogpost-header');
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses( __( 'Blogpost Text' , 'ark' ) )  );

						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show',ark_wp_kses( __(  'Show Instead Original Text' , 'ark' ) ) , 0);
						$s->addElement( ffOneElement::TYPE_NEW_LINE );

						$s->addOption(ffOneOption::TYPE_TEXT, 'title', ark_wp_kses( __( 'Title' , 'ark' ) ) , 'Here is the big headline for your blog post');
						$s->addElement( ffOneElement::TYPE_NEW_LINE );

						$s->addOption(ffOneOption::TYPE_TEXTAREA, 'description', ark_wp_kses( __( 'Description' , 'ark' ) ) , 'Morbi lacus massa, euismod ut turpis molestie, tristique sodales est. Integer sit amet mi id sapien tempor molestie in nec massa. Fusce non ante sed lorem rutrum feugiat.' );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
				$s->endSection();

			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();

		return $s;
	}
}