<?php $this->load->view('desktop/board/qna_common');?>
<?=$this->site->add_js("/static/js/board.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/editor_config.js");?>
<article id="skin-sybqna-write" class="container">
    <div class="write-form-container">
        <?=form_open_multipart(NULL, array("id"=>"form-board-write", "autocomplete"=>"off"))?>
        <fieldset>
            <input type="hidden" name="post_key" value="<?=$this->session->session_id?>">
            <input type="hidden" name="post_idx" value="<?=element('post_idx',$post)?>">
            <input type="hidden" name="post_secret" value="Y">


            <div class="form-group">
                <label class="form-group-label" for="usr_name">이름</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" id="usr_name" name="usr_name" value="<?=element('usr_name', $post)?>" placeholder="이름을 입력하세요" required="required" data-title="이름">
                </div>
                <div class="desc-box">
                    <div class="radio">
                        <input type="radio" name="post_etc4" id="usr_gender_f" value="F" <?=(!element('post_etc4',$post) OR element('post_etc4',$post)=='F')?'checked':''?>><label for="usr_gender_f">신부</label>
                    </div>
                    <div class="radio">
                        <input type="radio" name="post_etc4" id="usr_gender_m" value="M" <?=(element('post_etc4',$post)=='M')?'checked':''?>><label for="usr_gender_m">신랑</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-group-label" for="usr_phone">핸드폰</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" data-toggle="phone-check" id="usr_phone" name="usr_phone" value="<?=element('usr_phone', $post)?>" placeholder="핸드폰번호를 입력하세요" required="required" data-title="핸드폰번호">
                </div>
                <div class="desc-box"></div>
            </div>

            <div class="form-group">
                <label class="form-group-label" for="usr_phone">이메일</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" id="usr_email" name="usr_email" value="<?=element('usr_email', $post)?>" placeholder="이메일 주소를 입력하세요" required="required" data-title="이메일 주소">
                </div>
                <div class="desc-box"></div>
            </div>

            
            <div class="form-group">
                <label class="form-group-label" for="post_category">문의 지사</label>
                <div class="input-box">
                    <select class="form-control  input-md" name="post_category"  id="post_category">
                        <?php foreach($board['brd_category'] as $category) :?>
                        <option value="<?=$category['bca_key']?>" <?=$category['bca_key']==element('post_category',$post)?'selected':''?>><?=$category['bca_key']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-group-label" for="post_title">제목</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" name="post_title" id="post_title" placeholder="글 제목" value="<?=element('post_title', $post)?>" required="required" data-title="제목">
                </div>
            </div>


            <div class="form-group">
                <label class="form-group-label" for="usr_pass">비밀번호</label>
                <div class="input-box">
                    <input type="password" class="form-control input-md" id="usr_pass" name="usr_pass" value="" placeholder="비밀번호를 입력하세요" minlength="4" required="required" data-title="비밀번호">
                </div>
                <div class="desc-box"></div>
            </div>

            <div class="form-group">
                <textarea name="post_content" id="post_content" class="tinymce" value="" data-width="1078px"><?=element('post_content', $post)?></textarea>
            </div>

            <div class="form-group margin-top-10">
                <textarea class="form-control" readonly rows="4"><?=$this->site->config('site_privacy')?></textarea>
                <div class="text-center margin-top-10">
                    <div class="checkbox">
                        <input type="checkbox" value="Y" id="agree_privacy" checked><label for="agree_privacy">위 개인정보 취급방침에 동의합니다.</label>
                    </div>
                </div>
            </div>
            <div class="form-group action-box">
                <button type="submit" class="btn btn-primary"><?=element('post_idx',$post)?'수정하기':'등록하기'?></button>
                <button type="button" class="btn btn-default" data-toggle="btn-back">뒤로가기</button>
            </div>
        </fieldset>
        <?=form_close()?>
    </div>
</article>