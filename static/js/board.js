var recaptchaOnLoad = function(){
    grecaptcha.render('recaptcha', {
        'sitekey' : '6LcnhhAUAAAAAIzr4PMU44R4vTGISX4z3mo8oJsS',
        'theme' : 'light'
    });
}
$(function(){

    $("[data-toggle='post-delete']").on('click', function(e){
        if( ! confirm('해당 글을 삭제하시겠습니까?') )
        {
            e.preventDefault();
        }
    })

    $('button[data-toggle="board-add-file-input"]')
        .off('click.file_input_add')
        .on('click.file_input_add', function(){
            var target=$(this).data('target');
            if($(target).length<=0) {
                return false;
            }
            var input = $("<input>").attr({
                'type' : 'file',
                'name' : 'userfile[]'
            }).addClass("form-control input-md");
            $(target).append(input);
    });

    $("a[data-toggle='comment-delete']").on('click', function(e){
        var cmt_idx = $(this).data('idx');
        $.get('/board/comment_delete', {cmt_idx:cmt_idx}, function(res){
            if(res) {
                $("#dialog-password").remove();
                $("body").append( $("<div>").attr('id', 'dialog-password') );
                $("#dialog-password").html(res);
                var w = 400;
                if( $(window).width() < 400 )
                {
                    w = 340;
                }
                $("#dialog-password").dialog({ autoOpen : true, draggable : false, dialogClass : 'close', resizeable : false, modal: true, width:w, height:'auto'});
            }
            else {
                alert('잘못된 접근입니다.');
                return false;
            }
        });

    });

    $("a[data-toggle='comment-edit']").on('click', function(e){
        var cmt_idx = $(this).data('idx');
        $.get('/board/comment_edit', {cmt_idx:cmt_idx}, function(res){
            if(res) {
                $("#dialog-comment-edit").remove();
                $("body").append( $("<div>").attr('id', 'dialog-comment-edit') );
                $("#dialog-comment-edit").html(res);
                var w = 500;
                if( $(window).width() < 500 )
                {
                    w = 340;
                }
                $("#dialog-comment-edit").dialog({ autoOpen : true, draggable : false, dialogClass : 'close', resizeable : false, modal: true, width:w, height:'auto'});
            }
            else {
                alert('잘못된 접근입니다.');
                return false;
            }
        });
    });

    var formWrite=$("#form-board-write");

    if( formWrite.length ) {
        formWrite.on('submit', function(e){
            if(formWrite.length<=0) e.preventDefault();

            if (typeof(grecaptcha) != 'undefined') {
                if (grecaptcha.getResponse() == "") {
                    alert("스팸등록방지 확인을 눌러주세요.");
                    e.preventDefault();
                    return false;
                }
            }

            if( formWrite.find('input[type="checkbox"]#agree_privacy').length > 0 )
            {
                if(! formWrite.find('input[type="checkbox"]#agree_privacy').prop("checked") )
                {
                    alert('개인정보 취급방침에 동의하셔야 합니다.');
                    e.preventDefault();
                    return false;
                }
            }

            formWrite.find('[required="required"]').each(function(){
                if($(this).val().length<=0) {
                    var el_title = $(this).data('title');
                    alert('['+el_title+'] 항목은 필수로 입력하셔야 합니다.');
                    $(this).focus();
                    e.preventDefault();
                    return false;
                }
            });

            if( tinymce.activeEditor)
            {
                if(tinymce.activeEditor.getContent({format:'text'}).trim().length<=0){
                    alert('글 내용을 입력하셔야합니다.');
                    tinymce.activeEditor.focus();
                    e.preventDefault();
                    return false;
                }
            }
            ga_send('글 작성완료 :: 천생연분닷컴', '/board/'+formWrite.find("input[name='brd_key']").val()+'/write_ok');

            return true;
        });
    }

    var formComment=$("#form-comment");
    if(formComment.length) {
        formComment.on('submit', function(e){
            if(formComment.length<=0) e.preventDefault();
            formComment.find('[required="required"]').each(function(){
                if($(this).val().length<=0) {
                    var el_title = $(this).data('title');
                    alert('['+el_title+'] 항목은 필수로 입력하셔야 합니다.');
                    $(this).focus();
                    e.preventDefault();
                    return false;
                }
            });
        });
    }
});
