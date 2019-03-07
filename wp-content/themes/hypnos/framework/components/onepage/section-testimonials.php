<?php

################################################################################
# TESTIMONIALS START
################################################################################

$s->startSection('testimonials', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Testimonials')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-testimonials'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-testimonials').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Testimonials');

			$s->addOption(ffOneOption::TYPE_IMAGE, 'background-image', '', '', 'Background');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_SELECT, 'parallax_speed', 'Parallax speed', '0.4')
				->addSelectValue( 'No parallax effect', '0' )
				->addSelectValue( 'Speed 1', '0.1' )
				->addSelectValue( 'Speed 2', '0.2' )
				->addSelectValue( 'Speed 3', '0.3' )
				->addSelectValue( 'Speed 4', '0.4' )
			;

			$s->startSection('one-item', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Testimonial');
 
					$testimonialDefault = '"Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus of the printing and typesetting industry."';
					$s->addOption(ffOneOption::TYPE_IMAGE, 'image', '', '', 'Image');
					$s->addOption(ffOneOption::TYPE_TEXTAREA, 'testimonial','Testimonial', $testimonialDefault);
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'author', 'Author', 'Harra Halloy');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'position', 'Position', 'CEO of Hypnos');
					
					 
				
				$s->endSection();
			$s->endSection();
		
	
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
################################################################################
# TESTIMONIALS END
################################################################################