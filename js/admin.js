$(document).ready(function(){

$('#reportrange').daterangepicker(
    {
      ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
         'Last 7 days': [moment().subtract('days', 6), moment()],
         'Last 30 days': [moment().subtract('days', 29), moment()],
         'This month': [moment().startOf('month'), moment().endOf('month')],
         'Last month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
         'This Year': [moment().startOf('year'), moment().endOf('year')],
         'Last Year': [moment().subtract('year', 1).startOf('year'), moment().subtract('year', 1).endOf('year')]
      },
      startDate: moment().subtract('days', 29),
      endDate: moment()
    },
    function(start, end) {
        $('#range').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

    }
	);

    $("#divTemplate").find(".openModal").on("click",function(){
        var id = $(this).attr("id");
        $.post("CKEditor",{idStatusResume:id},function(data){
            $(".modal-body").html(data);
            $("#template-modal").find(".idStatus").attr("idStatus",id);
            $("#template-modal").modal("show");
        });
    });
    $('#template-modal').on('hidden.bs.modal', function () {
        CKEDITOR.instances['Statusresumes[templateEmail]'].destroy(true);
    });
    $("#buttonOKModal").on("click",function(){
        var id = $("#template-modal").find(".idStatus").attr("idStatus");
        var template = CKEDITOR.instances['Statusresumes[templateEmail]'].getData();
        $.post("SaveTemplate",{idStatusResume:id,Template:template},function(data){
            $("#buttonOKModal").hide();
            if(data == "success"){
                $(".modal-title").html("Success");
                $(".modal-body").html("Template modified");
            }else{
                $(".modal-title").html("Error");
                $(".modal-body").html(data);
            }
            $('#template-modal').on('hidden.bs.modal', function () {
                location.href='Templates';
            });
        });
    });

});