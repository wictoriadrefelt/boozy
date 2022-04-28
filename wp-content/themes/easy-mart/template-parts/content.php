<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

if( !has_post_thumbnail() ){ 
	$image_class = 'no-image';	
}else{
	$image_class = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $image_class ); ?>>
	
	<div class="em-thumbnail-date-wrap">
		<?php easy_mart_post_thumbnail(); ?>
		<div class="post-date-attr">
			<span class="post-month">
				<?php the_time('M'); ?>
			</span>
			<span class="post-day">
				<?php the_time('j'); ?>
			</span>
		</div><!-- .post-date-attr -->
	</div> <!-- em-thumbnail-date-wrap -->
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				easy_mart_posted_by();
				easy_mart_entry_footer();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_excerpt( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'easy-mart' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'easy-mart' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
