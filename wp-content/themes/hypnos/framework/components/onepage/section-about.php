<?php

################################################################################
# ABOUT START
################################################################################

$s->startSection('about', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'About')
		->addParam('hide-default', false)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-about'))
		;

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-about').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General');


			$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'about us');

			$descriptionDefault = 'We are relentless in moving boundaries and carry out this spirited attitude into <a href="#services" data-gal="m_PageScroll2id" data-ps2id-offset="65">digital solutions.<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a> Solutions that engage, <a href="#work" data-gal="m_PageScroll2id" data-ps2id-offset="65">inspire<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a> and make you think.';
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'description', 'Description', $descriptionDefault);


		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Content');

			$s->startSection('one-item-left', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Text Icon Block - Left');

					$s->addOption(ffOneOption::TYPE_ICON, 'icon','','ff-font-awesome4 icon-help');

					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'Listen');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$descriptionDefault = 'Simply dummy text of the printing and typesetting industry.';
					$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', 'Description', $descriptionDefault);
				$s->endSection();
			$s->endSection();

			$s->addOption( ffOneOption::TYPE_IMAGE, 'center-image', '', '', 'Center Image');

			$s->startSection('one-item-right', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Text Icon Block - Right');

					$s->addOption(ffOneOption::TYPE_ICON, 'icon','','ff-font-awesome4 icon-help')
							->addParam('data-autofilter', 'font-awesome');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'Networking');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$descriptionDefault = 'Simply dummy text of the printing and typesetting industry.';
					$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', 'Description', $descriptionDefault);
				$s->endSection();
			$s->endSection();

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();

################################################################################
# ABOUT END
################################################################################
