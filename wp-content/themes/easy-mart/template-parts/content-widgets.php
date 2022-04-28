<?php
/**
 * Template part for displaying from widget posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<figure class="post-thumbnail">
		<?php easy_mart_post_thumbnail(); ?>
		<div class="post-date-attr">
			<span class="post-month">
				<?php the_time('M'); ?>
			</span>
			<span class="post-day">
				<?php the_time('j'); ?>
			</span>
		</div>
	</figure>
	<div class="entry-title-desc-wrap">
		<header class="entry-header">
			<?php
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
			<a class="entry-btn" href="<?php the_permalink(); ?>"> <?php esc_html_e( 'Read More', 'easy-mart' ) ;?> <i class="fa fa-angle-right"> </i></a>
	</div> <!-- entry-title-desc-wrap -->
</article><!-- #post-<?php the_ID(); ?> -->
