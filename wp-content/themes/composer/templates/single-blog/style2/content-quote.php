<?php
    $prefix = composer_get_prefix();

    $id = get_the_ID();

?>

<article id="post-<?php echo esc_attr( $id ); ?>" <?php post_class( 'post post-container clearfix' ); ?>>
    
    <div class="entry-content">

        <div class="quote-link-content">

            <?php 

                get_template_part( 'templates/single-blog/includes/element', 'content' );

                $author = composer_get_meta_value( $id, '_amz_author', '' );

                if ( !empty( $author ) ) : ?>

                    <span class="quote-author"> &minus;  <?php echo esc_html( $author ); ?></span>

                <?php endif; 
            ?>

        </div> <!-- .quote-link-content -->

        <?php get_template_part( 'templates/single-blog/includes/element', 'comments' ); ?>

    </div> <!-- .entry-content -->

</article> <!-- .post-container -->