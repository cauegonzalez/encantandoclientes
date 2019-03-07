<?php
/*
	Plugin Name: Composer Core Plugins
	Plugin URI: http://themeforest.net
	Description: Core plugin for the composer theme.
	Version: 3.3
	Author: Theme Innwit
	Author URI: http://www.innwithemes.com
	Text Domain: amz-composer-plugins
	Domain Path: /languages/
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/*
 * The Ocean Core Plugins Iniatialize class
 */
class Composer_Base_Plugin {

	public function __construct(){
		//Initialize folders as super global variables
		define( 'AMAZEE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		define( 'AMAZEE_PLUGIN_URL', plugins_url( '', __FILE__ ) );

		define( 'AMAZEE_CLASS_DIR', plugin_dir_path( __FILE__ ).'class/' );

		define( 'AMAZEE_INC_DIR', plugin_dir_path( __FILE__ ).'includes/' );

		define( 'AMAZEE_STATUS_DIR', plugin_dir_path( __FILE__ ).'system-status/' );

		define( 'AMAZEE_STATUS_URL', plugins_url( '', __FILE__ ).'/system-status/' );
		
		// call plugin text-domain
		add_action( 'plugins_loaded', array( $this, 'amz_load_plugin_textdomain' ) );

		// call metabox iniatialization
		add_action( 'init', array( $this, 'init_metabox' ) );

		// call posttype iniatialization
		add_action( 'init', array( $this, 'init_posttype' ) );

		// Required Files
		require( AMAZEE_CLASS_DIR . 'class-post-types.php' );
		require( AMAZEE_CLASS_DIR . 'class-metaboxes.php' );

		require( AMAZEE_INC_DIR . 'visual-composer/vc_init.php' );

		require( AMAZEE_INC_DIR . 'helper.php' );

		require( AMAZEE_PLUGIN_DIR . 'demo-importer/init.php' );
		
		register_activation_hook( __FILE__, array( $this, 'activationHook' ) );

	}

	function activationHook() {

		if( is_plugin_active( 'js_composer/js_composer.php' ) || is_plugin_active_for_network( 'js_composer/js_composer.php' ) ) {

			$vc_editor_post_types = vc_editor_post_types();

			if ( ! in_array('pix_portfolio', $vc_editor_post_types) ) {

				array_push( $vc_editor_post_types, 'pix_portfolio' );

				vc_editor_set_post_types( $vc_editor_post_types );
				
			}

		}

	}
	
	/* Load Text Domain */
	function amz_load_plugin_textdomain() {
	    load_plugin_textdomain( 'amz-composer-plugins', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/* Iniatialize Metaboxes */
	function init_metabox() {

		//Default Page
		require_once( AMAZEE_INC_DIR . 'metaboxes/page-metabox.php' );

		//Post Metabox
		require_once( AMAZEE_INC_DIR . 'metaboxes/post-metabox.php' );

		//Portfolio Metabox
		require_once( AMAZEE_INC_DIR . 'metaboxes/portfolio-metabox.php' );

		if (class_exists('WooCommerce')) {
			// WooCommerce Metabox
			require_once( AMAZEE_INC_DIR . 'metaboxes/shop-metabox.php' );
		}

		if( class_exists( 'Tribe__Events__Main' ) ) {
			// Event Tribe Metabox
			require_once( AMAZEE_INC_DIR . 'metaboxes/event-tribe-metabox.php' );
		}

		// General Metabox
		require_once( AMAZEE_INC_DIR . 'metaboxes/general-metabox.php' );
	}

	/* Iniatialize Post Types */
	function init_posttype() {

		//Staff Post Type Metabox
		require_once( AMAZEE_INC_DIR . 'posttypes/posttypes.php' );
	}
	
}

$Composer_Base_Plugin = new Composer_Base_Plugin();
