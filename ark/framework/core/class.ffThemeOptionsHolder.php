<?php

class ffThemeOptionsHolder extends ffOptionsHolder {

	protected function skinOption( $s, $name, $default, $values ){
		/**
		 * @var $s ffOneStructure
		 */
		$s->addElement( ffOneElement::TYPE_HTML, '', '<div class="ff-theme-layout-changer">' );

		$option = $s->addOption( ffOneOption::TYPE_RADIO, $name, '', $default);

		$colors = array(
			''            => '#e91e63',

			'blue'        => '#03a9f4',
			'blue-gray'   => '#607d8b',
			'brown'       => '#795548',
			'cyan'        => '#00bcd4',
			'green'       => '#4caf50',
			'green-light' => '#8bc34a',
			'indigo'      => '#3f51b5',
			'orange'      => '#ff9800',
			'orange-deep' => '#ff5722',
			'purple'      => '#9c27b0',
			'red'         => '#f44336',
			'yellow'      => '#ffc107',
		);

		foreach ($values as $skin) {
			$option->addSelectValue( '<span style="display:inline-block;width:50px;height:50px;background-color:'.  $colors[$skin].';border:1px solid #333"> &nbsp; </span>' , $skin);
		}

		$s->addElement( ffOneElement::TYPE_HTML, '', '</div>' );

		return $option;
	}

	public function getOptions() {

		$s = $this->_getOnestructurefactory()->createOneStructure( ffThemeContainer::OPTIONS_NAME );

		$sh = $s->getOptionsStructureHelper();

		$s->startSection( ffThemeContainer::OPTIONS_NAME, ffOneSection::TYPE_NORMAL );

		$s->addElement( ffOneElement::TYPE_HTML, '', '<div class="top-hiding-parent">' );

////////////////////////////////////////////////////////////////////////////////
// GLOBAL LAYOUT
////////////////////////////////////////////////////////////////////////////////

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-collection-content-area ff-collection-options ffb-options" data-name="Global Layout">' );

			$s->startSection('global-layout');

				$s->addElement( ffOneElement::TYPE_TABLE_START );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Header');

						$s->addOptionNL( ffOneOption::TYPE_OPTIONS_COLLECTION, 'header', '', 'header_default')
							->addParam('namespace', 'header')
							->addParam('namespace-name', 'Headers')
							->addSelectValue('None', 'none', 'System')
						;

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Titlebar');

						$s->addOptionNL( ffOneOption::TYPE_OPTIONS_COLLECTION, 'titlebar', '', 'titlebar_default')
							->addParam('namespace', 'titlebar')
							->addParam('namespace-name', 'Titlebars')
							->addSelectValue('None', 'none', 'System')
						;

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Footer');

						$s->addOptionNL( ffOneOption::TYPE_OPTIONS_COLLECTION, 'footer', '', 'footer_default')
							->addParam('namespace', 'footer')
							->addParam('namespace-name', 'Footers')
							->addSelectValue('None', 'none', 'System')
						;

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START,'', 'Boxed Wrappers');

						$s->addOptionNL( ffOneOption::TYPE_OPTIONS_COLLECTION, 'boxed_wrapper', '', 'none')
							->addParam('namespace', 'boxed_wrapper')
							->addParam('namespace-name', 'Boxed Wrappers')
							->addSelectValue('None', 'none', 'System')
						;

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );



				$s->addElement( ffOneElement::TYPE_TABLE_END );

				$s->startSection('custom-container-sizes');

					$s->addElement( ffOneElement::TYPE_TABLE_START );

						$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses( __('Container Size', 'ark' ) ) );

							$s->addOptionNL(ffOneOption::TYPE_CHECKBOX, 'allow-custom-container-sizes', 'Set custom sizes for Container', '');

						$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);

					$s->addElement( ffOneElement::TYPE_TABLE_END );

					$sh->startHidingBox('allow-custom-container-sizes', 'checked' , false, '.top-hiding-parent');

						$s->addElement( ffOneElement::TYPE_TABLE_START );

							/* CONTAINER WIDTH */

							$s->startSection( 'container-width' );
								$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Container Width');
									$s->addElement(ffOneElement::TYPE_HTML, '', '<table class="ffb-box-model-table" border="0" cellpadding="0" cellspacing="0">');

									$s->addElement(ffOneElement::TYPE_HTML, '', '<tbody><tr><td></td><td>Small</td><td>Medium</td><td>Large</td><td>Full Width</td></tr>');

									$s->startSection( 'xs' );

										$s->addElement(ffOneElement::TYPE_HTML, '', '<tr>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addElement(ffOneElement::TYPE_HTML, '', 'Phone (XS)');
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'small', '', '')
													->addParam('placeholder', '100%')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'medium', '', '')
													->addParam('placeholder', '100%')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'large', '', '')
													->addParam('placeholder', '100%')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'fluid', '', '')
													->addParam('placeholder', '100%')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

										$s->addElement(ffOneElement::TYPE_HTML, '', '</tr>');

									$s->endSection();

									$s->startSection( 'sm' );

										$s->addElement(ffOneElement::TYPE_HTML, '', '<tr>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addElement(ffOneElement::TYPE_HTML, '', 'Tablet (SM)');
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'small', '', '')
													->addParam('placeholder', '750')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'medium', '', '')
													->addParam('placeholder', '750')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'large', '', '')
													->addParam('placeholder', '750')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'fluid', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

										$s->addElement(ffOneElement::TYPE_HTML, '', '</tr>');

									$s->endSection();

									$s->startSection( 'md' );

										$s->addElement(ffOneElement::TYPE_HTML, '', '<tr>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addElement(ffOneElement::TYPE_HTML, '', 'Laptop (MD)');
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'small', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'medium', '', '')
													->addParam('placeholder', '970')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'large', '', '')
													->addParam('placeholder', '970')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'fluid', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

										$s->addElement(ffOneElement::TYPE_HTML, '', '</tr>');

									$s->endSection();

									$s->startSection( 'lg' );

										$s->addElement(ffOneElement::TYPE_HTML, '', '<tr>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addElement(ffOneElement::TYPE_HTML, '', 'Desktop (LG)&nbsp;&nbsp;&nbsp;&nbsp;');
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'small', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'medium', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'large', '', '')
													->addParam('placeholder', '1170')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'fluid', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

										$s->addElement(ffOneElement::TYPE_HTML, '', '</tr>');

									$s->endSection();

									$s->addElement(ffOneElement::TYPE_HTML, '', '</tbody></table>');

								$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);
							$s->endSection();

						$s->addElement( ffOneElement::TYPE_TABLE_END );

					$sh->endHidingBox();

					$sh->startHidingBox('allow-custom-container-sizes', 'checked' , false, '.top-hiding-parent');

						$s->addElement( ffOneElement::TYPE_TABLE_START );

							/* CONTAINER PADDING */

							$s->startSection( 'container-padding' );
								$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Container Padding');
									$s->addElement(ffOneElement::TYPE_HTML, '', '<table class="ffb-box-model-table" border="0" cellpadding="0" cellspacing="0">');

									$s->addElement(ffOneElement::TYPE_HTML, '', '<tbody><tr><td></td><td>Small</td><td>Medium</td><td>Large</td><td>Full Width</td></tr>');

									$s->startSection( 'xs' );

										$s->addElement(ffOneElement::TYPE_HTML, '', '<tr>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addElement(ffOneElement::TYPE_HTML, '', 'Phone (XS)');
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'small', '', '')
													->addParam('placeholder', '15')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'medium', '', '')
													->addParam('placeholder', '15')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'large', '', '')
													->addParam('placeholder', '15')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'fluid', '', '')
													->addParam('placeholder', '15')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

										$s->addElement(ffOneElement::TYPE_HTML, '', '</tr>');

									$s->endSection();

									$s->startSection( 'sm' );

										$s->addElement(ffOneElement::TYPE_HTML, '', '<tr>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addElement(ffOneElement::TYPE_HTML, '', 'Tablet (SM)');
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'small', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'medium', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'large', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'fluid', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

										$s->addElement(ffOneElement::TYPE_HTML, '', '</tr>');

									$s->endSection();

									$s->startSection( 'md' );

										$s->addElement(ffOneElement::TYPE_HTML, '', '<tr>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addElement(ffOneElement::TYPE_HTML, '', 'Laptop (MD)');
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'small', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'medium', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'large', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'fluid', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

										$s->addElement(ffOneElement::TYPE_HTML, '', '</tr>');

									$s->endSection();

									$s->startSection( 'lg' );

										$s->addElement(ffOneElement::TYPE_HTML, '', '<tr>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addElement(ffOneElement::TYPE_HTML, '', 'Desktop (LG)&nbsp;&nbsp;&nbsp;&nbsp;');
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'small', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'medium', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'large', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

											$s->addElement(ffOneElement::TYPE_HTML, '', '<td>');
												$s->addOption( ffOneOption::TYPE_TEXT, 'fluid', '', '')
													->addParam('placeholder', 'Inherit')
													->addParam('short', true);
											$s->addElement(ffOneElement::TYPE_HTML, '', '</td>');

										$s->addElement(ffOneElement::TYPE_HTML, '', '</tr>');

									$s->endSection();

									$s->addElement(ffOneElement::TYPE_HTML, '', '</tbody></table>');

								$s->addElement( ffOneElement::TYPE_TABLE_DATA_END);
							$s->endSection();

						$s->addElement( ffOneElement::TYPE_TABLE_END );

					$sh->endHidingBox();

				$s->endSection(); // END custom-container-sizes

			$s->endSection();
		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );



////////////////////////////////////////////////////////////////////////////////
// GENERAL
////////////////////////////////////////////////////////////////////////////////

		
		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-collection-content-area ff-collection-options ffb-options" data-name="General">' );

		$s->startSection('layout');

			$s->addElement( ffOneElement::TYPE_TABLE_START );


				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Fresh Builder' , 'ark' ) ) );
					$s->addOption( ffOneOption::TYPE_CHECKBOX, 'enable-builder-jscache', ark_wp_kses( __( 'Enable builder js cache', 'ark' ) ), 1 );


					$s->addElement(ffOneElement::TYPE_HTML,'','<br><br></b><p>Enable Fresh Builder in these Custom Post Types</p>');
					$s->addElement(ffOneElement::TYPE_DESCRIPTION,'','Write here the post types slug. One slug per one line. So it looks like this: <pre>car</br>book</br>movie</pre>');
					$s->addOptionNL( ffOneOption::TYPE_TEXTAREA_STRICT, 'freshbuilder-post-types', '', '');


				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Page loader' , 'ark' ) ) );
					$s->addOption( ffOneOption::TYPE_CHECKBOX, 'enable-pageloader', ark_wp_kses( __( 'Enable page loader overlay', 'ark' ) ) );
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Scroll to top button' , 'ark' ) ) );
					$s->addOption( ffOneOption::TYPE_CHECKBOX, 'enable-scrolltop', ark_wp_kses( __( 'Enable scroll to top button', 'ark' ) ) );
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __(  'Smooth Scroll' , 'ark' ) ));
					$s->addOption( ffOneOption::TYPE_CHECKBOX, 'enable-smoothscroll', 'Enable smoothscroll script');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Link Scrolling Animation' , 'ark' ) ) );
					$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'enable-animation-sharplink',  ark_wp_kses(__('Enable animation when visitor click on #link', 'ark') ), 1 );
					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'smoothscroll-sharplink-speed', '&nbsp; &nbsp; &nbsp; &nbsp; '.ark_wp_kses(__('with speed', 'ark') ).'&nbsp;', 1000)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('miliseconds', 'ark')) );
					$s->addOptionNL( ffOneOption::TYPE_TEXT, 'smoothscroll-sharplink-offset', '&nbsp; &nbsp; &nbsp; &nbsp; '.ark_wp_kses(__('with offset', 'ark') ).'&nbsp;', 0)
						->addParam( ffOneOption::PARAM_TITLE_AFTER, 'px' );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );

		$s->endSection();
		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// SKIN
////////////////////////////////////////////////////////////////////////////////

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-collection-content-area ff-collection-options ffb-options" data-name="Skins and Accents">' );

		$s->startSection('colors');

				$s->addElement( ffOneElement::TYPE_TABLE_START );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Main Color Accent', 'ark' ) ));

					$s->addOptionNL(ffOneOption::TYPE_COLOR_PICKER_WITH_LIB, 'main', '', '[1]')
						->addParam('locked-library', true)
					;

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Main Transparent Color Accent', 'ark' ) ));
			
					$s->addOptionNL(ffOneOption::TYPE_COLOR_PICKER_WITH_LIB, 'transparent', '', '[2]')
						->addParam('locked-library', true)
					;

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Muted admin UI colors', 'ark' ) ));

						$s->addOptionNL(ffOneOption::TYPE_CHECKBOX, 'muted-admin-ui-colors', '', 0)
						;

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );

		$s->endSection();
		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// FONTS
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-collection-content-area ff-collection-options ffb-options" data-name="Fonts">' );

		$s->startSection('font');

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Note' , 'ark' ) ) );
					$s->addElement(ffOneElement::TYPE_DESCRIPTION, '', ark_wp_kses(__('Please note that including too many Custom/Google Fonts may decrease your site performance and loading speeds.', 'ark')));
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Include Custom Fonts' , 'ark' ) ) );
					for($i=1; $i<=5;$i++){
						$s->startSection('custom-font-family-'.$i);

							$s->addElement(ffOneElement::TYPE_TOGGLE_BOX_START, '', ark_wp_kses(__('Custom Font', 'ark')) . ' #' . $i )
								->addParam('is-opened', false);

								$s->addOptionNL(ffOneOption::TYPE_TEXT, 'font-name', '', 'custom-font-'.$i)
									->addParam('class', 'regular-text')
									->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('Custom font name', 'ark')) );;

								$s->addOptionNL(ffOneOption::TYPE_TEXT, 'eot', '', '')
									->addParam('class', 'regular-text')
									->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('EOT file (IE6-IE9)', 'ark')) );;

								$s->addOptionNL(ffOneOption::TYPE_TEXT, 'woff2', '', '')
									->addParam('class', 'regular-text')
									->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('WOFF2 file', 'ark')) );;

								$s->addOptionNL(ffOneOption::TYPE_TEXT, 'woff', '', '')
									->addParam('class', 'regular-text')
									->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('WOFF file', 'ark')) );;

								$s->addOptionNL(ffOneOption::TYPE_TEXT, 'ttf', '', '')
									->addParam('class', 'regular-text')
									->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('TTF file (Safari, Android, iOS)', 'ark')) );;

								$s->addOptionNL(ffOneOption::TYPE_TEXT, 'svg', '', '')
									->addParam('class', 'regular-text')
									->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('SVG file (Legacy iOS)', 'ark')) );;

								$s->addElement(ffOneElement::TYPE_DESCRIPTION,'',ark_wp_kses( __('Fill with path to font, for example: <code>http://example.com/wp-content/my-custom-font/my-custom-font.woff</code>', 'ark') ));
								$s->addElement(ffOneElement::TYPE_DESCRIPTION,'',ark_wp_kses( __('Please note, that icon fonts CSS files should be uploaded via FTP to your server.', 'ark') ));

								$s->addElement(ffOneElement::TYPE_NEW_LINE );
								$s->addElement(ffOneElement::TYPE_NEW_LINE );

								$s->addOptionNL(ffOneOption::TYPE_TEXT, 'fallback-1', '', 'Helvetica, Arial' )
									->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('Web Safe Font Fallback', 'ark')) );

								$s->addElement(ffOneElement::TYPE_NEW_LINE );
								$s->addElement(ffOneElement::TYPE_NEW_LINE );

								$s->addOption(ffOneOption::TYPE_SELECT, 'fallback-2', '', 'sans-serif')
									->addSelectValue( 'sans-serif', 'sans-serif')
									->addSelectValue( 'serif', 'serif')
									->addSelectValue( 'monospace', 'monospace')
									->addSelectValue( 'cursive', 'cursive')
									->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('Default Fallback', 'ark')) );
									;

							$s->addElement(ffOneElement::TYPE_TOGGLE_BOX_END);
						$s->endSection();
					}

					$s->addElement(ffOneElement::TYPE_DESCRIPTION, '', ark_wp_kses(__('<span style="color: red;">After including, you will be able to use/pick these fonts in Fresh Builder</span>', 'ark')));
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$customGroup = array();

				for( $i=1; $i<=5; $i++ ) {
					$oneFont = array();
					$oneFont['name'] = ark_wp_kses( __( 'Custom Font', 'ark' ) ) . ' #'.$i;
					$oneFont['value'] = 'custom-font-family-'.$i;
					$oneFont['group'] = 'Custom Fonts';

					$customGroup[] = $oneFont;
				}

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Google Font Settings' , 'ark' ) ) );

					$s->startSection('google-font-settings');

					$s->addElement(ffOneElement::TYPE_DESCRIPTION, '', ark_wp_kses(__('Select what font variants do you want to load globally on your website:', 'ark')));

					$s->addElement(ffOneElement::TYPE_HTML, '', '<table border="0" cellpadding="0" cellspacing="0"><tr><td style="padding: 0 40px 0 0">');

						$s->addElement(ffOneElement::TYPE_HTML, '', '<h3>'.ark_wp_kses( __( 'Font Normal' , 'ark' ) ).'</h3>');

						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-100', '100 Thin');
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-200', '200');
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-300', '300 Light', 1);
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-400', '400 Normal', 1);
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-500', '500 Medium', 1);
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-600', '600', 1);
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-700', '700 Bold', 1);
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-800', '800');
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-900', '900 Extra bold');

					$s->addElement(ffOneElement::TYPE_HTML, '', '</td><td style="padding: 0 40px 0 0">');

						$s->addElement(ffOneElement::TYPE_HTML, '', '<h3>'.ark_wp_kses( __( 'Font Cursive (Italic)' , 'ark' ) ).'</h3>');

						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-100i', '100 Thin');
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-200i', '200');
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-300i', '300 Light',1 );
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-400i', '400 Normal', 1);
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-500i', '500 Medium');
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-600i', '600');
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-700i', '700 Bold', 1);
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-800i', '800');
						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'font-weight-900i', '900 Extra bold');

//					$s->addElement(ffOneElement::TYPE_HTML, '', '</td><td style="padding:0;vertical-align: top">');
//
//						$s->addElement(ffOneElement::TYPE_HTML, '', '<h3>'.ark_wp_kses( __( 'Languages' , 'ark' ) ).'</h3>');
//
//						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'cyrillic', 'Cyrillic');
//						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'cyrillic-ext', 'Cyrillic Extended');
//						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'greek', 'Greek');
//						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'greek-ext', 'Greek Extended');
//						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'latin', 'Latin', 1);
//						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'latin-ext', 'Latin Extended', 1);
//						$s->addOptionNL( ffOneOption::TYPE_CHECKBOX, 'vietnamese', 'Vietnamese');

					$s->addElement(ffOneElement::TYPE_HTML, '', '</td></tr></table>');

					$s->endSection();

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


				$fonts = array();

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Select "Body" Font' , 'ark' ) ) );
					$fonts[] = $s->addOptionNL( ffOneOption::TYPE_FONT, 'body',  ark_wp_kses( __( 'Family ' , 'ark' ) ) , "'Roboto'");
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Select "Body Alt" Font' , 'ark' ) ) );
					$fonts[] = $s->addOption( ffOneOption::TYPE_FONT, 'body-alt', ark_wp_kses( __(  'Family ' , 'ark' ) ) , "'Droid Serif'");
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Select "Code" Font' , 'ark' ) ) );
					$fonts[] = $s->addOption( ffOneOption::TYPE_FONT, 'code', ark_wp_kses( __(  'Family ' , 'ark' ) ) , "'Courier New', Courier, monospace" );
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				for( $i=1; $i<=8;$i++ ) {
					$s->addElement(ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses(__('Include Google Font', 'ark')) . ' #' . $i );
						$fonts[] = $s->addOption(ffOneOption::TYPE_FONT, 'custom-font-'.$i, ark_wp_kses(__('Family ', 'ark')), "Arial, Helvetica, sans-serif");
						$s->addElement(ffOneElement::TYPE_DESCRIPTION, '', ark_wp_kses(__('<span style="color: red;">After including, you will be able to use/pick this font in Fresh Builder</span>', 'ark')));
					$s->addElement(ffOneElement::TYPE_TABLE_DATA_END);
				}


				foreach( $fonts as $oneFontSelect ) {
					foreach( $customGroup as $oneCustomFont ) {
						$oneFontSelect->addSelectValue( $oneCustomFont['name'], $oneCustomFont['value'], $oneCustomFont['group']);
					}
				}


			$s->addElement( ffOneElement::TYPE_TABLE_END );

		$s->endSection();
		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// ICON FONTS
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-collection-content-area ff-collection-options ffb-options" data-name="Icon Fonts">' );

		$s->startSection('iconfont');

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Note' , 'ark' ) ) );
					$s->addElement(ffOneElement::TYPE_DESCRIPTION, '', ark_wp_kses(__('Please note, that too many of custom icon fonts may decrease site performance and loading speed.', 'ark')));
					$s->addElement(ffOneElement::TYPE_DESCRIPTION, '', ark_wp_kses(__('If you have problem, that instead of icons you see squares, please check <a href="//support.freshface.net/knowledge-base/faq-frequently-asked-questions/#faq-domain-moved" target="_blank">FAQ &rArr; I changed domain and web is broken</a>', 'ark')));
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses( __('Custom Fonts' , 'ark') ) );
					$s->startSection('custom-icon-fonts', ffOneSection::TYPE_REPEATABLE_VARIABLE)
						->addParam('can-be-empty', true);
						$s->startSection('custom-icon-font', ffOneSection::TYPE_REPEATABLE_VARIATION)
							->addParam('section-name', ark_wp_kses(__('Custom font', 'ark')));

							$s->addOption(ffOneOption::TYPE_TEXT, 'slug', '', 'my-icon-font')
								->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('CSS File ID or slug', 'ark')) );

							$s->addElement(ffOneElement::TYPE_DESCRIPTION,'',ark_wp_kses( __('Allowed characters are <code>a-z</code>, <code>0-9</code> and minus character <code>-</code>.', 'ark') ));
							$s->addElement(ffOneElement::TYPE_DESCRIPTION,'',ark_wp_kses( __('Please note, that custom icon fonts with same ID will be ignored.', 'ark') ));
							$s->addElement(ffOneElement::TYPE_NEW_LINE );
							$s->addElement(ffOneElement::TYPE_NEW_LINE );

							$s->addOption(ffOneOption::TYPE_TEXT, 'path', get_site_url().'/', '')
								->addParam('class', 'regular-text')
								->addParam( ffOneOption::PARAM_TITLE_AFTER, ark_wp_kses(__('Path to icon font', 'ark')) );
							$s->addElement(ffOneElement::TYPE_DESCRIPTION,'',ark_wp_kses( __('Leave empty to ignore', 'ark') ));
							$s->addElement(ffOneElement::TYPE_DESCRIPTION,'',ark_wp_kses( __('Fill with path to font, for example: <code>wp-content/my-icon-font/my-icon-font.css</code>', 'ark') ));
							$s->addElement(ffOneElement::TYPE_DESCRIPTION,'',ark_wp_kses( __('Please note, that icon fonts CSS files should be uploaded via FTP to your server.', 'ark') ));
							$s->addElement(ffOneElement::TYPE_DESCRIPTION,'',ark_wp_kses( __('Be sure, that your icon font style does not contain selectors like <code>[class*=icon-]</code> - if it contains, please replace in the the string "icon" with the string "my-custom-icon" or something similar in the whole CSS file', 'ark') ));

						$s->endSection();
					$s->endSection();


				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$iconfont_examples = array(
					'brandico'    => '<i class="ff-font-brandico icon-facebook"></i><i class="ff-font-brandico icon-facebook-rect"></i><i class="ff-font-brandico icon-twitter"></i><i class="ff-font-brandico icon-twitter-bird"></i><i class="ff-font-brandico icon-vimeo"></i><i class="ff-font-brandico icon-vimeo-rect"></i><i class="ff-font-brandico icon-tumblr"></i><i class="ff-font-brandico icon-tumblr-rect"></i><i class="ff-font-brandico icon-googleplus-rect"></i><i class="ff-font-brandico icon-github-text"></i><i class="ff-font-brandico icon-github"></i><i class="ff-font-brandico icon-skype"></i><i class="ff-font-brandico icon-icq"></i><i class="ff-font-brandico icon-yandex"></i><i class="ff-font-brandico icon-yandex-rect"></i><i class="ff-font-brandico icon-vkontakte-rect"></i><i class="ff-font-brandico icon-odnoklassniki"></i><i class="ff-font-brandico icon-odnoklassniki-rect"></i><i class="ff-font-brandico icon-friendfeed"></i><i class="ff-font-brandico icon-friendfeed-rect"></i>',
					'elusive'     => '<i class="ff-font-elusive icon-glass"></i><i class="ff-font-elusive icon-music"></i><i class="ff-font-elusive icon-search"></i><i class="ff-font-elusive icon-search-circled"></i><i class="ff-font-elusive icon-mail"></i><i class="ff-font-elusive icon-mail-circled"></i><i class="ff-font-elusive icon-heart"></i><i class="ff-font-elusive icon-heart-circled"></i><i class="ff-font-elusive icon-heart-empty"></i><i class="ff-font-elusive icon-star"></i><i class="ff-font-elusive icon-star-circled"></i><i class="ff-font-elusive icon-star-empty"></i><i class="ff-font-elusive icon-user"></i><i class="ff-font-elusive icon-group"></i><i class="ff-font-elusive icon-group-circled"></i><i class="ff-font-elusive icon-torso"></i><i class="ff-font-elusive icon-video"></i><i class="ff-font-elusive icon-video-circled"></i><i class="ff-font-elusive icon-video-alt"></i><i class="ff-font-elusive icon-videocam"></i>',
					'entypo'      => '<i class="ff-font-entypo icon-note"></i><i class="ff-font-entypo icon-note-beamed"></i><i class="ff-font-entypo icon-music"></i><i class="ff-font-entypo icon-search"></i><i class="ff-font-entypo icon-flashlight"></i><i class="ff-font-entypo icon-mail"></i><i class="ff-font-entypo icon-heart"></i><i class="ff-font-entypo icon-heart-empty"></i><i class="ff-font-entypo icon-star"></i><i class="ff-font-entypo icon-star-empty"></i><i class="ff-font-entypo icon-user"></i><i class="ff-font-entypo icon-users"></i><i class="ff-font-entypo icon-user-add"></i><i class="ff-font-entypo icon-video"></i><i class="ff-font-entypo icon-picture"></i><i class="ff-font-entypo icon-camera"></i><i class="ff-font-entypo icon-layout"></i><i class="ff-font-entypo icon-menu"></i><i class="ff-font-entypo icon-check"></i><i class="ff-font-entypo icon-cancel"></i>',
					'fontelico'   => '<i class="ff-font-fontelico icon-emo-happy"></i><i class="ff-font-fontelico icon-emo-wink"></i><i class="ff-font-fontelico icon-emo-wink2"></i><i class="ff-font-fontelico icon-emo-unhappy"></i><i class="ff-font-fontelico icon-emo-sleep"></i><i class="ff-font-fontelico icon-emo-thumbsup"></i><i class="ff-font-fontelico icon-emo-devil"></i><i class="ff-font-fontelico icon-emo-surprised"></i><i class="ff-font-fontelico icon-emo-tongue"></i><i class="ff-font-fontelico icon-emo-coffee"></i><i class="ff-font-fontelico icon-emo-sunglasses"></i><i class="ff-font-fontelico icon-emo-displeased"></i><i class="ff-font-fontelico icon-emo-beer"></i><i class="ff-font-fontelico icon-emo-grin"></i><i class="ff-font-fontelico icon-emo-angry"></i><i class="ff-font-fontelico icon-emo-saint"></i><i class="ff-font-fontelico icon-emo-cry"></i><i class="ff-font-fontelico icon-emo-shoot"></i><i class="ff-font-fontelico icon-emo-squint"></i><i class="ff-font-fontelico icon-emo-laugh"></i>',
					'iconic'      => '<i class="ff-font-iconic icon-search"></i><i class="ff-font-iconic icon-mail"></i><i class="ff-font-iconic icon-heart"></i><i class="ff-font-iconic icon-heart-empty"></i><i class="ff-font-iconic icon-star"></i><i class="ff-font-iconic icon-user"></i><i class="ff-font-iconic icon-video"></i><i class="ff-font-iconic icon-picture"></i><i class="ff-font-iconic icon-camera"></i><i class="ff-font-iconic icon-ok"></i><i class="ff-font-iconic icon-ok-circle"></i><i class="ff-font-iconic icon-cancel"></i><i class="ff-font-iconic icon-cancel-circle"></i><i class="ff-font-iconic icon-plus"></i><i class="ff-font-iconic icon-plus-circle"></i><i class="ff-font-iconic icon-minus"></i><i class="ff-font-iconic icon-minus-circle"></i><i class="ff-font-iconic icon-help"></i><i class="ff-font-iconic icon-info"></i><i class="ff-font-iconic icon-home"></i>',
					'linecons'    => '<i class="ff-font-linecons icon-music"></i><i class="ff-font-linecons icon-search"></i><i class="ff-font-linecons icon-mail"></i><i class="ff-font-linecons icon-heart"></i><i class="ff-font-linecons icon-star"></i><i class="ff-font-linecons icon-user"></i><i class="ff-font-linecons icon-videocam"></i><i class="ff-font-linecons icon-camera"></i><i class="ff-font-linecons icon-photo"></i><i class="ff-font-linecons icon-attach"></i><i class="ff-font-linecons icon-lock"></i><i class="ff-font-linecons icon-eye"></i><i class="ff-font-linecons icon-tag"></i><i class="ff-font-linecons icon-thumbs-up"></i><i class="ff-font-linecons icon-pencil"></i><i class="ff-font-linecons icon-comment"></i><i class="ff-font-linecons icon-location"></i><i class="ff-font-linecons icon-cup"></i><i class="ff-font-linecons icon-trash"></i><i class="ff-font-linecons icon-doc"></i>',
					'maki'        => '<i class="ff-font-maki icon-aboveground-rail"></i><i class="ff-font-maki icon-airfield"></i><i class="ff-font-maki icon-airport"></i><i class="ff-font-maki icon-art-gallery"></i><i class="ff-font-maki icon-bar"></i><i class="ff-font-maki icon-baseball"></i><i class="ff-font-maki icon-basketball"></i><i class="ff-font-maki icon-beer"></i><i class="ff-font-maki icon-belowground-rail"></i><i class="ff-font-maki icon-bicycle"></i><i class="ff-font-maki icon-bus"></i><i class="ff-font-maki icon-cafe"></i><i class="ff-font-maki icon-campsite"></i><i class="ff-font-maki icon-cemetery"></i><i class="ff-font-maki icon-cinema"></i><i class="ff-font-maki icon-college"></i><i class="ff-font-maki icon-commerical-building"></i><i class="ff-font-maki icon-credit-card"></i><i class="ff-font-maki icon-cricket"></i><i class="ff-font-maki icon-embassy"></i>',
					'meteocons'   => '<i class="ff-font-meteocons icon-windy-rain-inv"></i><i class="ff-font-meteocons icon-snow-inv"></i><i class="ff-font-meteocons icon-snow-heavy-inv"></i><i class="ff-font-meteocons icon-hail-inv"></i><i class="ff-font-meteocons icon-clouds-inv"></i><i class="ff-font-meteocons icon-clouds-flash-inv"></i><i class="ff-font-meteocons icon-temperature"></i><i class="ff-font-meteocons icon-compass"></i><i class="ff-font-meteocons icon-na"></i><i class="ff-font-meteocons icon-celcius"></i><i class="ff-font-meteocons icon-fahrenheit"></i><i class="ff-font-meteocons icon-clouds-flash-alt"></i><i class="ff-font-meteocons icon-sun-inv"></i><i class="ff-font-meteocons icon-moon-inv"></i><i class="ff-font-meteocons icon-cloud-sun-inv"></i><i class="ff-font-meteocons icon-cloud-moon-inv"></i><i class="ff-font-meteocons icon-cloud-inv"></i><i class="ff-font-meteocons icon-cloud-flash-inv"></i><i class="ff-font-meteocons icon-drizzle-inv"></i><i class="ff-font-meteocons icon-rain-inv"></i>',
					'mfglabs'     => '<i class="ff-font-mfglabs icon-search"></i><i class="ff-font-mfglabs icon-mail"></i><i class="ff-font-mfglabs icon-heart"></i><i class="ff-font-mfglabs icon-heart-broken"></i><i class="ff-font-mfglabs icon-star"></i><i class="ff-font-mfglabs icon-star-empty"></i><i class="ff-font-mfglabs icon-star-half"></i><i class="ff-font-mfglabs icon-star-half_empty"></i><i class="ff-font-mfglabs icon-user"></i><i class="ff-font-mfglabs icon-user-male"></i><i class="ff-font-mfglabs icon-user-female"></i><i class="ff-font-mfglabs icon-users"></i><i class="ff-font-mfglabs icon-movie"></i><i class="ff-font-mfglabs icon-videocam"></i><i class="ff-font-mfglabs icon-isight"></i><i class="ff-font-mfglabs icon-camera"></i><i class="ff-font-mfglabs icon-menu"></i><i class="ff-font-mfglabs icon-th-thumb"></i><i class="ff-font-mfglabs icon-th-thumb-empty"></i><i class="ff-font-mfglabs icon-th-list"></i>',
					'modernpics'  => '<i class="ff-font-modernpics icon-search"></i><i class="ff-font-modernpics icon-mail"></i><i class="ff-font-modernpics icon-heart"></i><i class="ff-font-modernpics icon-star"></i><i class="ff-font-modernpics icon-user"></i><i class="ff-font-modernpics icon-user-woman"></i><i class="ff-font-modernpics icon-user-pair"></i><i class="ff-font-modernpics icon-video-alt"></i><i class="ff-font-modernpics icon-videocam"></i><i class="ff-font-modernpics icon-videocam-alt"></i><i class="ff-font-modernpics icon-camera"></i><i class="ff-font-modernpics icon-th"></i><i class="ff-font-modernpics icon-th-list"></i><i class="ff-font-modernpics icon-ok"></i><i class="ff-font-modernpics icon-cancel"></i><i class="ff-font-modernpics icon-cancel-circle"></i><i class="ff-font-modernpics icon-plus"></i><i class="ff-font-modernpics icon-home"></i><i class="ff-font-modernpics icon-lock"></i><i class="ff-font-modernpics icon-lock-open"></i>',
					'typicons'    => '<i class="ff-font-typicons icon-music-outline"></i><i class="ff-font-typicons icon-music"></i><i class="ff-font-typicons icon-search-outline"></i><i class="ff-font-typicons icon-search"></i><i class="ff-font-typicons icon-mail"></i><i class="ff-font-typicons icon-heart"></i><i class="ff-font-typicons icon-heart-filled"></i><i class="ff-font-typicons icon-star"></i><i class="ff-font-typicons icon-star-filled"></i><i class="ff-font-typicons icon-user-outline"></i><i class="ff-font-typicons icon-user"></i><i class="ff-font-typicons icon-users-outline"></i><i class="ff-font-typicons icon-users"></i><i class="ff-font-typicons icon-user-add-outline"></i><i class="ff-font-typicons icon-user-add"></i><i class="ff-font-typicons icon-user-delete-outline"></i><i class="ff-font-typicons icon-user-delete"></i><i class="ff-font-typicons icon-video"></i><i class="ff-font-typicons icon-videocam-outline"></i><i class="ff-font-typicons icon-videocam"></i>',
//					'simple line icons'
//					              => '<i class="ff-font-simple-line-icons icon-user-female"></i><i class="ff-font-simple-line-icons icon-user-follow"></i><i class="ff-font-simple-line-icons icon-user-following"></i><i class="ff-font-simple-line-icons icon-user-unfollow"></i><i class="ff-font-simple-line-icons icon-trophy"></i><i class="ff-font-simple-line-icons icon-screen-smartphone"></i><i class="ff-font-simple-line-icons icon-screen-desktop"></i><i class="ff-font-simple-line-icons icon-plane"></i><i class="ff-font-simple-line-icons icon-notebook"></i><i class="ff-font-simple-line-icons icon-moustache"></i><i class="ff-font-simple-line-icons icon-mouse"></i><i class="ff-font-simple-line-icons icon-magnet"></i><i class="ff-font-simple-line-icons icon-energy"></i><i class="ff-font-simple-line-icons icon-emoticon-smile active"></i><i class="ff-font-simple-line-icons icon-disc"></i><i class="ff-font-simple-line-icons icon-cursor-move"></i><i class="ff-font-simple-line-icons icon-crop"></i><i class="ff-font-simple-line-icons icon-credit-card"></i><i class="ff-font-simple-line-icons icon-chemistry"></i><i class="ff-font-simple-line-icons icon-user"></i>',
					'weathercons' => '<i class="ff-font-weathercons icon-day-cloudy-gusts"></i><i class="ff-font-weathercons icon-day-cloudy-windy"></i><i class="ff-font-weathercons icon-day-cloudy"></i><i class="ff-font-weathercons icon-day-fog"></i><i class="ff-font-weathercons icon-day-hail"></i><i class="ff-font-weathercons icon-day-lightning"></i><i class="ff-font-weathercons icon-day-rain-mix"></i><i class="ff-font-weathercons icon-day-rain-wind"></i><i class="ff-font-weathercons icon-day-rain"></i><i class="ff-font-weathercons icon-day-showers"></i><i class="ff-font-weathercons icon-day-snow"></i><i class="ff-font-weathercons icon-day-sprinkle"></i><i class="ff-font-weathercons icon-day-sunny-overcast"></i><i class="ff-font-weathercons icon-day-sunny"></i><i class="ff-font-weathercons icon-day-storm-showers"></i><i class="ff-font-weathercons icon-day-thunderstorm"></i><i class="ff-font-weathercons icon-cloudy-gusts"></i><i class="ff-font-weathercons icon-cloudy-windy"></i><i class="ff-font-weathercons icon-cloudy"></i><i class="ff-font-weathercons icon-fog"></i>',
					'websymbols'  => '<i class="ff-font-websymbols icon-search"></i><i class="ff-font-websymbols icon-mail"></i><i class="ff-font-websymbols icon-heart"></i><i class="ff-font-websymbols icon-heart-empty"></i><i class="ff-font-websymbols icon-star"></i><i class="ff-font-websymbols icon-user"></i><i class="ff-font-websymbols icon-video"></i><i class="ff-font-websymbols icon-picture"></i><i class="ff-font-websymbols icon-th-large"></i><i class="ff-font-websymbols icon-th"></i><i class="ff-font-websymbols icon-th-list"></i><i class="ff-font-websymbols icon-ok"></i><i class="ff-font-websymbols icon-ok-circle"></i><i class="ff-font-websymbols icon-cancel"></i><i class="ff-font-websymbols icon-cancel-circle"></i><i class="ff-font-websymbols icon-plus-circle"></i><i class="ff-font-websymbols icon-minus-circle"></i><i class="ff-font-websymbols icon-link"></i><i class="ff-font-websymbols icon-attach"></i><i class="ff-font-websymbols icon-lock"></i>',
					'zocial'      => '<i class="ff-font-zocial icon-duckduckgo"></i><i class="ff-font-zocial icon-aim"></i><i class="ff-font-zocial icon-delicious"></i><i class="ff-font-zocial icon-paypal"></i><i class="ff-font-zocial icon-flattr"></i><i class="ff-font-zocial icon-android"></i><i class="ff-font-zocial icon-eventful"></i><i class="ff-font-zocial icon-smashmag"></i><i class="ff-font-zocial icon-gplus"></i><i class="ff-font-zocial icon-wikipedia"></i><i class="ff-font-zocial icon-lanyrd"></i><i class="ff-font-zocial icon-calendar"></i><i class="ff-font-zocial icon-stumbleupon"></i><i class="ff-font-zocial icon-fivehundredpx"></i><i class="ff-font-zocial icon-pinterest"></i><i class="ff-font-zocial icon-bitcoin"></i><i class="ff-font-zocial icon-w3c"></i><i class="ff-font-zocial icon-foursquare"></i><i class="ff-font-zocial icon-html5"></i><i class="ff-font-zocial icon-ie"></i>',
				);

				// Options
				foreach ($iconfont_examples as $name => $path) {
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', ucfirst($name));
						$s->addOption( ffOneOption::TYPE_CHECKBOX, str_replace(' ', '_', $name),  ark_wp_kses( __(  'Enable font ' , 'ark' ) ) .ucfirst($name), 0);
						$s->addElement( ffOneElement::TYPE_NEW_LINE );
						$s->addElement( ffOneElement::TYPE_HTML, '', '<div class="theme-options-icons-preview-wrapper">' );
						$s->addElement( ffOneElement::TYPE_HTML, '', $iconfont_examples[ $name ] );
						$s->addElement( ffOneElement::TYPE_HTML, '', '</div>' );
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
				}

			$s->addElement( ffOneElement::TYPE_TABLE_END );

		$s->endSection();
		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// PORTFOLIO
////////////////////////////////////////////////////////////////////////////////


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-collection-content-area ff-collection-options ffb-options" data-name="Portfolio">' );

		$s->startSection('portfolio');

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Note' , 'ark' ) ) );
					$s->addElement(ffOneElement::TYPE_DESCRIPTION, '', ark_wp_kses(__('Please note, that if you use any caching plugin, you should delete cache to apply changes.', 'ark')));
					$s->addElement(ffOneElement::TYPE_DESCRIPTION, '', ark_wp_kses(__('If settings did not apply, go to <a href="./options-permalink.php" target="_blank">WordPress Admin &rArr; Settings &rArr; Permalinks</a> and press there <strong>Save changes</strong> even if you did not change anything.', 'ark')));
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Portfolio post Slug' , 'ark' ) ) );
					$s->addOption( ffOneOption::TYPE_TEXT, 'portfolio_slug', '' , 'portfolio');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Portfolio Category Slug' , 'ark' ) ) );
					$s->addOption( ffOneOption::TYPE_TEXT, 'portfolio_category_slug',  '' , 'portfolio-category');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', ark_wp_kses( __(  'Portfolio Tag Slug' , 'ark' ) ) ) ;
					$s->addOption( ffOneOption::TYPE_TEXT, 'portfolio_tag_slug',  '', 'portfolio-tag');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );
		$s->endSection();
		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// GOOGLE API
////////////////////////////////////////////////////////////////////////////////



		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-collection-content-area ff-collection-options ffb-options" data-name="Google API">' );
		$s->startSection('gapi');

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ark_wp_kses( __( 'Google API key' , 'ark' ) ) );

					$s->addOption(ffOneOption::TYPE_TEXT, 'key', ark_wp_kses( __(  'Google API key' , 'ark' ) ) , '');

					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '<p>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', ark_wp_kses( __( 'Please note, that you must have Google account (email) to create API key.' , 'ark' ) ) );
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '</p>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '<ol>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '<li>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', ark_wp_kses( __( 'Go to the page <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key</a> and click on the button <strong class="btn btn-xs btn-primary">GET A KEY</strong>.' , 'ark' ) ) );
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '</li>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '<li>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', ark_wp_kses( __( 'Click on <strong class="btn btn-xs btn-primary">Continue</strong> -it will take a moment' , 'ark' ) ) );
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '</li>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '<li>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', ark_wp_kses( __( 'Click on <strong class="btn btn-xs btn-primary">Create</strong>' , 'ark' ) ) );
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '</li>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '<li>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', ark_wp_kses( __( 'There will be the modal window with input labeled <code>Here is your API key</code>' , 'ark' ) ) );
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '</li>');
					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '</ol>');

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );

		$s->endSection();

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );


////////////////////////////////////////////////////////////////////////////////
// END
////////////////////////////////////////////////////////////////////////////////

		$s->addElement( ffOneElement::TYPE_HTML, '', '</div>' ); // ending of TOP HIDING PARENT

		$s->endSection();

		return $s;
	}

}










