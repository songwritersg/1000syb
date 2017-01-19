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
                        <img src="<?=base_url($gallery['gll_path'])?>">
                    </div>
                </li>
            <?php endforeach?>
        </ul>
    </div>
</article>


<article class="panel panel-default" style="border-top:0px;">
    <div class="panel-heading bg-color-white">
        <h2 class="panel-title">항공별 가격안내<i class="icon-dollar-circle" style="color:#979797"></i></h2>
    </div>
    <div class="panel-body bg-color-white">
        <ol class="program-list">
            <?php foreach($product['program_list'] as $prog) :?>
                <li <?=$prog['prg_idx']==$prg_idx?'class="active"':''?>>
                    <div class="program-list-header">
                        <h5><?=$prog['prg_title']?></h5>
                        <a class="btn" href="<?=base_url("products/{$sca_parent}/{$sca_key}/{$product['prd_idx']}/{$prog['prg_idx']}")?>"><i class="icon-caret-down"></i></a>
                    </div>
                    <div class="program-list-body" <?=$prg_idx==$prog['prg_idx']?'style="display:block"':''?>>                        
                        <table class="table table-price table-bordered">
                            <?php if($prog['ppm_desc']):?>
                            <tr>
                                <th colspan="3" class="ppm-desc"><?=$prog['ppm_desc']?></th>
                            </tr>
                            <?php endif;?>
                            <?php foreach($prog['price_list'] as $price) : ?>
                            <tr>
                                <th rowspan="4" class="room-title col-xs-4"><?=$price['room_title']?></th>
                                <th class="th-row" class="col-xs-3">판매가</th>
                                <td class="col-xs-5 td-row"><?=number_format($price['ppr_price'])?>원</td>
                            </tr>
                            <tr>
                                <th class="th-row">유류할증료</th>
                                <td class="col-xs-5 td-row"><?=number_format($price['alf_adjustment'])?>원</td>
                            </tr>
                            <tr>
                                <th class="th-row" style="border-bottom-color:#767676;">총가격</th>
                                <td class="col-xs-5 td-row" style="border-bottom-color:#767676;"><?=number_format($price['ppr_price']+$prog['alf_adjustment'])?>원</td>
                            </tr>
                            <tr>
                                <th class="th-row highl">할인가</th>
                                <td class="col-xs-5 td-row highl"><?=number_format($price['ppr_price']+$prog['alf_adjustment']-$price['ppr_discount'])?>원</td>
                            </tr>
                            <?php endforeach;?>
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
            <li role="presentation"><a href="#product-info" aria-controls="product-info" role="tab" data-toggle="tab">리조트정보</a></li>
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
                    <?php if( isset($product['ben_content']) && is_array($product['ben_content']) ) :?>
                    <?php foreach($product['ben_content'] as $ben_content) :?>
                        <table class="table table-benefit">
                            <thead>
                            <tr>
                                <th><?=nl2br($ben_content['title'])?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($ben_content['content'] as $content) :?>
                            <tr>
                                <td><?=nl2br($content)?></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    <?php endforeach;?>
                    <?php endif;?>
                    <table class="table table-benefit">
                        <thead>
                        <tr>
                            <th class="include">포함사항<i class="icon-check-circle pull-right text-primary" style="font-size:20px;"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                            <td><?=$product['ben_include']?></td>
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
                            <td><?=$product['ben_exclude']?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div role="tabpanel" class="tab-pane fade" id="product-info">
            <div class="panel panel-primary margin-top-20 margin-bottom-0">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><i class="icon-clock pull-left" style="color:#21ffea;"></i>&nbsp;리조트 정보<i class="icon-caret-down" style="color:#21ffea;"></i></h4>
                </div>
                <div class="panel-body bg-color-white" style="border-bottom:0px;background-image:url(/static/images/products/product_info_symbol.jpg);background-repeat:no-repeat;background-position-x:95%; background-position-y:15px; background-size:50px;">
                    <h2 class="text-primary product-title"><?=element('prd_info_title',$product,"상품 제목이 없습니다.")?></h2>
                </div>
                <div class="panel-body bg-color-white">
                    <h4 class="img-title"><?=element('prd_info_img_a_title',$product,"이미지 그룹 이름이 없습니다.")?></h4>
                    <div class="row">
                        <div class="col-xs-12">
                            <img class="img-responsive" src="<?=file_check($product['prd_info_img_a_1'])?base_url($product['prd_info_img_a_1']):'/static/images/common/no_image_938x400.jpg'?>">
                        </div>
                    </div>
                    <div class="row margin-top-10">
                        <div class="col-xs-6" style="padding-right:7.5px;">
                            <img class="img-responsive" src="<?=file_check($product['prd_info_img_a_2'])?base_url($product['prd_info_img_a_2']):'/static/images/common/no_image_306x200.jpg'?>">
                        </div>
                        <div class="col-xs-6" style="padding-left:7.5px;">
                            <img class="img-responsive" src="<?=file_check($product['prd_info_img_a_3'])?base_url($product['prd_info_img_a_3']):'/static/images/common/no_image_306x200.jpg'?>">
                        </div>
                    </div>
                    <?php if(element('prd_info_img_a_desc',$product)) :?>
                    <div class="row">
                        <p class="well well-product-detail"><?=nl2br(element('prd_info_img_a_desc',$product,"이미지 그룹 설명이 없습니다."))?></p>
                    </div>
                    <?php endif;?>

                    <h4 class="img-title margin-top-10"><?=element('prd_info_img_b_title',$product,"이미지 그룹 이름이 없습니다.")?></h4>
                    <div class="row">
                        <div class="col-xs-6" style="padding-right:7.5px;">
                            <img class="img-responsive" src="<?=file_check($product['prd_info_img_b_1'])?base_url($product['prd_info_img_b_1']):'/static/images/common/no_image_464x575.jpg'?>">
                        </div>
                        <div class="col-xs-6" style="padding-left:7.5px;">
                            <img class="img-responsive" src="<?=file_check($product['prd_info_img_b_2'])?base_url($product['prd_info_img_b_2']):'/static/images/common/no_image_464x575.jpg'?>">
                        </div>
                    </div>

                    <?php if(element('prd_info_img_b_desc',$product)) :?>
                    <div class="row">
                        <p class="well well-product-detail"><?=nl2br(element('prd_info_img_b_desc',$product,""))?></p>
                    </div>
                    <?php endif;?>

                    <?php if($product['prd_info_extra']) :?>
                    <p class="info-extra" style="font-size:12px; letter-spacing:-0.05em;"><?=nl2br($product['prd_info_extra'])?></p>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="product-program-detail">
            <div class="panel panel-primary margin-top-20 margin-bottom-0" style="box-shadow:none !important;;">
                <div class="panel-heading">
                    <h4 class="panel-title text-center"><i class="icon-clock pull-left" style="color:#21ffea;"></i>&nbsp;일정표 보기<i class="icon-caret-down" style="color:#21ffea;"></i></h4>
                </div>
                <div class="panel-body no-padding" style="border:0px">
                    <?php for($day=1; $day<=count($program_info['schedule']); $day++) : ?>
                        <table class="table table-program table-bordered" style="margin-bottom:15px;">
                            <thead>
                                <tr>
                                    <th class="col-xs-6 bg-color-white" colspan="6" >
                                        <h4>
                                            <?=$day?>일차
                                            <div class="pull-right" style="font-size:12px;">
                                                <?=$program_info['schedule'][$day-1]['meal']['b'] ? "<label class='label label-default'>B</label>&nbsp;{$program_info['schedule'][$day-1]['meal']['b']}":""?>
                                                <?=$program_info['schedule'][$day-1]['meal']['l'] ? "<label class='label label-default'>L</label>&nbsp;{$program_info['schedule'][$day-1]['meal']['l']}":""?>
                                                <?=$program_info['schedule'][$day-1]['meal']['d'] ? "<label class='label label-default'>D</label>&nbsp;{$program_info['schedule'][$day-1]['meal']['d']}":""?>
                                            </div>
                                        </h4>

                                    </td>                                
                                </tr>
                                <tr>
                                    <th class="col-xs-2 text-center">지역</th>
                                    <th class="col-xs-2 text-center">교통편</th>
                                    <th class="col-xs-2 text-center">시간</th>
                                    <th class="col-xs-6 text-center">내용</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($program_info['schedule'][$day-1]['items'] as $item) :?>
                                    <tr>
                                        <td class="location text-center"><?=$item['location']?></td>
                                        <td class="transport text-center"><?=$item['transport']?></td>
                                        <td class="time text-center"><?=$item['time']?></td>
                                        <td class="detail bg-color-white" style="font-size:12px !important;"><?=$item['content']?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endfor;?>
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
                <table class="table table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th class="col-xs-3">은행명</th>
                        <th class="col-xs-6">계좌번호</th>
                        <th class="col-xs-3">예금주</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>KB국민은행</td>
                        <td>268801-04-202744</td>
                        <td>(주)네이버네트워크</td>
                    </tr>
                    <tr>
                        <td>KB국민은행</td>
                        <td>431802-01-373419</td>
                        <td>(주)네이버네트워크</td>
                    </tr>
                    </tbody>
                </table>
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
           if ( selectedTab == '#product-program-detail')
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