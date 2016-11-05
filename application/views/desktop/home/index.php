<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.min.js")?>
<?=$this->site->add_js("/static/js/main.js")?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css")?>

<?php if( count($main_slide_banners) > 0 ) :?>
<!-- START:메인 슬라이드-->
<article class="container-fluid">
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
                                    <img src="<?=base_url("static/images/main/sample_maldives.png")?>" alt="몰디브 사진">
                                    <figcaption>몰디브</figcaption>
                                </figure>
                                <div class="mask"></div>
                                <a href="https://www.youtube.com/embed/_WpcDGqV79M" class="youtube-icon" data-toggle="youtube-link" data-width="800" data-height="600"></a>
                            </div>
                            <div class="desc">
                                <h4 class="desc-title">#Maldives.</h4>
                                <span class="sub-title">올인크루시브 리조트 특별혜택</span>
                            </div>
                        </li>

                        <li class="card">
                            <div class="thumbnail">
                                <figure>
                                    <img src="<?=base_url("static/images/main/sample_maldives.png")?>" alt="몰디브 사진">
                                    <figcaption>몰디브</figcaption>
                                </figure>
                                <div class="mask"></div>
                                <a href="https://www.youtube.com/embed/_WpcDGqV79M" class="youtube-icon" data-toggle="youtube-link" data-width="800" data-height="600"></a>
                            </div>
                            <div class="desc">
                                <h4 class="desc-title">#Maldives.</h4>
                                <span class="sub-title">올인크루시브 리조트 특별혜택</span>
                            </div>
                            <div class="desc">
                                <h4 class="desc-title">#Maldives.</h4>
                                <span class="sub-title">올인크루시브 리조트 특별혜택</span>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="col-7 col">
                <div class="row" id="image-section">
                    <div class="col col-6">
                        <a href="#" class="imgcard imgcard-honeymoon">허니문 견적문의</a>
                    </div>

                    <div class="col col-6">
                        <a href="#" class="imgcard imgcard-estimate">1:1상담신청하기</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<!-- END: Intro Section -->

<!-- START: Middle Banner -->
<?php foreach( $main_middle_banners as $banner) : ?>
<article class="container-fluid">
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
        <ul class="slide-indicator">
            <li><a href="javasscript:;" onclick="best_honeymoon_slider.move_prev();"><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="javasscript:;" onclick="best_honeymoon_slider.move_next();"><i class="fa fa-chevron-right"></i></a></li>
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
                <li class="left"><a href="javascript:;" onclick="best_honeymonn_list_slider.move_prev();"><i class="fa fa-chevron-left"></i></a> </li>
                <li class="right"><a href="javascript:;" onclick="best_honeymonn_list_slider.move_next();"><i class="fa fa-chevron-right"></i></a> </li>
            </ol>
            <ul class="slides">
                <?php for($i=0; $i<=12; $i++):?>
                <li>
                    <a href="#">
                        <img src="http://placehold.it/260x195" alt="260x195">
                        <div class="content">
                            <h6>KOH KOKUT</h6>
                            <p>[오전출발] 반얀트리<br>풀빌라 4박5일<i class="fa fa-chevron-circle-right "></i></p>
                        </div>
                    </a>
                </li>
                <?php endfor;?>
            </ul>
        </div>
    </div>
</article>
<!-- End:Best 허니문 추천지역-->