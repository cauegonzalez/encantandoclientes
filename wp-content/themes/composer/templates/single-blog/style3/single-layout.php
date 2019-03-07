<?php

	$prefix = composer_get_prefix();

    $id = get_the_ID();

    $style = composer_get_meta_value( $id, '_amz_style', 'default', $prefix.'style', 'style1' );
    $layout = composer_get_meta_value( $id, '_amz_layout', 'default', $prefix.'sidebar', 'right-sidebar' );
    $show_feature_section = composer_get_meta_value( $id, '_amz_show_feature_image', 'yes' ); // id, meta_key, meta_default

?>

<div class="newsection single-blog-<?php echo esc_attr( $style ); ?>">

    <?php
    // Empty assigment
    $css = '';

    if( has_post_thumbnail() && 'yes' == $show_feature_section ) {
        // Feature Image ID
        $image_id = get_post_thumbnail_id();

        $bg = composer_get_image_by_id( 1920, 550, $image_id, 1, 1, 0 );

        $css = 'style="';
        $css .= 'background: url('. esc_url( $bg ) .'); ';
        $css .= 'background-repeat: no-repeat; ';
        $css .= 'background-size: cover; ';
        $css .= 'height: 550px; ';
        $css .= '"';

        $no_image_class = '';
    }
    else {
        $no_image_class = 'no-feature-image';
    }

    ?>

    <div class="banner <?php echo $no_image_class; ?>" <?php echo $css; ?>>
        
        <div class="banner-content container">
            
            <?php 

                get_template_part( 'templates/single-blog/includes/element', 'caption' ); 

                get_template_part( 'templates/single-blog/includes/element', 'category' );

                get_template_part( 'templates/single-blog/includes/element', 'title' );

            ?>

        </div>
        
    </div>
	
	<div class="container">

        <?php if( 'full-width' != $layout ) : ?> 

            <div class="row">
                
            <div class="col-md-9 <?php echo esc_attr( $layout ); ?>">

        <?php endif;

        $format = get_post_format();
        $format = ( false == $format || NULL == $format || '' == $format ) ? 'image' : $format;
        $format = ( 'link' == $format || 'quote' == $format ) ? $format : 'default';

        get_template_part( 'templates/single-blog/style3/content', $format ); 

        if( 'full-width' != $layout ) : ?> 
            
            </div> <!-- .col-md-9 -->
                
            <div class="col-md-3">

                <?php get_template_part( 'templates/single-blog/includes/element', 'sidebar' ); ?>

            </div> <!-- .col-md-3 -->

            </div> <!-- .row -->

        <?php endif; ?>

    </div> <!-- .container -->

</div> <!-- .newsection -->
    
    