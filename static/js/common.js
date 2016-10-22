/******************************************************************************************************
 *
 * 천생연분닷컴 기본 Javascript
 *
 * @Author : 장선근 <jang@tjsrms.me>
 *
 *****************************************************************************************************/


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