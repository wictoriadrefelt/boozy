<?php
/**
 * Easy Mart functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */
/*-----------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'easy_mart_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function easy_mart_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Easy Mart, use a find and replace
		 * to change 'easy-mart' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'easy-mart', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary ( Appears in the header section after logo. )', 'easy-mart' ),
			'menu-2' => esc_html__( 'Top Header ( Appears at the top section of the site. )', 'easy-mart' ),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'easy_mart_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
	     * Restoring the classic Widgets Editor
	     * 
	     * @since 1.0.5
	     */
	    $easy_mart_enable_widgets_editor = get_theme_mod( 'easy_mart_enable_widgets_editor', false );
		if ( false === $easy_mart_enable_widgets_editor ) {
			remove_theme_support( 'widgets-block-editor' );
		}
	}
endif;
add_action( 'after_setup_theme', 'easy_mart_setup' );

/**
 * Set the theme version
 *
 * @global int $easy_mart_version
 * @since 1.0.0
 */
function easy_mart_theme_version() {
	$easy_mart_theme_info = wp_get_theme();
	$GLOBALS['easy_mart_version'] = $easy_mart_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'easy_mart_theme_version', 0 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function easy_mart_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'easy_mart_content_width', 640 );
}
add_action( 'after_setup_theme', 'easy_mart_content_width', 0 );

/**
 * Function for displaying menu item description
 * 
 */
function prefix_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
    	$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
	}
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Load custom footer hooks 
 */
require get_template_directory() . '/inc/custom-hooks/cv-footer-hooks.php';
require get_template_directory() . '/inc/custom-hooks/cv-custom-hooks.php';
require get_template_directory() . '/inc/custom-hooks/cv-header-hooks.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/cv-customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load widget functions file
 */
require get_template_directory() . '/inc/widgets/cv-widget-functions.php';

/**
 * Load TGM
 */
require get_template_directory() . '/inc/tgm/em-required-plugins.php';

/**
 * Load dynamic style file
 */
require get_template_directory(). '/inc/em-dynamic-styles.php';

/**
 * Load theme welcome page
 */
require get_template_directory(). '/inc/welcome/easy-mart-welcome.php';