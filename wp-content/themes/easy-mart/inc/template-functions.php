<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function easy_mart_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class of site layout
	$site_layout = get_theme_mod( 'site_layout_setting', 'full-width' );
	$classes[] = esc_attr( $site_layout );
	
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if( class_exists( 'WooCommerce' ) ){
		if( !is_woocommerce() ){

			if( is_page() ){
				$page_layout = get_theme_mod( 'design_page_section_setting', 'right-sidebar' );
				$classes[] = esc_attr( $page_layout );
			}

			if( is_single() ){
				$post_layout = get_theme_mod( 'design_post_section_setting', 'right-sidebar' );
				$classes[] = esc_attr( $post_layout );
			}

			if( is_archive() ){
				$archive_layout = get_theme_mod( 'design_archive_section_setting', 'right-sidebar' );
				$classes[] = esc_attr( $archive_layout );
			}
		}else {
			$wc_page_layout = get_theme_mod( 'design_wc_page_section_setting', 'right-sidebar' );
			$classes[] = esc_attr( $wc_page_layout );
		}	
	}else{
		if( is_page() ){
				$page_layout = get_theme_mod( 'design_page_section_setting', 'right-sidebar' );
				$classes[] = esc_attr( $page_layout );
			}

			if( is_single() ){
				$post_layout = get_theme_mod( 'design_post_section_setting', 'right-sidebar' );
				$classes[] = esc_attr( $post_layout );
			}

			if( is_archive() ){
				$archive_layout = get_theme_mod( 'design_archive_section_setting', 'right-sidebar' );
				$classes[] = esc_attr( $archive_layout );
			}		
	}

	return $classes;
}
add_filter( 'body_class', 'easy_mart_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function easy_mart_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'easy_mart_pingback_header' );

/**
 * Enqueue scripts and styles.
 */
function easy_mart_scripts() {
	global $easy_mart_version;

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style( 'lightslider-style', get_template_directory_uri() . '/assets/library/lightslider/css/lightslider.min.css', array(), '1.1.6' );
	wp_enqueue_style( 'easy-mart-style', get_stylesheet_uri(), array(), esc_attr( $easy_mart_version ) );
	wp_enqueue_style( 'easy-mart-responsive', get_template_directory_uri() . '/assets/css/em-responsive.css', array(), '1.0.0' );

	wp_enqueue_script( 'lightslider-scripts', get_template_directory_uri() . '/assets/library/lightslider/js/lightslider.min.js', array( 'jquery' ), '1.1.6' );
	if( class_exists( 'Woocommerce' ) ){
		wp_enqueue_script( 'easy-mart-custom-woocommerce-js', get_template_directory_uri() . '/assets/js/custom-woocommerce.js', array(), esc_attr( $easy_mart_version ) , true );	
	}
	wp_enqueue_script( 'easy-mart-custom-js', get_template_directory_uri() . '/assets/js/cv-custom-script.js', array(), esc_attr( $easy_mart_version ) , true );
	wp_localize_script( 'ajax_script_function', 'ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	wp_enqueue_script( 'easy-mart-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'easy-mart-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'easy_mart_scripts',10 );

/**
 * Admin scripts handler

 */
function easy_mart_admin_scripts($hook) {
	global $easy_mart_version;

	if( 'widgets.php' != $hook && 'customize.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
        return;
    }

	wp_enqueue_style( 'easy-mart-admin-style', get_template_directory_uri() . '/assets/css/em-admin-style.css', array(), esc_attr( $easy_mart_version ) );
	
    wp_enqueue_script( 'easy-mart-admin-script', get_template_directory_uri() .'/assets/js/em-admin-scripts.js', array( 'jquery' ), esc_attr( $easy_mart_version ) , true );
}

add_action( 'admin_enqueue_scripts', 'easy_mart_admin_scripts' );
/*---------------------------------------------------------------------------------------------------------------------------*/

/**
 * Function for wishlist update
 */
if( defined( 'YITH_WCWL' ) && ! function_exists( 'easy_mart_yith_wcwl_ajax_update_count' ) ){
	function easy_mart_yith_wcwl_ajax_update_count(){
		wp_send_json( array(
			'count' => yith_wcwl_count_products()
		) );
	}
    add_action( 'wp_ajax_easy_mart_wcwl_update_wishlist_count', 'easy_mart_yith_wcwl_ajax_update_count' );
    add_action( 'wp_ajax_nopriv_easy_mart_wcwl_update_wishlist_count', 'easy_mart_yith_wcwl_ajax_update_count' );
}

/*----------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'easy_mart_categories' ) ):

    /**
     * Easy Mart default categories array

     */
    function easy_mart_categories(){
    	
    	$easy_mart_post_cats = get_terms( array(
            'taxonomy'   => 'category',
            'hide_empty' => true,
            'parent'     => 0,
        ) );
    	$easy_mart_cat_list[''] = __( 'Select Category', 'easy-mart' );
    	foreach ($easy_mart_post_cats as $easy_mart_post_cat) {
    		$easy_mart_cat_list[ esc_attr( $easy_mart_post_cat->slug) ] = esc_html( $easy_mart_post_cat->name );
    	}
    	return $easy_mart_cat_list;	
    }

endif;

if ( !function_exists( 'easy_mart_woo_categories' ) ):

    /**
     * Easy Mart product categories array

     */
    function easy_mart_woo_categories(){
    	if( class_exists( 'WooCommerce' ) ){
    		$easy_mart_woo_post_cats = get_terms( array(
                'orderby'   => 'name',
                'hide_empty' => true,
            ) );
    		$easy_mart_woo_post_cat_list[ '' ] = __( 'Select Category', 'easy-mart' );
    		foreach ( $easy_mart_woo_post_cats as $easy_mart_woo_post_cat ) {
    			if( $easy_mart_woo_post_cat->taxonomy == 'product_cat' ){
    			$easy_mart_woo_post_cat_list[ esc_attr( $easy_mart_woo_post_cat->slug ) ] = esc_html( $easy_mart_woo_post_cat->name );
    			}
    		}
    		return $easy_mart_woo_post_cat_list;
    	}
    }

endif;

/*--------------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_css_strip_whitespace' ) ) :
    
    /**
     * Get minified css and removed space
     *
     * @since 1.0.0
     */

    function easy_mart_css_strip_whitespace( $css ){
        $replace = array(
            "#/\*.*?\*/#s" => "",  // Strip C style comments.
            "#\s\s+#"      => " ", // Strip excess whitespace.
        );
        $search = array_keys( $replace );
        $css = preg_replace( $search, $replace, $css );

        $replace = array(
            ": "  => ":",
            "; "  => ";",
            " {"  => "{",
            " }"  => "}",
            ", "  => ",",
            "{ "  => "{",
            ";}"  => "}", // Strip optional semicolons.
            ",\n" => ",", // Don't wrap multiple selectors.
            "\n}" => "}", // Don't wrap closing braces.
            "} "  => "}\n", // Put each rule on it's own line.
        );
        $search = array_keys( $replace );
        $css = str_replace( $search, $replace, $css );

        return trim( $css );
    }

endif;
/*----------------------------------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'easy_mart_hover_color' ) ) :
    
    /**
     * Generate darker color
     * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
     *
     * @since 1.0.0
     */
    function easy_mart_hover_color( $hex, $steps ) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max( -255, min( 255, $steps ) );

        // Normalize into a six character long hex string
        $hex = str_replace( '#', '', $hex );
        if ( strlen( $hex ) == 3) {
            $hex = str_repeat( substr( $hex,0,1 ), 2 ).str_repeat( substr( $hex, 1, 1 ), 2 ).str_repeat( substr( $hex,2,1 ), 2 );
        }

        // Split into three parts: R, G and B
        $color_parts = str_split( $hex, 2 );
        $return = '#';

        foreach ( $color_parts as $color ) {
            $color   = hexdec( $color ); // Convert to decimal
            $color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
            $return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
        }

        return $return;
    }

endif;
/*-----------------------------------------------------------------------------------------------------------------*/

if( ! function_exists( 'font_awesome_social_icon_array' ) ) :

    /**
     * Define font awesome social media icons
     *
     * @return array();
     * @since 1.0.0
     */

    function font_awesome_social_icon_array(){
        $social_icons_array =  array(
    			       'fa-facebook-square','fa-facebook-f','fa-facebook','fa-facebook-official','fa-twitter-square','fa-twitter','fa-yahoo','fa-google','fa-google-wallet','fa-google-plus-circle','fa-google-plus-official','fa-instagram','fa-linkedin-square','fa-linkedin','fa-pinterest-p','fa-pinterest','fa-pinterest-square','fa-google-plus-square','fa-google-plus','fa-youtube-square','fa-youtube','fa-youtube-play','fa-vimeo','fa-vimeo-square',
            );
        foreach ( $social_icons_array as $icon ) {
			$icon_name = ucfirst( str_ireplace( array( '-' ), array( ' ' ), $icon ) );
			$social_icons[esc_attr( $icon )] = esc_html( $icon_name );
		}
    	return $social_icons;
    }

endif;

 /*--------------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Lists of all fontawesome icons class
 *
 */
function font_awesome_list() {
	$icon_array = array('fa-500px','fa-address-book','fa-address-book-o','fa-address-card','fa-address-card-o','fa-adjust','fa-adn','fa-align-center','fa-align-justify','fa-align-left','fa-align-right',
'fa-amazon','fa-ambulance','fa-american-sign-language-interpreting','fa-anchor','fa-android','fa-angellist','fa-angle-double-down','fa-angle-double-left','fa-angle-double-right','fa-angle-double-up',
'fa-angle-down','fa-angle-left','fa-angle-right','fa-angle-up','fa-apple','fa-archive','fa-area-chart','fa-arrow-circle-down','fa-arrow-circle-left','fa-arrow-circle-o-down','fa-arrow-circle-o-left',
'fa-arrow-circle-o-right','fa-arrow-circle-o-up','fa-arrow-circle-right','fa-arrow-circle-up','fa-arrow-down','fa-arrow-left','fa-arrow-right','fa-arrow-up','fa-arrows','fa-arrows-alt','fa-arrows-h',
'fa-arrows-v','fa-assistive-listening-systems','fa-asterisk','fa-at','fa-audio-description','fa-backward','fa-balance-scale','fa-ban','fa-bandcamp','fa-bar-chart','fa-barcode','fa-bars','fa-bath',
'fa-battery-empty','fa-battery-full','fa-battery-half','fa-battery-quarter','fa-battery-three-quarters','fa-bed','fa-beer','fa-behance','fa-behance-square','fa-bell','fa-bell-o','fa-bell-slash',
'fa-bell-slash-o','fa-bicycle','fa-binoculars','fa-birthday-cake','fa-bitbucket','fa-bitbucket-square','fa-black-tie','fa-blind','fa-bluetooth','fa-bluetooth-b','fa-bold','fa-bolt','fa-bomb','fa-book',
'fa-bookmark','fa-bookmark-o','fa-braille','fa-briefcase','fa-btc','fa-bug','fa-building','fa-building-o','fa-bullhorn','fa-bullseye','fa-bus','fa-buysellads','fa-calculator','fa-calendar',
'fa-calendar-check-o','fa-calendar-minus-o','fa-calendar-o','fa-calendar-plus-o','fa-calendar-times-o','fa-camera','fa-camera-retro','fa-car','fa-caret-down','fa-caret-left','fa-caret-right',
'fa-caret-square-o-down','fa-caret-square-o-left','fa-caret-square-o-right','fa-caret-square-o-up','fa-caret-up','fa-cart-arrow-down','fa-cart-plus','fa-cc','fa-cc-amex','fa-cc-diners-club',
'fa-cc-discover','fa-cc-jcb','fa-cc-mastercard','fa-cc-paypal','fa-cc-stripe','fa-cc-visa','fa-certificate','fa-chain-broken','fa-check','fa-check-circle','fa-check-circle-o','fa-check-square',
'fa-check-square-o','fa-chevron-circle-down','fa-chevron-circle-left','fa-chevron-circle-right','fa-chevron-circle-up','fa-chevron-down','fa-chevron-left','fa-chevron-right','fa-chevron-up','fa-child',
'fa-chrome','fa-circle','fa-circle-o','fa-circle-o-notch','fa-circle-thin','fa-clipboard','fa-clock-o','fa-clone','fa-cloud','fa-cloud-download','fa-cloud-upload','fa-code','fa-code-fork','fa-codepen',
'fa-codiepie','fa-coffee','fa-cog','fa-cogs','fa-columns','fa-comment','fa-comment-o','fa-commenting','fa-commenting-o','fa-comments','fa-comments-o','fa-compass','fa-compress','fa-connectdevelop',
'fa-contao','fa-copyright','fa-creative-commons','fa-credit-card','fa-credit-card-alt','fa-crop','fa-crosshairs','fa-css3','fa-cube','fa-cubes','fa-cutlery','fa-dashcube','fa-database','fa-deaf',
'fa-delicious','fa-desktop','fa-deviantart','fa-diamond','fa-digg','fa-dot-circle-o','fa-download','fa-dribbble','fa-dropbox','fa-drupal','fa-edge','fa-eercast','fa-eject','fa-ellipsis-h','fa-ellipsis-v',
'fa-empire','fa-envelope','fa-envelope-o','fa-envelope-open','fa-envelope-open-o','fa-envelope-square','fa-envira','fa-eraser','fa-etsy','fa-eur','fa-exchange','fa-exclamation','fa-exclamation-circle',
'fa-exclamation-triangle','fa-expand','fa-expeditedssl','fa-external-link','fa-external-link-square','fa-eye','fa-eye-slash','fa-eyedropper','fa-facebook','fa-facebook-official','fa-facebook-square',
'fa-fast-backward','fa-fast-forward','fa-fax','fa-female','fa-fighter-jet','fa-file','fa-file-archive-o','fa-file-audio-o','fa-file-code-o','fa-file-excel-o','fa-file-image-o','fa-file-o','fa-file-pdf-o',
'fa-file-powerpoint-o','fa-file-text','fa-file-text-o','fa-file-video-o','fa-file-word-o','fa-files-o','fa-film','fa-filter','fa-fire','fa-fire-extinguisher','fa-firefox','fa-first-order','fa-flag',
'fa-flag-checkered','fa-flag-o','fa-flask','fa-flickr','fa-floppy-o','fa-folder','fa-folder-o','fa-folder-open','fa-folder-open-o','fa-font','fa-font-awesome','fa-fonticons','fa-fort-awesome','fa-forumbee',
'fa-forward','fa-foursquare','fa-free-code-camp','fa-frown-o','fa-futbol-o','fa-gamepad','fa-gavel','fa-gbp','fa-genderless','fa-get-pocket','fa-gg','fa-gg-circle','fa-gift','fa-git','fa-git-square',
'fa-github','fa-github-alt','fa-github-square','fa-gitlab','fa-glass','fa-glide','fa-glide-g','fa-globe','fa-google','fa-google-plus','fa-google-plus-official','fa-google-plus-square','fa-google-wallet',
'fa-graduation-cap','fa-gratipay','fa-grav','fa-h-square','fa-hacker-news','fa-hand-lizard-o','fa-hand-o-down','fa-hand-o-left','fa-hand-o-right','fa-hand-o-up','fa-hand-paper-o','fa-hand-peace-o',
'fa-hand-pointer-o','fa-hand-rock-o','fa-hand-scissors-o','fa-hand-spock-o','fa-handshake-o','fa-hashtag','fa-hdd-o','fa-header','fa-headphones','fa-heart','fa-heart-o','fa-heartbeat','fa-history',
'fa-home','fa-hospital-o','fa-hourglass','fa-hourglass-end','fa-hourglass-half','fa-hourglass-o','fa-hourglass-start','fa-houzz','fa-html5','fa-i-cursor','fa-id-badge','fa-id-card','fa-id-card-o',
'fa-ils','fa-imdb','fa-inbox','fa-indent','fa-industry','fa-info','fa-info-circle','fa-inr','fa-instagram','fa-internet-explorer','fa-ioxhost','fa-italic','fa-joomla','fa-jpy','fa-jsfiddle','fa-key',
'fa-keyboard-o','fa-krw','fa-language','fa-laptop','fa-lastfm','fa-lastfm-square','fa-leaf','fa-leanpub','fa-lemon-o','fa-level-down','fa-level-up','fa-life-ring','fa-lightbulb-o','fa-line-chart',
'fa-link','fa-linkedin','fa-linkedin-square','fa-linode','fa-linux','fa-list','fa-list-alt','fa-list-ol','fa-list-ul','fa-location-arrow','fa-lock','fa-long-arrow-down','fa-long-arrow-left',
'fa-long-arrow-right','fa-long-arrow-up','fa-low-vision','fa-magic','fa-magnet','fa-male','fa-map','fa-map-marker','fa-map-o','fa-map-pin','fa-map-signs','fa-mars','fa-mars-double','fa-mars-stroke',
'fa-mars-stroke-h','fa-mars-stroke-v','fa-maxcdn','fa-meanpath','fa-medium','fa-medkit','fa-meetup','fa-meh-o','fa-mercury','fa-microchip','fa-microphone','fa-microphone-slash','fa-minus',
'fa-minus-circle','fa-minus-square','fa-minus-square-o','fa-mixcloud','fa-mobile','fa-modx','fa-money','fa-moon-o','fa-motorcycle','fa-mouse-pointer','fa-music','fa-neuter','fa-newspaper-o',
'fa-object-group','fa-object-ungroup','fa-odnoklassniki','fa-odnoklassniki-square','fa-opencart','fa-openid','fa-opera','fa-optin-monster','fa-outdent','fa-pagelines','fa-paint-brush','fa-paper-plane',
'fa-paper-plane-o','fa-paperclip','fa-paragraph','fa-pause','fa-pause-circle','fa-pause-circle-o','fa-paw','fa-paypal','fa-pencil','fa-pencil-square','fa-pencil-square-o','fa-percent','fa-phone',
'fa-phone-square','fa-picture-o','fa-pie-chart','fa-pied-piper','fa-pied-piper-alt','fa-pied-piper-pp','fa-pinterest','fa-pinterest-p','fa-pinterest-square','fa-plane','fa-play','fa-play-circle',
'fa-play-circle-o','fa-plug','fa-plus','fa-plus-circle','fa-plus-square','fa-plus-square-o','fa-podcast','fa-power-off','fa-print','fa-product-hunt','fa-puzzle-piece','fa-qq','fa-qrcode','fa-question',
'fa-question-circle','fa-question-circle-o','fa-quora','fa-quote-left','fa-quote-right','fa-random','fa-ravelry','fa-rebel','fa-recycle','fa-reddit','fa-reddit-alien','fa-reddit-square','fa-refresh',
'fa-registered','fa-renren','fa-repeat','fa-reply','fa-reply-all','fa-retweet','fa-road','fa-rocket','fa-rss','fa-rss-square','fa-rub','fa-safari','fa-scissors','fa-scribd','fa-search','fa-search-minus',
'fa-search-plus','fa-sellsy','fa-server','fa-share','fa-share-alt','fa-share-alt-square','fa-share-square','fa-share-square-o','fa-shield','fa-ship','fa-shirtsinbulk','fa-shopping-bag','fa-shopping-basket',
'fa-shopping-cart','fa-shower','fa-sign-in','fa-sign-language','fa-sign-out','fa-signal','fa-simplybuilt','fa-sitemap','fa-skyatlas','fa-skype','fa-slack','fa-sliders','fa-slideshare','fa-smile-o',
'fa-snapchat','fa-snapchat-ghost','fa-snapchat-square','fa-snowflake-o','fa-sort','fa-sort-alpha-asc','fa-sort-alpha-desc','fa-sort-amount-asc','fa-sort-amount-desc','fa-sort-asc','fa-sort-desc',
'fa-sort-numeric-asc','fa-sort-numeric-desc','fa-soundcloud','fa-space-shuttle','fa-spinner','fa-spoon','fa-spotify','fa-square','fa-square-o','fa-stack-exchange','fa-stack-overflow','fa-star',
'fa-star-half','fa-star-half-o','fa-star-o','fa-steam','fa-steam-square','fa-step-backward','fa-step-forward','fa-stethoscope','fa-sticky-note','fa-sticky-note-o','fa-stop','fa-stop-circle',
'fa-stop-circle-o','fa-street-view','fa-strikethrough','fa-stumbleupon','fa-stumbleupon-circle','fa-subscript','fa-subway','fa-suitcase','fa-sun-o','fa-superpowers','fa-superscript','fa-table',
'fa-tablet','fa-tachometer','fa-tag','fa-tags','fa-tasks','fa-taxi','fa-telegram','fa-television','fa-tencent-weibo','fa-terminal','fa-text-height','fa-text-width','fa-th','fa-th-large','fa-th-list',
'fa-themeisle','fa-thermometer-empty','fa-thermometer-full','fa-thermometer-half','fa-thermometer-quarter','fa-thermometer-three-quarters','fa-thumb-tack','fa-thumbs-down','fa-thumbs-o-down',
'fa-thumbs-o-up','fa-thumbs-up','fa-ticket','fa-times','fa-times-circle','fa-times-circle-o','fa-tint','fa-toggle-off','fa-toggle-on','fa-trademark','fa-train','fa-transgender','fa-transgender-alt',
'fa-trash','fa-trash-o','fa-tree','fa-trello','fa-tripadvisor','fa-trophy','fa-truck','fa-try','fa-tty','fa-tumblr','fa-tumblr-square','fa-twitch','fa-twitter','fa-twitter-square','fa-umbrella',
'fa-underline','fa-undo','fa-universal-access','fa-university','fa-unlock','fa-unlock-alt','fa-upload','fa-usb','fa-usd','fa-user','fa-user-circle','fa-user-circle-o','fa-user-md','fa-user-o',
'fa-user-plus','fa-user-secret','fa-user-times','fa-users','fa-venus','fa-venus-double','fa-venus-mars','fa-viacoin','fa-viadeo','fa-viadeo-square','fa-video-camera','fa-vimeo','fa-vimeo-square','fa-vine',
'fa-vk','fa-volume-control-phone','fa-volume-down','fa-volume-off','fa-volume-up','fa-weibo','fa-weixin','fa-whatsapp','fa-wheelchair','fa-wheelchair-alt','fa-wifi','fa-wikipedia-w','fa-window-close',
'fa-window-close-o','fa-window-maximize','fa-window-minimize','fa-window-restore','fa-windows','fa-wordpress','fa-wpbeginner','fa-wpexplorer','fa-wpforms','fa-wrench','fa-xing','fa-xing-square',
'fa-y-combinator','fa-yahoo','fa-yelp','fa-yoast','fa-youtube','fa-youtube-play','fa-youtube-square');
foreach ( $icon_array as $icon ) {
		$icon_name = ucfirst( str_ireplace( array( '-' ), array( ' ' ), $icon ) );
		$icons[esc_attr( $icon )] = esc_html( $icon_name );
	}
	return $icons;
}