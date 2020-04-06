<?php
require_once('Connections/conexion.php');

if(isset($_POST["id"]) && !empty($_POST["id"])){
	
	 $insertSQL = sprintf("INSERT INTO tbldeseo(refUsuario, refProducto) VALUES (%s, %s)",
                       GetSQLValueString($_SESSION['tienda2020Front_UserId'], "int"),
                       GetSQLValueString($_POST["id"], "int")
					  );
  
  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));
	?>
		<li><a href="user-wishlist.php" style="color:#FF0004"><i class="fa fa-heart"></i>En mis deseos</a></li>
	<?php
}
?>