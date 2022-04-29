(function($) {
    'use strict';


    // ----------------------------
    // ----------------------------
    // ----------------------------
    $('.wopb-builder-slider-for').each(function () {
        const that = $(this)
        that.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            dots: false,
            infinite: true,
            asNavFor: '.wopb-builder-slider-nav',
            arrows: that.data('arrow') == 1 ? true : false,
            prevArrow: '<div class="wopb-slick-prev-large"><svg enable-background="new 0 0 477.175 477.175" version="1.1" viewBox="0 0 477.18 477.18"><path d="m145.19 238.58 215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"></path></svg></div>',
            nextArrow: '<div class="wopb-slick-next-large"><svg enable-background="new 0 0 477.175 477.175" version="1.1" viewBox="0 0 477.18 477.18"><path d="m360.73 229.08-225.1-225.1c-5.3-5.3-13.8-5.3-19.1 0s-5.3 13.8 0 19.1l215.5 215.5-215.5 215.5c-5.3 5.3-5.3 13.8 0 19.1 2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4l225.1-225.1c5.3-5.2 5.3-13.8 0.1-19z"/></svg></div>',
        });
    });
    
    $('.wopb-builder-slider-nav').each(function () {
        const that = $(this)
        const vertical = (that.data('position') == 'left' || that.data('position') == 'right') ? true : false
        that.slick({
            slidesToShow: Number(that.data('collg')),
            vertical: vertical,
            asNavFor: '.wopb-builder-slider-for',
            focusOnSelect: true,
            dots: false,
            pauseOnHover: true,
            verticalSwiping:true,
            infinite: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        vertical: false,
                        slidesToShow: Number(that.data('colmd'))
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        vertical: false,
                        slidesToShow: Number(that.data('colsm'))
                    }
                },
                {
                    breakpoint: 580,
                    settings: {
                        vertical: false,
                        slidesToShow: Number(that.data('colxs'))
                    }
                },
            ],
            arrows: that.data('arrow') == 1 ? true : false,
            prevArrow: '<div class="wopb-slick-prev-nav"><svg viewBox="0 0 492 287" xmlns="http://www.w3.org/2000/svg"><path transform="translate(0 -.96)" d="m485.97 252.68-224.38-245.85c-4.2857-4.3102-9.9871-6.1367-15.585-5.8494-5.6186-0.28724-11.3 1.5392-15.586 5.8494l-224.4 245.85c-8.0384 8.0653-8.0384 21.159 0 29.225s21.081 8.0653 29.12 0l210.86-231.05 210.84 231.05c8.0384 8.0653 21.08 8.0653 29.119 0 8.0384-8.0645 8.0384-21.159 0-29.225z"/></svg></div>',
            nextArrow: '<div class="wopb-slick-next-nav"><svg viewBox="0 0 492 287" xmlns="http://www.w3.org/2000/svg"><path transform="translate(0 -.96)" d="m485.97 252.68-224.38-245.85c-4.2857-4.3102-9.9871-6.1367-15.585-5.8494-5.6186-0.28724-11.3 1.5392-15.586 5.8494l-224.4 245.85c-8.0384 8.0653-8.0384 21.159 0 29.225s21.081 8.0653 29.12 0l210.86-231.05 210.84 231.05c8.0384 8.0653 21.08 8.0653 29.119 0 8.0384-8.0645 8.0384-21.159 0-29.225z"/></svg></div>',
        });

        that.on('mouseenter', '.slick-slide', function (e) {
            if ($(this).closest('.wopb-builder-slider-nav').data('view') == 1) {
                const index = $(e.currentTarget).data('slick-index'),
                    slickObj = that.slick('getSlick');
                slickObj.slickGoTo(index);
            }
        });

    });


    $(document).on('click', '.wopb-product-zoom', function(e){
        e.preventDefault();

        $('.wopb-builder-slider-for .slick-slide').trigger('zoom.destroy'); // remove zoom

        const pswpElement = $( '.pswp' )[0],
              options = { index: $('.wopb-builder-slider-for .slick-current').attr('data-slick-index') };

        let items = [];
        $('.wopb-builder-slider-for .slick-slide img').each(function(i, obj) {
            items.push({
                alt : $(obj).attr('alt'),
                src : $(obj).attr('src'),
                w : $(obj).data('width'),
                h : $(obj).data('height'),
            });
        });

        var photoswipe = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );
        photoswipe.init(); 
        photoswipe.options.escKey = true;
        
        photoswipe.listen('close', function() {
            $('.wopb-builder-slider-for .slick-slide').zoom({magnify: 2});
        });
    });

    $(document).ready(function() {
        if (typeof $('.wopb-builder-slider-for .slick-slide').zoom != 'undefined') {
            $('.wopb-builder-slider-for .slick-slide').zoom({magnify: 2});
        }
    });

    // ----------------------------
    // ----------------------------
    // ----------------------------



    // ------------------------
    // Builder Cart Options
    // ------------------------
    if ($('.wopb-cart-button').length > 0) {
        const plus = '<span class="wopb-builder-cart-plus"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M31 12h-11v-11c0-0.552-0.448-1-1-1h-6c-0.552 0-1 0.448-1 1v11h-11c-0.552 0-1 0.448-1 1v6c0 0.552 0.448 1 1 1h11v11c0 0.552 0.448 1 1 1h6c0.552 0 1-0.448 1-1v-11h11c0.552 0 1-0.448 1-1v-6c0-0.552-0.448-1-1-1z"></path></svg></span>';
        const minus = '<span class="wopb-builder-cart-minus"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32"><path d="M0 13v6c0 0.552 0.448 1 1 1h30c0.552 0 1-0.448 1-1v-6c0-0.552-0.448-1-1-1h-30c-0.552 0-1 0.448-1 1z"></path></svg></span>';
        const selector = $('.wopb-cart-button').closest('.cart').find('.quantity');
        const type = $('.wopb-cart-button').closest('.wopb-product-wrapper').data('type');
        if (type == 'both') {
            selector.append(plus);
            selector.prepend(minus);
        } else if (type == 'left') {
            selector.prepend('<span class="wopb-builder-cart-icon-left">'+plus+minus+'</span>');
        } else if (type == 'right') {
            selector.append('<span class="wopb-builder-cart-icon-right">'+plus+minus+'</span>');
        }
        
    }
    $(document).on('click', '.wopb-builder-cart-plus', function(e){
        e.preventDefault();
        const parents = $(this).closest('.quantity');
        const parentQuantity = parents.find('.input-text');
        let max = parentQuantity.attr('max');
        let _val = parseInt(parentQuantity.val() || 0);
        if (max) {
            if (_val < parseInt(max)) {
                _val = _val + 1;
            } else {
                $(this).addClass('disable');
            }
        } else {
            _val = _val + 1;
        }
        parentQuantity.val( _val );
        $('.wopb-builder-cart-minus').removeClass('disable');
    });
    $(document).on('click', '.wopb-builder-cart-minus', function(e){
        e.preventDefault();
        const parents = $(this).closest('.quantity');
        const parentQuantity = parents.find('.input-text');
        let _val = parseInt(parentQuantity.val());
        if (_val >= 2) {
            _val = _val - 1;
        } else {
            $(this).addClass('disable');
        }
        parentQuantity.val( _val );
        $('.wopb-builder-cart-plus').removeClass('disable');
    });



    // *************************************
    // Flex Menu
    // *************************************
    $(document).ready(function(){
        if ($('.wopb-flex-menu').length > 0) {
            const menuText = $('ul.wopb-flex-menu').data('name');
            $('ul.wopb-flex-menu').flexMenu({linkText: menuText, linkTextAll: menuText, linkTitle: menuText});
        }
    });
       

    // *************************************
    // Loadmore Append
    // *************************************
    $('.wopb-loadmore-action').on('click', function(e){
        e.preventDefault();

        let that    = $(this),
            parents = that.closest('.wopb-block-wrapper'),
            paged   = parseInt(that.data('pagenum')),
            pages   = parseInt(that.data('pages'));
        
        if(that.hasClass('wopb-disable')){
            return
        }else{
            paged++;
            that.data('pagenum', paged);
            if(paged == pages){
                $(this).addClass('wopb-disable');
            }else{
                $(this).removeClass('wopb-disable');
            }
        }

        $.ajax({
            url: wopb_data.ajax,
            type: 'POST',
            data: {
                action: 'wopb_load_more', 
                paged: paged ,
                blockId: that.data('blockid'),
                postId: that.data('postid'),
                blockName: that.data('blockname'),
                wpnonce: wopb_data.security
            },
            beforeSend: function() {
                parents.addClass('wopb-loading-active');
            },
            success: function(data) {
                $(data).insertBefore( parents.find('.wopb-loadmore-insert-before') );
            },
            complete:function() {
                parents.removeClass('wopb-loading-active');
            },
            error: function(xhr) {
                console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
                parents.removeClass('wopb-loading-active');
            },
        });
    });


    // *************************************
    // Filter
    // *************************************
    $('.wopb-filter-wrap li a').on('click', function(e){
        e.preventDefault();

        if($(this).closest('li').hasClass('filter-item')){
            let that    = $(this),
                parents = that.closest('.wopb-filter-wrap'),
                wrap = that.closest('.wopb-block-wrapper');

                parents.find('a').removeClass('filter-active');
                that.addClass('filter-active');

            $.ajax({
                url: wopb_data.ajax,
                type: 'POST',
                data: {
                    action: 'wopb_filter', 
                    taxtype: parents.data('taxtype'),
                    taxonomy: that.data('taxonomy'),
                    blockId: parents.data('blockid'),
                    postId: parents.data('postid'),
                    blockName: parents.data('blockname'),
                    wpnonce: wopb_data.security
                },
                beforeSend: function() {
                    wrap.addClass('wopb-loading-active');
                },
                success: function(data) {
                    wrap.find('.wopb-block-items-wrap').html(data);
                },
                complete:function() {
                    wrap.removeClass('wopb-loading-active');
                },
                error: function(xhr) {
                    console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
                    wrap.removeClass('wopb-loading-active');
                },
            });
        }
    });


    // *************************************
    // Pagination Number
    // *************************************
    function showHide(parents, pageNum, pages) {
        if (pageNum == 1) {
            parents.find('.wopb-prev-page-numbers').hide()
            parents.find('.wopb-next-page-numbers').show()
        } else if (pageNum == pages){
            parents.find('.wopb-prev-page-numbers').show()
            parents.find('.wopb-next-page-numbers').hide()
        } else {
            parents.find('.wopb-prev-page-numbers').show()
            parents.find('.wopb-next-page-numbers').show()
        }


        if(pageNum > 2) {
            parents.find('.wopb-first-pages').show()
            parents.find('.wopb-first-dot').show()
        }else{
            parents.find('.wopb-first-pages').hide()
            parents.find('.wopb-first-dot').hide()
        }
        
        if(pages > pageNum + 1){
            parents.find('.wopb-last-pages').show()
            parents.find('.wopb-last-dot').show()
        }else{
            parents.find('.wopb-last-pages').hide()
            parents.find('.wopb-last-dot').hide()
        }
    }

    function serial(parents, pageNum, pages){
        let datas = pageNum <= 2 ? [1,2,3] : ( pages == pageNum ? [pages-2,pages-1, pages] : [pageNum-1,pageNum,pageNum+1] )
        let i = 0
        parents.find('.wopb-center-item').each(function() {
            if(pageNum == datas[i]){
                $(this).addClass('pagination-active')
            }
            $(this).attr('data-current', datas[i]).find('a').text(datas[i])
            i++
        });
    }

    $('.wopb-pagination-ajax-action li').on('click', function(e){
        e.preventDefault();

        let that    = $(this),
            parents = that.closest('.wopb-pagination-ajax-action'),
            wrap = that.closest('.wopb-block-wrapper');

        let pageNum = 1;
        let pages = parents.attr('data-pages');
        
        if( that.data('current') ){
            pageNum = Number(that.attr('data-current'))
            parents.attr('data-paged', pageNum).find('li').removeClass('pagination-active')
            serial(parents, pageNum, pages)
            showHide(parents, pageNum, pages)
        } else {
            if (that.hasClass('wopb-prev-page-numbers')) {
                pageNum = Number(parents.attr('data-paged')) - 1
                parents.attr('data-paged', pageNum).find('li').removeClass('pagination-active')
                // parents.find('li[data-current="'+pageNum+'"]').addClass('pagination-active')
                serial(parents, pageNum, pages)
                showHide(parents, pageNum, pages)
            } else if (that.hasClass('wopb-next-page-numbers')) {
                pageNum = Number(parents.attr('data-paged')) + 1
                parents.attr('data-paged', pageNum).find('li').removeClass('pagination-active')
                // parents.find('li[data-current="'+pageNum+'"]').addClass('pagination-active')
                serial(parents, pageNum, pages)
                showHide(parents, pageNum, pages)
            }
        }

        const post_ID = (parents.parents('.wopb-shortcode').length != 0) ? parents.parents('.wopb-shortcode').data('postid') : parents.data('postid');

        if(pageNum){
            $.ajax({
                url: wopb_data.ajax,
                type: 'POST',
                data: {
                    action: 'wopb_pagination', 
                    paged: pageNum,
                    blockId: parents.data('blockid'),
                    postId: post_ID,
                    blockName: parents.data('blockname'),
                    builder: parents.data('builder'),
                    wpnonce: wopb_data.security
                },
                beforeSend: function() {
                    wrap.addClass('wopb-loading-active');
                },
                success: function(data) {
                    wrap.find('.wopb-block-items-wrap').html(data);
                    if($(window).scrollTop() > wrap.offset().top){
                        $([document.documentElement, document.body]).animate({
                            scrollTop: wrap.offset().top - 50
                        }, 100);
                    }

                },
                complete:function() {
                    wrap.removeClass('wopb-loading-active');
                },
                error: function(xhr) {
                    console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
                    wrap.removeClass('wopb-loading-active');
                },
            });
        }
    });
    
    // *************************************
    // SlideShow
    // *************************************
    $('.wopb-product-blocks-slide').each(function () {
        const that = $(this)
        const slideBrealpoint = that.data('slidestoshow').split('-');
        that.slick({
            arrows:         that.data('showarrows') ? true : false,
            dots:           that.data('showdots') ? true : false,
            infinite:       true,
            speed:          500,
            slidesToShow:   parseInt(slideBrealpoint[0]),
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: parseInt(slideBrealpoint[1]),
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: parseInt(slideBrealpoint[2]),
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: parseInt(slideBrealpoint[3]),
                        slidesToScroll: 1
                    }
                }
            ],
            autoplay:       that.data('autoplay') ? true : false,
            autoplaySpeed:  that.data('slidespeed') || 3000,
            cssEase:        "linear",
            prevArrow:      that.parent().find('.wopb-slick-prev').html(),
            nextArrow:      that.parent().find('.wopb-slick-next').html(),
        });
        that.show();
    });
    

    // *************************************
    // Variable Product Not Added in Cart
    // *************************************
    $('.add_to_cart_button').on('click', function(e){
        if($(this).hasClass('ajax_add_to_cart')){
            const urlData = $(this).attr('href');
            if(!urlData.includes('?add-to-cart=')){
                if(urlData.includes('http')){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    window.location.href = urlData;
                }
            }
        }
    });


    $('.wopb-modal-close').on('click', function(e){
        e.preventDefault();
        $(this).closest('.wopb-modal-wrap').removeClass('active');
    });


    document.addEventListener('keydown', function(e) {
        if(e.keyCode === 27){
            $('.wopb-modal-wrap').removeClass('active');
        }
    });


    // Loopcounter
    window.loopcounter = function (idWarp) {
        if (typeof idWarp != 'undefined') {
            let date = $(idWarp).data('date');
            if (typeof date != 'undefined') {
                var start = new Date(date),
                end = new Date(),
                diff = new Date(start - end),
                time = diff / 1000 / 60 / 60 / 24;

                var day = parseInt(time);
                var hour = parseInt(24 - (diff / 1000 / 60 / 60) % 24);
                var min = parseInt(60 - (diff / 1000 / 60) % 60);
                var sec = parseInt(60 - (diff / 1000) % 60);

                counterDate(idWarp, day, hour, min, sec);

                var interval = setInterval(function () {
                    if (sec == 0 && min != 0) {
                        min--;
                        sec = 60;
                    }
                    if (min == 0 && sec == 0 && hour != 0) {
                        hour--;
                        min = 59;
                        sec = 60;
                    }
                    if (min == 0 && sec == 0 && hour == 0 && day != 0) {
                        day--;
                        hour = 23;
                        min = 59;
                        sec = 60;
                    }
                    if (min == 0 && sec == 0 && hour == 0 && day == 0) {
                        clearInterval(interval);
                    } else {
                        sec--;
                    }
                    counterDate(idWarp, day, hour, min, sec);
                }, 1000);

                function counterDate(id, day, hour, min, sec) {
                    if (time < 0) { day = hour = min = sec = 0; }
                    $(id).find('.wopb-deals-counter-days').html(counterDoubleDigit(day));
                    $(id).find('.wopb-deals-counter-hours').html(counterDoubleDigit(hour));
                    $(id).find('.wopb-deals-counter-minutes').html(counterDoubleDigit(min));
                    $(id).find('.wopb-deals-counter-seconds').html(counterDoubleDigit(sec));
                }
                function counterDoubleDigit(arg) {
                    if (arg.toString().length <= 1) {
                        arg = ('0' + arg).slice(-2);
                    }
                    return arg;
                }
            }
        }
    }

    if (typeof loopcounter !== 'undefined') {
        if ($('.wopb-product-deals').length > 0) {
            $('.wopb-product-deals').each(function(i, obj) {
                loopcounter(obj);
            });
        }
    }


    
    // ------------------------
    // Quick Add Action
    // ------------------------
    $('.wopb-cart-action').on('click', function(e){
        const that = $(this);
        if (!that.hasClass('wopb-active')) {
            e.preventDefault();
        }
        $.ajax({
            url: wopb_data.ajax,
            type: 'POST',
            data: {
                action: 'wopb_addcart', 
                postid: $(this).data('postid'),
                wpnonce: wopb_data.security
            },
            beforeSend: function() {},
            success: function(data) {
                that.addClass('wopb-active');
            },
            complete:function() {},
            error: function(xhr) {
                console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
            },
        });
    });


    // ------------------------
    // Quick Add to Quickview Button
    // ------------------------
    $(document).on('click', '.wopb-quickview-btn', function(e){
        e.preventDefault();
        const _modal = $('.wopb-modal-wrap');
        const _postId = $(this).data('postid');
        const _postList = $(this).data('list');
        if(_postId){
            $.ajax({
                url: wopb_data.ajax,
                type: 'POST',
                data: { 
                    action: 'wopb_quickview', 
                    postid: _postId,
                    postList: _postList,
                    wpnonce: wopb_data.security
                },
                beforeSend: function() {
                    _modal.find('.wopb-modal-body').html('');
                    _modal.addClass('active');
                    _modal.find('.wopb-modal-loading').addClass('active');
                },
                success: function(data) {
                    _modal.find('.wopb-modal-body').html(data);
                    const width = $(window).width()-40;
                    if (width <= 992) { 
                        _modal.find('.wopb-quick-view-image').css('width', width);
                    }
                    slickSliderInit();
                },
                complete:function() {
                    _modal.find('.wopb-modal-loading').removeClass('active');
                },
                error: function(xhr) {
                    console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
                },
            });
        }
    });

    $(window).on('resize', function() {
        var win = $(this);
        const _modal = $('.wopb-modal-wrap');
        if (_modal.hasClass('active')){
            if (win.width() >= 992) { 
                _modal.find('.wopb-quick-view-image').removeAttr('style');
            } else {
                _modal.find('.wopb-quick-view-image').css('width', _modal.find('.wopb-quick-view-modal').width());
            }
        }
    });


    // ------------------------
    // Wishlist Modal Close
    // ------------------------
    $(document).on( 'click', '.wopb-modal-wrap', function (e) { // Outside Click
        if (
			!$(e.target).hasClass('wopb-wishlist-remove') && 
            !$(e.target).hasClass('ajax_add_to_cart') &&
			$(e.target).parents('.wopb-modal-body').length === 0 && 
			$(e.target).parents('.wopb-quick-view-navigation').length === 0 ) {
            	$('.wopb-modal-wrap').removeClass('active');
        }
    });
    $(document).on('click', '.wopb-modal-close, .wopb-modal-continue', function(e){ // Close Button
        e.preventDefault();
        $(this).closest('.wopb-modal-wrap').removeClass('active');
    });
    document.addEventListener('keydown', function(e) { // ESC Keydown Close
        if(e.keyCode === 27){
            $('.wopb-modal-wrap').removeClass('active');
        }
	});



    // ------------------------
    // Quick Add to Cart Quantity
    // ------------------------
    $(document).on('change', '.wopb-add-to-cart-quantity', function(e){
        e.preventDefault();
        let _val = $(this).val();
        let max = $(this).attr('max')
        const selector = $(this).closest('.wopb-add-to-cart').find('.add_to_cart_button');
        if ( typeof max !== typeof undefined ) {
            max = parseInt(max);
            const min = parseInt($(this).attr('min'));
            if ($(this).val() > max) {
                _val = max;
            } else if ($(this).val() < min) {
                _val = min;
            }
        }
        $(this).val(_val);
        selector.val(_val);
        selector.attr('data-quantity', _val);
    });

    // ------------------------
    // Quick Add to Cart Plus
    // ------------------------
    $(document).on('click', '.wopb-add-to-cart-plus', function(e){
        e.preventDefault();
        const parents = $(this).closest('.wopb-add-to-cart');
        const parentQuantity = parents.find('.wopb-add-to-cart-quantity');
        let max = parentQuantity.attr('max');
        let _val = parseInt(parentQuantity.val());
        if ( typeof max !== typeof undefined ) {
            if ( _val < parseInt(max) ) {
                _val = _val + 1;
            }else{
                $(this).addClass('disable');
            }
        } else {
            _val = _val + 1;
        }
        parents.find('.add_to_cart_button').attr('data-quantity', _val );
        parentQuantity.val( _val );
        $('.wopb-add-to-cart-minus').removeClass('disable');
    });

    // ------------------------
    // Quick Add to Cart Minus
    // ------------------------
    $(document).on('click', '.wopb-add-to-cart-minus', function(e){
        e.preventDefault();
        const parents = $(this).closest('.wopb-add-to-cart');
        const parentQuantity = parents.find('.wopb-add-to-cart-quantity');
        let _val = parseInt(parentQuantity.val());
        if ( _val >= 2 ) {
            _val = _val - 1;
        } else {
            $(this).addClass('disable');
        }
        parents.find('.add_to_cart_button').attr('data-quantity', _val );
        parentQuantity.val( _val );
        $('.wopb-add-to-cart-plus').removeClass('disable');
    });

    // ------------------------
    // Gallery Slick Slider
    // ------------------------
    function slickSliderInit() {
        $('.quickview-slider').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    }

    // ------------------------
    // Cart Redirect URL
    // ------------------------
    $(document).on('click', '.wopb-cart-btn', function(e) {
        const that = $(this);
        if (that.is('[data-redirect]')) {
            setTimeout(function(){ window.location.href = that.data('redirect'); }, 2000);
        }
    });

    // ------------------------
    // Remove Stock HTML from Cart Builder
    // ------------------------
    $('.wopb-builder-cart').find('.stock, .ast-stock-detail, .wopb-stock-progress-bar-section').remove();
        
/*
    if ($('.wopb-tooltip-text-top').length > 0) {
        $('.wopb-tooltip-text-top').each(function(i, obj) {
            let html = $(obj).html()
            if (html.indexOf('span') >= 0 ) {
                const itm1 = $(obj).find('span').eq(0)
                const itm2 = $(obj).find('span').eq(1)
                itm1.parents('span').css('left', -1 * (itm1.text().length * 4) + 'px');
                itm2.parents('span').css('left', -1 * (itm2.text().length * 4) + 'px');
            } else {
                $(obj).css('left', -1 * ($(obj).text().length * 4) + 'px');
            }
        });
    }
*/

})( jQuery );