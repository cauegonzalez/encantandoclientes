<?php

################################################################################
# TEAM START
################################################################################

$s->startSection('team', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Team')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-team'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-team').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General');

			$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'our team');
	
			$descriptionDefault = 'WE\'RE A SMALL, FRIENDLY AND TALENTED TEAM. WE CRAFT BEAUTIFUL <a href="#services" data-gal="m_PageScroll2id" data-ps2id-offset="65">DIGITAL SOLUTIONS<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a> FOR AWESOME <a href="#clients" data-gal="m_PageScroll2id" data-ps2id-offset="65">CLIENTS<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a> ACROSS ALL THE PLATFORMS.';
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'description', 'Description', $descriptionDefault);
	
	
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		
		
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Team Members');

			$s->startSection('one-item', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Team Member');

// icon / number / description
//TODO
					$s->addOption( ffOneOption::TYPE_IMAGE, 'image', '', '', 'Photo');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'name', 'Name', 'Alex Andrews');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'position', 'Position', 'Co-Founder / CEO');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', 'Description', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXTAREA, 'social-links', 'Social Links', 'https://twitter.com/_freshface
https://www.facebook.com/freshfacethemes
https://plus.google.com/107285294994146126204
http://www.linkedin.com/company/envato
http://www.flickr.com/photos/we-are-envato');

				$s->endSection();
			$s->endSection();
			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
################################################################################
# TEAM END
################################################################################