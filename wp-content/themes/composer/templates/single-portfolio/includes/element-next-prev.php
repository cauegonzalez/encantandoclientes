<?php

    $prefix = 'single_porfolio_';

	// Next and previous item
    $next_prev = composer_get_option_value( $prefix.'next_prev', 'show' );

    if( 'show' === $next_prev ) : ?>
        <div class="pull-right single-port-nav">
            <?php 
            	previous_post_link( '%link', '<span class="pixicon-arrow-left"></span>', false );
            	next_post_link( '%link', '<span class="pixicon-arrow-right"></span>', false );
            ?>
        </div>
    <?php endif;