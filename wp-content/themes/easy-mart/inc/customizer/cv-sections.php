<?php 
/**
 * Easy Mart manage the Customizer sections.
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

/*****  Header Panels *****/

// Top header section
Kirki::add_section( 'top_header_sec', array(
    'title'          => esc_html__( 'Top Header Section', 'easy-mart' ),
    'panel'          => 'easy_mart_header_panel',
    'priority'       => 5,
) );

// Header section
Kirki::add_section( 'header_sec', array(
    'title'          => esc_html__( 'Header Section', 'easy-mart' ),
    'panel'          => 'easy_mart_header_panel',
    'priority'       => 10,
) );

/***** Front Page Panel ******/
// Announcement Ticker Section
Kirki::add_section( 'ticker_sec', array(
    'title'          => esc_html__( 'Announcement Ticker Section', 'easy-mart' ),
    'panel'          => 'easy_mart_front_page_panel',
    'priority'       => 5,
) );

// Promo section
Kirki::add_section( 'promo_sec', array(
    'title'          => esc_html__( 'Promo Section', 'easy-mart' ),
    'panel'          => 'easy_mart_front_page_panel',
    'priority'       => 10,
) ); 

// Partners section
Kirki::add_section( 'partners_sec', array(
    'title'          => esc_html__( 'Partners Section', 'easy-mart' ),
    'panel'          => 'easy_mart_front_page_panel',
    'priority'       => 15,
) );

/***** Design Panel ******/
// Page Design Section
Kirki::add_section( 'design_page_section', array(
    'title'          => esc_html__( 'Page Setting', 'easy-mart' ),
    'panel'          => 'easy_mart_design_panel',
    'priority'       => 5,
) ); 

// Archive Design Section
Kirki::add_section( 'design_archive_section', array(
    'title'          => esc_html__( 'Archive Setting', 'easy-mart' ),
    'panel'          => 'easy_mart_design_panel',
    'priority'       => 10,
) );

// Post Design Section
Kirki::add_section( 'design_post_section', array(
    'title'          => esc_html__( 'Post Setting', 'easy-mart' ),
    'panel'          => 'easy_mart_design_panel',
    'priority'       => 15,
) );

if( class_exists( 'Woocommerce' ) ){
    // Woocommerce Page Design Section
    Kirki::add_section( 'design_woocommerce_page_section', array(
        'title'          => esc_html__( 'Woocommerce Page Setting', 'easy-mart' ),
        'panel'          => 'easy_mart_design_panel',
        'priority'       => 20,
    ) );
}

/***** Additional Panel ******/
// Sticky Menu Section
Kirki::add_section( 'sticky_menu_section', array(
    'title'          => esc_html__( 'Sticky Menu Setting', 'easy-mart' ),
    'panel'          => 'easy_mart_additional_panel',
    'priority'       => 10,
) );

// Follow US Section
Kirki::add_section( 'follow_us_section', array(
    'title'          => esc_html__( 'Follow Us Setting', 'easy-mart' ),
    'panel'          => 'easy_mart_additional_panel',
    'priority'       => 20,
) ); 

// Scroll To Top Section
Kirki::add_section( 'scroll_to_top_btn_section', array(
    'title'          => esc_html__( 'Scroll To Top Button Setting', 'easy-mart' ),
    'panel'          => 'easy_mart_additional_panel',
    'priority'       => 30,
) ); 


/***** Footer Panel ******/
// Footer content Section
Kirki::add_section( 'site_copyright_section', array(
    'title'          => esc_html__( 'Footer Content', 'easy-mart' ),
    'panel'          => 'easy_mart_footer_panel',
    'priority'       => 5,
) );

// Footer column section
Kirki::add_section( 'footer_column_section', array(
    'title'          => esc_html__( 'Footer Column', 'easy-mart' ),
    'panel'          => 'easy_mart_footer_panel',
    'priority'       => 10,
) );

/******* Genearal Panel ***********/
// Site Settings
Kirki::add_section( 'site_setting', array(
    'title'          => esc_html__( 'Site Setting', 'easy-mart' ),
    'panel'          => 'easy_mart_general_panel',
    'priority'       => 50,
) );