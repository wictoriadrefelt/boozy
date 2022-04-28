<?php 
/**
 * Easy Mart manage the Customizer panels.
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

/**
 *  General Panel
 */
Kirki::add_panel( 'easy_mart_general_panel', array(
    'priority'    => 5,
    'title'       => esc_html__( 'General Setting', 'easy-mart' ),
) );

/**
 *  Header Panel
 */
Kirki::add_panel( 'easy_mart_header_panel', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Header Panel', 'easy-mart' ),
) );

/**
 *  Front Page Panel
 */
Kirki::add_panel( 'easy_mart_front_page_panel', array(
    'priority'    => 15,
    'title'       => esc_html__( 'Front Page Panel', 'easy-mart' ),
) ); 

/**
 *  Additional Panel
 */
Kirki::add_panel( 'easy_mart_additional_panel', array(
    'priority'    => 20,
    'title'       => esc_html__( 'Additional Setting', 'easy-mart' ),
) ); 

/**
 *  Design Panel
 */
Kirki::add_panel( 'easy_mart_design_panel', array(
    'priority'    => 25,
    'title'       => esc_html__( 'Design Setting', 'easy-mart' ),
) );

/**
 *  Footer Panel
 */
Kirki::add_panel( 'easy_mart_footer_panel', array(
    'priority'    => 30,
    'title'       => esc_html__( 'Footer Setting', 'easy-mart' ),
) ); 