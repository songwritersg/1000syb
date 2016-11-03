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
<section id="sybSection">
    <?=$yield?>
</section>

<!--[if lt IE 9]>
<script src="<?=base_url('static/js/poly-checked.min.js')?>"></script>
<![endif]-->
</body>
</html>