<?php

	$prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();

    /*
     * Blog Post Format: Gallery
     */
    
    $gallery = json_decode( composer_get_meta_value( get_the_ID(), '_amz_gallery', '' ) );
    $gallery_auto_slide = composer_get_meta_value( get_the_ID(), '_amz_auto_slide', 'true' );
    $gallery_auto_slide_time = composer_get_meta_value( get_the_ID(), '_amz_auto_slide_time', '5000' );

    $type = composer_get_option_value( $prefix.'styles', 'normal' );
    $sidebar_position = composer_get_option_value( $prefix.'sidebar', 'right-sidebar' );
    $show_placeholder = composer_get_option_value( $prefix.'placeholder', 'show' );
    $show_placeholder = ( 'show' == $show_placeholder ) ? true : false;

    $content_wrap = composer_get_option_value( 'content_wrap', '1200' );

    if( 'grid' == $type || 'masonry' == $type ) :

    	$width = 282;
    	$height = 200;

	elseif( 'normal' == $type ) :

		$width = $content_wrap;
        $height = 350;

        if( 'full-width' != $sidebar_position ) :
            $width = round( $content_wrap*0.75 );
            $height = 350;
        endif;

    endif;
    
    $img_attr = array(
        'image_id'    => '',
        'image_tag'   => true,
        'placeholder' => $show_placeholder,
        'before'      => '<a href="'. esc_url( get_permalink() ) .'">',
        'after'       => '</a>',
        'width'       => $width,
        'height'      => $height,
        'srcset'      => array(
            '1024' => array( $width, $height ),
            '991'  => array( 991, 350 ),
            '768'  => array( 768, 350 ),
            '480'  => array( 480, 300 ),
            '320'  => array( 320, 220 )
        )
    );

    if( !empty( $gallery ) || has_post_thumbnail() ) : ?>
	    
        <div class="post-gallery">

	    	<?php 
            if( !empty( $gallery ) ) :

                // Build slider data
                $slider_data = array();

                $slider_data[] = 'data-items="1"';
                $slider_data[] = 'data-loop="false"';
                $slider_data[] = 'data-margin="0"';
                $slider_data[] = 'data-center="false"';
                $slider_data[] = 'data-stage-padding="0"';
                $slider_data[] = 'data-start-position="0"';
                $slider_data[] = 'data-touch-drag="true"';
                $slider_data[] = 'data-mouse-drag="true"';
                $slider_data[] = 'data-autoplay-hover-pause="true"';
                $slider_data[] = 'data-nav="true"';
                $slider_data[] = 'data-dots="false"';
                $slider_data[] = 'data-autoplay-timeout="'. esc_attr( $gallery_auto_slide_time ) .'"';
                $slider_data[] = 'data-autoplay="'. esc_attr( $gallery_auto_slide ) .'"';
                $slider_data[] = 'data-animate-in="false"';
                $slider_data[] = 'data-animate-out="false"';

                ?>

                <div class="post-format owl-carousel" <?php echo implode( ' ', $slider_data ); ?>>
                    
                    <?php 

                    foreach( $gallery as $src ) :

                        $img_attr = array(
                            'image_id'    => $src->itemId,
                            'image_tag'   => true,
                            'placeholder' => $show_placeholder,
                            'before'      => '<div><a href="'. esc_url( get_permalink() ) .'">',
                            'after'       => '</a></div>',
                            'width'       => $width,
                            'height'      => $height,
                            'srcset'      => array(
                                '1024' => array( $width, $height ),
                                '991'  => array( 991, 350 ),
                                '768'  => array( 768, 350 ),
                                '480'  => array( 480, 300 ),
                                '320'  => array( 320, 220 )
                            )
                        );

                        echo composer_get_image( $img_attr );

                    endforeach;

                    ?>

                </div> <!-- .owl-carousel -->

            <?php 
            elseif ( has_post_thumbnail() ) :

    	       echo composer_get_image( $img_attr );

            endif;
            ?>

        </div> <!-- .post-gallery -->

    <?php endif; 

	get_template_part( 'templates/blog/includes/blog', 'entrycontent' );

    get_template_part( 'templates/blog/loop/blog', 'articleend' );
