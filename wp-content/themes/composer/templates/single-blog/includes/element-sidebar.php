<?php

	$prefix = composer_get_prefix();

	$id = get_the_ID();

	$sidebar = composer_get_meta_value( $id, '_amz_sidebar', 0 );
    $sidebar = ( 0 == $sidebar || 'default' == $sidebar ) ? 'default' : $sidebar;

	$sidebar = composer_get_meta_value( $id, '_amz_sidebar', $sidebar, $prefix.'select_sidebar', 'blog-sidebar' );
	
	if ( is_active_sidebar( $sidebar ) ) :

		dynamic_sidebar( $sidebar );

	elseif ( is_active_sidebar( 'blog-sidebar' ) ) :

		dynamic_sidebar( 'blog-sidebar' );

	else : ?>
	
		<p class="sidebar-info"><?php esc_html_e( 'Please active sidebar widget or disable it from theme option.', 'composer' ); ?></p>

	<?php endif;