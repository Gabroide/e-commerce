<?php require_once('../Connections/conexion.php'); 
RestringirAcceso("1, 100");?>
<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsert")) {
	

  $updateSQL = sprintf("UPDATE tblopcion SET strNombre=%s, intEstado=%s, intOrden=%s, dblIncremento=%s WHERE idOpcion=%s",
                       GetSQLValueString($_POST["strNombre"], "text"),
					   GetSQLValueString($_POST["intEstado"], "int"),
					   GetSQLValueString($_POST["intOrden"], "int"),
					   GetSQLValueString(ProcessComaCost($_POST["dblIncremento"]), "double"),
					   GetSQLValueString($_POST["idOpcion"], "int"));

//echo $updateSQL;
$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));

  $updateGoTo = "options-list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
	}

$query_DatosConsulta = sprintf("SELECT * FROM tblopcion WHERE idOpcion=%s", GetSQLValueString($_GET["id"], "int"));

$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

?>              

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
                    <h1 class="page-header">Gestión de Opción</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<a href="options-list.php" class="btn btn-outline btn-info">Volver atrás</a>
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
                        	Editar Opción
                        	<!-- /.table-responsive -->
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="optiondetail-edit.php" method="post" id="forminsert" name="forminsert" role="form">
                                        <div class="form-group">
                                            <label for="strNombre">Nombre de la Opción</label>
                                            <input class="form-control" placeholder="Escribir Nombre de la Opción" name="strNombre" id="strNombre" value="<?php echo $row_DatosConsulta["strNombre"];?>">
                                        </div>
                                        <div class="alert alert-danger hiddeit" id="errornombre">eL CAMPO Nombre es obligatorio</div>
                                        <div class="form-group">
                                        	<label for="intOrden">Orden de categoría</label>
                                            <input class="form-control" placeholder="Escribir Orden de la Opción" name="intOrden" id="intOrden" value="<?php echo $row_DatosConsulta["intOrden"];?>">
                                        </div>
                                        <div class="alert alert-danger hiddeit" id="errororden">Orden obligatorio</div>  
										<div class="form-group">
                                        	<label for="dblIncremento">Incremento delPrecio</label>
                                            <input class="form-control" name="dblIncremento" id="dblIncremento" value="<?php echo $row_DatosConsulta["dblIncremento"];?>">
                                        </div>
										<div class="form-group">
											<label for="intEstado">Estado</label>
											<select name="intEstado" class="form-control" id="intEstado">
												<option value="0" <?php if ($row_DatosConsulta["intEstado"]=="0") echo "selected"; ?>>Inactivo</option>
												<option value="1" <?php if ($row_DatosConsulta["intEstado"]=="1") echo "selected"; ?>>Activo</option>
											</select>
										</div>
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                        <input name="idOpcion" type="hidden" id="idOpcion" value="<?php echo $row_DatosConsulta["idOpcion"];?>">
                                      	<input name="MM_insert" type="hidden" id="MM_insert" value="forminsert">                                       
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
