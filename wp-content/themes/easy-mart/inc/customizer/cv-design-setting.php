<?php 
/**
 * Easy Mart manage the Customizer design settings.
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

/************* Page Setting **************/
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'radio-image',
	'settings'    => 'design_page_section_setting',
	'label'       => esc_html__( 'Page Sidebar layout', 'easy-mart' ),
	'section'     => 'design_page_section',
	'default'     => 'right-sidebar',
	'priority'    => 10,
	'choices'     => array(
		'no-sidebar'   => get_template_directory_uri() . '/assets/images/no-sidebar.png',
		'left-sidebar'  => get_template_directory_uri() . '/assets/images/left-sidebar.png',
		'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
		'no-sidebar-center' => get_template_directory_uri() . '/assets/images/box-no-sidebar.png',
	),
) );

/************* Archive Setting **************/
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'radio-image',
	'settings'    => 'design_archive_section_setting',
	'label'       => esc_html__( 'Archive Sidebar layout', 'easy-mart' ),
	'section'     => 'design_archive_section',
	'default'     => 'right-sidebar',
	'priority'    => 10,
	'choices'     => array(
		'no-sidebar'   => get_template_directory_uri() . '/assets/images/no-sidebar.png',
		'left-sidebar'  => get_template_directory_uri() . '/assets/images/left-sidebar.png',
		'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
		'no-sidebar-center' => get_template_directory_uri() . '/assets/images/box-no-sidebar.png',
	),
) );

/************* Post Setting **************/
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'radio-image',
	'settings'    => 'design_post_section_setting',
	'label'       => esc_html__( 'Post Sidebar layout', 'easy-mart' ),
	'section'     => 'design_post_section',
	'default'     => 'right-sidebar',
	'priority'    => 10,
	'choices'     => array(
		'no-sidebar'   => get_template_directory_uri() . '/assets/images/no-sidebar.png',
		'left-sidebar'  => get_template_directory_uri() . '/assets/images/left-sidebar.png',
		'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
		'no-sidebar-center' => get_template_directory_uri() . '/assets/images/box-no-sidebar.png',
	),
) );

/************* Woocommerce Page Setting **************/
Kirki::add_field( 'easy_mart_config', array(
	'type'        => 'radio-image',
	'settings'    => 'design_wc_page_section_setting',
	'label'       => esc_html__( 'Sidebar layout', 'easy-mart' ),
	'section'     => 'design_woocommerce_page_section',
	'default'     => 'right-sidebar',
	'priority'    => 10,
	'choices'     => array(
		'no-sidebar'   => get_template_directory_uri() . '/assets/images/no-sidebar.png',
		'left-sidebar'  => get_template_directory_uri() . '/assets/images/left-sidebar.png',
		'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
		'no-sidebar-center' => get_template_directory_uri() . '/assets/images/box-no-sidebar.png',
	),
) );


