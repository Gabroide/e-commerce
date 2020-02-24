// JavaScript Document
function validarusuarioalta()
{
    valid = true;
	$("#erroremail").hide("slow");
	if (document.forminsert.strEmail.value == ""){
		$("#erroremail").show("slow");
	    valid = false;
	}
	return valid;
}