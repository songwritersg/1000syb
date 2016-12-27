<?php
$right_banners = $this->banner->lists("FLOAT_RIGHT");
$left_banners = $this->banner->lists("FLOAT_LEFT");
?>
<!--START:좌측 배너 시작-->
<aside class="floating-banner" id="left-banner">
    <ul class="banner-list">
        <?php foreach($left_banners as $banner) :?>
        <li><a href="<?=$banner['ban_url']?>" <?=($banner['ban_newwin']=='Y'?'target="_blank"':'')?>><img src="<?=base_url($banner['ban_image'])?>" alt="<?=$banner['ban_title']?>"></a></li>
        <?php endforeach;?>
    </ul>
</aside>
<!--END:좌측 배너 끝-->

<!-- START:우측 배너 시작-->
<aside class="floating-banner" id="right-banner">
    <ul class="banner-list">
        <?php foreach($right_banners as $banner) :?>
            <li><a href="<?=$banner['ban_url']?>" <?=($banner['ban_newwin']=='Y'?'target="_blank"':'')?>><img src="<?=base_url($banner['ban_image'])?>" alt="<?=$banner['ban_title']?>"></a></li>
        <?php endforeach;?>
    </ul>
</aside>
<!-- END:우측배너 끝-->