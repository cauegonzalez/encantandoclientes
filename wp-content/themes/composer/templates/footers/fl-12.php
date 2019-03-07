<?php
/**
 * Composer Footer Layouts
 *
 * Footer Layout 21
 *
 * @author 		Theme Innwit
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Layout 21
echo '<div class="col-md-12">';
	if( is_active_sidebar( 'footer-first-column' ) ) {
		dynamic_sidebar( 'footer-first-column' );
	}	
echo '</div>';