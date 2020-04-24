<?php require_once('../Connections/conexion.php'); RestringirAcceso("1");?>

<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$msgsuccess=0;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsert")) {

	$marcas=0;
	$impuesto=0;
	
	if(isset($_POST["intMarcas"]) && ($_POST["intMarcas"])=="1")
		$marcas=1;
	if(isset($_POST["intImpuesto"]) && ($_POST["intImpuesto"])=="1")
		$impuesto=1;
	$pago1=0;
	if(isset($_POST["intTransferencia"]) && ($_POST["intTransferencia"])=="1")
		$pago1=1;
	$pago2=0;
	if(isset($_POST["intPaypal"]) && ($_POST["intPaypal"])=="1")
		$pago2=1;
	$pago3=0;
	if(isset($_POST["intCaixa"]) && ($_POST["intCaixa"])=="1")
		$pago3=1;
	$pago4=0;
	if(isset($_POST["intSantender"]) && ($_POST["intSantander"])=="1")
		$pago4=1;
	$pago5=0;
	if(isset($_POST["intGooglePay"]) && ($_POST["intGooglePay"])=="1")
		$pago5=1;
	$pago6=0;
	if(isset($_POST["intApplePay"]) && ($_POST["intApplePay"])=="1")
		$pago6=1;
	
  $updateSQL = sprintf("UPDATE tblconfiguracion SET strTelefono=%s, strEmail=%s, strLogo=%s, intMarcas=%s, intImpuesto=%s, strPaypal_url=%s, strPaypal_email=%s, strCaixa_url=%s, strCaixa_fuc=%s, strCaixa_terminal=%s, strCaixa_version=%s, strCaixa_clave=%s, strSantander_url=%s, strSantander_merchantid=%s, strSantander_secret=%s, strSantander_account=%s, intTransferencia=%s, intPaypal=%s, intCaixa=%s, intSantander=%s, intGooglePay=%s, intApplePay=%s, strURL=%s, dblDescuento=%s WHERE idConfiguracion=%s",
                       GetSQLValueString($_POST["strTelefono"], "text"),
					   GetSQLValueString($_POST["strEmail"], "text"),
					   GetSQLValueString($_POST["strLogo"], "text"),
					   GetSQLValueString($marcas, "int"),
					   GetSQLValueString($impuesto, "int"),
					   GetSQLValueString($_POST["strPaypal_url"], "text"),
					   GetSQLValueString($_POST["strPaypal_email"], "text"),
						GetSQLValueString($_POST["strCaixa_url"], "text"),
						GetSQLValueString($_POST["strCaixa_fuc"], "text"),
						GetSQLValueString($_POST["strCaixa_terminal"], "text"),
						GetSQLValueString($_POST["strCaixa_version"], "text"),
						GetSQLValueString($_POST["strCaixa_clave"], "text"),
						GetSQLValueString($_POST["strSantander_url"], "text"),
						GetSQLValueString($_POST["strSantander_merchantid"], "text"),
						GetSQLValueString($_POST["strSantander_secret"], "text"),
						GetSQLValueString($_POST["strSantander_account"], "text"),
						GetSQLValueString($pago1, "int"),
						GetSQLValueString($pago2, "int"),
						GetSQLValueString($pago3, "int"),
					    GetSQLValueString($pago4, "int"),
					    GetSQLValueString($pago5, "int"),
					   GetSQLValueString($pago6, "int"),
					   GetSQLValueString($_POST["strURL"], "text"),
					   GetSQLValueString(($_POST["dblDescuento"]), "double"),
					   	GetSQLValueString($_POST["idConfiguracion"], "int"));

//echo $updateSQL;
$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));

	$msgsuccess=1;
}

?>

<?php
$query_DatosConsulta = sprintf("SELECT * FROM tblconfiguracion WHERE idConfiguracion=1");

$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);
?><!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/Administracion.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    <!-- InstanceEndEditable -->
    <!-- Bootstrap Core CSS -->
    <?php include("../includes/adm-header.php"); ?>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<!-- InstanceBeginEditable name="ContenidoAdmin" -->
<script src="scriptupload.js"></script>
<script src="../js/script-admin.js"></script>
<div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
  <div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Configuración</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<!--<a href="user-list.php" class="btn btn-outline btn-info">Volver atrás</a>-->
			<br>
			<br>
           
           <?php if($msgsuccess==1){ ?>
           <div class="row">
               	<div class="col-lg-12">
			   		<div class="alert alert-success">
						Las modificaciones efectuadas se han guardado correctamente.</a>.
		   			</div>
			   	</div>
	  		</div>
          <?php }?>
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resultado
                        </div>
`                         <!-- /.panel-heading -->
                        <div class="panel-body">
                        	Editar Configuración
                        	<!-- /.table-responsive -->
                        </div>
                        <div class="panel-body">
							<form role="form" action="settings.php" method="post" id="forminsert" name="forminsert">
								<div class="row">
									<div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="strURL">Web</label>
                                            <input class="form-control" placeholder="http://pciexpress.com" name="strURL" id="strURL" value="<?php echo $row_DatosConsulta["strURL"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="strEmail">E-mail</label>
                                            <input class="form-control" placeholder="e-mail" name="strEmail" id="strEmail" value="<?php echo $row_DatosConsulta["strEmail"];?>">
                                        </div>                                   
                                        <div class="form-group">
                                            <label for="strTelefono">Teléfono</label>
                                            <input class="form-control" placeholder="Teléfono que saldrá en la parte superior" name="strTelefono" id="strTelefono" value="<?php echo $row_DatosConsulta["strTelefono"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Mostrar Marcas</label>
 											<div class="checkbox">
												<label>
													<input type="checkbox" value="1" name="intMarcas" id="intMarcas" <?php if ($row_DatosConsulta["intMarcas"]==1){ ?>checked="checked" <?php }?>>
													Marcar para mostrar el apartado de marcas en el menú de la izquierda
												</label>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label>Precios con Impuestos</label>
 											<div class="checkbox">
												<label>
													<input type="checkbox" value="1" name="intImpuesto" id="intImpuesto" <?php if ($row_DatosConsulta["intImpuesto"]==1){ ?>checked="checked" <?php }?>>
													Marcar para mostrar el precio con los Impuestos añadidos.
												</label>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dblDescuento">Descuento General</label>
                                            <input class="form-control" name="dblDescuento" id="dblDescuento" value="<?php echo $row_DatosConsulta["dblDescuento"];?>">
                                        </div>                                    
                                        <?php 
											//BLOQUE INSERCION IMAGEN
											//***********************
											//***********************
											//***********************									  //***********************
											//PARÁMETROS DE IMAGEN
											$nombrecampoimagen="strLogo";
											$nombrecampoimagenmostrar="strLogopic";
											$nombrecarpetadestino="../images/"; //carpeta destino con barra al final
											$nombrecampofichero="file1";
											$nombrecampostatus="status1";
											$nombrebarraprogreso="progressBar1";
											$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
											$tiposficheropermitidos="jpg,png"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
											$limiteancho="410"; // En píxels, "0" significa cualquier tamaño permitido
											$limitealto="160"; // En píxels, "0" significa cualquier tamaño permitido

											$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

											//$cadenadeparametros="";
										?>
										<div class="form-group">
											<label>Imagen de logo</label>
											<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>" value="<?php echo $row_DatosConsulta["strLogo"];?>">
										</div
										> 
										<div class="form-group">
											<div class="row">
												<div class="col-lg-6">
													<input type="file" name="<?php echo $nombrecampofichero;?>" id="<?php echo $nombrecampofichero;?>"><br>
												</div>
												<div class="col-lg-6">
													<input class="form-control" type="button" value="Subir Fichero" onclick="uploadFile(<?php echo $cadenadeparametros;?>)">
												</div>
											</div>
											<progress id="<?php echo $nombrebarraprogreso;?>" value="0" max="100" style="width:100%;"></progress>
											<h5 id="<?php echo $nombrecampostatus;?>"></h5>
											<?php if ($row_DatosConsulta["strLogo"]!=""){?>
											<img src="<?php echo $nombrecarpetadestino.$row_DatosConsulta["strLogo"];?>" alt="Logo" id="<?php echo $nombrecampoimagenmostrar;?>">
											<?php }
											else
											{?>
											<img src="../images/users/nouser.jpg" alt="sin logo" width="400"  id="<?php echo $nombrecampoimagenmostrar;?>">
											<?php }?>
										</div>   
										<?php /*?>
										//***********************
										//***********************
										//***********************									  //***********************
										// FIN BLOQUE INSERCION IMAGEN
										<?php */?>                                        
                                        </div>
									<!-- /.col-lg-6 (nested) -->
									<div class="col-lg-6">
										<div class="form-group">
											<label>Métodos de Pago</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="1" name="intTransferencia" id="intTransferencia" <?php if ($row_DatosConsulta["intTransferencia"]==1){ ?>checked="checked" <?php }?>>
													Transferencia Bancaria
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="1" name="intPaypal" id="intPaypal" <?php if ($row_DatosConsulta["intPaypal"]==1){ ?>checked="checked" <?php }?>>
													Paypal
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="1" name="intCaixa" id="intCaixa" <?php if ($row_DatosConsulta["intCaixa"]==1){ ?>checked="checked" <?php }?>>
													CaixaBank
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="1" name="intSantander" id="intSantander" <?php if ($row_DatosConsulta["intSantander"]==1){ ?>checked="checked" <?php }?>>
													Santander
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="1" name="intGooglePay" id="intGooglePay" <?php if ($row_DatosConsulta["intGooglePay"]==1){ ?>checked="checked" <?php }?>>
													GooglePay
												</label>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox" value="1" name="intApplePay" id="intApplePay" <?php if ($row_DatosConsulta["intApplePay"]==1){ ?>checked="checked" <?php }?>>
													ApplePay
												</label>
											</div>
										</div>
										<div class="form-group">
											<label for="strPaypal_url">Paypal url</label>
											<input class="form-control" placeholder="Introduce la url de Paypal" name="strPaypal_url" id="strPaypal_url" value="<?php echo $row_DatosConsulta["strPaypal_url"];?>">
										</div>
										<div class="form-group">
											<label for="strPaypal_email">Paypal Email</label>
											<input class="form-control" placeholder="Introduce el Email de Paypal" name="strPaypal_email" id="strPaypal_email" value="<?php echo $row_DatosConsulta["strPaypal_email"];?>">
										</div>
										<div class="form-group">
											<label for="strCaixa_url">CaixaBank url</label>
											<input class="form-control" placeholder="Introduce la url de CaixaBank" name="strCaixa_url" id="strCaixa_url" value="<?php echo $row_DatosConsulta["strCaixa_url"];?>">
										</div>
										<div class="form-group">
											<label for="strCaixa_fuc">CaixaBank fuc</label>
											<input class="form-control" placeholder="Introduce el fuc de CaixaBank" name="strCaixa_fuc" id="strCaixa_fuc" value="<?php echo $row_DatosConsulta["strCaixa_fuc"];?>">
										</div>
										<div class="form-group">
											<label for="strCaixa_terminal">CaixaBank Terminal</label>
											<input class="form-control" placeholder="Introduce el Terminal de CaixaBank" name="strCaixa_terminal" id="strCaixa_terminal" value="<?php echo $row_DatosConsulta["strCaixa_terminal"];?>">
										</div>
										<div class="form-group">
											<label for="strCaixa_version">CaixaBank Versión</label>
											<input class="form-control" placeholder="Introduce la versión de CaixaBank" name="strCaixa_version" id="strCaixa_version" value="<?php echo $row_DatosConsulta["strCaixa_version"];?>">
										</div>
										<div class="form-group">
											<label for="strCaixa_clave">CaixaBank Clave</label>
											<input class="form-control" placeholder="Introduce la clave de CaixaBank" name="strCaixa_clave" id="strCaixa_clave" value="<?php echo $row_DatosConsulta["strCaixa_clave"];?>">
										</div>
										<div class="form-group">
											<label for="strSantander_url">Santander url</label>
											<input class="form-control" placeholder="Introduce la url del Santander" name="strSantander_url" id="strSantander_url" value="<?php echo $row_DatosConsulta["strSantander_url"];?>">
										</div>
										<div class="form-group">
											<label for="strSantander_merchantid">Santander merchantId</label>
											<input class="form-control" placeholder="Introduce el merchantId del Santander" name="strSantander_merchantid" id="strSantander_merchantid" value="<?php echo $row_DatosConsulta["strSantander_merchantid"];?>">
										</div>
										<div class="form-group">
											<label for="strSantander_secret">Santander Secret</label>
											<input class="form-control" placeholder="Introduce el Secret del Santander" name="strSantander_secret" id="strSantander_secret" value="<?php echo $row_DatosConsulta["strSantander_secret"];?>">
										</div>
										<div class="form-group">
											<label for="strSantander_account">Cuenta del Santander</label>
											<input class="form-control" placeholder="Introduce la Cuenta del Santander" name="strSantander_account" id="strSantander_account" value="<?php echo $row_DatosConsulta["strSantander_account"];?>">
										</div>
										<button type="submit" class="btn btn-success" value="Actualizar">Actualizar</button>
                                        <input type="hidden" name="idConfiguracion" id="idConfiguracion" value="<?php echo $row_DatosConsulta["idConfiguracion"];?>">                                       
                                    	<input type="hidden" name="MM_insert" id="MM_insert" value="forminsert">
									</div>
									<!-- /.col-lg-6 (nested) -->
									
								</div>
							</form>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- InstanceEndEditable -->
<!-- /#wrapper -->

    <?php include("../includes/adm-footer.php"); ?>

    

</body>

<!-- InstanceEnd --></html>