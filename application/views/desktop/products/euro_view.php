<?=$this->site->add_js("/static/js/jquery.carousel-1.1.min.js")?>
<aside class="container">
    <ol class="breadcrumbs">
        <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
        <li><a href="<?=base_url("products/{$sca_parent}")?>"><?=$category['sca_name']?></a></li>
        <li class="active"><span>상품보기</span></li>
    </ol>
</aside>

<article class="container" id="product-view">
    <div class="product-view-header">
        <h1><?=$product['prd_title']?></h1>
        <h3><?=$product['cty_name']?></h3>

        <div class="navigation">
            <select id="select-subcategory" data-toggle="syb-select">
                <?php foreach($category['children'] as $cate) :?>
                    <option value="<?=$cate['sca_key']?>" <?=$cate['sca_key']==$sca_key?'selected':''?>><?=htmlspecialchars($cate['sca_name'])?></option>
                <?php endforeach;?>
            </select>
            <select id="select-products" data-toggle="syb-select" data-value="<?=$product['prd_idx']?>">
                <?php foreach($product_list as $row) :?>
                    <option value="<?=$row['prd_idx']?>" <?=$row['prd_idx'] == $product['prd_idx']?"selected":""?>><?=$row['prd_title']?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="product-view-gallery">
        <div class="carousel">
            <div class="slides">
                <?php foreach($product['gallery_list'] as $gallery) : ?>
                    <div>
                        <a class="gallery-item" href="<?=$gallery?>" data-toggle="image-preview">
                            <img src="<?=$gallery?>">
                        </a>
                    </div>
                <?php endforeach?>
            </div>
        </div>
    </div>

    <div class="product-program-list">

        <h3>항공별 가격안내</h3>
        <div class="action-box">
            <ul class="sns-share-list">
                <li class=""><a href="#" data-toggle="sns-share" data-service="facebook" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">페이스북 공유하기</a></li>
                <li class=""><a href="#" data-toggle="sns-share" data-service="google" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">구글+ 공유하기</a></li>
                <li class=""><a href="#" data-toggle="sns-share" data-service="kakaostory" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">카카오 스토리 공유하기</a></li>
                <li class=""><a href="#" data-toggle="sns-share" data-service="band" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">밴드 공유하기</a></li>
                <li class=""><a href="#" data-toggle="sns-share" data-service="naver" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">네이버 공유하기</a></li>
            </ul>
            <button type="button" class="btn btn-primary" data-toggle="send-mail" data-idx="<?=$product['prd_idx']?>" data-prg="<?=$prg_idx?>" data-key="<?=$sca_key?>" data-parent="<?=$sca_parent?>">메일 보내기</button>
        </div>
        <div class="clearfix"></div>

        <ol class="program-list">
            <?php foreach($program_list as $prog) :?>
                <li <?=$prog['prg_idx']==$prg_idx?'class="active"':''?>>
                    <div class="program-list-header">
                        <h5><?=$prog['airline_name']?> <small>(<?=$prog['start_date']?>~<?=$prog['end_date']?>)</small></h5>
                        <a class="btn" href="<?=base_url("products/{$sca_parent}/{$sca_key}/{$product['prd_idx']}/{$prog['prg_idx']}")?>"><i class="fa <?=$prg_idx==$prog['prg_idx']?'fa-caret-down':'fa-caret-right'?>"></i></a>
                    </div>
                    <div class="program-list-body" <?=$prg_idx==$prog['prg_idx']?'style="display:block"':''?>>
                        <table class="table table-price">
                            <thead>
                            <tr>
                                <th>분류</th>
                                <th>출발 가능 일자</th>
                                <th>판매가</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=$prog['flight_type']?></td>
                                    <td><?=$prog['start_date']?>~<?=$prog['end_date']?></td>
                                    <td><?=number_format($prog['price'])?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
            <?php endforeach;?>
        </ol>
    </div>

    <div id="product-benefit">
        <ul class="product-menu">
            <li class="active"><a href="#product-benefit">상품특전 확인하기</a></li>
            <li><a href="#product-info">리조트 정보</a></li>
            <li><a href="#product-program-detail">일정표 확인하기</a></li>
            <li><a href="#" data-toggle="open-sybqna">상품 문의하기</a></li>
        </ul>
        <h4 class="detail-title"><img src="/static/images/products/title_product_benefit.jpg"></h4>
        <table class="table table-benefit">
            <thead>
                <th colspan="2">타사 비교 포인트</th>
            </thead>
            <tbody>
                <?php foreach($view['DIFFERENT_POINT_INFO'] as $diff) : ?>
                <tr>
                    <th><?=$diff['CityName']?></th>
                    <td><?=nl2br($diff['Content'])?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <?php foreach($view['RULE_INFO'] as $benefit) :?>
        <table class="table table-benefit">
            <tr>
                <th>상품 특전</th>
                <td><?=nl2br($benefit['BonusContent'])?></td>
            </tr>
        </table>
        <table class="table table-include">
            <thead>
            <tr>
                <th class="include"><i class="fa fa-check-circle"></i>&nbsp;포함사항</th>
                <th class="exclude">불포함 사항</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-left"><?=$benefit['InclusionContent']?></td>
                <td class="text-left"><?=$benefit['NotInclusionContent']?></td>
            </tr>
            </tbody>
        </table>
        <?php endforeach;?>
    </div>
    <div id="product-info">
        <ul class="product-menu">
            <li><a href="#product-benefit">상품특전 확인하기</a></li>
            <li class="active"><a href="#product-info">리조트 정보</a></li>
            <li><a href="#product-program-detail">일정표 확인하기</a></li>
            <li><a href="#" data-toggle="open-sybqna">상품 문의하기</a></li>
        </ul>
        
        <h2 style="font-size:20px;">관광지 정보</h2>
        <?php foreach($view['TOUR_LOCATION_INFO'] as $tour) :?>
        <table class="table">

            <tr>
                <th>국가이름</th>
                <td><?=$tour['NationName']?></td>
            </tr>
            <tr>
                <th>도시이름</th>
                <td><?=$tour['CityName']?></td>
            </tr>
            <tr>
                <th>관광지 이름</th>
                <td><?=$tour['KoreanName']?></td>
            </tr>
            <tr>
                <th>대표이미지</th>
                <td><a href="<?=$tour['ImgUrl']?>" target="_blank"><?=$tour['ImgUrl']?></a></td>
            </tr>
            <tr>
                <th>관광지 이름 (영어)</th>
                <td><?=$tour['EnglishName']?></td>
            </tr>
            <tr>
                <th>교통</th>
                <td><?=$tour['Visit']?></td>
            </tr>
            <tr>
                <th>설명</th>
                <td><?=$tour['Description']?></td>
            </tr>
            <tr>
                <th>이미지</th>
                <td>
                    <?php
                    $images = explode("|", $tour['Images']);
                    foreach($images as $img) echo "<a href=\"{$img}\" target='_blank'>{$img}</a><br>";
                    ?>
                </td>
            </tr>
        </table>
        <?php endforeach;?>

        <h2 style="font-size:20px;">호텔정보</h2>
        <?php foreach($view['HOTEL_INFO'] as $hotel) :?>
        <table class="table">
            <tr>
                <th>나라 이름</th>
                <td><?=$hotel['NationName']?></td>
            </tr>
            <tr>
                <th>도시 이름</th>
                <td><?=$hotel['CityName']?></td>
            </tr>
            <tr>
                <th>호텔 영어 이름</th>
                <td><?=$hotel['HotelEName']?></td>
            </tr>
            <tr>
                <th>호텔 등급</th>
                <td><?=$hotel['StarRating']?></td>
            </tr>
            <tr>
                <th>호텔 주소</th>
                <td><?=$hotel['HotelAddress']?></td>
            </tr>
            <tr>
                <th>호텔 이미지</th>
                <td><a href="<?=$hotel['ImageUrl']?>" target="_blank"><?=$hotel['ImageUrl']?></a></td>
            </tr>
            <tr>
                <th>호텔 전화번호</th>
                <td><?=$hotel['HotelTel']?></td>
            </tr>
            <tr>
                <th>호텔 총 객실수</th>
                <td><?=$hotel['TotalRoomCount']?></td>
            </tr>
            <tr>
                <th>호텔 층수</th>
                <td><?=$hotel['TotalFloorCount']?></td>
            </tr>
            <tr>
                <th>호텔 부대 시설들</th>
                <td>
                    <?php
                    $images = explode("|", $hotel['HotelFacilityNames']);
                    foreach ($images as $img) echo $img ."<br>";
                    ?>
                </td>
            </tr>
            <tr>
                <th>호텔 이미지들</th>
                <td>
                    <?php
                    $images = explode("|", $hotel['HotelImages']);
                    foreach($images as $img) echo "<a href=\"{$img}\" target='_blank'>{$img}</a><br>";
                    ?>
                </td>
            </tr>
        </table>
        <?php endforeach;?>

        <h2 style="font-size:20px;">식당정보</h2>
        <?php foreach($view['RESTAURANT_INFO'] as $rest):?>
        <table class="table">
            <tr>
                <th>도시 이름</th>
                <td><?=$rest['CityName']?></td>
            </tr>
            <tr>
                <th>식당 이름</th>
                <td><?=$rest['RestaurantName']?></td>
            </tr>
            <tr>
                <th>식당 주소</th>
                <td><?=$rest['RestaurantAddress']?></td>
            </tr>
            <tr>
                <th>식당 전화번호</th>
                <td><?=$rest['RestaurantTel']?></td>
            </tr>
            <tr>
                <th>식당 이미지들</th>
                <td>
                    <?php
                    $images = explode("|", $rest['RestaurantImages']);
                    foreach($images as $img) echo "<a href=\"{$img}\" target='_blank'>{$img}</a><br>";
                    ?>
                </td>
            </tr>
        </table>
        <?php endforeach;?>
    </div>

    <div id="product-program-detail">
        <ul class="product-menu">
            <li><a href="#product-benefit">상품특전 확인하기</a></li>
            <li><a href="#product-info">리조트 정보</a></li>
            <li class="active"><a href="#product-program-detail">일정표 확인하기</a></li>
            <li><a href="#" data-toggle="open-sybqna">상품 문의하기</a></li>
        </ul>
        <h4 class="detail-title"><img src="/static/images/products/title_product_program_detail.jpg"></h4>

        <?php for($day=1; $day<=count($view['schedule']); $day++) : ?>
            <div class="schedule-title">
                <span class="schedule-title-msg"><?=$day?>일차</span>
                <ol class="day-meal-info">
                </ol>
            </div>
            <table class="table table-schedule-detail">
                <thead>
                <tr>
                    <th class="location">지역</th>
                    <th class="transport">교통편</th>
                    <th class="time">시간</th>
                    <th class="detail">상세정보</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($view['schedule'][$day-1] as $item) :?>
                    <tr>
                        <td class="location"><?=$item['CityName']?></td>
                        <td class="transport"><?=$item['TrafficNo']?></td>
                        <td class="time"><?=$item['TrafficTime']?></td>
                        <td class="detail"><?=$item['TourType']?"<small>[{$item['TourType']}]</small>":''?>&nbsp;<?=$item['Content']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        <?php endfor;?>
    </div>
</article>

<script>
    $(function() {

        $("table.table.table-schedule-detail").each(function(){
            var $table = $(this);
            $table.find("tbody > tr").each(function(row) {
                $table.rowspan(row);
            });
        });

        $("a[data-toggle='view-gallery']").on('click', function (e) {
            e.preventDefault();
            $.popup({url: $(this).attr('href'), width: 1080, height: 900});
        });
        if ($(".carousel .slides div").length > 0) {
            $('.carousel').carousel({
                hAlign: 'center',
                vAlign: 'center',
                hMargin: 0.8,
                reflection: true,
                shadow: false,
                mouse: false,
                speed: 200,
                autoplay: false,
                slidesPerScroll: 3,
                carouselWidth: 1000,
                carouselHeight: 450,
                frontWidth: 480,
                frontHeight: 360,
                backOpacity: 0.5,
                directionNav: true
            });
        }
    });
</script>
