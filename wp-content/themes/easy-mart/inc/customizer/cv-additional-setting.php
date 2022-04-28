<?php 
/**
 * Easy Mart manage the Customizer front page settings.
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

/*************** Sticky Menu Setting *****************/ 
// toggle field for sticky menu show/hide
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'toggle',
	'settings'    => 'sticky_menu_setting',
	'label'       => esc_html__( 'Show/hide Sticky Menu', 'easy-mart' ),
	'description' => esc_html__( 'Make your main menu sticky.', 'easy-mart' ),
	'section'     => 'sticky_menu_section',
	'default'     => true,
	'priority'    => 5,
) );

/*************** Follow Us Setting ***************/
// Custom heading
Kirki::add_field( 
'easy_mart_config', array(
	'type'        => 'custom',
	'settings'    => 'follow_us_sec_heading',
	'section'     => 'follow_us_section',
	'default'     => '<div style="padding: 10px;background-color: #333; color: #fff;">' . esc_html__( 'Display This Section From ', 'easy-mart' ) .'<strong>'. esc_html__( 'Appearance', 'easy-mart' ) . '&gt;'. esc_html__( 'Widgets', 'easy-mart' ) .'&gt;'. esc_html__( 'EM: Follow Us', 'easy-mart' ) .'</strong></div>',
	'priority'    => 5,
) );

// repeater field for follow us Icons
Kirki::add_field( 
	'easy_mart_config', array(
		'type'        	=> 'repeater',
		'label'       	=> esc_html__( 'Follow Us', 'easy-mart' ),
		'description' 	=> esc_html__( 'Drag & Drop items to re-arrange the order', 'easy-mart' ),
		'section'     	=> 'follow_us_section',
		'priority'		=> 10,
		'row_label'   	=> array(
			'type'  => 'text',
			'value' => esc_html__( 'Follow Icon', 'easy-mart' ),
		),
		'settings'    => 'follow_us_contents',
		'choices'		=> array(
			'limit'		=> 5
		),
		'default'     =>  array(
			array(
				'social_icon' => 'fa-facebook',
				'social_url'  => 'https://www.facebook.com/',
			),
			array(
				'social_icon' => 'fa-linkedin',
				'social_url'  => 'https://www.linkedin.com',
			),
		),
		'fields'      => array(
			'social_icon' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Social Icon', 'easy-mart' ),
				'default'    => 'fa-facebook',
				'choices'    => font_awesome_social_icon_array(),
 			),
			'social_url'  => array(
				'type'    => 'link',
				'label'   => esc_html__( 'Link', 'easy-mart' ),
			),
		),
	)
);

/************** Scroll To Top Setting  *******************/

// Scroll To Top Custom heading
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'custom',
	'settings'    => 'follow_us_section_heading',
	'section'     => 'scroll_to_top_btn_section',
	'default'     => '<div style="padding: 10px;background-color: #333; color: #fff;">'.__( 'Customize scroll to button','easy-mart' ).'</div>',
	'priority'    => 5,
) );

// toggle field for scroll to button
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'toggle',
	'settings'    => 'scroll_to_top_btn',
	'label'       => esc_html__( 'Show/hide scroll to top button ', 'easy-mart' ),
	'section'     => 'scroll_to_top_btn_section',
	'default'     => true,
	'priority'    => 10,
	'partial_refresh'    => array(
		'scroll_to_top_btn' => array(
			'selector'        => '.em-scroll-up',
			'render_callback' => 'scroll_to_top_btn',
	) ),
) );

// Text field for scroll to button text
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'text',
	'settings'    => 'scroll_to_button_text',
	'label'       => esc_html__( 'Button Text', 'easy-mart' ),
	'section'     => 'scroll_to_top_btn_section',
	'priority'    => 15,
	'active_callback' => array(
		array(
			'setting'  => 'scroll_to_top_btn',
			'operator' => '==',
			'value'    => true,
		)
	),
	'partial_refresh'    => array(
		'scroll_to_button_text' => array(
			'selector'        => '.em-scroll-up',
			'render_callback' => 'scroll_to_button_text',
	) ),
) );

