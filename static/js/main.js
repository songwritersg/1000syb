'use strict';

$(function(){
    $.preload('/static/images/main/card_section_01_hover.png', '/static/images/main/card_section_02_hover.png');

    $('#main-slide').flexslider({
        animation: "slide",
        slideshow:false,
        prevText:"",
        nextText:"",
        manualControls:$(".slide-indicator ol li")
    });


    $('#movie-slider').flexslider({
        animation: "slide",
        slideshow:false,
        directionNav:false
    });

    best_honeymoon_slider.init();
    best_honeymonn_list_slider.init();

});

var best_honeymoon_slider = function(){

    var item_length;
    var item_width = 1090;
    var item_height =  250;
    var is_animate = false;
    var $slide;
    var $slide_mover;

    return {
        init:function( ){
            $slide = $("#slide-best-honeymoon");
            $slide.css({
                position:'relative',
                overflow:'hidden',
                height : item_height,
                marginBottom: '20px'
            });
            $slide_mover = $slide.find('ul.slides');
            item_length = $slide_mover.find("li").length;
            $slide_mover.css({
                width : item_width *  item_length,
                height : item_height,
                left : 0,
                position: 'absolute'
            });
        },
        move_next : function(){
            if( is_animate || item_length <= 1 ) return false;
            is_animate = true;
            $slide_mover.stop().animate({
                'left' : (-1 * item_width) + 'px'
            }, 200, function(){
                var firstChild = $slide_mover.children().filter(':lt(' + 1 + ')').clone(true);
                firstChild.appendTo($slide_mover);

                $slide_mover.children().filter(':lt(' + 1 + ')').remove();
                $slide_mover.css('left', '0px');
                is_animate = false;
            });
        },
        move_prev : function(){
            if( is_animate || item_length <= 1 ) return false;
            var lastItem = $slide_mover.children().eq(-2).nextAll().clone(true);
            lastItem.prependTo($slide_mover);
            $slide_mover.children().eq(-2).nextAll().remove();
            $slide_mover.css('left', (-1 * item_width) + 'px');
            is_animate = true;
            $slide_mover.animate({
                'left': '0px'
            }, 200, function () {
                is_animate = false;
            });
        }
    }
}();

var best_honeymonn_list_slider = function(){

    var item_length;
    var item_width = 276;
    var item_height =  330;
    var is_animate = false;
    var $slide;
    var $slide_mover;

    return {
        init:function( ){
            $slide = $("#slide-best-honeymoon-list");
            $slide.css({
                position:'relative',
                overflow:'hidden',
                height : item_height,
                marginBottom: '20px'
            });
            $slide_mover = $slide.find('ul.slides');
            item_length = $slide_mover.find("li").length;
            $slide_mover.css({
                width : item_width *  item_length,
                height : item_height,
                left : 0,
                position: 'absolute'
            });
        },
        move_next : function(){
            if( is_animate || item_length <= 1 ) return false;
            is_animate = true;
            $slide_mover.stop().animate({
                'left' : (-1 * item_width) + 'px'
            }, 200, function(){
                var firstChild = $slide_mover.children().filter(':lt(' + 1 + ')').clone(true);
                firstChild.appendTo($slide_mover);

                $slide_mover.children().filter(':lt(' + 1 + ')').remove();
                $slide_mover.css('left', '0px');
                is_animate = false;
            });
        },
        move_prev : function(){
            if( is_animate || item_length <= 1 ) return false;
            var lastItem = $slide_mover.children().eq(-2).nextAll().clone(true);
            lastItem.prependTo($slide_mover);
            $slide_mover.children().eq(-2).nextAll().remove();
            $slide_mover.css('left', (-1 * item_width) + 'px');
            is_animate = true;
            $slide_mover.animate({
                'left': '0px'
            }, 200, function () {
                is_animate = false;
            });
        }
    }
}();
