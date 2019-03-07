<?php

	$prefix = composer_get_prefix();

	$id = get_the_ID();

	$style = composer_get_meta_value( $id, '_amz_style', 'default', $prefix.'style', 'style1' );

	$show_feature_section = composer_get_meta_value( $id, '_amz_show_feature_image', 'yes' ); // id, meta_key, meta_default

	// Image dimension
    $image_size = composer_get_meta_value( $id, '_amz_image_size', 'default' ); // id, meta_key, meta_default

    if( 'default' == $image_size ) :
        $width = composer_get_option_value( $prefix.'image_width', 1360 );
        $height = composer_get_option_value( $prefix.'image_height', 460 );
    else:
        $width = composer_get_meta_value( $id, '_amz_image_width', 1360 );
        $height = composer_get_meta_value( $id, '_amz_image_height', 460 );
    endif;

	// Feature Image
	if( 'yes' == $show_feature_section && 'style1' == $style ) :

		// Get gallery meta values
        $gallery = composer_get_meta_value( $id, '_amz_gallery', '' );
        $gallery = ! empty( $gallery ) ? json_decode( $gallery ) : '';

        // Empty assignment
        $gallery_item = '';

        if( !empty( $gallery ) ) :

            foreach( $gallery as $src ) :

                if( ! empty( $src ) ) :

                    $img_attr = array(
                        'image_id'    => $src->itemId,
                        'image_tag'   => true,
                        'placeholder' => true,
                        'width'       => $width,
                        'height'      => $height,
                        'srcset'      => array(
                            '1024' => array( $width, $height ),
                            '991'  => array( 991, 460 ),
                            '768'  => array( 768, 400 ),
                            '480'  => array( 480, 360 ),
                            '320'  => array( 320, 260 )
                        )
                    );

                endif;

                $gallery_item .= '<div class="media-con">';

                    $gallery_item .= composer_get_image( $img_attr );

                $gallery_item .= '</div>'; // .media-con

            endforeach;

            $auto_slide = composer_get_meta_value( $id, '_amz_auto_slide', 'true' );
            $auto_slide_time = composer_get_meta_value( $id, '_amz_auto_slide_time', '2000' );

            //Set auto slide value
            $data = array();
            $data[] = 'data-nav="true"';
            $data[] = 'data-items="1"';
            $data[] = 'data-auto-height="true"';
            $data[] = 'data-dots="false"';
            $data[] = 'data-transition-style="fade"';
            $data[] = ( $auto_slide == 'true' || is_numeric( $auto_slide ) ) ? 'data-autoplay="'. esc_attr( $auto_slide ) .'"' : '';
            $data[] = ( $auto_slide == 'true' || is_numeric( $auto_slide ) ) ? 'data-autoplay-timeout="'. esc_attr( $auto_slide_time ) .'"' : '';

            if( !empty( $gallery_item ) ) : ?>

                <div class="single-gallery-carousel owl-carousel" <?php echo implode( ' ', $data ); ?>>
                    <?php echo $gallery_item; ?>                
                </div> <!-- .single-gallery-carousel -->

            <?php endif;

        else :
            // Feature Image
            $image_id = get_post_thumbnail_id();

            $img_attr = array(
                'image_id'    => $image_id,
                'image_tag'   => true,
                'placeholder' => true,
                'width'       => $width,
                'height'      => $height,
                'srcset'      => array(
                    '1024' => array( $width, $height ),
                    '991'  => array( 991, 460 ),
                    '768'  => array( 768, 400 ),
                    '480'  => array( 480, 360 ),
                    '320'  => array( 320, 260 )
                )
            );

            if( $image_id ) : ?>

                <div class="media-con">
                    <?php echo composer_get_image( $img_attr ); ?>
				</div> <!-- .media-con -->

            <?php endif;
            
        endif;

    endif;