<?php

	$prefix = composer_get_prefix();

	$id = get_the_ID();

	$style = composer_get_meta_value( $id, '_amz_style', 'default', $prefix.'style', 'style1' );

	$show_feature_section = composer_get_meta_value( $id, '_amz_show_feature_image', 'yes' ); // id, meta_key, meta_default

	// Feature Image
	if( 'yes' == $show_feature_section && 'style1' == $style ) :

		// Get video values
        $video_methods  = composer_get_meta_value( $id, '_amz_video_methods', 'normal' );
        $video_normal   = composer_get_meta_value( $id, '_amz_video_normal', '' );
        $poster         = composer_get_meta_value( $id, '_amz_poster', '' );
        $video_autoplay = composer_get_meta_value( $id, '_amz_video_autoplay', 'no' );
        $video_iframe   = composer_get_meta_value( $id, '_amz_video_iframe', '' );

        if( ! empty( $video_normal ) || ! empty( $video_iframe ) ) : ?>

            <div class="post-video post-format">

                <?php if( 'normal' == $video_methods ) :

                    if( ! empty( $video_normal ) ) :

                        $video_normal = htmlspecialchars_decode( $video_normal );
                        $vid_arr = json_decode( $video_normal,true );

                        $poster = htmlspecialchars_decode( $poster );
                        $poster = json_decode( $poster,false );
                        $poster = isset( $poster[0]->full ) ? $poster[0]->full : '';

                        $vid_sc = '';
                        $vid_sc .= '[video ';

                            foreach( $vid_arr as $vid ) :
                                $vid_sc .= $vid['format'] . '="' . esc_url( $vid['url'] ) . '" ';
                            endforeach;

                            $vid_sc .= 'poster = "' . esc_url( $poster ) . '" ';

                            if( $video_autoplay == 'yes' ) :
                                $vid_sc .= 'autoplay = "autoplay" ';
                            endif;

                        $vid_sc .= ']';

                        ?>

                        <div class="post-video-normal video">

                            <?php echo do_shortcode( $vid_sc ); ?>

                        </div> <!-- .post-video-normal -->

                    <?php endif;

                elseif( 'iframe' == $video_methods ) :

                    if( !empty( $video_iframe ) ) : ?>

                        <div class="post-video-iframe video"> 

                            <?php echo do_shortcode( $video_iframe ); ?>

                        </div> <!-- .post-video-iframe -->

                    <?php endif;

                endif;

                ?>

            </div> <!-- .post-video -->

        <?php endif;

	endif;