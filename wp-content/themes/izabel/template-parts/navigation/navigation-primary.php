<?php
/**
 * Displays Primary Navigation
 *
 * @package Izabel
 */
?>
<div id="header-navigation-area">
	<div class="wrapper">
		<button id="primary-menu-toggle" class="menu-primary-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php
			echo izabel_get_svg( array( 'icon' => 'bars' ) );
			echo izabel_get_svg( array( 'icon' => 'close' ) );

			$label = esc_html__( 'Menu', 'izabel' ); ?>
			<span class="menu-label"><?php echo esc_html( $label ); ?></span>

		</button>

		<div id="site-header-menu" class="site-primary-menu">
			<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
				<nav id="site-primary-navigation" class="main-navigation site-navigation custom-primary-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'izabel' ); ?>">
					<?php wp_nav_menu( array(
						'theme_location'	=> 'menu-1',
						'container_class'	=> 'primary-menu-container',
						'menu_class'		=> 'primary-menu',
					) ); ?>
				</nav><!-- #site-primary-navigation.custom-primary-menu -->
			<?php else : ?>
				<nav id="site-primary-navigation" class="main-navigation site-navigation default-page-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'izabel' ); ?>">
					<?php wp_page_menu(
						array(
							'menu_class' => 'primary-menu-container',
							'before'     => '<ul id="primary-page-menu" class="primary-menu">',
							'after'      => '</ul>',
						)
					); ?>
				</nav><!-- #site-primary-navigation.default-page-menu -->
			<?php endif; ?>


			<?php get_template_part( 'template-parts/navigation/navigation-social-header-left' );  ?>


			<?php $header_right_search = get_theme_mod( 'izabel_header_right_search_display', 1 ); ?>
			<?php if ( $header_right_search ) : ?>
				<div class="secondary-search-wrapper">
					<div id="search-container-main-mobile">
			        	<div class="search-container">
			            	<?php get_search_form(); ?>
			            </div><!-- .search-container -->
					</div><!-- #search-social-container -->
				</div><!-- .secondary-search-wrapper -->
			<?php endif; ?>

			<?php
				if ( function_exists( 'izabel_header_cart' ) ) {
					izabel_header_cart();
				}
			?>
		</div><!-- .site-primary-menu -->
	</div><!-- .wrapper -->
</div><!-- #header-navigation-area -->
