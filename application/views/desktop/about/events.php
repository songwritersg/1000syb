<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.min.js")?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css")?>
<article id="page-events" class="container">
    <!--START: Breadcrumbs-->
    <aside class="container">
        <ol class="breadcrumbs">
            <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
            <li class="active"><span>천생연분닷컴 이벤트</span></li>
        </ol>
    </aside>
    <!--END: Breadcrumbs-->
    <h1><img class="wide-banner margin-bottom-30" src="/static/images/about/about_title_events.jpg" alt="천생연분닷컴 이벤트"></h1>

    <div id="events-location">
        <h2>천생연분닷컴 <strong>지역별 박람회</strong><small>천생연분닷컴 허니문 전문 여행사의 전국의 지사들과 박람회를 한눈에!</small></h2>
        <div class="events-body">
            <div class="maps">
                <a class="active" href="#서울" data-idx="10">서울</a>
                <a href="#강원" data-idx="20">강원</a>
                <a href="#충남" data-idx="31">충남</a>
                <a href="#충북" data-idx="36">충북</a>
                <a href="#인천" data-idx="40">인천</a>
                <a href="#경기" data-idx="41">경기</a>
                <a href="#전남" data-idx="51">전남</a>
                <a href="#전북" data-idx="56">전북</a>
                <a href="#부산" data-idx="60">부산</a>
                <a href="#경남" data-idx="62">경남</a>
                <a href="#울산" data-idx="68">울산</a>
                <a href="#제주" data-idx="69">제주</a>
                <a href="#경북" data-idx="71">경북</a>
            </div>
            <div class="banner-list" id="banner-list" style="padding:30px;width:660px;height:530px;float:right">
                <div id="banner-slide-container" class="flexslider">
                    <ul class="slides">
                        <?php foreach($event_banner_list as $banner) :?>
                        <li data-location="<?=$banner['sed_location']?>"><a href="<?=$banner['sed_url']?>" target="_blank"><img src="<?=base_url($banner['sed_banner'])?>" alt="<?=$banner['sed_title']?>"></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--
    <table class="table table-default" id="list-events">
        <colgroup>
            <col width="575" />
            <col width="252" />
            <col width="253" />
        </colgroup>
        <thead>
        <tr>
            <th>이벤트</th>
            <th>이벤트 기간</th>
            <th>비고</th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($event_list) == 0) :?>

        <?php else :
            foreach($event_list as $event) : ?>
                <tr>
                    <td><a href="<?=$event['sev_url']?>" target="_blank" title="<?=$event['sev_title']?>"><img class="img-event" src="<?=base_url($event['sev_image'])?>" alt="<?=$event['sev_title']?>"></a></td>
                    <td class="text-center"><?=$event['sev_dates']?></td>
                    <td class="text-center"><img class="img-label" src="/static/images/about/lbl_event_<?=($event['sev_on']?'on':'off')?>.png" alt="<?=($event['sev_on']?'진행중':'종료')?>"></td>
                </tr>
        <?php
            endforeach;
            endif;
        ?>
        </tbody>
    </table>
    -->
</article>

<script>
$(function(){
    $("#events-location .maps > a").on('click', function(e){
        e.preventDefault();
        $("#events-location .maps > a").removeClass("active");
        $(this).addClass("active");
        var idx = $(this).data('idx');
        var bg_url = "/static/images/about/map_" + idx + ".jpg";
        $("#events-location .events-body .maps").css('background-image', 'url('+bg_url+')');

        // 해당 li로 이동
        $("#banner-slide-container .slides li").each(function(){
            if( $(this).data('location') == idx )
            {
                var index = $(this).index() - 1;
                $('#banner-slide-container').flexslider(index);

                return false;
            }
        });
    });

    $("#banner-slide-container").flexslider({
        animation: "slide",
        slideshow:false,
        slideshowSpeed : 1000,
        prevText:"",
        nextText:"",
        controlNav:false,
        after: function(slider){
            var loc = $("#banner-slide-container .slides li").eq(slider.currentSlide + 1).data('location');

            $("#events-location .maps > a").removeClass("active");
            var selected = $("#events-location .maps > a[data-idx='"+loc+"']");
            selected.addClass("active");
            var bg_url = "/static/images/about/map_" + loc + ".jpg";
            $("#events-location .events-body .maps").css('background-image', 'url('+bg_url+')');
        }
    });
});
</script>