$(function(){

    /**************************************************************************************************
     * Ajax 에러 기본 설정
     **************************************************************************************************/
    $(document).ajaxError(function(event, request, settings){

        var message = '알수없는 오류가 발생하였습니다.';
        if( typeof request.responseJSON != 'undefined' && typeof request.responseJSON.message != 'undefined' ) {
            message = request.responseJSON.message;
        }
        else {
            if( request.status == 500 ) message = '서버 코드 오류가 발생하였습니다.\n관리자에게 문의하세요';
            else if ( request.status == 401 ) message = '해당 명령을 실행할 권한이 없습니다.';
        }
        alert(message);
    });


    /**************************************************************************************************
     * 뒤로가기 버튼
     **************************************************************************************************/
    $("button[data-toggle='btn-back']").on('click',function(){
        history.go(-1);
    });
    
    $("input[type='search']+.input-group-addon > i").on('click', function(){
        ($(this).parents('form'))[0].submit();
    });


    /**************************************************************************************************
     * DatePicker 기본설정
     **************************************************************************************************/
    $.datepicker.regional.ko = {
        closeText: "닫기",
        prevText: '<i class="fa fa-caret-left"></i>',
        nextText: '<i class="fa fa-caret-right"></i>',
        currentText: "오늘",
        monthNames: ["1월", "2월", "3월", "4월", "5월", "6월",
            "7월", "8월", "9월", "10월", "11월", "12월"],
        monthNamesShort: ["1월", "2월", "3월", "4월", "5월", "6월",
            "7월", "8월", "9월", "10월", "11월", "12월"],
        dayNames: ["일요일", "월요일", "화요일", "수요일", "목요일", "금요일", "토요일"],
        dayNamesShort: ["일", "월", "화", "수", "목", "금", "토"],
        dayNamesMin: ["일", "월", "화", "수", "목", "금", "토"],
        weekHeader: "주",
        dateFormat: "yy-mm-dd",
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: true,
        yearSuffix: "년"
    };
    $.datepicker.setDefaults($.datepicker.regional.ko);

    /**************************************************************************************************
     * 화면상단으로
     **************************************************************************************************/
    $("[href='#top']").on('click', function(e){
        e.preventDefault();
        $('body,html').animate({
            scrollTop: 0
        }, 500);

        return false;
    });

    /**************************************************************************************************
     * 맨위로 이동 버튼 보엿다 감췃다
     **************************************************************************************************/
    $(window).scroll(function(){
        if( $(window).scrollTop() > ($(window).height() /2)  )
        {
            $("#btn-to-top").fadeIn('fast');
        }
        else {
            $("#btn-to-top").fadeOut('fast');
        }
    }).scroll();

    /**************************************************************************************************
     * 좌측메뉴 토글
     **************************************************************************************************/
    $("[data-toggle='toggle-menu']").on('click',function(e){
        e.preventDefault();
        $("body").toggleClass("opened");
        $("#menuOverlay").toggle();
    });

    /**************************************************************************************************
     * PC보기 / 모바일보기 토글
     **************************************************************************************************/
    $("[data-toggle='viewmode']").on('click', function(e){
        var value = $(this).data('value');
        var expire = new Date();
        expire.setDate(expire.getDate() + 30);
        cookies = "viewmode" + '=' +escape( value ) + '; path=/';
        cookies += ';expires=' + expire.toGMTString() + ';';
        document.cookie = cookies;

        location.reload();
    });

    /***************************************************************************************************
     * 핸드폰 번호 자동 하이픈
     **************************************************************************************************/
    $("input[data-toggle='phone-check']").blur(function(){
        if($(this).val() == '') return;
        var trans_num = $(this).val().replace(/-/gi,'');
        if(trans_num != null && trans_num != '') {
            if(trans_num.length==11 || trans_num.length==10) {
                var regExp_ctn = /^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/;
                if(regExp_ctn.test(trans_num)) {
                    trans_num = trans_num.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3");
                    $(this).val(trans_num);
                    return true;
                }
            }
            alert("유효하지 않은 전화번호 입니다.");
            $(this).val("");
            $(this).focus();
        }
    });

    /***************************************************************************************************
     * 공유하기 팝업 띄우기 버튼
     **************************************************************************************************/
    $('[data-toggle="open-sns-share"]').on('click' ,function(e){
        e.preventDefault();
        $("#mask-sns-share").remove();
        $("#pop-sns-share").hide();

        var mask = $("<div>").attr('id', 'mask-sns-share').css({
            position : 'fixed',
            top : '0px',
            left : '0px',
            width : '100%',
            height : '100%',
            '-ms-filter' : 'progid:DXImageTransform.Microsoft.Alpha(Opacity=50)',
            filter : 'progid:DXImageTransform.Microsoft.Alpha(Opacity=50)',
            opacity : 0.5,
            background : '#4a4a4a',
            '-moz-opacity' : 0.5,
            'z-index': 99,
            display: 'none'
        });

        $("body").append(mask);
        $("#mask-sns-share").fadeTo(300, 0.8);
        $('#pop-sns-share').fadeIn(300);

        $('#pop-sns-share [data-toggle="close"]').off('click').on('click', function(e){
            e.preventDefault();
            $('#pop-sns-share').fadeOut('300');
            $("#mask-sns-share").fadeOut('300',function(){
                $("#mask-sns-share").remove();
                $("body").css({
                    'overflow-y':'auto',
                    'padding-right' : '0px'
                });
            });
        });

        return false;
    });

    /***************************************************************************************************
     * 공유하기 버튼
     **************************************************************************************************/
    $("a[data-toggle='sns-share']").click(function(e){
        e.preventDefault();

        var _this = $(this);
        var sns_type = _this.data('service');
        var href = _this.data('url');
        var title = _this.data('title');
        var loc = "";
        var img = $("meta[name='og:image']").attr('content');

        if( ! sns_type || !href || !title) return;

        if( sns_type == 'facebook' ) {
            loc = '//www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(href);
        }
        else if ( sns_type == 'twitter' ) {
            loc = '//twitter.com/home?status='+encodeURIComponent(title)+' '+href;
        }
        else if ( sns_type == 'google' ) {
            loc = '//plus.google.com/share?url='+href;
        }
        else if ( sns_type == 'pinterest' ) {

            loc = '//www.pinterest.com/pin/create/button/?url='+href+'&media='+img+'&description='+encodeURIComponent(title);
        }
        else if ( sns_type == 'kakaostory') {
            loc = 'https://story.kakao.com/share?url='+encodeURIComponent(href);
        }
        else if ( sns_type == 'band' ) {
            loc = 'http://www.band.us/plugin/share?body='+encodeURIComponent(title)+'%0A'+encodeURIComponent(href);
        }
        else if ( sns_type == 'naver' ) {
            loc = "http://share.naver.com/web/shareView.nhn?url="+encodeURIComponent(href)+"&title="+encodeURIComponent(title);
        }
        else {
            return false;
        }
        $.popup({ url : loc});
        return false;
    });


    /***************************************************************************************************
     * 슬라이드 탭
     **************************************************************************************************/
    var min_left = 0;
    var max_left = 0;
    if( $(".tab-slide").length > 0 )
    {
        $(window).resize(function(){
            var w = 0;
            $(".tab-slide-ul li").each(function(){
                w += $(this).width() +1;
            });
            if ( w < $(".tab-slide-ul").parent().innerWidth()) {
                w =$(".tab-slide-ul").parent().innerWidth();
            }
            $(".tab-slide-ul").css('width', w);

            min_left = 0;
            max_left = w - $(window).width();

            var selected_w = $(".tab-slide-ul li.active").offset().left +  $(".tab-slide-ul li.active").width();
            if( selected_w > $(window).width() )
            {
                $(".tab-slide-ul").css('left', - (selected_w - $('.tab-slide').width()));
            }
        }).resize();

        $(".tab-slide-ul").touchScrollEvent({
            swipeLeft : function(){
                var current = parseInt($(".tab-slide-ul").css('left'));
                if( current > - max_left )
                {
                    $(".tab-slide-ul").css('left', current - 10 );
                }
            },
            swipeRight : function(){
                var current = parseInt($(".tab-slide-ul").css('left'));
                if( current < min_left )
                {
                    $(".tab-slide-ul").css('left', current + 10 );
                }
            }
        });
    }
});


/******************************************************************************************************
 *
 * PopUP
 *
 * Popup창을 띄웁니다.
 *****************************************************************************************************/
(function($) {
    $.popup=function(option) {
        var defaults={
            title : '_blank',
            width : 800,
            height : 600,
            url : ''
        };

        var options = $.extend({}, defaults, option);

        cw = screen.availWidth;
        ch = screen.availHeight;
        sw = options.width;
        sh = options.height;

        ml = (cw - sw) / 2;
        mt = (ch - sh) / 2;
        var option = 'width='+sw+',height='+sh+',top='+mt+',left='+ml+',scrollbars=yes,resizable=no';
        var win = window.open(options.url, options.title,  option);
        if (win == null || typeof(win) == "undefined" || (win == null && win.outerWidth == 0) || (win != null && win.outerHeight == 0))
        {
            alert("팝업 차단 기능이 설정되어있습니다\n\n차단 기능을 해제(팝업허용) 한 후 다시 이용해 주십시오.");
            return;
        }
    };
})(jQuery);



/******************************************************************************************************
 *
 * Table Rowspan
 *
 * Table Rowspan
 *****************************************************************************************************/
(function($){
    $.fn.rowspan = function(colIdx, isStats) {
        return this.each(function(){
            var that;
            $('tr', this).each(function(row) {
                $('td:eq('+colIdx+')', this).filter(':visible').each(function(col) {

                    if ($(this).html() == $(that).html()
                        && (!isStats
                            || isStats && $(this).prev().html() == $(that).prev().html()
                        )
                    ) {
                        rowspan = $(that).attr("rowspan") || 1;
                        rowspan = Number(rowspan)+1;

                        $(that).attr("rowspan",rowspan);

                        $(this).hide();

                    } else {
                        that = this;
                    }

                    that = (that == null) ? this : that;
                });
            });
        });
    };
})(jQuery);