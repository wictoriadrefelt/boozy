<?php 
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package CodeVibrant
 * @subpackage Easy Mart
 * @since 1.0.0
 *
 */
/*--------------------------------------------------------------------------------------------------------------------------------*/
if( ! function_exists( 'easy_mart_header_ticker_section' ) ) :

    /** 
     * Header Ticker section function
     *
     */
    function easy_mart_header_ticker_section() {
    	$ticker_opt = get_theme_mod( 'ticker_display_opt', false );
    	if( false == $ticker_opt ){
    		return;
    	}

    	$ticker_caption = get_theme_mod( 'ticker_caption', 'Announcement' );
    	$ticker_item_txt = get_theme_mod( 'ticker_item_txt', '' ); 
?>
    	<div class="em-ticker-section">
    		<?php if( !empty( $ticker_caption ) ){ ?>
    			<h3 class="ticker-title"> <i class="fa fa-bullhorn"> </i><?php echo esc_html( $ticker_caption ); ?></h3>
    		<?php 
    		  } 
    		  if( !empty( $ticker_item_txt ) ){
            ?>
    			<div class="ticker-content">
    				<span class="ticker-item"><?php echo wp_kses_post( $ticker_item_txt ); ?></span><!-- .ticker-item -->
    			</div><!-- .ticker-content -->
    		<?php 
    			}
            ?>	
    	</div><!-- .em-ticker-section -->
<?php	
    }

endif;
/*-------------------------------------------------------------------------------------------------------------------------------------------*/

if( !function_exists( 'easy_mart_front_page_top_section' ) ):

    /**
     * Function to display header top section
     */	
    function easy_mart_front_page_top_section(){
        if( !is_active_sidebar( 'frontpage_top_section' ) ){
        	return;
        }
        echo '<div class="frontpage-top-section">';
    		dynamic_sidebar( 'frontpage_top_section' );
    	echo '</div><!-- .frontpage-top-section -->';
    }

endif;

/*-------------------------------------------------------------------------------------------------------------------------------------------*/
if( !function_exists( 'easy_mart_front_page_middle_section_wrapper_start' ) ):

    /**
     * Function to display middle section wrapper start
     */	
    function easy_mart_front_page_middle_section_wrapper_start(){
    	if( !is_active_sidebar( 'front_page_middle_section_area' ) ){
        	return;
        }
    	echo '<div class="site-middle-section-wrapper clearfix">';
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------------------------*/
if( !function_exists( 'easy_mart_front_page_middle_content_display' ) ):

    /**
     * Function to display middle section content
     */	
    function easy_mart_front_page_middle_content_display(){

    	if( !is_active_sidebar( 'front_page_middle_section_area' ) ){
        	return;
        }
    	echo '<div class="site-middle-section">';
    		dynamic_sidebar( 'front_page_middle_section_area' );
    	echo '</div><!-- .site-middle-section -->';
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------------------------*/
if( !function_exists( 'easy_mart_front_page_middle_sidebar' ) ):
    
    /**
     * Function to display middle section sidebar
     */	
    function easy_mart_front_page_middle_sidebar(){

    	if( !is_active_sidebar( 'front_page_middle_section_sidebar' ) ){
        	return;
        }
    	echo '<div class="site-middle-sidebar-section">';
    		dynamic_sidebar( 'front_page_middle_section_sidebar' );
    	echo '</div><!-- .site-middle-sidebar-section -->';
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------------------------*/
if( !function_exists( 'easy_mart_front_page_middle_section_wrapper_end' ) ):
    
    /**
     * Function to display middle section wrapper end
     */	
    function easy_mart_front_page_middle_section_wrapper_end(){
    	if( !is_active_sidebar( 'front_page_middle_section_area' ) ){
        	return;
        }
    	echo '</div><!-- .site-middle-section-wrapper -->';
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------------------------*/
if( !function_exists( 'easy_mart_front_page_bottom_content' ) ):

    /**
     * Function to display bottom section content
     */	
    function easy_mart_front_page_bottom_content(){
    	if( !is_active_sidebar( 'front_page_bottom_section_area' ) ){
        	return;
        }
    	echo '<div class="site-bottom-section">';
    		dynamic_sidebar( 'front_page_bottom_section_area' );
    	echo '</div><!-- .site-bottom-section -->';
    }
    
endif;	

/*------------------------------------------------------------------------------------------------------------------------------------------*/
add_action( 'easy_mart_front_page_sections', 'easy_mart_header_ticker_section', 5 );
add_action( 'easy_mart_front_page_sections', 'easy_mart_front_page_top_section', 10 );
add_action( 'easy_mart_front_page_sections', 'easy_mart_front_page_middle_section_wrapper_start', 20 );
add_action( 'easy_mart_front_page_sections', 'easy_mart_front_page_middle_content_display', 30 );
add_action( 'easy_mart_front_page_sections', 'easy_mart_front_page_middle_sidebar', 40 );
add_action( 'easy_mart_front_page_sections', 'easy_mart_front_page_middle_section_wrapper_end', 50 );
add_action( 'easy_mart_front_page_sections', 'easy_mart_front_page_bottom_content', 60 );