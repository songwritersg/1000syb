/******************************************************************************************************
 *
 * 천생연분닷컴 기본 Javascript
 *
 * @Author : 장선근 <jang@tjsrms.me>
 *
 *****************************************************************************************************/

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
    $("a[data-toggle='youtube-link']").on('click',function(e){
        e.preventDefault();

        $("#pop-youtube").remove();
        var aside = $("<aside>").attr({id:'pop-youtube',tabindex : -1}).addClass('poplayer');
        aside.append( $("<div>").addClass('content') );
        $("body").append(aside);

        var width = $(this).attr('data-width') ? $(this).attr('data-width') : 800;
        var height = $(this).attr('data-height') ? $(this).attr('data-height') : 600;
        var iframe = $("<iframe allowfullscreen>");

        iframe.attr({width : width,height : height,frameborder : 0,src : $(this).attr('href')});

        $("#pop-youtube").bPopup({
            onOpen: function() {
                $("#pop-youtube .content").html( iframe );
            },
            onClose : function() {
                $("#pop-youtube .content").empty();
                $("#pop-youtube").remove();
            }
        });
    });
});

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
