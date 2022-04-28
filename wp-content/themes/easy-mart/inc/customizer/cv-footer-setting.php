<?php 
/**
 * Easy Mart manage the Customizer options of footer settings.
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

/******** Footer Copyright Section  **********/
// Text field for copyright text
Kirki::add_field( 'easy_mart_config', array(
	'type'     => 'text',
	'settings' => 'easy_mart_footer_copyright',
	'label'    => esc_html__( 'Footer Text', 'easy-mart' ),
	'section'  => 'site_copyright_section',
	'default'  => esc_html__( 'Easy Mart', 'easy-mart' ),
	'priority' => 5,
	'partial_refresh'    => array(
		'easy_mart_footer_copyright' => array(
			'selector'        => '.footer-copyright-text',
			'render_callback' => 'easy_mart_footer_copyright',
	) ),
) );

//Reapeater control for additional images
Kirki::add_field( 
	'easy_mart_config', array(
		'type'        	=> 'image',
		'label'       	=> esc_html__( 'Payment Partner Image', 'easy-mart' ),
		'section'     	=> 'site_copyright_section',
		'priority'		=> 10,
		'settings'    => 'site_copyright_section_image',
		'partial_refresh'    => array(
			'site_copyright_section_image' => array(
				'selector'        => '.site-payment-support',
				'render_callback' => 'site_copyright_section_image',
		) ),
	)
);

/******** Footer Copyright Section  **********/
// Footer column setting
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'radio-image',
	'settings'    => 'footer_column_section_layout',
	'label'       => esc_html__( 'Footer layout', 'easy-mart' ),
	'section'     => 'footer_column_section',
	'default'     => 'column-3',
	'priority'    => 30,
	'choices'     => array(
		'column-1'   => get_template_directory_uri() . '/assets/images/column-one.png',
		'column-2'  => get_template_directory_uri() . '/assets/images/column-two.png',
		'column-3' => get_template_directory_uri() . '/assets/images/column-three.png',
		'column-4' => get_template_directory_uri() . '/assets/images/column-four.png',
	),
) );
