<?php
namespace WOPB\blocks;

defined('ABSPATH') || exit;

class Product_Cart{

    public function __construct() {
        add_action('init', array($this, 'register'));
    }

    public function get_attributes($default = false){

        $attributes = array(
            'blockId' => [
                'type' => 'string',
                'default' => '',
            ],

            'preview' => [
                'type' => 'string',
                'default' => 'simple',
            ],
            //--------------------------
            //  Add To Cart Style
            //--------------------------
            'showQuantity'=>[
                'type' => 'boolean',
                'default'=> true,
            ],
            'showCampare'=>[
                'type' => 'boolean',
                'default'=> false,
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart .wopb-compare-btn {display:none;}'
                    ],
                ],
            ],
            'showWishlist'=>[
                'type' => 'boolean',
                'default'=> false,
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart .wopb-wishlist-add {display:none;}'
                    ],
                ],
            ],
            'addtocartAlignment' => [
                'type' => 'object',
                'default' => (object)['lg'=>'left'],
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart .cart {justify-content:{{addtocartAlignment}};} {{WOPB}} .wopb-builder-cart {text-align: {{addtocartAlignment}};}'
                    ],
                ],
            ],
            'quantityPosition' => [
                'type' => 'string',
                'default' => 'right',
                'style' =>[
                    (object)[
                        'depends' => [
                            (object)['key'=>'quantityPosition','condition'=>'==','value'=>'right'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-builder-cart-icon-left {display:flex; flex-direction:row-reverse;}'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'quantityPosition','condition'=>'==','value'=>'left'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-builder-cart-icon-left {display:flex;flex-direction:column;}'
                    ],
                    (object)[
                        'depends' => [
                            (object)['key'=>'quantityPosition','condition'=>'==','value'=>'both'],
                        ],
                        'selector'=>'{{WOPB}} .wopb-builder-cart-icon-left{display:block;}'
                    ],
                ],
            ],
            'cartText' => [
                'type' => 'string',
                'default' => 'Add to Cart',
            ],
            //--------------------------
            //  Quantity Style
            //--------------------------
            'quantityColor' => [
                'type' => 'string',
                'default' => '',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}}  input {color:{{quantityColor}};}'
                    ],
                ],
            ],
            'quantityBg' => [
                'type' => 'string',
                'default' => '#f5f5f5',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .quantity > input {background-color:{{quantityBg}};}'
                    ],
                ],
            ],
            'quantityBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#f5f5f5','type' => 'solid'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .quantity > input'
                    ],
                ],
            ],
            'quantityRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'0', 'unit' =>'px'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .quantity > input {border-radius:{{quantityRadius}};}'
                    ],
                ],
            ],
            'quantityPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => "16",'bottom' => "10",'left' => "17",'right' => "12", 'unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .quantity > input {padding:{{quantityPadding}}; }'
                    ],
                ],
            ],


            //--------------------------
            // Plus Minus Style
            //--------------------------
            'plusMinusColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart-plus > svg , .wopb-builder-cart-minus > svg {fill:{{plusMinusColor}};}'
                    ],
                ],
            ],
            'plusMinusBg' => [
                'type' => 'string',
                'default' => '#000',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart .quantity  .wopb-builder-cart-plus  , .wopb-builder-cart .quantity  .wopb-builder-cart-minus  {background:{{plusMinusBg}};}'
                    ],
                ],
            ],
            'plusMinusHoverColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart-plus:hover , .wopb-builder-cart-minus:hover {fill:{{plusMinusHoverColor}};}'
                    ],
                ],
            ],
            'plusMinusHoverBg' => [
                'type' => 'string',
                'default' => '#222',
                'style' =>[
                    (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart .quantity  .wopb-builder-cart-plus:hover  , .wopb-builder-cart .quantity  .wopb-builder-cart-minus:hover {background:{{plusMinusHoverBg}};}'
                    ],
                ],
            ],
            'plusMinusSize' => [
                'type' => 'string',
                'default' =>'10',
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart .quantity  .wopb-builder-cart-plus > svg , .wopb-builder-cart .quantity  .wopb-builder-cart-minus > svg{width:{{plusMinusSize}}px; }'
                    ],
                ],
            ],
            'plusMinusBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart-plus  , .wopb-builder-cart-minus'
                    ],
                ],
            ],
            'plusMinusRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'0', 'unit' =>'px'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart-plus  , .wopb-builder-cart-minus {border-radius:{{plusMinusRadius}}; }'
                    ],
                ],
            ],
            'plusMinusPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => "5",'bottom' => "5",'left' => "10",'right' => "10", 'unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .wopb-builder-cart .quantity  .wopb-builder-cart-plus  , .wopb-builder-cart .quantity  .wopb-builder-cart-minus{padding:{{plusMinusPadding}};}'
                    ],
                ],
            ],
            
            //--------------------------
            //  Button
            //--------------------------
            'btnTypo' => [
                'type' => 'object',
                'default' => (object)['openTypography' => 1, 'size' => (object)['lg' =>15, 'unit' =>'px'], 'height' => (object)['lg' =>20, 'unit' =>'px'], 'spacing' => (object)['lg' =>0, 'unit' =>'px'], 'transform' => '', 'weight' => '', 'decoration' => 'none','family'=>'' ],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button'
                    ],
                ],
            ],
            'btnColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button , .single.single-product {{WOPB}} .single_add_to_cart_button {color:{{btnColor}};}'
                    ],
                ],
            ],
            'btnBgColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => '#000000'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button , .site .single_add_to_cart_button ,
                        .site .single_add_to_cart_button:not(:hover):not(:active):not(.has-background), .single_add_to_cart_button:not(:hover):not(:active):not(.has-background)'
                    ],
                ],
            ],
            'btnBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button'
                    ],
                ],
            ],
            'btnRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button{border-radius:{{btnRadius}}; }'
                    ],
                ],
            ],
            'btnShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' =>1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button'
                    ],
                ],
            ],
            'btnHoverColor' => [
                'type' => 'string',
                'default' => '#fff',
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button:hover {color:{{btnHoverColor}}; }'
                    ],
                ],
            ],
            'btnBgHoverColor' => [
                'type' => 'object',
                'default' => (object)['openColor' => 1,'type' => 'color', 'color' => '#111'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button:hover'
                    ],
                ],
            ],
            'btnHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)[ 'top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid' ],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button:hover'
                    ],
                ],
            ],
            'btnHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button:hover {border-radius:{{btnHoverRadius}}; }'
                    ],
                ],
            ],
            'btnHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button:hover'
                    ],
                ],
            ],
            'btnSacing' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => 0,'bottom' => 0,'left' => 0,'right' => 20, 'unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button {margin:{{btnSacing}};}'
                    ],
                ],
            ],
            'btnPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => "15",'bottom' => "15",'left' => "18",'right' => "18", 'unit' =>'px']],
                'style' => [
                    (object)[
                        'selector'=>'{{WOPB}} .single_add_to_cart_button {padding:{{btnPadding}};}'
                    ],
                ],
            ],


            //--------------------------
            //  Wrapper
            //--------------------------
            'wrapBg' => [
                'type' => 'string',
                'default' => (object)['openColor' => 0, 'type' => 'color', 'color' => '#f5f5f5'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper{background-color:red;}'
                    ],
                ],
            ],
            'wrapBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' =>(object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper'
                    ],
                ],
            ],
            'wrapShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper'
                    ],
                ],
            ],
            'wrapRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper { border-radius:{{wrapRadius}}; }'
                    ],
                ],
            ],
            'wrapHoverBackground' => [
                'type' => 'object',
                'default' => (object)['openColor' => 0, 'type' => 'color', 'color' => '#ff5845'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper:hover'
                    ],
                ],
            ],
            'wrapHoverBorder' => [
                'type' => 'object',
                'default' => (object)['openBorder'=>0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4','type' => 'solid'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper:hover'
                    ],
                ],
            ],
            'wrapHoverRadius' => [
                'type' => 'object',
                'default' => (object)['lg' =>'', 'unit' =>'px'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper:hover { border-radius:{{wrapHoverRadius}}; }'
                    ],
                ],
            ],
            'wrapHoverShadow' => [
                'type' => 'object',
                'default' => (object)['openShadow' => 0, 'width' => (object)['top' => 1, 'right' => 1, 'bottom' => 1, 'left' => 1],'color' => '#009fd4'],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper:hover'
                    ],
                ],
            ],
            'wrapMargin' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '', 'unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper { margin:{{wrapMargin}}; }'
                    ],
                ],
            ],
            'wrapOuterPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['top' => '','bottom' => '','left' => '', 'right' => '', 'unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper { padding:{{wrapOuterPadding}}; }'
                    ],
                ],
            ],
            'wrapInnerPadding' => [
                'type' => 'object',
                'default' => (object)['lg' =>(object)['unit' =>'px']],
                'style' => [
                     (object)[
                        'selector'=>'{{WOPB}} .wopb-product-wrapper { padding:{{wrapInnerPadding}}; }'
                    ],
                ],
            ],
            
            'advanceId' => [
                'type' => 'string',
                'default' => '',
            ],
            'advanceZindex' => [
                'type' => 'string',
                'default' => '',
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {z-index:{{advanceZindex}};}'
                    ],
                ],
            ],
            'hideExtraLarge' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {display:none;}'
                    ],
                ],
            ],
            'hideDesktop' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {display:none;}'
                    ],
                ],
            ],
            'hideTablet' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {display:none;}'
                    ],
                ],
            ],
            'hideMobile' => [
                'type' => 'boolean',
                'default' => false,
                'style' => [
                    (object)[
                        'selector' => '{{WOPB}} {display:none;}'
                    ],
                ],
            ],
            'advanceCss' => [
                'type' => 'string',
                'default' => '',
                'style' => [(object)['selector' => '']],
            ]
        );
        
        if( $default ){
            $temp = array();
            foreach ($attributes as $key => $value) {
                if( isset($value['default']) ){
                    $temp[$key] = $value['default'];
                }
            }
            return $temp;
        }else{
            return $attributes;
        }
    }

    public function register() {
        register_block_type( 'product-blocks/product-cart',
            array(
                'title' => __('Add To Cart', 'product-blocks'),
                'attributes' => $this->get_attributes(),
                'render_callback' =>  array($this, 'content')
            ));
    }

    public function content($attr) {
        global $product;
        $block_name = 'product-cart';
        $wraper_before = $wraper_after = $content = '';

        $product = wc_get_product();

        if (!empty($product)) {
            global $productx_cart;
            $productx_cart = $attr['cartText'];
            
            if (wopb_function()->isPro()) {
                $methods = get_class_methods(wopb_pro_function());
                if (in_array('is_simple_preorder', $methods)) {
                    if (wopb_pro_function()->is_simple_preorder()) {
                        $productx_cart = wopb_function()->get_setting('preorder_add_to_cart_button_text');
                    }
                }
                if (in_array('is_simple_backorder', $methods)) {
                    if (wopb_pro_function()->is_simple_backorder()) {
                        $productx_cart = wopb_function()->get_setting('backorder_add_to_cart_button_text');
                    }
                }
            }

            $cart_text = function() {
                global $productx_cart;
                return $productx_cart;
            };
            $wraper_before .= '<div '.($attr['advanceId']?'id="'.$attr['advanceId'].'" ':'').' class="wp-block-product-blocks-'.$block_name.' wopb-block-'.$attr["blockId"].' '.(isset($attr["className"])?$attr["className"]:'').'">';

            add_filter( 'woocommerce_product_single_add_to_cart_text', $cart_text );

            ob_start();
            echo '<div class="wopb-product-wrapper wopb-builder-cart" data-type="'.$attr['quantityPosition'].'">';
            woocommerce_template_single_add_to_cart();
            echo '</div>';
            $form = ob_get_clean();
		    $content .= str_replace( 'single_add_to_cart_button', 'single_add_to_cart_button wopb-cart-button', $form );

            remove_filter( 'woocommerce_product_single_add_to_cart_text', $cart_text );

            $wraper_after .= '</div>';
        }

        return $wraper_before.$content.$wraper_after;
    }
}