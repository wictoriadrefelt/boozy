<?php
/*
 * Template Name: Right Sidebar ( Content, Primary Sidebar )
 *
 * Template Post Type: post, page
 *
 * The template for displaying Page/Post with Sidebar on right
 *
 * @package Izabel
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="singular-content-wrap">
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();

                 $template = 'single';

                    if ( is_page() ) {
                        $template = 'page';
                    }

                // Include the single post content template.
                get_template_part( 'template-parts/content/content', $template );

                // Comments Templates
                get_template_part( 'template-parts/content/content', 'comment' );

                if ( is_singular( 'attachment' ) ) {
                    // Parent post navigation.
                    the_post_navigation( array(
                        'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'izabel' ),
                    ) );
                } elseif ( is_singular( 'post' ) ) {
                    // Previous/next post navigation.
                    the_post_navigation( array(
                        'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'izabel' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'izabel' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . izabel_get_svg( array( 'icon' => 'arrow-down' ) ) . '</span>%title</span>',
                        'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'izabel' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'izabel' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . izabel_get_svg( array( 'icon' => 'arrow-down' ) ) . '</span></span>',
                    ) );
                }

                // End of the loop.
            endwhile;
            ?>
        </div><!-- .singular-content-wrap -->
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
