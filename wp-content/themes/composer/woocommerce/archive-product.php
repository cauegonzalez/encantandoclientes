<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$page_layout = composer_get_option_value( 'shop_sidebar', 'full-width' );
$selected_sidebar_replacement = composer_get_option_value( 'shop_select_sidebar', 0 );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
do_action( 'woocommerce_before_main_content' );


if ( $page_layout == 'right-sidebar' || $page_layout == 'left-sidebar' ) {
	echo '<div class="row padding-top">';

	echo '<div class="col-md-9 '. esc_attr($page_layout ).'">';
}

$shop_class = '';

?>
<header class="woocommerce-products-header">
	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php

if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked wc_print_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

?>
	<div class="loadmore-wrap">
		<?php woocommerce_product_loop_start(); ?>

			<?php woocommerce_product_subcategories();

			$page_layout = composer_get_option_value( 'shop_sidebar', 'full-width' );

			$shop_style_layout = composer_get_option_value( 'shop_style', 'default' );

			if( $page_layout == 'right-sidebar' || $page_layout == 'left-sidebar' ){
				$grid_sizer = 'col-md-4';
			}else{
				$grid_sizer = 'col-md-3';
			}

			if( 'masonry' == $shop_style_layout ) {
				$shop_class .= ' shop-contents';
			}

			?>
				<div class="load-container products <?php echo $shop_class; ?>">
					<?php if( 'masonry' == $shop_style_layout ) { ?>
						<div class="shop-grid-sizer <?php echo esc_attr( $grid_sizer ); ?>"></div>
					<?php } 
						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						}
					?>
				</div>
		<?php woocommerce_product_loop_end(); ?>

		<?php

			global $wp_query;
			$prefix = composer_get_prefix();

			//Pagination
			$pagination = composer_get_option_value('shop_pagination', 'load_more'); // default, load_more, autoload

			$loadmore_text = composer_get_option_value( 'shop_loadmore_text', esc_html__( 'Load More', 'composer' ) );
			$allpost_loaded_text = composer_get_option_value( 'shop_allpost_loaded_text', esc_html__( 'All Posts Loaded', 'composer' ) );
    		$change_url          = composer_get_option_value( $prefix.'change_url', 'no' );

			// Arguements array
			$shop_count = composer_get_option_value( 'shop_count', 8 );

			// Ordering query vars
			$WC_Query  = new WC_Query;
			$ordering = $WC_Query->get_catalog_ordering_args();

			if( composer_is_shop() ) {
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => $shop_count, 
					'post_status'    => 'publish',
					'orderby'        => $ordering['orderby'],
					'order'          => $ordering['order'],
					'meta_key'       => $ordering['meta_key']
				);
			}
			else if( composer_is_product_category() ) {

				$args = array(
					'post_status'    => 'publish',
					'post_type'      => 'product',
					'posts_per_page' => $shop_count,
					'orderby'        => $ordering['orderby'],
					'order'          => $ordering['order'],
					'meta_key'       => $ordering['meta_key'],
					'tax_query'      => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => array( get_query_var('product_cat') )
						)
					)
				);
			}

			// Values array
			$values = array();

			$values['style']               = $pagination;    
			$values['loadmore_text']       = $loadmore_text;
			$values['allpost_loaded_text'] = $allpost_loaded_text;
			$values['change_url']          = $change_url;
			$values['action']              = 'shop_loadmore';

			$values['max'] = $wp_query->max_num_pages;

			echo composer_pagination( $args, $values ); // args, values
		?>
	</div>
<?php
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
	do_action( 'woocommerce_after_shop_loop' );

} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

if ( $page_layout == 'right-sidebar' || $page_layout == 'left-sidebar' ) {

	echo '</div>'; //col-md-9

	//If the sidebar position is right or left sidebar, it ll apply
	if( 'full-width' != $page_layout ){
		composer_sidebar( $selected_sidebar_replacement , 'shop' );
	}

	echo '</div>'; //row
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
