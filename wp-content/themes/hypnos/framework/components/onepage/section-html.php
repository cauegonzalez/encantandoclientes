<?php

################################################################################
# HTML START
################################################################################

$s->startSection('html', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'HTML')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-html'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img width="200" src="'.ff_get_section_preview_image_url('section-html').'">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'HTML');

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'wrap-with-section', 'Wrap with section (settings above)', 1);

			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption( ffOneOption::TYPE_TEXTAREA, 'html', 'HTML', '');

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();

################################################################################
# HTML END
################################################################################