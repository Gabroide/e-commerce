<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//La "p" antes de localhost indica que la conexiÃ³n es persistente (http://blog.ayzweb.com/tutorial/conexion-php-a-mysql-mysql_connect-o-mysql_pconnect-persistente)
//Copyright Jorge Vila 2015

if (!isset($_SESSION)) {
  session_start();
}

$hostname_con = "p:localhost";
$database_con = "tienda2020";
$username_con = "root";
$password_con = "";
$con = mysqli_connect($hostname_con, $username_con, $password_con, $database_con);
mysqli_set_charset($con, 'utf8');

if (is_file("includes/funciones.php")) 
	include("includes/funciones.php"); 
else
{
	include("../includes/funciones.php");
}
