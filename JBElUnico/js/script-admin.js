 // JavaScript Document
function validarusuarioalta()
{
    valid = true;
	$("#erroremail").hide("slow");
	if (document.forminsert.strEmail.value == ""){
		$("#erroremail").show("slow");
	    valid = false;
	}
	$("#errorpass").hide("slow");
	if (document.forminsert.strPassword.value == ""){
		$("#errorpass").show("slow");
	    valid = false;
	}
	$("#errornombre").hide("slow");
	if (document.forminsert.strNombre.value == ""){
		$("#errornombre").show("slow");
	    valid = false;
	}
	return valid;
}

function validarusuarioeditar()
{
    valid = true;
	$("#erroremail").hide("slow");
	if (document.forminsert.strEmail.value == ""){
		$("#erroremail").show("slow");
	    valid = false;
	}
	$("#errornombre").hide("slow");
	if (document.forminsert.strNombre.value == ""){
		$("#errornombre").show("slow");
	    valid = false;
	}
	return valid;
}