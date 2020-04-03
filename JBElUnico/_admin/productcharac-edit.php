<?php require_once('../Connections/conexion.php');
RestringirAcceso("1");?><?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$variable_Consulta = "0";
if (isset($VARIABLE)) {
  $variable_Consulta = $VARIABLE;
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsert")) 
{
	//PRIMERO BORRAMOS LAS CARACTERISTICAS ACTUALES
	$query_Delete = sprintf("DELETE FROM tblproductocaracteristica WHERE refProducto=%s",
							   GetSQLValueString($_POST["id "], "int"));
		$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));
	
	//SEUNDO SELECCIONAMOS LAS CARARESTICAS
	$query_DatosCaracteristicaLista = sprintf("SELECT * FROM tblcaracteristica WHERE refPadre=0 AND intEstado=1 ");

	$DatosCaracteristicaLista = mysqli_query($con,  $query_DatosCaracteristicaLista) or die(mysqli_error($con));
	$row_DatosCaracteristicaLista = mysqli_fetch_assoc($DatosCaracteristicaLista);
	$totalRows_DatosCaracteristicaLista = mysqli_num_rows($DatosCaracteristicaLista);
	
	do
	{
		if($_POST["intCaracteristica-".$row_DatosCaracteristicaLista["idCaracteristica"]]!=0)
		{
			//INSERTO EN LA TABLA PRODUCTOCARACTERISTICA
			$insertSQL = sprintf("INSERT INTO tblproductocaracteristica(refProducto, refCaracteristica, refSeleccionada) VALUES (%s, %s, %s)",
						   GetSQLValueString($_POST["id"], "int"),
						  GetSQLValueString($row_DatosCaracteristicaLista["idCaracteristica"], "int"),
						  GetSQLValueString($_POST["intCaracteristica-".$row_DatosCaracteristicaLista["idCaracteristica"]], "int"));


	  		$Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));
		}
	} while($row_DatosCaracteristicaLista = mysqli_fetch_assoc($DatosCaracteristicaLista));

	  $insertGoTo = "product-list.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  header(sprintf("Location: %s", $insertGoTo));
}

/**************************************************************/
/*ORDEN PARAMETROS*/
/*ESTO CAMBIARÁ SEGÚN A QUÉ TABLA*/
if (isset($_GET["valor"]))
{
	switch ($_GET["valor"]) {
    case 1:
        $parametro_orden= "idCaracteristica";
        break;
    case 2:
        $parametro_orden= "strNombre";
        break;
	case 3:
		$parametro_orden= "intOrden";
		break;
    }
}
else
	$parametro_orden= "idCaracteristica"; //POR DEFECTO

if (isset($_GET["orden"]))
{
	switch ($_GET["orden"]) {
    case 1:
        $parametro_ordena_sentido= "ASC";
        break;
    case 2:
        $parametro_ordena_sentido= "DESC";
        break;
	}
}
else
	$parametro_ordena_sentido= "ASC"; //POR DEFECTO

$cadenaOrden=" ORDER BY ".$parametro_orden." ".$parametro_ordena_sentido;

/*ORDEN PARAMETROS*/
/**************************************************************/

/**************************************************************/
/**********************************         PAGINACION         /
/**************************************************************/

			
            $currentPage = $_SERVER["PHP_SELF"];
            
            $maxRows_DatosConsulta = 30; // Numero de registros por pagina
            $pageNum_DatosConsulta = 0;  // Seleccion de página actual
            $interval_page = 4; // desde la pagina actual - este valor hasta la pagina actual + este valor
            
            if (isset($_GET['pageNum_DatosConsulta'])) {
              $pageNum_DatosConsulta = $_GET['pageNum_DatosConsulta'];
            }
            $startRow_DatosConsulta = $pageNum_DatosConsulta * $maxRows_DatosConsulta;
/*************************************************************/
/*************************************************************/
/*************************************************************/
$consultaextendidaparaordenacion="";

if ((isset($_GET["MM_search"])) && ($_GET["MM_search"]=="formsearch"))
{
	$consultaextendida = "";
		
	$consultaextendidaparaordenacion="&MM_search=formsearch&strBuscar=".$_GET["strBuscar"];
	
	//(BLOQUE NOMBRE)
	$porciones = explode(" ", $_GET["strBuscar"]);
	$longitud = count($porciones);
	$extramodelo=" strNombre LIKE '%".$_GET["strBuscar"] ."%'";
	for($i=0; $i<$longitud; $i++)
	{
		$extramodelo.=" OR strNombre LIKE '%".$porciones[$i] ."%'";
	}
	//(FIN BLOQUE NOMBRE)

	
	$query_DatosConsulta = "SELECT * FROM tblcaracteristica WHERE (".$extramodelo.") WHERE refPadre=0 AND intEstado=1 ".$consultaextendida.$cadenaOrden;
	//echo $query_DatosConsulta;
}
else
{
	$query_DatosConsulta = sprintf("SELECT * FROM tblcaracteristica WHERE refPadre=0 AND intEstado=1 ".$cadenaOrden);
}

//$query_limit_DatosConsulta = sprintf("%s LIMIT %d, %d", $query_DatosConsulta, $startRow_DatosConsulta, $maxRows_DatosConsulta);
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

/**************************************************************/
/**********************************         PAGINACION         /
/**************************************************************/
            if (isset($_GET['totalRows_DatosConsulta'])) {
              $totalRows_DatosConsulta = $_GET['totalRows_DatosConsulta'];
            } else {
              $all_DatosConsulta = mysqli_query($con,  $query_DatosConsulta);
              $totalRows_DatosConsulta = mysqli_num_rows($all_DatosConsulta);
            }
            $totalPages_DatosConsulta = ceil($totalRows_DatosConsulta/$maxRows_DatosConsulta)-1;
            
            
            
            $queryString_DatosConsulta = "";
            if (!empty($_SERVER['QUERY_STRING'])) {
              $params = explode("&", $_SERVER['QUERY_STRING']);
              $newParams = array();
              foreach ($params as $param) {
                if (stristr($param, "pageNum_DatosConsulta") == false && 
                    stristr($param, "totalRows_DatosConsulta") == false) {
                  array_push($newParams, $param);
                }
              }
              if (count($newParams) != 0) {
                $queryString_DatosConsulta = "&" . htmlentities(implode("&", $newParams));
              }
            }
            $queryString_DatosConsulta = sprintf("&totalRows_DatosConsulta=%d%s", $totalRows_DatosConsulta, $queryString_DatosConsulta);
/*************************************************************/
/*************************************************************/
/*************************************************************/
//FINAL DE LA PARTE SUPERIOR

//FINAL DE LA PARTE SUPERIOR
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
<div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
  <div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gestión de Caracerísticas de Producto</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <a href="product-list.php" class="btn btn-outline btn-info">Volver atrás</a>
			<br>
			<br>
			
           <div class="row">
                <div class="col-lg-5">
                
                </div>
                <div class="col-lg-7">
                	<div class="well">
						
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
                               <form role="form" action="productcharac-edit.php" method="post" id="forminsert" name="forminsert" onSubmit="javascript:return validarmarcaalta();">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Id <?php
														//BLOQUE ORDENACIÓN
														//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
														$parametroparaprocesar="1";
														if (!isset($_GET["orden"])) {
															$orden=0;
															$valor=0;
														}
														else {
															$orden=$_GET["orden"];
															$valor=$_GET["valor"];
														}
														MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
													?></th>

												<th>Característica <?php
														//BLOQUE ORDENACIÓN
														//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
														$parametroparaprocesar="2";
														if (!isset($_GET["orden"])) {
															$orden=0;
															$valor=0;
														}
														else {
															$orden=$_GET["orden"];
															$valor=$_GET["valor"];
														}
														MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
													?></th>
												<th>Orden <?php
														//BLOQUE ORDENACIÓN
														//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
														$parametroparaprocesar="3";
														if (!isset($_GET["orden"])) {
															$orden=0;
															$valor=0;
														}
														else {
															$orden=$_GET["orden"];
															$valor=$_GET["valor"];
														}
														MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
													?></th>
												<th>Seleccionado </th>
											</tr>
										</thead>
										<tbody>
										   <?php 
											//AQUI ES DONDE SE SACAN LOS DATOS, SE COMPRUEBA QUE HAY RESULTADOS 
												 do { 
											?>

												<tr>
													<td><?php echo $row_DatosConsulta["idCaracteristica"];?></td>
													<td><?php echo $row_DatosConsulta["strNombre"];?></td>
													<td><?php echo $row_DatosConsulta["intOrden"];?></td>
													<td><?php echo ShowCharacProductEdit($row_DatosConsulta["idCaracteristica"], $_GET["id"]);?></td>
													<td></td>
												</tr>

												<?php
												 } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta)); 
											?>
										</tbody>
									</table>

									<button type="submit" class="btn btn-success" value="Actualizar">Actualizar</button>                                        
									<input type="hidden" name="MM_insert" id="MM_insert" value="forminsert">
									<input type="hidden" name="id" id="id" value="<?php echo $_GET["id"];?>">
								</fom>								
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
//AÃ‘ADIR AL FINAL DE LA PÃGINA
mysqli_free_result($DatosConsulta);
?>