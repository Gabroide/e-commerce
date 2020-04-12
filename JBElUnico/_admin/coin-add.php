<?php require_once('../Connections/conexion.php'); RestringirAcceso("1");?>
<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsert")) {

	 $insertSQL = sprintf("INSERT INTO tblmoneda(strNombre, dblValor, strSimbolo) VALUES (%s, %s, %s)",
						   GetSQLValueString($_POST["strNombre"], "text"),
						  GetSQLValueString(ProcessComaCost($_POST["dblValor"]), "double"),
						  GetSQLValueString($_POST["strSimbolo"], "text"));


	  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));


	  $insertGoTo = "coin-list.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  header(sprintf("Location: %s", $insertGoTo));
}
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
                    <h1 class="page-header">Gestión de Monedas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<a href="coin-list.php" class="btn btn-outline btn-info">Volver atrás</a>
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
                        	Añadir Moneda
                        	<!-- /.table-responsive -->
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="coin-add.php" method="post" id="forminsert" name="forminsert" onSubmit="javascript:return validarmarcaalta();">
                                        <div class="form-group">
                                            <label for="strNombre">Nombre de la Moneda</label>
                                            <input class="form-control" placeholder="Escribir Nombre de la Moneda" name="strNombre" id="strNombre">
                                        </div>
                                        <div class="alert alert-danger hiddeit" id="errormarca">
                                        	El campo Nombre de la Moneda es obligatorio.
                                        </div>
                                        <div class="form-group">
                                            <label for="dblValor">Valor de la Moneda</label>
                                            <input class="form-control" placeholder="1,00" name="dblValor" id="dblValor">
                                        </div>
                                        <div class="alert alert-danger hiddeit" id="errormarca">
                                        	El campo Valor de la Moneda es obligatorio.
                                        </div>
										<div class="form-group">
                                            <label for="strSimbolo">Símbolo de Moneda</label>
                                            <input class="form-control" placeholder="€" name="strSimbolo" id="strSimbolo">
                                        </div>
                                        <div class="alert alert-danger hiddeit" id="errorsimbolo">
                                        	El campo Simbolo de la Moneda es obligatorio.
                                        </div>
                                        <button type="submit" class="btn btn-success" value="Añadir">Añadir</button>                                        
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
