<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

get_header(); ?>

	<?php
	/**
	 * Fuctions to manage front page section
	 * 
	 * @hooked- easy_mart_header_ticker_section - 5
	 * @hooked- easy_mart_front_page_top_section - 10
	 * @hooked- easy_mart_front_page_middle_section_wrapper_start - 20
	 * @hooked- easy_mart_front_page_middle_content_display - 30
	 * @hooked- easy_mart_front_page_middle_sidebar - 40
	 * @hooked- easy_mart_front_page_middle_section_wrapper_end - 50
	 * @hooked- easy_mart_front_page_bottom_content - 60
	 *
	 */
	do_action( 'easy_mart_front_page_sections' ); 
	 
$frontpage_latest_post_view_opt = get_theme_mod( 'frontpage_latest_post_view_opt', false );
if( is_front_page()  && false == esc_attr( $frontpage_latest_post_view_opt ) ){
?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php
			if ( have_posts() ) :

				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

	<?php
	get_sidebar();
}
get_footer();
