<?php

	$prefix = composer_get_prefix();

	// Social share icons
	$url = get_permalink();

	$share_default = array(  
        'enabled' => array (
            'facebook'  => esc_html__( 'Facebook', 'composer' ),
            'twitter'   => esc_html__( 'twitter', 'composer' ),
            'gplus'     => esc_html__( 'Google Plus', 'composer' ),
            'linkedin'  => esc_html__( 'Linkedin', 'composer' ),
            'pinterest' => esc_html__( 'Pinterest', 'composer' )
        )
    );

	$share = composer_get_option_value( $prefix.'share', $share_default );

	if( ! empty( $share ) ) :

		if( isset( $share['enabled'] ) ) : ?>

			<p class="single-share-title"><?php esc_html_e( 'Share this post', 'composer' ); ?></p>

			<div class="social-share style1">

				<?php foreach ( $share['enabled'] as $key => $value ) :
					
					if( 'facebook' == $key ) : ?>
						<a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u='. esc_url( $url ); ?>" target="_blank" class="facebook pixicon-facebook" ></a>
					<?php endif;

					if( 'twitter' == $key ) : ?>
						<a href="<?php echo 'https://twitter.com/home?status='. esc_url( $url ); ?>" target="_blank" class="twitter pixicon-twitter"></a>
					<?php endif;

					if( 'gplus' == $key ) : ?>
						<a href="<?php echo 'https://plus.google.com/share?url='. esc_url( $url ); ?>" target="_blank" class="gplus pixicon-gplus"></a>
					<?php endif;

					if( 'linkedin' == $key ) : ?>
						<a href="<?php echo 'https://www.linkedin.com/cws/share?url='. esc_url( $url ); ?>" target="_blank" class="linkedin pixicon-linked-in"></a>
					<?php endif;

					if( 'pinterest' == $key ) : ?>
						<a href="<?php echo 'https://pinterest.com/pin/create/button/?url='. esc_url( $url ); ?>" target="_blank" class="pinterest pixicon-pinterest"></a>
					<?php endif;
					
				endforeach; ?>

			</div> <!-- .social-share -->

		<?php endif;

	endif;