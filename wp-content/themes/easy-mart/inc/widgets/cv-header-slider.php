<?php
/**
 * Widget to show the content of Header Slider
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

class Easy_Mart_Slider extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname'                     => 'easy_mart_slider',
            'description'                   => __( 'Display WooCommerce products or a posts from selected category as a slider.', 'easy-mart' ),
            'customize_selective_refresh'   => true,
        );
        parent::__construct( 'easy_mart_slider', __( 'EM: Slider', 'easy-mart' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
    	if( class_exists( 'WooCommerce' ) ) {
            $radio_type = array(
                        'post' => __( 'Default Posts','easy-mart' ),
                        'product' => __( 'WooCommerce Product', 'easy-mart' )
                    );
        } else {
            $radio_type = array(
                        'post' => __( 'Default Posts','easy-mart' )
                    );
        }

        $fields = array(

        	'slider_section' => array(
                'cv_widgets_name'         => 'slider_section',
                'cv_widgets_title'        => __( 'Slider Section', 'easy-mart' ),
                'cv_widgets_field_type'   => 'heading'
            ),

            'slider_post_type' => array(
                'cv_widgets_name'         => 'slider_post_type',
                'cv_widgets_title'        => __( 'Slider Post type', 'easy-mart' ),
                'cv_widgets_class'        => 'cv-slider-radio',
                'cv_widgets_field_type'   => 'radio',
                'cv_widgets_default'      =>'post',
                'cv_widgets_field_options'=> $radio_type
            ),

            'slider_default_cat_slug' => array(
                'cv_widgets_name'         => 'slider_default_cat_slug',
                'cv_widgets_title'        => __( 'Default Category', 'easy-mart' ),
                'cv_widgets_field_type'   => 'cv_category_dropdown',
            ),

            'slider_woo_cat_slug' => array(
                'cv_widgets_name'         => 'slider_woo_cat_slug',
                'cv_widgets_title'        => __( 'Products Category', 'easy-mart' ),
                'cv_widgets_field_type'   => 'cv_woo_category_dropdown',
            ),

            'slide_post_count' => array(
                'cv_widgets_name'         => 'slide_post_count',
                'cv_widgets_title'        => __( 'No. of posts to display', 'easy-mart' ),
                'cv_widgets_default'      => '3',
                'cv_widget_number_limit'  => '20',
                'cv_widgets_field_type'   => 'number'
            ),

            'slide_btn_text' => array(
                'cv_widgets_name'         => 'slide_btn_text',
                'cv_widgets_title'        => __( 'Slide button text', 'easy-mart' ),
                'cv_widgets_default'      => __( 'View Shop', 'easy-mart' ),
                'cv_widgets_field_type'   => 'text'
            ),

            'right_slider_section' => array(
                'cv_widgets_name'         => 'right_slider_section',
                'cv_widgets_title'        => __( 'Right Slider Section', 'easy-mart' ),
                'cv_widgets_field_type'   => 'heading'
            ),

            'right_slider_opt' => array(
                'cv_widgets_name'         => 'right_slider_opt',
                'cv_widgets_title'        => __( 'Check To Show Featured Products.', 'easy-mart' ),
                'cv_widgets_default'      => 1,
                'cv_widgets_field_type'   => 'checkbox'
            ),
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $em_slider_post_type = empty( $instance['slider_post_type'] ) ? 'post' : $instance['slider_post_type'];
        $slider_default_cat_slug   = empty( $instance['slider_default_cat_slug'] ) ? '' : $instance['slider_default_cat_slug'];
        $slider_woo_cat_slug   = empty( $instance['slider_woo_cat_slug'] ) ? '' : $instance['slider_woo_cat_slug'];
        $em_slide_post_count  = empty( $instance['slide_post_count'] ) ? '3' : $instance['slide_post_count'];
        $em_slide_btn_text    = empty( $instance['slide_btn_text'] ) ? '' : $instance['slide_btn_text'];
        $right_slider_opt     = empty( $instance['right_slider_opt'] ) ? null : $instance['right_slider_opt'];
    	echo $before_widget;
?>
	<div class="front-page-slider-wrap <?php if( true == $right_slider_opt ){ echo 'left-column'; } else{ echo 'no-featured-product-slider'; } ?>">
                <div class="front-page-slider-block">
                    <div class="front-page-slider">
                    <?php
                        if( class_exists( 'WooCommerce' ) && esc_html( $em_slider_post_type ) == 'product'  ){
                            $args = array(
                                'product_cat'    =>  esc_attr( $slider_woo_cat_slug ), 
                                'meta_key'     => '_thumbnail_id',
                                'posts_per_page' => absint( $em_slide_post_count ) 
                            );
                        }
                        else {
                            $args = array(
                                'category_name'    => esc_attr( $slider_default_cat_slug ), 
                                'meta_key'     => '_thumbnail_id',
                                'posts_per_page' => absint( $em_slide_post_count ) 
                            );
                        }
                        $post_query = new WP_Query( $args );
                        if( $post_query->have_posts() ):
                            while ( $post_query-> have_posts()): $post_query -> the_post();?>
                                <div class="slider-content">
                                    <figure class="thumb-image">
                                        <img src="<?php the_post_thumbnail_url(); ?>">
                                    </figure>
                                    <div class="slider-title-btn-wrap">
                                    <h2 class="slider-title">
                                        <?php the_title(); ?>
                                    </h2>
                                    <a class="slider-btn" href="<?php the_permalink(); ?>"><?php echo esc_html( $em_slide_btn_text ); ?></a>
                                </div>
                                </div>  
                    <?php 
                            endwhile;
                        endif;
                    ?>
                    </div><!-- .front-page-slider -->
                </div> <!-- front page slider block -->
            <?php 
            apply_filters( 'easy_mart_slider', $right_slider_opt ); ?>
	</div><!-- .front-page-slider-wrap -->
<?php
    	echo $after_widget;
    }


    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    easy_mart_widgets_updated_field_value()      defined in cv-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$cv_widgets_name] = easy_mart_widgets_updated_field_value( $widget_field, $new_instance[$cv_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    easy_mart_widgets_show_widget_field()        defined in cv-widget-fields.php
     */
    public function form( $instance ) {

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );

            if ( empty( $instance ) && isset( $cv_widgets_default ) ) {
                $cv_widgets_field_value = $cv_widgets_default;
            } elseif( empty( $instance ) ) {
                $cv_widgets_field_value = '';
            } else {
                $cv_widgets_field_value = wp_kses_post( $instance[$cv_widgets_name] );
            }
            easy_mart_widgets_show_widget_field( $this, $widget_field, $cv_widgets_field_value );
        }
    }

}
