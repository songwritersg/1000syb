<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<article id="mailform">
    <div class="product-view-header">
        <h1><?=$product['prd_title']?></h1>
        <h3><?=$program_info['prg_title']?></h3>
    </div>

    <?=form_open()?>
    <input type="hidden" name="prd_idx" value="<?=$prd_idx?>">
    <input type="hidden" name="prg_idx" value="<?=$prg_idx?>">
    <input type="hidden" name="sca_key" value="<?=$sca_key?>">
    <input type="hidden" name="sca_parent" value="<?=$sca_parent?>">

    <div class="mail-form-container">

        <div class="form-group">
            <label class="form-group-label" for="mail_sender">보내는 사람 메일주소</label>
            <div class="input-box">
                <input type="text" class="form-control" name="mail_sender" id="mail_sender" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="mail_receiver">받는 사람 메일주소</label>
            <div class="input-box">
                <input type="text" class="form-control" name="mail_receiver" id="mail_receiver" required>
                <p class="help-block">여러사람일 경우 콤마(,)를 사용하세요</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="mail_subject">메일 제목</label>
            <div class="input-box">
                <input type="text" class="form-control" name="mail_subject" id="mail_subject" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-group-label" for="userfile">파일 첨부</label>
            <div class="input-box button-box">
                <input type="file" name="userfile" style="display:none;">
                <button type="button" class="btn btn-white" data-toggle="add-attach">파일 추가</button>
                <ul class="attach-list">

                </ul>
            </div>
        </div>

        <img class="wide-banner" src="<?=base_url("/static/images/mailform/title_sales_comment.jpg")?>">
        <div class="editor-form">
            <textarea id="sales_comment" name="sales_comment" class="tinymce"></textarea>
        </div>

        <img class="wide-banner margin-top-30" src="<?=base_url("/static/images/mailform/title_schedule.jpg")?>">
        <?php for($day=1; $day<count($program_info['schedule']); $day++) : ?>
        <table class="table table-bordered table-schedules">
            <thead>
            <tr>
                <th style="width:80px;" class="days-info"><?=$day?>일차</th>
                <th style="width:240px;border:0px"></th>
                <th style="border:0px" class="days-meal-b"><?=$program_info['schedule'][$day-1]['meal']['b']?'<img style="vertical-align:middle" src="/static/images/mailform/icon_meal_b.png">'.$program_info['schedule'][$day-1]['meal']['b']:'&nbsp;'?></th>
                <th style="border:0px" class="days-meal-l"><?=$program_info['schedule'][$day-1]['meal']['l']?'<img style="vertical-align:middle" src="/static/images/mailform/icon_meal_l.png">'.$program_info['schedule'][$day-1]['meal']['l']:'&nbsp;'?></th>
                <th style="border:0px" class="days-meal-d"><?=$program_info['schedule'][$day-1]['meal']['d']?'<img style="vertical-align:middle" src="/static/images/mailform/icon_meal_d.png">'.$program_info['schedule'][$day-1]['meal']['d']:'&nbsp;'?></th>
            </tr>
            </thead>
            <tbody class="tbody-schedule-detail">
            <?php foreach($program_info['schedule'][$day-1]['items'] as $item) : ?>
                <tr>
                    <td colspan="5"><?=$item['content']?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endfor;?>
    </div>
    <textarea name="content" class="hide"></textarea>
    <div class="text-center margin-top-30 margin-bottom-50">
        <button type="submit" class="btn btn-primary btn-lg" onclick="get_data();">메일 보내기</button>
    </div>
    <?=form_close()?>
</article>

<script>
    function get_data()
    {
        var data =[];
        $(".table-schedules").each(function(){
            var day = $(this).find('.days-info').text();
            var meal_b = $(this).find('.days-meal-b').text();
            var meal_l = $(this).find('.days-meal-l').text();
            var meal_d = $(this).find('.days-meal-d').text();
            var detail = [];

            $(this).find('.tbody-schedule-detail > tr').each(function(){
                detail.push( $(this).find('td').html() );
            });

            var tmp = {
                day: day,
                meal : {
                    b: meal_b,
                    l: meal_l,
                    d: meal_d
                },
                content : detail
            };
            data.push(tmp);
        });
        $("textarea[name='content']").val( JSON.stringify(data));
    }

    $(function(){
        $(".tinymce").each(function(){
            var editor_id = $(this).attr('id');
            if( !editor_id || $(this).prop("nodeName") != 'TEXTAREA' ) return true;
            tinymce.init({
                selector:'textarea#'+editor_id,
                height : 300,
                width : '618px',
                theme_advanced_resizing: true,
                theme_advanced_resizing_use_cookie : false,
                menubar : false,
                plugins : 'advlist autolink link image imagetools media lists print preview emoticons table textcolor colorpicker code pagebreak jsplus_easy_image',
                language: "ko",
                toolbar1: 'jsplus_easy_image image media table | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | link pagebreak',
                toolbar2: 'formatselect fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough removeformat',
                font_formats : "나눔고딕=Nanum Gothic;돋움=돋움,Dotum;굴림=굴림,Gulim;바탕=바탕,Batang;궁서=궁서;Arial=Arial;Comic Sans MS=Comic Sans MS;Courier New=Courier New;Tahoma=Tahoma;Times New Roman=Times New Roman;Verdana=Verdana",
                fontsize_formats : "10px 11px 12px 14px 16px 18px 20px 24px 28px",
            });
        });

        $("[data-toggle='add-attach']").on('click', function(){
            $("input[type='file']").click().off('change.attach_selected').on('change.attach_selected', function(){
                if( ! $(this).val() ) return;
                if( ! confirm('선택한 파일을 첨부하시겠습니까?') ) return false;
                var formData = new FormData();
                formData.append('userfile', $(this)[0].files[0]);
                $.ajax({
                    url : '/api/products/attach',
                    type : 'POST',
                    processData : false,
                    contentType : false,
                    data:formData,
                    fail:function(){
                        alert('파일 업로드에 실패하였습니다.');
                    },
                    success:function(res) {
                        if( res.status == true )
                        {
                            var li = $("<li>");
                            var input = $("<input>").attr({'type' : 'hidden','name' : 'attach_list[]','value' : res.result.full_path});
                            var input2 = $("<input>").attr({'type' : 'hidden','name' : 'attach_name[]','value' : res.result.orig_name});
                            var a = $("<a>").attr({
                                'href' : 'javascript:;',
                                'data-toggle' : 'remove-attach',
                                'data-value' : res.result.full_path
                            }).addClass("text-color-red").html('&times;');
                            li.text(res.result.orig_name).append(input2).append(input).append(a);
                            $(".attach-list").append(li);

                            $("a[data-toggle='remove-attach']").off('click.remove_attach').on('click.remove_attach', function(){
                                var path = $(this).data('value');
                                var _this = $(this);
                                $.ajax({
                                    url : '/api/products/attach',
                                    type : 'DELETE',
                                    beforeSend: function(xhr){ xhr.setRequestHeader("Content-Type", "application/json"); },
                                    data : {
                                        path : path
                                    },
                                    success:function() {
                                        _this.parent().remove();
                                    }
                                });
                            });
                        }
                        else {
                            alert('파일 업로드 도중 오류가 발생하였습니다.\n' + res.result);
                        }
                    }
                })
            });
        });
    });
</script>