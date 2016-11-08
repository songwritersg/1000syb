<?php
// 이글의 답글 목록을 가져옴
$reply_list = $this->board_model->get_reply_list($board['brd_key'], $post['post_num']);
?>
<?php $this->load->view('desktop/board/qna_common');?>
<article id="skin-sybqna-view" class="container">
    <div class="post-header">
        <h1 class="post-title"><?=$post['post_title']?><small>질문과 답변</small><small><?=number_format($post['post_hit'])?></small></h1>
        <dl>
            <dt>글쓴이</dt>
            <dd><?=$post['usr_name']?></dd>
            <dt>작성일</dt>
            <dd><?=board_date_format($post['post_regtime'])?></dd>
        </dl>
    </div>
    <?php if(isset($post['post_attach_list']) && count($post['post_attach_list']) > 0  && $post['post_attach_image_count'] != count($post['post_attach_list']) ) :?>
    <div class="post-attach-list">
        <ul class="attach-list">
            <?php foreach($post['post_attach_list'] as $attach) : if($attach['bfi_is_image'] == 'Y') continue;?>
                <li><a href="<?=base_url("board/{$board['brd_key']}/download/{$attach['bfi_idx']}")?>"><i class="fa fa-download"></i>&nbsp;<?=$attach['bfi_originname']?></a></li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php endif;?>
    <div class="post-content">
        <?php
        if(isset($post['post_attach_image_count']) && $post['post_attach_image_count']  >0) :
            foreach($post['post_attach_list'] as $attach) :
                if( $attach['bfi_is_image'] == 'Y' ) :
                ?>
                    <figure class="post-attach-image">
                        <img src="<?=base_url($attach['bfi_filename'])?>">
                        <figcaption><?=$attach['bfi_caption']?></figcaption>
                    </figure>
                <?php
                endif;
            endforeach;
        endif;?>
        <?=$post['contents']?>
    </div>

    <?php foreach($reply_list as $reply) :?>
        <table class="table table-reply">
            <th>답변</th>
            <td><?=$reply['post_content']?></td>
        </table>
        <div class="post-reply">
            <h2><?=$reply['post_title']?><small><?=$reply['post_regtime']?></small></h2>
        </div>
    <?php endforeach;?>

    <div class="post-actions">
        <div class="pull-left">
            <a class="btn btn-dark" href="<?=base_url("board/{$board['brd_key']}").$querystring?>">목록</a>
        </div>

        <?php if($board['brd_use_reply'] == 'Y' && $auth['reply']) : ?>
            <a href="<?=base_url("board/{$board['brd_key']}/reply/{$post['post_idx']}")?>" class="btn btn-primary">답글달기</a>
        <?php endif;?>

        <a class="btn btn-white" href="<?=base_url("board/{$board['brd_key']}/{$post['post_idx']}/edit")?>">글 수정</a>
        <a class="btn btn-white" href="<?=base_url("board/{$board['brd_key']}/delete/{$post['post_idx']}").$querystring?>" onclick="return confirm('해당 글을 삭제하시겠습니까?');">삭제</a>
    </div>
</article>
