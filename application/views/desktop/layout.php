<!DOCTYPE html>
<html lang="ko">
<head>
<?=$this->site->display_meta()?>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#686e73">
<meta name="apple-mobile-web-app-title" content="1000syb">
<meta name="application-name" content="1000syb">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">
<meta name="theme-color" content="#ffffff">
<?=$this->site->add_css("//fonts.googleapis.com/earlyaccess/notosanskr.css", TRUE)?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css", TRUE)?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css", TRUE)?>
<?=$this->site->add_css("/static/css/common.min.css", TRUE)?>
<?=$this->site->display_css()?>
</head>
<body>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js", TRUE)?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js")?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js")?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js")?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js")?>
<?=$this->site->add_js("/static/js/common.min.js", TRUE)?>
<?=$this->site->display_js();?>
<script>
var base_url = '<?=base_url()?>';
</script>
<!--START:본문 바로가기-->
<div id="sybIndex">
    <a href="#sybSection">본문 바로가기</a>
    <a href="#sybNav">메뉴 바로가기</a>
    <a href="/sitemap">사이트맵</a>
</div>
<!--END:본문 바로가기-->

<!--START:헤더-->
<header id="sybHeader">
    <div class="container">
        <a class="left-top-banner" href="<?=base_url("/about/#insurance")?>"><img src="/static/images/common/banner_top_insurance.gif" alt="믿고 맡기는 허니문 보증보험 9억 3천 가입"></a>
        <h1 class="logo"><a href="<?=base_url()?>">천생연분닷컴</a></h1>
        <ul class="right-top-menu">
            <li><a href="<?=base_url()?>"><i class="fa fa-home"></i>&nbsp;메인</a></li>
            <li><a href="javascript:;" data-toggle="add-favorite"><i class="fa fa-star"></i>&nbsp;즐겨찾기</a></li>
            <li><a href="<?=base_url('board/article')?>"><i class="fa  fa-newspaper-o"></i>&nbsp;보도자료</a></li>
        </ul>
    </div>
</header>
<!--END:헤더-->

<!--START:네비게이션-->
<nav id="sybNav">
    <ul id="mainNaviagtion">
        <li <?=$this->active=='tai'?'class="active"':''?>><a href="<?=base_url("products/tai")?>">태국</a></li>
        <li <?=$this->active=='koh'?'class="active"':''?>><a href="<?=base_url("products/koh")?>">코사무이</a></li>
        <li <?=$this->active=='balo'?'class="active"':''?>><a href="<?=base_url("products/balo")?>">발리/롬복</a></li>
        <li <?=$this->active=='hwa'?'class="active"':''?>><a href="<?=base_url("products/hwa")?>">하와이</a></li>
        <li <?=$this->active=='mol'?'class="active"':''?>><a href="<?=base_url("products/mol")?>">몰디브</a></li>
        <li <?=$this->active=='eur'?'class="active"':''?>><a href="<?=base_url("products/eur")?>">유럽</a></li>
        <li <?=$this->active=='canc'?'class="active"':''?>><a href="<?=base_url("products/canc")?>">칸쿤</a></li>
        <li <?=$this->active=='aust'?'class="active"':''?>><a href="<?=base_url("products/aust")?>">호주</a></li>
        <li <?=$this->active=='aune'?'class="active"':''?>><a href="<?=base_url("products/aune")?>">남태평양</a></li>
        <li class="other1 <?=$this->active=='eth'?'active':''?>"><a href="<?=base_url("products/eth")?>">기타지역</a></li>
        <li class="other2 <?=$this->active=='oth'?'active':''?>"><a href="<?=base_url("products/oth")?>">특수지역</a></li>
    </ul>
</nav>
<!--END:네비게이션-->

<!--START:본문영역-->
<section id="sybSection">
    <h2 class="hide">본문영역</h2>
    <?=$yield?>
</section>
<!--END:본문영역-->

<?php $branches_list = $this->site_branch_model->get_branch_list(); ?>

<!--START:푸터영역-->
<footer id="sybFooter">
    <div class="container-fluid" id="sybFooter-header">
        <div class="container">
            <div class="row">
                <article class="col col-6">
                    <div class="banner">
                        <div class="banner-header">
                            <h5>EVENT</h5>
                        </div>
                        <div class="banner-body">
                            <a href="http://www.wnfair.com" target="_blank">
                                <img src="/static/images/layout/footer_banner_01.jpg" alt="허니문 계약시 드리는 천생연분닷컴 독점사은품 5종!">
                            </a>
                        </div>
                    </div>
                </article>

                <article class="col col-3">
                    <div class="banner">
                        <div class="banner-header">
                            <h5>Q/A</h5>
                        </div>
                        <div class="banner-body">
                            <a href="<?=base_url('board/sybqna')?>"><img src="/static/images/layout/footer_banner_02.jpg" alt="허니문 Q&A 바로가기"></a>
                        </div>
                    </div>
                </article>

                <article class="col col-3">
                    <div class="banner">
                        <div class="banner-header">
                            <h5>REAL REVIEW</h5>
                        </div>
                        <div class="banner-body">
                            <a href="<?=base_url('board/trstory')?>"><img src="/static/images/layout/footer_banner_03.jpg" alt="허니문 Review 바로가기"></a>
                        </div>
                    </div>
                </article>
            </div>
            <style>

            </style>

            <ul class="footer-navigation">
                <li><a href="http://www.wnfair.com" target="_blank"><i class="icon icon-calendar"></i>&nbsp;잠실롯데호텔 <strong>허니문&웨딩 박람회</strong></a></li>
                <li><a href="<?=base_url("about/branch")?>"><i class="icon icon-map"></i>&nbsp;전국 지사안내</a></li>
                <li><a href="<?=base_url("about/#insurance")?>"><i class="icon icon-text"></i>&nbsp;보증보험안내</a></li>
            </ul>
        </div>
    </div>

    <article class="container" id="footer-cscenter">
        <h4>고객 센터</h4>
        <div class="cscenter">
            <img class="wide-banner" src="/static/images/layout/footer_cscenter.jpg" alt="고객센터">
        </div>

        <div class="csbuttons">
            <a href="<?=base_url("board/sybqna/write")?>" class="btn btn-01">견적문의 요청</a>
            <a href="<?=base_url("counseling/call")?>" class="btn btn-02">전화문의 요청</a>
        </div>
        <div class="clearfix"></div>
    </article>

    <article class="container">
        <div class="row">
            <div class="col col-4">
                <div class="recent">
                    <div class="recent-header">
                        <h5><strong>Q/A</strong>허니문 문의 <a href="<?=base_url('board/sybqna')?>"><i class="fa fa-plus"></i></a></h5>
                    </div>
                    <div class="recent-body">
                        <?php $recent_list = $this->board_model->get_recent("sybqna");?>
                        <ul class="recent-list">
                        <?php foreach($recent_list as $post ) :?>
                            <li>
                                <a href="<?=$post['post_link']?>">
                                    <span class="title"><?=$post['post_title']?><?=($post['is_new'])?'<img alt="NEW" class="icon-new" src="/static/images/common/icon_new.gif">':''?></span>
                                    <span class="regtime"><?=board_date_format($post['post_regtime'])?></span>
                                </a>

                            </li>
                        <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col col-4">
                <div class="recent">
                    <div class="recent-header">
                        <h5><strong>NOTICE</strong>공지사항 <a href="<?=base_url('board/sybnotice')?>"><i class="fa fa-plus"></i></a></h5>
                    </div>
                    <div class="recent-body">
                        <?php $recent_list = $this->board_model->get_recent("sybnotice");?>
                        <ul class="recent-list">
                            <?php foreach($recent_list as $post ) :?>
                                <li>
                                    <a href="<?=$post['post_link']?>">
                                        <span class="title"><?=$post['post_title']?><?=($post['is_new'])?'<img class="icon-new" alt="NEW" src="/static/images/common/icon_new.gif">':''?></span>
                                        <span class="regtime"><?=board_date_format($post['post_regtime'])?></span>
                                    </a>

                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col col-4">
                <div class="recent">
                    <div class="recent-header">
                        <h5><strong>REAL STORY</strong>실제 고객님들의 후기 <a href="<?=base_url('board/trstory')?>"><i class="fa fa-plus"></i></a></h5>
                    </div>
                    <div class="recent-body">
                        <?php $recent_list = $this->board_model->get_recent("trstory");?>
                        <ul class="recent-list">
                            <?php foreach($recent_list as $post ) :?>
                                <li>
                                    <a href="<?=$post['post_link']?>">
                                        <span class="title"><?=htmlspecialchars($post['post_title'])?><?=($post['is_new'])?'<img alt="NEW"  class="icon-new" src="/static/images/common/icon_new.gif">':''?></span>
                                        <span class="regtime"><?=board_date_format($post['post_regtime'])?></span>
                                    </a>

                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <div class="footer-about">
        <div class="container">
            <ul class="footer-about-list">
                <li><a href="<?=base_url("about")?>">회사소개</a></li>
                <li><a href="<?=base_url("about/#location")?>">찾아오시는길</a></li>
                <li><a href="<?=base_url("about/agreement")?>">이용약관</a></li>
                <li class="privacy"><a href="<?=base_url("about/privacy")?>">개인정보 취급방침</a></li>
                <li><a href="<?=base_url("about/travel")?>">여행약관</a></li>
                <li><a href="<?=base_url("about/#insurance")?>">해외여행자보험</a></li>
            </ul>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <div class="information">
                <h5>INFORMATION</h5>
                <p>
                    (주)네이버 네트워크 | 대표자 <strong>임정택</strong><br>
                    본사 사업자번호 120-88-24167<br>
                    관광사업자등록증번호 제2015-06호<br>
                    통신판매업신고 번호<br>
                    <br>
                    BSP 보증보험 3억원<br>
                    기획여행 보증보험 2억원<br>
                    배상책임보험 3억원<br>
                    국외여행 보증보험 3천만원<br>
                    해외여행자 보험 1억원<br>
                </p>
            </div>

            <div class="address">
                <h5>ADDRESS</h5>
                <p>
                    <a href="tel:02-72-8876" class="phone"><i class="fa fa-mobile"></i>&nbsp;02-720-8876</a>&nbsp;|&nbsp;Fax.02) 2179-9481, 02) 720-8881<br>
                </p>
                    <dl class="address-list">
                        <dt>본사주소</dt><dd>서울시 강남구 봉은사로 437, (소암빌딩 4F)</dd>
                        <?php foreach($branches_list as $row) :?>
                        <dt><?=$row['bnc_name']?></dt><dd><?=$row['bnc_address']?></dd>
                        <?php endforeach;?>
                    </dl>
                <p>
                    <span>Copyright &copy; 천생연분닷컴 All rights reserved.</span>
                </p>
            </div>

            <div class="footer-award">
                <h5>AWARDS</h5>
                <img src="/static/images/layout/footer_banner_award.png" alt="브랜드 대상 수상, 서비스지수1위 수상"><br>

                <select class="select-jisa" onchange="location.href=this.value;">
                    <option value="">전국지사 바로가기</option>
                    <?php foreach($branches_list as $row):?>
                    <option value="<?=base_url("about/branch/".urlencode($row['bnc_name']))?>"><?=$row['bnc_name']?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
    </div>
</footer>

<?php $this->load->view('desktop/banners');?>

<!--[if lt IE 9]>
<script src="<?=base_url('static/js/poly-checked.min.js')?>"></script>
<![endif]-->
</body>
</html>
