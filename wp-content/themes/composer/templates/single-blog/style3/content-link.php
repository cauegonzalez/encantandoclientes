<?php
    $prefix = composer_get_prefix();

    $id = get_the_ID();

?>

<article id="post-<?php echo esc_attr( $id ); ?>" <?php post_class( 'post post-container clearfix' ); ?>>

    <div class="entry-content">

        <div class="quote-link-content">

            <?php 

                get_template_part( 'templates/single-blog/includes/element', 'content' );

                $link = composer_get_meta_value( $id, '_amz_link', '' );

                if ( !empty( $link ) ) : ?>

                    <a href="<?php echo esc_url( $link ); ?>" class="link-post"><?php echo esc_html( $link ); ?></a>

                <?php endif; 
            ?>

        </div> <!-- .quote-link-content -->

        <?php get_template_part( 'templates/single-blog/includes/element', 'comments' ); ?>

    </div> <!-- .entry-content -->

</article> <!-- .post-container -->
    
    