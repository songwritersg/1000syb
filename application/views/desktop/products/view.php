<!--START: Breadcrumbs-->
<aside class="container">
    <ol class="breadcrumbs">
        <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
        <li class="active"><span><?=$product['cty_name_kr']?></span></li>
    </ol>
</aside>
<!--END: Breadcrumbs-->

<script>
    $(function(){
        var gallery = $("#product-view-gallery");
        var selected_index = 0;
        gallery.find('li').eq(selected_index).addClass("active");
        gallery.find('li').not('.active').css('opacity', 0);
    });
</script>

<article class="container" id="product-view">

    <div class="product-view-header">
        <h3>HONEYMOON WITH 천생연분닷컴</h3>
        <h1><?=$product['prd_title']?><?=($product['prd_subtitle'])?"<small>{$product['prd_subtitle']}</small>":''?></h1>
    </div>
    <div class="product-view-gallery">
        <ul id="product-view-gallery">
            <?php foreach($product['gallery_list'] as $gallery) : ?>
            <li>
                <a class="gallery-item" href="#">
                    <img src="<?=base_url($gallery['gll_path'])?>">
                </a>
            </li>
            <?php endforeach?>
        </ul>
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
            <button type="button" class="btn btn-primary">메일 보내기</button>
        </div>
        <div class="clearfix"></div>

        <ol class="program-list">
            <?php
            $i =0;
            foreach($product['program_list'] as $program) :?>
            <li <?=$i==0?'class="active"':''?>>
                <div class="program-list-header">
                    <h5><?=$program['prg_title']?></h5>
                    <button type="button" data-toggle="collaspe"><i class="fa <?=$i==0?'fa-caret-down':'fa-caret-right'?>"></i></button>
                    <img class="icon-airline" src="<?=base_url($program['ail_icon'])?>">
                </div>
                <div class="program-list-body" <?=$i==0?'style="display:block"':''?>>
                    <table class="table table-price">
                        <thead>
                        <tr>
                            <th rowspan="2">구분</th>
                            <th colspan="4"><?=$program['ppm_desc']?></th>
                        </tr>
                        <tr>
                            <th>판매가</th>
                            <th>유류할증료</th>
                            <th class="sum-price">총가격</th>
                            <th class="total">할인가</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($program['price_list'] as $price) : ?>
                        <tr>
                            <td><?=$price['room_title']?></td>
                            <td><?=number_format($price['ppr_price'])?>원</td>
                            <td><?=number_format($program['alf_adjustment'])?>원</td>
                            <td class="sum-price"><?=number_format($price['ppr_price']+$program['alf_adjustment'])?>원</td>
                            <td class="total"><?=number_format($price['ppr_price']+$program['alf_adjustment']-$price['ppr_discount'])?>원</td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </li>
            <?php
            $i++;
            endforeach;?>
        </ol>
    </div>

    <!-- START:상품특전 확인하기 -->
    <div id="product-benefit">
        <ul class="product-menu">
            <li class="active"><a href="#product-benefit">상품특전 확인하기</a></li>
            <li><a href="#product-info">리조트 정보</a></li>
            <li><a href="#product-program-detail">일정표 확인하기</a></li>
            <li><a href="#" data-toggle="open-sybqna">상품 문의하기</a></li>
        </ul>
        <h4 class="detail-title"><img src="/static/images/products/title_product_benefit.jpg"></h4>
        <table class="table table-include">
            <thead>
            <tr>
                <th class="include"><i class="fa fa-check-circle"></i>&nbsp;포함사항</th>
                <th class="exclude">불포함 사항</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- END:상품특전 확인하기 -->

    <!-- START:리조트 정보 -->
    <div id="product-info">
        <ul class="product-menu">
            <li><a href="#product-benefit">상품특전 확인하기</a></li>
            <li class="active"><a href="#product-info">리조트 정보</a></li>
            <li><a href="#product-program-detail">일정표 확인하기</a></li>
            <li><a href="#" data-toggle="open-sybqna">상품 문의하기</a></li>
        </ul>
        <h4 class="detail-title"><img src="/static/images/products/title_product_info.jpg"></h4>
        <div class="info-detail">
            <div class="info-detail-header">
                <!--<h2><?=$product['prd_info_title']?$product['prd_info_title']:'상품 제목이 없습니다.'?></h2>-->
                <h2><?=element('prd_info_title',$product,"상품 제목이 없습니다.")?></h2>
                <p class="prd-info-description"><?=nl2br(element('prd_info_desc',$product,"상품 설명이 없습니다."))?></p>
            </div>
            <div class="info-detail-first">
                <h4 class="img-title"><?=element('prd_info_img_a_title',$product,"이미지 그룹 이름이 없습니다.")?></h4>
                <img class="img-a-1" src="<?=file_check($product['prd_info_img_a_1'])?base_url($product['prd_info_img_a_1']):'/static/images/common/no_image_938x400.jpg'?>">
                <img class="img-a-2" src="<?=file_check($product['prd_info_img_a_2'])?base_url($product['prd_info_img_a_2']):'/static/images/common/no_image_306x200.jpg'?>">
                <img class="img-a-3" src="<?=file_check($product['prd_info_img_a_3'])?base_url($product['prd_info_img_a_3']):'/static/images/common/no_image_306x200.jpg'?>">
                <img class="img-a-4" src="<?=file_check($product['prd_info_img_a_4'])?base_url($product['prd_info_img_a_4']):'/static/images/common/no_image_306x200.jpg'?>">
                <p class="img-description"><?=nl2br(element('prd_info_img_a_desc',$product,"이미지 그룹 설명이 없습니다."))?></p>
            </div>
            <div class="info-detail-second">
                <h4 class="img-title"><?=element('prd_info_img_b_title',$product,"이미지 그룹 이름이 없습니다.")?></h4>
                <img class="img-b-1" src="<?=file_check($product['prd_info_img_b_1'])?base_url($product['prd_info_img_b_1']):'/static/images/common/no_image_464x575.jpg'?>">
                <img class="img-b-2" src="<?=file_check($product['prd_info_img_b_2'])?base_url($product['prd_info_img_b_2']):'/static/images/common/no_image_464x575.jpg'?>">
                <p class="img-description"><?=nl2br(element('prd_info_img_b_desc',$product,"이미지 그룹 설명이 없습니다."))?></p>
            </div>
            <p class="info-extra"><?=nl2br($product['prd_info_extra'])?></p>
        </div>

    </div>

    <!-- END:리조트 정보-->

    <!-- START:일정표 확인하기-->
    <div id="product-program-detail">
        <ul class="product-menu">
            <li><a href="#product-benefit">상품특전 확인하기</a></li>
            <li><a href="#product-info">리조트 정보</a></li>
            <li class="active"><a href="#product-program-detail">일정표 확인하기</a></li>
            <li><a href="#" data-toggle="open-sybqna">상품 문의하기</a></li>
        </ul>
        <h4 class="detail-title"><img src="/static/images/products/title_product_program_detail.jpg"></h4>
    </div>
    <!-- END:일정표 확인하기-->

    <div id="product-common">
        <h4><img src="/static/images/products/product_common_title.png"></h4>

        <!-- START:예약취소료 규정-->
        <div class="common-panel">
            <div class="common-header"><h5>예약취소료 규정</h5></div>
            <div class="common-body"><?=stripslashes($this->site->config('product_cancel_info'))?></div>
        </div>
        <!-- END:예약취소료 규정-->

        <!-- START:추가경비-->
        <div class="common-panel">
            <div class="common-header"><h5>추가 경비</h5></div>
            <div class="common-body"><?=stripslashes($product['prd_extra_cost'])?></div>
        </div>
        <!-- END:추가경비-->

        <!-- START:유의사항/준비물-->
        <div class="common-panel">
            <div class="common-header"><h5>유의사항/준비물</h5></div>
            <div class="common-body"><?=stripslashes($product['prd_preperation'])?></div>
        </div>
        <!-- END:유의사항 준비물-->

        <!-- START:쇼핑안내-->
        <div class="common-panel">
            <div class="common-header"><h5>쇼핑안내</h5></div>
            <div class="common-body"><?=stripslashes($product['prd_shop_info'])?></div>
        </div>
        <!-- END:쇼핑안내-->

        <!-- START:입금계좌-->
        <div class="common-panel">
            <div class="common-header"><h5>입금계좌</h5></div>
            <div class="common-body">
                <table class="table" summary="입금계좌 안내">
                    <thead>
                    <tr>
                        <th>은행명</th>
                        <th>계좌번호</th>
                        <th>예금주</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center"><img src="/static/images/icons/icon_kb.png"></td>
                        <td class="text-center">268801-04-202744</td>
                        <td class="text-center">(주)네이버네트워크</td>
                    </tr>
                    <tr>
                        <td class="text-center"><img src="/static/images/icons/icon_kb.png"></td>
                        <td class="text-center">431802-01-373419</td>
                        <td class="text-center">(주)네이버네트워크</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END:입금계좌-->
    </div>
</article>

<script>
$(function(){
    $(".program-list > li > .program-list-header button[data-toggle='collaspe']").on('click', function(){
        var li = $(this).parent().parent();
        var i = $(this).find('i.fa');

        if( li.hasClass("active") ) return false;

        $(".program-list > li").removeClass("active");
        $(".program-list > li > .program-list-header button[data-toggle='collaspe'] i.fa").removeClass("fa-caret-down").removeClass("fa-caret-right").addClass("fa-caret-right");
        $(".program-list > li > .program-list-body").slideUp('fast');

        li.addClass("active");
        i.removeClass("fa-caret-down").removeClass("fa-caret-right").addClass("fa-caret-down");
        li.find('.program-list-body').slideDown('fast');
    });
});
</script>