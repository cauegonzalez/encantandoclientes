<div class="single-blog">

    <article id="post-<?php echo esc_attr( get_the_ID() ); ?>" <?php post_class( 'post post-container clearfix' ); ?>>
        
        <div class="entry-content">

            <div class="move-up heading">

                <?php 
                
                    get_template_part( 'templates/single-blog/includes/element', 'title' ); 

                    get_template_part( 'templates/single-blog/includes/element', 'ad' ); 

                    get_template_part( 'templates/single-blog/includes/element', 'category' ); 

                    get_template_part( 'templates/single-blog/includes/element', 'meta' ); 

                ?>
            </div> <!-- .heading -->

            <?php 

                get_template_part( 'templates/single-blog/includes/element', 'content' ); 

                get_template_part( 'templates/single-blog/includes/element', 'tags' ); 
            ?>

        </div> <!-- .entry-content -->

        <?php 

            get_template_part( 'templates/single-blog/includes/element', 'related-post' );

            get_template_part( 'templates/single-blog/includes/element', 'comments' );

        ?>

    </article> <!-- .post-container -->

</div> <!-- .single-blog -->