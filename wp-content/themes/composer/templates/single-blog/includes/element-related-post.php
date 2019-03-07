<?php

	$prefix = composer_get_prefix();

    $id = get_the_ID();

    // Get related post values from theme options
	$show_related_post = composer_get_option_value( $prefix.'related', 'show' );
	$title             = composer_get_option_value( $prefix.'related_title', esc_html__( 'Related Posts', 'composer' ) );
	$columns           = composer_get_option_value( $prefix.'related_columns', 'col1' );
	$title_length      = composer_get_option_value( $prefix.'related_title_length', 30 );
	$content_length    = composer_get_option_value( $prefix.'related_content_length', 90 );
	$items             = composer_get_option_value( $prefix.'related_no', 2 );
	$orderby           = composer_get_option_value( $prefix.'related_orderby', 'random' );
	$order             = composer_get_option_value( $prefix.'related_order', 'asc' );
	$bottom_meta       = composer_get_option_value( $prefix.'related_bottom_meta', 'like_comment' );
	$like              = composer_get_option_value( $prefix.'related_like', 'yes' );
	$comment           = composer_get_option_value( $prefix.'related_comment', 'yes' );
	$featured_image    = composer_get_option_value( $prefix.'related_featured_image', 'no' );
	$link_text         = composer_get_option_value( $prefix.'related_link_text', esc_html__( 'Read More', 'composer' ) );

    if( 'show' == $show_related_post && class_exists( 'Composer_Base_Plugin' ) ) :

		$category = get_the_category();

		if( !empty( $category ) ) :

			foreach ( $category as $key => $cat ) :
				$slug[] = $cat->slug;
			endforeach;

			$slug_string = implode( ', ', $slug );
		
		endif;

		$args = array(		
			'post_type' => 'post',		
			'order' => $order,
			'posts_per_page' => $items,
			'post__not_in' => array( $id ),
			'ignore_sticky_posts' => 1,
			'post_status' => 'publish',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-quote', 'post-format-link' ),
					'operator' => 'NOT IN'
				),
				array(
					'taxonomy' => 'category',
		            'field' => 'slug',
		            'terms' => $slug
				),
			)
		);

		$q = new WP_Query( $args );
		if ( $q->have_posts() ) : ?>
			<div class="related-post">
				<h2 class="title pull-out"><?php echo esc_html( $title ); ?></h2>

				<?php 
					echo do_shortcode('[blog exclude_id="'. esc_attr( $id ) .'" show_featured_image="'. esc_attr( $featured_image ) .'" columns="'. esc_attr( $columns ) .'" title_length="'. esc_attr( $title_length ) .'" excerpt_length="'. esc_attr( $content_length ) .'" slider="no" no_of_items="'. esc_attr( $items ) .'" insert_type ="category" category="'. esc_attr( $slug_string ) .'" order_by = "'. esc_attr( $orderby ) .'" order = "'. esc_attr( $order ) .'" show_like="'. esc_attr( $like ) .'" show_comment="'. esc_attr( $comment ) .'" bottom_meta="'. esc_attr( $bottom_meta ) .'" link_text="'. esc_attr( $link_text ) .'"]');
				?> 

			</div>

		<?php endif;

	endif;