<?php

################################################################################
# MAP START
################################################################################

$s->startSection('map', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Map')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-map'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-map').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Section');
			$s->addOption( ffOneOption::TYPE_TEXT, 'section-title', 'Title', 'Locate Us on Map');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', (__('Info','stig')));
			$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '<p style="color:#FF0000">
							Please note, that you must have Google API to make google map work. Go to the page
							<a href="./themes.php?page=ThemeOptions#ff-theme-mix-admin-tab-gapi" target="_blank">
								WP Admin Menu &rArr; Appearance &rArr; Theme Options &rArr; tab Google API
							</a>
							to create it.');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Map');
			$s->addOption( ffOneOption::TYPE_TEXT, 'longitude', 'longitude', '44.789511');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'latitude', 'latitude', '20.43633');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'map-size', 'Map size', '14');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Marker');
			$s->addOption( ffOneOption::TYPE_TEXT, 'marker-title', 'Title', 'HYPNOS');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption( ffOneOption::TYPE_TEXT, 'marker-description', 'Description', 'Checking out our office too?');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

	$s->addElement( ffOneElement::TYPE_TABLE_END );

$s->endSection();
################################################################################
# MAP END
################################################################################