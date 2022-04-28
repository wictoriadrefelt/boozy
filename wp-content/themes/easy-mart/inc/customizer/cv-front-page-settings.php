<?php 
/**
 * Easy Mart manage the Customizer front page settings.
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */


/****** Ticker Section ***********/

//  Ticker custom text 
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'custom',
	'settings'    => 'ticker_option',
	'section'     => 'ticker_sec',
	'default'     => '<div style="padding: 20px;background-color: #333; color: #fff;">' . esc_html__( 'Annoucement Ticker Option', 'easy-mart' ) . '</div>',
	'priority'    => 10,
) );

Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'toggle',
	'settings'    => 'ticker_display_opt',
	'label'       => __( 'Show/Hide annoucement ticker section', 'easy-mart' ),
	'section'     => 'ticker_sec',
	'default'     => false,
	'priority'    => 15,
	'partial_refresh'    => array(
		'ticker_display_opt' => array(
			'selector'        => '#content .cv-container .em-ticker-section',
			'render_callback' => 'ticker_display_opt',
	) ),
) );

// text field for ticker caption
Kirki::add_field( 'easy_mart_config', array(
	'type'     => 'text',
	'settings' => 'ticker_caption',
	'label'    => __( 'Ticker Caption', 'easy-mart' ),
	'section'  => 'ticker_sec',
	'default'  => __( 'Announcement', 'easy-mart'),
	'priority' => 20,
	'active_callback' => array(
		array(
			'setting'  => 'ticker_display_opt',
			'operator' => '==',
			'value'    => true,
		)
	),
	'partial_refresh'    => array(
		'ticker_caption' => array(
			'selector'        => '.em-ticker-section h3',
			'render_callback' => 'ticker_caption',
	) ),
) );

// reapeater field for ticker items
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'text',
	'label'       => __( 'Ticker Item', 'easy-mart' ),
	'section'     => 'ticker_sec',
	'sanitize_callback' => 'wp_kses_post',
	'priority'    => 30,
	'settings'     => 'ticker_item_txt',
	'active_callback' => array(
		array(
			'setting'  => 'ticker_display_opt',
			'operator' => '==',
			'value'    => true,
		)
	),
	'partial_refresh'    => array(
		'ticker_item_txt' => array(
			'selector'        => '.em-ticker-section .ticker-content .ticker-item',
			'render_callback' => 'ticker_item_txt',
	) ),
) );

/******************* Promo Section ************************/

// Custom heading
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'custom',
	'settings'    => 'promo_sec_heading',
	'section'     => 'promo_sec',
	'default'     => '<div style="padding: 10px;background-color: #333; color: #fff;">' . esc_html__( 'Display This Section From ', 'easy-mart' ) .'<strong>'. esc_html__( 'Appearance', 'easy-mart' ) .  '&gt;'. esc_html__( 'Widgets', 'easy-mart' ) .'&gt;'. esc_html__( 'EM: Promo Section', 'easy-mart' ) .'</strong></div>',
	'priority'    => 5,
) );

// Repeater field for promo content
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'repeater',
	'label'       => esc_html__( 'Promo Content', 'easy-mart' ),
	'section'     => 'promo_sec',
	'priority'    => 10,
	'row_label' => array(
		'type'  => 'text',
		'value' => esc_html__( 'Promo', 'easy-mart' ),
	),
	'button_label' => esc_html__( 'Add new', 'easy-mart' ),
	'settings'     => 'promo_sec_repeater',
	'choices'		=> array(
			'limit'		=> 4
		),
	'default'      => array(
		array(
			'promo_icon' => 'fa-apple',
			'promo_title'  => __( 'Free Delivery', 'easy-mart' ),
		),
		array(
			'promo_icon' => 'fa-apple',
			'promo_title'  => __( 'Free Shipping', 'easy-mart' ),
		),
	),
	'fields' => array(
		'promo_icon' => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Promo Icon', 'easy-mart' ),
			'default'     => 'fa-amazon',
			'choices'     => font_awesome_list(),
		),
		'promo_title'  => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Promo Title', 'easy-mart' ),
			'default'     => 'Free Shipping',
		),
	),	
) );

/******************* Partners Section ************************/
// Custom heading
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'custom',
	'settings'    => 'partners_sec_heading',
	'section'     => 'partners_sec',
	'default'     => '<div style="padding: 10px;background-color: #333; color: #fff;">' . esc_html__( 'Display This Section From ', 'easy-mart' ) .'<strong>'. esc_html__( 'Appearance', 'easy-mart' ) . '&gt;'. esc_html__( 'Widgets', 'easy-mart' ) .'&gt;'. esc_html__( 'EM: Partners Section', 'easy-mart' ) .'</strong></div>',
	'priority'    => 5,
) );

Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'repeater',
	'label'       => esc_html__( 'Partners Images', 'easy-mart' ),
	'section'     => 'partners_sec',
	'priority'    => 10,
	'row_label' => array(
		'type'  => 'text',
		'value' => esc_html__('Partner', 'easy-mart' ),
	),
	'button_label' => esc_html__( 'Add new', 'easy-mart' ),
	'settings'     => 'frontpage_partner_section_setting',
	'choices'		=> array(
			'limit'		=> 5
		),
	'fields' => array(
		'partner_image' => array(
			'type'        => 'image',
			'label'       => esc_html__( 'Partner Image', 'easy-mart' ),
			'default'     => '',
		),
		'partner_url'  => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Image URL', 'easy-mart' ),
			'default'     => '',
		),
	)
) );