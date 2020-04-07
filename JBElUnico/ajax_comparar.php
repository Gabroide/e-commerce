<?php
require_once('Connections/conexion.php');

if(isset($_POST["id"]) && !empty($_POST["id"])){
	
	//COMPROBAR QUE HAY 2 ELEMENTOS EN EL COMPARADOR
	$query_ConsultaFuncion = sprintf("SELECT refUsuario, idComparar FROM tblcomparar WHERE refUsuario=%s ",GetSQLValueString($_SESSION['tienda2020Front_UserId'], "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if($totalRows_ConsultaFuncion>0)
	{
		$primeraComparacion=$row_ConsultaFuncion["idComparar"];
	}
	
	if($totalRows_ConsultaFuncion<3)
	{
		 $insertSQL = sprintf("INSERT INTO tblcomparar(refUsuario, refProducto) VALUES (%s, %s)",
						   GetSQLValueString($_SESSION['tienda2020Front_UserId'], "int"),
						   GetSQLValueString($_POST["id"], "int")
						  );

	  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));
	}
	else
	{
		//ELIMINAMOS UN ELEMENTO DE LA TABLA
		$query_Delete = sprintf("DELETE FROM tblcomparar WHERE idComparar=%s AND refUsuario=%s",
							   GetSQLValueString($primeraComparacion, "int"), 
								GetSQLValueString($_SESSION["tienda2020Front_UserId"],"int"));
		$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));
		
		//AGREGAMOS NUEVO ELEMENTO AL COMPARADOR
		$insertSQL = sprintf("INSERT INTO tblcomparar(refUsuario, refProducto) VALUES (%s, %s)",
						   GetSQLValueString($_SESSION['tienda2020Front_UserId'], "int"),
						   GetSQLValueString($_POST["id"], "int")
						  );

	  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));
	}
	?>
		<li><a href="user-compare.php" style="color:#1A53A1"><i class="fa fa-bars"></i>En mi comparador</a></li>
	<?php
}
?>