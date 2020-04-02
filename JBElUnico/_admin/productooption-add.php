<?php require_once('../Connections/conexion.php'); 
RestringirAcceso("1, 1");

//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$insertSQL = sprintf("INSERT INTO tblproductoopcion(refProducto, refOpcion) VALUES (%s, %s)",
						  GetSQLValueString($_GET["id"], "int"),
						  GetSQLValueString($_GET["opcion"], "int"));

$Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));

$insertGoTo = "productoption-edit.php?id=".$_GET["id"];
header(sprintf("Location: %s", $insertGoTo));
mysqli_free_result($Result1);
?>