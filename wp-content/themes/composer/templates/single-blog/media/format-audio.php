<?php

	$prefix = composer_get_prefix();

	$id = get_the_ID();

	$style = composer_get_meta_value( $id, '_amz_style', 'default', $prefix.'style', 'style1' );

	$show_feature_section = composer_get_meta_value( $id, '_amz_show_feature_image', 'yes' ); // id, meta_key, meta_default

	// Feature Image
	if( 'yes' == $show_feature_section && 'style1' == $style ) :

		// Get audio values
        $audio_methods  = composer_get_meta_value( $id, '_amz_audio_methods', 'normal' );
        $audio_normal   = composer_get_meta_value( $id, '_amz_audio_normal', '' );
        $audio_autoplay = composer_get_meta_value( $id, '_amz_audio_autoplay', 'no' );
        $audio_iframe   = composer_get_meta_value( $id, '_amz_audio_iframe', '' );

        if( ! empty( $audio_normal ) || ! empty( $audio_iframe ) ) : ?>

            <div class="post-audio post-format">

                <?php if( 'normal' == $audio_methods ) :

                    if( ! empty( $audio_normal ) ) :

                        $audio_normal = htmlspecialchars_decode( $audio_normal );
                        $audio_arr = json_decode( $audio_normal, true );

                        $aud_sc = '';
                        $aud_sc .= '[audio ';

                            foreach( $audio_arr as $aud ) :
                                $ext = substr( strrchr( $aud['url'],'.' ), 1 );
                                $aud_sc .= $ext . '="' . esc_url( $aud['url'] ) . '" ';
                            endforeach;

                            if( $audio_autoplay == 'y' ) :
                                $aud_sc .= 'autoplay = "autoplay" ';
                            endif;

                        $aud_sc .= ']';

                        ?>

                        <div class="post-audio-normal audio">

                            <?php echo do_shortcode( $aud_sc ); ?>

                        </div> <!-- .post-audio-normal -->

                    <?php endif;

                elseif( 'iframe' == $audio_methods ) :

                    if( !empty( $audio_iframe ) ) : ?>

                        <div class="post-audio-iframe audio"> 

                            <?php echo do_shortcode( $audio_iframe ); ?>

                        </div> <!-- .post-audio-iframe -->

                    <?php endif;

                endif;

                ?>

            </div> <!-- .post-audio -->

        <?php endif;

	endif;