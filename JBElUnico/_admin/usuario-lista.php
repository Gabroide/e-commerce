<?php require_once('../Connections/conexion.php'); ?><?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$variable_Consulta = "0";
if (isset($VARIABLE)) {
  $variable_Consulta = $VARIABLE;
}

if ((isset($_GET["MM_Buscar"])) && ($_GET["MM_Buscar"]=="formbusqueda"))
{
	$query_DatosConsulta = sprintf("SELECT * FROM tblusuario WHERE strNombre LIKE "%'.%s.'%" ORDER BY idUsuario ASC",
								  GetSQLValueString($_GET["strBuscar"], "text"));
	
}

$query_DatosConsulta = sprintf("SELECT * FROM tblusuario ORDER BY idUsuario ASC");
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

//FINAL DE LA PARTE SUPERIOR
?>
             

<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/Administracion.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Administración Tienda 2017</title>
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
                    <h1 class="page-header">Gestión de Usuarios</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

           
            
<div class="row">
	<div class="col-lg-5">
		<a href="usuario-add.php" class="btn btn-outline btn-primary">Añadir Usuario</a>
	</div>
	<div class="col-lg-7">
	<div class="well">

	<form action="usuario-lista.php" method="get" id="formbusqueda" name="formbusqueda" role="form">
	
	<div class="row">
	<div class="col-lg-4">
	
	<div class="form-group">
		<input class="form-control" placeholder="Buscar..." name="strBuscar"  id="strBuscar">
	</div>
		</div>
		<div class="col-lg-6">
	<select name="intNivel" class="form-control" id="intNivel">
				<option value="0">0: Usuario público de tienda</option>
				<option value="1">1: SuperAdministrador </option>
				<option value="10">10: Gestor de Ventas</option>
				<option value="100">100: Gestor de Productos</option>
			</select>
			</div>
				<div class="col-lg-2">
			
	<button type="submit" class="btn btn-success">Buscar</button>
		</div>
	
	<input name="MM_Buscar" type="hidden" id="MM_Buscar" value="formbusqueda">
		</div>
		</form>
		</div>

	</div>
</div>

            
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resultado
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                               <?php if ($totalRows_DatosConsulta > 0) {  ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>e-mail</th>
                                            <th>Estado</th>
                                            <th>Nivel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
		//AQUI ES DONDE SE SACAN LOS DATOS, SE COMPRUEBA QUE HAY RESULTADOS
		
			 do { 
              		?>
              		
				<tr>
						<td><?php echo $row_DatosConsulta["idUsuario"];?></td>
						<td><?php echo $row_DatosConsulta["strNombre"];?></td>
						<td><?php echo $row_DatosConsulta["strEmail"];?></td>
						<td><?php echo MostrarEstado($row_DatosConsulta["intEstado"]);?></td>
						<td><?php echo MostrarNivel($row_DatosConsulta["intNivel"]);?></td>
				</tr>
              		
              		<?php
              		 } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta)); 
	?>
   
                                    </tbody>
                                </table>
                          <?php      
        } 
		else
		 { //MOSTRAR SI NO HAY RESULTADOS ?>
                No hay resultados.
                <?php } ?>
                            </div>
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

<!-- InstanceEnd --></html>
<?php
//AÑADIR AL FINAL DE LA PÁGINA
mysqli_free_result($DatosConsulta);
?>
