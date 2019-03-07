<?php

	$prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();

    /*
     * Blog Post Format: Link
     */
    
    $link          = composer_get_meta_value( get_the_ID(), '_amz_link', '' );
    
    $title_limit   = composer_get_option_value( $prefix.'title_limit', '20' );
    $post_title    = composer_shorten_text( get_the_title(), $title_limit );

    $content_limit = composer_get_option_value( $prefix.'content_limit', '90' );
    $content       = composer_shorten_text( get_the_excerpt(), $content_limit );

    ?>

    <div class="post-link">

        <?php the_title( '<h3 class="title">', '</h3>' );

	    if( ! empty( $content ) ) : ?>
	    	<p><?php echo esc_html( $content ); ?></p>
	    <?php endif;

	    if ( ! empty( $link ) ) : ?>
	    	<a href="<?php echo esc_url( $link ); ?>" class="link-post"><?php echo esc_html( $link ); ?></a>
	    <?php endif; ?>

    </div> <!-- .post-link -->


    <?php

    get_template_part( 'templates/blog/loop/blog', 'articleend'); 
