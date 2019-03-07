<?php

	$prefix = composer_get_prefix();

	$id = get_the_ID();

    // Single blog style
    $style = composer_get_meta_value( $id, '_amz_style', 'default', $prefix.'style', 'style1' );
	$show_category = composer_get_option_value( $prefix.'category', 'show' );

	if( 'show' == $show_category ) :

		if( 'style1' == $style ) : ?>
			
			<div class="cats style1"><span class="pull-out uc"><?php esc_html_e( 'Categories', 'composer' ); ?></span><?php the_category( '&ensp;/&ensp;' ); ?></div>

		<?php elseif( 'style2' == $style || 'style3' == $style ) : 

			$category = get_the_category(); ?>

			<div class="category style2"><a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>"><?php echo esc_html( $category[0]->cat_name ); ?></a></div>

		<?php endif;

	endif;