<div class="single-blog">

    <article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( 'post post-container clearfix' ); ?>>

        <?php

            get_template_part( 'templates/single-blog/includes/element', 'share' );

        ?>
        
        <div class="entry-content">
            <div class="move-up heading">

                <?php

                    $format = get_post_format();
                    $format = ( false == $format || NULL == $format || '' == $format ) ? 'image' : $format;

                    if( 'gallery' == $format || 'audio' == $format || 'video' == $format ) {

                        get_template_part( 'templates/single-blog/media/format', $format );

                    }

                ?>
            </div> <!-- .heading -->

            <div class="content-details">
                
                <div class="content">
                    
                    <?php

                        get_template_part( 'templates/single-blog/includes/element', 'ad' ); 

                        get_template_part( 'templates/single-blog/includes/element', 'content' ); 

                        get_template_part( 'templates/single-blog/includes/element', 'tags' ); 

                    ?>

                </div> <!-- .content -->

            </div> <!-- .content-details -->

        </div> <!-- .entry-content -->

        <?php

            get_template_part( 'templates/single-blog/includes/element', 'related-post' );

            get_template_part( 'templates/single-blog/includes/element', 'comments' );

        ?>

    </article> <!-- .post-container -->

</div> <!-- .single-blog -->