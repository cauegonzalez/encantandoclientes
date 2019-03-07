<?php

	/* Visual Composer: Initialize
	================================================== */
	
	// Include external shortcodes
	function amz_external_shortcodes() {
		require_once( AMAZEE_INC_DIR . 'visual-composer/shortcodes/external_shortcodes.php' );
	}
	add_action( 'init', 'amz_external_shortcodes' );

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( is_plugin_active( 'js_composer/js_composer.php' ) || is_plugin_active_for_network( 'js_composer/js_composer.php' ) ) {		
		
		// Include external elements
		function amz_external_vc_elements() {

			global $pagenow;
			require_once( AMAZEE_INC_DIR . 'visual-composer/vc_templates/extend_vc/extend_vc.php' );

			if( 'admin.php' != $pagenow ) {
				vc_set_as_theme();
			}

		}
		add_action( 'vc_before_init', 'amz_external_vc_elements' );

	}
