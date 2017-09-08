<?php

function ark_boxed_wrapper_start() {
	if( !FF_ARK_ENVIRONMENT_READY ) {
		return;
	}

	$vdm = ffContainer()->getThemeFrameworkFactory()->getSitePreferencesFactory()->getViewDataManager();
	$currentBoxedWrapper = $vdm->getCurrentBoxedWrapper();


	if ($currentBoxedWrapper == 'none') {
		return false;
	}

	$walker = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderShortcodesWalker();
	$shortcodePrinter = $walker->renderSpecificElement('boxed-wrapper', $currentBoxedWrapper->get('options'), 'boxed-wrapper');
	$themeBuilderManager = ffContainer()->getThemeFrameworkFactory()->getThemeBuilderManager();
//	$themeBuilderManager->addRenderdCssToStack( $walker->getRenderedCss() );
	$themeBuilderManager->printRenderedCss();


	echo $shortcodePrinter;
}

function ark_boxed_wrapper_end() {
	if( !FF_ARK_ENVIRONMENT_READY ) {
		return;
	}

	$vdm = ffContainer()->getThemeFrameworkFactory()->getSitePreferencesFactory()->getViewDataManager();
	$currentBoxedWrapper = $vdm->getCurrentBoxedWrapper();


	if ($currentBoxedWrapper == 'none') {
		return false;
	}

	echo '</div>';
	echo '</div>';
}