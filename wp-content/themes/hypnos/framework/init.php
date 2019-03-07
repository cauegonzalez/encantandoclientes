<?php

function ff_template_initialize() {
	$templateName = 'Hypnos';
	
	$fwc = ffContainer::getInstance();
	$fwc->getFramework()->loadOurTheme();
	//$fwc->getFramework()
}

ff_template_initialize();