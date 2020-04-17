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
    var valid = true;
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

function validarmarcaalta()
{
    valid = true;
	
	$("#errorpass").hide("slow");
	if (document.forminsert.strMarca.value == ""){
		$("#errormarca").show("slow");
	    valid = false;
	}
	
	$("#errororden").hide("slow");
	if (document.forminsert.intOrden.value == ""){
		$("#errororden").show("slow");
	    valid = false;
	}
	
	return valid;
}

function CodificarSEO(url)
{
  var encodedUrl = url.toString().toLowerCase(); 
  
  encodedUrl = encodedUrl.replace(/Ã¡/g, "a");
  encodedUrl = encodedUrl.replace(/Ã©/g, "e");
  encodedUrl = encodedUrl.replace(/Ã­/g, "i");
  encodedUrl = encodedUrl.replace(/Ã³/g, "o");
  encodedUrl = encodedUrl.replace(/Ãº/g, "u");
  encodedUrl = encodedUrl.replace(/Ã±/g, "n");
  encodedUrl = encodedUrl.replace(/,/g, "-");

  encodedUrl = encodedUrl.split(/\&+/).join("-")
  encodedUrl = encodedUrl.split(/[^a-z0-9]/).join("-");       
  encodedUrl = encodedUrl.split(/-+/).join("-");
  encodedUrl = encodedUrl.trim('-'); 

  return encodedUrl; 
}