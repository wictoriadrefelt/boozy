<?php 
/**
 * Functions which enhance the theme header by hooking into WordPress
 *
 * @package CodeVibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 *
 */

if( ! function_exists( 'easy_mart_top_header_start' ) ) :

	/** 
	 * Top header start function
	 */
	function easy_mart_top_header_start() { 
		echo '<div class="top-header">';
		echo '<div class="cv-container">';
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_top_header_site_info' ) ) :

	/** 
	 * Top header contact section
	 */
	function easy_mart_top_header_site_info() { 
		$contact_num = get_theme_mod( 'top_header_contact_number','+123 456 4444' );
		$email_txt = get_theme_mod( 'top_header_email_text','abc@gmail.com' );
		$address_txt = get_theme_mod( 'top_header_address_text','' );
		if( empty( $contact_num ) && empty( $email_txt ) && empty( $address_txt ) ){
			return;
		}
?>
		<div class="header-info-wrap">
			<?php if( !empty( $contact_num ) ){ ?>
				<div class="header-info-block contact_num">
					<?php echo esc_html( $contact_num ); ?>
				</div>
			<?php } if( !empty( $email_txt ) ){ ?>
				<div class="header-info-block email_txt">
					<?php echo esc_html( $email_txt ); ?>
				</div>
			<?php } if( !empty( $address_txt ) ){ ?>
				<div class="header-info-block address_txt">
					<?php echo esc_html( $address_txt ); ?>
				</div>
			<?php } ?>
		</div>
<?php 
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_top_header_nav_wrap_start' ) ) :

	/** 
	 * Output the start of nav wrap.
	 */
	function easy_mart_top_header_nav_wrap_start() {
		echo '<div class="top-nav-wishlist-wrappper">';
	}

endif;
/*--------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_top_header_wishlist_btn' ) ) :
	
	/** 
	 * Top header Wishlist function
	 */
	function easy_mart_top_header_wishlist_btn() {
		$top_header_wishlist_btn = get_theme_mod( 'top_header_wishlist_btn', true );
		if( !function_exists( 'YITH_WCWL' ) || ( $top_header_wishlist_btn ) === false  ){ 
			return;
		}

		$wishlist_text = get_theme_mod( 'wishlist_text', 'Wishlist' );
		$whishlist_url = YITH_WCWL()->get_wishlist_url();
?>
		<div class="cv-whishlist">
			<a href="<?php echo esc_url( $whishlist_url ); ?>">
				<i class="fa fa-heart"></i>
				<?php echo esc_html( $wishlist_text ); ?>
				<span class="cv-wl-counter">
					<?php printf( esc_html( '%s', 'easy-mart' ), absint( yith_wcwl_count_products() ) ); ?>
				</span> 
			</a>
		</div>
<?php
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_top_header_nav_menu' ) ) :

	/** 
	 * Top header Nav Menu function
	 */
	function easy_mart_top_header_nav_menu() { 
?>
		<nav id="top-header-nav" class="main-navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-2',
				'menu_id'        => 'top-header-menu',
				'depth'			 => '1',
			) );
			?>
		</nav><!-- #site-navigation -->
<?php
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_top_header_nav_wrap_end' ) ) :

	/** 
	 * Output the start of nav wrap.
	 */
	function easy_mart_top_header_nav_wrap_end() {
		echo '</div><!-- .top-nav-wishlist-wrappper -->';
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_top_header_end' ) ) :

	/** 
	 * Top header end function
	 */
	function easy_mart_top_header_end() {
		echo '</div><!-- .cv-container -->';
		echo '</div><!-- .top-header -->';
	}

endif;
/*--------------------------------------------------------------------------------------------------------------------------------*/

add_action( 'easy_mart_top_header_sec', 'easy_mart_top_header_start', 10 );
add_action( 'easy_mart_top_header_sec', 'easy_mart_top_header_site_info', 20 );
add_action( 'easy_mart_top_header_sec', 'easy_mart_top_header_nav_wrap_start', 30 );
add_action( 'easy_mart_top_header_sec', 'easy_mart_top_header_wishlist_btn', 40 );
add_action( 'easy_mart_top_header_sec', 'easy_mart_top_header_nav_menu', 50 );
add_action( 'easy_mart_top_header_sec', 'easy_mart_top_header_nav_wrap_end', 60 );
add_action( 'easy_mart_top_header_sec', 'easy_mart_top_header_end', 70 );

/*--------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_header_start' ) ) :

	/** 
	 * Header start function
	 */
	function easy_mart_header_start() { 
		echo '<header id="masthead" class="site-header">';
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'easy_mart_header_site_branding_wrapper_start' ) ) :

	/** 
	 * Header site branding start function
	 */
	function easy_mart_header_site_branding_wrapper_start() {
?>

		<div class="site-branding-wrapper">
			<div class="cv-container">
<?php	
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'easy_mart_header_site_branding' ) ) :

	/** 
	 * Header site branding function
	 */
	function easy_mart_header_site_branding() {
?>
		<div class="site-branding">
			<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
			?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
				endif;
				$easy_mart_description = get_bloginfo( 'description', 'display' );
				if ( $easy_mart_description || is_customize_preview() ) :
			?>
					<p class="site-description"><?php echo esc_html( $easy_mart_description ); /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
<?php
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'easy_mart_header_search' ) ) :

	/** 
	 * Header search function
	 */
	function easy_mart_header_search() { 

		if( !is_active_sidebar( 'header_section' ) ) {
			return;
		}
?>
		<div class="search-wrapper">
			<?php dynamic_sidebar( 'header_section' ); ?> 
		</div><!-- .search-wrapper --> 
<?php
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'easy_mart_header_site_branding_wrapper_end' ) ) :

	/** 
	 * Header site branding end function
	 */
	function easy_mart_header_site_branding_wrapper_end() {
?>
		</div><!-- .cv-container -->	
		</div><!-- .site-branding-wrapper -->		
<?php
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'easy_mart_header_primary_nav_start' ) ) :

	/** 
	 * Header Primary Nav start function
	 */
	function easy_mart_header_primary_nav_start() { 
		$sticky_menu_setting = get_theme_mod( 'sticky_menu_setting', true );
		if( true == esc_attr( $sticky_menu_setting ) ){
			$header_class = 'header_sticky';
		} else {
			$header_class = '';
		}
?>	
		<div class="site-primary-nav-wrapper clearfix <?php echo esc_html( $header_class ); ?>">
			<div class="cv-container">	
<?php
}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'easy_mart_header_category_menu' ) ) :

	/** 
	 * Header Category Menu function
	 */
	function easy_mart_header_category_menu() {
		$header_category_menu_opt = get_theme_mod( 'header_category_menu_opt', true ); 
		if( esc_attr( $header_category_menu_opt ) == false ) {
			return;
		}
?>
        <div class="em-cat-menu">
            <h3 class="categories-title"><i class="fa fa-bars"></i> <?php esc_html_e( 'Category Menu', 'easy-mart' ); ?> </h3>
            <div class="category-dropdown" style="display: none;">
            	<?php
				if( !class_exists( 'WooCommerce' ) ){
					$list_args = array(
                        'taxonomy' => 'category',
                        'title_li' => '',
                        'hierarchical' => false,
                        'hide_empty' => '1',
					);
				}else{
                    $list_args = array(
                        'taxonomy' => 'product_cat',
                        'title_li' => '',
                        'hierarchical' => false,
                        'hide_empty' => '1',
					);
				}
                    echo '<ul class="product-categories">';
                        wp_list_categories( apply_filters( 'easy_mart_slider_cat_list', $list_args ) );
                    echo '</ul>';
                ?>
            </div>
        </div><!-- .em-cat-menu -->
<?php
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_header_nav' ) ) :

	/** 
	 * Header navigation function
	 */
	function easy_mart_header_nav() {
?>
		<div class="site-main-menu-wrapper">
            <div class="menu-toggle hide"> <i class="fa fa-bars"></i><?php esc_html_e( 'Menu', 'easy-mart' ); ?></div>
			<nav id="site-navigation" class="main-navigation">
            <div class="menu-close hide"> <i class="fa fa-close"> </i><?php esc_html_e( 'Close', 'easy-mart' ); ?></div>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
				?>
			</nav><!-- #site-navigation -->
		</div><!-- .site-main-menu -->
<?php
	}

endif;
/*----------------------------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'easy_mart_header_cart' ) ) :

	/**
	 * Header Cart function
	 */
	function easy_mart_header_cart() {
		$header_cart_icon_opt = get_theme_mod( 'header_cart_icon_opt', true );
		if(  !class_exists( 'WooCommerce' ) || ( $header_cart_icon_opt ) === false ) {
			return;
		}
		easy_mart_woocommerce_cart_link();
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'easy_mart_header_primary_nav_end' ) ) :

	/** 
	 * Header Primary Nav end function
	 */
	function easy_mart_header_primary_nav_end() {
?>
			</div><!-- cv-container -->
		</div><!-- .site-primary-nav-wrapper -->	
<?php
	}

endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'easy_mart_header_end' ) ) :

	/** 
	 * Header end function
	 */
	function easy_mart_header_end() { 
		echo '</header><!-- #masthead -->';
	}
	
endif;

/*--------------------------------------------------------------------------------------------------------------------------------*/
add_action( 'easy_mart_header_sec', 'easy_mart_header_start', 10 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_site_branding_wrapper_start', 20 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_site_branding', 30 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_search', 40 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_site_branding_wrapper_end', 50 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_primary_nav_start', 60 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_category_menu', 70 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_nav', 80 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_cart', 90 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_primary_nav_end', 100 );
add_action( 'easy_mart_header_sec', 'easy_mart_header_end', 110 );