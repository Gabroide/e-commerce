<?php 
	$_SESSION['MM_Username'] = "";
	$_SESSION['MM_UserGroup'] = "";	 
	$_SESSION['tienda2020_UserId'] = "";
	$_SESSION['tienda2020_Mail'] = "";
	$_SESSION['tienda2020_Nivel'] = "";

	unset($_SESSION['MM_Username']);
	unset($_SESSION['MM_UserGroup']);
	unset($_SESSION['tienda2020_UserId']);
	unset($_SESSION['tienda2020_Mail']);
	unset($_SESSION['tienda2020_Nivel']);

	header("Location: index.php");
?>
