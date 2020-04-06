<?php require_once('Connections/conexion.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
}

if (isset($_POST['strEmail'])) {
  $loginUsername=$_POST['strEmail'];
  $password=md5($_POST['strPassword']);
  $MM_fldUserAuthorization = "intNivel";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "acceso_error.php";
  $MM_redirecttoReferrer = false;
  
  
  $LoginRS__query=sprintf("SELECT idUsuario, strEmail, strPassword, intNivel FROM tblusuario WHERE strEmail=%s AND strPassword=%s AND intEstado=1 AND intNivel=0",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysqli_query($con, $LoginRS__query) or die(mysqli_error($con));
  $row_LoginRS = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM2_Username'] = $loginUsername;
    $_SESSION['MM2_UserGroup'] = $loginStrGroup;	
    $_SESSION['MM2_IdUsuario'] = $row_LoginRS["idUsuario"];
	$_SESSION['tienda2020Front_UserId'] = mysqli_result($LoginRS,0,'idUsuario');
    $_SESSION['tienda2020Front_Mail'] = mysqli_result($LoginRS,0,'strEmail');
    $_SESSION['tienda2020Front_Nivel'] = mysqli_result($LoginRS,0,'intNivel');
	
	if (isset($_SESSION['MM2_Temporal'])){ 	
		//ImportarCarritoTemporal($_SESSION['MM_IdUsuario']);
	}
	$_SESSION['tienda2020Front_Temporal']="ELEVADO";
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>