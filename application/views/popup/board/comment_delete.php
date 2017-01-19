<div id="dialog-comment-delete-password">
    <?=form_open("https://www.1000syb.com/board/comment_delete",array("id"=>"form-comment-delete","autocomplete"=>"off"))?>
    <input type="hidden" name="cmt_idx" value="<?=$cmt_idx?>">
    <fieldset>
        <legend>비밀번호 입력</legend>
        <div class="form-group">
            <input type="password" name="comment_password" class="form-control" placeholder="비밀번호를 입력하세요">
        </div>
        <div class="text-center margin-top-20">
            <button type="submit" class="btn btn-dark">댓글 삭제하기</button>
            <button type="button" class="btn btn-default" onclick="$('#dialog-password').dialog('close');">닫기</button>
        </div>
    </fieldset>
    <?=form_close()?>
</div>
<script>
$(function(){
    $("#form-comment-delete").on('submit', function(e){
        e.preventDefault();
        var $cmtForm = $(this);
        var $cmt_password = $cmtForm.find('input[name="comment_password"]');
        if( $cmt_password.val().trim() == ''  )
        {
            alert('비밀번호를 입력해주세요');
            $cmt_password.focus();
            return false;
        }

        if( ! confirm('해당 댓글을 삭제하시겠습니까?') ) return false;

        $.ajax({
            url : base_url + "/api/board/comments",
            type : 'DELETE',
            data : $cmtForm.serialize(),
            async:false,
            success: function(res){
                if(res.status == true)
                {
                    alert('댓글이 삭제되었습니다.');
                    location.reload();
                }
                else {
                    alert( res.message ? res.message : '알수없는 오류가 발생하였습니다.' );
                }
            }
        })
    });
});
</script>
