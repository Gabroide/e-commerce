<?php require_once('../Connections/conexion.php'); RestringirAcceso("1");?>
<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsertar")) {

	$esprincipal=0;
	
	if(isset($_POST["intPrincipal"]) && ($_POST["intPrincipal"])=="1")
		$esprincipal=1;
	
	  $insertSQL = sprintf("INSERT INTO tblproducto(strNombre, refCategoria1, strImagen1, strDescripcion, dblPrecio, intEstado, refMArca, refCategoria2, refCategoria3, refCategoria4, refCategoria5, strImagen2, strImagen3, strImagen4, strImagen5, intPrincipal) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST["strNombre"], "text"),
						  GetSQLValueString($_POST["refCategoria1"], "int"),
						  GetSQLValueString($_POST["strImagen1"], "text"),
						  GetSQLValueString($_POST["strDescripcion"], "text"),
						  GetSQLValueString(ProcessComaCost($_POST["dblPrecio"]), "double"),
						  GetSQLValueString($_POST["intEstado"], "int"),
						  GetSQLValueString($_POST["refMarca"], "int"),
						  GetSQLValueString($_POST["refCategoria2"], "int"),
						   GetSQLValueString($_POST["refCategoria3"], "int"),
						  GetSQLValueString($_POST["refCategoria4"], "int"),
						  GetSQLValueString($_POST["refCategoria5"], "int"),
						  GetSQLValueString($_POST["strImagen2"], "text"),
						  GetSQLValueString($_POST["strImagen3"], "text"),
						  GetSQLValueString($_POST["strImagen4"], "text"),
						  GetSQLValueString($_POST["strImagen5"], "text"),
						  GetSQLValueString($esprincipal, "int"));


	  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));

	  $insertGoTo = "product-list.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  header(sprintf("Location: %s", $insertGoTo));
}

$query_DatosMarcas = sprintf("SELECT * FROM tblmarca WHERE intEstado=1 ORDER BY strMarca");

$DatosMarcas = mysqli_query($con,  $query_DatosMarcas) or die(mysqli_error($con));
$row_DatosMarcas = mysqli_fetch_assoc($DatosMarcas);
$totalRows_DatosMarcas = mysqli_num_rows($DatosMarcas);

?>              

<!DOCTYPE html>
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
<script src="../js/tinymce/tinymce.min.js"></script>

<script>
	tinymce.init({
	  selector: '#strDescripcion',
	  height: 300,
	  menubar: false,
	  plugins: [
		'advlist autolink lists link image charmap print preview anchor'
	  ],
	  toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link'
	});
</script>


 <div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
  <div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gestión de Productos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<a href="product-list.php" class="btn btn-outline btn-info" title="Volver atrás">Volver atrás</a>
			<br>
			<br>
           
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resultado
                        </div>
`                         <!-- /.panel-heading -->
                        <div class="panel-body">
                        	Añadir Producto
                        	<!-- /.table-responsive -->
                        </div>
                        <div class="panel-body">
                           <form role="form" action="product-add.php" method="post" id="forminsert" name="forminsert"> <!--onSubmit="javascript:return validarusuarioalta();">
                                        -->
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="strNombre">Nombre del Producto</label>
											<input class="form-control" placeholder="Esctibir Nombre del Producto" name="strNombre" id="strNombre">
										</div>
										<div class="form-group">
											<label for="strDescripcion">Descripción del Producto</label>
											<textarea name="strDescripcion" id="strDescripcion">Esctibir la Descripciónn del Producto</textarea>
										</div>
										<div class="form-group">
											<label for="dblPrecio">Precio del Producto</label>
											<input class="form-control" placeholder="Esctibir Precio del Producto" name="dblPrecio" id="dblPrecio">
										</div>
										<div class="form-group">
                                            <label>Mostrar en página principal</label>
 											<div class="checkbox">
												<label>
													<input type="checkbox" value="1" name="intPrincipal" id="intPrincipal">
													Marcar para mostrar el producto en la página principal de la tienda.
												</label>
											</div>
                                        </div>
										<div class="form-group">
											<label for="refMarca">Marca</label>
											<select class="form-control" name="refMarca" id="refMarca">
												<option value="0">Sin Marca</option>
												<?php do{?>
												<option value="<?php echo $row_DatosMarcas["idMarca"];?>"><?php echo $row_DatosMarcas["strMarca"];?></option>
												<?php } while($row_DatosMarcas=mysqli_fetch_assoc($DatosMarcas));?>
											</select>
										</div>

										<div class="form-group">
											<label for="intEstado">Estado</label>
											<select class="form-control" name="intEstado" id="intEstado">
												<option value="0">Inactivo</option>
												<option value="1" selected>Activo</option>
											</select>
										</div>
										<button type="submit" class="btn btn-success" value="Añadir">Añadir</button>                                        
										<input type="hidden" name="MM_insert" id="MM_insert" value="forminsertar">
                                    </div>
                                <!-- /.col-lg-6 (nested) -->
                                	<div class="col-lg-6">
                                		<div class="form-group">
											<label for="refCategoria1">Categoría 1</label>
											<select name="refCategoria1" class="form-control" id="refCategoria1">
												<?php dropdowncategoryProducts(0);?>
											</select>
										</div>
                                		<div class="form-group">
											<label for="refCategoria2">Categoría 2</label>
											<select name="refCategoria2" class="form-control" id="refCategoria2">
												<option value="0">Sin Categoría</option>
												<?php dropdowncategoryProducts(0);?>
											</select>
										</div>
                                		<div class="form-group">
											<label for="refCategoria3">Categoría 3</label>
											<select name="refCategoria3" class="form-control" id="refCategoria3">
												<option value="0">Sin Categoría</option>
												<?php dropdowncategoryProducts(0);?>
											</select>
										</div>
                                		<div class="form-group">
											<label for="refCategoria4">Categoría 4</label>
											<select name="refCategoria4" class="form-control" id="refCategoria4">
												<option value="0">Sin Categoría</option>
												<?php dropdowncategoryProducts(0);?>
											</select>
										</div>
                                		<div class="form-group">
											<label for="refCategoria5">Categoría 5</label>
											<select name="refCategoria5" class="form-control" id="refCategoria5">
												<option value="0">Sin Categoría</option>
												<?php dropdowncategoryProducts(0);?>
											</select>
										</div>
										<?php 
										//BLOQUE INSERCION IMAGEN
										//***********************
										//***********************
										//***********************									  //***********************
										//PARÁMETROS DE IMAGEN PRINCIPAL
										$nombrecampoimagen="strImagen1";
										$nombrecampoimagenmostrar="strImagenpic1";
										$nombrecarpetadestino="../images/products/"; //carpeta destino con barra al final
										$nombrecampofichero="file1";
										$nombrecampostatus="status1";
										$nombrebarraprogreso="progressBar1";
										$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
										$tiposficheropermitidos="jpg, png"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
										$limiteancho="530"; // En píxels, "0" significa cualquier tamaño permitido
										$limitealto="530"; // En píxels, "0" significa cualquier tamaño permitido

										$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

										//$cadenadeparametros="";


																			  ?>
										<div class="form-group">
											<label>Imagen Principal</label>
											<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
										</div> 
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
											<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
										</div>   
										<?php /*?>
										//***********************
										//***********************
										//***********************									  //***********************
										// FIN BLOQUE INSERCION IMAGEN
										<?php */?>    
										<?php 
										//BLOQUE INSERCION IMAGEN
										//***********************
										//***********************
										//***********************									  //***********************
										//PARÁMETROS DE IMAGEN
										$nombrecampoimagen="strImagen2";
										$nombrecampoimagenmostrar="strImagenpic2";
										$nombrecarpetadestino="../images/products/"; //carpeta destino con barra al final
										$nombrecampofichero="file2";
										$nombrecampostatus="status2";
										$nombrebarraprogreso="progressBar2";
										$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
										$tiposficheropermitidos="jpg, png"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
										$limiteancho="530"; // En píxels, "0" significa cualquier tamaño permitido
										$limitealto="530"; // En píxels, "0" significa cualquier tamaño permitido

										$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

										//$cadenadeparametros="";


																			  ?>
										<div class="form-group">
											<label>Imagen 2</label>
											<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
										</div> 
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
											<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
										</div>   
										<?php /*?>
										//***********************
										//***********************
										//***********************									  //***********************
										// FIN BLOQUE INSERCION IMAGEN
										<?php */?> 
										<?php 
										//BLOQUE INSERCION IMAGEN
										//***********************
										//***********************
										//***********************									  //***********************
										//PARÁMETROS DE IMAGEN
										$nombrecampoimagen="strImagen3";
										$nombrecampoimagenmostrar="strImagenpic3";
										$nombrecarpetadestino="../images/products/"; //carpeta destino con barra al final
										$nombrecampofichero="file3";
										$nombrecampostatus="status3";
										$nombrebarraprogreso="progressBar3";
										$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
										$tiposficheropermitidos="jpg, png"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
										$limiteancho="530"; // En píxels, "0" significa cualquier tamaño permitido
										$limitealto="530"; // En píxels, "0" significa cualquier tamaño permitido

										$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

										//$cadenadeparametros="";


																			  ?>
										<div class="form-group">
											<label>Imagen 3</label>
											<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
										</div> 
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
											<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
										</div>   
										<?php /*?>
										//***********************
										//***********************
										//***********************									  //***********************
										// FIN BLOQUE INSERCION IMAGEN
										<?php */?> 
										<?php 
										//BLOQUE INSERCION IMAGEN
										//***********************
										//***********************
										//***********************									  //***********************
										//PARÁMETROS DE IMAGEN
										$nombrecampoimagen="strImagen4";
										$nombrecampoimagenmostrar="strImagenpic4";
										$nombrecarpetadestino="../images/products/"; //carpeta destino con barra al final
										$nombrecampofichero="file4";
										$nombrecampostatus="status4";
										$nombrebarraprogreso="progressBar4";
										$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
										$tiposficheropermitidos="jpg, png"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
										$limiteancho="530"; // En píxels, "0" significa cualquier tamaño permitido
										$limitealto="530"; // En píxels, "0" significa cualquier tamaño permitido

										$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

										//$cadenadeparametros="";


																			  ?>
										<div class="form-group">
											<label>Imagen 4</label>
											<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
										</div> 
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
											<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
										</div>   
										<?php /*?>
										//***********************
										//***********************
										//***********************									  //***********************
										// FIN BLOQUE INSERCION IMAGEN
										<?php */?> 
										<?php 
										//BLOQUE INSERCION IMAGEN
										//***********************
										//***********************
										//***********************									  //***********************
										//PARÁMETROS DE IMAGEN
										$nombrecampoimagen="strImagen5";
										$nombrecampoimagenmostrar="strImagenpic5";
										$nombrecarpetadestino="../images/products/"; //carpeta destino con barra al final
										$nombrecampofichero="file5";
										$nombrecampostatus="status5";
										$nombrebarraprogreso="progressBar5";
										$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
										$tiposficheropermitidos="jpg, png"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
										$limiteancho="530"; // En píxels, "0" significa cualquier tamaño permitido
										$limitealto="53s0"; // En píxels, "0" significa cualquier tamaño permitido

										$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

										//$cadenadeparametros="";


																			  ?>
										<div class="form-group">
											<label>Imagen 5</label>
											<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
										</div> 
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
											<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
										</div>   
										<?php /*?>
										//***********************
										//***********************
										//***********************									  //***********************
										// FIN BLOQUE INSERCION IMAGEN
										<?php */?>
                                		                                                                            
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
