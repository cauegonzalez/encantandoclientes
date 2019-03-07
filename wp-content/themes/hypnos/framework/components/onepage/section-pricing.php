<?php

################################################################################
# PRICING START
################################################################################

$s->startSection('pricing', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Pricing Table')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-pricing'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-pricing').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

	$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General');
		$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'EFFICIENT AFFORDABLE PRICING MODELS');

	$s->startSection('one-table', ffOneSection::TYPE_REPEATABLE_VARIABLE);
		$s->startSection('item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'One Table');

			$s->addOption( ffOneOption::TYPE_CHECKBOX, 'highlight', 'Highlight', 0);
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_ICON, 'icon', 'Icon');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'Basic');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'price', 'Price', '$5.99');

			$s->startSection('one-line', ffOneSection::TYPE_REPEATABLE_VARIABLE );
				$s->startSection('line')->addParam('section-name', 'Text Line');
					$s->addOption( ffOneOption::TYPE_TEXT, 'text', 'Text', '<strong>24/7</strong> TECH SUPPORT');
				$s->endSection();
			$s->endSection();

			$s->startSection('button');
				$s->addOption( ffOneOption::TYPE_TEXT, 'text', 'Button Text', 'Buy Now');
				$s->addOption( ffOneOption::TYPE_TEXT, 'href', 'Href', '#');
			$s->endSection();

		$s->endSection();
	$s->endSection();

	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();

################################################################################
# PRICING END
################################################################################
