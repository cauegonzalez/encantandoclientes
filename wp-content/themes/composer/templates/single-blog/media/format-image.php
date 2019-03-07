<?php

	$prefix = composer_get_prefix();

	$id = get_the_ID();

	$style = composer_get_meta_value( $id, '_amz_style', 'default', $prefix.'style', 'style1' );

	$show_feature_section = composer_get_meta_value( $id, '_amz_show_feature_image', 'yes' ); // id, meta_key, meta_default

	// Image dimension
    $image_size = composer_get_meta_value( $id, '_amz_image_size', 'default' ); // id, meta_key, meta_default

    if( 'default' == $image_size ) {
        $width = composer_get_option_value( $prefix.'image_width', 1360 );
        $height = composer_get_option_value( $prefix.'image_height', 460 );
    }
    else {
        $width = composer_get_meta_value( $id, '_amz_image_width', 1360 );
        $height = composer_get_meta_value( $id, '_amz_image_height', 460 );
    }

	// Feature Image
	if( 'yes' == $show_feature_section && 'style1' == $style ) :

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