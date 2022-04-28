<?php
/**
 * Dynamic style for site primary color 
 *
 * @package CodeVibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 *
 */
add_action( 'wp_enqueue_scripts', 'easy_mart_dynamic_styles' );
if( ! function_exists( 'easy_mart_dynamic_styles' ) ) :

    /**
     * Easy Mart Dynamic Styles
     */
    function easy_mart_dynamic_styles() {
        $easy_mart_background_color = get_theme_mod( 'background_color', '#ffffff' ); 
        $easy_mart_primary_color = get_theme_mod( 'easy_mart_primary_color', '#DF3550' );
        $easy_mart_primary_color_hover = easy_mart_hover_color( $easy_mart_primary_color, '-20' );
        
        $output_css = '';

        $output_css .= ".navigation .nav-links a,.btn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.reply .comment-reply-link,.widget_search .search-submit,.woocommerce .price-cart:after,.woocommerce ul.products li.product .price-cart .button:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.added_to_cart.wc-forward,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce ul.products li.product .onsale, .woocommerce span.onsale,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt[disabled]:disabled,.woocommerce #respond input#submit.alt[disabled]:disabled:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt[disabled]:disabled,.woocommerce a.button.alt[disabled]:disabled:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt[disabled]:disabled,.woocommerce button.button.alt[disabled]:disabled:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt[disabled]:disabled,.woocommerce input.button.alt[disabled]:disabled:hover,.em-cat-menu .category-dropdown li a:hover,.site-primary-nav-wrapper .cv-container,#site-navigation ul.sub-menu, #site-navigation ul.children,.em-ticker-section .ticker-title,.slider-btn,.easy_mart_slider .slider-btn:hover,.woocommerce-active .product .onsale,.add_to_cart_button,.front-page-slider-block .lSAction > a:hover,.section-title::before,.cv-block-title:before,.woocommerce-products-header .page-title:before,.widget-title:before,.easy_mart_category_collection .category-title-btn-wrap .category-btn,.easy_mart_category_collection .category-title-btn-wrap .category-btn:hover,.post-date-attr,.em-scroll-up,.header_sticky.shrink,.follow-us-section .follow-us-content a { background-color:".esc_attr( $easy_mart_primary_color ).";}";

         $output_css .= "a,a:hover,a:focus,a:active,.entry-footer a:hover,.comment-author .fn .url:hover,.commentmetadata .comment-edit-link,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.woocommerce ul.cart_list li a:hover,.woocommerce ul.product_list_widget li a:hover,.woocommerce .woocommerce-message:before,.woocommerce div.product p.price ins,.woocommerce div.product span.price ins,.woocommerce div.product p.price del,.woocommerce .woocommerce-info:before,.woocommerce .product-categories li a:hover,.woocommerce p.stars:hover a::before,#top-header-nav ul li a:hover,.cv-whishlist a:hover,.em-ticker-section .ticker-item span,.slider-title span,.woocommerce-loop-product__title:hover,.product .star-rating span:before,.woocommerce .star-rating span:before,.easy-mart-woo-product-btn-wrapper a:hover,.woocommerce ul.products li.product .easy-mart-woo-product-btn-wrapper a:hover,.promo-icon-title-block .promo-icon,.easy_mart_default_post_category .entry-btn:hover,.easy_mart_default_post_category .entry-title-desc-wrap .entry-title a:hover,.entry-meta > span a:hover,.entry-title a:hover,.error-404.not-found .page-header .page-title,.menu-close:hover,.section-product-content-wrap.list-view .product-content li .easy-mart-woo-product-btn-wrapper a.add_to_cart_button:hover,#site-navigation .menu-close:hover{color:".esc_attr( $easy_mart_primary_color ).";}"; 

        $output_css .= ".navigation .nav-links a,.btn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.woocommerce form .form-row.woocommerce-validated .select2-container,.woocommerce form .form-row.woocommerce-validated input.input-text,.woocommerce form .form-row.woocommerce-validated select,.easy_mart_category_collection .category-title-btn-wrap .category-btn,.easy_mart_category_collection .category-title-btn-wrap .category-btn:hover,.promo-icon-title-block .promo-icon,.error-404.not-found{ border-color:".esc_attr( $easy_mart_primary_color )."; }";

        $output_css .= ".comment-list .comment-body,.woocommerce .woocommerce-info,.woocommerce .woocommerce-message{ border-top-color:".esc_attr( $easy_mart_primary_color )."; }";

        $output_css .= ".entry-title-desc-wrap,#blog-post article.hentry, .search article.hentry, .archive article.hentry, .tag article.hentry, .category article.hentry, .blog article.hentry{ border-bottom-color:".esc_attr( $easy_mart_primary_color )."; }";

       $output_css .= "#site-navigation ul li.current-menu-item>a,#site-navigation ul li:hover>a,#site-navigation ul li.current_page_ancestor>a,#site-navigation ul li.current-menu-ancestor>a,#site-navigation ul li.current_page_item>a,#site-navigation ul li.focus>a{  background-color:".esc_attr( $easy_mart_primary_color_hover )."; }";

        $output_css .= "@media (max-width: 1200px) { #masthead #site-navigation { background-color:".esc_attr( $easy_mart_primary_color )."; } }";

        $output_css .= "@media (max-width: 1200px) { #masthead .menu-toggle{  background-color:".esc_attr( $easy_mart_primary_color_hover )."; }}";

       $refine_output_css = easy_mart_css_strip_whitespace( $output_css );
        wp_add_inline_style( 'easy-mart-style', $refine_output_css );
    }
    
endif;