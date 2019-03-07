<?php
   
    $id = get_the_id();

    // Empty Assignment
    $slider_class = '';
    $slider_data = array();

    $gallery = json_decode( composer_get_meta_value( $id, '_amz_portfolio_gallery' ), true );

    if( !empty( $gallery ) ) :

        $slider = composer_get_meta_value( $id, '_amz_portfolio_slider', 'yes' );

        if( 'yes' == $slider ) :

            $slides_per_view = composer_get_meta_value( $id, '_amz_slides_per_view', '1' );
            $loop            = composer_get_meta_value( $id, '_amz_loop', 'false' );
            $margin          = composer_get_meta_value( $id, '_amz_margin', '0' );
            $center          = composer_get_meta_value( $id, '_amz_center', 'false' );
            $stage_padding   = composer_get_meta_value( $id, '_amz_stage_padding', '0' );
            $start_position  = composer_get_meta_value( $id, '_amz_start_position', '0' );
            $pagination      = composer_get_meta_value( $id, '_amz_pagination', 'false' );
            $touch_drag      = composer_get_meta_value( $id, '_amz_touch_drag', 'true' );
            $mouse_drag      = composer_get_meta_value( $id, '_amz_mouse_drag', 'true' );
            $stop_on_hover   = composer_get_meta_value( $id, '_amz_stop_on_hover', 'true' );
            $slide_arrow     = composer_get_meta_value( $id, '_amz_slide_arrow', 'true' );
            $slide_speed     = composer_get_meta_value( $id, '_amz_slide_speed', '5000' );
            $autoplay        = composer_get_meta_value( $id, '_amz_autoplay', 'false' );
            $animate_out     = composer_get_meta_value( $id, '_amz_animate_out', 'false' );
            $animate_in      = composer_get_meta_value( $id, '_amz_animate_in', 'false' );

            // Build slider data

            $slider_data[] = 'data-items="'. esc_attr( $slides_per_view ) .'"';
            $slider_data[] = 'data-loop="'. esc_attr( $loop ) .'"';
            $slider_data[] = 'data-margin="'. esc_attr( $margin ) .'"';
            $slider_data[] = 'data-center="'. esc_attr( $center ) .'"';
            $slider_data[] = 'data-stage-padding="'. esc_attr( $stage_padding ) .'"';
            $slider_data[] = 'data-start-position="'. esc_attr( $start_position ) .'"';
            $slider_data[] = 'data-dots="'. esc_attr( $pagination ) .'"';
            $slider_data[] = 'data-touch-drag="'. esc_attr( $touch_drag ) .'"';
            $slider_data[] = 'data-mouse-drag="'. esc_attr( $mouse_drag ) .'"';
            $slider_data[] = 'data-autoplay-hover-pause="'. esc_attr( $stop_on_hover ) .'"';
            $slider_data[] = 'data-nav="'. esc_attr( $slide_arrow ) .'"';
            $slider_data[] = 'data-autoplay-timeout="'. esc_attr( $slide_speed ) .'"';
            $slider_data[] = 'data-autoplay="'. esc_attr( $autoplay ) . '"';
            $slider_data[] = 'data-animate-in="'. esc_attr( $animate_in ) .'"';
            $slider_data[] = 'data-animate-out="'. esc_attr( $animate_out ) .'"';

            $slider_class = 'owl-carousel';

        endif;

        ?>

        <div class="portfolio-img pix-post-gallery <?php echo esc_attr( $slider_class ); ?>" <?php echo implode( ' ', $slider_data ); ?>>
                                  
            <?php foreach( $gallery as $src ) : ?>

                <div class="portfolio-image-gallery">

                    <?php 

                        $layout = composer_get_meta_value( $id, '_amz_portfolio_layout', 'full_width' );
                        $fixed_content = composer_get_meta_value( $id, '_amz_portfolio_fixed_content', 'not_fixed' );

                        if( 'full_width' === $layout ) :

                            $width = composer_get_meta_value( $id, '_amz_width', 1200 );
                            $height = composer_get_meta_value( $id, '_amz_height', 500 );

                            if( 'yes' == $slider ) :
                                $width = (int) round( $width / (int) $slides_per_view );
                            endif;

                            if( ! empty( $src ) ) :

                                $img_attr = array(
                                    'image_id'    => $src['itemId'],
                                    'image_tag'   => true,
                                    'placeholder' => true,
                                    'width'       => $width,
                                    'height'      => $height,
                                    'srcset'      => array(
                                        '1024' => array( $width, $height ),
                                        '991'  => array( 652, 300 ),
                                        '768'  => array( 652, 300 ),
                                        '480'  => array( 354, 280 ),
                                        '320'  => array( 226, 180 )
                                    )
                                );

                            endif;

                        else:
                            
                            $width = composer_get_meta_value( $id, '_amz_width', 790 );
                            $height = composer_get_meta_value( $id, '_amz_height', 400 );

                            if( 'yes' == $slider ) :
                                $width = (int) round( $width / (int) $slides_per_view );
                            endif;

                            if( ! empty( $src ) ) :

                                $img_attr = array(
                                    'image_id'    => $src['itemId'],
                                    'image_tag'   => true,
                                    'placeholder' => true,
                                    'width'       => $width,
                                    'height'      => $height
                                );

                                if( 'not_fixed' == $fixed_content ) :
                                    
                                    $img_attr['srcset'] = array(
                                        '1024' => array( $width, $height ),
                                        '991'  => array( 652, 300 ),
                                        '768'  => array( 652, 300 ),
                                        '480'  => array( 354, 280 ),
                                        '320'  => array( 226, 180 )
                                    );

                                endif;

                            endif;

                        endif;

                        echo composer_get_image( $img_attr );
                    ?>

                </div> <!-- .portfolio-image-gallery -->

            <?php endforeach; ?>

        </div> <!-- .portfolio-img -->

    <?php endif;