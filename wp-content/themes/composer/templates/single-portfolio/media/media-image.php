<?php

    $id = get_the_id();

    $layout = composer_get_meta_value( $id, '_amz_portfolio_layout', 'full_width' );
    $fixed_content = composer_get_meta_value( $id, '_amz_portfolio_fixed_content', 'not_fixed' );

    $image = composer_get_meta_value( $id, '_amz_portfolio_single_image', '' );
    $image = ! empty( $image ) ? json_decode( $image ) : '';

    if( 'full_width' === $layout ) :
        $width = composer_get_meta_value( $id, '_amz_width', 1200 );
        $height = composer_get_meta_value( $id, '_amz_height', 300 );

        if( ! empty( $image ) ) :

            $img_attr = array(
                'image_id'    => $image[0]->itemId,
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

    else :
        $width = composer_get_meta_value( $id, '_amz_width', 790 );
        $height = composer_get_meta_value( $id, '_amz_height', 400 );

        if( ! empty( $image ) ) :

            $img_attr = array(
                'image_id'    => $image[0]->itemId,
                'image_tag'   => true,
                'placeholder' => true,
                'width'       => $width,
                'height'      => $height
            );

            if( 'not_fixed' == $fixed_content ) {
                $img_attr['srcset'] = array(
                    '1024' => array( $width, $height ),
                    '991'  => array( 652, 300 ),
                    '768'  => array( 652, 300 ),
                    '480'  => array( 354, 280 ),
                    '320'  => array( 226, 180 )
                );
            }

        endif;

    endif;

    ?>

    <div class="portfolio-img pix-post-gallery">

        <?php if( !empty( $image ) ) : ?>
            <div class="portfolio-image-gallery">
                <?php echo composer_get_image( $img_attr ); ?>
            </div>
        <?php endif; ?>

    </div> <!-- .portfolio-img -->