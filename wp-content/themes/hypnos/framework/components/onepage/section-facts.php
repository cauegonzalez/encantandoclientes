<?php

################################################################################
# FUN FACTS START
################################################################################

$s->startSection('fun-facts', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Facts')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-facts'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-facts').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


		require dirname(__FILE__).'/part-section-id.php';


		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Facts');
			$s->startSection('one-fact', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Fact');
					$s->addOption( ffOneOption::TYPE_TEXT, 'number', 'Number', '87');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'description', 'Description', 'Clients');
				$s->endSection();
			$s->endSection();
			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
################################################################################
# FUN FACTS END
################################################################################