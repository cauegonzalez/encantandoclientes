<?php    
	
    $prefix = ( isset($_POST['values'] ) ) ? $_POST['values']['prefix'] : composer_get_prefix();

    // Pagination
    $pagination          = composer_get_option_value($prefix.'pagination', 'number'); // load_more, autoload, number, text
    $loadmore_text       = composer_get_option_value( $prefix.'loadmore_text', esc_html__( 'Load More', 'composer' ) );
    $allpost_loaded_text = composer_get_option_value( $prefix.'allpost_loaded_text', esc_html__( 'All Posts Loaded', 'composer' ) );
    $change_url          = composer_get_option_value( $prefix.'change_url', 'no' );

    // Values array
    $values = array();

    $values['style']               = $pagination;    
    $values['loadmore_text']       = $loadmore_text;
    $values['allpost_loaded_text'] = $allpost_loaded_text;
    $values['change_url']          = $change_url;
    $values['action']              = 'blog_loadmore';

    // Default
    $args = array(
        'posts_per_page'      => get_option( 'posts_per_page' ),
        'ignore_sticky_posts' => 1
    );
    
    if( is_category() ) : // Archive Category

        $category_obj = get_term_by( 'name', single_cat_title('',false), 'category' );
        $slug = $category_obj->slug;

        $category = array(
            'category_name' => $slug
        );

        $args = array_merge( $args, $category );
    
    elseif( is_author() ) : // Archive Author

        global $post;
        $author_id = $post->post_author;

        $author = array(
            'author' => $author_id
        );

        $args = array_merge( $args, $author );

    elseif( is_tag() ) : // Archive Tag

        $posttags = get_term_by( 'name', single_tag_title( '',false ), 'post_tag' );
        $slug = $posttags->slug;

        $tag = array(
            'tag' => $slug
        );

        $args = array_merge( $args, $tag );
    
    elseif( is_day() ) : // Archive Day

        $day = array(
            'day'      => get_the_time( 'j' ),
            'monthnum' => get_the_time( 'm' ),
            'year'     => get_the_time( 'Y' )
        );

        $args = array_merge( $args, $day );
     
     elseif( is_month() ) : // Archive Month

        $month = array(
            'monthnum' => get_the_time( 'm' ),
            'year'     => get_the_time( 'Y' )
        );
        $args = array_merge( $args, $month );
    
    elseif( is_year() ) : // Archive Year

        $year = array(
            'year' => get_the_time('Y')
        );

        $args = array_merge( $args, $year );
    
    elseif( is_search() ) : // Archive Search

        $search = array(
            's' => get_search_query()
        );
        
        $args = array_merge( $args, $search );   

    endif;

    echo composer_pagination( $args, $values ); // args, values