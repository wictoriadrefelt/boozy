<?php
/**
 * Easy Mart Theme Customizer
 *
 * @package Easy Mart
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function easy_mart_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->get_section( 'title_tagline' )->panel = 'easy_mart_general_panel';
	$wp_customize->get_section( 'colors' )->panel = 'easy_mart_general_panel';
	$wp_customize->get_section( 'background_image' )->panel = 'easy_mart_general_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'easy_mart_general_panel';
    $wp_customize->remove_section( 'header_image' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'easy_mart_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'easy_mart_customize_partial_blogdescription',
        ) );
    }
    
    // Require upsell customizer section class.
	require get_template_directory() . '/inc/customizer/cv-customizer-upsell-class.php';

	/**
     * Register custom section types.
     *
     * @since 1.0.0
     */
	$wp_customize->register_section_type( 'Easy_Mart_Customize_Section_Upsell' );

	/**
     * Register theme upsell sections.
     *
     * @since 1.0.0
     */
    $wp_customize->add_section( new Easy_Mart_Customize_Section_Upsell(
        $wp_customize,
            'theme_upsell',
            array(
                'title'    => esc_html__( 'Buy Easy Mart Pro', 'easy-mart' ),
                'pro_url'  => 'https://codevibrant.com/wpthemes/easy-mart-pro/',
                'priority'  => 1,
            )
        )
    );
}
add_action( 'customize_register', 'easy_mart_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function easy_mart_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function easy_mart_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the top header contact number for the selective refresh partial.
 *
 */
function top_header_contact_number(){
    $contact_num = get_theme_mod( 'top_header_contact_number', '+123 456 4444' );
    return esc_html( $contact_num );
}

/**
 * Render the top header email text for the selective refresh partial.
 *
 */
function top_header_email_text(){
    $email_txt = get_theme_mod( 'top_header_email_text','abc@gmail.com' );
    return esc_html( $email_txt );
}

/**
 * Render the top header address text for the selective refresh partial.
 *
 */
function top_header_address_text(){
    $address_txt = get_theme_mod( 'top_header_address_text','' );
    return esc_html( $address_txt );
}

/**
 * Render the site announcement display option for the selective refresh partial.
 *
 */
function ticker_display_opt(){
    $ticker_display_opt = get_theme_mod( 'ticker_display_opt', false );
	if( false == $ticker_display_opt ){
		return;
	}else{
        return easy_mart_header_ticker_section();
    }
}

/**
 * Render the site announcement caption for the selective refresh partial.
 *
 */
function ticker_caption(){
    $ticker_caption = get_theme_mod( 'ticker_caption', __( 'Announcement', 'easy-mart') );
    return esc_html( $ticker_caption );
}

/**
 * Render the site announcement item text for the selective refresh partial.
 *
 */
function ticker_item_txt(){
    $ticker_item_txt = get_theme_mod( 'ticker_item_txt', '' );
    return esc_html( $ticker_item_txt );
} 


/**
 * Render the category menu for the selective refresh partial.
 *
 */
function header_category_menu_opt(){
    $header_category_menu_opt = get_theme_mod( 'header_category_menu_opt', '' );
    if( false == $header_category_menu_opt ){
		return;
	}else{
        return easy_mart_header_category_menu();
    }
} 

/**
 * Render the header cart for the selective refresh partial.
 *
 */
function header_cart_icon_opt(){
    $header_cart_icon_opt = get_theme_mod( 'header_cart_icon_opt', '' );
    return esc_html( $header_cart_icon_opt );
}

/**
 * Render the scroll to top btn for the selective refresh partial.
 *
 */
function scroll_to_top_btn(){
    $scroll_to_top_btn = get_theme_mod( 'scroll_to_top_btn', '' );
    if( false == $scroll_to_top_btn ){
		return;
	}else{
        return easy_mart_scroll_to_top_btn();
    }
}

/**
 * Render the scroll to top btn text for the selective refresh partial.
 *
 */
function scroll_to_button_text(){
    $scroll_to_button_text = get_theme_mod( 'scroll_to_button_text', '' );
    if( empty( $scroll_to_button_text ) ){  
        return '<i id="em-scrollup" class="fa fa-arrow-up"></i>';
    }else {
        return esc_html( $scroll_to_button_text );
    }
}

/**
 * Render the footer copyright text for the selective refresh partial.
 *
 */
function easy_mart_footer_copyright(){
    $easy_mart_footer_copyright = get_theme_mod( 'easy_mart_footer_copyright', '' );
    return esc_html( $easy_mart_footer_copyright );
}

/**
 * Render the footer copyright text for the selective refresh partial.
 *
 */
function site_copyright_section_image(){
    $site_copyright_section_image = get_theme_mod( 'site_copyright_section_image', '' );
    return '<img src="'.esc_url( $site_copyright_section_image ).'">';
}

/*----------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function easy_mart_customize_backend_scripts() {

    wp_enqueue_style( 'customizer-style', get_template_directory_uri() . '/assets/css/em-customizer-style.css', array(), 'all' );
    wp_enqueue_style( 'backend-fontawesome-style', get_template_directory_uri() . '/assets/library/font-awesome/css/fontawesome.min.css', array(), '5.7.0' );
     
    wp_enqueue_script( 'easy-mart-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array(), '20151215', false );
}
add_action( 'customize_controls_enqueue_scripts', 'easy_mart_customize_backend_scripts', 10 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function easy_mart_customize_preview_js() {

	wp_enqueue_script( 'easy-mart-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );

}
add_action( 'customize_preview_init', 'easy_mart_customize_preview_js' );


/**
 * Add Kirki customizer library file
 */
require get_template_directory() . '/inc/kirki/kirki.php';

/**
 * Configuration for Kirki Framework
 */
function easy_mart_kirki_configuration() {
    return array(
        'url_path' => get_template_directory_uri() . '/inc/kirki/',
    );
}
add_filter( 'kirki/config', 'easy_mart_kirki_configuration' );

/**
 * Easy Mart Kirki Config
 */
Kirki::add_config( 'easy_mart_config', array(
    'capability'  => 'edit_theme_options',
    'option_type' => 'theme_mod',
) );

require get_template_directory() . '/inc/customizer/cv-general-setting.php';
require get_template_directory() . '/inc/customizer/cv-panels.php';
require get_template_directory() . '/inc/customizer/cv-sections.php';
require get_template_directory() . '/inc/customizer/cv-header-settings.php';
require get_template_directory() . '/inc/customizer/cv-footer-setting.php';
require get_template_directory() . '/inc/customizer/cv-front-page-settings.php';
require get_template_directory() . '/inc/customizer/cv-design-setting.php';
require get_template_directory() . '/inc/customizer/cv-additional-setting.php';

