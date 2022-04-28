<?php 
/**
 * Easy Mart manage the Customizer sections.
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */
/**  Primary color  **/
// Color Picker field for Primary Color
Kirki::add_field( 
	'easy_mart_config', array(
		'type'        => 'color',
		'settings'    => 'easy_mart_primary_color',
		'label'       => esc_html__( 'Primary Color', 'easy-mart' ),
		'section'     => 'colors',
		'default'     => '#DF3550',
	)
);

/** Top Header Section **/
// text field for contact number text
Kirki::add_field( 'easy_mart_config', array(
	'type'     => 'text',
	'settings' => 'top_header_contact_number',
	'label'    => esc_html__( 'Add contact number', 'easy-mart' ),
	'section'  => 'top_header_sec',
	'default'  => esc_html__( '+123 456 4444', 'easy-mart' ),
	'priority' => 5,
	'partial_refresh'    => array(
		'top_header_contact_number' => array(
			'selector'        => '.header-info-wrap .contact_num',
			'render_callback' => 'top_header_contact_number',
	) ),
) );

// text field for email text
Kirki::add_field( 'easy_mart_config', array(
	'type'     => 'text',
	'settings' => 'top_header_email_text',
	'label'    => esc_html__( 'Add email', 'easy-mart' ),
	'section'  => 'top_header_sec',
	'default'  => esc_html__( 'abc@gmail.com', 'easy-mart' ),
	'priority' => 10,
	'partial_refresh'    => array(
		'top_header_email_text' => array(
			'selector'        => '.header-info-wrap .email_txt',
			'render_callback' => 'top_header_email_text',
	) ),
) );

// text field for address text
Kirki::add_field( 'easy_mart_config', array(
	'type'     => 'text',
	'settings' => 'top_header_address_text',
	'label'    => esc_html__( 'Add address text', 'easy-mart' ),
	'section'  => 'top_header_sec',
	'priority' => 15,
	'partial_refresh'    => array(
		'top_header_address_text' => array(
			'selector'        => '.header-info-wrap .address_txt',
			'render_callback' => 'top_header_address_text',
	) ),
) );

if ( class_exists( 'YITH_WCWL' ) ) {
	// toggle field for wishlist show/hide
	Kirki::add_field( 'easy_mart_config', array(
		'type'        => 'toggle',
		'settings'    => 'top_header_wishlist_btn',
		'label'       => esc_html__( 'Show/hide wishlist', 'easy-mart' ),
		'description' => esc_html__( 'Activate your YITH WooCommerce Wishlist plugin to display wishlist', 'easy-mart' ),
		'section'     => 'top_header_sec',
		'default'     => true,
		'priority'    => 20,
	) );

	// text field for wishlist text
	Kirki::add_field( 'easy_mart_config', array(
		'type'     => 'text',
		'settings' => 'wishlist_text',
		'label'    => esc_html__( 'Add Wishlist Text', 'easy-mart' ),
		'section'  => 'top_header_sec',
		'default'  => esc_html__( 'Wishlist', 'easy-mart' ),
		'priority' => 25,
		'active_callback' => array(
			array(
				'setting'  => 'top_header_wishlist_btn',
				'value'    => true,
				'operator' => 'in',
			),
		),
	) );
}


/****** Header Section *****/

// toggle field for Category Menu show/hide
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'toggle',
	'settings'    => 'header_category_menu_opt',
	'label'       => esc_html__( 'Show/hide Category Menu', 'easy-mart' ),
	'section'     => 'header_sec',
	'default'     => true,
	'priority'    => 10,
	'partial_refresh'    => array(
		'header_category_menu_opt' => array(
			'selector'        => '.em-cat-menu',
			'render_callback' => 'header_category_menu_opt',
	) ),
) );

if ( class_exists( 'WooCommerce' ) ) {

	// toggle field for cart icon show/hide
	Kirki::add_field( 'easy_mart_config', array(
		'type'        => 'toggle',
		'settings'    => 'header_cart_icon_opt',
		'label'       => esc_html__( 'Show/hide Cart', 'easy-mart' ),
		'description' => esc_html__( 'Activate your WooCommerce plugin to display cart', 'easy-mart' ),
		'section'     => 'header_sec',
		'default'     => true,
		'priority'    => 15,
		'partial_refresh'    => array(
			'header_cart_icon_opt' => array(
				'selector'        => '.header-cart',
				'render_callback' => 'header_cart_icon_opt',
		) ),
	) );

}
