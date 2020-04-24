<?php require_once('../Connections/conexion.php');
RestringirAcceso("1"); ?>

<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$variable_Consulta = "0";
if (isset($VARIABLE)) {
  $variable_Consulta = $VARIABLE;
}

/**************************************************************/
/*ORDEN PARAMETROS*/
/*ESTO CAMBIARÃ SEGÃšN A QUÃ‰ TABLA*/
if (isset($_GET["valor"]))
{
	switch ($_GET["valor"]) {
    case 1:
        $parametro_orden= "idUsuario";
        break;
    case 2:
        $parametro_orden= "strNombre";
        break;
    case 3:
        $parametro_orden= "strEmail";
        break;
    case 4:
        $parametro_orden= "intEstado";
        break;
    case 5:
        $parametro_orden= "intNivel";
        break;
	}
}
else
	$parametro_orden= "idUsuario"; //POR DEFECTO

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
            
            $maxRows_DatosConsulta = 10; // Numero de registros por pagina
            $pageNum_DatosConsulta = 0;  // Seleccion de pÃ¡gina actual
            $interval_page = 4; // desde la pagina actual - este valor hasta la pagina actual + este valor
            
            if (isset($_GET['pageNum_DatosConsulta'])) {
              $pageNum_DatosConsulta = $_GET['pageNum_DatosConsulta'];
            }
            $startRow_DatosConsulta = $pageNum_DatosConsulta * $maxRows_DatosConsulta;
/*************************************************************/
/*************************************************************/
/*************************************************************/

$consultaextendidaparaordenacion="";

if((isset($_GET["MM_search"])) && ($_GET["MM_search"]=="formsearch"))
{
	if((isset($_GET["intNivel"])) && ($_GET["intNivel"]=="-1"))
	{
		$consultaextendida = "";
	}
	else{
		$consultaextendida = " AND intNivel=".$_GET["intNivel"];
	}
	
	$consultaextendidaparaordenacion="&intNivel=".$_GET["intNivel"]."&MM_Buscar=formsearch&strBuscar=".$_GET["strBuscar"];
	
	//(BLOQUE NOMBRE)
	$porciones = explode(" ", $_GET["strBuscar"]);
	$longitud = count($porciones);
	$extramodelo=" strNombre LIKE '%".$_GET["strBuscar"] ."%'";
	for($i=0; $i<$longitud; $i++)
	{
		$extramodelo.=" OR strNombre LIKE '%".$porciones[$i] ."%'";
	}
	//(FIN BLOQUE NOMBRE)
	
	//(BLOQUE E-MAIL)
	$porciones = explode(" ", $_GET["strBuscar"]);
	$longitud = count($porciones);
	$extramodelo.=" OR strEmail LIKE '%".$_GET["strBuscar"] ."%'";
	for($i=0; $i<$longitud; $i++)
	{
		$extramodelo.=" OR strEmail LIKE '%".$porciones[$i] ."%'";
	}
	//(FIN BLOQUE E-MAIL)
	
	$query_DatosConsulta = "SELECT * FROM tblusuario WHERE (".$extramodelo.") ".$consultaextendida.$cadenaOrden;
	//echo $query_DatosConsulta;
}
else
{
	$query_DatosConsulta = sprintf("SELECT * FROM tblusuario".$cadenaOrden);
}

$query_limit_DatosConsulta = sprintf("%s LIMIT %d, %d", $query_DatosConsulta, $startRow_DatosConsulta, $maxRows_DatosConsulta);
$DatosConsulta = mysqli_query($con,  $query_limit_DatosConsulta) or die(mysqli_error($con));
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
                    <h1 class="page-header">Gestión de Usuarios</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
           <div class="row">
                <div class="col-lg-5">
                	<a value="Añadir Usuario" href="user-add.php" class="btn btn-outline btn-primary">Añadir Usuario</a>
                </div>
                <div class="col-lg-7">
                	<div class="well">
						<form role="form" action="user-list.php" method="get" id="formsearch" name="formsearch">
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label for="strBuscar">Buscar</label>
										<input class="form-control" placeholder="Buscar..." name="strBuscar"  id="strBuscar" value="<?php if (isset($_GET["strBuscar"]))
											echo $_GET["strBuscar"];
										?>">	
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="intNivel">Nivel de Usuario</label>
										<select class="form-control" name="intNivel" id="intNivel">
											<option value="-1" <?php if ((isset($_GET["intNivel"])) && (($_GET["intNivel"]=="-1"))) echo "selected"; ?>>Todos</option>
											<option value="0" <?php if ((isset($_GET["intNivel"])) && (($_GET["intNivel"]=="0"))) echo "selected"; ?>>0: Usuario publico de la tienda</option>
											<option value="1" <?php if ((isset($_GET["intNivel"])) && (($_GET["intNivel"]=="1"))) echo "selected"; ?>>1: Superadministrador</option>
											<option value="10" <?php if ((isset($_GET["intNivel"])) && (($_GET["intNivel"]=="10"))) echo "selected"; ?>>10: Gestor de Ventas</option>
											<option value="100" <?php if ((isset($_GET["intNivel"])) && (($_GET["intNivel"]=="100"))) echo "selected"; ?>>100: Gestor de Productos</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2">
									<button type="submit" class="btn btn-success" value="Buscar">Buscar</button>
								</div>
								<input type="hidden" name="MM_search" id="MM_search" value="formsearch">
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
                               <?php if ($totalRows_DatosConsulta > 0) { ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id <?php
													//BLOQUE ORDENACIÃ“N
													//SI HAY PARÃMETROS, HAY QUE SABER SI SON DE ORDEN
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
												?>
                                           </th>
                                            <th></th>
                                            <th>Nombre <?php
													//BLOQUE ORDENACIÃ“N
													//SI HAY PARÃMETROS, HAY QUE SABER SI SON DE ORDEN
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
												?>
                                            </th>
                                            <th>E-mail <?php
													//BLOQUE ORDENACIÃ“N
													//SI HAY PARÃMETROS, HAY QUE SABER SI SON DE ORDEN
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
												?> 
                                            </th>
                                            <th>Estado <?php
													//BLOQUE ORDENACIÃ“N
													//SI HAY PARÃMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="4";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?>
                                            </th>
                                            <th>Nivel <?php
													//BLOQUE ORDENACIÃ“N
													//SI HAY PARÃMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="5";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?>
                                            </th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
										//AQUI ES DONDE SE SACAN LOS DATOS, SE COMPRUEBA QUE HAY RESULTADOS 
											 do { 
													?>
              		
										<tr>
											<td><?php echo $row_DatosConsulta["idUsuario"];?></td>
											<td>
												<?php if($row_DatosConsulta["strImagen"] != ""){?>
													<img src="../images/users/<?php echo $row_DatosConsulta["strImagen"];?>" width="30" height="30" alt="avatar del usuario">
												<?php } else {?>
													<img src="../images/users/nouser.jpg" width="30" height="30" alt=""/>	
												<?php }?>
											</td>
											<td><?php echo $row_DatosConsulta["strNombre"];?></td>
											<td><?php echo $row_DatosConsulta["strEmail"];?></td>
											<td><?php echo ShowState($row_DatosConsulta["intEstado"]);?></td>
											<td><?php echo ShowLevel($row_DatosConsulta["intNivel"]);?></td>
										  <td><a href="user-edit.php?id=<?php echo $row_DatosConsulta["idUsuario"];?>" class="btn btn-warning btn-circle" title="Edición de Usuario">
												<i class="fa fa-edit"></i></a> <a href="phoneseller.php?id=<?php echo $row_DatosConsulta["idUsuario"];?>" class="btn btn-success btn-circle" title="Edición de Usuario" target="_blank">
												<i class="fa fa-headphones"></i></a></td>
										</tr>
              		
              							<?php
											 } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta)); 
											?> 
									</tbody>
                                </table>
                                <ul class="pagination">
		<?php if ($pageNum_DatosConsulta > 0) { // Show if not first page ?>
			<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, 0, $queryString_DatosConsulta); ?>" title="Primero">Primero</a></li>
		<?php } // Show if not first page ?>
		<?php if ($pageNum_DatosConsulta > 0) { // Show if not first page ?>
                	<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, max(0, $pageNum_DatosConsulta - 1), $queryString_DatosConsulta); ?>" title="Anterior">&laquo;</a></li> 								
		<?php } // Show if not first page 
                if ($pageNum_DatosConsulta-$interval_page<1){
		 $inicio = 0;
		 } else{
		 $inicio = $pageNum_DatosConsulta-$interval_page;
		 }
		 if ($pageNum_DatosConsulta+$interval_page>=$totalPages_DatosConsulta){
			$final = $totalPages_DatosConsulta;
			} else{
			 $final = $pageNum_DatosConsulta+$interval_page;
			}
			for ($pagina=$inicio; $pagina<=$final; ++$pagina){
				if ($pagina==$pageNum_DatosConsulta){
					$clase = "active";
				} 
				else 
				{
					$clase = "";
				}?>
				<li class="<?php echo $clase; ?>"><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, min($totalPages_DatosConsulta,$pagina), $queryString_DatosConsulta); ?>"  title="<?php echo $pagina+1; ?>"><?php echo $pagina+1; ?></a></li>				<?php }?>
                        <?php if ($pageNum_DatosConsulta < $totalPages_DatosConsulta) { // Show if not last page ?>
			<li class="disabled"><a href="#">...</a></li>								
			<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, min($totalPages_DatosConsulta, $pageNum_DatosConsulta + 1), $queryString_DatosConsulta); ?>" title="Siguiente">&raquo;</a></li>									<?php } // Show if not last page ?>
			<?php if ($pageNum_DatosConsulta < $totalPages_DatosConsulta) { // Show if not last page ?>							<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, $totalPages_DatosConsulta, $queryString_DatosConsulta); ?>" title="Ultimo">Ãšltimo</a></li>							
			<?php } // Show if not last page ?>       
	</ul>s
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