<?php require_once('../Connections/conexion.php'); ?>

<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/Administracion.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    <!-- InstanceEndEditable -->
    <!-- Bootstrap Core CSS -->
    <?php include("../includes/adm-header.php"); ?>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="ContenidoAdmin" -->
	<script src="scriptupload.js"></script>
	<script src="../js/script-admin.js"></script>
	<div id="wrapper">
	  <!-- Navigation -->
	  <?php include("../includes/adm-menu.php"); ?>
	  <div id="page-wrapper">
		 <div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Error detectado</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<br>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Atención
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6">
										<?php if ($_GET["error"]==1){?>
											<div class="alert alert-danger">El correo introducido ya existe. <a href="user-add.php">Inténtalo de nuevo</a>.</div>
										<?php }?>
										
										<?php if ($_GET["error"]==2){?>
											<div class="alert alert-danger">El correo introducido ya existe. <a href="user-edit.php?id=<?php echo $_GET["id"];?>'">Inténtalo de nuevo</a>.</div>
										<?php }?>
										
										<?php if ($_GET["error"]==3){?>
											<div class="alert alert-danger">Usted no dispone de las credenciales para acceder a esta sección.</div>
										<?php }?>
								  </div>
									<!-- /.col-lg-6 (nested) -->

									<!-- /.col-lg-6 (nested) -->
								</div>
								<!-- /.row (nested) -->
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">

								<!-- /.table-responsive -->
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
					<!-- /.col-lg-6 -->

					<!-- /.col-lg-6 -->
				</div>
	  </div>
	  <!-- /#page-wrapper -->
	</div>
<!-- InstanceEndEditable -->
<!-- /#wrapper -->

    <?php include("../includes/adm-footer.php"); ?>

    

</body>

<!-- InstanceEnd -->
</html>