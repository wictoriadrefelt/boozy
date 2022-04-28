<?php 
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package CodeVibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 *
 */

if ( !function_exists( 'easy_mart_scroll_to_top_btn' ) ):

	/**
	 * Functions for scroll to top button
	 */
	function easy_mart_scroll_to_top_btn() {
		$scroll_to_top_btn = get_theme_mod( 'scroll_to_top_btn', true );
		if ( false == $scroll_to_top_btn ) {
			return;
		} 

		$scroll_to_button_text = get_theme_mod( 'scroll_to_button_text', '' );
		?>
		 <div class="em-scroll-up"> 
		 	<?php
		 		if ( empty( $scroll_to_button_text ) ) {  
	    			echo '<i id="em-scrollup" class="fa fa-arrow-up"></i>';
	    		}else {
	    			echo esc_html( $scroll_to_button_text );
	    		}
	    	?>
	    </div>
<?php 
	}

endif;
/*----------------------------------------------------------------------------------------------------------------------------------------*/

$footer_column = get_theme_mod( 'footer_column_section_layout', 'column-3' );

if ( !function_exists( 'easy_mart_footer_start' ) ):

	/**
	 * Functions for footer start
	 */
	function easy_mart_footer_start() {
		global $footer_column;
		?>
		<footer id="colophon" class="site-footer <?php echo 'footer-'.esc_attr( $footer_column ); ?>">
<?php 
	}

endif;

/*----------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'easy_mart_footer_top_section_start' ) ):

	/**
	 * Functions for footer top section start
	 */
	function easy_mart_footer_top_section_start() {
		if ( !is_active_sidebar( 'footer-sidebar-1' ) && !is_active_sidebar( 'footer-sidebar-2' ) && !is_active_sidebar( 'footer-sidebar-3' ) && !is_active_sidebar( 'footer-sidebar-4' ) ) {
			return;
		} ?>
		<div class="site-footer-top-section">
			<div class="cv-container">
			<div class="footer-widget-wrapper">
<?php 
	}

endif;
/*------------------------------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'easy_mart_footer_sidebar_one' ) ):

	/**
	 * Functions for footer sidebar one
	 */
	function easy_mart_footer_sidebar_one() { 
		if ( is_active_sidebar( 'footer-sidebar-1' ) ) {
			echo '<div class="em-footer-widget">';
				dynamic_sidebar( 'footer-sidebar-1' );
			echo '</div><!-- .em-footer-widget -->';
		}
	}

endif;	
/*------------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'easy_mart_footer_sidebar_two' ) ):

	/**
	 * Functions for footer sidebar two
	 */
	function easy_mart_footer_sidebar_two() { 
		global $footer_column;
		if ( esc_attr( $footer_column ) == 'column-1' ) {
			return;
		}

		if ( is_active_sidebar( 'footer-sidebar-2' ) ) {
			echo '<div class="em-footer-widget">';
				dynamic_sidebar( 'footer-sidebar-2' );
			echo '</div><!-- .em-footer-widget -->';
		}
	}

endif;
/*------------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'easy_mart_footer_sidebar_three' ) ):

	/**
	 * Functions for footer sidebar three
	 */
	function easy_mart_footer_sidebar_three() { 
		global $footer_column;
		if ( esc_attr( $footer_column ) == 'column-1' || esc_attr( $footer_column ) == 'column-2' ) {
			return;
		}

		if ( is_active_sidebar( 'footer-sidebar-3' ) ) {
			echo '<div class="em-footer-widget">';
				dynamic_sidebar( 'footer-sidebar-3' );
			echo '</div><!-- .em-footer-widget -->';
		}
	}

endif;
/*------------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'easy_mart_footer_sidebar_four' ) ):

	/**
	 * Functions for footer sidebar four
	 */
	function easy_mart_footer_sidebar_four() { 
		global $footer_column;
		if ( esc_attr( $footer_column ) != 'column-4' ) {
			return;
		}

		if ( is_active_sidebar( 'footer-sidebar-4' ) ) {
			echo '<div class="em-footer-widget">';
				dynamic_sidebar( 'footer-sidebar-4' );
			echo '</div><!-- .em-footer-widget -->';
		}
	}

endif;
/*------------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'easy_mart_footer_top_section_end' ) ):

	/**
	 * Functions for footer top section end 
	 */
	function easy_mart_footer_top_section_end() {
		if ( !is_active_sidebar( 'footer-sidebar-1' ) && !is_active_sidebar( 'footer-sidebar-2' ) && !is_active_sidebar( 'footer-sidebar-3' ) && !is_active_sidebar( 'footer-sidebar-4' ) ) {
			return;
		} ?>
				</div> <!-- footer-widget-wrapper -->
			</div><!-- .cv-container -->
		</div><!-- .site-footer-top-section -->
	<?php 
	}

endif;

/*------------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'easy_mart_footer_bottom_section_start' ) ):

	/**
	 * Functions for footer bottom section start
	 */
	function easy_mart_footer_bottom_section_start() { ?>
		<div class="site-footer-bottom-section">
			<div class="cv-container">
	<?php 
	}

endif;

/*------------------------------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'easy_mart_footer_payment_support' ) ):

	/**
	 * Functions for footer payment support
	 */
	function easy_mart_footer_payment_support() { ?>
		<div class="site-info">
			<span class="footer-copyright-text">
				<?php 
					$easy_mart_footer_copyright = get_theme_mod( 'easy_mart_footer_copyright', __( 'Easy Mart', 'easy-mart' ) );
					echo esc_html( $easy_mart_footer_copyright );
				?>
			</span>
			<span class="sep"> | </span>
			<?php
				$designer_url = 'https://codevibrant.com';
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'easy-mart' ), 'easy-mart', '<a href="'. esc_url( $designer_url ) .'" rel="designer">CodeVibrant</a>' );
			?>
		</div><!-- .site-info -->
		<?php
			$footer_image = get_theme_mod( 'site_copyright_section_image','' );
			
			if ( !empty( $footer_image ) ) { ?>
				<div class="site-payment-support">
					<figure>
						<img src="<?php echo esc_url( $footer_image ); ?>">
					</figure>
				</div><!-- .site-payment-support -->
		<?php } 
	}

endif;
/*------------------------------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'easy_mart_footer_bottom_section_end' ) ):

	/**
	 * Functions for footer bottom section end
	 */
	function easy_mart_footer_bottom_section_end() { ?>
			</div><!-- .cv-container -->
		</div><!-- .site-footer-bottom-section -->
	<?php 
	}

endif;

/*------------------------------------------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'easy_mart_footer_end' ) ):

	/**
	 * Functions for footer end
	 */
	function easy_mart_footer_end() { ?>
		</footer><!-- #colophon -->
	<?php 
	}
	
endif;
/*------------------------------------------------------------------------------------------------------------------------------------------*/
add_action( 'easy_mart_footer', 'easy_mart_scroll_to_top_btn', 5 );
add_action( 'easy_mart_footer', 'easy_mart_footer_start', 10 );
add_action( 'easy_mart_footer', 'easy_mart_footer_top_section_start', 20 );
add_action( 'easy_mart_footer', 'easy_mart_footer_sidebar_one', 30 );
add_action( 'easy_mart_footer', 'easy_mart_footer_sidebar_two', 40 );
add_action( 'easy_mart_footer', 'easy_mart_footer_sidebar_three', 50 );
add_action( 'easy_mart_footer', 'easy_mart_footer_sidebar_four', 60 );
add_action( 'easy_mart_footer', 'easy_mart_footer_top_section_end', 70 );
add_action( 'easy_mart_footer', 'easy_mart_footer_bottom_section_start', 80 ); 
add_action( 'easy_mart_footer', 'easy_mart_footer_payment_support', 90 );
add_action( 'easy_mart_footer', 'easy_mart_footer_bottom_section_end', 100 );
add_action( 'easy_mart_footer', 'easy_mart_footer_end', 110 );