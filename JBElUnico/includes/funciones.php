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


?>
