<?php require_once('../Connections/conexion.php'); 
RestringirAcceso("1, 100");?>
                      
<?php
	 $updateSQL = sprintf("UPDATE tblmoneda SET intPrincipal=1 WHERE idMoneda=%s", GetSQLValueString($_GET["id"], "int"));

	//echo $updateSQL;
	$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));

  	$updateGoTo = "coin-list.php";
  	if (isset($_SERVER['QUERY_STRING'])) {
    	$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    	$updateGoTo .= $_SERVER['QUERY_STRING'];
  	}
  	header(sprintf("Location: %s", $updateGoTo));
?>