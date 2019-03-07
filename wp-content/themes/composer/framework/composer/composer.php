<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! class_exists( 'composer' ) ) {

	class composer {

		protected static $_instance = null;

		public function __construct(){
			
			add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 ); // add admin menus
			add_action( 'admin_enqueue_scripts', array( $this, 'theme_options_css_scripts' ) );
			
		}

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function theme_options_css_scripts( $hook_suffix ) {

			wp_enqueue_style( 'system-status-css', COMPOSER_FRAMEWORK_URI. '/composer/assets/css/admin.css', null, '1.0' );

			if( 'composer_page_theme-options' == $hook_suffix || 'appearance_page_theme-options' == $hook_suffix ) {
				wp_register_style( 'pix-themeoptions', COMPOSER_ADMIN_DIR . 'assets/css/fonts.css', array(), '2.0', 'all' );
				wp_enqueue_style( 'pix-themeoptions');

				wp_enqueue_style('admin-style', COMPOSER_ADMIN_DIR . 'assets/css/admin-style.css');
				wp_enqueue_style('jquery-ui-custom-admin', COMPOSER_ADMIN_DIR .'assets/css/jquery-ui-custom.css');

				if ( !wp_style_is( 'wp-color-picker','registered' ) ) {
					wp_register_style( 'wp-color-picker', COMPOSER_ADMIN_DIR . 'assets/css/color-picker.min.css');
				}

				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_style('jquery-alpha-color-picker', COMPOSER_ADMIN_DIR .'assets/css/alpha-color-picker.css', array( 'wp-color-picker' ) );	

				do_action('of_style_only_after');

				wp_enqueue_script('jquery-ui-core');
				wp_enqueue_script('jquery-ui-sortable');
				wp_enqueue_script('jquery-ui-slider');
				wp_enqueue_script('jquery-input-mask', COMPOSER_ADMIN_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
				wp_enqueue_script('tipsy', COMPOSER_ADMIN_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
				wp_enqueue_script('cookie', COMPOSER_ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
				wp_enqueue_script('smof', COMPOSER_ADMIN_DIR .'assets/js/smof.js', array( 'jquery' ));


				// Enqueue colorpicker scripts for versions below 3.5 for compatibility
				if ( !wp_script_is( 'wp-color-picker', 'registered' ) ) {
					wp_register_script( 'iris', COMPOSER_ADMIN_DIR .'assets/js/iris.min.js', array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
					wp_register_script( 'wp-color-picker', COMPOSER_ADMIN_DIR .'assets/js/color-picker.min.js', array( 'jquery', 'iris' ) );
				}
				
				wp_enqueue_script( 'wp-color-picker' );
				
				wp_enqueue_script(
			        'alpha-color-picker',
			        COMPOSER_ADMIN_DIR . 'assets/js/alpha-color-picker.js', // Update to where you put the file.
			        array( 'jquery', 'wp-color-picker' ), // You must include these here.
			        null,
			        true
			    );

				/**
				 * Enqueue scripts for file uploader
				 */
				
				if ( function_exists( 'wp_enqueue_media' ) )
					wp_enqueue_media();

				do_action('of_load_only_after');
			}
		}

		/**
		 * Add menu items.
		 */
		public function admin_menu() {

			// add_menu_page( 
			// 	esc_html__( 'Composer', 'composer' ), 
			// 	esc_html__( 'Composer', 'composer' ), 
			// 	'administrator', 
			// 	'composer', 
			// 	array( $this, 'welcome' ),
			// 	'',
			// 	25
			// );

			// remove_submenu_page ('composer', 'composer');

			// add_submenu_page( 
			// 	'composer', 
			// 	esc_html__( 'Welcome', 'composer' ), 
			// 	esc_html__( 'Welcome', 'composer' ), 
			// 	'administrator', 
			// 	'welcome', 
			// 	array( $this, 'welcome' )
			// );

			// add_submenu_page( 
			// 	'composer', 
			// 	esc_html__( 'Registration', 'composer' ), 
			// 	esc_html__( 'Registration', 'composer' ), 
			// 	'administrator', 
			// 	'registration', 
			// 	array( $this, 'registration' )
			// );

			// add_submenu_page( 
			// 	'composer', 
			// 	esc_html__( 'Support', 'composer' ), 
			// 	esc_html__( 'Support', 'composer' ), 
			// 	'administrator', 
			// 	'support', 
			// 	array( $this, 'support' )
			// );

			// add_submenu_page( 
			// 	'composer', 
			// 	esc_html__( 'FAQ', 'composer' ), 
			// 	esc_html__( 'FAQ', 'composer' ), 
			// 	'administrator', 
			// 	'faq', 
			// 	array( $this, 'faq' )
			// );

			// add_submenu_page( 
			// 	'composer', 
			// 	esc_html__( 'Demo', 'composer' ), 
			// 	esc_html__( 'Demo', 'composer' ), 
			// 	'administrator', 
			// 	'demo', 
			// 	array( $this, 'demo' )
			// );

			// add_submenu_page( 
			// 	'composer', 
			// 	esc_html__( 'Plugins', 'composer' ), 
			// 	esc_html__( 'Plugins', 'composer' ), 
			// 	'administrator', 
			// 	'plugins', 
			// 	array( $this, 'plugins' )
			// );

			// add_submenu_page( 
			// 	'composer', 
			// 	esc_html__( 'System Status', 'composer' ), 
			// 	esc_html__( 'System Status', 'composer' ), 
			// 	'administrator', 
			// 	'system-status', 
			// 	array( $this, 'system_status' )
			// );

			// add_submenu_page( 
			// 	'composer', 
			// 	esc_html__( 'Theme Options', 'composer' ), 
			// 	esc_html__( 'Theme Options', 'composer' ), 
			// 	'administrator', 
			// 	'theme-options', 
			// 	'optionsframework_options_page'
			// );

			add_submenu_page( 
				'themes.php', 
				esc_html__( 'System Status', 'composer' ), 
				esc_html__( 'System Status', 'composer' ), 
				'administrator', 
				'system-status', 
				array( $this, 'system_status' )
			);

			add_submenu_page( 
				'themes.php', 
				esc_html__( 'Theme Options', 'composer' ), 
				esc_html__( 'Theme Options', 'composer' ), 
				'administrator', 
				'theme-options', 
				'optionsframework_options_page'
			);
		}

		public function welcome() {
		}

		public function registration() {
		}

		public function support() {
		}

		public function faq() {
		}

		public function demo() {
		}

		public function plugins() {
		}

		public function system_status() {
			require_once( COMPOSER_FRAMEWORK. '/composer/_system-status.php');
		}

	}
}

/**
 * Main instance
 *
 * Returns the main instance of CFC to prevent the need to use globals.
 *
 * @since  1.0
 * @return composer
 */
if( ! function_exists( 'composer_init' ) ) {
	function composer_init() {
		return composer::instance();
	}
}

$composer = composer_init();