<?php require_once('Connections/conexion.php');

if ((isset($_POST['intCaptcha'])) && ($_POST["intCaptcha"]==11))
{
	if (isset($_SESSION['tienda2020Front_UserId']))
	{
		$insertSQL = sprintf("INSERT INTO tblcomentario (refProducto, strFecha, refUsuario, strNombreComentador, txtComentario) VALUES (%s, NOW(), %s, %s, %s)",
						   GetSQLValueString($_POST["refProducto"], "int"),
						   GetSQLValueString($_SESSION['tienda2020Front_UserId'], "text"),
						   GetSQLValueString($_POST["strNombreComentador"], "text"),
						   GetSQLValueString($_POST['txtComentario'], "text"));

		$Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
	}
	else
	{
		$insertSQL = sprintf("INSERT INTO tblcomentario (refProducto, strFecha, strNombreComentador, txtComentario) VALUES (%s, NOW(), %s, %s)",
						   GetSQLValueString($_POST["refProducto"], "int"),
						   GetSQLValueString($_POST['strNombreComentador'], "text"),
						   GetSQLValueString($_POST['txtComentario'], "text"));

		$Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
	}
}    

header(sprintf("Location: ".$_POST["refURL"]));
?>