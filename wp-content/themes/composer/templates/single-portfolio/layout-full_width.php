<?php 

    $id = get_the_id();   

    $details_position = composer_get_meta_value( $id, '_amz_portfolio_details_position', 'media_on_top' );

    ?>

    <div class="single-portfolio-item <?php echo esc_attr( $details_position ); ?>">
        
        <?php 
        $details = ( $details_position == 'media_on_top' ) ? array( 'media', 'details' ) : array( 'details', 'media' );
        $style = composer_get_meta_value( $id, '_amz_single_portfolio_style', 'image' );

        foreach ( $details as $key => $value ) :
            if( 'media' == $value ) : ?>

                <div>
                    <?php get_template_part( 'templates/single-portfolio/media/media', $style ); ?>
                </div>

            <?php else : ?>
                
                <div class="row">

                    <div class="col-md-8">
                        
                        <div class="portfolio-description">
                            
                            <?php 
                                get_template_part( 'templates/single-portfolio/includes/element', 'title' );

                                get_template_part( 'templates/single-portfolio/includes/element', 'terms' );
                                
                                get_template_part( 'templates/single-portfolio/includes/element', 'content' );

                            ?>

                            <div id="portfolio-item-bottom">

                                <?php
                                    get_template_part( 'templates/single-portfolio/includes/element', 'like' );

                                    get_template_part( 'templates/single-portfolio/includes/element', 'share' );

                                    get_template_part( 'templates/single-portfolio/includes/element', 'next-prev' );

                                ?>

                            </div> <!-- .portfolio-item-bottom -->

                        </div> <!-- .portfolio-description -->

                    </div> <!-- .col-md-8 -->

                    <aside class="col-md-4 portfolio-info">

                        <div class="portfolio-info-inner">

                            <?php
                                get_template_part( 'templates/single-portfolio/includes/element', 'project-details' );
                            ?>
                        </div> <!-- .portfolio-info-inner -->

                    </aside> <!-- .col-md-4 -->
                    
                </div> <!-- .row -->

            <?php endif;

        endforeach; ?>

    </div> <!-- .single-portfolio-item -->