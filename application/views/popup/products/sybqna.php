
<div class="pop-content">
    <img src="/static/images/products/title_sybqna.png">
    <a class="close">&times;</a>
    <form id="form-sybqna" method="post" action="<?=base_url("api/products/sybqna")?>">
        <fieldset>
            <div class="form-group">
                <label class="control-label" for="form-sybqna-usrname">이름</label>
                <div class="input-box">
                    <input id="form-sybqna-usrname" type="text" class="form-control input-md" placeholder="작성자 이름을 입력하세요" style="width:290px;">
                </div>
                <div class="input-box">
                    <div class="radio">
                        <input type="radio" class="form-control" name="usr_gender" id="usr_gender_m" value="M"><label for="usr_gender_m">신랑</label>
                    </div>
                    <div class="radio">
                        <input type="radio" class="form-control" name="usr_gender" id="usr_gender_f" value="F" checked><label for="usr_gender_f">신부</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="form-sybqna-phone">연락처</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md phone-check" name="usr_phone" placeholder="" id="form-sybqna-phone" style="width:390px;">
                    <p class="help-block">※ 빠른 상담을 위해 핸드폰 번호를 입력해주세요.</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="form-sybqna-email">이메일</label>
                <div class="input-box">
                    <input type="email" class="form-control input-md email-check" name="usr_email" placeholder="" id="form-sybqna-email" style="width:390px;">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="form-sybqna-category">문의지사</label>
                <div class="input-box">
                    <select class="form-control input-md" name="post_category" id="form-sybqna-category" style="width:200px;">
                        <?php foreach($categories as $cate) :?>
                        <option value="<?=$cate['bca_key']?>"><?=$cate['bca_key']?></option>
                        <?php endforeach?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="form-sybqna-title">제목</label>
                <div class="input-box">
                    <input type="text" class="form-control input-md" name="post_title" id="form-sybqna-title">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="form-sybqna-usrpass">비밀번호</label>
                <div class="input-box">
                    <input type="password" class="form-control input-md" name="usr_pass" id="form-sybqna-usrpass" style="width:150px;">
                </div>
            </div>
            <div class="form-group">
                <textarea class="tinymce" rows="20" id="post_content" name="post_content"></textarea>
            </div>

            <div class="policy">
                <textarea class="form-control" readonly="readonly" rows="3" style="resize:none"><?=$this->site->config('site_privacy');?></textarea>
                <div class="checkbox pull-right margin-top-10">
                    <input type="checkbox" value="Y" id="agree_privacy" checked><label for="agree_privacy">위 개인정보 취급방침에 동의합니다.</label>
                </div>
            </div>
            
            <div class="text-center margin-top-30">
                <button type="submit" class="btn btn-primary btn-lg">작성하기</button>
            </div>
        </fieldset>
    </form>
</div>
<script>
    $(document).ready(function(){
        tinymce.init({
            selector:'textarea#post_content',
            height : 300,
            width : "99%",
            theme_advanced_resizing: true,
            theme_advanced_resizing_use_cookie : false,
            menubar : false,
            plugins : 'advlist autolink link image imagetools media lists print preview emoticons table textcolor colorpicker code pagebreak jsplus_easy_image',
            language: "ko",
            toolbar1: 'preview code | jsplus_easy_image image media table emoticons | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | link pagebreak',
            toolbar2: 'formatselect fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough removeformat',
            font_formats : "나눔고딕=Nanum Gothic;돋움=돋움,Dotum;굴림=굴림,Gulim;바탕=바탕,Batang;궁서=궁서;Arial=Arial;Comic Sans MS=Comic Sans MS;Courier New=Courier New;Tahoma=Tahoma;Times New Roman=Times New Roman;Verdana=Verdana",
            fontsize_formats : "10px 11px 12px 14px 16px 18px 20px 24px 28px",
        });
    });
</script>