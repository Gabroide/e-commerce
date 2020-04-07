<?php require_once('Connections/conexion.php'); ?>
<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$variable_Consulta = "0";
if (isset($VARIABLE)) {
  $variable_Consulta = $VARIABLE;
}

$resultadosporclick=6;


	$query_DatosConsulta = sprintf("SELECT refProducto FROM tbldeseo WHERE refUsuario=%s", GetSQLValueString($_SESSION['tienda2020Front_UserId'], "int"));
	$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
	$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
	$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

//FINAL DE LA PARTE SUPERIOR
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
						<h2 class="title text-center">Lista de Deseos</h2>
						
						<?php 
		//AQUI ES DONDE SE SACAN LOS DATOS, SE COMPRUEBA QUE HAY RESULTADOS
		if ($totalRows_DatosConsulta > 0) {  
			 do { 
				 ?>
				 <div class="col-sm-4" id="deseomostrado<?php echo $row_DatosConsulta["refProducto"];?>">
					<?php ShowProduct($row_DatosConsulta["refProducto"], 1); ?>			
				</div>
				 
				 <?php
			
                  
              		 } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta));
				
		} 
		else
		 { //MOSTRAR SI NO HAY RESULTADOS ?>
                No has generado una lista de Deseos.
                <?php } ?>

								
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