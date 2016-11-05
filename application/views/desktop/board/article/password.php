<?php $this->load->view('desktop/board/customer_common');?>
<article id="skin-article-password" class="container">
    <div class="password-container">
        <?=form_open(NULL, array("onsubmit"=>"board.password.submit();","autocomplete"=>"off"));?>
        <input type="hidden" name="reurl" value="<?=set_value("reurl",$reurl)?>">
        <div class="password-box">
            <legend class="legend">비밀번호 입력</legend>
            <h4>비밀번호를 입력해주세요.</h4>
            <hr>
            <fieldset class="fieldset">
                <div class="col col-8">
                    <input type="password" class="form-control input-lg" name="password" accesskey="s" required="required" placeholder="비밀번호를 입력하세요" tabindex="1" autofocus>
                </div>
                <div class="col col-4">
                    <button type="submit" class="btn btn-primary btn-block btn-lg" tabindex="2">확인</button>
                </div>
                <div class="clearfix"></div>
            </fieldset>
            <?=validation_errors('<p class="help-block has-error">');?>
        </div>
        <?=form_close()?>
    </div>
</article>