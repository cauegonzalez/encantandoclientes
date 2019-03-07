<?php

	$prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();

    /*
     * Blog Post Format: Quote
     */
    
    $author        = composer_get_meta_value( get_the_ID(), '_amz_author', '' );
    
    $content_limit = composer_get_option_value( $prefix.'content_limit', '90' );
    $content       = composer_shorten_text( get_the_excerpt(), $content_limit );

    if( !empty( $content ) && !empty( $author ) ) : ?>

	    <div class="post-quote">
            
		    <?php if( ! empty( $content ) ) : ?>
		    	<p><?php echo esc_html( $content ); ?></p>
		    <?php endif;

		    if( ! empty( $author ) ) : ?>
		    	<span class="quote-author"> &minus; <?php echo esc_html( $author ); ?></span>
		    <?php endif; ?>

	    </div> <!-- .post-quote -->
	
    <?php endif;

    get_template_part( 'templates/blog/loop/blog', 'articleend' ); 
