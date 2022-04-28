<?php
/**
 * Widget to show the content of default category posts
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

class Easy_Mart_Default_Post_Category extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname'                     => 'easy_mart_default_post_category',
            'description'                   => __( 'Display Posts from specific category.', 'easy-mart' ),
            'customize_selective_refresh'   => true,
        );
        parent::__construct( 'easy_mart_default_post_category', __( 'EM: Default Post Category', 'easy-mart' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(
            
            'section_heading' => array(
                'cv_widgets_name'         => 'section_heading',
                'cv_widgets_title'        => __( 'Default Category', 'easy-mart' ),
                'cv_widgets_field_type'   => 'heading'
            ),

            'section_title' => array(
                'cv_widgets_name'         => 'section_title',
                'cv_widgets_title'        => __( 'Section Title', 'easy-mart' ),
                'cv_widgets_default'      => __( 'Our Recent News', 'easy-mart' ),
                'cv_widgets_field_type'   => 'text'
            ),

            'post_cat_type' => array(
                'cv_widgets_name'         => 'post_cat_type',
                'cv_widgets_title'        => __( 'Choose category', 'easy-mart' ),
                'cv_widgets_default'      => '',
                'cv_widgets_field_type'   => 'cv_category_dropdown'
            ),

            'post_count' => array(
                'cv_widgets_name'         => 'post_count',
                'cv_widgets_title'        => __( 'No. of posts to display', 'easy-mart' ),
                'cv_widgets_default'      => 2,
                'cv_widget_number_limit'  => 8,
                'cv_widgets_field_type'   => 'number'
            ),

            'column_count' => array(
                'cv_widgets_name'         => 'column_count',
                'cv_widgets_title'        => __( 'No of Section Columns', 'easy-mart' ),
                'cv_widgets_default'      => 2,
                'cv_widget_number_limit'  => 4,
                'cv_widgets_field_type'   => 'number'
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

        $section_title = empty( $instance['section_title'] ) ? '' : $instance['section_title']; 
        $post_cat_type = empty( $instance['post_cat_type'] ) ? '' : $instance['post_cat_type'];
        $post_count = empty( $instance['post_count'] ) ? 3 : $instance['post_count']; 
        $column_count = empty( $instance['column_count'] ) ? 2 : $instance['column_count'];
        echo $before_widget;
?>
    <div class="front-page-em-section">
        <?php
            if( !empty( $section_title ) ){
        ?>
            <div class="section-title-wrap">
                <h2 class="section-title">
                    <?php echo esc_html( $section_title ); ?>
                </h2>
            </div>
        <?php 
            }
            echo '<div class="section-post-content-wrap column-'.absint( $column_count ).'">';
            $post_args = array(
                'post_type' => 'post',
                'category_name' => esc_html( $post_cat_type ),
                'posts_per_page' => absint( $post_count )
            );
            $posts_query = new WP_Query( $post_args );
            if( $posts_query -> have_posts() ):
                while ( $posts_query -> have_posts() ): $posts_query -> the_post();
                    echo '<div class="post-content">';
                        get_template_part( 'template-parts/content', 'widgets' );
                    echo '</div><!-- .post-content -->';
                endwhile;
            endif;
            echo '</div><!-- .section-post-content-wrap -->';
        ?>
    </div><!-- .front-page-em-section -->
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
