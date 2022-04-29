<?php
namespace WOPB;

defined('ABSPATH') || exit;

class Builder {
    public function __construct(){
        $this->builder_post_type_callback();
        add_filter('manage_wopb_builder_posts_columns', array($this, 'builder_table_head'));
        add_action('manage_wopb_builder_posts_custom_column', array($this, 'builder_table_content'), 10, 2);
        add_action('restrict_manage_posts', array($this, 'filter_restrict_builder_callback'));
        add_filter('parse_query', array($this, 'builder_filter_callback'));
        add_filter('post_row_actions', array($this, 'edit_condition_link_callback'), 10, 2);
        add_action('add_meta_boxes', array($this, 'init_metabox_callback'));
        add_action('save_post', array($this, 'metabox_save_data'));
        add_action('admin_head', array($this, 'custom_head_templates'));
        add_action('load-post-new.php', array($this, 'disable_new_post_templates'));
    }

    public function custom_head_templates() {
        if( 'wopb_builder' == get_current_screen()->post_type && (!defined('WOPB_PRO_VER')) ) {
            $post_count = wp_count_posts('wopb_builder');
            $post_count = $post_count->publish + $post_count->draft;
            if( $post_count > 0 ) { ?>
                <span class="wopb-pro-needed" style="display: none;"></span>
                <div class="wopb-pro-notice wopb-modal">
                    <div class="wopb-popup-wrap wopb-modal-wrap">
                        <div class="wopb-modal-header">
                            <h2><?php esc_html_e('Upgrade to Get All Feature!', 'product-blocks'); ?></h2>
                            <div class="wopb-pro-notice-close"><span class="dashicons dashicons-no-alt"></span></div>
                        </div>

                        <div class="wopb-modal-body">
                            <div class="wopb-list-notice">
                                <ul>
                                    <li><?php esc_html_e('Unlimited Product Single Page Builder', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Unlimited Product Archive Page Builder', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Shop Page Builder', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Pro Sections, Layout & Design', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Quickview Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Save Template Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Whishlist Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Compare Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Flip Image Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Fast & Priority Support', 'product-blocks'); ?></li>
                                </ul>    
                            </div>
                        </div>

                        <div class="wopb-modal-footer">
                            <?php echo '<a class="wopb-btn-upgrade-pro wopb-btn" target="_blank" href="'.wopb_function()->get_premium_link().'">Upgrade Pro</a>'; ?>
                        </div>

                        
                    </div>
                </div>
            <?php }
        }
    }

    public function disable_new_post_templates() {
        if ( get_current_screen()->post_type == 'wopb_builder' && (!defined('WOPB_PRO_VER')) ){
            $post_count = wp_count_posts('wopb_builder');
            $post_count = $post_count->publish + $post_count->draft;
            if ($post_count > 0) {
                wp_die( 'You are not allowed to do that! Please <a target="_blank" href="'.wopb_function()->get_premium_link().'">Upgrade Pro.</a>' );
            }
        }
    }


    function init_metabox_callback() {
        add_meta_box('container-width-id', __('ProductX Builder', 'product-blocks'), array($this, 'container_width_callback'), 'wopb_builder', 'side');
    }
    
    function container_width_callback($post) {
        wp_nonce_field('container_meta_box', 'container_meta_box_nonce');
        $width = get_post_meta($post->ID, '__wopb_container_width', true); ?>
        <p>
            <label style="margin-bottom:5px;display:block;"><?php _e('Builder Page Container Width', 'product-blocks'); ?></label>
            <input type="number" name="container-width" value="<?php echo ($width ? $width : 1140); ?>"/>
        </p>
    <?php }
    
    function metabox_save_data($post_id) {
        if ( ! isset( $_POST['container_meta_box_nonce'] ) ) {
            return;
        }
        
        if ( ! wp_verify_nonce( $_POST['container_meta_box_nonce'], 'container_meta_box' ) ) {
            return;
        }
        
        if ( ! isset( $_POST['container-width'] ) ) {
            return;
        }
        
        $width = sanitize_text_field($_POST['container-width']);
        $sidebar = sanitize_text_field($_POST['builder-sidebar']);
    
        update_post_meta($post_id, '__wopb_container_width', $width);
    }

    function edit_condition_link_callback($actions, $post) {
        if ($post->post_type == 'wopb_builder') {
            if (isset($actions['edit'])) {
                $actions['edit'] = str_replace( strip_tags($actions['edit']), __('Edit with Gutenberg', 'product-blocks'), $actions['edit'] );
            }
            $new_element = array( 'condition' => '<a href="'.get_edit_post_link($post->ID).'" class="wopb-builder-conditions">'.__('Edit Condition' , 'product-blocks').'</a>' );
            array_splice($actions, 1, 0,$new_element);
        }
        return $actions;
    }

    // Restrict Content Callback
    public function filter_restrict_builder_callback() {
        $type = isset($_GET['post_type']) ? $_GET['post_type'] : 'post';
        if ('wopb_builder' == $type){
            $values = array(
                'All' => 'all', 
                'Archive' => 'archive',
            );
            ?>
            <select name="builder_type">
            <?php
                $current_v = isset($_GET['builder_type'])? $_GET['builder_type'] : 'all';
                foreach ($values as $label => $value) {
                    printf(
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v? ' selected="selected"':'',
                        $label
                    );
                }
            ?>
            </select>
            <?php
        }
    }
    

    // Builder Filter Add
    public function builder_filter_callback( $query ) {
        global $pagenow;
        $type = 'post';
        if (isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
        }
        if ( 'wopb_builder' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['builder_type']) && $_GET['builder_type'] != '' && $_GET['builder_type'] != 'all') {
            $query->query_vars['meta_value'] = $_GET['builder_type'];
        }
    }

    
    // Builder Heading Add
    public function builder_table_head( $defaults ) {
        $type_array = array('type' => __('Builder Type', 'product-blocks'));
        array_splice( $defaults, 2, 0, $type_array ); 
        return $defaults;
    }


    // Column Content
    public function builder_table_content( $column_name, $post_id ) {
        if ($column_name == 'type') {
            echo ucfirst(get_post_meta( $post_id, '_wopb_builder_type', true ));
        }
    }

    // Builder Post Type Register
    public function builder_post_type_callback() {
        $labels = array(
            'name'                => _x( 'Builder', 'Builder', 'product-blocks' ),
            'singular_name'       => _x( 'Builder', 'Builder', 'product-blocks' ),
            'menu_name'           => __( 'Builder', 'product-blocks' ),
            'parent_item_colon'   => __( 'Parent Builder', 'product-blocks' ),
            'all_items'           => __( 'Builder', 'product-blocks' ),
            'view_item'           => __( 'View Builder', 'product-blocks' ),
            'add_new_item'        => __( 'Add New', 'product-blocks' ),
            'add_new'             => __( 'Add New', 'product-blocks' ),
            'edit_item'           => __( 'Edit Builder', 'product-blocks' ),
            'update_item'         => __( 'Update Builder', 'product-blocks' ),
            'search_items'        => __( 'Search Builder', 'product-blocks' ),
            'not_found'           => __( 'No Builder Found', 'product-blocks' ),
            'not_found_in_trash'  => __( 'Not Builder found in Trash', 'product-blocks' ),
        );
        $args = array(
            'labels'              => $labels,
            'show_in_rest'        => true,
            'supports'            => array( 'title', 'editor' ),
            'hierarchical'        => false,
            'public'              => false,
            'rewrite'             => false,
            'show_ui'             => true,
            'show_in_menu'        => 'wopb-settings',
            'show_in_nav_menus'   => false,
            'exclude_from_search' => true,
            'capability_type'     => 'page',
        );
       register_post_type( 'wopb_builder', $args );
    }
}