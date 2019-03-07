<?php

	$prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();

    /*
     * Blog Post Format: Standard
     */

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

	?>

    <div class="post-standard">
        <?php echo composer_get_image( $img_attr ); ?>
    </div> <!-- .post-standard -->

    <?php 
    	get_template_part( 'templates/blog/includes/blog', 'entrycontent' );

		get_template_part( 'templates/blog/loop/blog', 'articleend' );