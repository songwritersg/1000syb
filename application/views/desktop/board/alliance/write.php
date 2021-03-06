<script src='https://www.google.com/recaptcha/api.js?onload=recaptchaOnLoad&render=explicit' async defer></script>
<?php $this->load->view('desktop/board/customer_common');?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/editor_config.js");?>
<article id="skin-alliance-write" class="container" style="margin-bottom:50px;">
    <div class="write-form-container">
        <div class="alliance-info">
            <dl class="manager-info">
                <dt>담당자 : </dt>
                <dd>곽윤철 팀장</dd>
                <dt>연락처 : </dt>
                <dd>02-720-8876</dd>
                <dt>E-mail : </dt>
                <dd>yunchurl@daum.net</dd>
            </dl>
            <p class="help">
                ※ 고객을 위한 다양한 아이템과 높은 퀄리티의 서비스를 위해 천생연분닷컴은 항상 열려있습니다.<br>
                ※ 기업간의 신뢰와 협력을 중요하게 생각하며 적극적 제휴와 공동마케팅을 통해<br>
                성공적인 비전을 만드실 파트너를 찾습니다.
            </p>
        </div>
        <?=form_open_multipart(NULL, array("id"=>"form-board-write", "autocomplete"=>"off"))?>
        <fieldset>
            <input type="hidden" name="post_key" value="<?=$this->session->session_id?>">
            <input type="hidden" name="post_idx" value="<?=element('post_idx',$post)?>">
            <input type="hidden" name="brd_key" value="<?=$board['brd_key']?>">
            <input type="hidden" name="post_secret" value="Y">
            <input type="hidden" name="post_notice" value="N">
            <input type="text" class="fake-input">
            <input type="password" class="fake-input">
            <table class="form-table">
                <colgroup>
                    <col width="170" />
                    <col width="*">
                    <col width="443">
                </colgroup>
                <tr>
                    <th><label for="post_title">업체명</label></th>
                    <td>
                        <input type="text" class="form-control input-md" name="post_title" id="post_title" placeholder="업체명" value="<?=element('post_title', $post)?>" required="required" data-title="업체명">
                    </td>
                    <td>
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
                    </td>
                </tr>
                <tr>
                    <th><label for="usr_name">담당자 성명</label></th>
                    <td>
                        <input type="text" class="form-control input-md" id="usr_name" name="usr_name" value="<?=element('usr_name', $post)?>" placeholder="담당자 성명을 입력하세요" required="required" data-title="담당자 성명">
                    </td>
                    <td/>
                </tr>
                <tr>
                    <th><label for="post_ext1">대표 번호</label></th>
                    <td>
                        <input type="text" class="form-control input-md" id="post_ext1" name="post_ext1" value="<?=element('post_ext1', $post)?>" placeholder="대표번호를 입력하세요" required="required" data-title="대표번호">
                    </td>
                    <td/>
                </tr>
                <tr>
                    <th><label for="usr_phone">핸드폰</label></th>
                    <td>
                        <input type="text" class="form-control input-md" data-toggle="phone-check" id="usr_phone" name="usr_phone" value="<?=element('usr_phone', $post)?>" placeholder="핸드폰번호를 입력하세요" required="required" data-title="핸드폰번호">
                    </td>
                    <td/>
                </tr>
                <tr>
                    <th><label for="usr_phone">이메일</label></th>
                    <td>
                        <input type="text" class="form-control input-md" id="usr_email" name="usr_email" value="<?=element('usr_email', $post)?>" placeholder="이메일 주소를 입력하세요" required="required" data-title="이메일 주소">
                    </td>
                    <td/>
                </tr>
                <tr>
                    <th><label for="usr_pass">비밀번호</label></th>
                    <td>
                        <input type="password" class="form-control input-md" id="usr_pass" name="usr_pass" value="" placeholder="비밀번호를 입력하세요" minlength="4" required="required" data-title="비밀번호">
                    </td>
                    <td/>
                </tr>
                <tr>
                    <th><label for="post_content">제휴 내용</label></th>
                    <td colspan="2">
                        <textarea name="post_content" id="post_content" class="form-control" rows="10"><?=element('post_content', $post)?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><label>파일 업로드</label></th>
                    <td id="container-file-input">
                        <input type="file" name="userfile[]" class="form-control input-md">
                    </td>
                    <td style="vertical-align:bottom">
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
                    <td/>
                </tr>
                <?php endif;?>
                <tr>
                    <th>스팸등록방지</th>
                    <td colspan="2"><div id="recaptcha" style="margin:auto"></div></td>
                </tr>
            </table>

            <div class="margin-top-30">
                <textarea class="form-control" readonly rows="4"><?=$this->site->config('site_privacy')?></textarea>
                <div class="text-center margin-top-10">
                    <div class="checkbox">
                        <input type="checkbox" value="Y" id="agree_privacy"><label for="agree_privacy">위 개인정보 취급방침에 동의합니다.</label>
                    </div>
                </div>
            </div>

            <div class="margin-top-30 text-center">
                <button type="submit" class="btn btn-primary btn-lg"><?=element('post_idx',$post)?'수정하기':'등록하기'?></button>
            </div>
        </fieldset>
        <?=form_close()?>
    </div>
</article>