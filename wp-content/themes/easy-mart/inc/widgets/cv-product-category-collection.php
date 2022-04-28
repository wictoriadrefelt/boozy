<?php
/**
 * Widget to show the content of Category Collection Product Section
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

class Easy_Mart_Products_Category_Collection extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname'                     => 'easy_mart_products_category_collection',
            'description'                   => __( 'Displays list of product categories.', 'easy-mart' ),
            'customize_selective_refresh'   => true,
        );
        parent::__construct( 'easy_mart_products_category_collection', __( 'EM: Product Category Collection ', 'easy-mart' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        	$fields[ 'section_heading' ] = array(
                'cv_widgets_name'         => 'section_heading',
                'cv_widgets_title'        => __( 'Displays Product Categories', 'easy-mart' ),
                'cv_widgets_field_type'   => 'heading'
            );

        	$fields[ 'section_title' ] = array(
                'cv_widgets_name'         => 'section_title',
                'cv_widgets_title'        => __( 'Section Title', 'easy-mart' ),
                'cv_widgets_description'  => __( 'Categories with thumbnail image are only shown.', 'easy-mart' ),
                'cv_widgets_default'      => __( 'Our Product Categories', 'easy-mart' ),
                'cv_widgets_field_type'   => 'text'
            );

            for( $i = 1; $i <= 4; $i++ ) {
                $fields[ 'coll_heading_' . $i ] = array(
                    'cv_widgets_name'         => 'coll_heading_'.$i,
                    'cv_widgets_title'        => __( 'Collection', 'easy-mart' ) . ' ' . $i,
                    'cv_widgets_field_type'   => 'heading'
                );
                $fields[ 'collection_cat_slug_' . $i ] = array(
                    'cv_widgets_name'         => 'collection_cat_slug_'.$i,
                    'cv_widgets_title'        => __( 'Select Category', 'easy-mart' ),
                    'cv_widgets_default'      => '',
                    'cv_widgets_field_type'   => 'cv_woo_category_dropdown'
                );
            }

            $fields[ 'no_of_column' ]  = array(
                'cv_widgets_name'         => 'no_of_column',
                'cv_widgets_title'        => __( 'No of Section Columns', 'easy-mart' ),
                'cv_widgets_default'      => 3,
                'cv_widgets_field_type'   => 'number',
                'cv_widget_number_limit'  => 4,  
            );

            $fields[ 'btn_text' ] = array(
                'cv_widgets_name'         => 'btn_text',
                'cv_widgets_title'        => __( 'Button Text', 'easy-mart' ),
                'cv_widgets_default'      => __( 'View All', 'easy-mart' ),
                'cv_widgets_field_type'   => 'text'
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
        $no_of_column = empty( $instance['no_of_column'] ) ? 3 : $instance['no_of_column'];
        $btn_text = empty( $instance['btn_text'] ) ? 'View All' : $instance['btn_text'];
    	echo $before_widget;
?>
	<div class="front-page-product-categories-section">
        <?php 
            if( !empty( $section_title ) ){ ?>
            <div class="section-title-wrap">
                <h2 class="section-title">
                    <?php echo esc_html( $section_title ); ?>
                </h2>
            </div> <!-- section-title-wrap -->
        <?php 
            } ?>       
        <div class="product-category <?php echo 'column-'.absint( $no_of_column ); ?>">
    		<?php 
            for( $i = 1; $i <= 4; $i++ ){
            $easy_mart_coll_cat_slug    = empty( $instance['collection_cat_slug_'.$i] ) ? '' : $instance['collection_cat_slug_'.$i];
            $easy_mart_cat_info = get_term_by( 'slug', $easy_mart_coll_cat_slug , 'product_cat' );
                if( !empty( $easy_mart_cat_info ) ) {
                    easy_mart_product_cat_sec( $easy_mart_cat_info, $btn_text ); 
                } 
            }
    		?>
        </div><!-- .product-category -->
	</div><!-- .front-page-product-categories-section -->
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
