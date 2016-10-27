<?=$this->site->add_js("/static/js/board.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/editor_config.js");?>
<article id="skin-normal-write" class="container">
    <div class="write-form-container">
        <?=form_open_multipart(NULL, array("id"=>"form-board-write", "onsubmit"=>"return board.write();", "autocomplete"=>"off"))?>
        <fieldset>
            <input type="hidden" name="post_key" value="<?=$this->session->session_id?>">
            <?php if(element("brd_category", $board)) :?>
            <div class="form-group">
                <label class="form-group-label" for="post_category">분류</label>
                <div class="input-box">
                    <select class="form-control  input-md" name="post_category"  id="post_category">
                        <?php foreach($board['brd_category'] as $category) :?>
                        <option value="<?=$category['bca_key']?>" <?=$category['bca_key']==element('post_category',$post)?'selected':''?>><?=$category['bca_key']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <?php else : ?>
            <input type="hidden" name="post_category" value="<?=element("post_category", $post)?>">
            <?php endif;?>

            <div class="form-group">
                <label class="form-group-label" for="post_title">제목</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" name="post_title" id="post_title" placeholder="글 제목" value="<?=element('post_title', $post)?>">
                </div>
                <div class="desc-box">
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
                </div>
            </div>

            <?php if($this->member->is_login()) :?>
                <input type="hidden" class="form-control" name="usr_name" value="<?=$this->member->info('usr_name')?>">
                <input type="hidden" class="form-control" name="usr_id" value="<?=$this->member->info('usr_id')?>">
            <?php else :?>
                <div class="form-group">
                    <label class="form-group-label" for="usr_name">이름</label>
                    <div class="input-box">
                        <input type="text" class="form-control input-md" id="usr_name" name="usr_name" value="<?=element('usr_name', $post)?>" placeholder="이름을 입력하세요">
                    </div>
                    <div class="desc-box">

                    </div>
                </div>
                <div class="form-group">
                    <label class="form-group-label" for="usr_pass">비밀번호</label>
                    <div class="input-box">
                        <input type="password" class="form-control input-md" id="usr_pass" name="usr_pass" value="" placeholder="비밀번호를 입력하세요" minlength="4">
                    </div>
                    <div class="desc-box"></div>
                </div>
            <?php endif;?>

            <div class="form-group">
                <textarea name="post_content" id="post_content" class="tinymce" value="" data-width="1078px"><?=element('post_content', $post)?></textarea>
            </div>

            <?php if($board['brd_use_file'] == 'Y') :?>
            <div class="form-group">
                <label class="form-group-label">파일 업로드</label>
                <div class="input-box" id="container-file-input">
                    <input type="file" name="userfile[]" class="form-control input-md" accept="image/*">
                </div>
                <div class="desc-box">
                    <button type="button" class="btn btn-default btn-md" data-toggle="board-add-file-input" data-target="#container-file-input"><i class="fa fa-plus-circle"></i>&nbsp;파일 추가</button>
                </div>
            </div>
            <?php endif;?>

            <div class="form-group action-box">
                <button type="submit" class="btn btn-primary">등록하기</button>
                <button type="button" class="btn btn-default" data-toggle="btn-back">뒤로가기</button>
            </div>
        </fieldset>
        <?=form_close()?>
    </div>
</article>