<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/editor_config.js");?>
<?php $this->load->view("desktop/board/trstory/common_header")?>
<article id="skin-trstory-write" class="container" style="margin-bottom:50px;">
    <div class="board-title">
        <h2>허니문 여행후기 작성<i class="fa fa-pencil"></i></h2>
    </div>
    <img src="/static/images/board/trstory_event.jpg" class="wide-banner">
    <div class="write-form-container">
        <?=form_open_multipart(NULL, array("id"=>"form-board-write", "autocomplete"=>"off"))?>
        <fieldset>
            <input type="hidden" name="post_key" value="<?=$this->session->session_id?>">
            <input type="hidden" name="post_idx" value="<?=element('post_idx',$post)?>">
            <input type="hidden" name="brd_key" value="<?=$board['brd_key']?>">
            <input type="hidden" name="post_secret" value="N">
            <input type="hidden" name="post_ext1" value="N">
            <input type="text" class="fake-input">
            <input type="password" class="fake-input">
            <table class="form-table">
                <colgroup>
                    <col width="170" />
                    <col width="*">
                    <col width="443">
                </colgroup>
                <tr>
                    <th><label for="usr_name">작성자</label></th>
                    <td>
                        <input type="text" class="form-control input-md" id="usr_name" name="usr_name" value="<?=element('usr_name', $post)?>" placeholder="이름을 입력하세요" required="required" data-title="작성자">
                    </td>
                    <td/>
                </tr>
                <tr>
                    <th><label for="usr_phone">연락처</label></th>
                    <td>
                        <input type="text" class="form-control input-md" id="usr_phone" data-toggle="phone-check" name="usr_phone" value="<?=element('usr_phone', $post)?>" placeholder="연락처를 입력하세요" required="required" data-title="연락처">
                    </td>
                    <td/>
                </tr>
                <tr>
                    <th><label for="post_ext2">허니문지역</label></th>
                    <td>
                        <input type="text" class="form-control input-md" id="post_ext2"  name="post_ext2" value="<?=element('post_ext2', $post)?>" placeholder="허니문 지역을 입력하세요">
                    </td>
                    <td />
                </tr>
                <tr>
                    <th><label for="usr_pass">비밀번호</label></th>
                    <td>
                        <input type="password" class="form-control input-md" id="usr_pass" name="usr_pass" value="" placeholder="비밀번호를 입력하세요" minlength="4" required="required" data-title="비밀번호" autocomplete="off">
                    </td>
                    <td />
                </tr>
                <tr>
                    <th><label for="post_title">제목</label></th>
                    <td>
                        <input type="text" class="form-control input-md" name="post_title" id="post_title" placeholder="글 제목" value="<?=element('post_title', $post)?>" required="required" data-title="제목">
                    </td>
                    <td>
                        <?php if($auth['is_admin']) :?>
                            <div class="checkbox checkbox-md">
                                <input type="checkbox" value="Y" id="post_notice" name="post_notice" <?=element('post_notice', $post)=='Y'?'checked':''?>><label for="post_notice">공지</label>
                            </div>
                        <?php endif;?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="no-padding">
                        <textarea name="post_content" id="post_content" class="tinymce" value="" data-width="1078px"><?=element('post_content', $post)?></textarea>
                    </td>
                </tr>
            </table>

            <div class="form-group margin-top-10">
                <textarea class="form-control" readonly rows="4"><?=$this->site->config('site_privacy')?></textarea>
                <div class="text-center margin-top-10">
                    <div class="checkbox">
                        <input type="checkbox" value="Y" id="agree_privacy"><label for="agree_privacy">위 개인정보 취급방침에 동의합니다.</label>
                    </div>
                </div>
            </div>
            <div class="form-group action-box text-center margin-top-30">
                <button type="submit" class="btn btn-primary btn-lg"><?=element('post_idx',$post)?'수정하기':'등록하기'?></button>
                <button type="button" class="btn btn-default btn-lg" data-toggle="btn-back">뒤로가기</button>
            </div>
        </fieldset>
        <?=form_close()?>
    </div>
</article>