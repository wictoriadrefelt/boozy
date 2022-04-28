<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'easy-mart' ); ?></a>
	<?php 
	/**
	 * Easy Mart Top Header hooks 
	 *
	 * @hooked - easy_mart_top_header_start - 10
	 * @hooked - easy_mart_top_header_site_info - 20
	 * @hooked - easy_mart_top_header_nav_wrap_start - 30
	 * @hooked - easy_mart_top_header_wishlist_btn - 40
	 * @hooked - easy_mart_top_header_nav_menu - 50
	 * @hooked - easy_mart_top_header_nav_wrap_end - 60
	 * @hooked - easy_mart_top_header_end - 70
	 *
	 */
		do_action( 'easy_mart_top_header_sec' );

	/**
	 * Easy Mart Header hooks 
	 *
	 * @hooked - easy_mart_header_start - 10
	 * @hooked - easy_mart_header_site_branding_wrapper_start - 20
	 * @hooked - easy_mart_header_site_branding - 30
	 * @hooked - easy_mart_header_search - 40
	 * @hooked - easy_mart_header_site_branding_wrapper_end - 50
	 * @hooked - easy_mart_header_primary_nav_start - 60
	 * @hooked - easy_mart_header_category_menu - 70
	 * @hooked - easy_mart_header_nav - 80
	 * @hooked - easy_mart_header_cart - 90
	 * @hooked - easy_mart_header_primary_nav_end - 100
	 * @hooked - easy_mart_header_end - 110
	 *
	 */
		do_action( 'easy_mart_header_sec' );
	?>

	<div id="content" class="site-content">
	<div class="cv-container">