<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.min.js")?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css")?>
<style>
    body { background:#1c1d21;}
    #header { position:relative; height:60px; width:100%; border-bottom:1px solid #3a3c44; display:table; table-layout:fixed; white-space:nowrap;}
    #header .header-icon { width:160px; display:table-cell; border-right:1px solid #3a3c44; line-height:1em; text-align:center;vertical-align: middle; height:60px; padding:0px 25px;}
    #header .header-icon img { vertical-align:middle;  }
    #header .header-text { display:table-cell; vertical-align:middle; height:60px; width:10000px; padding:0px 25px; font-size:18px; color:#fff;}
    #header .header-close { display:table-cell; vertical-align:middle; height:60px; text-align:center; width:60px; padding:0px 16px; border-left:1px solid #3a3c44;}
    #section { padding:40px 0px; 680px; border-bottom:1px solid #3a3c44; position:relative;}
    #section .directionNav { position:absolute; top:50%; margin-top:-16px; width:100%;}
    #section .directionNav li a { position:absolute; top:0px; left:50%; }
    #section .directionNav li a.prev {margin-left:-460px;}
    #section .directionNav li a.next {margin-left:430px;}
    #section .directionNav li a:hover { opacity:0.7; }
    #section #slider { width:800px; height:600px; margin-left:auto; margin-right:auto; border:0px; margin-bottom:0px; }
    #section #slider .slides {}
    #section #slider .slides li {}
    #section #slider .slides li img { width:800px;height:600px; }
    #footer { padding:20px 0px; position:relative;}
    #footer .thumb-custom-nav { position:absolute; top:20px; width:100%; list-style:none;}
    #footer .thumb-custom-nav li a { position:absolute; top:0px; outline:0px; left:50%;}
    #footer .thumb-custom-nav li a.prev { margin-left:-430px; }
    #footer .thumb-custom-nav li a.next { margin-left:400px; }
    #footer .thumb-custom-nav li a:hover { opacity:0.7; }
    #footer #slider-thumb { width:800px; height:115px; margin-left:auto; margin-right:auto; border:0px; margin-bottom:0px; background:transparent;}
    #footer #slider-thumb .slides li img { width:150px; height:115px; opacity: 0.5; cursor:pointer;}
    #footer #slider-thumb .slides li:hover img { opacity:1;}
    #footer #slider-thumb .slides li.flex-active-slide img { border:4px solid #33bfb2; opacity:1; }
</style>
<header id="header">
    <h1>
        <div class="header-icon"><img src="/static/images/products/title_gallery.png"></div>
        <div class="header-text"><?=$room['prd_title']?>&nbsp;<?=$room['room_title']?></div>
        <div class="header-close"><a href="javascript:;" onclick="window.close();return false;"><img src="/static/images/products/icon_close.png"></a></div>
    </h1>
</header>
<section id="section">
    <ul class="directionNav">
        <li><a class="prev flex-prev" href="javascript:;"><img src="/static/images/carousel/prev_button.png"></a></li>
        <li><a class="next flex-next" href="javasscipt:;"><img src="/static/images/carousel/next_button.png"></a></li>
    </ul>
    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php foreach($gallery_list as $image) :?>
            <li><img src="<?=base_url($image['gll_path'])?>"></li>
            <?php endforeach;?>
        </ul>
    </div>
</section>
<footer id="footer">
    <div class="thumb-custom-nav">
        <li><a class="prev flex-prev" href="javascript:;"><img src="/static/images/carousel/button_thumb_prev.png"></a></li>
        <li><a class="next flex-next" href="javasscipt:;"><img src="/static/images/carousel/button_thumb_next.png"></a></li>
    </div>
    <div id="slider-thumb" class="flexslider">
        <ul class="slides">
            <?php foreach($gallery_list as $image) :?>
                <li><img src="<?=base_url($image['gll_path'])?>"></li>
            <?php endforeach;?>
        </ul>
    </div>
</footer>
<script>
$(function(){
    $("#slider-thumb").flexslider({
        animation:'slide',
        itemWidth : 150,
        itemHeight : 115,
        itemMargin:10,
        controlNav:false,
        animationLoop:false,
        customDirectionNav : ".thumb-custom-nav a",
        slideshow:false,
        asNavFor: '#slider'
    });

    $("#slider").flexslider({
        animation:'slide',
        itemWidth:800,
        slideshow: false,
        itemHeight:600,
        controlNav:false,
        customDirectionNav : "#section .directionNav a",
        sync: "#slider-thumb"
    });
});
</script>