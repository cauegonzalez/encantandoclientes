<?php

################################################################################
# SLIDER START
################################################################################

$s->startSection('slider', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Slider')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Slider')
		->addParam('advanced-picker-menu-id', 'slider')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-slider'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-slider').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Slider Revolution');

			$s->addOption(ffOneOption::TYPE_REVOLUTION_SLIDER, 'id', '', '');
			// $slider = $s->addOption(ffOneOption::TYPE_SELECT, 'id', '', '');

			// $slider->addSelectValue(' - NO SLIDER SELECTED - ', '');

			// global $wpdb;

			// $table_name = $wpdb->prefix.'revslider_sliders';
			// if($wpdb->get_var('SHOW TABLES LIKE "'.$table_name.'"') == $table_name) {
			// 	$SQL = 'SELECT `title`, `alias` FROM `'.$table_name.'`';
			// 	$results = $wpdb->get_results( $SQL, ARRAY_A );
			// }

			// if( !empty($results) ){
			// 	foreach ($results as $row) {
			// 		$slider->addSelectValue( $row['title'], $row['alias'] );
			// 	}
			// }

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Background Image');
			$s->startSection('background-image');

				$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show', 'Use', 0);
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption(ffOneOption::TYPE_SELECT, 'effect', 'Effect', '')
					->addSelectValue( 'None / Cover', '' )
					->addSelectValue( 'Parallax effect', 'parallax' )
					->addSelectValue( 'Pattern', 'pattern' );

				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption( ffOneOption::TYPE_IMAGE, 'image', '', '', 'Background image');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption(ffOneOption::TYPE_SELECT, 'parallax_speed', 'Parallax speed', '0.4')
					->addSelectValue( 'No parallax effect', '0' )
					->addSelectValue( 'Speed 1', '0.1' )
					->addSelectValue( 'Speed 2', '0.2' )
					->addSelectValue( 'Speed 3', '0.3' )
					->addSelectValue( 'Speed 4', '0.4' )
				;

			$s->endSection();
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Background Video');
			$s->startSection('background-video');

				$s->addOption(ffOneOption::TYPE_CHECKBOX, 'show', 'Use', 0);
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption( ffOneOption::TYPE_TEXT, 'mp4',  'MP4 Url',  'http://demo.freshface.net/hypnos-light/wp-content/uploads/sites/6/2014/11/video.mp4' );
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption( ffOneOption::TYPE_TEXT, 'webm', 'WEBM Url', 'http://demo.freshface.net/hypnos-light/wp-content/uploads/sites/6/2014/11/video.webm' );
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption( ffOneOption::TYPE_TEXT, 'ogg',  'OGV Url',  'http://demo.freshface.net/hypnos-light/wp-content/uploads/sites/6/2014/11/video.ogg' );

				$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Fields "OGV Url", "WEBM Url" and "MP4 Url" are for different web browsers. Some browser supports all videos format, some only one. Remove from ALL fields "http://demo.freshface.net/ ..." if you put somewhere your video.');
			$s->endSection();

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

	$s->addElement( ffOneElement::TYPE_TABLE_END );

$s->endSection();//*/
################################################################################
# SLIDER END
################################################################################