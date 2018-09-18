$(document).ready(function(){
	$("#buttonReject").on("click",function(){
    	$(".reject").show();
    	$(".pending").hide();
    	$(".call").hide();
    	$("#buttonOKModal").attr("name","reject");
	});
	$("#buttonPending").on("click",function(){
		$(".pending").show();
    	$(".reject").hide();
    	$(".call").hide();
    	$("#buttonOKModal").attr("name","pending");
	});
	$("#buttonCall").on("click",function(){
		$(".call").show();
    	$(".reject").hide();
    	$(".pending").hide();
    	$("#buttonOKModal").attr("name","call");
	});

	$("#buttonOKModal").on("click",function(){
		var name = $(this).attr("name");
		var idresume = $(this).parents('#view-modal').attr('data-resume-id');
		$.post("manageresume",{action:name, idresume: idresume},function(data){
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
});