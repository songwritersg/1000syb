<h2 class="page-title">Customer Service<small>고객불편신고</small></h2>
<?php $this->load->view('mobile/board/customer_common')?>


<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<article id="skin-sybqna-write" class="container">
    <div class="write-form-container margin-top-20">
        <?=form_open_multipart("http://www.1000syb.com/board/cscenter/write", array("class"=>"form-horizontal", "id"=>"form-board-write", "autocomplete"=>"off"))?>
        <fieldset>
            <input type="hidden" name="post_key" value="<?=$this->session->session_id?>">
            <input type="hidden" name="post_idx" value="<?=element('post_idx',$post)?>">
            <input type="hidden" name="brd_key" value="<?=$board['brd_key']?>">
            <input type="hidden" name="post_secret" value="Y">
            <input type="hidden" name="post_notice" value="N">


            <div class="form-group form-group-padding margin-bottom-0">
                <div class="col-xs-8">
                    <div class="row margin-bottom-m0">
                        <input type="text" style="border-right:0px;" class="form-control input-flat input-big input-no-border" id="usr_name" name="usr_name" value="<?=element('usr_name', $post)?>" placeholder="작성자" required="required" data-title="작성자">
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="row margin-bottom-m0">
                        <select class="form-control input-flat input-big input-no-border" name="post_category">
                            <?php foreach($board['brd_category'] as $category) :?>
                                <option value="<?=$category['bca_key']?>" <?=$category['bca_key']==element('post_category',$post, $this->input->get('category'))?'selected':''?>><?=$category['bca_key']?></option>
                            <?php endforeach;?>
                        </select>
                        <i class="icon-caret-down" style="right:15px;"></i>
                    </div>
                </div>
            </div>

            <div class="form-group form-group-padding margin-bottom-m0" style="margin-bottom:-1px;">
                <input type="tel" class="form-control input-flat input-big input-no-border" data-toggle="phone-check" id="usr_phone" name="usr_phone" value="<?=element('usr_phone', $post)?>" placeholder="연락처" required="required" data-title="연락처">
                <i class="icon-iphone"></i>
            </div>


            <div class="form-group form-group-padding margin-bottom-m0" style="margin-bottom:-1px;">
                <input type="text" class="form-control input-flat input-big input-no-border"  name="post_ext1" value="<?=element('post_ext1', $post)?>" placeholder="허니문지역" required="required" data-title="허니문지역">
                <i class="icon-location"></i>
            </div>

            <div class="form-group form-group-padding " style="margin-bottom:-1px;">
                <input type="password" class="form-control input-flat input-big input-no-border" id="usr_pass" name="usr_pass" value="" placeholder="비밀번호를 입력하세요" minlength="4" required="required" data-title="비밀번호">
                <i class="icon-lock"></i>
            </div>

            <div class="form-group form-group-padding " style="margin-bottom:-1px;">
                <input type="text" class="form-control input-flat input-big input-no-border" name="post_title" id="post_title" placeholder="제목" value="<?=element('post_title', $post)?>" required="required" data-title="제목" autocomplete="off">
                <i class="icon-font"></i>
            </div>

            <div class="form-group form-group-padding">
                <div style="border:1px solid #ddd">
                    <textarea name="post_content" id="post_content" class="tinymce" value="" data-width="1078px"><?=element('post_content', $post)?></textarea>
                </div>
            </div>


            <div class="form-group form-group-padding ">
                <input type="file" name="userfile[]" class="form-control input-flat input-big input-no-border">
                <i class="icon-paper-clip"></i>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><label for="agree_privacy" style="display:block;">개인정보 취급방침 동의<small class="text-primary">(필수)</small></label></h4>
                    <div class="checks">
                        <input type="checkbox" value="Y" id="agree_privacy"><label for="agree_privacy"></label>
                    </div>
                </div>
                <div class="panel-body no-padding">
                    <textarea class="form-control input-flat" style="font-size:12px; letter-spacing:-0.05em; border:0px;" readonly rows="4"><?=$this->site->config('site_privacy')?></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6" style="padding-right:7.5px;">
                    <button type="button" class="btn btn-default btn-big btn-block btn-flat" data-toggle="btn-back">뒤로가기</button>
                </div>
                <div class="col-xs-6" style="padding-left:7.5px;">
                    <button type="submit" class="btn btn-primary btn-big btn-block btn-flat"><?=element('post_idx',$post)?'수정하기':'등록하기'?></button>
                </div>
            </div>

        </fieldset>
        <?=form_close()?>
    </div>
</article>

<script>
    $(function(){
        $(".tinymce").each(function(){
            var editor_id = $(this).attr('id');
            var width = $(this).data('width');
            if( typeof width == 'undefined' || ! width ) {
                width = '100%';
            }
            if( !editor_id || $(this).prop("nodeName") != 'TEXTAREA' ) return true;

            tinymce.init({
                selector:'textarea#'+editor_id,
                height : 300,
                width : '100%',
                theme_advanced_resizing: true,
                theme_advanced_resizing_use_cookie : false,
                menubar : false,
                plugins : 'advlist autolink link image imagetools media lists print preview emoticons table textcolor colorpicker code pagebreak jsplus_easy_image',
                language: "ko",
                toolbar1: 'bold italic alignleft aligncenter alignright link jsplus_easy_image',
                /*
                 toolbar1: 'jsplus_easy_image image media table emoticons | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | link pagebreak',
                 toolbar2: 'formatselect fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough removeformat',
                 */
                font_formats : "나눔고딕=Nanum Gothic;돋움=돋움,Dotum;굴림=굴림,Gulim;바탕=바탕,Batang;궁서=궁서;Arial=Arial;Comic Sans MS=Comic Sans MS;Courier New=Courier New;Tahoma=Tahoma;Times New Roman=Times New Roman;Verdana=Verdana",
                fontsize_formats : "10px 11px 12px 14px 16px 18px 20px 24px 28px",
                relative_urls : false,
                remove_script_host : false,
                document_base_url : base_url
            });
        });
    });
</script>

