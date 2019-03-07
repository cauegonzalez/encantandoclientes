<?php

################################################################################
# SMALL HEADER START
################################################################################

$s->startSection('small-header', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Small Header')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-small-header'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-small-header').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Header');
			$s->addOption( ffOneOption::TYPE_TEXT, 'link', 'Link', '#contact');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'ARE YOU READY TO START A CONVERSATION?');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'description', 'Description', 'Get In Touch!');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

	$s->addElement( ffOneElement::TYPE_TABLE_END );

$s->endSection();

################################################################################
# SMALL HEADER END
################################################################################
