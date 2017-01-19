<div class="container">
    <div class="row">
        <h2 class="page-title">회사소개<small>본점안내</small></h2>
    </div>
</div>
<div id="page-about">
    <aside class="container">
        <div class="row">
            <ul class="tab">
                <li class="active"><span>서울 본점소개</span></li>
                <li class=""><a href="<?=base_url("about/branch")?>">지사안내</a></li>
            </ul>
        </div>
    </aside>

    <article id="awards" class="container" style="padding-top:15px;border-top:1px solid #ddd">
        <ul>
            <li><img class="img-responsive" src="<?=base_url("static/images/about/awards_brand.png")?>" alt="고객이 신뢰하는 브랜드 대상"></li>
            <li><img class="img-responsive" src="<?=base_url("static/images/about/awards_service.png")?>"  alt="고객감동 서비스지수 1위"></li>
        </ul>
    </article>

    <article id="about" class="container">
        <div class="about-container">
            <div class="about-group">
                <h3><i class="icon-checked"></i>&nbsp;대한민국 1등 허니문 여행사</h3>
                <p>1999년부터 <strong class="text-primary">17년동안</strong> 최고의 상품과 서비스 제공</p>
            </div>

            <div class="about-group">
                <h3><i class="icon-checked"></i>&nbsp;글로벌 인프라 시스템</h3>
                <p>13개국의 현지 인프라를 통한 신속한 <strong class="text-primary">고객대응 시스템 구축</strong></p>
            </div>

            <div class="about-group">
                <h3><i class="icon-checked"></i>&nbsp;국내 최대 규모 박람회 &amp; 초대전</h3>
                <p><strong class="text-primary">롯데호텔 박람회와 사무실 초대전</strong>을 통해 고객 맞춤형 상담</p>
            </div>

            <div class="about-group">
                <h3><i class="icon-checked"></i>&nbsp;항공발권 시스템 구축</h3>
                <p><strong class="text-primary">항공자체 발권 시스템</strong>을 국내 허니문여행사 최초로 구축</p>
            </div>

            <div class="about-group">
                <h3><i class="icon-checked"></i>&nbsp;고객 감동 브랜드 대상 외 3관왕</h3>
                <p>여행 만족도,브랜드,고객감동 등 <strong class="text-primary">소비자가 인정하는 브랜드</strong></p>
            </div>

            <div class="about-group">
                <h3><i class="icon-checked"></i>&nbsp;여행 보증 보험 9억 3천만원</h3>
                <p><strong class="text-primary">고객의 안전을 최우선</strong>으로 생각한 여행 보증보험 가입</p>
            </div>
        </div>
    </article>

    <article id="location" class="container" style="padding-bottom:15px;border-bottom:1px solid #ddd">
        <div class="map-container">
            <div id="about-location-map"></div>
        </div>
        <div class="map-info">
            <p class="tel"><a href="tel:02-720-8876">T.02-720-8876</a> | F.02-2179-9481</p>
            <p>서울 강남구 봉은사로 437 (삼성동 44-10) 소암빌딩 4층</p>
        </div>
    </article>
</div>

<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=qgDDeNxLd_swk2lKKlxf"></script>
<script>
    var mapX = 37.511818;
    var mapY = 127.047605;
    var position = new naver.maps.LatLng(mapX, mapY);
    var mapOptions = {
        center: position,
        zoom: 12,
        zoomControl: true,
        zoomControlOptions: {
            style: naver.maps.ZoomControlStyle.SMALL,
            position: naver.maps.Position.RIGHT_BOTTOM
        }
    };
    var map = new naver.maps.Map('about-location-map', mapOptions);
    var marker = new naver.maps.Marker({ position: position, map: map});
    var contentString = ['<div id="map-info-window">','<h4 style="padding:0px 15px">천생연분닷컴</h4>','</div>'].join('');
    var infoWindow = new naver.maps.InfoWindow({ content : contentString});
    infoWindow.open(map, marker);
</script>