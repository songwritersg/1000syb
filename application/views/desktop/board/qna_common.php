<?php
$board_array = array(
    array("title"=>"Q/A","key"=>"sybqna","url"=>base_url("board/sybqna")),
    array("title"=>"전화상담신청","key"=>"call","url"=>base_url("counseling/call")),
    array("title"=>"평일방문상담","key"=>"visit","url"=>base_url("counseling/visit")),
);
?>
<!--END: Breadcrumbs-->
<aside class="container">
    <ol class="breadcrumbs">
        <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
        <li class="active"><span><?=$board['brd_title']?></span></li>
    </ol>
</aside>
<!--END: Breadcrumbs-->
<div class="container">
    <h1 class="margin-bottom-30"><img class="wide-banner" src="/static/images/board/title_sybqna.jpg"></h1>

    <div class="board-title">
        <h2>고객센터 <i class="fa fa-comments"></i></h2>
    </div>
    <ul class="tab tab-justified tab-default margin-bottom-30">
        <?php foreach($board_array as $menu) :?>
            <li <?=$board['brd_key']==$menu['key']?'class="active"':''?>><a href="<?=$menu['url']?>"><?=$menu['title']?><?=$board['brd_key']==$menu['key']?'&nbsp;<i class="fa fa-caret-down"></i>':''?></a></li>
        <?php endforeach;?>
    </ul>
</div>