<?=form_open("https://www.1000syb.com/board/comment_edit",array("id"=>"form-comment-edit","autocomplete"=>"off"))?>
<input type="hidden" name="cmt_idx" value="<?=$cmt_idx?>">
<input type="hidden" name="comment_user" value="<?=$comment['usr_name']?>">
<input type="text" class="fake-input">
<input type="password" class="fake-input">
<fieldset>
    <legend>댓글 수정하기</legend>
    <div class="form-group margin-top-10">
        <h2>댓글 수정</h2>
        <button type="button" title="닫기" class="btn-close" onclick="$('#dialog-comment-edit').dialog('close');">&times;</button>
    </div>
    <div class="form-group margin-top-10">
        <textarea class="form-control" name="comment_content" rows="5"><?=$comment['cmt_content']?></textarea>
    </div>

    <div class="margin-top-10">
        <input type="password" name="comment_password" class="form-control" placeholder="비밀번호를 입력하세요">
        <button type="submit" class="btn btn-lg btn-primary">댓글 수정하기</button>
    </div>
</fieldset>
<?=form_close()?>
<script>
    $(function(){
        $("#form-comment-edit").on('submit', function(e){
            e.preventDefault();
            var $cmtForm = $(this);
            var $cmt_user = $cmtForm.find('input[name="comment_user"]');
            var $cmt_password = $cmtForm.find('input[name="comment_password"]');
            var $cmt_content = $cmtForm.find('textarea[name="comment_content"]');
            if( $cmt_password.val().trim() == ''  )
            {
                alert('비밀번호를 입력해주세요');
                $cmt_password.focus();
                return false;
            }
            if( $cmt_user.val().trim() == '' )
            {
                alert('작성자 이름을 입력하세요');
                $cmt_user.focus();
                return false;
            }
            if( $cmt_content.val().trim() == '' )
            {
                alert('댓글 내용을 입력하세요');
                $cmt_content.focus();
                return false;
            }

            if( ! confirm('해당 댓글을 수정하시겠습니까??') ) return false;

            $.ajax({
                url : base_url + "/api/board/comments",
                type : 'POST',
                async:false,
                data : $cmtForm.serialize(),
                success: function(res){
                    if(res.status == true)
                    {
                        alert('댓글이 수정되었습니다.');
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
