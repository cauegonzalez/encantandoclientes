<?php

    $id = get_the_id();

    // Empty Assignment
    $vid_sc = '';

    $portfolio_video = composer_get_meta_value( $id, '_amz_portfolio_video', '' );
    $poster = composer_get_meta_value( $id, '_amz_portfolio_poster', '' );
    $video_autoplay = composer_get_meta_value( $id, '_amz_portfolio_video_autoplay', 'no' );

    if( !empty( $portfolio_video ) ) :

        $portfolio_video = htmlspecialchars_decode( $portfolio_video );
        $vid_arr = json_decode( $portfolio_video, true );

        $poster = htmlspecialchars_decode( $poster );
        $poster = json_decode( $poster,false );

        $poster = isset( $poster[0]->full ) ? $poster[0]->full : '';

        $vid_sc = '[video ';

            foreach( $vid_arr as $vid ) :
                $vid_sc .= $vid['format'] . '="' . esc_url( $vid['url'] ) . '" ';
            endforeach;

            $vid_sc .= 'poster="' . esc_attr( $poster ) . '" ';

            if( $video_autoplay == 'yes' ) :
                $vid_sc .= 'autoplay="autoplay" ';
            endif;

        $vid_sc .= ']';

        ?>

        <div class="portfolio-video">
            <?php echo do_shortcode( $vid_sc ); ?>
        </div> <!-- .portfolio-video -->
    
    <?php endif;