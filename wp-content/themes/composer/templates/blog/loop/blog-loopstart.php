<?php

    $prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();

    //Blog 
    $type = composer_get_option_value( $prefix.'styles', 'normal' );
    $sidebar_position = composer_get_option_value( $prefix.'sidebar', 'right-sidebar' );

    $columns = ( 'full-width' != $sidebar_position ) ? ' col-md-9 ' : ' col-md-12 ';

    $load_class = ( 'masonry' != $type ) ? ' load-container' : '';

    ?>

    <div id="style-<?php echo esc_attr( $type ); ?>" class="blog <?php echo esc_attr( $columns . $sidebar_position . $load_class ); ?>">
    
    <?php
        get_template_part( 'templates/blog/loop/blog', 'isotopestart');