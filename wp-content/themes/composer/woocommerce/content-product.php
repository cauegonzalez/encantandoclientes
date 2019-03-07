<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$page_layout = composer_get_option_value( 'shop_sidebar', 'full-width' );
$selected_sidebar_replacement = composer_get_option_value( 'shop_select_sidebar', 0 );
$cart_btn = composer_get_option_value( 'cart_btn_on_hover', 'hide' );

$title_tag = composer_get_option_value( 'shop_title_tag', 'h3' );

// Extra post classes
$classes = array();
if( $page_layout == 'right-sidebar' || $page_layout == 'left-sidebar' ) {
	$classes = array('col-md-4');
	$grid_sizer = 'col-md-4';
}
else {
	$classes = array('col-md-3');
	$grid_sizer = 'col-md-3';
}

$classes[] = 'load-element';

$shop_style_layout = composer_get_option_value( 'shop_style', 'default' );
$shop_catalog_styles = composer_get_option_value( 'shop_catalog_styles', 'classic' );

if( 'masonry' == $shop_style_layout ) {
	$classes[] = 'shop-item';
}

$classes[] = 'shop-' . $shop_catalog_styles;

?>
<div <?php wc_product_class( $classes ); ?>>
	<?php	 
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	do_action( 'woocommerce_before_shop_loop_item_title' );

	echo '<div class="woo-product-item">';

		echo '<div class="product-img amz-product-thumbnail">';

			echo '<a href="'. esc_url( get_permalink() ) .'">';

				woocommerce_show_product_loop_sale_flash();

				$img = $image_thumb_url[0] = "";
				
				$shop_width = composer_get_option_value( 'shop_width', 398 );
				$shop_height = composer_get_option_value( 'shop_height', 494 );

				$shop_thumb = composer_get_meta_value( get_the_ID(), '_amz_shop_thumb', '' );
				$shop_thumb = ! empty( $shop_thumb ) ? json_decode( $shop_thumb, true ) : '';
				$shop_thumb_id = ! empty( $shop_thumb ) ? $shop_thumb[0]['itemId'] : '';

				if( ! empty( $shop_thumb_id ) ) {
					echo composer_get_image_by_id( $shop_width, $shop_height, $shop_thumb_id, 0, 1, 0 );
				}
				else if ( has_post_thumbnail() ) {

					$amz_image_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id (), 'full' );
					$amz_image_url = $amz_image_thumb_url[0];

					if( ! empty( $amz_image_url ) ) {

						$image_url = aq_resize( $amz_image_url, $shop_width, $shop_height, true, true );

						if( $image_url ) {
							echo '<img alt="" src="' . $image_url . '" width="' . $shop_width . '" height="' . $shop_height . '">';
						} else {
							echo '<img alt="" src="' . $amz_image_thumb_url[0] . '">';
						}

					}						

					$amz_gallery_ids = $product->get_gallery_image_ids();						

					if ( $amz_gallery_ids ) {
						$amz_image_thumb_url = wp_get_attachment_image_src( $amz_gallery_ids[0], 'full');
						$amz_image_url = $amz_image_thumb_url[0];

						if( ! empty( $amz_image_url ) ) {
							$amz_image_url = aq_resize( $amz_image_url, $shop_width, $shop_height, true, true );
						}

						if( $amz_image_url ) {
							echo '<img alt="" class="amz-image-swap" src="' . $amz_image_url . '" width="' . $shop_width . '" height="' . $shop_height . '">';
						} else {
							echo '<img alt="" class="amz-image-swap" src="' . $amz_image_thumb_url[0] . '">';
						}

					}

				}
				else {
					echo '<img src="'. esc_url( '//placehold.it/'.$shop_width.'x'.$shop_height ).'" alt="">';	
				}

			echo '</a>';
						
			if( $cart_btn != 'hide' ){
				echo '<div class="product-hover product-icons">';								
					echo woocommerce_template_loop_add_to_cart();
				echo '</div>';
			}

		echo '</div>';

		echo '<div class="product-content clearfix">';
			
			echo '<'. composer_title_tag( $title_tag ) .' class="title"><a href="'. esc_url( get_permalink() ) .'"> '.esc_html( get_the_title() ).'</a></'. composer_title_tag( $title_tag ) .'>';

			/**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			do_action( 'woocommerce_shop_loop_item_title' );

			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			do_action( 'woocommerce_after_shop_loop_item_title' );

			woocommerce_template_loop_price();


			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			do_action( 'woocommerce_after_shop_loop_item' );

			?>
			
			

		</div>

	</div>
</div>
