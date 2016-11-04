<!--START: Breadcrumbs-->
<aside class="container">
    <ol class="breadcrumbs">
        <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>        
        <li class="active"><span>월별 허니문 추천</span></li>
    </ol>
</aside>
<!--END: Breadcrumbs-->
<article class="container" id="page-recommend">
    <img class="wide-banner" src="/static/images/products/banner_recommend.jpg">
    <h1 class="margin-top-30"><img src="/static/images/products/title_recommend.png"></h1>
    <ul class="month-indicator">
        <?php for($month=1; $month<=12; $month++) :
            $dateObj = DateTime::createFromFormat("!m", $month);
            $month_name = $dateObj->format('M');
            ?>
        <li <?=($month==1)?'class="active"':''?>><a href="javascript:;" onclick="month_slider.move(<?=$month?>);"><?=$month_name?></a></li>
        <?php endfor;?>
    </ul>
    <div id="month-slider">
        <ul>
        <?php for($month=1; $month<=12; $month++) : ?>
            <li id="month-<?=$month?>" class="month-section" style="background-image:url(/static/images/products/recommend_<?=sprintf('%02d',$month)?>_bg.jpg);">
                <div class="thumb"><img src="/static/images/products/recommend_<?=sprintf('%02d',$month)?>_thumb.jpg"></div>
                <a href="<?=base_url("board/sybqna/write")?>" class="btn btn-primary-simple btn-xlg">상품 문의하기</a>
            </li>
        <?php endfor;?>
        </ul>
    </div>

</article>

<script>
    var month_slider = function(){
        var height = 310,
            length = 12,
            current_month = 1,
            $slider = $("#month-slider");

        return {
            init : function(){
                $slider.css({'height' : height*length});
            },
            move_next : function( steps ) {
                var $slide_container = $slider.find('ul');
                $slide_container.animate({
                    'top': '-' + (height*steps) + 'px'
                }, 300, 'easeInOutCubic', function () {
                    for(var i=0; i<steps; i++)
                    {
                        var firstChild = $slide_container.children().filter(':lt(' + 1 + ')').clone(true);
                        firstChild.appendTo($slide_container);
                        $slide_container.children().filter(':lt(' + 1 + ')').remove();
                        $slide_container.css('top', '0px');
                        current_month ++;
                        if( current_month > 12 ) {
                            current_month = 1;
                        }
                    }
                });
                $(".month-indicator li").removeClass("active");
                $(".month-indicator li").eq( (current_month+steps)%12 -1 ).addClass("active");
            },
            move : function( month ) {
                if( current_month < month )
                {
                    month_slider.move_next( month - current_month );
                }
                else if ( current_month > month )
                {
                    month_slider.move_next( (12-current_month) + month);
                }
            }
        }
    }();

    $(function(){
        month_slider.init();
    });
</script>