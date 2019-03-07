<?php

    $id = get_the_ID();

    $prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();

    $type = composer_get_option_value( $prefix.'styles', 'normal' );
    $sidebar_position = composer_get_option_value( $prefix.'sidebar', 'right-sidebar' );
    $isotope_col = composer_get_option_value( $prefix.'columns', 'col-md-3' );

    if( 'masonry' != $type && 'grid' != $type ) : ?>

        <div class="load-element">

    <?php endif;

        if( 'masonry' == $type || 'grid' == $type ) : ?>

            <div class="load-element element <?php echo esc_attr( $isotope_col ); ?>">

        <?php endif;

            get_template_part('blog/loop/blog' , 'animationstart');

            ?>

            <article id="post-<?php echo esc_attr( $id ); ?>" <?php post_class( 'post post-container clearfix' ); ?>>