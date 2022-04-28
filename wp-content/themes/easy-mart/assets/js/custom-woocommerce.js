jQuery(document).ready(function($) {

    "use strict";  

	/**
    * Update wishlist on header
    *  
    */ 
   $(document).on( 'added_to_wishlist removed_from_wishlist', function(){
	var counter = $('.cv-whishlist .cv-wl-counter');
	
	$.ajax({
		url: yith_wcwl_l10n.ajax_url,
		data: {
		action: 'easy_mart_wcwl_update_wishlist_count'
		},
		dataType: 'json',
		success: function( data ){
			counter.html( data.count );
		},
		beforeSend: function(){
			counter.block();
		},
		complete: function(){
			counter.unblock();
		}
	})
} );

	$( "li .add_to_cart_button" ).html( '<i class="fa fa-shopping-cart"></i>' );
	
});	