$(document).ready(function(){

    $("a.edit-template").on("click", function(){
        var panelParent = $(this).parents(".panel-default");
        panelParent.find(".read-only").toggleClass("hidden")
        panelParent.find(".div-ckeditor").toggleClass("hidden");
    });

    $('#template-modal').on('hidden.bs.modal', function () {
        CKEDITOR.instances['Statusresumes[templateEmail]'].destroy(true);
    });
});