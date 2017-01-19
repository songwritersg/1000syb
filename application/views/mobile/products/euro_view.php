<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.min.js")?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css")?>
<h2 class="page-title"><a href="<?=base_url("products/{$category['sca_key']}")?>"><?=$category['sca_info_title']?></a><small><?=$category['sca_info_subtitle']?></small></h2>

<article class="panel panel-default margin-bottom-0">
    <div class="panel-heading" style="">
        <h2 class="panel-title"><?=$product['prd_title']?><i class="icon-location" style="color:#979797"></i></h2>
    </div>
    <div class="panel-body" id="product-galleries">
        <ul class="slides" id="product-gallery-list">

            <?php foreach($product['gallery_list'] as $gallery) : ?>
                <li>
                    <div class="img-container">
                        <img src="<?=$gallery?>">
                    </div>
                </li>
            <?php endforeach?>
        </ul>
    </div>
</article>


<article class="panel panel-default" style="border-top:0px;">
    <div class="panel-heading" style="background:#f7f7f7">
        <h2 class="panel-title">항공별 가격안내<i class="icon-dollar-circle" style="color:#979797"></i></h2>
    </div>
    <div class="panel-body">
        <ol class="program-list">
            <?php foreach($program_list as $prog) :?>
                <li <?=$prog['prg_idx']==$prg_idx?'class="active"':''?>>
                    <div class="program-list-header">
                        <h5><?=$prog['airline_name']?> <small>(<?=$prog['start_date']?>~<?=$prog['end_date']?>)</small></h5>
                        <a class="btn" href="<?=base_url("products/{$sca_parent}/{$sca_key}/{$product['prd_idx']}/{$prog['prg_idx']}")?>"><i class="icon-caret-down"></i></a>
                    </div>
                    <div class="program-list-body" <?=$prg_idx==$prog['prg_idx']?'style="display:block"':''?>>
                        <table class="table table-price table-bordered">
                            <tr>
                                <th class="th-row" class="col-xs-4">분류</th>
                                <td class="col-xs-8 td-row"><?=$prog['flight_type']?></td>
                            </tr>
                            <tr>
                                <th class="th-row" style="border-bottom-color:#767676;">출발가능일자</th>
                                <td class="col-xs-4 td-row" style="border-bottom-color:#767676;"><?=$prog['start_date']?>~<?=$prog['end_date']?></td>
                            </tr>
                            <tr>
                                <th class="th-row highl">판매가</th>
                                <td class="col-xs-8 td-row highl"><?=number_format($prog['price'])?>원</td>
                            </tr>
                        </table>
                    </div>
                </li>
            <?php endforeach;?>
        </ol>
    </div>
</article>
<style>
</style>
<article class="container">
    <div class="row bg-color-white ">
        <ul class="nav nav-pills nav-justified">
            <li role="presentation" class="active"><a href="#product-benefit" aria-controls="product-benefit" role="tab" data-toggle="tab">상품특전</a></li>
            <li role="presentation"><a href="#product-info" aria-controls="product-info" role="tab" data-toggle="tab">관광지정보</a></li>
            <li role="presentation"><a href="#product-program-detail" aria-controls="product-program-detail" role="tab" data-toggle="tab">일정표 보기</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="product-benefit">
            <div class="panel panel-primary margin-top-20 margin-bottom-0">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><i class="icon-clock pull-left" style="color:#21ffea;"></i>&nbsp;상품특전<i class="icon-caret-down" style="color:#21ffea;"></i></h4>
                </div>
                <div class="panel-body no-padding">
                    <?php foreach($view['DIFFERENT_POINT_INFO'] as $diff) :?>
                        <table class="table table-benefit">
                            <thead>
                            <tr>
                                <th><?=$diff['CityName']?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?=nl2br($diff['Content'])?></td>
                            </tr>
                            </tbody>
                        </table>
                    <?php endforeach;?>

                    <?php foreach($view['RULE_INFO'] as $benefit) :?>
                        <table class="table table-benefit">
                            <thead>
                            <tr>
                                <th>상품특전</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=nl2br($benefit['BonusContent'])?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-benefit">
                            <thead>
                            <tr>
                                <th class="include">포함사항<i class="icon-check-circle pull-right text-primary" style="font-size:20px;"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <td><?=$benefit['InclusionContent']?></td>
                            </tbody>
                        </table>
                        <table class="table table-benefit">
                            <thead>
                            <tr>
                                <th class="exclude">불포함 사항<i class="icon-cancel pull-right text-danger" style="font-size:20px;"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?=$benefit['NotInclusionContent']?></td>
                            </tr>
                            </tbody>
                        </table>
                    <?php endforeach;?>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="product-info">
            <div class="panel panel-primary margin-top-20 margin-bottom-0">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><i class="icon-clock pull-left" style="color:#21ffea;"></i>&nbsp;관광지 정보<i class="icon-caret-down" style="color:#21ffea;"></i></h4>
                </div>
                <div class="panel-body bg-color-white" style="border-bottom:0px;background-image:url(/static/images/products/product_info_symbol.jpg);background-repeat:no-repeat;background-position-x:95%; background-position-y:15px; background-size:50px;">
                    <h2 class="text-primary product-title"><?=$product['prd_title']?></h2>
                </div>
                <div class="panel-body bg-color-white">
                    <div class="flexslider" id="resort-flexslider" style="margin-bottom:30px;">
                        <ul class="slides">
                            <?php foreach($view['TOUR_LOCATION_INFO'] as $tour) :?>
                                <li class="euro-resort-info">
                                    <div class="img-thumb" style="background-image:url('<?=$tour['ImgUrl']?>');"></div>
                                    <table class="table table-bordered" summary="<?=$tour['NationName']?>/<?=$tour['CityName']?> 관광지 정보">
                                        <tr>
                                            <th>국가/도시</th>
                                            <td><?=$tour['NationName']?>/<?=$tour['CityName']?></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2">관광지안내</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p class="ellipsis"><?=nl2br(trim(strip_tags($tour['Description'])))?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div role="tabpanel" class="tab-pane fade" id="product-program-detail">
            <div class="panel panel-primary margin-top-20 margin-bottom-0" style="box-shadow:none !important;;">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><i class="icon-clock pull-left" style="color:#21ffea;"></i>&nbsp;일정표 보기<i class="icon-caret-down" style="color:#21ffea;"></i></h4>
                </div>
                <div class="panel-body no-padding" style="border:0px">

                    <?php for($day=1; $day<=count($view['schedule']); $day++) : ?>
                    <table class="table table-program table-bordered" style="margin-bottom:15px;">
                        <thead>
                        <tr>
                            <th class="col-xs-6 bg-color-white" colspan="6" ><h4><?=$day?>일차</h4></th>
                        </tr>
                        <tr>
                            <th class="col-xs-2 text-center">지역</th>
                            <th class="col-xs-2 text-center">교통편</th>
                            <th class="col-xs-2 text-center">시간</th>
                            <th class="col-xs-6 text-center">내용</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($view['schedule'][$day-1] as $item) :?>
                            <tr>
                                <td class="location text-center"><?=$item['CityName']?></td>
                                <td class="transport text-center"><?=$item['TrafficNo']?></td>
                                <td class="time text-center"><?=$item['TrafficTime']?></td>
                                <td class="detail bg-color-white" style="font-size:12px !important;"><?=$item['TourType']?"<small>[{$item['TourType']}]</small>":''?>&nbsp;<?=$item['Content']?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    <?php endfor;?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</article>

<article class="margin-top-20 container">
    <button class="btn btn-default-gradient btn-block btn-lg" style="font-size:14px;" type="button" data-toggle="collapse" data-target="#travel-info" aria-expanded="false" aria-controls="travel-info">여행 필수 체크사항&nbsp;<i style="color:#979797;" class="icon-plus-circle"></i></button>
    <div class="collapse" id="travel-info">
        <h3><i class="icon-check-circle">여행 필수 체크사항</i></h3>

        <div class="panel panel-dark margin-bottom-10">
            <div class="panel-heading"  data-toggle="collapse" data-target="#cancel-info" aria-expanded="false" aria-controls="travel-info">
                <h4 class="panel-title">예약취소료 규정 <i class="icon-caret-down pull-right"></i></h4>
            </div>
            <div class="panel-body collapse" id="cancel-info" style="font-size:12px; letter-spacing:-0.05em;">
                <?=stripslashes($this->site->config('product_cancel_info'))?>
            </div>
        </div>


        <div class="panel panel-dark margin-bottom-10">
            <div class="panel-heading"  data-toggle="collapse" data-target="#cost-info" aria-expanded="false" aria-controls="travel-info">
                <h4 class="panel-title">추가경비 <i class="icon-caret-down pull-right"></i></h4>
            </div>
            <div class="panel-body collapse" id="cost-info" style="font-size:12px; letter-spacing:-0.05em;">
                <?=stripslashes($product['prd_extra_cost'])?>
            </div>
        </div>


        <div class="panel panel-dark margin-bottom-10">
            <div class="panel-heading"  data-toggle="collapse" data-target="#preperation-info" aria-expanded="false" aria-controls="travel-info">
                <h4 class="panel-title">유의사항/준비물 <i class="icon-caret-down pull-right"></i></h4>
            </div>
            <div class="panel-body collapse" id="preperation-info" style="font-size:12px; letter-spacing:-0.05em;">
                <?=stripslashes($product['prd_preperation'])?>
            </div>
        </div>

        <div class="panel panel-dark margin-bottom-10">
            <div class="panel-heading"  data-toggle="collapse" data-target="#shop-info" aria-expanded="false" aria-controls="travel-info">
                <h4 class="panel-title">쇼핑안내 <i class="icon-caret-down pull-right"></i></h4>
            </div>
            <div class="panel-body collapse" id="shop-info" style="font-size:12px; letter-spacing:-0.05em;">
                <?=stripslashes($product['prd_shop_info'])?>
            </div>
        </div>

        <div class="panel panel-dark margin-bottom-10">
            <div class="panel-heading"  data-toggle="collapse" data-target="#account-info" aria-expanded="false" aria-controls="travel-info">
                <h4 class="panel-title">입금계좌 <i class="icon-caret-down pull-right"></i></h4>
            </div>
            <div class="panel-body collapse" id="account-info" style="font-size:12px; letter-spacing:-0.05em;">

            </div>
        </div>
    </div>
</article>
<script>
    $(function(){

        $("#product-galleries").flexslider({
            controlNav : false,
            animation : 'slide'
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var selectedTab = $(e.target).attr("href") // activated tab
            if( $(selectedTab + ' .flexslider' ).length  ){

                $(window).trigger('resize'); //this should fix for you but you can also try this
                var carousel_sliders = $(selectedTab + ' .flexslider');
                for (var i = 0; i < carousel_sliders.length; i++) {
                    var element = carousel_sliders.eq(i);
                    element.flexslider({
                        animation: "slide",
                        slideshow:false,
                        slideshowSpeed : 5000,
                        prevText:"",
                        nextText:"",
                        controlNav:false
                    });
                }
            }
            else if ( selectedTab == '#product-program-detail')
            {
                $("table.table.table-program").each(function(){
                    var $table = $(this);
                    $table.find("tbody > tr").each(function(row) {
                        $table.rowspan(row);
                    });
                });
            }
        });

    });
</script>