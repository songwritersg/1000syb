<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.min.js")?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css")?>

<article id="main-slide">
    <div class="main-slide-container flexslider">
        <ul class="slides">
            <?php foreach($mobile_slide_banners as $slide) : ?>
                <li><a<?=$slide['tag']?>><img src="<?=base_url($slide['ban_image'])?>" alt="<?=$slide['ban_title']?>"></a></li>
            <?php endforeach;?>
        </ul>
    </div>
</article>

<script>
$(function(){
    $("#main-slide .flexslider").flexslider({
        animation:'slide',
        controlNav : false
    }) ;
});
</script>

<article id="main-banner-tel">
    <div class="container">
        <a href="<?=base_url("board/sybqna")?>">QnA 허니문 온라인 상담</a>
        <a class="banner-tel" href="tel:02-720-8876">T. 02-720-8876</a>
    </div>
</article>

<?php
// BEST 상품 리스트를 가져온다.
$best_products = json_decode( $this->site->config('product_best_mobile'), TRUE );
foreach ( $best_products as &$prd)
{
    $prd['prd_thumb'] = "";
    $this->db->where('prd_idx', $prd['idx']);
    $result = $this->db->get('tbl_product');
    if( $product = $result->row_array() ) {
        $prd['prd_thumb'] = $product['prd_thumb'];
    }
}
?>

<article id="main-recommend-resort" class="container">
    <div class="recommend-container">
        <ul class="slides">
            <?php foreach($best_products as $row):?>
            <li>
                <a href="<?=base_url("products/{$row['sca_parent']}/{$row['sca_key']}/{$row['idx']}")?>">
                    <h3 class="text-center"><strong class="text-primary"><?=$row['location']?></strong> 추천 허니문</h3>
                    <div class="thumb">
                        <img src="<?=base_url($row['prd_thumb'])?>" alt="<?=$row['title']?>">
                    </div>
                    <div class="content">
                        <h4><?=$row['title']?></h4>
                        <p><?=$row['description']?></p>
                    </div>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
        <ul class="flex-direction-nav">
            <li class="flex-nav-prev"><a class="flex-prev" href="#">Previous</a></li>
            <li class="flex-nav-next"><a class="flex-next" href="#">Next</a></li>
        </ul>
    </div>
</article>


<script>
    var $slider = $("#main-recommend-resort .recommend-container");
        $slider.is_animate = false;
        $slider.current_slide = 0;
        $slider.touchStartX = 0;
        $slider.touchStartY = 0;
        $slider.touchEndX = 0;
        $slider.touchEndY = 0;
        $slider.touching = false;
        $slider.find('.slides > li').eq( $slider.current_slide ).css('opacity', 1);
        $slider.on('touchstart', function(e){
            var touch = typeof e.originalEvent.touches[0] != 'undefined' ? e.originalEvent.touches[0] : null;
            if( ! touch ) return;
            $slider.touchStartX = touch.pageX;
            $slider.touchStartY = touch.pageY;
            $slider.touching = true;

        }).on('touchmove', function(e){
            if( $slider.touching )
            {
                var touch = e.originalEvent.touches[0];
                $slider.touchEndX = touch.pageX;
                $slider.touchEndY = touch.pageY;
            }
        }).on('touchend', function(e){
            var diffX = $slider.touchEndX - $slider.touchStartX;
            var diffY = $slider.touchEndY - $slider.touchStartY;

            // 터치를 움직인 방향이 위아래보다 좌우가 더 많을때만 실행
            // 터치를 움직인 거리가 어느정도 이상일때만 동작
            if( Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > window.outerWidth / 20 )
            {
                if( $slider.touchStartX > $slider.touchEndX ) {
                    $slider.move_next();
                }
                else {
                    $slider.move_prev();
                }
            }

            $slider.touching = false;
            $slider.touchStartX = $slider.touchStartY = $slider.touchEndX = $slider.touchEndY = 0;

        });
        $slider.find('ul.flex-direction-nav > li > a.flex-prev').on('click', function(e){
            $slider.move_prev();
            e.preventDefault();
        });
        $slider.find('ul.flex-direction-nav > li > a.flex-next').on('click', function(e){
            $slider.move_next();
            e.preventDefault();
        });

    $(function(){
        $(window).resize(function(){
            $slider.container_width = $slider.width();
            $slider.slide_ul = $slider.find('ul.slides');
            $slider.slide_length = $slider.slide_ul.find(' > li').length;
            $slider.slide_ul_width = ($slider.container_width * $slider.slide_length) + (10 * ($slider.slide_length-1));
            $slider.image_height = $slider.container_width * 5 / 8;

            $("#main-recommend-resort").css('height', $slider.container_width * 0.625 + 175);

            $slider.find('ul.slides').css('width', $slider.slide_ul_width );
            $slider.find('ul.slides > li, ul.slides > li .thumb, ul.slides > li .thumb > img').css('width', $slider.container_width);
            $slider.find('ul.slides > li .thumb > img').css('height', $slider.image_height);

            $slider.move_next = function(){
                if( $slider.is_animate == true) return;
                if( $slider.current_slide >= $slider.slide_length - 1 ) return;

                $slider.is_animate = true;
                $slider.current_slide++;
                $slider.move_current();
            };

            $slider.move_prev = function() {
                if( $slider.is_animate == true) return;
                if( $slider.current_slide <= 0 ) return;

                $slider.is_animate = true;
                $slider.current_slide--;
                $slider.move_current();
            }

            $slider.move_current = function() {
                $slider.slide_ul.animate({
                    'left' : - ( $slider.current_slide * $slider.container_width + (10 * $slider.current_slide - 1 ) )
                },300, function(){
                    $slider.is_animate = false;
                });
                ($slider.slide_ul.find(' > li').eq( $slider.current_slide )).stop().animate({
                    'opacity' : 1,
                },300);
                ($slider.slide_ul.find(' > li').eq( $slider.current_slide + 1 )).stop().animate({
                    'opacity' : 0.5,
                },300);
                ($slider.slide_ul.find(' > li').eq( $slider.current_slide -1 )).stop().animate({
                    'opacity' : 0.5,
                },300);
            }

        }).resize();
    });
</script>

<article id="main-recent-notice" class="container">
    <h2 class="recent-title"><a href="<?=base_url("board/sybnotice")?>">공지사항</a></h2>
    <?php $recent_list = $this->board_model->get_recent("sybnotice");?>
    <ul class="recent-list">
        <?php foreach($recent_list as $i=>$post ) : if($i>=3) continue; ?>
            <li class="row">
                <a href="<?=$post['post_link']?>">
                    <div class="title col-xs-8"><?=($post['is_new'])?'<img class="icon-new" alt="NEW" src="/static/images/common/icon_new.gif">':''?><?=$post['post_title']?></div>
                    <div class="regtime col-xs-4 text-right"><?=date('y.m.d.', strtotime($post['post_regtime']))?></div>
                </a>
            </li>
        <?php endforeach;?>
    </ul>
</article>

<div class="clearfix" style="background:#f5f5f5;height:15px;"></div>

<article id="main-recent-review" class="container">
    <h2 class="recent-title bottom-border-none"><a href="<?=base_url("board/trstory")?>"><strong class="text-primary">Best</strong> 허니문 후기</a></h2>
    <?php $recent_list = $this->board_model->get_recent("trstory");?>
    <ul class="recent-list row">
        <?php
        $i = 0;
        foreach($recent_list as $post ) : if($i>=2 OR $post['is_notice']) continue; ?>
            <li class="col-xs-6">
                <a class="item" href="<?=$post['post_link']?>">
                    <figure class="recent-thumb">
                        <img class="img-responsive" src="<?=get_post_image($post['post_content'],360)?get_post_image($post['post_content'],360):base_url('static/images/common/no_image_570x380.jpg')?>">
                        <figcaption class="figcaption"><?=$post['post_title']?></figcaption>
                    </figure>
                    <div class="col-xs-12">
                        <h3 class="recent-post-title"><?=$post['post_title']?></h3>
                        <p class="recent-post-description"><?=cut_str(trim(strip_tags($post['post_content'],"<br>")),100)?></p>
                    </div>
                </a>
            </li>
        <?php
        $i++;
        endforeach;?>
    </ul>
</article>