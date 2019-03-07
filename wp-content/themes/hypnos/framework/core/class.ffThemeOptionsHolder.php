<?php

class ffThemeOptionsHolder extends ffOptionsHolder {

	protected function layoutIMG( $subpath ){
		$subpath = str_replace('loop-archive-', '', $subpath);
		$subpath = str_replace('loop-single-', '', $subpath);
		return '<img src="' . get_template_directory_uri().'/assets/images/'.$subpath .'.png" />';
	}

	protected function layoutOption( $s, $name, $default, $values ){

		$s->addElement( ffOneElement::TYPE_HTML, '', '<div class="ff-theme-layout-changer">' );

		$option = $s->addOption( ffOneOption::TYPE_RADIO, $name, '', $default);

		foreach ($values as $img) {
			$option->addSelectValue( $this->layoutIMG( $img ) , $img);
		}

		$s->addElement( ffOneElement::TYPE_HTML, '', '</div>' );

		return $option;
	}

	protected function skinOption( $s, $name, $default, $values ){

		$s->addElement( ffOneElement::TYPE_HTML, '', '<div class="ff-theme-layout-changer">' );

		$option = $s->addOption( ffOneOption::TYPE_RADIO, $name, '', $default);

		$colors = array(
			'light'   => '#EEE',
			'dark'    => '#252525',
			'blue'    => '#3498db',
			'green'   => '#2ecc71',
			'orange'  => '#e67e22',
			'red'     => '#e74c3c',
			'yellow'  => '#f1c40f',
		);

		foreach ($values as $skin) {
			$option->addSelectValue( '<span style="display:inline-block;width:50px;height:50px;background-color:'.$colors[$skin].';border:1px solid #333"> &nbsp; </span>' , $skin);
		}

		$s->addElement( ffOneElement::TYPE_HTML, '', '</div>' );

		return $option;
	}

	public function getOptions() {

		$s = $this->_getOnestructurefactory()->createOneStructure( ffThemeContainer::OPTIONS_NAME );

		$s->startSection( ffThemeContainer::OPTIONS_NAME, ffOneSection::TYPE_NORMAL );

			$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-layout ff-theme-mix-admin-tab-content">' );
			$s->startSection('layout');

				$s->addElement( ffOneElement::TYPE_HEADING, '', 'Page Layout' );
				$s->addElement( ffOneElement::TYPE_TABLE_START );
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Layout');

						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'page-layout-boxed', 'Use boxed layout', 0);
						$s->addElement( ffOneElement::TYPE_NEW_LINE );
						$s->addOption( ffOneOption::TYPE_IMAGE, 'background-image', 'Background Image' );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
				$s->addElement( ffOneElement::TYPE_TABLE_END );


				$s->addElement( ffOneElement::TYPE_HEADING, '', 'Special' );

				$s->addElement( ffOneElement::TYPE_TABLE_START );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Page loader');

						$s->addOption( ffOneOption::TYPE_TEXT, 'pageloader-text', 'Text', 'PASSION - LOVE - MOTIVATION');
						$s->addElement( ffOneElement::TYPE_NEW_LINE );
						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'disable-pageloader', 'Disable page loader overlay');

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Smooth Scroll');
						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'disable-smoothscroll', 'Disable smoothscroll script');

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_END );

				$s->addElement( ffOneElement::TYPE_HEADING, '', 'Post Meta' );

				$s->addElement( ffOneElement::TYPE_TABLE_START );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Post Meta');

						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'disable-postmeta', 'Disable Post Meta on Category');

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Post Meta Date');

						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'postmeta-date-show', 'Show date', 1);

						$s->addElement( ffOneElement::TYPE_NEW_LINE );

						$s->addOption( ffOneOption::TYPE_TEXT, 'postmeta-date-format', 'Post Meta Date format', 'M j Y');

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Post Meta Categories');

						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'postmeta-categories-show', 'Show categories', 1);

						$s->addElement( ffOneElement::TYPE_NEW_LINE );

						$s->addOption( ffOneOption::TYPE_TEXT, 'postmeta-categories-format', 'Post Meta Categories text', 'Categories: %s');

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Post Meta Tags');

						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'postmeta-tags-show', 'Show tags', 1);

						$s->addElement( ffOneElement::TYPE_NEW_LINE );

						$s->addOption( ffOneOption::TYPE_TEXT, 'postmeta-tags-format', 'Post Meta Tags text', 'Tags: %s');

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Comments Meta Date');

						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'commentsmeta-date-show', 'Show date', 1);

						$s->addElement( ffOneElement::TYPE_NEW_LINE );

						$s->addOption( ffOneOption::TYPE_TEXT, 'commentsmeta-date-format', 'Comments Meta Date', 'M j Y, H:i');

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );


				$s->addElement( ffOneElement::TYPE_TABLE_END );


			$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div><div class="ff-theme-mix-admin-tab-sidebars ff-theme-mix-admin-tab-content">' );

				$s->addElement( ffOneElement::TYPE_HEADING, '', 'Sidebar Layout' );

				$s->addElement( ffOneElement::TYPE_TABLE_START );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Post Page');

						$this->layoutOption(
							$s, 'post_page', 'loop-archive-cs-1'
							, array(
								'loop-archive-c-1' ,
								'loop-archive-sc-1' ,
								'loop-archive-cs-1' ,
							)
						);

						$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Your latest posts / Posts page / Home');
						$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'If Front page displays a static page, choose sidebar on/off in page template writepanel');

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Categories, Tags, Author and&nbsp;Date Archives');
						$this->layoutOption(
							$s, 'archives', 'loop-archive-cs-1'
							, array(
								'loop-archive-c-1' ,
								'loop-archive-sc-1' ,
								'loop-archive-cs-1' ,
							)
						);

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Search Page');
						$this->layoutOption(
							$s, 'search', 'loop-archive-cs-1'
							, array(
								'loop-archive-c-1' ,
								'loop-archive-sc-1' ,
								'loop-archive-cs-1' ,
							)
						);

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', '404 Page');
						$this->layoutOption(
							$s, '404', 'loop-archive-cs-1'
							, array(
								'loop-archive-sc-1' ,
								'loop-archive-cs-1' ,
							)
						);

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Single');
						$this->layoutOption(
							$s, 'single_post', 'loop-single-cs-1'
							, array(
								'loop-single-c-1' ,
								'loop-single-cs-1' ,
								'loop-single-sc-1' ,
							)
						);

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_END );


			$s->endSection();

			$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div><div class="ff-theme-mix-admin-tab-skins ff-theme-mix-admin-tab-content">' );
			$s->startSection('colors');

				$s->addElement( ffOneElement::TYPE_HEADING, '', 'Skins and accents' );

				$s->addElement( ffOneElement::TYPE_TABLE_START );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Skin');

						$this->skinOption(
							$s, 'skin', 'light'
							, array(
								'light' ,
								'dark' ,
							)
						);

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Color Accent');

						$this->skinOption(
							$s, 'accent', 'blue'
							, array(
								'blue' ,
								'green' ,
								'orange' ,
								'red' ,
								'yellow' ,
							)
						);

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_END );

			$s->endSection();

			$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div><div class="ff-theme-mix-admin-tab-fonts ff-theme-mix-admin-tab-content">' );

			$s->startSection('font');

				$s->addElement( ffOneElement::TYPE_HEADING, '', 'Fonts' );

				$s->addElement( ffOneElement::TYPE_TABLE_START );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Headers');
						$s->addOption( ffOneOption::TYPE_CHECKBOX, 'default_headers', 'Use theme font for Headers: &nbsp;', 1);
						$s->addOption(ffOneOption::TYPE_SELECT, 'theme-header', ' ', '')
							->addSelectValue('Axis font face', 'axis')
							->addSelectValue('Vollkorn font face', 'Vollkorn-Bold')
							->addSelectValue('Sifonn font face', 'Sifonn-Basic')
						;

						$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'If this option is checked, first next font option will be ingored on headers.');
						$s->addElement( ffOneElement::TYPE_NEW_LINE );
						$s->addOption( ffOneOption::TYPE_FONT, 'headers', 'Family ', "'Open Sans'");
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Body');
						$s->addOption( ffOneOption::TYPE_FONT, 'body', 'Family ', "'Lato'");
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Buttons');
						$s->addOption( ffOneOption::TYPE_FONT, 'buttons', 'Family ', "'Open Sans'");
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

					$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Pre, Code');
						$s->addOption( ffOneOption::TYPE_FONT, 'pre', 'Family ', "'Courier New', Courier, monospace");
					$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_END );

			$s->endSection();

			$s->startSection('header');

			$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div><div class="ff-theme-mix-admin-tab-header ff-theme-mix-admin-tab-content">' );

			$s->addElement( ffOneElement::TYPE_HEADING, '', 'Header Logo' );

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Header Logo');
					$s->addOption( ffOneOption::TYPE_TEXT, 'logo_text', 'Logo text', 'HYPNOS' );
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_CHECKBOX, 'logo_use_image', 'Use logo image instead of text', 0);
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption( ffOneOption::TYPE_IMAGE, 'logo_image_url', 'Logo Image' );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
			$s->addElement( ffOneElement::TYPE_TABLE_END );


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );
		$s->endSection();

		$s->startSection('footer');
			$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', ' <div class="ff-theme-mix-admin-tab-footer ff-theme-mix-admin-tab-content">' );

				$s->addElement( ffOneElement::TYPE_HEADING, '', 'Footer' );

				$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Footer icons');

				$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-icons', 'Show footer icons', 1);

				$s->startSection('footer-icons', ffOneSection::TYPE_REPEATABLE_VARIABLE);
					$s->startSection('item', ffOneSection::TYPE_REPEATABLE_VARIATION)->addParam('section-name', 'Links');

						$s->addOption( ffOneOption::TYPE_TEXT, 'link', 'Link', 'https://twitter.com/_freshface');
						$s->addElement( ffOneElement::TYPE_NEW_LINE );
						$s->addOption(ffOneOption::TYPE_ICON, 'icon','Icon','ff-font-awesome4 icon-twitter');
					$s->endSection();
				$s->endSection();

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Footer text');

				$s->addOption( ffOneOption::TYPE_CHECKBOX, 'show-text', 'Show footer text', 1);
				$s->addElement( ffOneElement::TYPE_NEW_LINE );
				$s->addOption( ffOneOption::TYPE_TEXTAREA, 'text', 'Text', '&copy;2014 ALL RIGHT RESERVED.' );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
				$s->addElement( ffOneElement::TYPE_TABLE_END );


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );
		$s->endSection();


		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-translations ff-theme-mix-admin-tab-content">' );
		$s->startSection('translation');


			$s->addElement( ffOneElement::TYPE_HEADING, '', 'Translations' );

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->startSection('posts');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Posts');

					$s->addOption( ffOneOption::TYPE_TEXT, 'posted_by', 'Posted by %s', __('By %s', 'default') );
					$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', '"Posted by" author in article footer');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					$s->addOption( ffOneOption::TYPE_TEXT, 'Excerpt_More', 'Excerpt More', __('Read More', 'default') );
					$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', '"More ..." or "Read More" text in posts');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
				$s->endSection();

				$s->startSection('comment_list');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Comments');

					$s->addOption(ffOneOption::TYPE_TEXT, 'comments_zero', '<span>No</span> Comments', '<span>No</span> Comments');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption(ffOneOption::TYPE_TEXT, 'comments_one', 'Comment <span>(1)</span>', 'Comment <span>(1)</span>');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption(ffOneOption::TYPE_TEXT, 'comments_more', 'Comments <span>(%)</span>', 'Comments <span>(%)</span>');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );
					$s->addOption(ffOneOption::TYPE_TEXT, 'reply', 'Reply Link', 'Reply' );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
				$s->endSection();

				$s->startSection('comment_form');
				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Comment Form');


					$s->addOption(ffOneOption::TYPE_TEXT, 'title', 'Form Title', __('Leave a Comment', 'default') );
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					$s->addOption(ffOneOption::TYPE_TEXT, 'logged_in_as', 'Logged In As', __('Logged in as %s. <a href="%s">Log out?</a>', 'default') );
					$s->addElement( ffOneElement::TYPE_NEW_LINE );


					$s->addOption(ffOneOption::TYPE_TEXT, 'name', 'Name', 'Your Name *');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );


					$s->addOption(ffOneOption::TYPE_TEXT, 'email', 'Email', 'Your Email Adress *');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );


					$s->addOption(ffOneOption::TYPE_TEXT, 'website', 'Website', 'Your Website');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );


					$s->addOption(ffOneOption::TYPE_TEXT, 'comment', 'Comment', 'Your Message *');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					$s->addOption(ffOneOption::TYPE_TEXT, 'send_button', 'Send Button', 'Send Message');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );
				$s->endSection();

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', 'Search');

					$s->addOption( ffOneOption::TYPE_TEXT, 'Search_Results_for', 'Search Results for', __('Search Results for: %s', 'default'));
					$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', '"Search Results for" title in search page');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					$s->addOption( ffOneOption::TYPE_TEXT, 'Type_to_search', 'Type to search', 'Type to search');
					$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Placeholder in search form in menu');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					$s->addOption( ffOneOption::TYPE_TEXT, 'Search_button', 'Search', __('Search', 'default') );
					$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Search button text');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '', '404');

					$s->addOption( ffOneOption::TYPE_TEXT, '404_Title', '404 Title', __('404 Not found', 'default'));
					$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', '"Not found" title in 404 page');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

					$s->addOption( ffOneOption::TYPE_TEXT, '404_Description', '404 Description', __('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'default' ) );
					$s->addElement( ffOneElement::TYPE_DESCRIPTION, '', 'Info, that there are no results');
					$s->addElement( ffOneElement::TYPE_NEW_LINE );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );

		$s->endSection();

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );

		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '<div class="ff-theme-mix-admin-tab-gapi ff-theme-mix-admin-tab-content">' );
		$s->startSection('gapi');


			$s->addElement( ffOneElement::TYPE_HEADING, '',  ( __( 'Google API' , 'stig' ) )  );

			$s->addElement( ffOneElement::TYPE_TABLE_START );

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_START, '',  ( __( 'Google API key' , 'stig' ) ) );

					$s->addOption(ffOneOption::TYPE_TEXT, 'key', ( __(  'Google API key' , 'stig' ) ) , '');

					$s->addElement(ffOneElement::TYPE_HTML, 'TYPE_HTML', '<p>
							Please note, that you must have Google account (email) to create API key.
						</p>
						<ol>
							<li>
								Go to the page <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key</a>
								and click on the button <strong class="btn btn-xs btn-primary">GET A KEY</strong>.
							</li>
							<li>
								Click on <strong class="btn btn-xs btn-primary">Continue</strong> -it will take a moment
							</li>
							<li>Click on <strong class="btn btn-xs btn-primary">Create</strong></li>
							<li>There will be the modal window with input labeled <code>Here is your API key</code></li>
						</ol>');

				$s->addElement( ffOneElement::TYPE_TABLE_DATA_END );

			$s->addElement( ffOneElement::TYPE_TABLE_END );

		$s->endSection();
		$s->addElement( ffOneElement::TYPE_HTML, 'TYPE_HTML', '</div>' );




			$s->addElement( ffOneElement::TYPE_NEW_LINE );
			$s->addElement( ffOneElement::TYPE_BUTTON_PRIMARY, 'Save', 'Save Changes' );

		$s->endSection();

		return $s;
	}

}










