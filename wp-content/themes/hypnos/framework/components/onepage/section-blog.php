<?php

################################################################################
# PORTFOLIO START
################################################################################

$s->startSection('blog', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Blog')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-blog'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-blog').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General');

			$s->addOption( ffOneOption::TYPE_IMAGE, 'background-image', '', '', 'Background Image');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_SELECT, 'parallax_speed', 'Parallax speed', '0.4')
				->addSelectValue( 'No parallax effect', '0' )
				->addSelectValue( 'Speed 1', '0.1' )
				->addSelectValue( 'Speed 2', '0.2' )
				->addSelectValue( 'Speed 3', '0.3' )
				->addSelectValue( 'Speed 4', '0.4' )
			;

			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'Read Our Blog');

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Posts');

			$s->addOption(ffOneOption::TYPE_TEXT, 'post-count', 'Count', 6);
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_HTML, '', '<label>Category</label>' );
			$s->addOption( ffOneOption::TYPE_TAXONOMY, 'taxonomies', 'Taxonomies', 'all')
				->addParam('tax_type', 'category')
				->addParam('type', 'multiple');

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Botom button');
			$s->addOption(ffOneOption::TYPE_TEXT, 'read-more-link', 'Link', get_home_url() );
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXT, 'read-more', 'Title', 'More News ...');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();//*/
################################################################################
# PORTFOLIO END
################################################################################