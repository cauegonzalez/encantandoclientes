<?php

    $id = get_the_id();

    $prefix = 'single_porfolio_';

	// Like Count
    $like = composer_get_option_value( $prefix.'like', 'show' );

    if( 'show' === $like ) :

        $like_count = get_post_meta( $id, '_pix_like_me', true );
        $like_count = empty( $like_count ) ? 0 : $like_count;

        $like_class = isset( $_COOKIE['pix_like_me_'. $id] ) ? 'liked' : '';

        ?>

        <a href="#void" class="single-port-like pix-like-me <?php echo esc_attr( $like_class ); ?>" data-id="<?php echo esc_attr( $id ); ?>">
            <i class="pixicon-heart-2"></i>
            <span class="like-count"><?php echo esc_html( $like_count ); ?></span>
            <span class="already-liked"><?php esc_html_e( 'You already liked!', 'composer' ); ?></span>
        </a> <!-- .pix-like-me -->

    <?php endif;