<?php
/**
 * Files to managed the all function related to widgets
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 *
 */
/*---------------------------------------------------------------------------------------------------------------------------------*/

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function easy_mart_widgets_init() {

	/**
	 * Register Sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'easy-mart' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register Header Section 
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Header Section', 'easy-mart' ),
		'id'            => 'header_section',
		'description'   => esc_html__( 'This section is displayed after the site logo.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register Frontpage Top Section 
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage Top Section', 'easy-mart' ),
		'id'            => 'frontpage_top_section',
		'description'   => esc_html__( 'Displays content on the top of the main content area with full width on frontpage.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register front page Middle sections  
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'FrontPage Middle Sections', 'easy-mart' ),
		'id'            => 'front_page_middle_section_area',
		'description'   => esc_html__( 'Add widgets here to display it in the middle part of the main content area on frontpage.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register front page Middle Section Sidebar  
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'FrontPage Middle Section Sidebar', 'easy-mart' ),
		'id'            => 'front_page_middle_section_sidebar',
		'description'   => esc_html__( 'Add widgets here to display it on the right side of the main content area on frontpage.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register front page Bottom section  
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'easy-mart' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register front page Bottom section  
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Bottom Section', 'easy-mart' ),
		'id'            => 'front_page_bottom_section_area',
		'description'   => esc_html__( 'Add widgets here to display it with full width on the bottom of the main content area on frontpage.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register footer sidebar 1  
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 1', 'easy-mart' ),
		'id'            => 'footer-sidebar-1',
		'description'   => esc_html__( 'Displays content on the top of the footer section.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register footer sidebar 2  
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 2', 'easy-mart' ),
		'id'            => 'footer-sidebar-2',
		'description'   => esc_html__( 'Displays content on the top of the footer section.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register footer sidebar 3  
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 3', 'easy-mart' ),
		'id'            => 'footer-sidebar-3',
		'description'   => esc_html__( 'Displays content on the top of the footer section.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register footer sidebar 4
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 4', 'easy-mart' ),
		'id'            => 'footer-sidebar-4',
		'description'   => esc_html__( 'Displays content on the top of the footer section.', 'easy-mart' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cv-block-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'easy_mart_widgets_init' );

/*---------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Register various widgets
 *
 * @since 1.0.0
 */
function easy_mart_register_widget(){
	register_widget( 'Easy_Mart_Follow_Us' );
	register_widget( 'Easy_Mart_Partners_Section' );
	register_widget( 'Easy_Mart_Default_Post_Category' );
	register_widget( 'Easy_Mart_Promo_Section' );
    register_widget( 'Easy_Mart_Slider' );

    if( class_exists( 'WooCommerce' ) ){
    	register_widget( 'Easy_Mart_Advanced_Product_Search' );
    	register_widget( 'Easy_Mart_Products_Category_Collection' );
		register_widget( 'Easy_Mart_Featured_Latest_Product_List' );
		register_widget( 'Easy_Mart_Product_Category' );
    }   
}
add_action( 'widgets_init', 'easy_mart_register_widget' );

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/** 
 *  Widget files
 *
 */
if( class_exists( 'WooCommerce' ) ){
	require get_template_directory() . '/inc/widgets/cv-product-category.php';
	require get_template_directory() . '/inc/widgets/cv-featured-latest-product-list.php';
	require get_template_directory() . '/inc/widgets/cv-advanced-product-search.php';
	require get_template_directory() . '/inc/widgets/cv-product-category-collection.php';
}
require get_template_directory() . '/inc/widgets/cv-header-slider.php';
require get_template_directory() . '/inc/widgets/cv-default-post-category.php';
require get_template_directory() . '/inc/widgets/cv-promo-section.php';
require get_template_directory() . '/inc/widgets/cv-partner-section.php';
require get_template_directory() . '/inc/widgets/cv-follow-us.php';
require get_template_directory() . '/inc/widgets/cv-widget-hooks.php';
require get_template_directory() . '/inc/widgets/cv-widget-fields.php';
