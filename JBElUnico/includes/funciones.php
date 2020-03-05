<?php //MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
  global $con;
  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($con, $theValue) : mysqli_escape_string($con,$theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


function ShowLevel($level)
{
	
	switch ($level) {
    case 0:
        return '<button type="button" class="btn btn-primary btn-xs" value="Usuario público">Usuario público</button>';
        break;
    case 1:
         return '<button type="button" class="btn btn-success btn-xs" value="SuperAdministrador">SuperAdministrador</button>';
        break;
    case 10:
         return '<button type="button" class="btn btn-info btn-xs" value="Gestor de Ventas">Gestor de Ventas</button>';
        break;
    case 100:
         return '<button type="button" class="btn btn-warning btn-xs" value="Gestor de Productos">Gestor de Productos</button>';
        break;
	}
}

function ShowState($state)
{
	
	switch ($state) {
    case 0:
         return '<button type="button" class="btn btn-error btn-danger" value="Inactivo"><i class="fa fa-times"></i></button>';
        break;
    case 1:
         return '<button type="button" class="btn btn-success btn-circle" value="Activo"><i class="fa fa-check"></i></button>';
        break;
	}
}

//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

function testuniquemail($email)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strEmail FROM tblusuario WHERE strEmail = %s",GetSQLValueString($email, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0) 
		return true;
	else
		return false;
	
	mysqli_free_result($ConsultaFuncion);
}

function testuniquemailupload($idactual, $email)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strEmail FROM tblusuario WHERE strEmail = %s AND idUsuario <> %s",GetSQLValueString($email, "text"), GetSQLValueString($idactual, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0)
		return true;
	else
		return false;
	
	mysqli_free_result($ConsultaFuncion);
}

function MostrarOrdenCampo($parametroparaprocesar, $orden, $valor, $currentPage, $consultaextendidaparaordenacion){

	if ((isset($orden)) && ($orden!="0"))	{
		if ((isset($valor)) && ($valor==$parametroparaprocesar))
		{
			//SI HAY VALOR Y ORDEN Y ERA ESTE PARÃMETRO
			//SI VENIA DE orden=1
			if ($orden=="1"){
			?>
			<a href="<?php echo $currentPage;?>?orden=2&valor=<?php echo $parametroparaprocesar;?><?php echo $consultaextendidaparaordenacion;?>"><i class="fa fa-angle-double-down"></i></a>
			<?php
			}
			if ($orden=="2"){
			?>
			<a href="<?php echo $currentPage;?>?orden=1&valor=<?php echo $parametroparaprocesar;?><?php echo $consultaextendidaparaordenacion;?>"><i class="fa fa-angle-double-up"></i></a>
			<?php
			}
		}

		else
		{ //SI HAY VALOR Y ORDEN Y PERO NO DE ESTE PARÃMETRO
			?>
			<a href="<?php echo $currentPage;?>?orden=1&valor=<?php echo $parametroparaprocesar;?><?php echo $consultaextendidaparaordenacion;?>"><i class="fa fa-angle-double-up"></i></a>
			<?php

		}
	}
	else
	{ //NO HAY PARÃMETROS
		?>
			<a href="<?php echo $currentPage;?>?orden=1&valor=<?php echo $parametroparaprocesar;?><?php echo $consultaextendidaparaordenacion;?>"><i class="fa fa-angle-double-down"></i></a>
			<?php
	}
}

function dropdowncategory($padre, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
		?>
		<option value="<?php echo $row_ConsultaFuncion["idCategoria"] ?>"><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"] ?></option>
		<?php
			dropdowncategory($row_ConsultaFuncion["idCategoria"], " --");
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function adminlevelcategory($padre, $pertenencia="")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
		?>
			<tr>
				<td><?php echo $row_ConsultaFuncion["idCategoria"];?></td>
				<td><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></td>
				<td><?php echo ShowState($row_ConsultaFuncion["intEstado"]);?></td>
				<td><?php echo $row_ConsultaFuncion["intOrden"];?></td>
				<td></td>
				<td><a href="category-edit.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>" class="btn btn-warning btn-circle" titel="Edición de Categoria">
					<i class="fa fa-edit"></i></a></td>
			</tr>
		<?php	
			adminlevelcategory($row_ConsultaFuncion["idCategoria"], "----- ");
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

?>