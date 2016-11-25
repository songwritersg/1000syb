$(function(){

    $(document).on('click', '[data-toggle="add-schedule-table"]', function(e){
        var new_table = $("#tmpl-new-table").tmpl();
        new_table.insertBefore( $(this).parent() );
        tinymce.init({
            selector : '.tbody-schedule-detail .content',
            inline: true,
            menubar: false,
            plugins: 'link image textcolor colorpicker',
            toolbar1 : 'bold link | forecolor backcolor'
        });
    });

    $(document).on('click', '[data-toggle="remove-schedule-table"]', function(e){
        if(! confirm('해당 일차를 삭제하시겠습니까?')) return false;
        $(this).parent().parent().parent().parent().prev().remove();
        $(this).parent().parent().parent().parent().remove();
    });

    $(document).on('click', 'a.editable', function(e){
        e.preventDefault();
        var $this = $(this);
        var result = prompt("변경할 텍스트를 입력하세요", $this.text());
        if(result)
        {
            $this.text(result);
        }
    });

    $(document).on('click', '[data-toggle="prepend-schedule-row"]', function(e){
        e.preventDefault();
        var new_tr = $("#tmpl-new-row").tmpl();
        new_tr.insertBefore( $(this).parent().parent().parent() );

        tinymce.init({
            selector : '.tbody-schedule-detail .content',
            inline: true,
            menubar: false,
            plugins: 'link image textcolor colorpicker',
            toolbar1 : 'bold link | forecolor backcolor'
        });
    });

    $(document).on('click', '[data-toggle="append-schedule-row"]', function(e){
        e.preventDefault();
        var new_tr = $("#tmpl-new-row").tmpl();
        new_tr.insertAfter( $(this).parent().parent().parent() );

        tinymce.init({
            selector : '.tbody-schedule-detail .content',
            inline: true,
            menubar: false,
            plugins: 'link image textcolor colorpicker',
            toolbar1 : 'bold link | forecolor backcolor'
        });
    });

    $(document).on('click', '[data-toggle="remove-schedule-row"]', function(e){
        e.preventDefault();
        if(! confirm('해당 행을 삭제하시겠습니까?')) return false;
        $(this).parent().parent().parent().remove();
    });

    tinymce.init({
        selector : '.tbody-schedule-detail .content',
        inline: true,
        menubar: false,
        plugins: 'link image textcolor colorpicker',
        toolbar1 : 'bold link | forecolor backcolor'
    });

    $(".tinymce").each(function(){
        var editor_id = $(this).attr('id');
        if( !editor_id || $(this).prop("nodeName") != 'TEXTAREA' ) return true;
        tinymce.init({
            selector: 'textarea#' + editor_id,
            height: 300,
            width: '618px',
            theme_advanced_resizing: true,
            theme_advanced_resizing_use_cookie: false,
            menubar: false,
            plugins: 'advlist autolink link image imagetools media lists print preview emoticons table textcolor colorpicker code pagebreak jsplus_easy_image',
            language: "ko",
            toolbar1: 'jsplus_easy_image image media table | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | link pagebreak',
            toolbar2: 'formatselect fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough removeformat',
            font_formats: "나눔고딕=Nanum Gothic;돋움=돋움,Dotum;굴림=굴림,Gulim;바탕=바탕,Batang;궁서=궁서;Arial=Arial;Comic Sans MS=Comic Sans MS;Courier New=Courier New;Tahoma=Tahoma;Times New Roman=Times New Roman;Verdana=Verdana",
            fontsize_formats: "10px 11px 12px 14px 16px 18px 20px 24px 28px",
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

function get_data()
{
    var data =[];
    $(".table-schedules").each(function(){
        var day = $(this).find('.days-info>.editable').text();
        var meal_b = $(this).find('.days-meal-b>.editable').text();
        var meal_l = $(this).find('.days-meal-l>.editable').text();
        var meal_d = $(this).find('.days-meal-d>.editable').text();
        meal_b = meal_b == '없음' ? '' : meal_b;
        meal_l = meal_l == '없음' ? '' : meal_l;
        meal_d = meal_d == '없음' ? '' : meal_d;

        var detail = [];

        $(this).find('.tbody-schedule-detail > tr').each(function(){
            detail.push( $(this).find('td > div.content').html() );
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