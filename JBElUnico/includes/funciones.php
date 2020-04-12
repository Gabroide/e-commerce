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
				<td>
					<a href="category-edit.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>" class="btn btn-warning btn-circle" titel="Edición de Categoria">
					<i class="fa fa-edit"></i></a>
					<a href="category-delete.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>" class="btn btn-danger btn-circle" titel="Edición de Categoria">
												<i class="fa fa-times-circle"></i></a>
				</td>
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
		define("_mostrarimpuesto", $row_ConsultaFuncion["intImpuesto"]);
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

function ShowProduct($id, $tipomuestra=0)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproducto WHERE idProducto=%s",GetSQLValueString($id, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	$linkProduct="product-detail.php?id=".$row_ConsultaFuncion["idProducto"];
?>

	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
				<?php if ($row_ConsultaFuncion["strImagen1"]!=""){?>
					<a href="<?php echo $linkProduct; ?>">
						<img src="images/products/<?php echo $row_ConsultaFuncion["strImagen1"];?>" alt="<?php echo $row_ConsultaFuncion["strNombre"];?>" title="<?php echo $row_ConsultaFuncion["strNombre"];?>" id="imagenproducto<?php echo $row_ConsultaFuncion["idProducto"];?>">
					</a>
					<?php }
					else
					{?>
					<a href="<?php echo $linkProduct;?>">
						<img src="images/products/nodisponible.jpg" alt="Producto sin Imagen" id="imagenproducto<?php echo $row_ConsultaFuncion["idProducto"];?>">
					</a>
				<?php }?>
				<h2><?php echo CalculateProductCost($row_ConsultaFuncion["idProducto"]); ?></h2>
				<p><?php echo $row_ConsultaFuncion["strNombre"]; ?></p>
				<a href="<?php echo $linkProduct ;?>" class="btn btn-default add-to-cart"><i class="fa fa-cog"></i>Ver</a>
				<!--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Añadir al carrito</a>
				-->
				<?php if($tipomuestra==2){?>
					<br>
				<?php
					ShowCharacCompare($row_ConsultaFuncion["idProducto"]);
				 }?>
			</div>									
		</div>
		<div class="choose">
			<ul class="nav nav-pills nav-justified" id="deseolista<?php echo $row_ConsultaFuncion["idProducto"];?>">
		<?php if (isset($_SESSION['tienda2020Front_UserId'])){
			if (!IsAWish($row_ConsultaFuncion["idProducto"])){?>
			<li id="deseoli<?php echo $row_ConsultaFuncion["idProducto"];?>"><a href="javascript:void(0);" class="Adeseos" id="deseo<?php echo $row_ConsultaFuncion["idProducto"];?>"><i class="fa fa-plus-square"></i> Añadir a mis deseos</a></li>
			<?php
			}
			else
			{
				?>
				<li><a href="user-wishlist.php" style="color:#FF0004"><i class="fa fa-heart"></i> En mis deseos</a></li>
				
				<?php
			
				}
			 }
			else
			
			{?>
				<li id="deseoli<?php echo $row_ConsultaFuncion["idProducto"];?>"><a title="Debes registrarte para poder guardar tus deseos" href="javascript:void(0);" id="deseo<?php echo $row_ConsultaFuncion["idProducto"];?>"><i class="fa fa-plus-square"></i> A mis deseos</a></li>
				
				<?php
			}?>
			
			
			<?php 
			//COMPARADOR
			if (isset($_SESSION['tienda2020Front_UserId'])){
				if (!IsInTheList($row_ConsultaFuncion["idProducto"])){?>
					<li id="compararli<?php echo $row_ConsultaFuncion["idProducto"];?>"><a href="javascript:void(0);" class="Acomparar" id="comparar<?php echo $row_ConsultaFuncion["idProducto"];?>"><i class="fa fa-plus-square"></i> Añadir al comparador</a></li>
				<?php
				}
				else
				{
					?>
					<li><a href="user-compare.php" style="color:#1A53A1"><i class="fa fa-bars"></i>En el compardor</a></li>

					<?php

					}
			 }
			else
			{?>
				<li id="compararli<?php echo $row_ConsultaFuncion["idProducto"];?>"><a title="Debes registrarte para poder utilizar el comparador" href="javascript:void(0);" id="comparar<?php echo $row_ConsultaFuncion["idProducto"];?>"><i class="fa fa-plus-square"></i> Añadir al comparador</a></li>
				
				<?php
			}?>
			</ul>
		</div>
		
		<?php if($tipomuestra==1){ ?>
		<div class="choose">
			<ul class="nav nav-pills nav-justified" id="deseolista<?php echo $row_ConsultaFuncion["idProducto"];?>">
				<li><a href="javascript:void(0)" onClick="javascript:DeleteWish(<?php echo $row_ConsultaFuncion["idProducto"] ?>)" title="Eliminar el producto de mis deseos"><i class="fa fa-times-circle"> Eliminar de mis deseos</i></a></li>
			</ul>
		</div>
		<?php }?>
		<?php if($tipomuestra==2){ ?>
		<div class="choose">
			<ul class="nav nav-pills nav-justified" id="deseolista<?php echo $row_ConsultaFuncion["idProducto"];?>">
				<li><a href="javascript:void(0)" onClick="javascript:DeleteCompare(<?php echo $row_ConsultaFuncion["idProducto"] ?>)" title="Eliminar el producto del listado de comparación"><i class="fa fa-times-circle"> Eliminar de mi comparador</i></a></li>
			</ul>
		</div>
		<?php }?>
	</div>

<?php		
	mysqli_free_result($ConsultaFuncion);
}

function ProductosDependientes($cat)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT idProducto, strNombre FROM tblproducto WHERE refCategoria1=%s OR refCategoria2=%s OR refCategoria3=%s OR refCategoria4=%s OR refCategoria5=%s", 
								   GetSQLValueString($cat, "int"),
								  GetSQLValueString($cat, "int"),
								  GetSQLValueString($cat, "int"),
								  GetSQLValueString($cat, "int"),
								  GetSQLValueString($cat, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
		?>
		<a href="productlist.php?id=<?php echo $row_ConsultaFuncion["idProducto"];?>"><?php echo $row_ConsultaFuncion["strNombre"];?></a><br>

		<?php
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function BrandsItems($marca)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT COUNT(idProducto) AS total FROM tblproducto WHERE refMarca=%s", 
								   GetSQLValueString($marca, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["total"];
	
	mysqli_free_result($ConsultaFuncion);
}

function CalculateProductCost($producto, $opcion=0)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT dblPrecio, refImpuesto FROM tblproducto WHERE idProducto=%s", 
								   GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if($opcion==0)	
	{
		$impuesto=0;
	
		if(_mostrarimpuesto==0)
		{
			$datoimpuesto=GetTax($row_ConsultaFuncion["refImpuesto"]);
			$impuesto=$row_ConsultaFuncion["dblPrecio"]*($datoimpuesto/100);
		}

		return number_format($row_ConsultaFuncion["dblPrecio"]+$impuesto, 2, ",", ".")."€";
	}
	
	if($opcion==1)	
	{
		return $row_ConsultaFuncion["dblPrecio"];
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function adminleveloption($padre, $pertenencia="")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblopcion WHERE refPadre=%s ",GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
		?>
			<tr>
				<td><?php echo $row_ConsultaFuncion["idOpcion"];?></td>
				<td><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></td>
				<td><?php echo ShowState($row_ConsultaFuncion["intEstado"]);?></td>
				<td><?php echo $row_ConsultaFuncion["intOrden"];?></td>
				<td><?php echo $row_ConsultaFuncion["dblIncremento"];?></td>
				<td>
					<a href="optiondetail-edit.php?id=<?php echo $row_ConsultaFuncion["idOpcion"];?>" class="btn btn-warning btn-circle" title="Edición de la Opción">
					<i class="fa fa-edit"></i></a>
				</td>
			</tr>
		<?php	
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function ShowOptionProductEdit($opcion, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproductoopcion WHERE refProducto=%s AND refOpcion=%s", 
									 GetSQLValueString($producto, "intt"), 
									 GetSQLValueString($opcion, "int"));
	
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0) 
		return '<a href="productooption-add.php?opcion='.$opcion.'&id='.$producto.'" title="Asignar al producto" type="button" class="btn btn-error btn-danger"><i class="fa fa-times"></i></a>';
	else
		return '<a href="productooption-delete.php?opcion='.$opcion.'&id='.$producto.'" title="No asignar al producto" type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></a>';
	
	mysqli_free_result($ConsultaFuncion);
}

function ShowOptions($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproductoopcion WHERE refProducto=%s", 
								   GetSQLValueString($producto, "int"));
	
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
			ShowOptionsProductSubOption($row_ConsultaFuncion["refOpcion"]);
		?>
			
			<br>

		<?php
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function ShowOptionsProductSubOption($opcion)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblopcion WHERE refPadre=%s AND intEstado=1 ORDER BY intOrden ASC", 
								   GetSQLValueString($opcion, "int"));
	
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{?>
		<b><?php echo GetNameOption($opcion);
			?></b>
		
			<select class="form-control" name="intOpcion-<?php echo $opcion;?>" id="intOpcion-<?php echo $opcion;?>">
		
		<?php
		do{?>
			<option value="<?php echo $row_ConsultaFuncion["idOpcion"];?>"><?php echo $row_ConsultaFuncion["strNombre"];?></option>
		<?php
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
		?>
			</select>
		<?php
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function GetNameOption($opcion)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblopcion WHERE idOpcion=%s",
		 GetSQLValueString($opcion, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return $row_ConsultaFuncion["strNombre"];
	else
		return "----";
	mysqli_free_result($ConsultaFuncion);
}

function CharacLevelOption($padre, $pertenencia="")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcaracteristica WHERE refPadre=%s ",GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
		?>
			<tr>
				<td><?php echo $row_ConsultaFuncion["idCaracteristica"];?></td>
				<td><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></td>
				<td><?php echo ShowState($row_ConsultaFuncion["intEstado"]);?></td>
				<td><?php echo $row_ConsultaFuncion["intOrden"];?></td>
				<td>
					<a href="characdetail-edit.php?id=<?php echo $row_ConsultaFuncion["idCaracteristica"];?>" class="btn btn-warning btn-circle" title="Edición de la Característica">
					<i class="fa fa-edit"></i></a>
				</td>
			</tr>
		<?php	
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function ShowCharacProductEdit($caracteristica, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcaracteristica WHERE refPadre=%s AND intEstado=1 ORDER BY intOrden ASC", 
								   GetSQLValueString($caracteristica, "int"));
	
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		//echo GetNameCharac($caracteristica);
		$actual=GetProductSelectedCharac($caracteristica, $producto);
		?>
		
			<select class="form-control" name="intCaracteristica-<?php echo $caracteristica;?>" id="intCaracteristica-<?php echo $caracteristica;?>">
			<option value="0" <?php if ($actual=="0") echo "selected"; ?>>No disponible</option>
			
		<?php
		do{?>
			<option value="<?php echo $row_ConsultaFuncion["idCaracteristica"];?>" <?php if ($actual==$row_ConsultaFuncion["idCaracteristica"]) echo "selected"; ?>><?php echo $row_ConsultaFuncion["strNombre"];?></option>
		<?php
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
		?>
			</select>
		<?php
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function GetNameCharac($caracteristica)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblcaracteristica WHERE idCaracteristica=%s",
		 GetSQLValueString($caracteristica, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return $row_ConsultaFuncion["strNombre"];
	else
		return "----";
	mysqli_free_result($ConsultaFuncion);
}

function GetProductSelectedCharac($caracteristica, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT refSeleccionada FROM tblproductocaracteristica WHERE refProducto=%s AND refCaracteristica=%s",
		 GetSQLValueString($producto, "int"),
		 GetSQLValueString($caracteristica, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return $row_ConsultaFuncion["refSeleccionada"];
	else
		return "0";
	mysqli_free_result($ConsultaFuncion);
}

function ShowCharacFrontEnd($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproductocaracteristica WHERE refProducto=%s", 
								   GetSQLValueString($producto, "int"));
	
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do
		{
			echo "<strong>".GetNameCharac($row_ConsultaFuncion["refCaracteristica"]).":</strong>";
			echo GetNameCharac($row_ConsultaFuncion["refSeleccionada"]);
			echo "<br>";
			//$actual=GetProductSelectedCharac($caracteristica, $producto);
		} while($row_ConsultaFuncion=mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function ShowBreadcrumbs($categoria)
{
	global $con;
	
	$nivel1="";
	$nivel2="";
	$nivel3="";
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE idCategoria = %s",
		 GetSQLValueString($categoria, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($row_ConsultaFuncion["refPadre"]!="0")
	{
		//ES DE SEGUNDO O TERCER NIVEL
		$query_ConsultaFuncion2 = sprintf("SELECT * FROM tblcategoria WHERE idCategoria = %s",
		 GetSQLValueString($row_ConsultaFuncion["refPadre"], "int"));
		//echo $query_ConsultaFuncion;
		$ConsultaFuncion2 = mysqli_query($con,  $query_ConsultaFuncion2) or die(mysqli_error($con));
		$row_ConsultaFuncion2 = mysqli_fetch_assoc($ConsultaFuncion2);
		$totalRows_ConsultaFuncion2 = mysqli_num_rows($ConsultaFuncion2);
		
		if ($row_ConsultaFuncion2["refPadre"]!="0")
		{
			//CONSIDERAMOS NIVEL 3
			$nivel2=$row_ConsultaFuncion2["strNombre"];
			$nivel3=$row_ConsultaFuncion["strNombre"];
			
			$query_ConsultaFuncion3 = sprintf("SELECT * FROM tblcategoria WHERE idCategoria = %s",
		 GetSQLValueString($row_ConsultaFuncion2["refPadre"], "int"));
		//echo $query_ConsultaFuncion;
		$ConsultaFuncion3 = mysqli_query($con,  $query_ConsultaFuncion3) or die(mysqli_error($con));
		$row_ConsultaFuncion3 = mysqli_fetch_assoc($ConsultaFuncion3);
		$totalRows_ConsultaFuncion3 = mysqli_num_rows($ConsultaFuncion3);
			
			$nivel1=$row_ConsultaFuncion3["strNombre"];
			
			
		}
		else
		{
			//CONSIDERAMOS NIVEL 2
			$nivel1=$row_ConsultaFuncion2["strNombre"];
			$nivel2=$row_ConsultaFuncion["strNombre"];
		}
		
		
		
	}
	else
	{
		//ES DE PRIMER NIVEL
		$nivel1=$row_ConsultaFuncion["strNombre"];
	}
	
	?>
	 	<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="index.php">Inicio</a></li>
			  <?php if ($nivel1!="") 
				echo '<li >'.$nivel1.'</li>'
				?>
				 <?php if ($nivel2!="") 
				echo '<li >'.$nivel2.'</li>'
				?>
				 <?php if ($nivel3!="") 
				echo '<li >'.$nivel3.'</li>'
				?>

			</ol>
		</div>
	<?php
	
	mysqli_free_result($ConsultaFuncion);
}

function GetUserName($usuario)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblusuario WHERE idUsuario=%s",GetSQLValueString($usuario, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["strNombre"];
		
	mysqli_free_result($ConsultaFuncion);
}

function IsAWish($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT idDeseo FROM tbldeseo WHERE refUsuario=%s AND refProducto=%s",
									 GetSQLValueString($_SESSION['tienda2020Front_UserId'], "int"),
									GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>=1) 
		return true;
	else
		return false;
	
	mysqli_free_result($ConsultaFuncion);
}

function IsInTheList($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT idComparar FROM tblcomparar WHERE refUsuario=%s AND refProducto=%s",
									 GetSQLValueString($_SESSION['tienda2020Front_UserId'], "int"),
									GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>=1) 
		return true;
	else
		return false;
	
	mysqli_free_result($ConsultaFuncion);
}

function ShowCharacCompare($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcaracteristica WHERE intEstado=1 AND refPadre=0 ORDER BY intOrden ASC");
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
			echo "<b>".GetNameCharac($row_ConsultaFuncion["idCaracteristica"])."</b><br>";
			echo GetCharacValue($row_ConsultaFuncion["idCaracteristica"], $producto);
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function GetCharacValue($caracteristica, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT refSeleccionada FROM tblproductocaracteristica WHERE refProducto=%s AND refCaracteristica=%s",
		 GetSQLValueString($producto, "int"),
		 GetSQLValueString($caracteristica, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return GetNameCharac($row_ConsultaFuncion["refSeleccionada"])."<br>";
	else
		return "--<br>";
	mysqli_free_result($ConsultaFuncion);
}

function InsertarUsuarioTemporal()
{
	global $con;
	
	$insertSQL = sprintf("INSERT INTO tblusuario (strNombre, strEmail, intEstado, strPassword, fchAlta) VALUES (%s, %s, %s, %s, NOW())",
                       GetSQLValueString("", "text"),
                       GetSQLValueString("", "text"),
                       GetSQLValueString(1, "int"),
                       GetSQLValueString("", "text"));
  $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
  return mysqli_insert_id($con);
}

function ImportarCarritoTemporal($valortemporal)
{
	
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT idContador FROM tblcarrito WHERE tblcarrito.refUsuario=%s AND tblcarrito.intTransaccionEfectuada = 0", GetSQLValueString($_SESSION['MM2_Temporal'], "int"));
	$ConsultaFuncion = mysqli_query($con, $query_ConsultaFuncion) or die(mysqli_error());
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	if ($totalRows_ConsultaFuncion>0){
		do{
		
		$updateSQL = sprintf("UPDATE tblcarrito SET refUsuario=%s WHERE idContador=%s AND intTransaccionEfectuada = 0",         $valortemporal, $row_ConsultaFuncion["idContador"]);
  
  		$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));
		
		} while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
}

function AddOptionsToCart($idcarrito, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblopcion WHERE intEstado=1 AND refPadre=0 ");
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			//BUSCO SOBRE tblproductoopcion para ver si tiene esa opcion activada
			
			$query_ConsultaOpcion = sprintf("SELECT * FROM tblproductoopcion WHERE refProducto=%s AND refOpcion=%s", 
					$producto,
					$row_ConsultaFuncion["idOpcion"]);
			//echo $query_ConsultaOpcion;
			$ConsultaOpcion = mysqli_query($con,  $query_ConsultaOpcion) or die(mysqli_error($con));
			$row_ConsultaOpcion = mysqli_fetch_assoc($ConsultaOpcion);
			$totalRows_ConsultaOpcion = mysqli_num_rows($ConsultaOpcion);
			
			//SI EXISTE COMO OPCION, HAY QUE AGREGARLA A LA TABLA RELACIONADA
			if ($totalRows_ConsultaOpcion==1)
				AddOptionToProduct($idcarrito, $row_ConsultaFuncion["idOpcion"]);
			
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function AddOptionToProduct($idcarrito, $opcion)
{
	global $con;
	
	$insertSQL = sprintf("INSERT INTO tblcarritodetalle (refCarrito, refOpcion, refOpcionSeleccionada) VALUES (%s, %s, %s)",
                       GetSQLValueString($idcarrito, "int"),
                       GetSQLValueString($opcion, "int"),
                       GetSQLValueString($_POST["intOpcion-".$opcion], "int"));
  $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
}

function comprobarexistencia($idproducto, $idusuario)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcarrito WHERE refUsuario = %s AND refProducto=%s AND intTransaccionEfectuada = 0", $idusuario,$idproducto );
	$ConsultaFuncion = mysqli_query($con, $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion >0) 
	{
		do{
		$valor=TestCartOptions($idproducto, $row_ConsultaFuncion["idContador"]);
		//EL PRODUCTO YA EXISTE EN EL CARRITO PENDIENTE, HAY QUE COMPROBAR QUE LAS OPCIONES SON LAS MISMAS
		if ($valor==1){
			return $row_ConsultaFuncion["idContador"];
			exit;
		}
		 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
	}
	else
	return 0;
	mysqli_free_result($ConsultaFuncion);
}

function TestCartOptions($producto, $idcompra)
{
	global $con;
	
	$coincide=1;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblopcion WHERE intEstado=1 AND refPadre=0 ");
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			//BUSCO SOBRE tblproductoopcion para ver si tiene esa opcion activada
			
			$query_ConsultaOpcion = sprintf("SELECT * FROM tblproductoopcion WHERE refProducto=%s AND refOpcion=%s", 
					$producto,
					$row_ConsultaFuncion["idOpcion"]);
			//echo $query_ConsultaOpcion;
			$ConsultaOpcion = mysqli_query($con,  $query_ConsultaOpcion) or die(mysqli_error($con));
			$row_ConsultaOpcion = mysqli_fetch_assoc($ConsultaOpcion);
			$totalRows_ConsultaOpcion = mysqli_num_rows($ConsultaOpcion);
			
			//SI EXISTE COMO OPCION, HAY QUE COMPROBAR SI TIENE EL MISMO VALOR QUE LA QUE ESTAMOS INTENTANDO INSERTAR
			if ($totalRows_ConsultaOpcion==1)
			{
				
				$query_ConsultaOpcion2 = sprintf("SELECT * FROM tblcarritodetalle WHERE refCarrito=%s AND refOpcion=%s", 
					$idcompra,
					$row_ConsultaFuncion["idOpcion"]);
			//echo $query_ConsultaOpcion;
			$ConsultaOpcion2 = mysqli_query($con,  $query_ConsultaOpcion2) or die(mysqli_error($con));
			$row_ConsultaOpcion2 = mysqli_fetch_assoc($ConsultaOpcion2);
			$totalRows_ConsultaOpcion2 = mysqli_num_rows($ConsultaOpcion2);
				
			$seleccionada=$row_ConsultaOpcion2["refOpcionSeleccionada"];
				if ($seleccionada!=$_POST["intOpcion-".$row_ConsultaFuncion["idOpcion"]])
				 {
					$coincide=0;
				 }

			}
	
				//AgregarOpcionAProducto($idcarrito, $row_ConsultaFuncion["idOpcion"]);
			
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	
	mysqli_free_result($ConsultaFuncion);
	return $coincide;
}

function GetTax($idImpuesto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT dblImpuesto FROM tblimpuesto WHERE idImpuesto=%s", 
								   GetSQLValueString($idImpuesto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["dblImpuesto"];
	
	mysqli_free_result($ConsultaFuncion);
}

function CalculateProductTax($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT dblPrecio, refImpuesto FROM tblproducto WHERE idProducto=%s", 
								   GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	$impuesto=GetTax($row_ConsultaFuncion["refImpuesto"]);
	
	return number_format($row_ConsultaFuncion["dblPrecio"]*($impuesto/100), 2, ",", ".");
	
	mysqli_free_result($ConsultaFuncion);
}

function ShowProductOptionsCart($lineacarrito)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcarritodetalle WHERE refCarrito=%s", 
								   GetSQLValueString($lineacarrito, "int"));
	
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
			echo GetNameOption($row_ConsultaFuncion["refOpcion"]).": ";
			echo GetNameOption($row_ConsultaFuncion["refOpcionSeleccionada"]);
		?>
			
			<br>

		<?php
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}

function ShowCartQuantity()
{
	global $con;
	
	if ((isset($_SESSION['tienda2020Front_UserId'])) || (isset($_SESSION['MM2_Temporal'])))
	{
		if ($_SESSION['MM2_Temporal']=="ELEVADO")
			$usuariotempoactivo=$_SESSION['tienda2020Front_UserId'];
		else
			$usuariotempoactivo=$_SESSION['MM2_Temporal'];
	}
	
	$query_ConsultaFuncion = sprintf("SELECT SUM(intCantidad) AS Total FROM tblcarrito WHERE refUsuario = %s AND intTransaccionEfectuada=0 ", 
	   GetSQLValueString($usuariotempoactivo, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	echo "(".$row_ConsultaFuncion["Total"].")";	
	
	mysqli_free_result($ConsultaFuncion);
}

function ZoneAdminLevelOption($padre, $pertenencia="")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblzona WHERE refPadre=%s ",GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0) 
	{
		do{
		?>
			<tr>
				<td><?php echo $row_ConsultaFuncion["idZona"];?></td>
				<td><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></td>
				<td><?php echo ShowState($row_ConsultaFuncion["intEstado"]);?></td>
				<td><?php echo $row_ConsultaFuncion["dblInferior"];?></td>
				<td><?php echo $row_ConsultaFuncion["dblSuperior"];?></td>
				<td><?php echo $row_ConsultaFuncion["dblIncremento"];?></td>
				<td>
					<a href="zonedetail-edit.php?id=<?php echo $row_ConsultaFuncion["idZona"];?>" class="btn btn-warning btn-circle" title="Edición de la Zona">
					<i class="fa fa-edit"></i></a>
				</td>
			</tr>
		<?php	
		} while($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	
	mysqli_free_result($ConsultaFuncion);
}
?>