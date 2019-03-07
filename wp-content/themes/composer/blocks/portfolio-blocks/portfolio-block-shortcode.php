<?php
    /* =============================================================================
     Portfolio Blocks Shortcodes
     ========================================================================== */

    function composer_portfolio_blocks( $atts, $content = null, $code ){

        //Portfolio blocks class Initialised
        $portfolio_blocks = new portfolio_blocks();

        // Get number of items value
        $block_count = $portfolio_blocks->get_post_count( $code );

        extract( shortcode_atts( array(
            'el_class'             => '',
            'insert_type'          => 'posts', //posts, id
            'id'                   => '',
            'filter'               => 'yes',
            'filter_style'         => 'normal simple',  //normal, dropdown, simple
            'order_by'             => 'modified', //'none', ID', 'author' , 'title', 'name', 'date', 'modified', 'parent', 'rand', 'menu_order'
            'order'                => 'desc', //desc, asc
            'no_of_items'          => $block_count,
            'exclude_portfolio'    => '',
            'style'                => 'style1', // style1, style2, style3, style4, style5, style6
            'title_tag'            => 'h2',
            'show_terms'           => 'yes', // yes, no    
            'show_like'            => 'yes', // yes, no    
            'port_hover_color'     => '', // port-bg-white, port-bg-color
            'show_lightbox'        => 'yes', // yes, no
            'on_click'             => 'single_port_link', // single_port_link, single_button_link, none
            'margin'               => 'margin-no', // margin-no, margin-yes            
            'append_content'       => 'no', // yes, no
            'append_content_pos'   => '1',
            'append_content_align' => 'left', // left, right, center
            'append_title'         => esc_html__( 'Our Work', 'composer' ),
            'append_button_link'   => '',           
            'pagination'           => 'none', // none, load_more, autoload, number, text
            'loadmore_text'        => esc_html__( 'Load More', 'composer' ),            
            'allpost_loaded_text'  => esc_html__( 'All Portfolio Loaded', 'composer' )
        ), $atts ) );

        // Empty assignment
        $wrap_start = $wrap_end = $content_inner_start = $content_inner_end = $filter_html = $portfolio_item_html = $pagination_html = $output = $size = '';

        // Filter categories
        $terms = false; $filter_array = $filter_array_order = array();

        // Set paged
        if( get_query_var( 'paged' ) ) {
            $paged = get_query_var( 'paged' );
        }
        elseif( get_query_var( 'page' ) ) {
            $paged = get_query_var( 'page' );
        }
        else{
            $paged = 1;
        }

        //Build id as array
        $post_in = array_filter( explode( ",", $id ) );

        // Portfolio Arguements
        if( !empty( $exclude_portfolio ) ){
            $exclude_portfolio = explode( ',', $exclude_portfolio );
        }
        else{
            $exclude_portfolio = '';
        }

        //Query arguement for Insert type: Posts, Category, ID
        if( $insert_type == 'id' && !empty( $post_in ) ){
            $args = array( 
                'post_type'           => 'pix_portfolio',             
                'order'               => $order,
                'orderby'             => 'post__in',
                'posts_per_page'      => $no_of_items,
                'post__in'            => $post_in,
                'post__not_in'        => $exclude_portfolio,
                'ignore_sticky_posts' => 1,
                'paged'               => $paged, 
                'post_status'         => 'publish'
            );
        }
        else{
            $args = array(
                'post_type'           => 'pix_portfolio',
                'orderby'             => $order_by,
                'order'               => $order,
                'posts_per_page'      => $no_of_items,
                'post__not_in'        => $exclude_portfolio,
                'ignore_sticky_posts' => 1,
                'paged'               => $paged, 
                'post_status'         => 'publish'
            );
        }

        // Assign and call query
        $query = new WP_Query( $args );
        query_posts( $args );

        // Total Post
        $total_post = $query->post_count;
        $total_post = ( 'yes' == $append_content ) ? $total_post - 1 : $total_post;

        // Portfolio Options
        $options = array();
        
        $options['style']            = $style;
        $options['filter']           = $filter;
        $options['filter_style']     = $filter_style;
        $options['title_tag']        = $title_tag;
        $options['show_terms']       = $show_terms;
        $options['show_like']        = $show_like;
        $options['port_hover_color'] = $port_hover_color;
        $options['show_lightbox']    = $show_lightbox;
        $options['on_click']         = $on_click;
        $options['margin']           = $margin;

        // Assign Post count
        $post_count = 1;

        // Grid Sizer Class
        if( 'grid_block12' == $code ) {
            $grid_sizer = 'vc_col-sm-6';
        }
        else {
            $grid_sizer = 'vc_col-sm-3';
        }

        // Adjust append content position
        $append_content_pos = ( 'no' == $append_content ) ? 0 : $append_content_pos;

        if ( have_posts() ) : 

            $wrap_start .= '<div class="loadmore-wrap no-portfolio-carousel '. esc_attr( $port_hover_color .' '. $el_class ) .'">';

                    $content_inner_start .= '<div class="portfolio-block-container load-container portfolio-contents '. esc_attr( $port_hover_color . ' ' . $margin ) .'">';

                        $portfolio_item_html .= '<div class="portfolio-grid-sizer '. esc_attr( $grid_sizer ) .'"></div>';

                            while ( have_posts() ) : the_post();

                                $id = get_the_ID();

                                // Assign Post count
                                $post_count = ( $post_count > $block_count ) ? 1 : $post_count;

                                // Get column class for items
                                $class = $portfolio_blocks->get_column_class( $code, $post_count );

                                // Add apend content
                                if( 'yes' == $append_content && ( int )$append_content_pos === $post_count ){ 

                                    // Get append content box size
                                    $size = $portfolio_blocks->get_image_size( $code, $post_count );

                                    $portfolio_item_html .= '<div class="'. esc_attr( $class ) .' pix-portfolio-item portfolio-text-content '. esc_attr( $style ) .' append-'. esc_attr( $append_content_align ) .'" style="min-height:'. esc_attr( $size['height'] ) .'px;">';
                                        $portfolio_item_html .= '<div class="portfolio-inner-text">';
                                            $portfolio_item_html .= '<h2>'. esc_html( $append_title ) .'</h2>';
                                            $portfolio_item_html .= '<p>'. esc_html( $content ). '</p>';

                                            $btn_att = vc_build_link( $append_button_link );
                                            $btn_att['href'] = ( isset( $btn_att['url']) && !empty( $btn_att['url'] ) ) ? $btn_att['url'] : '#';
                                            $btn_att['title'] = ( isset($btn_att['title'] ) && !empty( $btn_att['title'] ) ) ? $btn_att['title'] : esc_html__('Read More','composer' );
                                            $btn_att['target'] = ( isset( $btn_att['target'] ) ) ? $btn_att['target'] : ''; 

                                            if( !empty( $btn_att['href'] ) && !empty( $btn_att['title'] ) ){
                                                $portfolio_item_html .= '<div class="pix_button"><a href="'. esc_url( $btn_att['href'] ) .'" '. ( ( !empty( $btn_att['target'] ) ) ? ' target="'. esc_attr( $btn_att['target'] ) .'"' : '' ).' class="clear btn btn-solid btn-oval color btn-hover-solid">'. esc_html( $btn_att['title'] ) .'</a></div>';
                                            }
                                        $portfolio_item_html .= '</div>';
                                    $portfolio_item_html .= '</div>';
                                }

                                // Build term slug separated with space, those slugs appends to portfolio item classes
                                $terms = get_the_terms( $id,'pix_categories' );
                                $slug_class = '';
                                if( !empty( $terms ) ) {
                                    foreach( $terms as $term ) {
                                        if( 0 == $term->parent ) {
                                            $slug_class .= ' ' . esc_attr( strtolower( str_replace( ' ','-',$term->slug ) ) );
                                            $filter_array[$term->slug] = $term->name; // It helps to build a filter
                                            if( isset( $term->term_order ) ) {
                                                $filter_array_order[$term->slug] = $term->term_order;
                                            }
                                        }
                                    }
                                }

                                if( ( int )$append_content_pos != $post_count ){ // skip append position portfolio item
                                    $portfolio_item_html .= '<div class="load-element pix-portfolio-item element '. esc_attr( $style . ' ' . $class . ' ' . $post_count . $slug_class ) .'">';

                                        $portfolio_item_html .= '<div class="portfolio-container portfolio-'. esc_attr( $style ) .'">';

                                            $portfolio_item_html .= $portfolio_blocks->initialize( $code, $options, $post_count, $total_post );

                                        $portfolio_item_html .= '</div>'; // portfolio-container

                                    $portfolio_item_html .= '</div>'; // element
                                }

                            $post_count++; endwhile;
        
        else:
            $portfolio_item_html .= '<div>'. esc_html__( 'No Portfolio Items Found.', 'composer' ) .'</div>';
        endif;
        
        $content_inner_end .= '</div>'; // portfolio-contents

        // Portfolio Pagination
        if( empty( $offset ) ) {
            // Values array
            $values = array();

            $values['style']               = $pagination;
            $values['loadmore_text']       = $loadmore_text;
            $values['allpost_loaded_text'] = $allpost_loaded_text;
            $values['action']              = 'portfolio_blocks_loadmore';
            $values['code']                = $code;
            $values['options']             = $options;
            $values['total_post']          = $total_post;

            $pagination_html .= $portfolio_blocks->pagination( $args, $values );
        }

        $wrap_end .= '</div>'; // no-portfolio-carousel

        $filter_html .= $portfolio_blocks->filter( $options['filter'], $options['filter_style'], $filter_array, $filter_array_order );

        $output = $wrap_start . $filter_html . $content_inner_start . $portfolio_item_html . $content_inner_end . $pagination_html . $wrap_end;

        wp_reset_query();
        return  $output;
    }

    add_shortcode( 'portfolio_block1', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block2', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block3', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block4', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block5', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block6', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block7', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block8', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block9', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block10', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block11', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block12', 'composer_portfolio_blocks' );
    add_shortcode( 'portfolio_block13', 'composer_portfolio_blocks' );