<?php 


/*

Plugin Name: Delivery Plugin
Description: Plugin to offer different type of delivery. 


*/


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


    add_action( 'woocommerce_shipping_init', 'drone_shipping_init' );
 
    function drone_shipping_init() {
        if ( ! class_exists( 'WC_DRONE_SHIPPING') ) {
            class WC_DRONE_SHIPPING extends WC_Shipping_Method {
               
               public function __construct() {
                   $this->id                 = 'drone_shipping'; 
                   $this->method_title       = __( 'Drone Shipping' );  
                   $this->method_description = __( 'Get all your lovely bubbles straight to your door' ); 
   
                   $this->enabled            = "yes"; 
                   $this->title              = "Drone Shipping"; 

                   
                   $this->init();
               }
               
               public function init() {
                   
                   $this->init_form_fields(); 
                   $this->init_settings(); 
   
                 
                   add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
               }
               
               public function calculate_shipping( $package ) {
                   
                   $rate = array(
                       'label' => $this->title,
                       'cost' => '299',
                       'calc_tax' => 'per_item'
                   );
   
                   $this->add_rate( $rate );
                   
               }
               
            }
        }
    }
    
    add_filter( 'woocommerce_shipping_methods', 'add_drone_method');
    
    function add_drone_method( $methods ) {
       $methods['drone_shipping'] = 'WC_DRONE_SHIPPING';
       return $methods;
    }
}