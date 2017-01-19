<!DOCTYPE html>
<html lang="ko">
<head>
<?=$this->site->display_meta()?>
<?=$this->site->add_css("//fonts.googleapis.com/earlyaccess/nanumgothic.css")?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css", TRUE)?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css", TRUE)?>
<?=$this->site->add_css("/static/css/mobile.min.css")?>
<?=$this->site->display_css()?>
</head>
<body>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js", TRUE)?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js", TRUE)?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js", TRUE)?>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.16/clipboard.min.js", TRUE)?>
<?=$this->site->add_js("/static/js/jquery.touch.scroll.min.js")?>
<?=$this->site->add_js("/static/js/mobile.min.js", TRUE)?>
<?=$this->site->display_js()?>
<script>var base_url = '<?=base_url()?>';</script>
<div id="wrapper">
    <!--START:본문 바로가기-->
    <div id="sybIndex">
        <a href="#sybSection">본문 바로가기</a>
        <a href="#sybNav">메뉴 바로가기</a>
        <a href="/customer/sitemap">사이트맵</a>
    </div>

    <header id="sybHeader">
        <h1 class="logo"><a href="<?=base_url()?>">천생연분 닷컴</a></h1>
        <div class="header-btn left">
            <button type="button" class="btn" data-toggle="toggle-menu"><i class="icon-menubar"></i></button>
        </div>
        <div class="header-btn right">
            <a class="btn text-primary" href="tel:02-720-8876"><i class="icon-phone-square"></i></a>
        </div>
    </header>

    <aside id="sybLeftMenu">
        <div class="menu-header">
            <h2 class="menu-header-title"><i class="icon-home"></i><span>천생연분 닷컴에 오신걸 환영합니다.</span></h2>
            <button type="button" class="btn" data-toggle="toggle-menu"><i class="icon-close"></i></button>
        </div>
        <ul class="menu-navigation">
            <li>
                <span>허니문 지역상품<i class="icon-caret-down"></i></span>
                <ul class="sub-menu">
                    <li <?=$this->active=='tai'?'class="active"':''?>><a href="<?=base_url("products/tai")?>">태국</a></li>
                    <li <?=$this->active=='koh'?'class="active"':''?>><a href="<?=base_url("products/koh")?>">코사무이</a></li>
                    <li <?=$this->active=='balo'?'class="active"':''?>><a href="<?=base_url("products/balo")?>">발리/롬복</a></li>
                    <li <?=$this->active=='hwa'?'class="active"':''?>><a href="<?=base_url("products/hwa")?>">하와이</a></li>
                    <li <?=$this->active=='mol'?'class="active"':''?>><a href="<?=base_url("products/mol")?>">몰디브</a></li>
                    <li <?=$this->active=='eur'?'class="active"':''?>><a href="<?=base_url("products/eur")?>">유럽</a></li>
                    <li <?=$this->active=='canc'?'class="active"':''?>><a href="<?=base_url("products/canc")?>">칸쿤</a></li>
                    <li <?=$this->active=='aust'?'class="active"':''?>><a href="<?=base_url("products/aust")?>">호주</a></li>
                    <li <?=$this->active=='aune'?'class="active"':''?>><a href="<?=base_url("products/aune")?>">남태평양</a></li>
                    <li <?=$this->active=='eth'?'class="active"':''?>><a href="<?=base_url("products/eth")?>">기타지역</a></li>
                    <li <?=$this->active=='oth'?'class="active"':''?>><a href="<?=base_url("products/oth")?>">특수지역</a></li>
                </ul>
            </li>
            <li>
                <span>커뮤니티<i class="icon-caret-down"></i></span>
                <ul class="sub-menu">
                    <li <?=$this->uri->segment(2)=='sybqna'?'class="active"':''?>><a href="<?=base_url("board/sybqna")?>">질문과 답변</a></li></li>
                    <li <?=$this->uri->segment(1)=='counseling' && $this->uri->segment(2)=='call'?'class="active"':''?>><a href="<?=base_url("counseling/call")?>">전화상담 신청</a></li></li>
                    <li <?=$this->uri->segment(1)=='counseling' && $this->uri->segment(2)=='visit'?'class="active"':''?>><a href="<?=base_url("counseling/visit")?>">평일방문 신청</a></li></li>
                </ul>
            </li>
            <li>
                <span>고객센터<i class="icon-caret-down"></i></span>
                <ul class="sub-menu">
                    <li <?=$this->uri->segment(2)=='sybnotice'?'class="active"':''?>><a href="<?=base_url("board/sybnotice")?>">공지사항</a></li></li>
                    <li <?=$this->uri->segment(2)=='alliance'?'class="active"':''?>><a href="<?=base_url("board/alliance/write")?>">제휴문의</a></li></li>
                    <li <?=$this->uri->segment(2)=='article'?'class="active"':''?>><a href="<?=base_url("board/article")?>">보도자료</a></li></li>
                    <li <?=$this->uri->segment(2)=='cscenter'?'class="active"':''?>><a href="<?=base_url("board/cscenter/write")?>">고객불편신고</a></li></li>
                </ul>
            </li>
            <li <?=$this->uri->segment(2)=='trstory'?'class="active"':''?>><a href="<?=base_url("board/trstory")?>">허니문 후기<i class="icon-right-circle"></i></a></li>
            <li <?=$this->uri->segment(1)=='about' && $this->uri->segment(2)!='branch'?'class="active"':''?>><a href="<?=base_url("about")?>">천생연분닷컴<i class="icon-right-circle"></i></a></li>
            <li <?=$this->uri->segment(1)=='about' && $this->uri->segment(2)=='branch'?'class="active"':''?>><a href="<?=base_url("about/branch")?>">지사안내<i class="icon-right-circle"></i></a></li>
        </ul>
    </aside>

    <aside id="menuOverlay" data-toggle='toggle-menu'></aside>

    <?php $branches_list = $this->site_branch_model->get_branch_list(); ?>

    <!--END:본문 바로가기-->
    <section id="sybSection">
        <h2 class="hide">본문영역</h2>
        <?=$yield?>
    </section>

    <footer id="sybFooter">
        <article class="footer-button-area">
            <a href="<?=base_url("board/sybqna")?>" class="btn btn-block btn-primary btn-flat col-xs-6">
                <i class="icon-chat"></i>
                <h4>허니문 Q/A</h4>
                <span>문의사항은 이곳에서</span>
            </a>
            <a href="<?=base_url("board/trstory")?>" class="btn btn-block btn-primary btn-flat col-xs-6">
                <i class="icon-film"></i>
                <h4>허니문 후기</h4>
                <span>천생연분닷컴의 경쟁력</span>
            </a>
        </article>
        <article class="footer-branch-info container margin-bottom-20">
            <h3>전국지사 안내<small>(클릭하면 해당페이지로 이동합니다.)</small></h3>
            <dl>
                <?php foreach($branches_list as $row) :?>
                <dt><?=$row['bnc_name']?></dt><dd><?=$row['bnc_tel']?><a href="<?=base_url("about/branch/".urlencode($row['bnc_name']))?>"><i class="icon-right-circle"></i></a></dd>
                <?php endforeach;?>
            </dl>
        </article>
        <article class="footer-link-area">
            <a class="btn btn-dark btn-flat btn-big col-xs-4" style="color:#ddd; font-size:12px;" href="http://www.wnfair.com/?key=mobile">박람회 신청</a>
            <button class="btn btn-dark btn-flat btn-big col-xs-4" style="color:#979797; font-size:12px;" data-toggle="viewmode" data-value="<?=DEVICE_DESKTOP?>">PC 버젼</button>
            <a class="btn btn-dark btn-flat btn-big col-xs-4" style="color:#979797; font-size:12px;" href="<?=base_url("about")?>">회사소개</a>
        </article>
        <article class="footer-about-area">
            <ul class="footer-link-list">
                <li><a href="<?=base_url("about/agreement")?>">이용약관</a></li>
                <li class="privacy"><a href="<?=base_url("about/privacy")?>">개인정보취급방침</a></li>
                <li><a href="<?=base_url("about/travel")?>">여행약관</a></li>
            </ul>
            <p>(주) 네이버 네트워크 | 대표자 임정택</p>
            <p>본사 사업자번호 120-88-24167</p>
            <p>통신판매업신고 : 제 2011-서울강남-03392호</p>
            <p>관광사업자등록번호 제 2015-06호</p>
            <p>Copyright 천생연분닷컴&copy; ALl rights reserved.</p>
        </article>
    </footer>
</div>
<aside id="pop-sns-share">
    <div class="pop-header">
        <h3 class="pop-header-title">공유하기</h3>
        <button type="button" data-toggle="close"><i class="icon-close"></i></button>
    </div>
    <ul class="sns-list">
        <li><a href="javascript:;" data-url="<?=current_url()?>" data-toggle='sns-share' data-service="naver" data-title="<?=$this->site->meta_title?>"><img class="sns-icon" src="<?=base_url("static/images/sns/naver.jpg")?>">네이버</a></li>
        <li><a href="javascript:;" data-url="<?=current_url()?>" data-toggle='sns-share' data-service="google" data-title="<?=$this->site->meta_title?>"><img class="sns-icon" src="<?=base_url("static/images/sns/google.jpg")?>">GOOGLE</a></li>
        <li><a href="javascript:;" data-url="<?=current_url()?>" data-toggle='sns-share' data-service="band" data-title="<?=$this->site->meta_title?>"><img class="sns-icon" src="<?=base_url("static/images/sns/band.jpg")?>">밴드</a></li>
        <li><a href="javascript:;" data-url="<?=current_url()?>" data-toggle='sns-share' data-service="kakaostory" data-title="<?=$this->site->meta_title?>"><img class="sns-icon" src="<?=base_url("static/images/sns/kakaostory.jpg")?>">카카오<br>스토리</a></li>
        <li><a href="javascript:;" data-url="<?=current_url()?>" data-toggle='sns-share' data-service="facebook" data-title="<?=$this->site->meta_title?>"><img class="sns-icon" src="<?=base_url("static/images/sns/facebook.png")?>">페이스북</a></li>
    </ul>
    <div class="form-group form-group-padding margin-top-20">
        <div class="input-group">
            <input type="text" class="form-control input-flat" value="<?=current_url()?>" readonly id="input-copy-current-url">
            <span class="input-group-btn"><button type="button" class="btn btn-default btn-flat" id="btn-copy-current-url" data-clipboard-target="#input-copy-current-url" title="공유할 URL을 클립보드에 복사">URL 복사</button></span>
            <script>
                var clipboard =  new Clipboard('#btn-copy-current-url');
                clipboard.on('success', function(e){
                    alert('현재 주소가 복사되었습니다.');
                });
            </script>
        </div>
    </div>
</aside>
<button type="button" href="#top" id="btn-to-top" style="display:none;"><i class="icon-arrow-up"></i></button>
</body>
</html>
