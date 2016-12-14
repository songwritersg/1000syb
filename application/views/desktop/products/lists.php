<article class="container-fluid" id="product-lists-info">
    <div class="video-container">
        <div id="bgplayer"></div>
        <div id="bgthumb" style="background:url(<?=$category['sca_info_bg_thumb']?>) no-repeat top center;"></div>
        <script>
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/player_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            var player;

            function onYouTubeIframeAPIReady() {
                player = new YT.Player('bgplayer', {
                    height: $(document).width() * 1080 / 1920,
                    width:  $(document).width(),
                    videoId: '<?=$category['sca_info_bg_mp4']?>',
                    playerVars : {
                        showinfo : 0,
                        autoplay : 1,
                        loop : 1,
                        controls : 0,
                        playlist : '<?=$category['sca_info_bg_mp4']?>'
                    },
                    rel: 0,
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange' : onStateChange
                    }
                });
            }
            function onPlayerReady(event){
                player.setPlaybackQuality( player.getAvailableQualityLevels() );
                player.mute();
            }

            function onStateChange(event){
                if( event.data == YT.PlayerState.PLAYING) {
                    $("#bgthumb").hide();
                }
                else {
                    $("#bgthumb").show();
                }
            }

            $(function(){
                $(window).resize(function(){
                    var iframe_height = $(document).width() * 1080 / 1920;
                    $(".video-container").css({'width': $(document).width(),'height':iframe_height});
                    $(".video-container #bgplayer").attr({'height':'500px','width':$(document).width()});
                }).resize();
            });
        </script>
    </div>
    <div  id="info-container">
        <div class="container">
            <div class="title-container">
                <h2 class="category-title"><?=$category['sca_info_title']?></h2>
                <p class="category-subtitle"><?=$category['sca_info_subtitle']?></p>
            </div>
            <div class="desc-container"><?=nl2br($category['sca_info_description'])?></div>
        </div>
    </div>
    <div class="container">
        <ul class="top-product-list">
            <?php
            for($i=1; $i<=3; $i++) :
                if( $category["sca_top_{$i}"] && element('prd_idx',$category["sca_top_{$i}"]) ) : ?>
                <li class="top-product">
                    <label class="top-label">TOP<br><?=$i?></label>
                    <img class="product-thumbnail" src="<?=base_url($category["sca_top_".$i]['prd_thumb'])?>" alt="<?=$category["sca_top_".$i]['prd_title']?>">
                    <div class="img-overlay"></div>
                    <div class="product-detail">
                        <h4><?=preg_replace("/\\[|\\]/","",$category["sca_top_".$i]['prd_title'])?></h4>
                        <p><?=$category["sca_top_".$i]['prd_detail']?></p>
                        <a class="btn btn-primary" href="<?=base_url("products/{$category['sca_top_'.$i]['sca_parent']}/{$category['sca_top_'.$i]['sca_key']}/{$category['sca_top_'.$i]['prd_idx']}")?>">상품보기&nbsp;<i class="fa fa-caret-right"></i></a>
                    </div>
                </li>
            <?php
                endif;
            endfor;?>
        </ul>
    </div>
</article>

<script>
    $(function(){
       $(".top-product").on('mouseover', function(){
           $(this).find('.img-overlay').stop().fadeTo('100', 0.8);
           $(this).stop().animate({borderWidth : 2},100);
           $(this).find('.product-detail').stop().animate({
               top : '110px'
           },100);
       }).on('mouseleave', function(){
           $(this).find('.img-overlay').stop().fadeOut('100');
           $(this).stop().animate({borderWidth : 0},100);
           $(this).find('.product-detail').stop().animate({top : '225px'},100);
       });
    });
</script>

<article class="container-fluid" id="product-lists" style="background:#fff;">
    <div class="container">
        <h2 class="category-title"><strong><?=strtoupper($category['sca_info_title'])?></strong>&nbsp;AREA</h2>
        <ul class="category-list">
            <?php foreach($category['children'] as $cate) : ?>
            <li <?=$selected==$cate['sca_key']?'class="active"':''?>><a href="<?=base_url("products/{$category['sca_key']}/{$cate['sca_key']}")?>"><?=$cate['sca_name']?></a></li>
            <?php endforeach;?>
        </ul>
        <div class="product-list">
            <ul>
                <?php foreach($lists as $row) :?>
                <li>
                    <a href="<?=base_url("products/{$category['sca_key']}/{$selected}/{$row['prd_idx']}")?>">
                        <div class="thumbnails">
                            <img src="<?=$row['prd_thumb']?>" alt="<?=$row['prd_title']?>">
                        </div>
                        <div class="info">
                            <h4 class="city-name"><?=$row['cty_name']?></h4>
                            <h3 class="product-title"><?=$row['prd_title']?></h3>
                            <p class="description">
                                <span class="price"><?=($row['ppr_price'] >0 ? number_format($row['ppr_price']). '<small>원~</small>' : '<small>가격문의</small>')?></span>
                                <i class="fa fa-chevron-circle-right"></i>
                            </p>
                        </div>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</article>

<script>
    $(function(){
    });
</script>