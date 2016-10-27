var members = function(){
    return {
        login : function(){
            var frmLogin=$("form#form-login");
            var inpID=frmLogin.find('input[name="login_id"]');
            var inpPW=frmLogin.find('input[name="login_pass"]');
            if(frmLogin.length<=0||inpID.length<=0||inpPW.length<=0) return false;
            if(inpID.val().length<=0) {
                alert('아이디를 입력해주세요');
                inpID.focus();
                return false;
            }
            if(inpPW.val().length<=0) {
                alert('비밀번호를 입력해주세요');
                inpPW.focus();
                return false;
            }
            return true;
        }
    }
}();