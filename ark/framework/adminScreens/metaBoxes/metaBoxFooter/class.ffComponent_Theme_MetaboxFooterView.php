<?php

class ffComponent_Theme_MetaboxFooterView extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'Footer');

		$s->startSection('general');
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __('Footer Type', 'ark' ) )  );
					$s->addOptionNL( ffOneOption::TYPE_SELECT, 'type', '', '' )
						->addSelectValue(esc_attr( __('Normal', 'ark' ) ) ,'')
						->addSelectValue(esc_attr( __('Footer Reveal', 'ark' ) ) ,'footer-reveal')
					;
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
		return $s;
	}
}

