<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.min.js")?>
<?=$this->site->add_js("/static/js/main.min.js")?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css")?>
<style>
    .flexslider { border:0px;}
</style>
<?php if( count($main_slide_banners) > 0 ) :?>
<!-- START:메인 슬라이드-->
<article class="container-fluid" id="main-slide-container">
    <h2 class="hide">메인 슬라이드</h2>
    <div class="flexslider" id="main-slide">
        <ul class="slides">
            <?php foreach($main_slide_banners as $slide) : ?>
                <li><a<?=$slide['tag']?>><img src="<?=base_url($slide['ban_image'])?>" alt="<?=$slide['ban_title']?>"></a></li>
            <?php endforeach;?>
        </ul>
        <?php if(count($main_slide_banners) > 1) :?>
            <div class="slide-indicator">
                <ol><?php for($i=1; $i<=count($main_slide_banners); $i++) :
                        ?><li><a href="#"><?=$i?></a></li><?php
                    endfor;?></ol>
            </div>
        <?php endif;?>
    </div>
</article>
<!-- END:메인 슬라이드-->
<?php endif;?>

<!-- START: Intro Section -->
<article class="container-fluid">
    <h2 class="hide">허니문 지역</h2>
    <div class="container">
        <h2 class="section-title"><img alt="허니문 지역" src="<?=base_url("static/images/main/title_resort_info.png");?>"></h2>

        <div class="row">
            <div class="col-5 col">
                <div class="flexslider" id="movie-slider">
                    <ul class="slides">
                        <li class="card">
                            <div class="thumbnail">
                                <figure>
                                    <img src="<?=base_url("static/images/main/thumb_canc.png")?>" alt="시크릿 더 바인">
                                    <figcaption>시크릿 더 바인</figcaption>
                                </figure>
                                <div class="mask"></div>
                                <a href="https://player.vimeo.com/video/193016225" class="youtube-icon" data-toggle="youtube-link" data-width="800" data-height="600"></a>
                            </div>
                            <div class="desc">
                                <h4 class="desc-title">#Cancun</h4>
                                <span class="sub-title">Secrets The Vine</span>
                            </div>
                        </li>

                        <li class="card">
                            <div class="thumbnail">
                                <figure>
                                    <img src="<?=base_url("static/images/main/thumb_bali.png")?>" alt="발리 로얄 산트리안">
                                    <figcaption>발리 로얄 산트리안</figcaption>
                                </figure>
                                <div class="mask"></div>
                                <a href="https://player.vimeo.com/video/178277388" class="youtube-icon" data-toggle="youtube-link" data-width="800" data-height="600"></a>
                            </div>
                            <div class="desc">
                                <h4 class="desc-title">#Bali</h4>
                                <span class="sub-title">로얄 산트리안</span>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="col-7 col">
                <div class="row" id="image-section">
                    <div class="col col-6">
                        <a href="<?=base_url("board/sybqna/write")?>" class="imgcard imgcard-honeymoon">허니문 견적문의</a>
                    </div>

                    <div class="col col-6">
                        <a href="<?=base_url("counseling/call")?>" class="imgcard imgcard-estimate">1:1상담신청하기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<!-- END: Intro Section -->

<!-- START: Middle Banner -->
<?php foreach( $main_middle_banners as $banner) : ?>
<article class="container-fluid" style="margin-bottom:30px">
    <h2 class="hide">허니문 소개 배너</h2>
    <div class="container">
        <a<?=$banner['tag']?> style="display:block;"><img style="width:100%" class="wide-banner img-hover" src="<?=base_url($banner['ban_image'])?>" alt="<?=$banner['ban_title']?>"></a>
    </div>
</article>
<?php endforeach;?>
<!-- END: Middle Banner -->

<!-- START:Best 허니문 추천지역-->
<article class="continer-fluid" id="best-honeymoon">
    <h2 class="hide">BEST 허니문 추천지역</h2>
    <div class="container">
        <ul class="slide-indicator" id="best-honeymmon-slide-indicator">
            <li><a href="javascript:;" data-action="prev"><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="javascript:;" data-action="next"><i class="fa fa-chevron-right"></i></a></li>
        </ul>
        <h4>
            BEST <strong>허니문 추천지역</strong>
        </h4>
        <div id="slide-best-honeymoon">
            <ul class="slides">
                <?php
                $i=0;
                foreach($main_best_banners as $slide) :
                    if( $i%2 == 0 && $i != 0) echo "</li>";
                    if( $i%2 == 0 ) echo "<li>";
                    ?>
                    <a<?=$slide['tag']?>><img src="<?=base_url($slide['ban_image'])?>" alt="<?=$slide['ban_title']?>"></a>
                    <?php
                    $i++;
                endforeach;?>
                </li>
            </ul>
        </div>

        <div id="slide-best-honeymoon-list" >
            <ol class="slide-indicator">
                <li class="left"><a href="javascript:;" data-action="prev"><i class="fa fa-chevron-left"></i></a> </li>
                <li class="right"><a href="javascript:;" data-action="next"><i class="fa fa-chevron-right"></i></a> </li>
            </ol>
            <ul class="slides">
                <?php foreach($best_products as $row):?>
                <li>
                    <a href="<?=base_url("products/{$row['sca_parent']}/{$row['sca_key']}/{$row['prd_idx']}")?>">
                        <img src="<?=base_url($row['prd_thumb'])?>" alt="260x195">
                        <div class="content">
                            <h6><?=$row['cty_name_kr']?></h6>
                            <p><?=preg_replace("/\\[|\\]/","",$row['prd_title'])?><i class="fa fa-chevron-circle-right "></i></p>
                        </div>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</article>
<!-- End:Best 허니문 추천지역-->

<?php
if($this->site->config('site_poplayer') && ! $this->input->cookie('syb_poplayer')) :
    $poplayer = json_decode($this->site->config('site_poplayer'), TRUE);
    if($poplayer['active'] == 'Y') : ?>
    <div id="mask"></div>
    <div id="popup-layer" style="width:<?=$poplayer['width']?>px; height:<?=$poplayer['height']?>px; margin-left:-<?=$poplayer['width']/2?>px; margin-top:-<?=$poplayer['height']/2?>px;">
        <img src="<?=base_url($poplayer['file_name'])?>" style="width:<?=$poplayer['width']?>px; height:<?=$poplayer['height']?>px;" alt="팝업 공지">
        <button type="button" data-toggle="close">&times;</button>
        <button type="button" data-toggle="cookie-close">오늘 하루 열지 않기</button>
    </div>
    <script>
        $("#popup-layer [data-toggle='close']").on('click',function(){
            $("#popup-layer").remove();
            $('#mask').remove();
        });
        $("#popup-layer [data-toggle='cookie-close']").on('click',function(){
            $.cookie('syb_poplayer', 1, {expires:1});
            $("#popup-layer").remove();
            $('#mask').remove();
        });
    </script>
    <?php
    endif;
endif;?>