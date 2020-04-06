<?php require_once('Connections/conexion.php');

	$_SESSION['MM2_Username'] = "";
	$_SESSION['MM2_UserGroup'] = "";
	$_SESSION['MM2_idUsuario'] = "";
	$_SESSION['tienda2020Front_UserId'] = "";
	$_SESSION['tienda2020Front_Mail'] = "";
	$_SESSION['tienda2020Front_Nivel'] = "";
	$_SESSION['MM2_Temporal'] = "";
	$_SESSION['tienda2020Front_Temporal'] = "";

	unset($_SESSION['MM2_Username']);
	unset($_SESSION['MM2_UserGroup']);
	unset($_SESSION['MM2_idUsuario']);
	unset($_SESSION['tienda2020Front_UserId']);
	unset($_SESSION['tienda2020Front_Mail']);
	unset($_SESSION['tienda2020Front_Nivel']);
	unset($_SESSION['MM2_Temporal']);
	unset($_SESSION['tienda2020Front_Temporal']);

	header("Location: index.php");
?>
