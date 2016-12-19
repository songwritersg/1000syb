<?php $this->load->view('desktop/board/customer_common');?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/editor_config.js");?>
<article id="skin-article-write" class="container">
    <div class="write-form-container">
        <?=form_open_multipart(NULL, array("id"=>"form-board-write", "autocomplete"=>"off"))?>
        <fieldset>
            <input type="hidden" name="post_key" value="<?=$this->session->session_id?>">
            <input type="hidden" name="post_idx" value="<?=element('post_idx',$post)?>">
            <input type="hidden" name="post_category" value="<?=element("post_category", $post)?>">
            <input type="text" class="fake-input">
            <input type="password" class="fake-input">

            <table class="form-table">
                <colgroup>
                    <col width="170" />
                    <col width="*">
                    <col width="443">
                </colgroup>
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
                    <th><label for="post_tag">주요 태그</label></th>
                    <td>
                        <input type="text" class="form-control input-md" name="post_tag" id="post_tag" placeholder="주요 태그" value="<?=element('post_tag', $post)?>">
                    </td>
                    <td>쉼표(,)를 이용하여 여러 키워드를 입력하실수 있습니다.</td>
                </tr>
                <tr>
                    <td colspan="3" class="no-padding">
                        <textarea name="post_content" id="post_content" class="tinymce" value="" data-width="1078px"><?=element('post_content', $post)?></textarea>
                    </td>
                </tr>
            </table>
            <div class="margin-top-30 text-center">
                <button type="submit" class="btn btn-primary btn-lg"><?=element('post_idx',$post)?'수정하기':'등록하기'?></button>
                <button type="button" class="btn btn-default btn-lg" data-toggle="btn-back">뒤로가기</button>
            </div>
        </fieldset>
        <?=form_close()?>
    </div>
</article>