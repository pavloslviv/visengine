<?php

class ffComponent_Theme_MetaboxPageSettingsView extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'PageSettings');

		$s->startSection('general');
			$s->addElement( ffOneElement::TYPE_TABLE_START );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __('Custom Page Header', 'ark' ) )  );
					$s->addOptionNL( ffOneOption::TYPE_POST_SELECTOR, 'custom-header-id', '', 'theme-options' )
						->addSelectValue(esc_attr( __('Default from Theme Options', 'ark' ) ) ,'theme-options')
						->addSelectValue(esc_attr( __('No Header', 'ark' ) ) ,'no-header')
						->addParam('post_type', 'ff-header')
					;
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses( __('Custom Page Footer', 'ark' ) ));
					$s->addOptionNL( ffOneOption::TYPE_POST_SELECTOR, 'custom-footer-id', '', 'theme-options' )
						->addSelectValue(esc_attr( __('Default from Theme Options', 'ark' ) ) ,'theme-options')
						->addSelectValue(esc_attr( __('No Footer', 'ark' ) ) ,'no-footer')
						->addParam('post_type', 'ff-footer')
					;
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
		return $s;
	}
}

