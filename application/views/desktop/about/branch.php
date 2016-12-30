<!--START: Breadcrumbs-->
<aside class="container">
    <ol class="breadcrumbs">
        <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
        <li class="active"><span>지사안내</span></li>
    </ol>
</aside>
<!--END: Breadcrumbs-->

<!--START: 메인컨텐츠-->
<article class="container" id="about-branch">

    <img class="wide-banner margin-bottom-30" src="/static/images/about/top_banner.jpg" alt="천생연분닷컴 회사소개 배너">

    <ul class="tab tab-default tab-justified">
        <li ><a href="<?=base_url('about')?>">천생연분닷컴 본사 회사소개</a></li>
        <li class="active"><a href="#" onclick="return false;">천생연분닷컴 지사안내</a></li>
    </ul>
    <ul class="tab tab-branch tab-justified margin-bottom-30">
        <?php foreach($branch_list as $branch):?>
        <li <?=$view['bnc_idx']==$branch['bnc_idx']?'class="active"':''?>><a href="<?=base_url('about/branch/'.urlencode($branch['bnc_name']))?>"><?=$branch['bnc_name']?></a></li>
        <?php endforeach?>
    </ul>

    <div class="branch-title">
        <h2>천생연분닷컴 <?=$view['bnc_name']?>에 방문해주셔서 감사합니다.<strong><?=$view['bnc_name_eng']?></strong></h2>
    </div>

    <div id="slide-fair">
        <div class="slide-fair-container">
            <ul>
                <li><img src="<?=base_url($view['bnc_image_big_01'])?>" alt="<?=$view['bnc_name']?> 소개 사진 첫번째"></li>
                <li><img src="<?=base_url($view['bnc_image_big_02'])?>" alt="<?=$view['bnc_name']?> 소개 사진 두번째"></li>
                <li><img src="<?=base_url($view['bnc_image_big_03'])?>" alt="<?=$view['bnc_name']?> 소개 사진 세번째"></li>
            </ul>
        </div>
        <div class="slide-fair-list">
            <ul>
                <li class="active"><img src="<?=base_url($view['bnc_image_big_01'])?>"  alt="<?=$view['bnc_name']?> 소개 사진 첫번째 썸네일"></li>
                <li><img src="<?=base_url($view['bnc_image_big_02'])?>" alt="<?=$view['bnc_name']?> 소개 사진 두번째 썸네일"></li>
                <li><img src="<?=base_url($view['bnc_image_big_03'])?>" alt="<?=$view['bnc_name']?> 소개 사진 세번째 썸네일"></li>
            </ul>
        </div>
    </div>

    <div class="branch-actions">
        <a class="branch-banner" href="<?=$view['bnc_banner_url']?>"><img src="<?=base_url($view['bnc_banner_image'])?>" alt="천생연분닷컴 <?=$view['bnc_name']?> 박람회"></a>
        <a class="branch-button" href="<?=$view['bnc_button_url']?>"><img src="<?=base_url($view['bnc_button_image'])?>" alt="천생연분닷컴 <?=$view['bnc_name']?> 허니문 질문과 답변" ></a>
    </div>
</article>

<article class="container-fluid margin-top-50" id="location">
    <div class="container">
        <header>
            <h2>천생연분닷컴 <strong><?=$view['bnc_name']?> 찾아오시는길</strong></h2>
            <p>천생연분닷컴을 쉽게 찾아오실 수 있게 안내해 드립니다.</p>
        </header>
        <div id="about-location-map"></div>
        <div class="location-info">
            <ul>
                <li>T. <?=$view['bnc_tel']?></li>
                <li>F. <?=$view['bnc_fax']?></li>
                <li><?=$view['bnc_address']?></li>
            </ul>
        </div>
        <table class="table transport-info">
            <thead>
            <tr>
                <th><img class="thead-icon" src="/static/images/icons/icon_subway.png" alt="지하철">&nbsp;지하철</th>
                <th><img class="thead-icon" src="/static/images/icons/icon_bus.png" alt="버스">&nbsp;버스</th>
                <th><img class="thead-icon" src="/static/images/icons/icon_car.png" alt="승용차">&nbsp;승용차</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?=$view['bnc_subway']?></td>
                <td><?=$view['bnc_bus']?></td>
                <td><?=$view['bnc_car']?></td>
            </tr>
            </tbody>
        </table>
    </div>
</article>

<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=qgDDeNxLd_swk2lKKlxf"></script>
<script>
    $(function(){
        $("#slide-fair > .slide-fair-list > ul >li").on('click', function(){
            var index = $(this).index();
            var slide_height = 400;
            $("#slide-fair > .slide-fair-list > ul >li").removeClass("active");
            $("#slide-fair > .slide-fair-list > ul >li").eq(index).addClass("active");

            $("#slide-fair > .slide-fair-container > ul").stop().animate({'top': -1 * (index * slide_height) + "px"}, 300);
        });
    });
    var mapX = <?=$view['bnc_map_x']?>;
    var mapY = <?=$view['bnc_map_y']?>;
    var position = new naver.maps.LatLng(mapX, mapY);
    var mapOptions = { center: position, zoom: 12 };
    var map = new naver.maps.Map('about-location-map', mapOptions);
    var marker = new naver.maps.Marker({ position: position, map: map});
    var contentString = ['<div id="map-info-window">','<h4><?=$view['bnc_name']?></h4>','<p><?=$view['bnc_address']?></p>','</div>'].join('');
    var infoWindow = new naver.maps.InfoWindow({ content : contentString});
    infoWindow.open(map, marker);
</script>
