<?php

	$prefix = composer_get_prefix();

	$caption  = composer_get_option_value( $prefix.'caption', 'disable' );
    
    // Caption
	$thumb_img = get_post( get_post_thumbnail_id() );

	if( 'enable' == $caption && isset( $thumb_img ) && ! empty( $thumb_img->post_excerpt ) ) : ?>

		<p class="caption"><?php echo esc_html( $thumb_img->post_excerpt ); ?></p>

	<?php endif;