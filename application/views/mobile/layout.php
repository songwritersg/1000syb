<!DOCTYPE html>
<html lang="ko">
<head>
<?=$this->site->display_meta()?>
<?=$this->site->add_css("//fonts.googleapis.com/earlyaccess/nanumgothic.css")?>
<?=$this->site->add_css("/static/css/mobile.min.css")?>
<?=$this->site->display_css()?>
</head>
<body>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js", TRUE)?>
<?=$this->site->add_js("/static/js/mobile.min.js", TRUE)?>
<?=$this->site->display_js()?>
<script>var base_url = '<?=base_url()?>';</script>
<!--START:본문 바로가기-->
<div id="sybIndex">
    <a href="#sybSection">본문 바로가기</a>
    <a href="#sybNav">메뉴 바로가기</a>
    <a href="/sitemap">사이트맵</a>
</div>

<header id="sybHeader">
    <div class="header-btn left">
        <button type="button" class="btn" data-role="toggle-menu">A</button>
    </div>
    <div class="header-btn right">
        <a class="btn">B</a>
    </div>
</header>

<aside id="sybLeftMenu">
    <div class="menu-header">
        <button type="button" class="btn" data-role="toggle-menu">닫기</button>
    </div>
    <ul class="menu-navigation">
        <li>
            <a href="#">허니문 지역상품</a>
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
        <li><a href="#">질문과 답변</a></li>
        <li><a href="#">허니문 후기</a></li>
        <li><a href="#">천생연분닷컴</a></li>
        <li><a href="#">지사안내</a></li>
    </ul>
</aside>

<aside id="menuOverlay"></aside>

<!--END:본문 바로가기-->
<section id="sybSection">
    <h2 class="hide">본문영역</h2>
    <?=$yield?>
</section>

</body>
</html>
