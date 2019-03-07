<?php

################################################################################
# TEXTBOXES START
################################################################################

$s->startSection('text-boxes', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Text boxes')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-text-boxes'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-text-boxes').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Boxes');
			$s->startSection('item', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('one-item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Text Box');

					$animation = $s->addOption(ffOneOption::TYPE_SELECT, 'animation', 'Animation', '');
					foreach (array('top', 'right', 'bottom', 'left') as $mov) {
						$animation->addSelectValue( 'From '.$mov, $mov );
					}
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'OFFICE:');
					$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', 'Description', 'NIKOLE TESLE 41, KRALJEVO, SERBIA');

				$s->endSection();
			$s->endSection();
			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
################################################################################
# TEXTBOXES END
################################################################################