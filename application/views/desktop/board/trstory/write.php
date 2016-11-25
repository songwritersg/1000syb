<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/editor_config.js");?>
<?php $this->load->view("desktop/board/trstory/common_header")?>
<article id="skin-trstory-write" class="container">
    <div class="board-title">
        <h2>허니문 여행후기 작성<i class="fa fa-pencil"></i></h2>
    </div>
    <img src="/static/images/board/trstory_event.jpg" class="wide-banner">
    <div class="write-form-container">
        <?=form_open_multipart(NULL, array("id"=>"form-board-write", "autocomplete"=>"off"))?>
        <fieldset>
            <input type="hidden" name="post_key" value="<?=$this->session->session_id?>">
            <input type="hidden" name="post_idx" value="<?=element('post_idx',$post)?>">
            <input type="hidden" name="post_secret" value="N">
            <input type="hidden" name="post_ext1" value="N">


            <div class="form-group">
                <label class="form-group-label" for="usr_name">작성자</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" id="usr_name" name="usr_name" value="<?=element('usr_name', $post)?>" placeholder="이름을 입력하세요" required="required" data-title="작성자">
                </div>
                <div class="desc-box">

                </div>
            </div>

            <div class="form-group">
                <label class="form-group-label" for="usr_phone">연락처</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" id="usr_phone" data-toggle="phone-check" name="usr_phone" value="<?=element('usr_phone', $post)?>" placeholder="연락처를 입력하세요" required="required" data-title="연락처">
                </div>
                <div class="desc-box"></div>
            </div>
            
            <div class="form-group">
                <label class="form-group-label" for="post_ext2">허니문지역</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" id="post_ext2"  name="post_ext2" value="<?=element('post_ext2', $post)?>" placeholder="허니문 지역을 입력하세요">
                </div>
                <div class="desc-box"></div>
            </div>

            <div class="form-group">
                <label class="form-group-label" for="usr_pass">비밀번호</label>
                <div class="input-box">
                    <input type="password" class="form-control input-md" id="usr_pass" name="usr_pass" value="" placeholder="비밀번호를 입력하세요" minlength="4" required="required" data-title="비밀번호">
                </div>
                <div class="desc-box"></div>
            </div>


            <div class="form-group">
                <label class="form-group-label" for="post_title">제목</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" name="post_title" id="post_title" placeholder="글 제목" value="<?=element('post_title', $post)?>" required="required" data-title="제목">
                </div>
                <div class="desc-box">
                    <?php if($auth['is_admin']) :?>
                        <div class="checkbox checkbox-md">
                            <input type="checkbox" value="Y" id="post_notice" name="post_notice" <?=element('post_notice', $post)=='Y'?'checked':''?>><label for="post_notice">공지</label>
                        </div>
                    <?php endif;?>
                </div>
            </div>

            <div class="form-group">
                <textarea name="post_content" id="post_content" class="tinymce" value="" data-width="1078px"><?=element('post_content', $post)?></textarea>
            </div>

            <div class="form-group action-box">
                <button type="submit" class="btn btn-primary"><?=element('post_idx',$post)?'수정하기':'등록하기'?></button>
                <button type="button" class="btn btn-default" data-toggle="btn-back">뒤로가기</button>
            </div>
        </fieldset>
        <?=form_close()?>
    </div>
</article>