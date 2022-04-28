<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function easy_mart_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'easy_mart_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function easy_mart_woocommerce_scripts() {
	wp_enqueue_style( 'easy-mart-woocommerce-style', get_template_directory_uri() . '/inc/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'easy-mart-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'easy_mart_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function easy_mart_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'easy_mart_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function easy_mart_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'easy_mart_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function easy_mart_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'easy_mart_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function easy_mart_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'easy_mart_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function easy_mart_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'easy_mart_woocommerce_related_products_args' );

if ( ! function_exists( 'easy_mart_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function easy_mart_woocommerce_product_columns_wrapper() {
		$columns = easy_mart_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'easy_mart_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'easy_mart_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function easy_mart_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'easy_mart_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'easy_mart_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function easy_mart_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'easy_mart_woocommerce_wrapper_before' );

if ( ! function_exists( 'easy_mart_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function easy_mart_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'easy_mart_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 */

if ( ! function_exists( 'easy_mart_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function easy_mart_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		easy_mart_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'easy_mart_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'easy_mart_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function easy_mart_woocommerce_cart_link() {
		?>
		<a class="header-cart cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'easy-mart' ); ?>">
			<span class="easy_mart_cart_icon">
				<i class="fa fa-shopping-cart"></i>
			</span>
				<?php
				$item_count_text = sprintf(
					/* translators: number of items in the mini cart. */
					_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'easy-mart' ),
					WC()->cart->get_cart_contents_count()
				);
				?>
			<span class="easy_mart_cart_num count">
				<strong>
					<?php echo esc_html( $item_count_text ); ?>
				</strong>
			</span>
			<span class="cart-total amount">
				<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
			</span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'easy_mart_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function easy_mart_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php easy_mart_woocommerce_cart_link(); ?>
			</li>
			<li>
			<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
			?>
			</li>
		</ul>
<?php
	}
}

if( !function_exists( 'product_btn_wrapper_start' ) ):
	/**
	 * Product button wrapper start
	 *
	 */
	function product_btn_wrapper_start() {
?>	
		<div class="easy-mart-woo-product-btn-wrapper">
<?php
	}
endif;

/**
 * Product Add to wishlist button
 *
 */
function easy_mart_wishlist_btn() {
	if ( ! function_exists( 'YITH_WCWL' ) ) {	
	    return;
	}
	global $product;
	$product_id = yit_get_product_id( $product );
	$current_product = wc_get_product( $product_id );
	$product_type = $current_product->get_type();
	$whishlist_url = YITH_WCWL()->get_wishlist_url();
?>	
		<a class="wishlist-button add_to_wishlist" href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', intval( $product_id ) ) )?>" rel="nofollow" data-product-id="<?php echo esc_attr( $product_id ); ?>" data-product-type="<?php echo esc_attr( $product_type ); ?>">
			<i class="fa fa-heart"></i>
		</a> <!-- .whishlist-buttom -->
<?php
}

/**
 * Product permalink button
 *
 */
function easy_mart_product_permalink_btn() {
?>	
	<a class="permalink-button" href="<?php the_permalink(); ?>">
		<i class="fa fa-link"></i>
	</a><!-- .permalink-buttom-wrap -->
<?php
}

if( !function_exists( 'product_btn_wrapper_end' ) ):
	/**
	 * Product button wrapper end
	 *
	 */
	function product_btn_wrapper_end() {
?>	
		</div><!-- .easy-mart-woo-product-btn-wrapper -->
<?php
	}
endif;

/**
 *  Function for thumbnail wrapper start
 *
 */
if( !function_exists( 'shop_product_thumbnail_wrap_start' ) ):
	/**
	 * Product image wrap start
	 *
	 */
	function shop_product_thumbnail_wrap_start(){
?>
		<figure class="woocommerce-image-wrapper">
<?php 
	}
endif;

/**
 *  Function for thumbnail wrapper end
 *
 */
if( !function_exists( 'shop_product_thumbnail_wrap_end' ) ):
	/**
	 * Product image wrap start
	 *
	 */
	function shop_product_thumbnail_wrap_end(){
?>
	</figure>
<?php 
}
endif;
add_action( 'woocommerce_before_shop_loop_item_title', 'shop_product_thumbnail_wrap_start', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'product_btn_wrapper_start', 14 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15 );
add_action( 'woocommerce_before_shop_loop_item_title', 'easy_mart_wishlist_btn', 20 );
add_action( 'woocommerce_before_shop_loop_item_title', 'easy_mart_product_permalink_btn', 25 );
add_action( 'woocommerce_before_shop_loop_item_title', 'product_btn_wrapper_end', 26 );
add_action( 'woocommerce_before_shop_loop_item_title', 'shop_product_thumbnail_wrap_end', 30 );
/*--------------------------------------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'archive_product_title_wrapper_start' ) ):
	/**
	 * Function title wrapper start
	 *
	 */
	function archive_product_title_wrapper_start(){
?>
		<div class="woocommerce-loop-title-wrapper">
<?php 
	}
endif;

if( !function_exists( 'archive_product_title_wrapper_end' ) ):
	/**
	 * Function title wrapper end
	 *
	 */
	function archive_product_title_wrapper_end(){
?>
		</div><!-- .woocommerce-loop-title-wrapper -->
<?php 
	}
endif;

add_action( 'woocommerce_shop_loop_item_title', 'archive_product_title_wrapper_start', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
add_action( 'woocommerce_after_shop_loop_item', 'archive_product_title_wrapper_end', 15 );
/*--------------------------------------------------------------------------------------------------------------------------------------*/

// Removed add to cart from product archive
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating' , 5);
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

/**
 * Star rating in archive product
 *
 *
 */
function add_star_rating(){
global $woocommerce, $product;
$average = $product->get_average_rating();

echo '<div class="star-rating"><span style="width:'.( ( absint( $average ) / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.absint( $average ).'</strong> '.esc_html( 'out of 5', 'easy-mart' ).'</span></div>';
}
add_action('woocommerce_after_shop_loop_item_title', 'add_star_rating', 5 ); 

/*-------------------------------------------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'get_shop_sidebar' ) ):
/**
 * Function for shop sidebar
 *
 *
 */
function get_shop_sidebar(){
	if( !is_active_sidebar( 'shop-sidebar' ) ){
		return;
	}
	echo '<aside id="secondary" class="widget-area">';
		dynamic_sidebar( 'shop-sidebar' );
	echo '</aside><!-- #secondary -->';
}
endif;
// Remove woocommerce sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
add_action( 'woocommerce_sidebar', 'get_shop_sidebar', 15 );

/*-------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_woo_product_search' ) ) :
	/**
     * Woocommerce Product search 
     * 
     */
	function easy_mart_woo_product_search(){ 

		$args = array(
                'number'     => '',
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => true
            );
            $product_categories = get_terms( 'product_cat', $args ); 
            $categories_show = '<option value="">'.esc_html__('All Categories','easy-mart').'</option>';
            $check = '';
            if( is_search() ){
                if( isset( $_GET['term'] ) && $_GET['term']!='' ){
					$check = isset($_GET['term']) ? sanitize_text_field( wp_unslash( $_GET['term'] ) ): '';
                }
            }
            $checked = '';
            $allcat = esc_html__( 'All Categories','easy-mart' );
            $categories_show .= '<optgroup class="sm-advance-search" label="'.$allcat.'">';
            foreach( $product_categories as $category ){
                if( isset( $category->slug ) ){
                    if( trim( $category->slug ) == trim( $check ) ){
                        $checked = 'selected="selected"';
                    }
                    $categories_show  .= '<option '.$checked.' value="'.esc_attr( $category->slug ).'">'.esc_html( $category->name ).'</option>';
                    $checked = '';
                }
            }
            $categories_show .= '</optgroup>';
            $form = '<div class="cv-woo-product-search-wrapper"><form role="search" method="get" class="woocommerce-product-search" id="searchform"  action="' . esc_url( home_url( '/'  ) ) . '">
            			<div class = "search-wrap">
	                         <div class="sm_search_wrap">
	                            <select class="cv-select-products false" name="term">'.$categories_show.'
	                            </select>
	                         </div>
	                         <div class="sm_search_form">
	                             <input class="search-field" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' .esc_attr__('Search products','easy-mart'). '" autocomplete="off"/>
	                             <button type="submit" id="searchsubmit">
	                             <i class="fa fa-search"></i></button>
	                             <input type="hidden" name="post_type" value="product" />
	                             <input type="hidden" name="taxonomy" value="product_cat" />
	                         </div>
	                         <div class="search-content"></div>
	                    </div>
                         
                    </form><!-- .woocommerce-product-search --></div><!-- .cv-woo-product-search-wrapper -->';
		echo $form;
	}
endif;
/*-------------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Widget list view function
 * 
 */

function btn_price_wrapper_start(){
	echo '<div class="woocommerce-price-btn-wrapper">';
}

function btn_price_wrapper_end(){
	echo '</div><!-- .woocommerce-price-btn-wrapper -->';
}