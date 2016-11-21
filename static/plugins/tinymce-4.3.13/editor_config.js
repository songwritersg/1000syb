$(document).ready(function(){
	
	$(".tinymce").each(function(){
		var editor_id = $(this).attr('id');
		var width = $(this).data('width');
		if( typeof width == 'undefined' || ! width ) {
			width = '100%';
		}
		if( !editor_id || $(this).prop("nodeName") != 'TEXTAREA' ) return true;

		tinymce.init({ 
			selector:'textarea#'+editor_id,
			height : 600,
			width : '100%',
			theme_advanced_resizing: true,
    		theme_advanced_resizing_use_cookie : false,
			menubar : false,
			plugins : 'advlist autolink link image imagetools media lists print preview emoticons table textcolor colorpicker code pagebreak jsplus_easy_image',			
			language: "ko",
			toolbar1: 'preview code | jsplus_easy_image image media table emoticons | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | link pagebreak',
			toolbar2: 'formatselect fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough removeformat',			
			font_formats : "나눔고딕=Nanum Gothic;돋움=돋움,Dotum;굴림=굴림,Gulim;바탕=바탕,Batang;궁서=궁서;Arial=Arial;Comic Sans MS=Comic Sans MS;Courier New=Courier New;Tahoma=Tahoma;Times New Roman=Times New Roman;Verdana=Verdana",
			fontsize_formats : "10px 11px 12px 14px 16px 18px 20px 24px 28px",
		});
	});
	
});
