$(document).ready(function(){

    $("a.edit-template").on("click", function(){
        var panelParent = $(this).parents(".panel-default");
        panelParent.find(".read-only").toggleClass("hidden")
        panelParent.find(".div-ckeditor").toggleClass("hidden");
    });

    $('#template-modal').on('hidden.bs.modal', function () {
        CKEDITOR.instances['Statusresumes[templateEmail]'].destroy(true);
    });

    // $("#buttonOKModal").on("click",function(){
    //     var id = $("#template-modal").find(".idStatus").attr("idStatus");
    //     var template = CKEDITOR.instances['Statusresumes[templateEmail]'].getData();
    //     $.post("SaveTemplate",{idStatusResume:id,Template:template},function(data){
    //         $("#buttonOKModal").hide();
    //         if(data == "success"){
    //             $(".modal-title").html("Success");
    //             $(".modal-body").html("Template modified");
    //         }else{
    //             $(".modal-title").html("Error");
    //             $(".modal-body").html(data);
    //         }
    //         $('#template-modal').on('hidden.bs.modal', function () {
    //             location.href='Templates';
    //         });
    //     });
    // });
});