<?php

	$id = get_the_ID();

	// Empty assignment
	$aud_sc = '';

    /*
     * Blog Post Format: Audio
     */
    
    $audio_methods = composer_get_meta_value( $id, '_amz_audio_methods', 'normal' );
    $audio_normal = composer_get_meta_value( $id, '_amz_audio_normal', '' );
    $audio_autoplay = composer_get_meta_value( $id, '_amz_audio_autoplay', 'no' );
    $audio_iframe = composer_get_meta_value( $id, '_amz_audio_iframe', '' );
    $audio_iframe = composer_get_meta_value( $id, '_amz_audio_iframe', '' );


    if( !empty( $audio_normal ) || !empty( $audio_iframe ) ) : ?>

	    <div class="post-audio post-format">

	        <?php 
	        	if( $audio_methods == 'normal' ) :

		            if( !empty( $audio_normal ) ) :

		                $audio_normal = htmlspecialchars_decode( $audio_normal );
		                $audio_arr = json_decode( $audio_normal,true );

		                $aud_sc = '[audio ';
		                
			                foreach( $audio_arr as $aud ) :
			                    $ext = substr( strrchr( $aud['url'],'.' ),1 );
			                    $aud_sc .= $ext . '="' . esc_url( $aud['url'] ) . '" ';
			                endforeach;

			                if( $audio_autoplay == 'y' ) :
			                    $aud_sc .= 'autoplay = "autoplay" ';
			                endif;

		                $aud_sc .= ']';

		                echo '<div class="post-audio-normal audio">'. do_shortcode( esc_html( $aud_sc ) ) .'</div>';

		            endif;

		        elseif( $audio_methods == 'iframe' ) :

		            if( !empty( $audio_iframe ) ) : ?>

		                <div class="post-audio-iframe audio">
		                	<?php echo do_shortcode( $audio_iframe ); ?>
		                </div>

		            <?php endif;

		        endif;

		    ?>

	    </div>

	<?php endif;

		get_template_part( 'templates/blog/includes/blog', 'entrycontent' );

		get_template_part( 'templates/blog/loop/blog', 'articleend' );
