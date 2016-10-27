<article id="skin-normal-view" class="container">
    <div class="post-header">
        <h1 class="post-title"><?=$post['post_title']?><small>조회수 : <?=number_format($post['post_hit'])?></small></h1>
    </div>
    <div class="post-content">
        <?=$post['contents']?>
    </div>
    <?php if($post_np['next'] OR $post_np['prev']) :?>
    <div class="post-np">
        <ul class="post-np-list">
        <?php if($post_np['next']) : ?>
            <li>
                <label>다음글</label>
                <a href="<?=base_url("board/{$board['brd_key']}/{$post_np['next']['post_idx']}").$querystring?>">
                    <?=($post_np['next']['post_depth']>0)?'<img src="/static/images/common/icon_reply.gif">':''?>
                    <?=$post_np['next']['post_title']?>
                    <?=$post_np['next']['post_secret']=='Y'?"<i class='fa fa-lock'></i>":""?>
                </a>
            </li>
        <?php endif;?>
        <?php if($post_np['prev']) : ?>
            <li>
                <label>이전글</label>
                <a href="<?=base_url("board/{$board['brd_key']}/{$post_np['prev']['post_idx']}").$querystring?>">
                    <?=($post_np['prev']['post_depth']>0)?'<img src="/static/images/common/icon_reply.gif">':''?>
                    <?=$post_np['prev']['post_title']?>
                    <?=$post_np['prev']['post_secret']=='Y'?"<i class='fa fa-lock'></i>":""?>
                </a>
            </li>
        <?php endif;?>
        </ul>
    </div>
    <?php endif;?>
    <div class="post-actions">
        <?php if($board['brd_use_reply'] == 'Y' && $auth['reply']) : ?>
            <a href="" class="btn btn-primary">답글달기</a>
        <?php endif;?>

        <?php if($auth['write'] && $this->member->is_login() && $post['usr_id'] == $this->member->info('usr_id')) : ?>

        <?php endif;?>
        <a href="<?=base_url("board/{$board['brd_key']}/{$post['post_idx']}/edit")?>" class="btn btn-primary">글 수정</a>
        <a class="btn btn-dark" href="<?=base_url("board/{$board['brd_key']}").$querystring?>">목록</a>

        <?php if($auth['is_admin'] OR $auth['is_subadmin'] OR $this->member->is_login() && $post['usr_id'] == $this->member->info('usr_id')) :?>
        <a class="btn btn-dark" href="<?=base_url("board/{$board['brd_key']}").$querystring?>">삭제</a>
        <?php endif;?>
    </div>
</article>
