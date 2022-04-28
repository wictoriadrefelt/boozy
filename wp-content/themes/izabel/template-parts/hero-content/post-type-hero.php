<?php
/**
 * The template used for displaying hero content
 *
 * @package Izabel
 */
?>

<?php

if ( $id = get_theme_mod( 'izabel_hero_cont' ) ) {
	$args['page_id'] = absint( $id );
}

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query( $args );
if ( $hero_query->have_posts() ) :
	while ( $hero_query->have_posts() ) :
		$hero_query->the_post();

		$thumb = get_the_post_thumbnail_url( get_the_ID(), 'izabel-hero-content' );
		?>
		<div id="hero-section" class="section content-right text-aligned-left">
			<div class="wrapper section-content-wrapper hero-content-wrapper">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-thumbnail" style="background-image: url( '<?php echo esc_url( $thumb ); ?>' )">
							<a class="cover-link" href="<?php the_permalink(); ?>"></a>
						</div><!-- .post-thumbnail -->
						<div class="entry-container">
					<?php else : ?>
						<div class="entry-container full-width">
					<?php endif; ?>
						<header class="entry-header section-title-wrapper">
							<?php the_title( '<h2 class="entry-title section-title">', '</h2>' ); ?>
						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php
							the_content();
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'izabel' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span class="page-number">',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'izabel' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
							?>
						</div><!-- .entry-content -->

						<?php if ( get_edit_post_link() ) : ?>
							<footer class="entry-footer">
								<div class="entry-meta">
									<?php
										edit_post_link(
											sprintf(
												/* translators: %s: Name of current post */
												esc_html__( 'Edit %s', 'izabel' ),
												the_title( '<span class="screen-reader-text">"', '"</span>', false )
											),
											'<span class="edit-link">',
											'</span>'
										);
									?>
								</div>
							</footer><!-- .entry-footer -->
						<?php endif; ?>
					</div><!-- .entry-container -->
				</article><!-- #post-## -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
