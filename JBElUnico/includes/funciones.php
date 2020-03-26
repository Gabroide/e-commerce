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

function dropdowncategorylevel2($padre, $pertenencia = "")
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
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
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
			dropdowncategorylevel2($row_ConsultaFuncion["idCategoria"], " --");
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function dropdowncategoryupdate($padre, $seleccionado, $pertenencia = "")
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
		<option value="<?php echo $row_ConsultaFuncion["idCategoria"] ?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"] ?></option>
		<?php
			dropdowncategoryupdate2($row_ConsultaFuncion["idCategoria"], $seleccionado, " --");
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function dropdowncategoryupdate2($padre, $seleccionado, $pertenencia = "")
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
		<option value="<?php echo $row_ConsultaFuncion["idCategoria"] ?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"] ?></option>
		<?php
			
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

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

function RestringirAcceso($acceden)
{
	if (!isset($_SESSION)) {
  		session_start();
	}
	$MM_authorizedUsers = $acceden;
	$MM_donotCheckaccess = "false";

	$MM_restrictGoTo = "error.php?error=3";
		if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
		  $MM_qsChar = "?";
		  $MM_referrer = $_SERVER['PHP_SELF'];
		  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
			if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
				$MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
		  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
		  header("Location: ". $MM_restrictGoTo); 
		  exit;
		}
}

function hassubcategories($padre)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s AND intEstado=1",GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
		return true;
	else
		return false;
	
	mysqli_free_result($ConsultaFuncion);
}

function showsubcategories($padre)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s AND intEstado=1",GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
			if(hassubcategories($row_ConsultaFuncion["idCategoria"]))
			{
		?>
		<li><a href="category.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $row_ConsultaFuncion["strNombre"];?> </a>
			<ul>
				<?php showsubsubcategories($row_ConsultaFuncion["idCategoria"]);?>
			</ul>
		</li>
		<?php
			}
			else
			{
			?>
			<li><a href="category.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $row_ConsultaFuncion["strNombre"];?> </a></li>		
			<?php }
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function showsubsubcategories($padre)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s AND intEstado=1",GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{ ?>
		<li><a href="category.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $row_ConsultaFuncion["strNombre"];?> </a></li>
		<?php
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function ConfigIni()
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblconfiguracion WHERE idConfiguracion = 1");
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		define("_logo", $row_ConsultaFuncion["strLogo"]);
		define("_email", $row_ConsultaFuncion["strEmail"]);
		define("_telefono", $row_ConsultaFuncion["strTelefono"]);
		define("_marcas", $row_ConsultaFuncion["intMarcas"]);
	}
	
	mysqli_free_result($ConsultaFuncion);
}

ConfigIni();

function ShowBrand($idMarca)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblmarca WHERE idMarca = %s",
		 GetSQLValueString($idMarca, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return $row_ConsultaFuncion["strMarca"];
	else
		return "No usado";
	mysqli_free_result($ConsultaFuncion);
}

function dropdowncategoryProducts($padre, $pertenencia = "")
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
			dropdowncategorylevel2Products($row_ConsultaFuncion["idCategoria"], " --");
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function dropdowncategorylevel2Products($padre, $pertenencia = "")
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
			dropdowncategorylevel3Products($row_ConsultaFuncion["idCategoria"], " ----");
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function dropdowncategorylevel3Products($padre, $pertenencia = "")
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
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function ProcessComaCost($precio)
{
	return str_replace(',','.',$precio);
}

function dropdowncategoryProductsEdit($padre, $seleccionado, $pertenencia = "")
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
		<option value="<?php echo $row_ConsultaFuncion["idCategoria"] ?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"] ?></option>
		<?php
			dropdowncategorylevel2ProductsEdit($row_ConsultaFuncion["idCategoria"], $seleccionado, " --");
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function dropdowncategorylevel2ProductsEdit($padre, $seleccionado, $pertenencia = "")
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
		<option value="<?php echo $row_ConsultaFuncion["idCategoria"] ?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"] ?></option>
		<?php
			dropdowncategorylevel3ProductsEdit($row_ConsultaFuncion["idCategoria"], $seleccionado, " ----");
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function dropdowncategorylevel3ProductsEdit($padre, $seleccionado, $pertenencia = "")
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
		<option value="<?php echo $row_ConsultaFuncion["idCategoria"] ?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"] ?></option>
		<?php
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}
?>