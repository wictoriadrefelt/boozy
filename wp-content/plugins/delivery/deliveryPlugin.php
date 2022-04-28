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
                   $this->id                 = 'drone_shipping'; // Id for your shipping method. Should be uunique.
                   $this->method_title       = __( 'Drone Shipping' );  // Title shown in admin
                   $this->method_description = __( 'Get all your lovely bubbles straight to your door' ); // Description shown in admin
   
                   $this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
                   $this->title              = "Drone Shipping"; // This can be added as an setting but for this example its forced.

                   
                   $this->init();
               }
               
               public function init() {
                   // Load the settings API
                   $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
                   $this->init_settings(); // This is part of the settings API. Loads settings you previously init.
   
                   // Save settings in admin if you have any defined
                   add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
               }
               
               public function calculate_shipping( $package ) {
                   
                   $rate = array(
                       'label' => $this->title,
                       'cost' => '299',
                       'calc_tax' => 'per_item'
                   );
   
                   // Register the rate
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