<?php require_once('../Connections/conexion.php'); 
RestringirAcceso("1, 1");

//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$query_Delete = sprintf("DELETE FROM tblproductoopcion WHERE refProducto=%s AND refOpcion=%s", 
						GetSQLValueString($_GET["id"], "int"),
					   GetSQLValueString($_GET["opcion"], "int"));

$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));

$insertGoTo = "productoption-edit.php?id=".$_GET["id"];
header(sprintf("Location: %s", $insertGoTo));
mysqli_free_result($Result1);
?>