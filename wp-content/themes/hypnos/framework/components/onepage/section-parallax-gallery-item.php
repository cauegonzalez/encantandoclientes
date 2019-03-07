<?php

################################################################################
# PARALLAX GALLERY ITEM START
################################################################################

$s->startSection('parallax-gallery-item', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Parallax Gallery Item')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-parallax-gallery-item'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-parallax-gallery-item').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General');

			$s->addOption(ffOneOption::TYPE_IMAGE, 'background-image', '', '', 'Background');
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
			$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'DREAMY HONEY');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'description', 'Description', 'When Honey appears, she brings an <span>eternal summer</span> along.');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_SELECT, 'align', 'Text align', 'left')
				->addSelectValue('left', 'left')
				->addSelectValue('right', 'right')
			;


		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
################################################################################
# PARALLAX-GALLERY-ITEM END
################################################################################