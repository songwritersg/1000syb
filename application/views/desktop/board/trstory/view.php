<?php $this->load->view("desktop/board/trstory/common_header")?>
<article id="skin-trstory-view" class="container">
    <div class="post-header">
        <h1 class="post-title"><?=$post['post_title']?><small><?=number_format($post['post_hit'])?></small></h1>
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

    <?php if($board['brd_use_comment'] == 'Y') : ?>
    <!-- START:댓글-->
    <div class="post-comment">
        <?php if($auth['comment']) :?>
            <div id="comment-form-container">
                <?=form_open("board/{$board['brd_key']}/comment", array("id"=>"form-comment"));?>
                <input type="hidden" name="reurl" value="<?=current_full_url(TRUE)?>">
                <input type="hidden" name="post_idx" value="<?=$post['post_idx']?>">
                <?php if(! $this->member->is_login()) :?>
                    <div class="form-group">
                        <label for="comment_usr_name">이름</label>
                        <div class="input-box">
                            <input type="text" class="form-control input-md" id="comment_usr_name" name="usr_name" required="required" data-title="이름" placeholder="이름을 입력하세요">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comment_usr_pass">패스워드</label>
                        <div class="input-box">
                            <input type="password" class="form-control input-md" id="comment_usr_pass" name="usr_pass" required="required" data-title="비밀번호" placeholder="비밀번호를 입력하세요">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <?php endif;?>
                <div class="form-group margin-top-20">
                    <div class="input-box">
                        <textarea name="cmt_content" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="button-box">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">댓글달기</button>
                    </div>
                </div>
                <?=form_close()?>
            </div>
        <?php endif;?>
        <div class="comment-list-container">
            <?php if(count($comment_list) > 0) :?>
            <ul class="comment-list">
                <?php foreach($comment_list as $comment) :?>
                <li class="comments">
                    <div class="comments-header">
                        <div class="pull-left">
                            <span class="name"><?=$comment['usr_name']?>님</span><span class="regtime"><?=$comment['cmt_regtime']?></span>
                        </div>
                        <div class="pull-right">
                            <a href="javascript:void(0);" data-idx="<?=$comment['cmt_idx']?>" data-toggle="comment-edit">수정</a>
                            <a href="javascript:void(0);" data-idx="<?=$comment['cmt_idx']?>" data-toggle="comment-delete">삭제</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="comments-body"><?=nl2br($comment['cmt_content'])?></div>
                </li>
                <?php endforeach;?>
            </ul>
            <?php else :?>
                <p class="no-comments">등록된 댓글이 없습니다.</p>
            <?php endif;?>
        </div>
    </div>
    <!-- END:댓글-->
    <?php endif;?>

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
        <div class="pull-left">
            <a class="btn btn-dark" href="<?=base_url("board/{$board['brd_key']}").$querystring?>">목록</a>
        </div>

        <?php if($board['brd_use_reply'] == 'Y' && $auth['reply']) : ?>
            <a href="<?=base_url("board/{$board['brd_key']}/reply/{$post['post_idx']}")?>" class="btn btn-primary">답글달기</a>
        <?php endif;?>

        <a class="btn btn-default" href="<?=base_url("board/{$board['brd_key']}/{$post['post_idx']}/edit")?>">글 수정</a>
        <a class="btn btn-default" href="<?=base_url("board/{$board['brd_key']}/delete/{$post['post_idx']}").$querystring?>" onclick="return confirm('해당 글을 삭제하시겠습니까?');">삭제</a>
    </div>
</article>
