$(document).ready(function(){
	$(".NAVIGABLE").on("click",function(){

		var to = $(this).attr("to");

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

	$("#liStep1").on("click",function(){
		toStep1();
	});
	$("#liStep2").on("click",function(){
		toStep2();
	});
	$("#liStep3").on("click",function(){
		toStep3();
	});
	$("#liStep4").on("click",function(){
		toStep4();
	});
	$("#liStepSummary").on("click",function(){
		toSummary();
	});

	$("#divStep2").each(function(){
		divStep2();
	});
	$("#divStep3").each(function(){
		divStep3();
	});
	$("#divStep4").each(function(){
		divStep4();
	});

	$("#SendResume").on("click",function(){
		$("#buttonOKModal").show();
		$("#modalSummary").find(".modal-title").html("Send resume");
		$("#modalSummary").find(".modal-body").html('Your resume be sent to recruitment team, are you sure?');
    	$("#modalSummary").modal("show");
    	// $("#document-form").submit();
	});
	$("#buttonOKModal").on("click",function(){
		$("#modalSummary").modal("hide");
		$(".form-control").removeAttr("disabled");

		// $.post("Send",$("#resume-form").serialize(),function(data){
		$('#resume-form').ajaxSubmit({
			url:'Send',
			type: 'POST',
			success: function(data){
				$("#buttonOKModal").hide();
				var answer = data.split("//");

				if(answer[0] == "success"){
					var id = answer[1];
					$('#document-form').ajaxSubmit({
		                url:'SaveFiles',
		                type: 'POST',
		                data:{idResume:id},
		                success: function(){
		                	location.href='Done';
		     //            	response = response.replace(/\s*[\r\n][\r\n \t]*/g, "");
		     //            	if(response == "yes."){
		     //            	$("#modalSummary").find(".modal-title").html("Resume sent successfully");
							// $("#modalSummary").find(".modal-body").html('<i class="fa fa-check-square fa-4x" style="color:#3fb618;"></i>');
							//     $('#modalSummary').on('hidden.bs.modal', function () {
							//     	location.href='../index';
	   			// 				 });
							// }else{
							// 	$("#modalSummary").find(".modal-title").html("Some errors occurred");
							// 	$("#modalSummary").find(".modal-body").html('<i class="fa fa-exclamation-triangle fa-4x danger" style="color:##ff0039;"></i>'+response);
							// 	$("#modalSummary").modal("show");
							// }
		                }
	           	 	});
				}else{
					$("#modalSummary").find(".modal-title").html("Some errors occurred");
					$("#modalSummary").find(".modal-body").html('<i class="fa fa-exclamation-triangle fa-4x danger" style="color:##ff0039;"></i>'+data);
					$("#modalSummary").modal("show");
				    $('#modalSummary').on('hidden.bs.modal', function () {
			    		$('#resume-form').submit();
					 });
				}
			}
		});
	});//click

});
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
function divStep2(){
	$("#linkAddNewEducation").on("click",function(){
		$.post("FormEducation",function(data, textStatus, xhr) {
			$("#demo_modal").find(".modal-title").html("Add a new education record");
			$("#demo_modal").find(".modal-body").html(data);
			$("#buttonAddModal").attr("name","Education");
        	$("#demo_modal").modal("show");
		});
	});
	$("#linkAddNewExperience").on("click",function(){
		$.post("FormSection",{type:'1'},function(data, textStatus, xhr) {
			$("#demo_modal").find(".modal-title").html("Add a new experience record");
			$("#demo_modal").find(".modal-body").html(data);
			$("#buttonAddModal").attr("name","Experience");
        	$("#demo_modal").modal("show");
		});
	});

	$("#buttonAddModal").on("click",function(){
	    if($(this).attr("name") == "Education"){
			if($("#demo_modal").find(".modal-body").find(".has-success").length == 4){
				$.post("AdminEducation",$("#education-form").serialize(),function(data){
					$("#listEducation").html(data);
					$('#demo_modal').modal('hide');
				});
			}else{
				$("#education-form").submit();
			}
	    }else if($(this).attr("name") == "Experience"){
			if($("#demo_modal").find(".modal-body").find(".has-success").length == 2){
				$.post("AdminSection",($("#experience-form").serialize()+'&'+$.param({ 'Session': 'Experiences' })),function(data){
					$("#listExperience").html(data);
					$('#demo_modal').modal('hide');
				});
			}else{
				$("#experience-form").submit();
			}
	    }
  	});

	$("#listEducation").on("click","button[name='deleteItem']",function(){
		$.post("AdminEducation",{"idEducation":$(this).attr("idEducation")},function(data){
			$("#listEducation").html(data);
	    });
	});
	$("#listExperience").on("click","button[name='deleteItem']",function(){
		$.post("AdminSection",{"idSection":$(this).attr("idSection"),Session:'Experiences'},function(data){
			$("#listExperience").html(data);
	    });
	});

}//end step2

function divStep3(){
	$("#linkAddNewAchievement").on("click",function(){
		$.post("FormSection",{'type':'2'},function(data, textStatus, xhr) {
			$("#demo_modal").find(".modal-title").html("Add a achievement");
			$("#demo_modal").find(".modal-body").html(data);
			$("#buttonAddModal").attr("name","Achievement");
        	$("#demo_modal").modal("show");
		});
	});
	$("#linkAddNewHobby").on("click",function(){
		$.post("FormSection",{'type':'3'},function(data, textStatus, xhr) {
			$("#demo_modal").find(".modal-title").html("Add a hobby");
			$("#demo_modal").find(".modal-body").html(data);
			$("#buttonAddModal").attr("name","Hobby");
        	$("#demo_modal").modal("show");
		});
	});

	$("#buttonAddModal").on("click",function(){
	    if($(this).attr("name") == "Achievement"){
			if($("#demo_modal").find(".modal-body").find(".has-success").length == 2){
				$.post("AdminSection",($("#achievement-form").serialize()+'&'+$.param({ 'Session': 'Achievements' })),function(data){
				   $("#listAchievements").html(data);
				});
				$('#demo_modal').modal('hide');
			}else{
				$("#achievement-form").submit();
			}
	     }else if($(this).attr("name") == "Hobby"){
			if($("#demo_modal").find(".modal-body").find(".has-success").length == 2){
				$.post("AdminSection",($("#hobby-form").serialize()+'&'+$.param({ 'Session': 'Hobbies' })),function(data){
				   $("#listHobbies").html(data);
				});
				$('#demo_modal').modal('hide');
			}else{
				$("#hobby-form").submit();
			}
	    }
  	});

	$("#listAchievements").on("click","button[name='deleteItem']",function(){
		$.post("AdminSection",{"idSection":$(this).attr("idSection"),Session:'Achievements'},function(data){
			$("#listAchievements").html(data);
	    });
	});

	$("#listHobbies").on("click","button[name='deleteItem']",function(){
		$.post("AdminSection",{"idSection":$(this).attr("idSection"),Session:'Hobbies'},function(data){
			$("#listHobbies").html(data);
	    });
	});
}//end step3

function divStep4(){
	$("#linkAddNewInterest").on("click",function(){
		$.post("FormSection",{'type':'4'},function(data, textStatus, xhr) {
			$("#demo_modal").find(".modal-title").html("Add a personal interest");
			$("#demo_modal").find(".modal-body").html(data);
			$("#buttonAddModal").attr("name","Interest");
        	$("#demo_modal").modal("show");
		});
	});
	$("#linkAddNewReference").on("click",function(){
		$.post("FormSection",{'type':'5'},function(data, textStatus, xhr) {
			$("#demo_modal").find(".modal-title").html("Add a personal reference");
			$("#demo_modal").find(".modal-body").html(data);
			$("#buttonAddModal").attr("name","Reference");
        	$("#demo_modal").modal("show");
		});
	});

	$("#buttonAddModal").on("click",function(){
	    if($(this).attr("name") == "Interest"){
			if($("#demo_modal").find(".modal-body").find(".has-success").length == 2){
				$.post("AdminSection",($("#interest-form").serialize()+'&'+$.param({ 'Session': 'Interests' })),function(data){
				   $("#listInterests").html(data);
				});
				$('#demo_modal').modal('hide');
			}else{
				$("#interest-form").submit();
			}
	     }else if($(this).attr("name") == "Reference"){
			if($("#demo_modal").find(".modal-body").find(".has-success").length == 2){
				$.post("AdminSection",($("#reference-form").serialize()+'&'+$.param({ 'Session': 'References' })),function(data){
				   $("#listReferences").html(data);
				});
				$('#demo_modal').modal('hide');
			}else{
				$("#reference-form").submit();
			}
	    }
  	});

	$("#listInterests").on("click","button[name='deleteItem']",function(){
		$.post("AdminSection",{"idSection":$(this).attr("idSection"),Session:'Interests'},function(data){
			$("#listInterests").html(data);
	    });
	});

	$("#listReferences").on("click","button[name='deleteItem']",function(){
		$.post("AdminSection",{"idSection":$(this).attr("idSection"),Session:'References'},function(data){
			$("#listReferences").html(data);
	    });
	});

}//end step4