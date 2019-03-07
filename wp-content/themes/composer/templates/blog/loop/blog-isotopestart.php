<?php

	$prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();

    $type = composer_get_option_value( $prefix.'styles', 'normal' );

    if( $type == 'masonry' ) : ?>
        <div class="blog-isotope row load-container <?php echo esc_attr( $type ); ?>">
    <?php endif;