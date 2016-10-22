<!DOCTYPE html>
<html lang="ko">
<head>
<?=$this->site->display_meta()?>
<?=$this->site->add_css("//fonts.googleapis.com/earlyaccess/nanumgothic.css", TRUE)?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css", TRUE)?>
<?=$this->site->add_css("/static/css/common.css", TRUE)?>
<?=$this->site->display_css()?>
</head>
<body>
<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js", TRUE)?>
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
    <h1 class="logo"><a href="<?=base_url()?>">천생연분닷컴</a></h1>
</header>
<!--END:헤더-->

<!--START:네비게이션-->
<nav id="sybNav">
    <ul id="mainNaviagtion">
        <li><a href="#">태국</a></li>
        <li><a href="#">코사무이</a></li>
        <li><a href="#">발리/롬복</a></li>
        <li><a href="#">하와이</a></li>
        <li><a href="#">몰디브</a></li>
        <li><a href="#">유럽</a></li>
        <li><a href="#">칸쿤</a></li>
        <li><a href="#">남태평양</a></li>
        <li><a href="#">연계지역</a></li>
        <li><a href="#">특수지역</a></li>
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

</footer>
</body>
</html>
