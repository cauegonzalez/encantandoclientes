<?php

################################################################################
# PORTFOLIO START
################################################################################

$s->startSection('portfolio', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Portfolio')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-portfolio'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-portfolio').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General');

			$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'Our work');

			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'description', 'Description', '<a href="#about" data-gal="m_PageScroll2id" data-ps2id-offset="65">We believe<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a> in coming up with original ideas and turning them into digital work that is both <a href="#services" data-gal="m_PageScroll2id" data-ps2id-offset="65">innovative and measurable.<svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a>');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Portfolio filter');
			$s->addOption( ffOneOption::TYPE_TEXT, 'show_all', 'Show all text translation', 'Show all');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addElement( ffOneElement::TYPE_HTML, '', '<div style="display:none;">');
			$s->addOption(ffOneOption::TYPE_SELECT, 'filter_portfolio_by', 'Filter Portfolio by', '')
				->addSelectValue( 'Portfolio Tag', '' )
				->addSelectValue( 'Portfolio Category', 'category' )
			;
			$s->addElement( ffOneElement::TYPE_HTML, '', '</div>');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Portfolio Categories');
			$s->addOption( ffOneOption::TYPE_TAXONOMY, 'taxonomies-ff', 'Taxonomies', '')
				->addParam('tax_type', 'ff-portfolio-category')
				->addParam('type', 'multiple');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Portfolio items are shown only from these portfolio categories. (If you leave this blank, then all are shown.)' );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();//*/
################################################################################
# PORTFOLIO END
################################################################################