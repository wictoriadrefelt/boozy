<?php
/**
 * Define custom fields for widgets
 * 
 * @package Code Vibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 */

function easy_mart_widgets_show_widget_field( $instance = '', $widget_field = '', $cv_widget_field_value = '' ){

	extract( $widget_field );

	switch( $cv_widgets_field_type ){
		
		// text field
		case 'text':
		?>
			 <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>"><?php echo esc_html( $cv_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $cv_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $cv_widget_field_value ); ?>" />

                <?php if ( isset( $cv_widgets_description ) ) { ?>
                    <br />
                    <small><em><?php echo esc_html( $cv_widgets_description ); ?></em></small>
                <?php } ?>
            </p>
		<?php
		break;

         /**
         * checkbox
         */
        case 'checkbox' :
        ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $cv_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked( '1', $cv_widget_field_value ); ?>/>
                <label for="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>"><?php echo esc_html( $cv_widgets_title ); ?></label>

                <?php if ( isset( $cv_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $cv_widgets_description ); ?></em>
                <?php } ?>
            </p>
            <?php
            break;

         /**
         * select field
         */
        case 'select' :
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>"><?php echo esc_html( $cv_widgets_title ); ?>:</label>
                <select name="<?php echo esc_attr( $instance->get_field_name( $cv_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>" class="widefat">
                    <?php foreach ( $cv_widgets_field_options as $select_option_name => $select_option_title ) { ?>
                        <option value="<?php echo esc_attr( $select_option_name ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $select_option_name ) ); ?>" <?php selected( $select_option_name, $cv_widget_field_value ); ?>><?php echo esc_html( $select_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $cv_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $cv_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

		case 'cv_category_dropdown':
			$select_field = 'name="'. esc_attr( $instance->get_field_name( $cv_widgets_name ) ) .'" id="'. esc_attr( $instance->get_field_id( $cv_widgets_name ) ) .'" class="widefat"';
    	?>
    		<p class="post-cat">
    			<label for="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>" >
    				<?php echo esc_html( $cv_widgets_title ); ?>:
    			</label>
    			<?php 	
    			$categories_args = wp_parse_args( array(
                        'taxonomy'          => 'category',
                        'show_option_none'  => __( '- - Select Category - -', 'easy-mart' ),
                        'selected'          => esc_attr( $cv_widget_field_value ),
                        'show_option_all'   => '',
                        'orderby'           => 'id',
                        'order'             => 'ASC',
                        'show_count'        => 0,
                        'hide_empty'        => 1,
                        'child_of'          => 0,
                        'exclude'           => '',
                        'hierarchical'      => 1,
                        'depth'             => 0,
                        'tab_index'         => 0,
                        'hide_if_empty'     => false,
                        'option_none_value' => 0,
                        'value_field'       => 'slug',
                    ) ); 

    			 	$categories_args['echo'] = false;

                    $dropdown = wp_dropdown_categories( $categories_args );
                    $dropdown = str_replace( '<select', '<select ' . $select_field, $dropdown );
                    echo $dropdown;
                ?>
    		</p>

		<?php 
			break;

			case 'cv_woo_category_dropdown':
			$select_field = 'name="'. esc_attr( $instance->get_field_name( $cv_widgets_name ) ) .'" id="'. esc_attr( $instance->get_field_id( $cv_widgets_name ) ) .'" class="widefat"';
    	?>
    		<p class="product-cat">
    			<label for="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>" >
    				<?php echo esc_html( $cv_widgets_title ); ?>:
    			</label>
    			<?php 	
    			$categories_args = wp_parse_args( array(
                        'taxonomy'          => 'product_cat',
                        'show_option_none'  => __( '- - Select Category - -', 'easy-mart' ),
                        'selected'          => esc_attr( $cv_widget_field_value ),
                        'show_option_all'   => '',
                        'orderby'           => 'id',
                        'order'             => 'ASC',
                        'show_count'        => 0,
                        'hide_empty'        => 1,
                        'child_of'          => 0,
                        'exclude'           => '',
                        'hierarchical'      => 1,
                        'depth'             => 0,
                        'tab_index'         => 0,
                        'hide_if_empty'     => false,
                        'option_none_value' => '',
                        'value_field'       => 'slug',
                    ) ); 

    			 	$categories_args['echo'] = false;

                    $dropdown = wp_dropdown_categories( $categories_args );
                    $dropdown = str_replace( '<select', '<select ' . $select_field, $dropdown );
                    echo $dropdown;
                ?>
    		</p>

		<?php 
			break;

        case 'cv_slider_category_dropdown':
            $select_field = 'name="'. esc_attr( $instance->get_field_name( $cv_widgets_name ) ) .'" id="'. esc_attr( $instance->get_field_id( $cv_widgets_name ) ) .'" class="widefat"';
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>" >
                    <?php echo esc_html( $cv_widgets_title ); ?>:
                </label>
                <?php   
                    $categories_args = wp_parse_args( array(
                        'taxonomy'          => 'category',
                        'show_option_none'  => __( '- - Select Category - -', 'easy-mart' ),
                        'selected'          => esc_attr( $cv_widget_field_value ),
                        'show_option_all'   => '',
                        'orderby'           => 'id',
                        'order'             => 'ASC',
                        'show_count'        => 0,
                        'hide_empty'        => 1,
                        'child_of'          => 0,
                        'exclude'           => '',
                        'hierarchical'      => 1,
                        'depth'             => 0,
                        'tab_index'         => 0,
                        'hide_if_empty'     => false,
                        'option_none_value' => 0,
                        'value_field'       => 'slug',
                    ) );

                    if( class_exists( 'WooCommerce' ) ) {
                        $categories_args['taxonomy'] = 'product_cat';
                    }

                    $categories_args['echo'] = false;

                    $dropdown = wp_dropdown_categories( $categories_args );
                    $dropdown = str_replace( '<select', '<select ' . $select_field, $dropdown );
                    echo $dropdown;
                ?>
            </p>

        <?php 
            break;

        // number
        case 'number' :
        if( empty( $cv_widget_field_value ) ){
            $cv_widget_field_value = $cv_widgets_default;
        }
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>"><?php echo esc_html( $cv_widgets_title ); ?>:</label>
                  <input name="<?php echo esc_attr( $instance->get_field_name( $cv_widgets_name ) ); ?>" type="number" step="1" min="1" <?php if( !empty( $cv_widget_number_limit ) ){ echo 'max='.absint( $cv_widget_number_limit ); } ?> id="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>" value="<?php echo absint( $cv_widget_field_value ); ?>" class="small-text" />

                <?php if ( isset( $cv_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $cv_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * Radio fields
        */    
        case 'radio' :
            if( empty( $cv_widget_field_value ) ) {
                $cv_widget_field_value = $cv_widgets_default;
            }
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $cv_widgets_name ) ); ?>"><?php echo esc_html( $cv_widgets_title ); ?>:</label>
                <div id="cv-radio" class="radio-wrapper">
                    <?php
                        foreach ( $cv_widgets_field_options as $cv_option_name => $cv_option_title ) {
                    ?>
                        <input id="<?php echo esc_attr( $instance->get_field_id( $cv_option_name ) ); ?>" class="<?php echo esc_attr( $cv_widgets_class ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $cv_widgets_name ) ); ?>" type="radio" value="<?php echo esc_html( $cv_option_name ); ?>" <?php checked( $cv_option_name, $cv_widget_field_value ); ?> />
                        <label for="<?php echo esc_attr( $instance->get_field_id( $cv_option_name ) ); ?>"><?php echo esc_html( $cv_option_title ); ?></label>
                    <?php } ?>
                </div>

                <?php if ( isset( $cv_widgets_description ) ) { ?>
                    <small><?php echo esc_html( $cv_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        /**
         * selector widget field
         */
        case 'selector':
            if( empty( $cv_widget_field_value ) ) {
                $cv_widget_field_value = $cv_widgets_default;
            }
        ?>
            <p><span class="field-label"><label class="field-title"><?php echo esc_html( $cv_widgets_title ); ?></label></span></p>
        <?php            
            echo '<div class="selector-labels">';
            foreach ( $cv_widgets_field_options as $key => $value ){
                $img_path = $value['img_path'];
                $class = ( $cv_widget_field_value == $key ) ? 'selector-selected': '';
                echo '<label class="'. esc_attr( $class ) .'" data-val="'. esc_attr( $key ) .'">';
                echo '<img src="'. esc_url( $value['img_path'] ) .'" title="'. esc_attr( $value['label'] ) .'" alt="'. esc_attr( $value['label'] ) .'"/>';
                echo '</label>';
            }
            echo '</div>';
            echo '<input data-default="'. esc_attr( $cv_widget_field_value ) .'" type="hidden" value="'. esc_attr( $cv_widget_field_value ) .'" name="'. esc_attr( $instance->get_field_name( $cv_widgets_name ) ) .'"/>';
            break;         

		// heading
        case 'heading':
        ?>
            <h4 class="field-heading"><span class="field-label"><strong><?php echo esc_html( $cv_widgets_title ); ?></strong></span></h4>
        <?php
            break;
	}
}

function easy_mart_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );

    if ( $cv_widgets_field_type == 'number') {
        return absint( $new_field_value );
    } else {
        return sanitize_text_field( $new_field_value );
    }
}