<?php
    $board_array = array(
        array("title"=>"공지사항","key"=>"sybnotice","url"=>base_url("board/sybnotice")),
        array("title"=>"제휴문의","key"=>"alliance","url"=>base_url("board/alliance/write")),
        array("title"=>"보도자료","key"=>"article","url"=>base_url("board/article")),
        array("title"=>"고객불편신고","key"=>"cscenter","url"=>base_url("board/cscenter/write")),
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
    <h2 class="margin-bottom-30"><img class="wide-banner" src="/static/images/board/title_customer.jpg" alt="천생연분닷컴의 새로운 소식을 전해드리겠습니다."></h2>

    <div class="board-title">
        <h2>고객센터 <i class="fa fa-comments"></i></h2>
    </div>
    <ul class="tab tab-justified tab-default margin-bottom-30">
        <?php foreach($board_array as $menu) :?>
        <li <?=$board['brd_key']==$menu['key']?'class="active"':''?>><a href="<?=$menu['url']?>"><?=$menu['title']?><?=$board['brd_key']==$menu['key']?'&nbsp;<i class="fa fa-caret-down"></i>':''?></a></li>
        <?php endforeach;?>
    </ul>
</div>