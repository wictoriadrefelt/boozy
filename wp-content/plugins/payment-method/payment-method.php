<?php
/*
 * Plugin Name: Payment method 
 * Version: 1.0.1
 */




if ( ! in_array('woocommerce/woocommerce.php', apply_filters('
active_plugins', get_option('active_plugins')))) return; 


add_action( 'plugins_loaded', 'init_alternative_payment', 11 );
function init_alternative_payment() {
    if ( class_exists('WC_Payment_Gateway')) {
	class WC_ALTERNATIVE_PAYMENT extends WC_Payment_Gateway {

 	
          public function __construct() {

            $this->id = 'alternative_payment';
            $this->has_fields = false; 
            $this->method_title = 'Alternative Payment';
            $this->method_description = 'A way to incorperate a different type of payment'; 
            
           
            
            // Load settings
            $this->init_settings();
            $this->title = $this->get_option( 'title' );
            $this->description = $this->get_option( 'description' );
            $this->instruction = $this->get_option( 'instruction' );
            $this->enabled = $this->get_option( 'enabled' );
            $this->testmode = 'yes' === $this->get_option( 'testmode' );
            $this->private_key = $this->testmode ? $this->get_option( 'test_private_key' ) : $this->get_option( 'private_key' );
            $this->publishable_key = $this->testmode ? $this->get_option( 'test_publishable_key' ) : $this->get_option( 'publishable_key' );
            
            $this->init_form_fields();
            $this->init_settings();
            
            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
            add_action('woocommerce_thank_you_' . $this->id, array( $this, 
            'thank_you_page'));
           
        
         }
      
          public function init_form_fields(){

            $this->form_fields = array(
                'enabled' => array(
                    'title'       => 'Enable/Disable',
                    'label'       => 'Enable alternative payment',
                    'type'        => 'checkbox',
                    'description' => '',
                    'default'     => 'no'
                ),
                'title' => array(
                    'title'       => 'Title',
                    'type'        => 'text',
                    'description' => 'This controls the title which the user sees during checkout.',
                    'default'     => 'Bottlecaps',
                    'desc_tip'    => true,
                ),
                'description' => array(
                    'title'       => 'Description',
                    'type'        => 'textarea',
                    'description' => 'This controls the description which the user sees during checkout.',
                    'default'     => 'Pay with bottlecaps, just as if you were living in the wasteland',
                ),
                'testmode' => array(
                    'title'       => 'Test mode',
                    'label'       => 'Enable Test Mode',
                    'type'        => 'checkbox',
                    'description' => 'Place the payment gateway in test mode using test API keys.',
                    'default'     => 'yes',
                    'desc_tip'    => true,
                ),
                'test_publishable_key' => array(
                    'title'       => 'Test Publishable Key',
                    'type'        => 'text'
                ),
                'test_private_key' => array(
                    'title'       => 'Test Private Key',
                    'type'        => 'password',
                ),
                'publishable_key' => array(
                    'title'       => 'Live Publishable Key',
                    'type'        => 'text'
                ),
                'private_key' => array(
                    'title'       => 'Live Private Key',
                    'type'        => 'password'
                )
            );
        }


	
    

    public function process_payment( $order_id ) {
        $order = wc_get_order( $order_id); 

        $order->update_status('on-hold', 'awaiting bootlecaps');

        $this->clear_payment_with_api(); 

        wc_reduce_stock_levels( $order_id );


        WC()->cart->empty_cart();
        return array(
            'result' => 'success',
            'redirect' => $this->get_return_url( $order)
        );

    }

    public function clear_payment_with_api() {

    }

    public function thank_you_page(){
        if($this->instructions){
            echo wpautop( $this->instructions); 

        }
    }

}}}
    add_filter('woocommerce_payment_gateways', 'add_alternative_payment_gateway' );

    function add_alternative_payment_gateway( $gateways ) {
        $gateways[] = 'WC_ALTERNATIVE_PAYMENT';
        return $gateways; 

    }


