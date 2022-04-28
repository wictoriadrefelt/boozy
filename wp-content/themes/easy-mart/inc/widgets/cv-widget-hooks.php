<?php 
/**
 * Widgets Hooks for easy mart front page sections 
 * 
 * @package Code Vibrant
 * @package Easy Mart
 * @since 1.0.0
 */

if ( !function_exists( 'easy_mart_right_slider' ) ):

	add_filter( 'easy_mart_slider', 'easy_mart_right_slider', 10, 1 );

	/**
	 * Front Page Header Right Slider Function
	 *
	 *
	 */
	function easy_mart_right_slider( $right_slider_opt ){
		if( false == $right_slider_opt ){
			return;
		}
?>
		<div class="em-right-slider-wrapper">
			<div class="em-right-slider right-column">
			<?php 
				$featured_product_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                            array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'name',
                                'post_status'   => 'publish',
                                'terms'    => 'featured',
                            ),
                        ),
                    );
		        $woo_products_query = new WP_Query( $featured_product_args );
		        if( $woo_products_query -> have_posts() ):
		            while ( $woo_products_query -> have_posts() ): $woo_products_query -> the_post();
		    ?>
		                <div class="right-slider-featured-product-content">
		                    <?php  wc_get_template_part( 'content', 'product' );
		                    woocommerce_template_loop_add_to_cart(); ?>
		                </div><!-- .right-slider-featured-product-content -->
		    <?php
		        	endwhile;
		        	wp_reset_postdata();
		        endif;
			?>
				</div><!-- .em-right-slider -->
		</div><!-- .em-right-slider-wrapper -->
<?php
	}

endif;

/*--------------------------------------------------------------------------------------------------------*/
if ( !function_exists( 'easy_mart_product_cat_sec' ) ):

	/**
	 * Front Page Product Categories
	 */
	function easy_mart_product_cat_sec( $category, $btn_text ){
		$cat_name = $category->name;
	    $cat_slug = $category->slug;
	    $cat_id = $category->term_id;
	    $thumbnail_id = get_term_meta( $cat_id, 'thumbnail_id', true );
	    if( empty( $thumbnail_id ) ){
	    	return;
	    }
?>
	    <div class="category-content">
			<?php 
			$cat_link = get_term_link( $cat_id, 'product_cat' );
	        if( !empty( $thumbnail_id ) ){ ?>
	            <figure class="category-thumb">
	                <a href="<?php echo esc_url( $cat_link ); ?>"><?php echo wp_get_attachment_image( $thumbnail_id , 'large' ); ?></a>
	            </figure>
	        <div class="category-title-btn-wrap"> 
		        <h2 class="category-title">
			        <a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name );?></a>
			    </h2>
		        <?php }
		        if( !empty( $btn_text ) ){ ?>
		            <a class="category-btn" href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $btn_text ); ?></a>
		        <?php } ?>
		     </div> <!-- category-title-btn-wrap -->
	    </div><!-- .category-content -->
<?php
	}
	
endif;