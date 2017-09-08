<?php

class ffComponent_Theme_MenuOptions extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure();
		$s->startSection('general');

			$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Mega menu (for first level only)', 'ark' ) ));
				$s->addOption(ffOneOption::TYPE_SELECT, 'megamenu', '' , '')
					->addSelectValue( ark_wp_kses( __( 'Classic Menu' , 'ark' ) ), '')
					->addSelectValue( ark_wp_kses( __( 'Mega menu with 2 columns' , 'ark' ) ), 'col-md-6')
					->addSelectValue( ark_wp_kses( __( 'Mega menu with 3 columns' , 'ark' ) ), 'col-md-4')
					->addSelectValue( ark_wp_kses( __( 'Mega menu with 4 columns' , 'ark' ) ), 'col-md-3')
					->addSelectValue( ark_wp_kses( __( 'Mega menu with 6 columns' , 'ark' ) ), 'col-md-2')
				;
			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->endSection();
		return $s;
	}
}

