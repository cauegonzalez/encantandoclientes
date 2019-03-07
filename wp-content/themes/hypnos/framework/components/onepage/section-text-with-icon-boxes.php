<?php

################################################################################
# ICONBOXES START
################################################################################

$s->startSection('text-with-icon-boxes', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Text with icon boxes')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-text-with-icon-boxes'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-text-with-icon-boxes').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Boxes');
			$s->startSection('item', ffOneSection::TYPE_REPEATABLE_VARIABLE);
				$s->startSection('one-item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Text with Icon Box');

					$animation = $s->addOption(ffOneOption::TYPE_SELECT, 'animation', 'Animation', '');
					foreach (array('top', 'right', 'bottom', 'left') as $mov) {
						$animation->addSelectValue( 'From '.$mov, $mov );
					}
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					$s->addOption(ffOneOption::TYPE_ICON, 'icon','','ff-font-awesome4 icon-phone')
							->addParam('data-autofilter', 'font-awesome');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_TEXT, 'title', 'Title', 'Unlimited Pages');
					$s->addOption( ffOneOption::TYPE_TEXTAREA, 'description', 'Description', 'Nascetur ridiculus mus. Penatibus et magnis dis parturient montes. Simply dummy text of the printing. Ipsum has been the industry\'s standard.');
					$s->addOption( ffOneOption::TYPE_TEXTAREA, 'overlay', 'Overlay text', 'You may build your free professional website <br/>with a complete liberty of customization.');

				$s->endSection();
			$s->endSection();
			$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
		$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
################################################################################
# ICONBOXES END
################################################################################