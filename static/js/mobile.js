$(function(){
    $("[data-role='toggle-menu']").on('click',function(e){
        e.preventDefault();
        $("body").toggleClass("opened");
        $("#menuOverlay").toggle();
    });
});