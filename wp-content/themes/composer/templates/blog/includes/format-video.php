<?php

    /*
     * Blog Post Format: Video
     */
    
    // Empty assignment
    $vid_sc = '';

    // Get video meta box values
    $video_methods  = composer_get_meta_value( get_the_ID(), '_amz_video_methods', 'normal' );
    $video_normal   = composer_get_meta_value( get_the_ID(), '_amz_video_normal', '' );
    $poster         = composer_get_meta_value( get_the_ID(), '_amz_poster', '' );
    $video_autoplay = composer_get_meta_value( get_the_ID(), '_amz_video_autoplay', 'no' );
    $video_iframe   = composer_get_meta_value( get_the_ID(), '_amz_video_iframe', '' );
    $video_iframe   = composer_get_meta_value( get_the_ID(), '_amz_video_iframe', '' );

    if( !empty( $video_normal ) || !empty( $video_iframe ) ) : ?>

        <div class="post-format post-video">

            <?php 
                if( 'normal' == $video_methods ) :

                    if( ! empty( $video_normal ) ) :

                        $video_normal = htmlspecialchars_decode( $video_normal );
                        $vid_arr = json_decode( $video_normal,true );

                        $poster = htmlspecialchars_decode( $poster );
                        $poster = json_decode( $poster,false );

                        $poster = isset( $poster[0]->full ) ? $poster[0]->full : '';

                        $vid_sc = '[video ';

                            foreach($vid_arr as $vid) :
                                $vid_sc .= $vid['format'] . '="' . esc_url( $vid['url'] ) . '" ';
                            endforeach;

                            $vid_sc .= 'poster = "' . esc_attr( $poster ) . '" ';

                            if( 'yes' == $video_autoplay ) :
                                $vid_sc .= 'autoplay = "autoplay" ';
                            endif;

                        $vid_sc .= ']';

                        ?>

                        <div class="post-video-normal video">
                            <?php echo do_shortcode( esc_html( $vid_sc ) ); ?>
                        </div> <!-- .post-video-normal -->

                    <?php endif;

                elseif( 'iframe' == $video_methods ) :

                    if( !empty( $video_iframe ) ) : ?>

                        <div class="post-video-iframe video">
                            <?php echo $video_iframe; ?>
                        </div> <!-- .post-video-iframe -->

                    <?php endif;

                endif;

            ?>

        </div> <!-- .post-format -->

    <?php endif;

	get_template_part( 'templates/blog/includes/blog', 'entrycontent');
    
    get_template_part( 'templates/blog/loop/blog', 'articleend');
