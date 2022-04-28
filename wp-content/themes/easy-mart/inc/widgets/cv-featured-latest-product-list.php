<?php
/**
 * Widget to show the content of Featured Section
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

class Easy_Mart_Featured_Latest_Product_List extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname'                     => 'easy_mart_featured_latest_product_list',
            'description'                   => __( 'Display WooCommerce products lists from chosen category type featured/latest.', 'easy-mart' ),
            'customize_selective_refresh'   => true,
        );
        parent::__construct( 'easy_mart_featured_latest_product_list', __( 'EM: Featured/Latest Products', 'easy-mart' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(
            
            'section_heading' => array(
                'cv_widgets_name'         => 'section_heading',
                'cv_widgets_title'        => __( 'Displays Woocommerce Products', 'easy-mart' ),
                'cv_widgets_field_type'   => 'heading'
            ),

            'section_title' => array(
                'cv_widgets_name'         => 'section_title',
                'cv_widgets_title'        => __( 'Section Title', 'easy-mart' ),
                'cv_widgets_default'      => __( 'Featured Products', 'easy-mart' ),
                'cv_widgets_field_type'   => 'text'
            ),

            'section_products_type' => array(
                'cv_widgets_name'         => 'section_products_type',
                'cv_widgets_title'        => __( 'Choose product type', 'easy-mart' ),
                'cv_widgets_class'        => '',
                'cv_widgets_default'      => __( 'featured', 'easy-mart' ),
                'cv_widgets_field_type'   => 'radio',
                'cv_widgets_field_options' => array( 
                                                'latest' => __( 'Latest Products', 'easy-mart' ),
                                                'featured' => __( 'Featured Products', 'easy-mart' ), 
                                            )
            ),

            'product_count' => array(
                'cv_widgets_name'         => 'product_count',
                'cv_widgets_title'        => __( 'No. of products to display', 'easy-mart' ),
                'cv_widgets_default'      => 3,
                'cv_widget_number_limit'  => 8,
                'cv_widgets_field_type'   => 'number'
            ),

            'column_count' => array(
                'cv_widgets_name'         => 'column_count',
                'cv_widgets_title'        => __( 'No of Section Columns', 'easy-mart' ),
                'cv_widgets_default'      => 3,
                'cv_widget_number_limit'  => 4,
                'cv_widgets_field_type'   => 'number'
            ),

             'section_layout' => array(
                'cv_widgets_name'         => 'section_layout',
                'cv_widgets_title'=> __( 'Section Layouts', 'easy-mart' ),
                'cv_widgets_default'      => 'grid-view',
                'cv_widgets_field_type'   => 'selector',
                'cv_widgets_field_options' => array(
                    'list-view'  => array(
                        'label'     => esc_html__( 'List View', 'easy-mart' ),
                        'img_path'  => get_template_directory_uri() . '/assets/images/list-type.png'
                    ),
                    'grid-view'  => array(
                        'label'     => esc_html__( 'Layout 2', 'easy-mart' ),
                        'img_path'  => get_template_directory_uri() . '/assets/images/grid-type.png'
                    )
                )
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
        $product_count = empty( $instance['product_count'] ) ? 3 : $instance['product_count'];  
        $section_products_type = empty( $instance['section_products_type'] ) ? 'featured' : $instance['section_products_type'];
        $column_count = empty( $instance['column_count'] ) ? 3 : $instance['column_count'];
        $section_layout = empty( $instance['section_layout'] ) ? 'grid-view' : $instance['section_layout'];
        echo $before_widget;
?>
    <div class="front-page-em-section">
        <?php if( !empty( $section_title ) ){ ?>
            <div class="section-title-wrap">
                <h2 class="section-title">
                    <?php echo esc_html( $section_title ); ?>
                </h2>
            </div>
        <?php 
        }   
            echo '<div class="section-product-content-wrap column-'.absint( $column_count ).' '.esc_html( $section_layout ).'">';
            if( 'featured' == esc_html( $section_products_type ) ){
                $product_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => absint( $product_count ),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'post_status'   => 'publish',
                            'terms'    => 'featured',
                        ),
                    ),
                );
            } else {
                $product_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => absint( $product_count )
                );
            }
            $woo_products_query = new WP_Query( $product_args );
            if( $woo_products_query -> have_posts() ):
                while ( $woo_products_query -> have_posts() ): $woo_products_query -> the_post();
                    echo '<div class="product-content">';
                        if( $section_layout == 'list-view' ){
                            get_template_part( 'template-parts/woocommerce/content', 'product' );
                        }else{
                            wc_get_template_part( 'content', 'product' );
                        }
                    echo '</div><!-- .product-content -->';
                endwhile; endif;
                echo '</div><!-- .section-product-content-wrap -->';
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
