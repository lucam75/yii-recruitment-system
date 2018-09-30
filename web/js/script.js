$(document).ready(function(){
	$(".NAVIGABLE").on("click",function(){

		var to = $(this).val();

		if(to == "toStep1"){
			toStep1();
		}else if(to == "toStep2"){
			toStep2();
		}else if(to == "toStep3"){
			toStep3();
		}else if(to == "toStep4"){
			toStep4();
		}else if(to == "toSummary"){
			toSummary();
		}
	});

	// $("#liStep1").on("click",function(){
	// 	toStep1();
	// });
	// $("#liStep2").on("click",function(){
	// 	toStep2();
	// });
	// $("#liStep3").on("click",function(){
	// 	toStep3();
	// });
	// $("#liStep4").on("click",function(){
	// 	toStep4();
	// });
	// $("#liStepSummary").on("click",function(){
	// 	toSummary();
	// });

	// $("#divStep2").each(function(){
	// 	divStep2();
	// });
	// $("#divStep3").each(function(){
	// 	divStep3();
	// });
	// $("#divStep4").each(function(){
	// 	divStep4();
	// });

	// $("#SendResume").on("click",function(){
	// 	$("#buttonOKModal").show();
	// 	$("#modalSummary").find(".modal-title").html("Send resume");
	// 	$("#modalSummary").find(".modal-body").html('Your resume be sent to recruitment team, are you sure?');
    // 	$("#modalSummary").modal("show");
    // 	// $("#document-form").submit();
	// });
	// $("#buttonOKModal").on("click",function(){
	// 	$("#modalSummary").modal("hide");
	// 	$(".form-control").removeAttr("disabled");

	// 	// $.post("Send",$("#resume-form").serialize(),function(data){
	// 	$('#resume-form').ajaxSubmit({
	// 		url:'Send',
	// 		type: 'POST',
	// 		success: function(data){
	// 			$("#buttonOKModal").hide();
	// 			var answer = data.split("//");

	// 			if(answer[0] == "success"){
	// 				var id = answer[1];
	// 				$('#document-form').ajaxSubmit({
	// 	                url:'SaveFiles',
	// 	                type: 'POST',
	// 	                data:{idResume:id},
	// 	                success: function(){
	// 	                	location.href='Done';
	// 	     //            	response = response.replace(/\s*[\r\n][\r\n \t]*/g, "");
	// 	     //            	if(response == "yes."){
	// 	     //            	$("#modalSummary").find(".modal-title").html("Resume sent successfully");
	// 						// $("#modalSummary").find(".modal-body").html('<i class="fa fa-check-square fa-4x" style="color:#3fb618;"></i>');
	// 						//     $('#modalSummary').on('hidden.bs.modal', function () {
	// 						//     	location.href='../index';
	//    			// 				 });
	// 						// }else{
	// 						// 	$("#modalSummary").find(".modal-title").html("Some errors occurred");
	// 						// 	$("#modalSummary").find(".modal-body").html('<i class="fa fa-exclamation-triangle fa-4x danger" style="color:##ff0039;"></i>'+response);
	// 						// 	$("#modalSummary").modal("show");
	// 						// }
	// 	                }
	//            	 	});
	// 			}else{
	// 				$("#modalSummary").find(".modal-title").html("Some errors occurred");
	// 				$("#modalSummary").find(".modal-body").html('<i class="fa fa-exclamation-triangle fa-4x danger" style="color:##ff0039;"></i>'+data);
	// 				$("#modalSummary").modal("show");
	// 			    $('#modalSummary').on('hidden.bs.modal', function () {
	// 		    		$('#resume-form').submit();
	// 				 });
	// 			}
	// 		}
	// 	});
	// });//click

	// Migrated
	AddSectionsHandler();

});

function AddSectionsHandler(){
	var sectionsMap = new Array();
	sectionsMap['experience'] = 1;
	sectionsMap['achievements'] = 2;
	sectionsMap['hobbies'] = 3;
	sectionsMap['interests'] = 4;
	sectionsMap['references'] = 5;

	$(".open-sections-modal").on("click", function() {
		var sectionName = $(this).data('section-name');
		var modalId = $(this).data('target');
		var modalTitle = $(this).data('modal-title');

		$(modalId).find("#add-section-form input#sections-typesection_idtypesection").val(sectionsMap[sectionName]);
		$(modalId).find("h4.modal-title").html(modalTitle);

		$(modalId).find("#buttonOKModal").on("click", function(){
			var form = $(modalId).find("form#add-section-form");
			if(formIsValid(form)){
				form.find("input[name='_csrf']").remove();
				console.log("The form is valid");
				//console.log(form.serialize());
				if (typeof(Storage) !== "undefined") {
					var sections = localStorage.getItem("sections");
					console.log(sections);
					if(sections == null){
						sections = new Array();
					}else{
						sections = "["+localStorage.getItem("sections")+"]";
					}
					console.log("Sections");
					console.log(sections);
					console.log("Stringify");
					console.log(JSON.stringify(form.serialize()));
					sections.push(JSON.stringify(form.serialize()));
					localStorage.setItem("sections", sections);
					
				}
			}else{
				console.log("The form is not valid");
			}
		});

	});
}

function toStep1(){
	$("#divStep2").animate({opacity:'0'},"slow");
	$("#divStep2").hide();
	$("#divStep3").animate({opacity:'0'},"slow");
	$("#divStep3").hide();
	$("#divStep4").animate({opacity:'0'},"slow");
	$("#divStep4").hide();
	$("#divStep5").animate({opacity:'0'},"slow");
	$("#divStep5").hide();
	$(".noSummary").show();
	$("#divSummary").hide();

	$(".form-control").removeAttr("disabled");
	$("#divStep1").animate({opacity:'1'},"slow");
	$("#divStep1").show();
}
function toStep2(){
	$("#divStep1").animate({opacity:'0'},"slow");
	$("#divStep1").hide();
	$("#divStep3").animate({opacity:'0'},"slow");
	$("#divStep3").hide();
	$("#divStep4").animate({opacity:'0'},"slow");
	$("#divStep4").hide();
	$("#divStep5").animate({opacity:'0'},"slow");
	$("#divStep5").hide();
	$(".noSummary").show();
	$("#divSummary").hide();

	$("#divStep2").animate({opacity:'1'},"slow");
	$("#divStep2").show();
}
function toStep3(){
	$("#divStep1").animate({opacity:'0'},"slow");
	$("#divStep1").hide();
	$("#divStep2").animate({opacity:'0'},"slow");
	$("#divStep2").hide();
	$("#divStep4").animate({opacity:'0'},"slow");
	$("#divStep4").hide();
	$("#divStep5").animate({opacity:'0'},"slow");
	$("#divStep5").hide();
	$(".noSummary").show();
	$("#divSummary").hide();

	$("#divStep3").animate({opacity:'1'},"slow");
	$("#divStep3").show();
}
function toStep4(){
	$("#divStep1").animate({opacity:'0'},"slow");
	$("#divStep1").hide();
	$("#divStep2").animate({opacity:'0'},"slow");
	$("#divStep2").hide();
	$("#divStep3").animate({opacity:'0'},"slow");
	$("#divStep3").hide();
	$("#divStep5").animate({opacity:'0'},"slow");
	$("#divStep5").hide();
	$(".noSummary").show();
	$("#divSummary").hide();

	$("#divStep4").animate({opacity:'1'},"slow");
	$("#divStep4").show();
}
function toSummary(){

	$(".noSummary").hide();
	$(".form-control").attr("disabled","disabled");
	$("#divSummary").show();
	$("#divStep1").animate({opacity:'1'},"fast");
	$("#divStep1").show();
	$("#divStep2").animate({opacity:'1'},"fast");
	$("#divStep2").show();
	$("#divStep3").animate({opacity:'1'},"fast");
	$("#divStep3").show();
	$("#divStep4").animate({opacity:'1'},"fast");
	$("#divStep4").show();
	$("#divStep5").animate({opacity:'1'},"fast");
	$("#divStep5").show();
}

function formIsValid(form) {
	var data = form.data('yiiActiveForm');
	data.submitting = true;
	data.shouldSubmit = false;
	// form.on('afterValidate', handler);
	form.on('beforeSubmit', function () {
			  var data = form.data('yiiActiveForm');
			  if (!data.shouldSubmit) {
					data.shouldSubmit = true;
					return false;
			  }
	});
	form.yiiActiveForm('validate', false);

	return form.find(".has-error").length > 0 ? false:true;
};