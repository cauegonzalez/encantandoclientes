<?php

	$prefix = composer_get_prefix();

    $id = get_the_ID();

    $style = composer_get_meta_value( $id, '_amz_style', 'default', $prefix.'style', 'style1' );
    $layout = composer_get_meta_value( $id, '_amz_layout', 'default', $prefix.'sidebar', 'right-sidebar' );

?>

<div class="newsection single-blog-<?php echo esc_attr( $style ); ?>">
	
	<div class="container">

		<?php if( 'full-width' != $layout ) : ?> 

            <div class="row">
                
            <div class="col-md-9 <?php echo esc_attr( $layout ); ?>">

        <?php endif;

        $format = get_post_format();
        $format = ( false == $format || NULL == $format || '' == $format ) ? 'image' : $format;

        if( 'link' != $format && 'quote' != $format ) {

            get_template_part( 'templates/single-blog/media/format', $format );

            get_template_part( 'templates/single-blog/includes/element', 'caption' );
        }

        $format = ( 'link' == $format || 'quote' == $format ) ? $format : 'default';

        get_template_part( 'templates/single-blog/style1/content', $format ); 

        if( 'full-width' != $layout ) : ?> 
            
            </div> <!-- .col-md-9 -->
                
            <div class="col-md-3">

                <?php get_template_part( 'templates/single-blog/includes/element', 'sidebar' ); ?>

            </div> <!-- .col-md-3 -->

            </div> <!-- .row -->

        <?php endif; ?>

	</div> <!-- .container -->

</div> <!-- .newsection -->
    
    