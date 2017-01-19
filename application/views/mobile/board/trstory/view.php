<h2 class="page-title">Real Review<small>허니문 후기</small></h2>

<article class="container">
    <div class="row">
        <div class="panel panel-default margin-top-15">
            <div class="panel-heading">
                <h2 class="post-title"><?=$post['post_title']?></h2>
                <ul class="post-view-info">
                    <li><?=board_date_format($post['post_regtime'])?></li>
                    <li><?=name_blind($post['usr_name'])?></li>
                    <li><?=$post['post_category']?></li>
                    <li><?=number_format($post['post_hit'])?></li>
                </ul>
            </div>
            <div class="panel-body post-body" style="background:#fff;">
                <?php
                if(isset($post['post_attach_image_count']) && $post['post_attach_image_count']  >0) :
                    foreach($post['post_attach_list'] as $attach) :
                        if( $attach['bfi_is_image'] == 'Y' ) :
                            ?>
                            <figure class="post-attach-image">
                                <img src="<?=base_url($attach['bfi_filename'])?>" class="img-responsive">
                                <figcaption><?=$attach['bfi_caption']?></figcaption>
                            </figure>
                            <?php
                        endif;
                    endforeach;
                endif;?>
                <?=$post['contents']?>
            </div>
            <div class="panel-body" style="background:#fff;">
                <div class="pull-left">
                    <button type="button" class="btn btn-default btn-flat" data-toggle="open-sns-share"><i class="icon-open"></i></button>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default" href="<?=base_url("board/{$board['brd_key']}/{$post['post_idx']}/edit")?>">수정</a>
                    <a class="btn btn-default" href="<?=base_url("board/{$board['brd_key']}/delete/{$post['post_idx']}").$querystring?>" data-toggle='post-delete'>삭제</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default margin-bottom-0" >
            <div class="panel-heading">
                <h4 class="panel-title">댓글<i class="icon-chat"></i></h4>
            </div>
            <div class="panel-body">
                <div id="comment-form-container">
                    <?=form_open("board/{$board['brd_key']}/comment", array("id"=>"form-comment"));?>
                    <input type="hidden" name="reurl" value="<?=current_full_url(TRUE)?>">
                    <input type="hidden" name="post_idx" value="<?=$post['post_idx']?>">
                    <div class="form-group">
                        <input type="text" class="form-control input-flat input-lg" id="comment_usr_name" name="usr_name" required="required" data-title="이름" placeholder="이름을 입력하세요">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control input-flat input-lg" id="comment_usr_pass" name="usr_pass" required="required" data-title="비밀번호" placeholder="비밀번호를 입력하세요">
                    </div>
                    <div class="form-group">
                        <textarea name="cmt_content" rows="5" class="form-control input-flat" placeholder="댓글을 남겨보세요" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-big btn-block">댓글달기</button>
                    </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <?php if(count($comment_list) > 0) :?>
        <ul class="comment-list">

            <?php foreach($comment_list as $comment) :?>
                <li class="comments">
                    <div class="comments-header">
                        <div class="pull-left">
                            <span class="name"><?=$comment['usr_name']?>님</span><span class="regtime"><?=$comment['cmt_regtime']?></span>
                        </div>
                        <div class="pull-right">
                            <a href="javascript:void(0);" class="btn btn-xs btn-default-gradient btn-flat" data-idx="<?=$comment['cmt_idx']?>" data-toggle="comment-edit">수정</a>
                            <a href="javascript:void(0);" class="btn btn-xs btn-default-gradient btn-flat" data-idx="<?=$comment['cmt_idx']?>" data-toggle="comment-delete">삭제</a>
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

    <div class="row">
        <div class="panel-footer">
            <div class="pull-left">
                <?php if($post_np['prev']) : ?>
                    <a class="btn btn-default btn-flat" href="<?=base_url("board/{$board['brd_key']}/{$post_np['prev']['post_idx']}").$querystring?>"><i class="icon-caret-down"></i>&nbsp;이전글</a>
                <?php endif;?>
                <?php if($post_np['next']) : ?>
                    <a class="btn btn-default btn-flat" href="<?=base_url("board/{$board['brd_key']}/{$post_np['next']['post_idx']}").$querystring?>"><i class="icon-caret-down i-rotate-180"></i>&nbsp;다음글</a>
                <?php endif;?>
            </div>

            <div class="pull-right">
                <a class="btn btn-dark btn-flat" href="<?=base_url("board/{$board['brd_key']}").$querystring?>">목록</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</article>