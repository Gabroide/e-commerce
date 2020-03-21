<?php require_once('../Connections/conexion.php'); RestringirAcceso("1");?>

<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsert")) {

	
	
  $updateSQL = sprintf("UPDATE tblconfiguracion SET strTelefono=%s, strEmail=%s, strLogo=%s WHERE idConfiguracion=%s",
                       GetSQLValueString($_POST["strTelefono"], "text"),
					   GetSQLValueString($_POST["strEmail"], "text"),
					   GetSQLValueString($_POST["strLogo"], "text"),					   
					   GetSQLValueString($_POST["idConfiguracion"], "int"));

//echo $updateSQL;
$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));

  $updateGoTo = "settings.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));

}

?>

<?php
$query_DatosConsulta = sprintf("SELECT * FROM tblconfiguracion WHERE idConfiguracion=1");

$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);
?><!DOCTYPE html>
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
                    <h1 class="page-header">Configuración</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<!--<a href="user-list.php" class="btn btn-outline btn-info">Volver atrás</a>-->
			<br>
			<br>
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resultado
                        </div>
`                         <!-- /.panel-heading -->
                        <div class="panel-body">
                        	Editar Configuración
                        	<!-- /.table-responsive -->
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="settings.php" method="post" id="forminsert" name="forminsert">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input class="form-control" placeholder="e-mail" name="strEmail" id="strEmail" value="<?php echo $row_DatosConsulta["strEmail"];?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Teléfono</label>
                                            <input class="form-control" placeholder="Teléfono que saldrá en la parte superior" name="strTelefono" id="strTelefono" value="<?php echo $row_DatosConsulta["strTelefono"];?>">
                                        </div>
										<?php 
											//BLOQUE INSERCION IMAGEN
											//***********************
											//***********************
											//***********************									  //***********************
											//PARÁMETROS DE IMAGEN
											$nombrecampoimagen="strLogo";
											$nombrecampoimagenmostrar="strLogopic";
											$nombrecarpetadestino="../images/"; //carpeta destino con barra al final
											$nombrecampofichero="file1";
											$nombrecampostatus="status1";
											$nombrebarraprogreso="progressBar1";
											$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
											$tiposficheropermitidos="jpg,png"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
											$limiteancho="410"; // En píxels, "0" significa cualquier tamaño permitido
											$limitealto="160"; // En píxels, "0" significa cualquier tamaño permitido

											$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

											//$cadenadeparametros="";
										?>
										<div class="form-group">
											<label>Imagen de logo</label>
											<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>" value="<?php echo $row_DatosConsulta["strLogo"];?>">
										</div> 
										<div class="form-group">
											<div class="row">
												<div class="col-lg-6">
													<input type="file" name="<?php echo $nombrecampofichero;?>" id="<?php echo $nombrecampofichero;?>"><br>
												</div>
												<div class="col-lg-6">
													<input class="form-control" type="button" value="Subir Fichero" onclick="uploadFile(<?php echo $cadenadeparametros;?>)">
												</div>
											</div>
											<progress id="<?php echo $nombrebarraprogreso;?>" value="0" max="100" style="width:100%;"></progress>
											<h5 id="<?php echo $nombrecampostatus;?>"></h5>
											<?php if ($row_DatosConsulta["strLogo"]!=""){?>
											<img src="<?php echo $nombrecarpetadestino.$row_DatosConsulta["strLogo"];?>" alt="Logo" id="<?php echo $nombrecampoimagenmostrar;?>">
											<?php }
											else
											{?>
											<img src="../images/users/nouser.jpg" alt="sin logo" width="400"  id="<?php echo $nombrecampoimagenmostrar;?>">
											<?php }?>
										</div>   
										<?php /*?>
										//***********************
										//***********************
										//***********************									  //***********************
										// FIN BLOQUE INSERCION IMAGEN
										<?php */?>                                        
                                        <button type="submit" class="btn btn-success" value="Actualizar">Actualizar</button>
                                        <input type="hidden" name="idConfiguracion" id="idConfiguracion" value="<?php echo $row_DatosConsulta["idConfiguracion"];?>">                                       
                                    	<input type="hidden" name="MM_insert" id="MM_insert" value="forminsert">
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- InstanceEndEditable -->
<!-- /#wrapper -->

    <?php include("../includes/adm-footer.php"); ?>

    

</body>

<!-- InstanceEnd --></html>