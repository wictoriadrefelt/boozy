<?php
/**
 * Compare Addons Core.
 * 
 * @package WOPB\Compare
 * @since v.1.1.0
 */

namespace WOPB;

defined('ABSPATH') || exit;

/**
 * Compare class.
 */
class Compare {

    /**
	 * Setup class.
	 *
	 * @since v.1.1.0
	 */
    public function __construct(){
        add_action('wp_ajax_wopb_compare', array($this, 'wopb_compare_callback'));
        add_action('wp_ajax_nopriv_wopb_compare', array($this, 'wopb_compare_callback'));

        add_shortcode('wopb_compare', array($this, 'compare_shortcode_callback'));

        add_filter('wopb_settings', array($this, 'get_option_settings'), 10, 1);
        add_action('wp_enqueue_scripts', array($this, 'add_compare_scripts'));

        if (wopb_function()->get_setting('compare_single_enable') == 'yes') {
            if (wopb_function()->get_setting('compare_position') == 'before_cart') {
                add_action('woocommerce_before_add_to_cart_button', array($this, 'add_compare_html'));
            } else {
                add_action('woocommerce_after_add_to_cart_button', array($this, 'add_compare_html'));
            }
        }
    }


    /**
	 * Compare Shortcode, Where Compare Shown
     * 
     * @since v.1.1.0
	 * @return STRING | HTML of the shortcode
	 */
    public function compare_shortcode_callback($ids = array()) {
        $html = '';
        $compare_data = empty($ids) ? wopb_function()->get_compare_id() : $ids;
    
        if (count($compare_data) > 0) {
            $_product = $_price = $_availability = $_add_to_cart = $_sku = $_action = '';
            $html .= '<div class="wopb-modal-content wopb-compare-modal-content'.(empty($post_id) ? ' wopb-compare-shortcode' : '').'">';
                $html .= '<div class="wopb-compare-modal">';
                    foreach ($compare_data as $key => $val) {
                        $product = wc_get_product($val);
                        if ($product) {
                            $_product .= '<td class="col'.$key.'">';
                                $_product .= '<a class="wopb-compare-thumbnail" href="'.$product->get_permalink().'">';
                                    $_product .= $product->get_image('woocommerce_thumbnail');
                                    $_product .= $product->get_title();
                                    $_product .= wc_get_rating_html( $product->get_average_rating() );
                                $_product .= '</a>';
                            $_product .= '</td>';
                            $_price .= '<td class="col'.$key.'">'.$product->get_price_html().'</td>';
                            $_short_description .= '<td class="col'.$key.'">'.$product->get_short_description().'</td>';

                            ob_start();
                            wc_display_product_attributes( $product );
                            $additional = ob_get_clean();

                            $_additional .= '<td class="col'.$key.'">'.$additional.'</td>';

                            $weight = $product->get_weight();
							$weight = $weight ? ( wc_format_localized_decimal( $weight ) . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) ) ) : '-';
                            $_weight .= '<td class="col'.$key.'">'.sprintf( '<span>%s</span>', esc_html( $weight ) ).'</td>';

                            // $_description .= '<td class="col'.$key.'">'.$product->get_description().'</td>';
                            $_availability .= '<td class="col'.$key.'">'.( ($product->is_purchasable() && $product->is_in_stock()) ? $product->get_stock_quantity().' '.__('in stock', 'product-blocks') : '' ).'</td>';
                            $_add_to_cart .= '<td class="col'.$key.'">'.do_shortcode('[add_to_cart style="" id="'.$product->get_id().'" show_price="false"]').'</td>';
                            $_sku .= '<td class="col'.$key.'">'.$product->get_sku().'</td>';
                            $_dimensions .= '<td class="col'.$key.'">'.$product->get_dimensions().'</td>';
                            $_action .= '<td class="col'.$key.'"><a class="wopb-compare-remove" data-class="col'.$key.'" href="#" data-action="remove" data-postid="'.$product->get_id().'">'.__('Remove', 'product-blocks').' <span>x</span></a></td>';
                        }
                    }
                    $html .= '<div class="wopb-table-responsive">';
                        $html .= '<table>';
                            $html .= '<thead style="position:sticky;top:0;">
                                <tr>
                                    <th>'.__('Action', 'product-blocks').'</th>';
                                    $html .= $_action;
                                    $html .= '<th class="wopb-modal-close"></th>';
                                '</tr>
                            </thead>';
                            $html .= '<tbody>';
                                $html .= '<tr><th>'.__('Product', 'product-blocks').'</th>'.$_product.'</tr>';
                                $html .= '<tr><th>'.__('Price', 'product-blocks').'</th>'.$_price.'</tr>';
                                $html .= '<tr><th>'.__('Short Description', 'product-blocks').'</th>'.$_short_description.'</tr>';
                                // $html .= '<tr><th>'.__('Description', 'product-blocks').'</th>'.$_description.'</tr>';
                                $html .= '<tr><th>'.__('Availability', 'product-blocks').'</th>'.$_availability.'</tr>';
                                $html .= '<tr><th>'.__('Add to Cart', 'product-blocks').'</th>'.$_add_to_cart.'</tr>';
                                $html .= '<tr><th>'.__('SKU', 'product-blocks').'</th>'.$_sku.'</tr>';
                                $html .= '<tr><th>'.__('Dimensions', 'product-blocks').'</th>'.$_dimensions.'</tr>';
                                $html .= '<tr><th>'.__('Weight', 'product-blocks').'</th>'.$_weight.'</tr>';
                                $html .= '<tr><th>'.__('Additional', 'product-blocks').'</th>'.$_additional.'</tr>';
                                // $html .= '<tr><th>'.__('Action', 'product-blocks').'</th>'.$_action.'</tr>';
                            $html .= '</tbody>';
                        $html .= '</table>';
                    $html .= '</table>';
                $html .= '</div>';
                // $html .= '<div class="wopb-modal-close"></div>';
            $html .= '</div>';
        }
        return $html;
    }


    /**
	 * Compare HTML for Cart Button
     * 
     * @since v.1.1.0
	 * @return NULL
	 */
    public function add_compare_html() {
        $btn_text = wopb_function()->get_setting('compare_text');
        $compare_page = wopb_function()->get_setting('compare_page');
        $action_added = wopb_function()->get_setting('compare_action_added');
        $after_text = wopb_function()->get_setting('compare_added_text');
        $compare_data = wopb_function()->get_compare_id();
        $compare_active = in_array(get_the_ID(), $compare_data);

        echo '<a class="wopb-compare-btn'.($compare_active ? ' wopb-compare-active' : '').'" data-action="add" '.($compare_page && $action_added == 'redirect' ? 'data-redirect="'.get_permalink($compare_page).'"' : '').' data-postid="'.get_the_ID().'">';
            echo '<span><strong>⇄</strong> ';
                echo ($btn_text ? $btn_text : __('Compare', 'product-blocks'));
            echo '</span>';
            echo '<span><strong>⇄</strong> ';
                echo ($after_text ? $after_text : __('Added', 'product-blocks'));
            echo '</span>';
        echo '</a>';
    }

    /**
	 * Quickview JS Script Add
     * 
     * @since v.1.1.0
	 * @return NULL
	 */
    public function add_compare_scripts() {
        wp_enqueue_style('wopb-compare-style', WOPB_URL.'addons/compare/css/compare.css', array(), WOPB_VER);
        wp_enqueue_script('wopb-compare', WOPB_URL.'addons/compare/js/compare.js', array('jquery'), WOPB_VER, true);
        wp_localize_script('wopb-compare', 'wopb_data', array(
            'ajax' => admin_url('admin-ajax.php'),
            'security' => wp_create_nonce('wopb-nonce')
        ));
    }

    
    /**
	 * Quickview Action Button Shortcode
     * 
     * @since v.1.1.0
	 * @return STRING | HTML of the shortcode
	 */
    public function add_quickview_html() {
        $btn_text = wopb_function()->get_setting('quickview_text');

        $html = '<span>';
            $html .= '<a class="wopb-compare-action" data-postid="'.get_the_ID().'" href="#">'.( $btn_text ? $btn_text : __('Quick View', 'product-blocks') ).'</a>';
        $html .= '</span>';

        echo $html;
    }


    /**
	 * Compare Addons Intitial Setup Action
     * 
     * @since v.1.1.0
	 * @return NULL
	 */
    public function initial_setup(){
        
        // Set Default Value
        $initial_data = array(
            'compare_heading'       => 'yes',
            'compare_page'          => '',
            'compare_text'          => __('Compare', 'product-blocks'),
            'compare_added_text'    => __('Added', 'product-blocks'),
            'compare_single_enable' => 'yes',
            'compare_position'      => 'after_cart',
            'compare_action_added'  => 'popup',
            'wopb_compare'          => 'true',
        );
        foreach ($initial_data as $key => $val) {
            wopb_function()->set_setting($key, $val);
        }

        // Insert Compare Page
        $compare_arr  = array( 
            'post_title'     => 'Compare',
            'post_type'      => 'page',
            'post_content'   => '<!-- wp:shortcode -->[wopb_compare]<!-- /wp:shortcode -->',
            'post_status'    => 'publish',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_author'    => get_current_user_id(),
            'menu_order'     => 0,
        );
        $compare_id = wp_insert_post( $compare_arr, FALSE );
        if ($compare_id) {
            wopb_function()->set_setting('compare_page', $compare_id);
        }
    }
    

    /**
	 * Compare Addons Default Settings Param
     * 
     * @since v.1.1.0
     * @param ARRAY | Default Filter Congiguration
	 * @return ARRAY
	 */
    public static function get_option_settings($config){

        $arr = array(
            'compare' => array(
                'label' => __('Compare', 'product-blocks'),
                'attr' => array(
                    'compare_heading' => array(
                        'type'  => 'heading',
                        'label' => __('Compare Settings', 'product-blocks'),
                    ),
                    'compare_page' => array(
                        'type' => 'select',
                        'label' => __('Compare Page', 'product-blocks'),
                        'options' => wopb_function()->all_pages(true),
                        'desc' => '<code>[wopb_compare]</code> '.__('Use shortcode inside compare page.', 'product-blocks')
                    ),
                    'compare_text' => array(
                        'type' => 'text',
                        'label' => __('Button Text', 'product-blocks'),
                        'default' => __('Compare', 'product-blocks')
                    ),
                    'compare_added_text' => array(
                        'type' => 'text',
                        'label' => __('Browse Text', 'product-blocks'),
                        'default' => __('Added', 'product-blocks'),
                        'desc' => __('Lorem ipsum dolor sit amet.', 'product-blocks')
                    ),
                    'compare_single_enable' => array(
                        'type' => 'switch',
                        'label' => __('Enable / Disable', 'product-blocks'),
                        'default' => 'yes',
                        'desc' => __('Enable Compare in Single Page.', 'product-blocks')
                    ),
                    'compare_position' => array(
                        'type' => 'radio',
                        'label' => __('Position on Single Page', 'product-blocks'),
                        'options' => array(
                            'before_cart' => __( 'Before Cart','product-blocks' ),
                            'after_cart' => __( 'After Cart','product-blocks' ),
                        ),
                        'default' => 'after_cart'
                    ),
                    'compare_action_added' => array(
                        'type' => 'radio',
                        'label' => __('Action after Added', 'product-blocks'),
                        'options' => array(
                            'popup' => __( 'Popup','product-blocks' ),
                            'redirect' => __( 'Redirect to Page','product-blocks' ),
                        ),
                        'default' => 'popup'
                    ),
                    'wopb_compare' => array(
                        'type' => 'hidden',
                        'value' => 'true'
                    )
                )
            )
        );
        
        return array_merge($config, $arr);
    }


    /**
	 * Compare Add Action Callback.
     * 
     * @since v.1.1.0
	 * @return ARRAY | With Custom Message
	 */
    public function wopb_compare_callback() {
        if (!wp_verify_nonce($_REQUEST['wpnonce'], 'wopb-nonce')) {
            return ;
        }

        global $post;
        $postId = sanitize_text_field($_POST['postid']);
        $type = sanitize_text_field($_POST['type']);

        if ( $postId && $type ) {
            $message = '';
            $data_id = isset($_COOKIE['wopb_compare']) ? $_COOKIE['wopb_compare'] : '';
            $data_id = $data_id ? maybe_unserialize(stripslashes_deep($data_id)) : array();
            if ($type == 'add') {
                if (!in_array($postId, $data_id)) {
                    $data_id[] = $postId;
                    $message = __('Compare Added.', 'product-blocks');
                }
            } else {
                if (false !== $key = array_search($postId, $data_id)) {
                    unset($data_id[$key]);
                    $message = __('Compare Removed.', 'product-blocks');
                }
            }
            setcookie('wopb_compare', maybe_serialize($data_id), time()+604800, '/'); // 7 Days
            
            
            $html = (wopb_function()->get_setting('compare_action_added') != 'redirect') ? $this->compare_shortcode_callback($data_id) : '';
            
            return wp_send_json_success( array('html' => $html, 'message' => $message) );
        } else {
            return wp_send_json_error( __('Compare Not Added.', 'product-blocks') );
        }
        die();
    }
}