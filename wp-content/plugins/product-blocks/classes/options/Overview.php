<?php
namespace WOPB;

defined('ABSPATH') || exit;

class Options_Overview{
    public function __construct() {
        add_submenu_page('wopb-settings', 'Overview', 'Overview', 'manage_options', 'wopb-settings', array( self::class, 'create_admin_page'), 0);
    }
    /**
     * Settings page output
     */
    public static function create_admin_page() { ?>
        <style>
            .style-css{
                background-color: #f2f2f2;
                -webkit-font-smoothing: subpixel-antialiased;
            }
        </style>

        <div class="wopb-option-body">
            
            <?php require_once WOPB_PATH . 'classes/options/Heading.php'; ?>
            
            <div class="wopb-tab-wrap">
                <div class="wopb-content-wrap">
                    <div class="wopb-overview-wrap">
                        <div class="wopb-tab-content-wrap">
                            <div class="wopb-overview wopb-admin-card">
                                <iframe width="650" height="350" src="https://www.youtube.com/embed/bR2RPDtrFq4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <div class="wopb-overview-btn">
                                        <a href="https://wopb.wpxpo.com/" target="_blank" class="wopb-btn wopb-btn-primary"><?php esc_html_e('Live Demo', 'product-blocks'); ?></a>
                                        <a class="wopb-btn wopb-btn-transparent" target="_blank" href="<?php echo wopb_function()->get_premium_link(); ?>"><?php esc_html_e('Plugin Details', 'product-blocks'); ?></a>
                                    </div>
                            </div>
                        </div><!--/overview-->
                        
                        <?php if (!wopb_function()->isActive()) { ?>
                        <div class="wopb-admin-sidebar">
                            <div class="wopb-sidebar wopb-admin-card">
                                <h3><?php esc_html_e('Why Upgrade to Pro', 'product-blocks'); ?></h3>
                                <p><?php esc_html_e('You are using lite version of ProductX. To get more awesome features to upgrade to the Pro version', 'product-blocks'); ?></p>
                                <ul class="wopb-sidebar-list">
                                    <li><?php esc_html_e('Pro Sections, Layout & Design', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Quickview Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Save Template Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Whishlist Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Compare Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Flip Image Addon', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Get All Blocks with Full Control', 'product-blocks'); ?></li>
                                    <li><?php esc_html_e('Fast & Priority Support', 'product-blocks'); ?></li>
                                </ul>
                                <a href="<?php echo wopb_function()->get_premium_link(); ?>" target="_blank" class="wopb-btn wopb-btn-primary wopb-btn-pro"><?php esc_html_e('Upgrade Pro  ➤', 'product-blocks'); ?></a>
                            </div>
                        </div><!--/sidebar-->
                        <?php } ?>

                    </div>
                </div><!--/overview wrapper-->

                <div class="wopb-content-wrap">
                    <div class="wopb-promo-items">
                        <div class="wopb-promo-item wopb-admin-card">
                            <h4><?php _e('Advanced <strong>Query</strong> Builder', 'product-blocks'); ?></h4>
                        </div>
                        <div class="wopb-promo-item wopb-admin-card">
                            <h4><?php _e('<strong>Ajax</strong> Powered Post Filter', 'product-blocks'); ?></h4>
                        </div>
                        <div class="wopb-promo-item wopb-admin-card">
                            <h4><?php _e('Quick <strong>Query</strong> Builder', 'product-blocks'); ?></h4>
                        </div>
                        <div class="wopb-promo-item wopb-admin-card">
                            <h4><?php _e('Ready <strong>Starter</strong> Packs', 'product-blocks'); ?></h4>
                        </div>
                        <div class="wopb-promo-item wopb-admin-card">
                            <h4><?php _e('Premade <strong>Block</strong> Design', 'product-blocks'); ?></h4>
                        </div>
                    </div>
                </div><!--/Promo-->

                <div class="wopb-content-wrap">
                    <div class="wopb-featured-item wopb-admin-card">
                        <div class="wopb-featured-image">
                            <img src="<?php echo WOPB_URL.'assets/img/admin/starter-packs.png'; ?>" alt="Filter Category"/>
                        </div>
                        <div class="wopb-featured-content">
                            <h4><?php _e('Design Library', 'product-blocks'); ?></h4>
                            <p><?php _e('ProductX comes with a rich and beautiful readymade starter pack and design library. It helps you to create a beautiful site without design knowledge.', 'product-blocks'); ?></p>
                            <a class="wopb-btn wopb-btn-primary" target="_blank" href="https://wopb.wpxpo.com/starter-packs/"><?php _e('Explore Details', 'product-blocks'); ?></a>
                        </div>
                    </div>
                </div><!--/wopb-featured-item-->

                <div class="wopb-content-wrap">
                    <div class="wopb-features wopb-admin-card">
                        <div class="wopb-text-center"><h2 class="wopb-admin-title"><?php _e('Pro Features', 'product-blocks'); ?></h2></div> 

                        <ul class="wopb-dashboard-list">
                            <li><?php _e('Advanced Query Builder', 'product-blocks'); ?></li>
                            <li><?php _e('Post Filter Ajax Powered', 'product-blocks'); ?></li>
                            <li><?php _e('Smart Image Flip Option', 'product-blocks'); ?></li>
                            <li><?php _e('AJAX Pagination and Loadmore', 'product-blocks'); ?></li>
                            <li><?php _e('Wishlist Addon', 'product-blocks'); ?></li>
                            <li><?php _e('Compare Addon', 'product-blocks'); ?></li>
                            <li><?php _e('Product Quickview Addon', 'product-blocks'); ?></li>
                            <li><?php _e('Wishlist Addon', 'product-blocks'); ?></li>
                            <li><?php _e('Saved Templates & Shortcode', 'product-blocks'); ?></li>
                            <li><?php _e('Ready-made Starter Packs', 'product-blocks'); ?></li>
                            <li><?php _e('Ready-made Section Library', 'product-blocks'); ?></li>
                            <li><?php _e('Ready-made Design Library', 'product-blocks'); ?></li>
                            <li><?php _e('Action Filter', 'product-blocks'); ?></li>
                            <li><?php _e('Product Carousel', 'product-blocks'); ?></li>
                            <li><?php _e('Product Navigations', 'product-blocks'); ?></li>
                            <li><?php _e('Sales Status', 'product-blocks'); ?></li>
                            <li><?php _e('Feature Tags', 'product-blocks'); ?></li>
                            <li><?php _e('Display Stocks', 'product-blocks'); ?></li>
                            <li><?php _e('Display Review', 'product-blocks'); ?></li>
                            <li><?php _e('Product Deals', 'product-blocks'); ?></li>
                            <li><?php _e('Lots of Pro Layouts', 'product-blocks'); ?></li>
                        </ul>

                        <div class="wopb-text-center">
                            <a class="wopb-btn wopb-btn-primary" target="_blank" href="<?php echo wopb_function()->get_premium_link(); ?>"><?php esc_html_e('More Features', 'product-blocks'); ?></a>
                        </div> 
                    </div>
                </div><!--/features-->

                <div class="wopb-content-wrap">
                    <div class="wopb-features wopb-admin-card">
                        <div class="wopb-text-center"><h2 class="wopb-admin-title"><?php _e('Pro Addons', 'product-blocks'); ?></h2></div>
                        <div class="wopb-feature-items"> 
                            <div class="wopb-feature-item">
                                <div class="wopb-feature-image">
                                    <img src="<?php echo WOPB_URL.'assets/img/admin/addon-compare.png'; ?>" alt="Compare Addon">
                                </div>
                                <div class="wopb-feature-content">
                                    <h4><?php _e('Compare Addon', 'product-blocks'); ?></h4>
                                    <div><?php _e('Customers need to compare different types of products for making decisions. Compare Addon create a compare table for making decisions easily.', 'product-blocks'); ?></div>
                                </div>
                            </div>
                            <div class="wopb-feature-item"> 
                                <div class="wopb-feature-image">    
                                    <img src="<?php echo WOPB_URL.'assets/img/admin/addon-wishlist.png'; ?>" alt="Wishlist Addon"/>
                                </div>
                                <div class="wopb-feature-content">
                                    <h4><?php _e('Wishlist Addon', 'product-blocks'); ?></h4>
                                    <div><?php _e('ProductX comes with a feature rich Wishlist addon. Wishlist is very helpful for users to save any product to profile for future purchase.', 'product-blocks'); ?></div>
                                </div>
                            </div>
                            <div class="wopb-feature-item">
                                <div class="wopb-feature-image">
                                    <img src="<?php echo WOPB_URL.'assets/img/admin/addon-savetemplate.png'; ?>" alt="Save Template Addon"/>
                                </div>
                                <div class="wopb-feature-content">
                                    <h4><?php _e('Save Template Addon', 'product-blocks'); ?></h4>
                                    <div><?php _e('Using this addon you can save Gutenberg blocks as a template and convert it into a shortcode. You can use this shortcode anywhere you want.', 'product-blocks'); ?></div>
                                </div>
                            </div>
                            <div class="wopb-feature-item">
                                <div class="wopb-feature-image">
                                    <img src="<?php echo WOPB_URL.'assets/img/admin/addon-quickview.png'; ?>" alt="Quickview Addon"/>
                                </div>
                                <div class="wopb-feature-content">    
                                    <h4><?php _e('Quickview Addon', 'product-blocks'); ?></h4>
                                    <div><?php _e('Sometimes users want to view quick details of a product without going to a single page. This addon can help to popup a single product.', 'product-blocks'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="wopb-text-center">
                            <a class="wopb-btn wopb-btn-primary" target="_blank" href="<?php echo wopb_function()->get_premium_link(); ?>"><?php esc_html_e('Plugin Details', 'product-blocks'); ?></a>
                        </div>
                    </div>
                </div><!--/feature-->

                <?php require_once WOPB_PATH . 'classes/options/Footer.php'; ?>

            </div>
        </div>

    <?php }
}

