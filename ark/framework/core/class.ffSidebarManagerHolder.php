<?php

class ffSidebarManagerHolder extends ffOptionsHolder {

	public function getOptions() {

		$s = $this->_getOnestructurefactory()->createOneStructure( ffThemeContainer::SIDEBARS_NAME );

		$s->startSection( ffThemeContainer::SIDEBARS_NAME, ffOneSection::TYPE_NORMAL );

////////////////////////////////////////////////////////////////////////////////
// SIDEBARS
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-sidebars ff-theme-mix-admin-tab-content">' );

			$s->startSection('sidebars');

				$s->addElement( ffOneElement::TYPE_TABLE_START );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Sidebars' , 'ark' ) ) );

						$s->startSection('sidebars', ffOneSection::TYPE_REPEATABLE_VARIABLE);
							$s->startSection('sidebar', ffOneSection::TYPE_REPEATABLE_VARIATION)
								->addParam('section-name', ark_wp_kses(__('Sidebar', 'ark')));

								$s->addElement( ffOneElement::TYPE_TABLE_START );
									$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'ID' , 'ark' ) ) );
										$s->addOption(ffOneOption::TYPE_TEXT, 'slug', '', 'sidebar-1');
										$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Allowed characters are a-z, 0-9 and minus character -.');
										$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Please note, that sidebars with same ID will be ignored.');
									$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
									$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Title' , 'ark' ) ) );
										$s->addOption(ffOneOption::TYPE_TEXT, 'title', '', 'Sidebar #1');
									$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
									$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Note' , 'ark' ) ) );
										$s->addOption(ffOneOption::TYPE_TEXTAREA, 'description', '', 'This Sidebar has been created via Ark > Sidebars');

									$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

								$s->addElement( ffOneElement::TYPE_TABLE_END );

							$s->endSection();
						$s->endSection();

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_END );

			$s->endSection();

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );

		$s->addElement( ffOneElement::TYPE_NEW_LINE );
		$s->addElement( ffOneElement::TYPE_BUTTON_PRIMARY, ark_wp_kses( __(  'Save' , 'ark' ) ), 'Save Changes' )
			->addParam('class', 'ff-use-old-normalization');

		$s->endSection();

		return $s;
	}

}










