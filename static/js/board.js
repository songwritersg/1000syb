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
                'name' : 'userfile[]',
                'accept' : 'image/*'
            }).addClass("form-control input-md");
            $(target).append(input);
        });
});