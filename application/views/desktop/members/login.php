<?=$this->site->add_js("/static/js/members.min.js")?>
<article class="container">
    <div id="login-box">
        <?=form_open(NULL, array("id"=>"form-login", "onsubmit"=>"return members.login();"))?>
        <label for="login_id">아이디</label>
        <input type="text" class="form-control" id="login_id" name="login_id" placeholder="사용자 아이디" autofocus>
        <label for="login_pass">비밀번호</label>
        <input type="password" class="form-control" id="login_pass" name="login_pass" placeholder="사용자 비밀번호">
        <button type="submit" class="btn btn-primary pull-right">로그인</button>
        <div class="clearfix"></div>
        <?=form_close()?>
    </div>
</article>