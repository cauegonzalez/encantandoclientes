<?php

################################################################################
# CONTACT START
################################################################################

$s->startSection('contact', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Contact')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-contact'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-contact').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Centered box');
			$s->addOption( ffOneOption::TYPE_TEXT, 'center-title', 'Title', 'Contact');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'center-description', 'Description', 'Let us work with you to create <a href="#services" data-gal="m_PageScroll2id" data-ps2id-offset="65">online strategy<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a> that works');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Form settings');
			$s->addOption( ffOneOption::TYPE_TEXT, 'msg_email', 'Your email', 'freshface@mailinator.com');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'msg_subject', 'Your subject', 'Contact Form - ' . get_site_url() );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Form labels');
			$s->addOption(ffOneOption::TYPE_TEXT, 'form-title', 'Title', 'WANT TO DISCUS YOUR IDEAS?');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'form-name', 'Name', 'Your name: *');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'form-email', 'E-mail', 'e-mail: *');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'form-content', 'Message', 'Tell us everything');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'form-send', 'Send button', 'Submit');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Form Messages');
			$s->addOption(ffOneOption::TYPE_TEXT, 'err-name', 'Please enter name', 'please enter name');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'err-email', 'Please enter e-mail', 'please enter e-mail');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'err-emailvld', 'E-mail is not a valid format', 'e-mail is not a valid format');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'err-form', 'There was a problem validating the form please check!', 'There was a problem validating the form please check!');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'err-timedout', 'The connection to the server timed out!', 'The connection to the server timed out!');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'ajaxsuccess', 'Successfully sent!', 'Successfully sent!');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'err-email-sending', 'Error when sending email', 'An error ocurred, please try again later');
			
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );

$s->endSection();
################################################################################
# CONTACT END
################################################################################