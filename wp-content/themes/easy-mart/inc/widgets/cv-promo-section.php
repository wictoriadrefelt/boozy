<?php
/**
 * Widget to show the content of Promo Section
 *
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

class Easy_Mart_Promo_Section extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname'                     => 'easy_mart_promo_content',
            'description'                   => __( 'Displays promo section content.', 'easy-mart' ),
            'customize_selective_refresh'   => true,
        );
        parent::__construct( 'easy_mart_promo_content', __( 'EM: Promo Section', 'easy-mart' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(

        	'promo_section' => array(
                'cv_widgets_name'         => 'promo_section',
                'cv_widgets_title'        => __( 'This section is customized from customizer.', 'easy-mart' ),
                'cv_widgets_field_type'   => 'heading'
            ),

            'section_title' => array(
                'cv_widgets_name'         => 'section_title',
                'cv_widgets_title'        => __( 'Section Title.', 'easy-mart' ),
                'cv_widgets_default'      => __( 'PROMO', 'easy-mart' ),
                'cv_widgets_field_type'   => 'text'
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
    	echo $before_widget;
       
?>
	<div class="front-page-promo-section">
      <?php 
            if( !empty( $section_title ) ){ ?>
                <div class="section-title-wrap">
                    <h2 class="section-title">
                        <?php echo esc_html( $section_title ); ?>
                    </h2>
                </div>
            <?php }
        ?>
        <div class="promo-icon-title-wrap">    
        <?php 
            $default_promo = array(
                array(
                    'promo_icon' => 'fa-apple',
                    'promo_title'  => __( 'Free Delivery', 'easy-mart' ),
                ),
                array(
                    'promo_icon' => 'fa-apple',
                    'promo_title'  => __( 'Free Shipping', 'easy-mart' ),
                ),
            );
            $promo_sec = get_theme_mod( 'promo_sec_repeater', $default_promo );
            foreach ( $promo_sec as $promo_sec_opt ) {
        ?>
                <div class="promo-icon-title-block">
                    <div class="promo-icon"> <i class="fa <?php echo esc_html( $promo_sec_opt['promo_icon'] ) ?>"></i> </div>
                    <h3 class="promo-title"><?php echo esc_html( $promo_sec_opt['promo_title'] ); ?></h3>
                </div>
        <?php 
            }
        ?> 
        </div> <!-- promo-icon-title-wrap -->
	</div><!-- .front-page-promo-section -->
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
