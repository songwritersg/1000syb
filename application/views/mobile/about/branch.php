<div class="container">
    <div class="row">
        <h2 class="page-title">회사소개<small>지사안내</small></h2>
    </div>
</div>

<div id="page-about">
    <aside class="container">
        <div class="row">
            <ul class="tab">
                <li class=""><a href="<?=base_url("about")?>">서울 본점소개</a></li>
                <li class="active"><span>지사안내</span></li>
            </ul>
        </div>
    </aside>
    <aside class="container" style="background: #fff;">
        <div class="row">
            <div class="tab-slide tab-slide-sub" style="margin-top:0px; border-top:0px;">
                <ul class="tab-slide-ul">
                    <?php foreach($branch_list as $branch) :?>
                    <li<?=$view['bnc_idx']==$branch['bnc_idx']?' class="active"':''?>><a href="<?=base_url("about/branch/".urlencode($branch['bnc_name']))?>"><?=$branch['bnc_name']?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </aside>

    <article class="container" id="branch-map">
        <div class="row">
            <div class="container">
                <h2 class="branch-title">천생연분닷컴 <stron class="text-primary"><?=$view['bnc_name']?></stron></h2>
                <div id="map">
                    <div id="about-location-map"></div>
                </div>
                <div class="map-info">
                    <p class="tel"><a href="tel:<?=$view['bnc_tel']?>">T.<?=$view['bnc_tel']?></a><?=$view['bnc_fax']?" | F.{$view['bnc_fax']}":""?></p>
                    <p>주소 : <?=$view['bnc_address']?></p>
                    <?php if($view['bnc_banner_url']) :?>
                    <p>박람회 : <a href="<?=$view['bnc_banner_url']?>" target="_blank"><?=$view['bnc_banner_url']?></a></p>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </article>
</div>


<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=qgDDeNxLd_swk2lKKlxf"></script>
<script>
    var mapX = <?=$view['bnc_map_x']?>;
    var mapY = <?=$view['bnc_map_y']?>;
    var position = new naver.maps.LatLng(mapX, mapY);
    var mapOptions = { center: position, zoom: 12 };
    var map = new naver.maps.Map('about-location-map', mapOptions);
    var marker = new naver.maps.Marker({ position: position, map: map, zoomControl: true,
        zoomControlOptions: {
            style: naver.maps.ZoomControlStyle.SMALL,
            position: naver.maps.Position.RIGHT_BOTTOM
        }});
    var contentString = ['<div id="map-info-window">','<h4 style="padding:0px 15px"><?=$view['bnc_name']?></h4>','</div>'].join('');
    var infoWindow = new naver.maps.InfoWindow({ content : contentString});
    infoWindow.open(map, marker);
</script>
