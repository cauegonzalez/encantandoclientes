<?php
    $prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();

    $animate = composer_get_option_value( $prefix.'animate', 'enable' );
    $transition = composer_get_option_value( $prefix.'transition', 'fadeInUp' );
    $duration = composer_get_option_value( $prefix.'duration', '500ms' );

    if( 'enable' === $animate ) :

        $animate_class = 'pix-animate-cre';
        $delay = '200';

        $data = array();

        $data[] = 'data-delay="'. esc_attr( $delay ) .'" ';
        $data[] = isset( $transition ) ? 'data-trans="'. esc_attr( $transition ) .'" ' : '';
        $data[] = isset( $duration ) ? 'data-duration="'. esc_attr( $duration ) .'" ' : '';

        ?>

        <div class="<?php echo esc_attr( $animate_class ); ?>" <?php echo implode( ' ', $data ); ?>>

    <?php endif;