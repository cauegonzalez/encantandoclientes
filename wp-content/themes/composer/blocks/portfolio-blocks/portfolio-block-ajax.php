<?php

    function portfolio_blocks_loadmore(){

        // Empty assignment
        $output = '';

        // Portfolio blocks class Initialised
        $portfolio_blocks = new portfolio_blocks();

        // Get ajax values
        $args = isset($_POST['args']) ? $_POST['args'] : '';
        $values = isset($_POST['values']) ? $_POST['values'] : '';
        $options = $values['options'];

        // Add next paged number in a query
        $args['paged'] = isset($_POST['paged']) ? $_POST['paged'] : 1;

        //Assign and call query
        $query = new WP_Query( $args );
        query_posts( $args );

        if ( have_posts() ) :
            $post_count = 1;

            while ( have_posts() ) : the_post();

                $id = get_the_ID();

                // Get column class for items
                $class = $portfolio_blocks->get_column_class( $values['code'], $post_count );

                // Build term slug separated with space, those slugs appends to portfolio item classes
                $terms = get_the_terms( $id,'pix_categories' );
                $slug_class = '';
                if( !empty( $terms ) ) {
                    foreach( $terms as $term ) {
                        $slug_class .= ' ' . esc_attr( strtolower( str_replace( ' ','-',$term->slug ) ) );
                        $filter_array[$term->slug] = $term->name; // It helps to build a filter
                    }
                }

                $output .= '<div class="load-element pix-portfolio-item element '. esc_attr( $options['style'] . ' ' . $class . ' ' . $post_count . $slug_class ) .'">';

                    $output .= '<div class="portfolio-container portfolio-'. esc_attr( $options['style'] ) .'">';

                        $output .= $portfolio_blocks->initialize( $values['code'], $options, $post_count, $values['total_post'] );

                    $output .= '</div>'; // portfolio-container

                $output .= '</div>'; // element

            $post_count++; endwhile;

        else:
            $output .= '<div>'. esc_html__('Portfolio Not Found.', 'composer'). '</div>';
        endif;

        echo "<div class='ajax-posts-wrap' >";

            if ( have_posts() ) {
                echo "<div class='ajax-posts' data-paged='". esc_attr( $args['paged'] ) ."' data-categories='". json_encode( $filter_array ) ."'>";
                    echo $output;
                echo '</div>';
            }
            else {
                echo $output;
            }            
            
        echo '</div>';

        wp_reset_query();

        die();
    }

    // ajax functions
    add_action('wp_ajax_portfolio_blocks_loadmore',  'portfolio_blocks_loadmore' );
    add_action('wp_ajax_nopriv_portfolio_blocks_loadmore', 'portfolio_blocks_loadmore' );