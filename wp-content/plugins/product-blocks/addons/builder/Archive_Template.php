<?php
defined( 'ABSPATH' ) || exit;

get_header();

do_action( 'wopb_before_content' );

$page_id = wopb_function()->conditions('return');

$width = get_post_meta($page_id, '__wopb_container_width', true);

if ($width) {
    echo '<div class="wopb-builder-container" style="max-width: '.$width.'px; margin: 0 auto;">';
}

if ($page_id) {
    if ( have_posts() ) :
        the_post();
        wopb_function()->content($page_id);
    endif;
}

if ($width) {
    echo '</div>';
}

do_action( 'wopb_after_content' );

get_footer();