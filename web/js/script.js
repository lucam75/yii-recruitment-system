$(document).ready(function(){
	$(".NAVIGABLE").on("click",function(){

		var to = $(this).val();

		if(to == "toStep1"){
			toStep(1);
		}else if(to == "toStep2"){
			toStep(2);
		}else if(to == "toStep3"){
			toStep(3);
		}else if(to == "toStep4"){
			toStep(4);
		}else if(to == "toStepSummary"){
			toSummary();
		}
	});
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
		
	});

	$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
		console.log("beforeInsert");
	});
	
	$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
		console.log("afterInsert");
	});
	
	$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
		if (! confirm("Are you sure you want to delete this item?")) {
			return false;
		}
		return true;
	});
	
	$(".dynamicform_wrapper").on("afterDelete", function(e) {
		console.log("Deleted item!");
	});
	
	$(".dynamicform_wrapper").on("limitReached", function(e, item) {
		alert("Limit reached");
	});
}

function toStep(step){
	$(".divStep").not("#divStep"+step).animate({opacity:'0'},"slow");
	$(".divStep").not("#divStep"+step).hide();
	$(".no-summary-element").show();
	$("#divSummary").hide();

	//$(".form-control").removeAttr("disabled");
	$("#divStep"+step).animate({opacity:'1'},"slow");
	$("#divStep"+step).show();
}

function toSummary(){
	console.log("to summary");
	$(".divStep").show().animate({opacity:'1'},"fast");
	$(".no-summary-element").hide();
	$(".summary-element").removeClass("hidden");
	$(".summary-element").show();
	//$(".form-control").attr("disabled","disabled");
	$("#divSummary").show();
}