<?php
    get_header();

    $prefix = composer_get_prefix();

    $composer_id = get_the_ID();

    // Single blog style
    $composer_style = composer_get_meta_value( $composer_id, '_amz_style', 'default', $prefix.'style', 'style1' );
    $composer_style = apply_filters( 'composer_single_blog_style', $composer_style );

    if ( have_posts() ) :
     
        while ( have_posts() ) : the_post();

            if( 'visual_composer' == $composer_style ) :

                the_content();

            else :

                get_template_part( 'templates/single-blog/'. $composer_style .'/single', 'layout' );

            endif;

        endwhile;

    endif;

get_footer();