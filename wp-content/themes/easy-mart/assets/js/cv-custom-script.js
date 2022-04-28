jQuery(document).ready(function($) {

    "use strict";    

    /*
     * Sticky menu script
     */
    $(function(){
        var shrinkHeader = 170;
        var wpAdminBar = $('#wpadminbar');
        var wpAdminBarHeight = $('#wpadminbar').height();
        if(wpAdminBar.length) {
            $('.header_sticky').css('top',wpAdminBarHeight+'px');
        }
        $(window).scroll(function() {
            var scroll = getCurrentScroll();
            if ( scroll >= shrinkHeader ) {
                $('.header_sticky').addClass('shrink');
            } else {
                $('.header_sticky').removeClass('shrink');
            }
        });
        function getCurrentScroll() {
            return window.pageYOffset || document.documentElement.scrollTop;
        }
    });
    
    /**
     * Category menu toggle dropdown scripts
     *
     *
     */ 
    $('.categories-title').click( function() {
        $(this).next('.category-dropdown').slideToggle('slow');
    } );

    /**
     * Left Slider for header sections
     *
     */
    $(".front-page-slider").lightSlider({
        item: 1,
        autoWidth: false,
        adaptiveHeight: true,
        loop: true,
        pager: false,
        controls: true,
        slideMargin: 0,
        auto: true,
        pause: 8000,
        speed: 3000,
        prevHtml : '<i class="fa fa-angle-left"> </i>',
        nextHtml : '<i class="fa fa-angle-right"> </i>',
        onSliderLoad: function() {
            $('.front-page-slider').removeClass('cS-hidden');
        }
    });

     /**
     * Right Slider for header sections
     *
     */
    $(".em-right-slider").lightSlider({
        item: 1,
        autoWidth: false,
        loop: true,
        adaptiveHeight: true,
        controls: false,
        pager: false,
    });

    /* 
     * Scroll To Top
     */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1000) {
            $('.em-scroll-up').fadeIn('slow');
        } else {
            $('.em-scroll-up').fadeOut('slow');
        }
    });

    $('.em-scroll-up').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    
    //responsive menu toggle
    $('#masthead .menu-toggle').click(function(event) {
        $('#masthead #site-navigation').toggleClass('menu-activate');
    });
    
    $('#masthead #site-navigation .menu-close').click(function(event) {
        $('#masthead #site-navigation').removeClass('menu-activate');
    });

    //responsive sub menu toggle
    $('#site-navigation .menu-item-has-children, #site-navigation .page_item_has_children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

    $('#site-navigation .sub-toggle').click(function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
        $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
    }); 

});