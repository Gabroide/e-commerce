<?php require_once('Connections/conexion.php'); 

if ($_SESSION['MM2_Temporal']=="ELEVADO")
{
	$usuariotempoactivo=$_SESSION['tienda2020Front_UserId'];
    $insertGoTo = "index.php";//"cart_list.php";
}
else
{
	$usuariotempoactivo=$_SESSION['MM2_Temporal'];
    $insertGoTo = "index.php";//"prealta.php";
}

switch($_GET["op"])
{
	case 1:
		$updateSQL = sprintf("UPDATE tblcarrito SET intCantidad=intCantidad+1 WHERE idContador=%s AND refUsuario=%s AND intTransaccionEfectuada=0",
                       			GetSQLValueString($_GET["id"], "int"),
							   	$usuariotempoactivo);

		//echo $updateSQL;
		$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));
		
		$insertGoTo = "cart.php";
		header(sprintf("Location: %s", $insertGoTo));
		smysqli_free_result($Result1);
		
		break;
	case 2:
		if($_GET["actual"]==1)
		{
			$query_Delete = sprintf("DELETE FROM tblcarrito WHERE idContador=%s AND refUsuario=%s AND intTransaccionEfectuada=0",
							   GetSQLValueString($_GET["id"], "int"),
							   $usuariotempoactivo);
			$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));

		}
		else
		{
			$updateSQL = sprintf("UPDATE tblcarrito SET intCantidad=intCantidad-1 WHERE idContador=%s AND refUsuario=%s AND intTransaccionEfectuada=0",
                       			GetSQLValueString($_GET["id"], "int"),
							   	$usuariotempoactivo);

			//echo $updateSQL;
			$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));
		}
		
		$insertGoTo = "cart.php";
		header(sprintf("Location: %s", $insertGoTo));
		smysqli_free_result($Result1);
		
		break;
	case 3:
		$query_Delete = sprintf("DELETE FROM tblcarrito WHERE idContador=%s AND refUsuario=%s AND intTransaccionEfectuada=0",
							   GetSQLValueString($_GET["id"], "int"),
							   $usuariotempoactivo);
		$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));

		  $insertGoTo = "cart.php";
		  header(sprintf("Location: %s", $insertGoTo));
		  mysqli_free_result($Result1);
		
		break;
	case 4:
	$query_Delete = sprintf("DELETE FROM tblcarrito WHERE  refUsuario=%s",
						   $usuariotempoactivo);
	$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));

	  $insertGoTo = "cart.php";
	  header(sprintf("Location: %s", $insertGoTo));
	  mysqli_free_result($Result1);

	break;
	}
?>