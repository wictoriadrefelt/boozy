<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

?>
	</div><!-- .cv-container -->
	</div><!-- #content -->

		<?php
		/**
		 * Footer hooked functions call 
		 * 
		 * @hooked - easy_mart_footer_start - 10
		 * @hooked - easy_mart_footer_sidebar_one - 20
		 * @hooked - easy_mart_footer_sidebar_two - 30
		 * @hooked - easy_mart_footer_sidebar_three - 40
		 * @hooked - easy_mart_footer_sidebar_four - 50
		 * @hooked - easy_mart_footer_site_info - 60
		 * @hooked - easy_mart_footer_end - 70
		 * 
		 */ 
			do_action( 'easy_mart_footer' );
		?>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
