
<h2 class="page-title">Customer Service<small>질문과 답변</small></h2>

<?php $this->load->view('mobile/board/qna_common');?>

<article class="container" id="form-search" style="padding:15px;background:transparent;border-bottom:1px solid #ddd;">
    <form method="get" >
        <input type="hidden" name="scol" value="title">
        <div class="input-group">
            <input type="search" class="form-control input-lg input-flat" name="stxt" placeholder="검색어를 입력해주세요" value="<?=$stxt?>">
            <span class="input-group-addon"><i class="icon-search"></i></span>
        </div>
    </form>
</article>

<article class="container" style="padding-top:15px;background:#fff;">
    <a href="<?=base_url("board/{$board['brd_key']}/write").$querystring?>" class="btn btn-default-gradient btn-block btn-big"><i class="icon-edit"></i>&nbsp;글쓰기</a>
</article>

<article class="container" style="background:#fff;border-bottom:1px solid #ddd;">
    <ul class="post-list media-list">
        <?php foreach($list as $row) :?>
        <li class="media">

            <?php if($row['is_new']) :?>
            <div class="media-left">
                <img src="/static/images/common/icon_new_m.png" class="newicon">
            </div>
            <?php endif;?>

            <div class="media-body">
                <a href="<?=$row['post_link']?>"><?=$row['post_title']?></a>
                <p><?=$row['post_category']?> | <?=name_blind($row['usr_name'])?> | <?=board_date_format($row['post_regtime'])?>&nbsp;|&nbsp;<?=number_format($row['post_hit'])?></p>
            </div>
            <div class="media-right">
                <?php if($row['answer_count']>0) :?>
                <a href="<?=$row['post_link']?>" class="btn btn-block btn-md btn-dark">답변완료</a>
                <?php else :?>
                <a href="<?=$row['post_link']?>" class="btn btn-block btn-md btn-default-gradient">답변대기</a>
                <?php endif;?>
            </div>
        </li>
        <?php endforeach;?>
    </ul>
    <div class="text-center">
        <?=$pagination?>
    </div>
</article>