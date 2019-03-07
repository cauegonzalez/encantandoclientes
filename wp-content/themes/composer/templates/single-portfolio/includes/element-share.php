<?php

    $prefix = 'single_porfolio_';

	// Share
    $share = composer_get_option_value( $prefix.'share', 'show' );

    if( 'show' === $share ) : 

        $link = get_permalink();

        ?>

        <div class="portfolio-icons">

            <div class="port-icon-hover share-btn">

                <div class="share-top">
                    <i class="pixicon-share"></i>
                </div>

                <div class="port-share-btn">

                    <a href="https://plus.google.com/share?url=<?php echo esc_url( $link ); ?>" target="_blank" class="gplus"><i class="pixicon-gplus"></i></a>

                    <a href="http://twitter.com/share?url=<?php echo esc_url( $link ); ?>&amp;text=<?php echo esc_html__( 'Check out this Project', 'composer' ) . esc_attr( $link ); ?>" target="_blank" class="twitter"><i class="pixicon-twitter"></i></a>

                    <a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $link ); ?>" target="_blank" class="facebook"><i class="pixicon-facebook"></i></a>

                </div> <!-- .port-share-btn -->

            </div> <!-- .port-icon-hover -->

        </div> <!-- .portfolio-icons -->


    <?php endif;