<?php require_once('../Connections/conexion.php'); ?>

<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsert")) {
 
	if($_POST["strPassword"]!="")
	{
		$updateSQL = sprintf("UPDATE tblusuario SET strEmail=%s, strNombre=%s, intNivel=%s, intEstado=%s, strPassword=%s WHERE idUsuario=%s",
                       GetSQLValueString($_POST["strEmail"], "text"),
					  GetSQLValueString($_POST["strNombre"], "text"),
					  GetSQLValueString($_POST["intNivel"], "int"),
					  GetSQLValueString($_POST["intEstado"], "int"),
					   GetSQLValueString(md5($_POST["strPassword"]), "text"),
					  GetSQLValueString($_POST["idUsuario"], "int"));
	}
	else
	{
		$updateSQL = sprintf("UPDATE tblusuario SET strEmail=%s, strNombre=%s, intNivel=%s, intEstado=%s WHERE idUsuario=%s",
                       GetSQLValueString($_POST["strEmail"], "text"),
					  GetSQLValueString($_POST["strNombre"], "text"),
					  GetSQLValueString($_POST["intNivel"], "int"),
					  GetSQLValueString($_POST["intEstado"], "int"),
					  GetSQLValueString($_POST["idUsuario"], "int"));
	}
//echo $updateSQL;
$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));

  $updateGoTo = "user-list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

?>

<?php
$query_DatosConsulta = sprintf("SELECT * FROM tblusuario WHERE idUsuario=%s", GetSQLValueString($_GET["id"], "int"));

$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);
?><!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/Administracion.dwt.php" codeOutsideHTMLIsLocked="false" -->

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
<div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
  <div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gestión de usuarios</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<a href="user-list.php" class="btn btn-outline btn-info">Volver atrás</a>
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
                        	Editar usuario
                        	<!-- /.table-responsive -->
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="user-edit.php" method="post" id="forminsert" name="forminsert">
                                        <div class="form-group">
                                            <label for="strEmail">Correo electrónico</label>
                                            <input class="form-control" placeholder="micorreo@correo.es" name="strEmail" id="strEmail" value="<?php echo $row_DatosConsulta["strEmail"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="strPassword">Contraseña</label>
                                            <input class="form-control" placeholder="Escribir Contraseña sólo si se va a cambiar" name="strPassword" id="strPassword">
                                        </div>
                                        <div class="form-group">
                                            <label for="strNombre">Nombre del Usuario</label>
                                            <input class="form-control" placeholder="Nombre" name="strNombre" id="strNombre" value="<?php echo $row_DatosConsulta["strNombre"];?>">>
                                        </div>
                                        <div class="form-group">
                                            <label for="intNivel">Nivel de Usuario</label>
                                            <select class="form-control" name="intNivel" id="intNivel">
                                                <option value="0" <?php if ($row_DatosConsulta["intNivel"]=="0") echo "selected"; ?>>0: Usuario publico de la tienda</option>
                                                <option value="1" <?php if ($row_DatosConsulta["intNivel"]=="1") echo "selected"; ?>>1: Superadministrador</option>
                                                <option value="10" <?php if ($row_DatosConsulta["intNivel"]=="10") echo "selected"; ?>>10: Gestor de Ventas</option>
                                                <option value="100" <?php if ($row_DatosConsulta["intNivel"]=="100") echo "selected"; ?>>100: Gestor de Productos</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="intEstado">Estado</label>
                                            <select class="form-control" name="intEstado" id="intEstado">
                                                <option value="0" <?php if ($row_DatosConsulta["intEstado"]=="0") echo "selected"; ?>>Inactivo</option>
                                                <option value="1" <?php if ($row_DatosConsulta["intEstado"]=="1") echo "selected"; ?>>Activo</option>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success" value="Editar">Editar</button>
                                        <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $row_DatosConsulta["idUsuario"];?>">                                       
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
