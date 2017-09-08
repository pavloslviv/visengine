<?php

function ff_template_initialize() {
	$fwc = ffContainer::getInstance();
	$fwc->getFramework()->loadOurTheme();
}

ff_template_initialize();