<!DOCTYPE html>
<html lang="ko">
<head>
<?=$this->site->display_meta()?>
<?=$this->site->add_css("//fonts.googleapis.com/earlyaccess/notosanskr.css", TRUE)?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css", TRUE)?>
<?=$this->site->add_css("/static/css/common.css", TRUE)?>
<?=$this->site->display_css()?>
</head>
<body>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js", TRUE)?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/bPopup/0.11.0/jquery.bpopup.min.js", TRUE)?>
<?=$this->site->add_js("/static/js/common.js", TRUE)?>
<?=$this->site->display_js();?>

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
        <a class="left-top-banner"><img src="/static/images/common/banner_top_insurance.gif"></a>
        <h1 class="logo"><a href="<?=base_url()?>">천생연분닷컴</a></h1>
        <ul class="right-top-menu">
            <li><a href="<?=base_url()?>"><i class="fa fa-home"></i>&nbsp;HOME</a></li>
            <li><a href="<?=base_url('members/login')?>"><i class="fa fa-power-off"></i>&nbsp;LOGIN</a></li>
            <li><a href="javascript:;" data-toggle="add-favorite"><i class="fa fa-star"></i>&nbsp;FAVORITE</a></li>
            <li><a href="<?=base_url('board/article')?>"><i class="fa  fa-newspaper-o"></i>&nbsp;BLOG</a></li>
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
        <li <?=$this->active=='aune'?'class="active"':''?>><a href="<?=base_url("products/aune")?>">남태평양</a></li>
        <li class="other1 <?=$this->active=='eth'?'active':''?>"><a href="<?=base_url("products/eth")?>">연계지역</a></li>
        <li class="other2 <?=$this->active=='oth'?'active':''?>"><a href="<?=base_url("products/oth")?>">특수지역</a></li>
    </ul>
</nav>
<!--END:네비게이션-->

<!--START:본문영역-->
<section id="sybSection">
    <?=$yield?>
</section>
<!--END:본문영역-->

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

            <ul class="footer-navigation">
                <li><a href="http://www.wnfair.com" target="_blank">잠실롯데호텔 <strong>허니문&웨딩 박람회</strong>&nbsp;<i class="fa fa-chevron-circle-right"></i></a></li>
                <li><a href="#">전국 지사안내&nbsp;<i class="fa fa-chevron-circle-right"></i></a></li>
                <li><a href="#">보증보험안내&nbsp;<i class="fa fa-chevron-circle-right"></i></a></li>
            </ul>
        </div>
    </div>

    <article class="container" id="footer-cscenter">
        <h4>고객 센터</h4>
        <div class="cscenter">
            <img class="wide-banner" src="/static/images/layout/footer_cscenter.jpg">
        </div>

        <div class="csbuttons">
            <a href="" class="btn btn-01">견적문의 요청</a>
            <a href="" class="btn btn-02">전화문의 요청</a>
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
                                    <span class="title"><?=$post['post_title']?><?=($post['is_new'])?'<img class="icon-new" src="/static/images/common/icon_new.gif">':''?></span>
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
                                        <span class="title"><?=$post['post_title']?><?=($post['is_new'])?'<img class="icon-new" src="/static/images/common/icon_new.gif">':''?></span>
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
                                        <span class="title"><?=$post['post_title']?><?=($post['is_new'])?'<img class="icon-new" src="/static/images/common/icon_new.gif">':''?></span>
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
                <li><a href="<?=base_url("about/#location")?>">찾아오시는길</a></li>
                <li><a href="<?=base_url("about/agreement")?>">이용약관</a></li>
                <li class="privacy"><a href="<?=base_url("about/privacy")?>">개인정보 취급방침</a></li>
                <li><a href="<?=base_url("about/travel")?>">여행약관</a></li>
                <li><a href="<?=base_url("about/#insurance")?>">해외여행자보험</a></li>
                <li><a href="<?=base_url("about/#account")?>">계좌번호안내</a></li>
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

            <address class="address">
                <h5>ADDRESS</h5>
                <p>
                    <a href="tel:02-72-8876" class="phone"><i class="fa fa-mobile"></i>&nbsp;02-720-8876</a>&nbsp;|&nbsp;Fax.02) 2179-9481, 02) 720-8881<br>
                </p>
                    <dl class="address-list">
                        <dt>본사 주소</dt><dd>서울시 강남구 봉은사로 437, (소암빌딩 4F)</dd>
                        <dt>광주 지사</dt><dd>광주광역시 동구 서석로 7</dd>
                        <dt>인천 지사</dt><dd>인천광역시 남구 주안동 1422-3 펠로다이아몬드 2F</dd>
                        <dt>부산 지사</dt><dd>부산 부산진구 부전2동 155-4 전자랜드 본점 5F</dd>
                        <dt>창원 지사</dt><dd>경남 창원 의창구 명서동 서울종합상가 101호</dd>
                        <dt>천안 지사</dt><dd>충남 천안시 서북구 쌍용동 210-27 우준빌딩 3F</dd>
                        <dt>대구 지사</dt><dd>대구광역시 중구 공평로 11</dd>
                        <dt>청주 지사</dt><dd></dd>
                    </dl>
                <p>
                    <span>Copyright &copy; 천생연분닷컴 All rights reserved.</span>
                </p>
            </address>

            <div class="footer-award">
                <h5>AWARDS</h5>
                <img src="/static/images/layout/footer_banner_award.png"><br>
                <select data-toggle="syb-select">
                    <option value="">전국지사 바로가기</option>
                    <option value="">광주 지사</option>
                    <option value="">인천 지사</option>
                </select>
            </div>
        </div>
    </div>
</footer>
<!--[if lt IE 9]>
<script src="<?=base_url('static/js/poly-checked.min.js')?>"></script>
<![endif]-->
</body>
</html>
