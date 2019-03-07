<?php

################################################################################
# FEATURED START
################################################################################

$s->startSection('featured', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Featured')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-featured'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-featured').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General');

			$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'our featured works');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'button-title', 'Button Title', 'all projects');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'button-title-hover', 'Button Title on Hover', 'see projects');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'button-link', 'Button Link', '#work');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Historical Events');

			$s->startSection('projects', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('one-project', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Project');

				$s->addOption(ffOneOption::TYPE_IMAGE, 'image', '', '', '');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'Featured project');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption( ffOneOption::TYPE_TEXT, 'link', 'Link', '#');

				$s->endSection();
			$s->endSection();

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();

################################################################################
# FEATURED END
################################################################################