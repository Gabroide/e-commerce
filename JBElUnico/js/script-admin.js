 // JavaScript Document
function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )
        return false;
else return true;
}

function validarusuarioalta()
{
    valid = true;
	$("#erroremail").hide("slow");
	if (document.forminsert.strEmail.value == ""){
		$("#erroremail").show("slow");
	    valid = false;
	}
	
	$("#wrongemail").hide("slow");
	if (!validarEmail(document.forminsert.strEmail.value)){
		$("#wrongemail").show("slow");
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

function validarcategoriaalta()
{
    valid = true;
	
	$("#errororden").hide("slow");
	if (document.forminsert.intOrden.value == ""){
		$("#errororden").show("slow");
	    valid = false;
	}
	$("#errornombre").hide("slow");
	if (document.forminsert.strNombre.value == ""){
		$("#errornombre").show("slow");
	    valid = false;
	}
	return valid;
}

function validaraccesoadmin()
{
    valid = true;
	$("#erroremail").hide("slow");
	if (document.formaccess.strEmail.value == ""){
		$("#erroremail").show("slow");
	    valid = false;
	}
	
	$("#wrongemail").hide("slow");
	if (!validarEmail(document.formacess.strEmail.value)){
		$("#wrongemail").show("slow");
	    valid = false;
	}
	
	$("#errorpass").hide("slow");
	if (document.formacess.strPassword.value == ""){
		$("#errorpass").show("slow");
	    valid = false;
	}
	
	return valid;
}