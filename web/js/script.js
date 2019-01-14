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
	//readValuesFromLocalStorage(2);
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
	//storeAddedRecords();
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
	console.log("to summary");
	$(".no-summary-element").hide();
	$(".summary-element").removeClass("hidden");
	$(".form-control").attr("disabled","disabled");
	$("#divSummary").show();
	$("#divStep1").animate({opacity:'1'},"fast");
	$("#divStep1").show();
	/*$("#divStep2").animate({opacity:'1'},"fast");
	$("#divStep2").show();
	$("#divStep3").animate({opacity:'1'},"fast");
	$("#divStep3").show();
	$("#divStep4").animate({opacity:'1'},"fast");
	$("#divStep4").show();
	$("#divStep5").animate({opacity:'1'},"fast");
	$("#divStep5").show();*/
}