<article id="page-404" class="container background-1">
    <img class="title-404" src="/static/images/common/404_msg.png" alt="404 Error">
    <p class="msg-404">페이지를 찾을 수 없습니다. 찾으려는 페이지의 주소가 잘못되었거나,<br>페이지의 주소가 변경 혹은 삭제되어 요청하신 페이지를 찾을 수 없습니다.</p>
    <p class="msg-404-2">※ 입력하신 주소가 정확한지 다시 한 번 확인해 주시기 바랍니다.</p>
    <ul class="page-404-buttons margin-top-20">
        <li><a class="btn btn-default btn-lg" href="javascript:;" onclick="history.back(-1);">이전페이지</a></li>
        <li><a class="btn btn-dark btn-lg" href="<?=base_url()?>">HOME</a></li>
    </ul>
</article>
<script>
$.preload("/static/images/common/404_1.jpg", "/static/images/common/404_2.jpg");
$(function(){
    setInterval(function() {
        var $container = $("#page-404");
        if($container.hasClass('background-1'))
        {
            $container.removeClass('background-1').addClass('background-2');
        }
        else {
            $container.removeClass('background-2').addClass('background-1');
        }
    }, 3000);
});
</script>