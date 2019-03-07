<?php
	// Define Blocks location
	define('COMPOSER_BLOCKS', 		 COMPOSER_DIR . 		'/blocks');
	define('COMPOSER_BLOCKS_URI', 		 COMPOSER_URI . 		'/blocks');

	// Get option value
	if ( class_exists( 'WooCommerce' ) ) {
		$block_default = array( 'blog_blocks', 'grid_blog_blocks', 'featured_blog_blocks', 'portfolio_blocks', 'shop_blocks', 'gallery_blocks' );
	}
	else {
		$block_default = array( 'blog_blocks', 'grid_blog_blocks', 'featured_blog_blocks', 'portfolio_blocks', 'gallery_blocks' );
	}

    $required_blocks = composer_get_option_value( 'required_blocks', $block_default );

    // Required Files
    if( in_array( 'blog_blocks', $required_blocks ) || ( isset( $required_blocks['blog_blocks'] ) && $required_blocks['blog_blocks'] ) ) {
		composer_require_file ( COMPOSER_BLOCKS .			'/blog-blocks/class-blog-blocks.php' ); // Class Blog Block
    }

    if( in_array( 'grid_blog_blocks', $required_blocks ) || ( isset( $required_blocks['grid_blog_blocks'] ) && $required_blocks['grid_blog_blocks'] ) ) {
    	composer_require_file ( COMPOSER_BLOCKS .			'/grid-blog-blocks/class-grid-blog-blocks.php' ); // Class Grid Blog Block
    }

    if( in_array( 'featured_blog_blocks', $required_blocks ) || ( isset( $required_blocks['featured_blog_blocks'] ) && $required_blocks['featured_blog_blocks'] ) ) {
		composer_require_file ( COMPOSER_BLOCKS .			'/featured-blog-blocks/class-featured-blog-blocks.php' ); // Class Featured Blog Block
	}

	if( in_array( 'portfolio_blocks', $required_blocks ) || ( isset( $required_blocks['portfolio_blocks'] ) && $required_blocks['portfolio_blocks'] ) ) {
		composer_require_file ( COMPOSER_BLOCKS .			'/portfolio-blocks/class-portfolio-blocks.php' ); // Class Portfolio Block
	}

	if( class_exists( 'WooCommerce' ) && ( in_array( 'shop_blocks', $required_blocks ) || ( isset( $required_blocks['shop_blocks'] ) && $required_blocks['shop_blocks'] ) ) ) {
		composer_require_file ( COMPOSER_BLOCKS .			'/shop-blocks/class-shop-blocks.php' ); // Class Shop Block
	}

	if( in_array( 'gallery_blocks', $required_blocks ) || ( isset( $required_blocks['gallery_blocks'] ) && $required_blocks['gallery_blocks'] ) ) {
		composer_require_file ( COMPOSER_BLOCKS .			'/gallery-blocks/class-gallery-blocks.php' ); // Class Gallery Block
	}


	if( in_array( 'blog_blocks', $required_blocks ) ||
		in_array( 'grid_blog_blocks', $required_blocks ) || 
		in_array( 'featured_blog_blocks', $required_blocks ) || 
		in_array( 'portfolio_blocks', $required_blocks )  || 
		( class_exists( 'WooCommerce' ) && in_array( 'shop_blocks', $required_blocks ) ) ||
		in_array( 'gallery_blocks', $required_blocks ) ||
		( isset( $required_blocks['blog_blocks'] ) && $required_blocks['blog_blocks'] ) ||
		( isset( $required_blocks['grid_blog_blocks'] ) && $required_blocks['grid_blog_blocks'] ) ||
		( isset( $required_blocks['featured_blog_blocks'] ) && $required_blocks['featured_blog_blocks'] ) ||
		( isset( $required_blocks['portfolio_blocks'] ) && $required_blocks['portfolio_blocks'] ) ||
		( class_exists( 'WooCommerce' ) && isset( $required_blocks['shop_blocks'] ) && $required_blocks['shop_blocks'] ) ||
		( isset( $required_blocks['gallery_blocks'] ) && $required_blocks['gallery_blocks'] )
	) {
		// Admin Enque CSS and Scripts
		add_action( 'admin_enqueue_scripts', 'vc_pagebuilder_icon' );

		function vc_pagebuilder_icon( $hook_suffix ){

			if( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) {

				//Load CSS
				wp_enqueue_style( 'vc_pagebuilder_icon', COMPOSER_BLOCKS_URI. '/assets/css/vc-pagebuilder-icon.css', array('tinymce_style'), 1.0 );

			}
			
		}

	}