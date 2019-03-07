<?php 

    $prefix = 'single_porfolio_';

    $id = get_the_id();

    $fixed_position = composer_get_meta_value( $id, '_amz_portfolio_fixed_position', 'fixed_on_right' );
    $fixed_content = composer_get_meta_value( $id, '_amz_portfolio_fixed_content', 'not_fixed' );

    // Empty assignment
    $fixed_class_left = $fixed_content_class_left = $fixed_class_right = $fixed_content_class_right = '';

    if( 'fixed' === $fixed_content ) :

        if( $fixed_position == 'fixed_on_left' ){
            $fixed_class_left = 'single-portfolio-affix-container';
            $fixed_content_class_left = 'single-portfolio-affix-media';
        }
        elseif( $fixed_position == 'fixed_on_right' ){
            $fixed_class_right = 'single-portfolio-affix-container';
            $fixed_content_class_right = 'single-portfolio-affix-content';
        }
         
    endif;

    $style = composer_get_meta_value( $id, '_amz_single_portfolio_style', 'image' );

    ?>

    <div class="single-portfolio-item row">

        <div class="col-md-8 <?php echo esc_attr( $fixed_class_left ); ?>">

            <div class="<?php echo esc_attr( $fixed_content_class_left ); ?>">
                
                <?php if( 'fixed' === $fixed_content && 'fixed_on_left' == $fixed_position ) : ?>
                    <div class="single-portfolio-affix-wrap">
                    <div class="single-portfolio-affix clearfix">
                <?php endif;

                    get_template_part( 'templates/single-portfolio/media/media', $style );

                if( 'fixed' === $fixed_content && 'fixed_on_left' == $fixed_position ) : ?>
                    </div> <!-- .single-portfolio-affix -->
                    </div> <!-- .single-portfolio-affix-wrap -->
                <?php endif; ?>

            </div> <!-- .single-portfolio-affix-media -->

        </div> <!-- .col-md-8 -->

        <div class="col-md-4 <?php echo esc_attr( $fixed_class_right ); ?>">

            <div class="<?php echo esc_attr( $fixed_content_class_right ); ?>">
                
                <?php if( 'fixed' === $fixed_content && 'fixed_on_right' == $fixed_position ) : ?>
                    <div class="single-portfolio-affix-wrap">
                    <div class="single-portfolio-affix clearfix">
                <?php endif; ?>

                    <div class="portfolio-description">
                        
                        <?php 

                            get_template_part( 'templates/single-portfolio/includes/element', 'title' );
                            
                            get_template_part( 'templates/single-portfolio/includes/element', 'terms' );
                                    
                            get_template_part( 'templates/single-portfolio/includes/element', 'content' );

                        ?>

                    </div> <!-- .portfolio-description -->

                    <aside class="portfolio-info">

                        <div class="portfolio-info-inner">

                            <?php get_template_part( 'templates/single-portfolio/includes/element', 'project-details' ); ?>

                        </div> <!-- .portfolio-info-inner -->

                        <div id="portfolio-item-bottom">
                            
                            <?php 

                                get_template_part( 'templates/single-portfolio/includes/element', 'like' );

                                get_template_part( 'templates/single-portfolio/includes/element', 'share' );

                                get_template_part( 'templates/single-portfolio/includes/element', 'next-prev' );

                            ?>

                        </div> <!-- #portfolio-item-bottom -->

                    </aside> <!-- .portfolio-info -->
                
                <?php if( 'fixed' === $fixed_content && 'fixed_on_right' == $fixed_position ) : ?>
                    </div> <!-- .single-portfolio-affix -->
                    </div> <!-- .single-portfolio-affix-wrap -->
                <?php endif; ?>

            </div> <!-- .single-portfolio-affix-content -->
            
        </div> <!-- .col-md-4 -->

    </div> <!-- .row -->