<?php
/**
 * The custom theme template for displaying product content within loops
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>  
<li <?php wc_product_class(); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
    do_action( 'woocommerce_before_shop_loop_item' );
    
    shop_product_thumbnail_wrap_start();
    woocommerce_show_product_loop_sale_flash();
    woocommerce_template_loop_product_thumbnail();
	shop_product_thumbnail_wrap_end();
	
    
    /**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	add_action( 'woocommerce_list_after_shop_loop_item_title', 'add_star_rating', 5 );
	add_action( 'woocommerce_list_after_shop_loop_item_title', 'btn_price_wrapper_start', 6 );
	add_action( 'woocommerce_list_after_shop_loop_item_title', 'product_btn_wrapper_start', 8 );
	add_action( 'woocommerce_list_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 8 );
	add_action( 'woocommerce_list_after_shop_loop_item_title', 'easy_mart_wishlist_btn', 8 );
	add_action( 'woocommerce_list_after_shop_loop_item_title', 'easy_mart_product_permalink_btn', 8 );
	add_action( 'woocommerce_list_after_shop_loop_item_title', 'product_btn_wrapper_end', 8 );
	add_action( 'woocommerce_list_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	add_action( 'woocommerce_list_after_shop_loop_item_title', 'btn_price_wrapper_end', 12 );
	do_action( 'woocommerce_list_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>