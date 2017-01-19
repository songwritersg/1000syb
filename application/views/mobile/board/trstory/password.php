<h2 class="page-title">Password<small>비밀번호 입력</small></h2>
<article class="container margin-top-20">
    <div class="password-container">
        <?=form_open("https://www.1000syb.com/board/{$board['brd_key']}/password/{$post_idx}", array("onsubmit"=>"board.password.submit();","autocomplete"=>"off"));?>
        <input type="hidden" name="reurl" value="<?=set_value("reurl",$reurl)?>">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">비밀번호 입력<i class="icon-lock"></i></h4>
            </div>
            <div class="panel-body">
                <input type="password" class="form-control input-lg input-flat" name="password" accesskey="s" required="required" placeholder="비밀번호를 입력하세요" tabindex="1" autofocus>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <button type="button" class="btn btn-default btn-block btn-flat btn-lg" onclick="history.back(-1);">취소</button>
            </div>
            <div class="col-xs-6">
                <button type="submit" class="btn btn-primary btn-block btn-flat btn-lg" tabindex="2">확인</button>
            </div>
        </div>
        <?=form_close()?>
    </div>
</article>