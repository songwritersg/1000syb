<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js")?>
<?=$this->site->add_js("/static/js/jquery.carousel-1.1.min.js")?>
<!--START: Breadcrumbs-->
<aside class="container">
    <ol class="breadcrumbs">
        <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
        <li><a href="<?=base_url("products/{$sca_parent}")?>"><?=$sca_parent?></a></li>
        <li class="active"><span><?=$product['cty_name_kr']?></span></li>
    </ol>
</aside>
<!--END: Breadcrumbs-->


<article class="container" id="product-view">

    <div class="product-view-header">
        <!--
        <h3>HONEYMOON WITH 천생연분닷컴</h3>
        <h1><?=$product['prd_title']?><small><?=$program_info['prg_title']?></small></h1>
        -->
        <h1><?=$product['prd_title']?></h1>
        <h3><?=$program_info['prg_title']?></h3>

        <div class="navigation">
            <select id="select-subcategory" data-toggle="syb-select">
                <?php foreach($category['children'] as $cate) :?>
                <option value="<?=$cate['sca_key']?>" <?=$cate['sca_key']==$sca_key?'selected':''?>><?=$cate['sca_name']?></option>
                <?php endforeach;?>
            </select>
            <select id="select-products" data-toggle="syb-select" data-value="<?=$product['prd_idx']?>">
                <?php foreach($product_list as $row) :?>
                <option value="<?=$row['prd_idx']?>" <?=$row['prd_idx'] == $product['prd_idx']?"selected":""?>><?=$row['prd_title']?></option>
                <?php endforeach;?>
            </select>
        </div>
        <script>
            $(function(){
                $("#select-subcategory").off('change.category_change').on('change.category_change', function(){

                    $("#select-products").empty().off('change.product_change');
                    $("#select-products").sybSelect('update')
                    var sca_key = $("#select-subcategory option:selected").val();

                    $.get('/api/products/info', {sca_key:sca_key}, function(res){
                        for(var i in res.result)
                        {
                            var option = $("<option>").attr('value', res.result[i].prd_idx).text(res.result[i].prd_title);
                            if( res.result[i].prd_idx == $("#select-products").data('value') )
                            {
                                option.attr('selected', 'selected');
                            }
                            $("#select-products").append(option);
                        }

                        $("#select-products").sybSelect('update').on('change.product_change',function(){
                            location.href = "/products/<?=$sca_parent?>/" + $("#select-subcategory option:selected").val() + "/" + $("#select-products option:selected").val();
                        });
                    });

                });

                $("#select-products").on('change.product_change',function(){
                    location.href = "/products/<?=$sca_parent?>/" + $("#select-subcategory option:selected").val() + "/" + $("#select-products option:selected").val();
                });
            });
        </script>
    </div>
    <div class="product-view-gallery">
        <div class="carousel">
            <div class="slides">
                <?php foreach($product['gallery_list'] as $gallery) : ?>
                <div>
                    <?php if($gallery['gll_type'] == 'ZOOM') : ?>
                    <a class="gallery-item" href="<?=base_url($gallery['gll_path'])?>" data-toggle="bpopup">
                    <?php elseif($gallery['gll_type'] == 'LINK' ): ?>
                    <a class="gallery-item" href="<?=$gallery['gll_url']?>">
                    <?php elseif($gallery['gll_type'] == 'LINK_WIN'): ?>
                    <a class="gallery-item" href="<?=$gallery['gll_url']?>" target="_blank">
                    <?php elseif($gallery['gll_type'] == 'VIDEO'): ?>
                    <a class="gallery-item" href="#">
                    <?php endif;?>
                        <img src="<?=base_url($gallery['gll_path'])?>">
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
            <button type="button" class="btn btn-primary">메일 보내기</button>
        </div>
        <div class="clearfix"></div>

        <ol class="program-list">
            <?php foreach($product['program_list'] as $prog) :?>
            <li <?=$prog['prg_idx']==$prg_idx?'class="active"':''?>>
                <div class="program-list-header">
                    <h5><?=$prog['prg_title']?></h5>
                    <a class="btn" href="<?=base_url("products/{$sca_parent}/{$sca_key}/{$product['prd_idx']}/{$prog['prg_idx']}")?>"><i class="fa <?=$prg_idx==$prog['prg_idx']?'fa-caret-down':'fa-caret-right'?>"></i></a>
                    <img class="icon-airline" src="<?=base_url($prog['ail_icon'])?>">
                </div>
                <div class="program-list-body" <?=$prg_idx==$prog['prg_idx']?'style="display:block"':''?>>
                    <table class="table table-price">
                        <thead>
                        <tr>
                            <th rowspan="2">구분</th>
                            <th colspan="4"><?=$prog['ppm_desc']?></th>
                        </tr>
                        <tr>
                            <th>판매가</th>
                            <th>유류할증료</th>
                            <th class="sum-price">총가격</th>
                            <th class="total">할인가</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($prog['price_list'] as $price) : ?>
                        <tr>
                            <td><?=$price['room_title']?>&nbsp;<a href="<?=base_url("products/gallery/{$price['room_idx']}")?>" data-toggle="view-gallery""><img class="icon-gallery" src="/static/images/icons/icon_gallery.png"></a></td>
                            <td><?=number_format($price['ppr_price'])?>원</td>
                            <td><?=number_format($prog['alf_adjustment'])?>원</td>
                            <td class="sum-price"><?=number_format($price['ppr_price']+$prog['alf_adjustment'])?>원</td>
                            <td class="total"><?=number_format($price['ppr_price']+$prog['alf_adjustment']-$price['ppr_discount'])?>원</td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </li>
            <?php endforeach;?>
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
        <?php if( isset($product['ben_content']) && is_array($product['ben_content']) ) :?>
        <?php foreach($product['ben_content'] as $ben_content) :?>
        <table class="table table-benefit">
            <tr>
                <th rowspan="<?=count($ben_content['content'])?>"><?=$ben_content['title']?></th>
                <td><?=nl2br($ben_content['content'][0])?></td>
            </tr>
            <?php for($i=1; $i<count($ben_content['content']); $i++) :?>
            <tr>
                <td><?=$ben_content['content'][$i]?></td>
            </tr>
            <?php endfor?>
        </table>
        <?php endforeach;?>
        <?php endif;?>
        <table class="table table-include">
            <thead>
            <tr>
                <th class="include"><i class="fa fa-check-circle"></i>&nbsp;포함사항</th>
                <th class="exclude">불포함 사항</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?=$product['ben_include']?></td>
                <td><?=$product['ben_exclude']?></td>
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
        <?php for($day=1; $day<count($program_info['schedule']); $day++) : ?>
        <div class="schedule-title">
            <span class="schedule-title-msg"><?=$day?>일차</span>
            <ol class="day-meal-info">
                <?=$program_info['schedule'][$day-1]['meal']['b'] ? "<li><label>B</label>{$program_info['schedule'][$day-1]['meal']['b']}</li>":""?>
                <?=$program_info['schedule'][$day-1]['meal']['l'] ? "<li><label>L</label>{$program_info['schedule'][$day-1]['meal']['l']}</li>":""?>
                <?=$program_info['schedule'][$day-1]['meal']['d'] ? "<li><label>D</label>{$program_info['schedule'][$day-1]['meal']['d']}</li>":""?>
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
            <?php foreach($program_info['schedule'][$day-1]['items'] as $item) :
                ?>
                <tr>
                    <td class="location"><?=$item['location']?></td>
                    <td class="transport"><?=$item['transport']?></td>
                    <td class="time"><?=$item['time']?></td>
                    <td class="detail"><?=$item['content']?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endfor;?>
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

    $("a[data-toggle='view-gallery']").on('click',function(e){
        e.preventDefault();
        $.popup({url : $(this).attr('href'),width:1080,height:900});
    });

    $('.carousel').carousel({
        hAlign:'center',
        vAlign:'center',
        hMargin:0.8,
        reflection:true,
        shadow:false,
        mouse:false,
        speed:200,
        autoplay:false,
        slidesPerScroll:3,
        carouselWidth:1000,
        carouselHeight:450,
        frontWidth:480,
        frontHeight:360,
        backOpacity:0.5,
        directionNav:true
    });

    $("a[data-toggle='open-sybqna']").on('click', function(e){
        e.preventDefault();
        $("#pop-sybqna").remove();
        $("body").append($("<div>").attr('id',"pop-sybqna").append($("<div>").addClass("content")));
        $.get(base_url+'products/sybqna', {}, function(res){
            $("#pop-sybqna .content").html(res);
            $("#pop-sybqna").bPopup({
                modalClose:true,
                follow : [false, false],
                closeClass:'close',
            });
        });


    });
});
</script>