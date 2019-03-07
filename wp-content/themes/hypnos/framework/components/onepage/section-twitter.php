<?php

################################################################################
# TWITTER START
################################################################################

$s->startSection('twitter', ffOneSection::TYPE_REPEATABLE_VARIATION)
		->addParam('section-name', 'Twitter')
		->addParam('hide-default', true)

		->addParam('advanced-picker-menu-title', 'Common')
		->addParam('advanced-picker-menu-id', 'common')
		->addParam('advanced-picker-section-image', ff_get_section_preview_image_url('section-twitter'));

	$s->addElement( ffOneElement::TYPE_TABLE_START );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Preview');
			$s->addElement(ffOneElement::TYPE_HTML,'','<img src="'.ff_get_section_preview_image_url('section-twitter').'" width="250">');
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		require dirname(__FILE__).'/part-section-id.php';

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Background');
			$s->addOption( ffOneOption::TYPE_IMAGE, 'background-image', '', '', '');
			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addOption(ffOneOption::TYPE_SELECT, 'parallax_speed', 'Parallax speed', '0.4')
				->addSelectValue( 'No parallax effect', '0' )
				->addSelectValue( 'Speed 1', '0.1' )
				->addSelectValue( 'Speed 2', '0.2' )
				->addSelectValue( 'Speed 3', '0.3' )
				->addSelectValue( 'Speed 4', '0.4' )
			;
		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'General');

			$s->startSection('fw_twitter');
				$s->addOption(ffOneOption::TYPE_TEXT, 'username', 'Username', '_freshface');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption(ffOneOption::TYPE_TEXT, 'number-of-tweets', 'Number of Tweets', '5');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption(ffOneOption::TYPE_TEXT, 'caching-time-in-minutes', 'Caching time in minutes', '60');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );

				// $this->_auth['consumerKey'], $this->_auth['consumerSecret'], $this->_auth['accessToken'], $this->_auth['accessTokenSecret']

				$s->addOption(ffOneOption::TYPE_TEXT, 'consumer-key', 'Consumer Key');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption(ffOneOption::TYPE_TEXT, 'consumer-secret', 'Consumer Secret');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption(ffOneOption::TYPE_TEXT, 'access-token', 'Access Token');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption(ffOneOption::TYPE_TEXT, 'access-token-secret', 'Access Token Secret');
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->endSection();

		$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

	$s->addElement( ffOneElement::TYPE_TABLE_END );

$s->endSection();

################################################################################
# TWITTER END
################################################################################