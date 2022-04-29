<?php
namespace WOPB;

defined('ABSPATH') || exit;

class Condition {
    public function __construct() {
        add_filter('template_include', array($this, 'include_builder_files'), 999);
        add_action('admin_footer', array($this, 'builder_footer_callback'));
        add_action('admin_enqueue_scripts', array($this, 'load_media'));
        add_action('enqueue_block_editor_assets', array($this, 'register_scripts_back_callback'));
    }

    public function register_scripts_back_callback(){
        $builder = wopb_function()->is_archive_builder();
        if ($builder) {
            wp_enqueue_script( 'wopb-blocks-builder-script', WOPB_URL.'addons/builder/blocks.min.js', array('wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor'), WOPB_VER, true );
        }
    }

    // Load Media
    public function load_media() {
        if (!$this->is_builder()) {
            return;
        }
        wp_enqueue_script('builder-script', WOPB_URL.'addons/builder/builder.js', array('jquery'), WOPB_VER, true);
        wp_enqueue_style('builder-style', WOPB_URL.'addons/builder/builder.css', array(), WOPB_VER);

        wp_localize_script('builder-script', 'builder_option', array(
            'security' => wp_create_nonce('wopb-nonce'),
            'ajax' => admin_url('admin-ajax.php')
        ));
    }

    public function include_builder_files($template) {
        $includes = wopb_function()->conditions('includes');
        return $includes ? $includes : $template;
    }

    public function is_builder() {
        global $post;
        return isset($_GET['post_type']) ? ($_GET['post_type'] == 'wopb_builder') : (isset($post->post_type) ? ($post->post_type == 'wopb_builder') : false);
    }


    public function builder_footer_callback() {

        if ($this->is_builder()) { ?>
            <form class="wopb-builder" action="">
                <div class="wopb-builder-modal">
                    <div class="wopb-popup-wrap">
                        <input type="hidden" name="action" value="wopb_new_post">
                        <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('wopb-nonce'); ?>">
                        <div class="wopb-builder-wrapper">
                            <div class="wopb-builder-left">
                                <div class="wopb-builder-left-content">
                                    <div class="wopb-builder-left-title">
                                        <label><?php _e('Name of Your Template', 'product-blocks'); ?></label>
                                        <div>
                                            <input type="text" name="post_title" class="wopb-title" placeholder="<?php _e('Template Name', 'product-blocks'); ?>" />
                                        </div>
                                    </div>
                                    <div class="wopb-builder-left-title">
                                        <label><?php _e('Select Template Type', 'product-blocks'); ?></label>
                                        <div>
                                            <select name="post_filter">
                                                <option value=""><?php _e('--Select--', 'product-blocks'); ?></option>    
                                                <option value="single-product"><?php _e('Single Product', 'product-blocks'); ?></option>    
                                                <option value="archive"><?php _e('Product Archive', 'product-blocks'); ?></option>
                                                <option value="shop"><?php _e('Shop', 'product-blocks'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="wopb-message"></div>
                                    <div class="wopb-builder-button">
                                    <button class="wopb-new-template"><?php echo __('Create Template', 'product-blocks'); ?></button>
                                    <a class="wopb-edit-template" href="<?php echo get_edit_post_link(get_the_ID()); ?>"><?php echo __('Save & Edit Template', 'product-blocks'); ?></a>
                                    </div>
                                </div>
                            </div>

                            <div class="wopb-builder-right">
                                <div class="wopb-builder-archive-wrap">
                                    <div class="wopb-builder-right-title">
                                        <label>
                                            <?php _e('Where You Want to Display Your Template', 'product-blocks'); ?>
                                        </label>
                                        <span>
                                            <input type="checkbox" id="archive" name="archive" value="archive" class="wopb-single-select"/>
                                            <label for="archive"><?php _e('All Shop Archive Pages', 'product-blocks'); ?></label>
                                        </span>
                                        <span>
                                            <input type="checkbox" id="search" name="search" value="search" class="wopb-single-select"/>
                                            <label for="search"><?php _e('Shop Search Result', 'product-blocks'); ?></label>
                                        </span>
                                        <?php
                                        $taxonomy_list = wopb_function()->get_taxonomy_list();
                                        foreach ($taxonomy_list as $key => $val) { ?>
                                            <span>
                                                <input type="checkbox" name="<?php echo $val; ?>" id="id-<?php echo $key; ?>" value="<?php echo $val; ?>" class="wopb-single-select"/>
                                                <label for="id-<?php echo $key; ?>"><?php printf( __('All %s Pages', 'product-blocks'),  $val); ?></label>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    foreach ($taxonomy_list as $val) { ?>
                                    <div class="wopb-multi-select">
                                        <span class="wopb-multi-select-action"><?php printf( __('Specific %s', 'product-blocks'),  $val); ?></span>
                                        <select class="multi-select-data select-<?php echo $val; ?> wopb-multi-select-hide" name="<?php echo $val; ?>_id[]" multiple="multiple" data-type="<?php echo $val; ?>"></select>
                                        <div class="wopb-option-multiselect">
                                            <div class="multi-select-action"><ul></ul></div>
                                            <div class="wopb-search-dropdown">
                                                <input type="text" value="" placeholder="Search..." class="wopb-item-search"/>
                                                <div class="wopb-search-results"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="wopb-builder-single-wrap">
                                    <div class="wopb-builder-right-title">
                                        <label>
                                            <?php _e('Where You Want to Display Your Template', 'product-blocks'); ?>
                                        </label>
                                        <span>
                                            <input type="checkbox" id="allsingle" name="allsingle" value="allsingle" class="wopb-single-select"/>
                                            <label for="allsingle"><?php _e('All Product Single Pages', 'product-blocks'); ?></label>
                                        </span>
                                        <div class="wopb-multi-select">
                                            <span class="wopb-multi-select-action"><?php _e('Specific Product', 'product-blocks'); ?></span>
                                            <select class="multi-select-data select-single-product wopb-multi-select-hide" name="single_product_id[]" multiple="multiple" data-type="single_product"></select>
                                            <div class="wopb-option-multiselect">
                                                <div class="multi-select-action"><ul></ul></div>
                                                <div class="wopb-search-dropdown">
                                                    <input type="text" value="" placeholder="Search..." class="wopb-item-search"/>
                                                    <div class="wopb-search-results"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php foreach ($taxonomy_list as $val) { ?>
                                        <div class="wopb-multi-select">
                                            <span class="wopb-multi-select-action"><?php printf( __('Specific %s', 'product-blocks'),  $val); ?></span>
                                            <select class="multi-select-data select-single-<?php echo $val; ?> wopb-multi-select-hide" name="single_<?php echo $val; ?>_id[]" multiple="multiple" data-type="<?php echo $val; ?>"></select>
                                            <div class="wopb-option-multiselect">
                                                <div class="multi-select-action"><ul></ul></div>
                                                <div class="wopb-search-dropdown">
                                                    <input type="text" value="" placeholder="Search..." class="wopb-item-search"/>
                                                    <div class="wopb-search-results"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="wopb-builder-close"><span class="dashicons dashicons-no-alt"></span></div>
                    </div>
                </div>
            </form>
        </div>
        <?php    
        }
    }


}
