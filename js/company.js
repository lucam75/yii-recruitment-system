$(document).ready(function(){
	$("#buttonReject").on("click",function(){
    	$(".reject").show();
    	$(".pending").hide();
    	$(".call").hide();
    	$("#buttonOKModal").attr("name","reject");
    	$("#view-modal").modal("show");
	});
	$("#buttonPending").on("click",function(){
		$(".pending").show();
    	$(".reject").hide();
    	$(".call").hide();
    	$("#buttonOKModal").attr("name","pending");
    	$("#view-modal").modal("show");
	});
	$("#buttonCall").on("click",function(){
		$(".call").show();
    	$(".reject").hide();
    	$(".pending").hide();
    	$("#buttonOKModal").attr("name","call");
    	$("#view-modal").modal("show");
	});

	$("#buttonOKModal").on("click",function(){
		var name = $(this).attr("name");
		$.post("ManageResume",{action:name},function(data){
			$("#buttonOKModal").hide();
			if(data == "success"){
				$(".modal-title").html("Success");
				$(".modal-body").html("Status changed and applicant notified.");
			}else{
				$(".modal-title").html("Error");
				$(".modal-body").html(data);
			}
			$('#view-modal').on('hidden.bs.modal', function () {
    			location.href='index';
			})
		});
	});


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
});