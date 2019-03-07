<?php

################################################################################
# VIDEO START
################################################################################

$s->startSection('video', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Video')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-video'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-video').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General');

			$s->addOption(ffOneOption::TYPE_TEXT, 'video', 'YouTube/Vimeo video URL', 'http://player.vimeo.com/video/88883554?title=0&byline=0&portrait=0&color=323232');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_TEXT, 'title', 'Title', 'Inspiring days for web designers.');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

			$s->addOption(ffOneOption::TYPE_TEXTAREA, 'description', 'Description', '"Believe in what you do, do what matters, and do it with love."');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
	$s->addElement( ffOneElement::TYPE_TABLE_END );
$s->endSection();
################################################################################
# VIDEO END
################################################################################