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
			<div class="col-sm-12 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Muchas Gracias</h2>
						<?php if ($_GET["tipo"]==1){?>
							<div>
								<p>Muchas gracias, se te ha enviado un correo electrónico con la confirmación y nuestros datos bancarioas. Su pedido no será tramitado hasta que no nos llegue la orden de transferencia bancara.</p>
								<p>Si tiene alguna duda contacte con nosotros mediante cualquiera de los canales disponibles: pággina web, correo electrónico o teléfono.</p>
							</div>
						<?php }?>
				</div><!--/login form-->
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