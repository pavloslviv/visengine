<?php

class ffComponent_Theme_MetaboxPortfolioView extends ffOptionsHolder {
	public function getOptions() {
		$s = $this->_getOnestructurefactory()->createOneStructure( 'category');


		$s->startSection('general');
			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses( __('Custom Post Title', 'ark') ) );
					$s->startSection('title');
						$s->addOption( ffOneOption::TYPE_TEXT, 'title', '', '');
						$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', ark_wp_kses( __('If left empty, the default Post Title will be printed.', 'ark') ) );
					$s->endSection();
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );


				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses( __('Custom Subtitle', 'ark') ));
					$s->startSection('subtitle');
						$s->addOption( ffOneOption::TYPE_TEXT, 'subtitle', '', '');
						$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', ark_wp_kses( __('If left empty, the default Subtitle will be printed.', 'ark') ) );
					$s->endSection();
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses( __('Custom Link URL', 'ark') ));
					$s->startSection('url');
						$s->addOptionNL( ffOneOption::TYPE_TEXT, 'url', '','');
						$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', ark_wp_kses( __('If left empty, the default Single Portfolio Post URL will be printed.', 'ark') ) );
						$s->addElement(ffOneElement::TYPE_NEW_LINE );
						$s->addOptionNL( ffOneOption::TYPE_SELECT, 'target', '', '')
							->addSelectValue( esc_attr( __('Same Tab','ark') ),'')
							->addSelectValue( esc_attr( __('New Tab','ark') ),'_blank')
							->addSelectValue( esc_attr( __('Lightbox','ark') ),'lightbox')
							->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses( ark_wp_kses( __('Link Target', 'ark' ) ) ) )
						;
					$s->endSection();
				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses( __('Image Size (Mosaic Grid)', 'ark') ));
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'', ark_wp_kses( __('IMPORTANT: The following options will take effect only in "Mosaic Grid" Portfolio Type.', 'ark') ) );
					$s->addElement(ffOneElement::TYPE_NEW_LINE );

					$s->startSection('img-size');
						$s->addOptionNL( ffOneOption::TYPE_SELECT, 'column-width', '', '1')
							->addSelectValue( esc_attr( __('1 Column wide (smallest)','ark') ),1)
							->addSelectValue( esc_attr( __('2 Columns wide','ark') ),2)
							->addSelectValue( esc_attr( __('3 Columns wide','ark') ),3)
							->addSelectValue( esc_attr( __('4 Columns wide','ark') ),4)
							->addSelectValue( esc_attr( __('5 Columns wide','ark') ),5)
							->addSelectValue( esc_attr( __('6 Columns wide (largest)','ark') ),6)
							->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses( ark_wp_kses( __(' Maximum Column Width of this Post', 'ark' ) ) ) )
						;

						$s->addOption(ffOneOption::TYPE_TEXT, 'ratio-width', '', '')
							->addParam('class','small-text')
							->addParam('short', true);
						;
						$s->addElement(ffOneElement::TYPE_HTML,'',' : &nbsp;' );
						$s->addOptionNL(ffOneOption::TYPE_TEXT, 'ratio-height', '', '')
							->addParam('class','small-text')
							->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses( ark_wp_kses( __('Custom Image Aspect Ratio', 'ark' ) ) ) )
							->addParam('short', true);
						;
						$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','For example: <code>16:9</code> or <code>4:3</code>' );

					$s->endSection();

				$s->addElement(ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
		return $s;
	}
}

