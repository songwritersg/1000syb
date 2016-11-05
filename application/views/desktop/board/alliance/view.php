<?php $this->load->view('desktop/board/customer_common');?>
<article id="skin-alliance-view" class="container">
    <div class="post-header">
        <h1 class="post-title"><?=$post['post_title']?></h1>
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
        <table class="table">
            <colgroup>
                <col width="200" />
                <col width="*" />
            </colgroup>
            <tr>
                <th>업체명</th>
                <td><?=$post['post_title']?></td>
            </tr>
            <tr>
                <th>담당자 성명</th>
                <td><?=$post['usr_name']?></td>
            </tr>
            <tr>
                <th>대표 번호</th>
                <td><?=$post['post_ext1']?></td>
            </tr>
            <tr>
                <th>핸드폰</th>
                <td><?=$post['usr_phone']?></td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td><?=$post['usr_email']?></td>
            </tr>
        </table>
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
        <?php if($this->member->level() >= 8) :?>
        <div class="pull-left">
            <a class="btn btn-dark" href="<?=base_url("board/{$board['brd_key']}").$querystring?>">목록</a>
        </div>

        <?php if($board['brd_use_reply'] == 'Y' && $auth['reply']) : ?>
            <a href="<?=base_url("board/{$board['brd_key']}/reply/{$post['post_idx']}")?>" class="btn btn-primary">답글달기</a>
        <?php endif;?>

        <a class="btn btn-default" href="<?=base_url("board/{$board['brd_key']}/{$post['post_idx']}/edit")?>">글 수정</a>
        <a class="btn btn-default" href="<?=base_url("board/{$board['brd_key']}/delete/{$post['post_idx']}").$querystring?>" onclick="return confirm('해당 글을 삭제하시겠습니까?');">삭제</a>
        <?php endif;?>
    </div>
</article>
