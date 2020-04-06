<?php require_once('Connections/conexion.php'); ?>

<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- InstanceBeginEditable name="doctitle" -->
    <title>Home | E-Shopper</title>
    <meta name="description" content="">
    <meta name="author" content="">
<!-- InstanceEndEditable -->
    <?php include("includes/head.php"); ?>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head><!--/head-->

<body>
<!-- InstanceBeginEditable name="contenido" -->
<?php include("includes/header.php"); ?>
<?php //include("includes/slider.php"); ?>
<section>
  <div class="container">
  	<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Acceder a tu cuenta</h2>
						<form action="acceso.php" method="post">
							<label for="strEmail">Correo Electrónico</label>
							<input type="mail" placeholder="micorreo@correo.com" id="strEmail" name="strEmail"/>
							<label for="strPassword">Contraseña</label>
							<input type="password" placeholder="Contraseña" id="strPassword" name="strPassword"/>
							<span>
								<input type="checkbox" class="checkbox"> 
								No cerrar la sesión
							</span>
							<button type="submit" class="btn btn-default">Acceder</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Ó</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Registrarse</h2>
						<form action="#">
							<label for="newmail">Correo Electrónico</label>
							<input type="text" placeholder="Name" />
							<input type="email" placeholder="Email Address"/>
							<input type="password" placeholder="Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
							<br>
							<br>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
  </div>
</section>
<?php include("includes/footer.php"); ?>
<?php include("includes/footerjs.php"); ?>
<script type="text/javascript" src="js/jquery.mlens-1.6.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
    $("#placeholder").mlens(
    {
        imgSrc: $("#placeholder").attr("data-big"),   // path of the hi-res version of the image
        lensShape: "circle",                // shape of the lens (circle/square)
        lensSize: 180,                  // size of the lens (in px)
        borderSize: 4,                  // size of the lens border (in px)
        borderColor: "#fff",                // color of the lens border (#hex)
        borderRadius: 0,                // border radius (optional, only if the shape is square)
		responsive: true      
    });
});

</script>
<script type="text/javascript" language="javascript">
function showPic (whichpic) {
 if (document.getElementById) {
  document.getElementById('placeholder').src = whichpic.href;
	 document.getElementById('placeholder').setAttribute("data-big", whichpic.href);
	 
	  $("#placeholder").mlens(
    {
        imgSrc: $("#placeholder").attr("data-big"),   // path of the hi-res version of the image
        lensShape: "circle",                // shape of the lens (circle/square)
        lensSize: 180,                  // size of the lens (in px)
        borderSize: 4,                  // size of the lens border (in px)
        borderColor: "#fff",                // color of the lens border (#hex)
        borderRadius: 0,                // border radius (optional, only if the shape is square)
		responsive: true      
    });
	 
	 
	 //$("#placeholder").attr("data-big") = whichpic.href;
  return false;
 } else {
  return true;
 }
}
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html> 
<?php
//AÃ‘ADIR AL FINAL DE LA PÃGINA
mysqli_free_result($DatosConsulta);
?>