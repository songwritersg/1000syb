/******************************************************************************************************
 *
 * 천생연분닷컴 기본 Javascript
 *
 * @Author : 장선근 <jang@tjsrms.me>
 *
 *****************************************************************************************************/
/** Jquery UI Dialog Default Setting **/

$(function(){

    /**************************************************************************************************
     * 뒤로가기 버튼
     **************************************************************************************************/
    $("button[data-toggle='btn-back']").on('click',function(){
        history.go(-1);
     });

    /***************************************************************************************************
     * 유투브 링크
     **************************************************************************************************/
    $("a[data-toggle='youtube-link']").fancybox({
        type : 'iframe',
        href : $(this).attr('href')
    });

    /***************************************************************************************************
     * 이미지 확대하기
     **************************************************************************************************/
    $("a[data-toggle='image-preview']").fancybox({});


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
     * 이메일 유효성 체크
     **************************************************************************************************/
    $("input[data-toggle='email-check']").blur(function(){
        if($(this).val() == '') return;
        var regex = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
        if( ! regex.test($(this).val()) )
        {
            alert("유효하지 않은 이메일 주소 입니다.");
            $(this).val('');
            $(this).focus();
            return false;
        }
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
});

/******************************************************************************************************
 *
 * Get Parameter 값 가져오기
 *
 *****************************************************************************************************/
function validation_check(el, msg)
{
    if( el.length <=0 ) return false;

    if( el.val().trim() == '' )
    {
        alert(msg);
        el.focus();
        return false;
    }

    return true;
}


/******************************************************************************************************
 *
 * Get Parameter 값 가져오기
 *
 *****************************************************************************************************/
function getQuerystring(paramName){

    var _tempUrl = window.location.search.substring(1); //url에서 처음부터 '?'까지 삭제
    var _tempArray = _tempUrl.split('&'); // '&'을 기준으로 분리하기

    for(var i = 0; _tempArray.length; i++) {
        var _keyValuePair = _tempArray[i].split('='); // '=' 을 기준으로 분리하기

        if(_keyValuePair[0] == paramName){ // _keyValuePair[0] : 파라미터 명
            // _keyValuePair[1] : 파라미터 값
            return _keyValuePair[1];
        }
    }
}

/******************************************************************************************************
 *
 * 이미지 프리로드
 *
 * 브라우져가 렌더링 하기전에 이미지를 미리 로드한다.
 * @use $.preload('img.jpg', 'img2.jpg');
 *
 *****************************************************************************************************/
(function($) {
    var cache = [];
    $.preload = function() {
        var args_len = arguments.length;
        for ( var i = args_len; i--; )
        {
            var cacheImage = document.createElement('img');
            cacheImage.src = arguments[i];
            cache.push(cacheImage);
        }
    }
})(jQuery);

/******************************************************************************************************
 *
 * togglebar
 *
 * togglebar 열고닫기
 *
 *****************************************************************************************************/
(function($) {
    $(function() {
        $("[data-toggle='togglebar']").on('click', function () {
            var $collapse = $(this);
            $collapse.toggleClass("opened");
            $collapse.find('.togglebar-body').slideToggle();
        });
    });
})(jQuery);


/******************************************************************************************************
 *
 * PopUP
 *
 * Popup창을 띄웁니다.
 *****************************************************************************************************/
(function($) {
    $.popup = function(option) {
        $.popup.default = {
            title : '_blank',
            width : 800,
            height : 600,
            url : ''
        };

        var options = $.extend({}, $.popup.default, option);

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
 * SelectBox
 *
 * Select Box에 디자인처리를 위함.
 *****************************************************************************************************/
(function($) {

    $.fn.sybSelect = function(method) {

        if( typeof method == 'string' )
        {
            if( method == 'update' )
            {
                this.each(function() {
                    var $select = $(this);
                    var $dropdown = $(this).next('.syb-select');
                    var open = $dropdown.hasClass('open');

                    if( $dropdown.length )
                    {
                        $dropdown.remove();
                        init_select($select);

                        if (open) {
                            $select.next().trigger('click');
                        }
                    }
                });
            }
            else if (method == 'destroy')
            {
                this.each(function(){
                    var $select = $(this);
                    var $dropdown = $(this).next('.syb-select');

                    if( $dropdown.length )
                    {
                        $dropdown.remove();
                        $select.css('display', '');
                    }
                });

                if( $(".syb-select").length == 0 )
                {
                    $(document).off('.syb_select');
                }
            }
            return this;
        }

        this.hide();

        this.each(function() {
            var $select = $(this);

            if (!$select.next().hasClass('syb-select')) {
                init_select($select);
            }
        });

        function init_select($select) {
            $select.after($('<div></div>')
                .addClass('syb-select')
                .addClass($select.attr('class') || '')
                .addClass($select.attr('disabled') ? 'disabled' : '')
                .attr('tabindex', $select.attr('disabled') ? null : '0')
                .html('<span class="current"></span><ul class="list"></ul>')
            );

            var $dropdown = $select.next();
            var $options = $select.find('option');
            var $selected = $select.find('option:selected');

            $dropdown.find('.current').html($selected.data('display') || $selected.text());

            $options.each(function(i) {
                var $option = $(this);
                var display = $option.data('display');

                $dropdown.find('ul').append($('<li></li>')
                    .attr('data-value', $option.val())
                    .attr('data-display', (display || null))
                    .addClass('option' +
                        ($option.is(':selected') ? ' selected' : '') +
                        ($option.is(':disabled') ? ' disabled' : ''))
                    .html($option.text())
                );
            });
        }

        $(document).off('syb_select');

        $(document).on('click.syb_select', '.syb-select', function(event) {
            var $dropdown = $(this);
            $('.syb-select').not($dropdown).removeClass('open');
            $dropdown.toggleClass('open');

            if ($dropdown.hasClass('open')) {
                $dropdown.find('.option');
                $dropdown.find('.focus').removeClass('focus');
                $dropdown.find('.selected').addClass('focus');
            } else {
                $dropdown.focus();
            }
        });

        $(document).on('click.syb_select', function(event) {
            if ($(event.target).closest('.syb-select').length === 0) {
                $('.syb-select').removeClass('open').find('.option');
            }
        });

        $(document).on('click.syb_select', '.syb-select .option:not(.disabled)', function(event) {
            var $option = $(this);
            var $dropdown = $option.closest('.syb-select');

            $dropdown.find('.selected').removeClass('selected');
            $option.addClass('selected');

            var text = $option.data('display') || $option.text();
            $dropdown.find('.current').text(text);

            $dropdown.prev('select').val($option.data('value')).trigger('change');
        });

        $(document).on('keydown.syb_select', '.syb-select', function(event) {
            var $dropdown = $(this);
            var $focused_option = $($dropdown.find('.focus') || $dropdown.find('.list .option.selected'));

            // Space or Enter
            if (event.keyCode == 32 || event.keyCode == 13) {
                if ($dropdown.hasClass('open')) {
                    $focused_option.trigger('click');
                } else {
                    $dropdown.trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$dropdown.hasClass('open')) {
                    $dropdown.trigger('click');
                } else {
                    var $next = $focused_option.nextAll('.option:not(.disabled)').first();
                    if ($next.length > 0) {
                        $dropdown.find('.focus').removeClass('focus');
                        $next.addClass('focus');
                    }
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$dropdown.hasClass('open')) {
                    $dropdown.trigger('click');
                } else {
                    var $prev = $focused_option.prevAll('.option:not(.disabled)').first();
                    if ($prev.length > 0) {
                        $dropdown.find('.focus').removeClass('focus');
                        $prev.addClass('focus');
                    }
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($dropdown.hasClass('open')) {
                    $dropdown.trigger('click');
                }
                // Tab
            } else if (event.keyCode == 9) {
                if ($dropdown.hasClass('open')) {
                    return false;
                }
            }
        });

        var style = document.createElement('a').style;
        style.cssText = 'pointer-events:auto';
        if (style.pointerEvents !== 'auto') {
            $('html').addClass('no-csspointerevents');
        }

        return this;
    };

}(jQuery));

$(function(){
    $("select[data-toggle='syb-select']").sybSelect();
});
