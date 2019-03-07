<?php
/*
Plugin Name: OT One Click Import Demo for Ananke theme
Plugin URI: http://oceanthemes.net/
Description: OT One Click Import Demo plugin for Reduxframework extensions loading
Version: 3.5.8
Author: OceanThemes
Author URI: http://oceanthemes.net/
*/

// Set your ReduxFrameWork Option name below //
$redux_opt_name = "theme_option";

if ( !function_exists( 'ananke_one_click_import_demo_extension_loader' ) ) {
	function ananke_one_click_import_demo_extension_loader( $ReduxFramework ) {
		$path    = dirname( __FILE__ ) . '/extensions/';
		$folders = scandir( $path, 1 );
		foreach ( $folders as $folder ) {
			if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
				continue;
			}
			$extension_class = 'ReduxFramework_Extension_' . $folder;
			if ( ! class_exists( $extension_class ) ) {
				// In case you wanted override your override, hah.
				$class_file = $path . $folder . '/extension_' . $folder . '.php';
				$class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
				if ( $class_file ) {
					require_once $class_file;
				}
			}
			if ( ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
				$ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
			}
		}
	}
	// Modify {$redux_opt_name} to match your opt_name
	add_action( "redux/extensions/{$redux_opt_name}/before", 'ananke_one_click_import_demo_extension_loader', 0 );
}

if ( !function_exists( 'wbc_filter_title' ) ) {

	/**
	 * Filter for changing demo title in options panel so it's not folder name.
	 *
	 * @param [string] $title name of demo data folder
	 *
	 * @return [string] return title for demo name.
	 */

	function wbc_filter_title( $title ) {
		return trim( ucfirst( str_replace( "-", " ", $title ) ) );
	}

	// Uncomment the below
	add_filter( 'wbc_importer_directory_title', 'wbc_filter_title', 10 );
}

if ( !function_exists( 'wbc_importer_description_text' ) ) {

	/**
	 * Filter for changing importer description info in options panel
	 * when not setting in Redux config file.
	 *
	 * @param [string] $title description above demos
	 *
	 * @return [string] return.
	 */

	function wbc_importer_description_text( $description ) {

		$message = '<p>'. esc_html__( 'Best if used on new WordPress install.', 'framework' ) .'</p>';
		$message .= '<p>'. esc_html__( 'Images are for demo purpose only.', 'framework' ) .'</p>';

		return $message;
	}

	// Uncomment the below
	add_filter( 'wbc_importer_description', 'wbc_importer_description_text', 10 );
}

if ( !function_exists( 'wbc_importer_label_text' ) ) {

	/**
	 * Filter for changing importer label/tab for redux section in options panel
	 * when not setting in Redux config file.
	 *
	 * @param [string] $title label above demos
	 *
	 * @return [string] return no html
	 */

	function wbc_importer_label_text( $label_text ) {

		$label_text = 'Demo Importer';

		return $label_text;
	}

	// Uncomment the below
	add_filter( 'wbc_importer_label', 'wbc_importer_label_text', 10 );
}

/************************************************************************
* Extended Import Demo:
* Way to set menu, import revolution slider, and set home page.
*************************************************************************/

if ( !function_exists( 'ot_extended_import_demo' ) ) {
	function ot_extended_import_demo( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		/************************************************************************
		* Import slider(s) for the current demo being imported
		*************************************************************************/

		if ( class_exists( 'RevSlider' ) ) {

			//If it's demo1 or demo2
			$wbc_sliders_array = array(
				'ananke-dark' => 'home-slider.zip', //Set slider zip name				
				'ananke-light' => 'home-slider.zip', //Set slider zip name	
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}

		/************************************************************************
		* Setting Menus
		*************************************************************************/

		// If it's archi-dark and archi-light
		$wbc_menu_array = array( 
			'ananke-dark', 
			'ananke-light',  
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$onepage_menu = get_term_by( 'name', 'Menu Home', 'nav_menu' );
			$main_menu = get_term_by( 'name', 'Menu Pages', 'nav_menu' );									
			set_theme_mod( 'nav_menu_locations', array(
					'primary' => $onepage_menu->term_id,
					'secondary'  => $main_menu->term_id,
				)
			);
		}

		/************************************************************************
		* Set HomePage
		*************************************************************************/

		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'ananke-dark' => 'Home Slider',
			'ananke-light' => 'Home Slider',			
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}
	}

	// Uncomment the below
	add_action( 'wbc_importer_after_content_import', 'ot_extended_import_demo', 10, 2 );
}

?>
