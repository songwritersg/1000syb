<?=form_open(NULL,array("id"=>"form-comment-edit","autocomplete"=>"off"))?>
<input type="hidden" name="cmt_idx" value="<?=$cmt_idx?>">
<input type="text" class="fake-input">
<input type="password" class="fake-input">
<fieldset>
    <legend>댓글 수정하기</legend>
    <div class="form-group margin-top-10">
        <textarea class="form-control" name="comment_content" rows="5"><?=$comment['cmt_content']?></textarea>
    </div>
    <div class="form-group margin-top-10">
        <input type="text" class="form-control" name="comment_user" value="<?=$comment['usr_name']?>" placeholder="작성자 이름을 입력하세요">
        <input type="password" name="comment_password" class="form-control" placeholder="비밀번호를 입력하세요">
    </div>
    <div class="text-center margin-top-20">
        <button type="submit" class="btn btn-dark">댓글 수정하기</button>
        <button type="button" class="btn btn-default" onclick="$('#dialog-comment-edit').dialog('close');">닫기</button>
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
                data : $cmtForm.serialize(),
                success: function(res){
                    alert('댓글이 수정되었습니다.');
                    location.reload();
                }
            })
        });
    });
</script>
