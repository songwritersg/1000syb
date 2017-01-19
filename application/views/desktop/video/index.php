<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.1/imagesloaded.pkgd.min.js")?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.1/isotope.pkgd.min.js")?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js")?>
<style>
    h2.page-title { padding:30px; font-size:20px; background:#fff; border:1px solid #ddd;}
    h2.page-title > i { color:#c8c8c8; float:right; }

    .filter-box { padding:30px 30px 0px; background:#f9f9f9; border:1px solid #ddd; border-top:0px; margin-bottom:20px;}

    #video-filter { list-style:none; padding:0; margin:0;  }
    #video-filter li { display:block; padding:0px;  margin-bottom:20px;}
    #video-filter li > a { display:block; width:150px; height:42px; background:#fff; color:#282828; text-align:center; border:1px solid #ddd; transition:all .3s ease-in-out; line-height:42px; border-radius:20px;}
    #video-filter li > a:hover { border-color:#33bfb2; color:#33bfb2;}
    #video-filter li.activeFilter > a { color:#33bfb2; border-color:#33bfb2;}
    #video-filter li:nth-child(3n):after,
    #video-filter li:last-child:after { clear:both; content:'';display:table;}

    #vimeo-list:after,
    #vimeo-list li:nth-child(3n):after,
    #vimeo-list li:last-child:after{ clear:both; content:'';display:table;}
    #vimeo-list li:nth-child(3n+1) {clear:both;}
    #vimeo-list li { margin-bottom:30px;}
    #vimeo-list li a { display:block; position:relative;}
    #vimeo-list li a figure { position:relative; width:350px; height:196px; overflow:hidden; }
    #vimeo-list li a figure > img { width:350px; height:196px; transition:all .3s ease-in-out; }
    #vimeo-list li a:hover figure > img { transform:scale(1.2); -webkit-transform:scale(1.2); -moz-transform:scale(1.2); }
    #vimeo-list li a figure figcaption { display:none; }
    #vimeo-list li a figure i {position: absolute; top: 50%; left: 50%; font-size: 32px; z-index: 3; margin-left: -16px; margin-top: -16px; color: #fff; display:none; transition:all .3s ease-in-out; }
    #vimeo-list li a:hover figure i { display:block; }
    #vimeo-list li a h3 { font-size:20px; text-overflow:ellipsis; white-space:nowrap; word-wrap:normal; overflow:hidden; }
    #vimeo-list li a h4 { font-size:16px; color:#33bfb2; font-weight:bold;}
    #vimeo-list li a .video-info { position:absolute; bottom:10px; left:0px; width:100%; margin:0; padding:0 15px; text-overflow:ellipsis; white-space:nowrap; width:100%; z-index:3; color:#fff; font-size:20px;}
    #vimeo-list li a .bottom-shadow { position:absolute; width:100%; min-height:40%; bottom:0px; left:0px; background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 100%); background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,1) 100%); background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,1) 100%);  }
    #vimeo-list li a .overlay:before { content: ''; width: 100%; height: 100%; position: absolute; top: 0px; left: 0px; display: inline-block; background: rgba(0,0,0,0.0); z-index: 1; transition: all .3s ease-in-out; }
    #vimeo-list li a:hover .overlay:before { background:rgba(0,0,0,0.6); }
    #vimeo-list li a:hover .play-icon { transform:scale(1); -webkit-transform:scale(1); -moz-transform:scale(1); }
</style>
<article class="container">
    
    <aside class="container">
        <ol class="breadcrumbs">
            <li><a href="http://www.1000syb.com/"><i class="fa fa-home"></i></a></li>
            <li class="active"><span>지역별 참고 동영상</span></li>
        </ol>
    </aside>

    <h2 class="page-title">지역별 참고 동영상<i class="fa fa-camera"></i></h2>
    <div class="filter-box">
        <ul id="video-filter" class="clearfix">
            <?php foreach($video_category as $i=>$row):?>
                <li class="col col-2 <?=$i==0?'activeFilter':''?>"><a href="#" data-filter=".pf-<?=md5($row['vim_category'])?>"><?=$row['vim_category']?></a></li>
            <?php endforeach;?>
        </ul>
    </div>

    <div class="row">
        <ul class="vimeo-list" id="vimeo-list">
            <?php foreach($video_list as $row):?>
            <li class="col col-4 pf-<?=md5($row['vim_category'])?>">
                <a href="<?=$row['vim_embed_url']?>" data-toggle='youtube-link' data-type="<?=$row['vim_type']?>">
                    <figure>
                        <img class="img-responsive" src="<?=$row['vim_thumb']?>" alt="<?=$row['vim_title']?>">
                        <figcaption><?=$row['vim_title']?></figcaption>
                        <span class="play-icon">
                            <img class="img-responsive play-svg svg" src="<?=base_url("static/images/common/svg_play.svg")?>" alt="play">
                        </span>
                    </figure>
                    <div class="video-info">
                        <h4><?=$row['vim_category']?></h4>
                        <h3><?=$row['vim_title']?></h3>
                    </div>
                    <div class="bottom-shadow"></div>
                    <div class="overlay"></div>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</article>

<script>
    var grid_container = $('#vimeo-list');
    var filter_container = $("#video-filter");
    var filter_active_class = "activeFilter";

    $(function(){

        $('img').lazyload({
            container: grid_container,
            effect : "fadeIn"
        });

        grid_container.isotope({
            itemSelector : 'li',
            percentPosition : true,
            filter : '.pf-<?=md5($video_category[0]['vim_category'])?>'
        });

        // 카테고리
        filter_container.find('a').on('click' , function(e){
            e.preventDefault();
            filter_container.find('li').removeClass(filter_active_class);
            $(this).parent('li').addClass(filter_active_class);
            var selector = $(this).attr('data-filter');
            grid_container.isotope({ filter: selector });
        });

    });
</script>