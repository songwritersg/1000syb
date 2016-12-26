$(function(){
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
                $("#dialog-password").dialog({ autoOpen : true, draggable : false, dialogClass : 'close', resizeable : false, modal: true, width:400, height:'auto'});
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
                $("#dialog-comment-edit").dialog({ autoOpen : true, draggable : false, dialogClass : 'close', resizeable : false, modal: true, width:500, height:'auto'});
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
            formWrite.find('[required="required"]').each(function(){
                if($(this).val().length<=0) {
                    var el_title = $(this).data('title');
                    alert('['+el_title+'] 항목은 필수로 입력하셔야 합니다.');
                    $(this).focus();
                    e.preventDefault();
                    return false;
                }
            });
            if(tinymce.activeEditor.getContent({format:'text'}).trim().length<=0){
                alert('글 내용을 입력하셔야합니다.');
                tinymce.activeEditor.focus();
                e.preventDefault();
                return false;
            }
            if( formWrite.find('#agree_privacy').length > 0 )
            {
                if(! formWrite.find('#agree_privacy').prop("checked") )
                {
                    alert('개인정보 취급방침에 동의하셔야 합니다.');
                    e.preventDefault();
                    return false;
                }
            }

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
