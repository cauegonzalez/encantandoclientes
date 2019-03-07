<?php

################################################################################
# SERVICES START
################################################################################

$s->startSection('services', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Services')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-services'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-services').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Centered box');
			$s->addOption( ffOneOption::TYPE_TEXT, 'center-title', 'Title', 'Services');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'center-description', 'Description', '<a href="#team" data-gal="m_PageScroll2id" data-ps2id-offset="65">We tackle business problems<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a> with intelligence. We use cutting-edge tech and cutting-edge thinking to bring <a href="#clients" data-gal="m_PageScroll2id" data-ps2id-offset="65">brands<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a> to life online and direct consumer behaviour.');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Left');
			$s->addOption( ffOneOption::TYPE_TEXT, 'left-title', 'Title', 'THE BEST SOLUTION FOR YOUR BUSINESS');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'left-description', 'Description', 'We believe in coming up with original ideas and turning them into digital work that is both innovative and measurable. We tackle business problems with intelligence.');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Right');
			$s->startSection('right-item', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('one-item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Services Right Item');

					$s->addOption( ffOneOption::TYPE_TEXTAREA, 'text', 'Text', 'Ipsum has been the industry\'s standard. Simply dummy text of the printing.');

				$s->endSection();
			$s->endSection();
			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
################################################################################
# SERVICES END
################################################################################