<?php $this->load->view('desktop/board/customer_common');?>
<?=$this->site->add_js("/static/js/board.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/editor_config.js");?>
<article id="skin-cscenter-write" class="container">
    <div class="write-form-container">
        <div class="cscenter-info">
            <p class="help">
                ※ 상당중이나 여행중에 조금이라도 불편한 사항이 있으셨나요?<br>
                ※ 불편하신 점이 있다면 본 신청서를 통해서 , 천생연분닷컴 고객만족센터로 접수하실 수 있습니다.<br>
                ※ 신청서가 접수되면 담당자가 불편신고내역을 현지와 확인하여 최대한 신속하게 처리하도록 하겠습니다.
            </p>
        </div>
        <?=form_open_multipart(NULL, array("id"=>"form-board-write", "autocomplete"=>"off"))?>
        <fieldset>
            <input type="hidden" name="post_key" value="<?=$this->session->session_id?>">
            <input type="hidden" name="post_idx" value="<?=element('post_idx',$post)?>">
            <input type="hidden" name="post_secret" value="Y">
            <input type="hidden" name="post_notice" value="N">

            <div class="form-group">
                <label class="form-group-label" for="usr_name">이름</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" id="usr_name" name="usr_name" value="<?=element('usr_name', $post)?>" placeholder="담당자 성명을 입력하세요" required="required" data-title="담당자 성명">
                </div>
                <div class="desc-box">
                    <div class="desc-box">
                        <div class="radio">
                            <input type="radio" name="post_category" id="post_category_1" value="허니문" checked><label for="post_category_1" >허니문</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="post_category" id="post_category_2" value="웨딩"><label for="post_category_2">웨딩</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="post_category" id="post_category_3" value="박람회"><label for="post_category_3">박람회</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="post_category" id="post_category_4" value="ETC"><label for="post_category_4">ETC</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-group-label" for="usr_phone">연락처</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" data-toggle="phone-check" id="usr_phone" name="usr_phone" value="<?=element('usr_phone', $post)?>" placeholder="핸드폰번호를 입력하세요" required="required" data-title="핸드폰번호">
                </div>
                <div class="desc-box"></div>
            </div>

            <div class="form-group">
                <label class="form-group-label" for="post_ext1">여행지</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" id="post_ext1" name="post_ext1" value="<?=element('post_ext1', $post)?>" placeholder="여행지를 입력하세요" required="required" data-title="여행지">
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
                    <input type="text" class="form-control input-md" name="post_title" id="post_title" placeholder="제목을 입력하세요" value="<?=element('post_title', $post)?>" required="required" data-title="제목">
                </div>
            </div>

            <div class="form-group">
                <textarea name="post_content" id="post_content" class="tinymce" value="" data-width="1078px"><?=element('post_content', $post)?></textarea>
            </div>

            <?php if($board['brd_use_file'] == 'Y') :?>
            <div class="form-group">
                <label class="form-group-label">파일 업로드</label>
                <div class="input-box" id="container-file-input">
                    <input type="file" name="userfile[]" class="form-control input-md">
                </div>
                <div class="desc-box">
                    <button type="button" class="btn btn-default btn-md" data-toggle="board-add-file-input" data-target="#container-file-input"><i class="fa fa-plus-circle"></i>&nbsp;파일 추가</button>
                </div>
            </div>
                <?php if(element('post_idx', $post) && element('post_attach_list', $post) && count(element('post_attach_list', $post))>0) :?>
                <div class="form-group">
                    <label class="form-group-label">첨부된 파일</label>
                    <div class="input-box" style="line-height:1.4">
                        <?php foreach(element("post_attach_list", $post) as $attach) :?>
                        <?=$attach['bfi_originname']?>&nbsp;<div class="checkbox" style="margin-left:30px;"><input type="checkbox" name="del_file[]" value="<?=$attach['bfi_idx']?>" id="attach_<?=$attach['bfi_idx']?>"><label for="attach_<?=$attach['bfi_idx']?>">삭제</label></div>
                        <div class="clearfix"></div>
                        <?php endforeach;?>
                    </div>
                </div>
                <?php endif;?>
            <?php endif;?>

            <div class="form-group">
                <textarea class="form-control" readonly rows="4"><?=$this->site->config('site_privacy')?></textarea>
                <div class="text-center margin-top-10">
                    <div class="checkbox">
                        <input type="checkbox" value="Y" id="agree_privacy" checked><label for="agree_privacy">위 개인정보 취급방침에 동의합니다.</label>
                    </div>
                </div>
            </div>

            <div class="form-group action-box">
                <button type="submit" class="btn btn-primary"><?=element('post_idx',$post)?'수정하기':'등록하기'?></button>
            </div>
        </fieldset>
        <?=form_close()?>
    </div>
</article>