<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/editor_config.js");?>
<?php $this->load->view('desktop/board/customer_common');?>
<article id="skin-sybnotice-write" class="container">
    <div class="write-form-container">
        <?=form_open_multipart(NULL, array("id"=>"form-board-write", "autocomplete"=>"off"))?>
        <fieldset>
            <input type="hidden" name="post_key" value="<?=$this->session->session_id?>">
            <input type="hidden" name="post_idx" value="<?=element('post_idx',$post)?>">
            <input type="hidden" name="brd_key" value="<?=$board['brd_key']?>">
            <input type="text" class="fake-input">
            <input type="password" class="fake-input">

            <table class="form-table">
                <colgroup>
                    <col width="170" />
                    <col width="*">
                    <col width="443">
                </colgroup>
                <?php if(element("brd_category", $board)) :?>
                <tr>
                    <th><label for="post_category">분류</label></th>
                    <td>
                        <select class="form-control  input-md" name="post_category"  id="post_category">
                            <?php foreach($board['brd_category'] as $category) :?>
                                <option value="<?=$category['bca_key']?>" <?=$category['bca_key']==element('post_category',$post)?'selected':''?>><?=$category['bca_key']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td/>
                </tr>
                <?php else : ?>
                <input type="hidden" name="post_category" value="<?=element("post_category", $post)?>">
                <?php endif;?>
                <tr>
                    <th><label for="post_title">제목</label></th>
                    <td>
                        <input type="text" class="form-control input-md" name="post_title" id="post_title" placeholder="글 제목" value="<?=element('post_title', $post)?>" required="required" data-title="제목">
                    </td>
                    <td>
                        <?php if($board['brd_use_secret'] == 'Y') :?>
                            <div class="checkbox checkbox-md">
                                <input type="checkbox" value="Y" id="post_secret" name="post_secret" <?=element('post_secret', $post)=='Y'?'checked':''?>><label for="post_secret">비밀글</label>
                            </div>
                        <?php endif;?>

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

                <?php if($board['brd_use_file'] == 'Y') :?>
                    <tr>
                        <th><label>파일 업로드</label></th>
                        <td id="container-file-input">
                            <input type="file" name="userfile[]" class="form-control input-md">
                        </td>
                        <td style="vertical-align: bottom;">
                            <button type="button" class="btn btn-default btn-md" data-toggle="board-add-file-input" data-target="#container-file-input"><i class="fa fa-plus-circle"></i>&nbsp;파일 추가</button>
                        </td>
                    </tr>
                    <?php if(element('post_idx', $post) && element('post_attach_list', $post) && count(element('post_attach_list', $post))>0) :?>
                    <tr>
                        <th><label class="form-group-label">첨부된 파일</label></th>
                        <td>
                            <?php foreach(element("post_attach_list", $post) as $attach) :?>
                                <?=$attach['bfi_originname']?>&nbsp;<div class="checkbox" style="margin-left:30px;"><input type="checkbox" name="del_file[]" value="<?=$attach['bfi_idx']?>" id="attach_<?=$attach['bfi_idx']?>"><label for="attach_<?=$attach['bfi_idx']?>">삭제</label></div>
                                <div class="clearfix"></div>
                            <?php endforeach;?>
                        </td>
                    </tr>
                    <?php endif;?>
                <?php endif;?>
            </table>

            <div class="form-group action-box text-center margin-top-30">
                <button type="submit" class="btn btn-primary btn-lg"><?=element('post_idx',$post)?'수정하기':'등록하기'?></button>
                <button type="button" class="btn btn-default btn-lg" data-toggle="btn-back">뒤로가기</button>
            </div>
        </fieldset>
        <?=form_close()?>
    </div>
</article>