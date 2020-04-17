<?php require_once('Connections/conexion.php'); ?>
<?php

	if(testuniquemail($_POST["strEmail"]))
	{

	  $insertSQL = sprintf("INSERT INTO tblusuario(strEmail, strPassword, strNombre, intNivel, intEstado) VALUES (%s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST["strEmail"], "text"),
						  GetSQLValueString(md5($_POST["strPassword"]), "text"),
						  GetSQLValueString($_POST["strNombre"], "text"),
						  0,
						  1);
						  //GetSQLValueString($_POST["intEstado"], "int"));


	  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));
	}
	else
	{
		//EL EMAIL NO ES úNICO
		$insertGoTo = "error.php?error=1";
	  	header(sprintf("Location: %s", $insertGoTo));
	}

?>
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
      <div class="col-sm-3">
        <?php include("includes/leftsidebar.php"); ?>
      </div>
      <div class="col-sm-9 padding-right">
      	
      	<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="index.php">Inicio</a></li>
			  <li>Mis Deseos</li>
			</ol>
		</div>
	  	
        <div class="features_items"><!--features_items-->
			<h2 class="title text-center">REGISTRO REALIZADO</h2>
			<p class="text-center">Su registro se ha realizadode forma satisfactoria. ¡Muchas gracias!</p>
		</div>
       
        <?php //include("includes/categories.php"); ?>
        <?php //include("includes/recomended.php"); ?>
      </div>
    </div>
  </div>
</section>
<?php include("includes/footer.php"); ?>
<?php include("includes/footerjs.php"); ?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html> 
<?php
//AÃ‘ADIR AL FINAL DE LA PÃGINA
mysqli_free_result($DatosConsulta);
?>