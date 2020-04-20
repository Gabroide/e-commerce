<?php require_once('Connections/conexion.php'); ?>
<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$variable_Consulta = "0";
if (isset($VARIABLE)) {
  $variable_Consulta = $VARIABLE;
}
$resultadosporclick=3;

if (isset($_GET["cat"]) && !empty($_GET["cat"]))
{
	//CONSULTAR ID DE SEO DE CATEGORIA ACTUAL
	$query_DatosSEO = sprintf("SELECT idCategoria FROM tblcategoria WHERE strSEO=%s",
				GetSQLValueString($_GET["cat"], "text") );
	$DatosSEO = mysqli_query($con,  $query_DatosSEO) or die(mysqli_error($con));
	$row_DatosSEO = mysqli_fetch_assoc($DatosSEO);
	$totalRows_DatosSEO = mysqli_num_rows($DatosSEO);

	$_GET["id"]=$row_DatosSEO["idCategoria"];


	$categoriaparaver=$_GET["id"];

	$query_DatosConsultaTotales = sprintf("SELECT COUNT(idProducto) AS TotalProductosConsulta FROM tblproducto WHERE intEstado=1  AND (refCategoria1=".$categoriaparaver." OR refCategoria2=".$categoriaparaver." OR refCategoria3=".$categoriaparaver." OR refCategoria4=".$categoriaparaver." OR refCategoria5=".$categoriaparaver." ) ORDER BY idProducto ASC");
	$DatosConsultaTotales = mysqli_query($con,  $query_DatosConsultaTotales) or die(mysqli_error($con));
	$row_DatosConsultaTotales = mysqli_fetch_assoc($DatosConsultaTotales);
	$totalRows_DatosConsultaTotales = mysqli_num_rows($DatosConsultaTotales);

	$totalresultados=$row_DatosConsultaTotales["TotalProductosConsulta"];

	$query_DatosConsulta = sprintf("SELECT idProducto FROM tblproducto WHERE intEstado=1 AND (refCategoria1=".$categoriaparaver." OR refCategoria2=".$categoriaparaver." OR refCategoria3=".$categoriaparaver." OR refCategoria4=".$categoriaparaver." OR refCategoria5=".$categoriaparaver." ) ORDER BY idProducto ASC LIMIT 0,".$resultadosporclick);
	$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
	$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
	$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

	}
	//FINAL DE LA PARTE SUPERIOR

	//PROCESAMIENTO DE MARCA
	if (isset($_GET["marca"]) && !empty($_GET["marca"])){

	//$categoriaparaver=$_GET["id"];

	$query_DatosConsultaTotales = sprintf("SELECT COUNT(idProducto) AS TotalProductosConsulta FROM tblproducto WHERE intEstado=1 AND refMarca=%s ORDER BY idProducto ASC",
									GetSQLValueString($_GET["marca"], "int"));

	$DatosConsultaTotales = mysqli_query($con,  $query_DatosConsultaTotales) or die(mysqli_error($con));
	$row_DatosConsultaTotales = mysqli_fetch_assoc($DatosConsultaTotales);
	$totalRows_DatosConsultaTotales = mysqli_num_rows($DatosConsultaTotales);

	$totalresultados=$row_DatosConsultaTotales["TotalProductosConsulta"];

	$query_DatosConsulta = sprintf("SELECT idProducto FROM tblproducto WHERE intEstado=1 AND refMarca=%s ORDER BY idProducto ASC LIMIT 0,".$resultadosporclick, GetSQLValueString($_GET["marca"], "int"));
	$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
	$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
	$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

}
?>
<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- InstanceBeginEditable name="doctitle" -->
    <title>Home | E-Shopper</title>
    <meta name="description" content="">
    <meta name="author" content="">
<!-- InstanceEndEditable -->
    <?php include("includes/head.php"); ?>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head><!--/head-->

<body>
<!-- InstanceBeginEditable name="contenido" -->
<?php include("includes/header.php"); ?>
<?php //include("includes/slider.php"); ?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php include("includes/leftsidebar.php"); ?>
      </div>
      <div class="col-sm-9 padding-right">
      	
      	<?php
		  if(isset($_GET["id"]) && !empty($_GET["id"])){
		  	ShowBreadcrumbs($categoriaparaver);
		  }?>
      	<?php
		  if(isset($_GET["brand"]) && !empty($_GET["brand"])){
		?>
  		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="index.php">Inicio</a></li>
			  <?php echo '<li>'.ShowBrand($_GET["brand"]).'</li>';?>
			</ol>
		</div>
  		<?php }?>
	  	
        <div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						
						<?php 
		//AQUI ES DONDE SE SACAN LOS DATOS, SE COMPRUEBA QUE HAY RESULTADOS
		if ($totalRows_DatosConsulta > 0) {  
			 do { 
				 ?>
				 <div class="col-sm-4">
					<?php ShowProduct($row_DatosConsulta["idProducto"]); ?>			
				</div>
				 
				 <?php
			
                  
              		 } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta));
			
			$tutorial_id=1;
			
			if($totalresultados>$resultadosporclick)
			{?>
			
			<div style="text-align: center">
				<div class="btn btn-default add-to-cart" id="show_more_main<?php echo $tutorial_id; ?>">
        			<span id="<?php echo $tutorial_id; ?>" class="show_more" title="Ver más productos">Ver más productos</span>
        			<span class="loding" style="display: none;"><span class="loding_txt">Cargando productos....</span></span>
    			</div>
    		</div>
			
		 <?php
			}
		} 
		else
		 { //MOSTRAR SI NO HAY RESULTADOS ?>
                No hay resultados.
                <?php } ?>

								
					</div>
       
        <?php //include("includes/categories.php"); ?>
        <?php //include("includes/recomended.php"); ?>
      </div>
    </div>
  </div>
</section>
<?php include("includes/footer.php"); ?>
<?php include("includes/footerjs.php"); ?>
<script>
	//CON BOTON PARA AVANZAR
	$(document).ready(function(){
		$(document).on('click','.show_more',function(){
			var ID = $(this).attr('id');
			$('.show_more').hide();
			$('.loding').show();
			$.ajax({
				type:'POST',
				url:'ajax_more.php',

				<?php if(isset($_GET["id"]) && !empty($_GET["id"])){ ?>
					data:'id='+ID+'&max=<?php echo $resultadosporclick;?>'+'&cat=<?php echo $categoriaparaver;?>',
				<?php }?>
				
				<?php if(isset($_GET["brand"]) && !empty($_GET["brand"])){ ?>
					data:'id='+ID+'&max=<?php echo $resultadosporclick;?>'+'&brand=<?php echo $_GET["brand"];?>',
				<?php }?>
				
				success:function(html){
					$('#show_more_main'+ID).remove();
					$('.features_items').append(html);
				}
			}); 
		});
	});
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html> 
<?php
//AÃ‘ADIR AL FINAL DE LA PÃGINA
mysqli_free_result($DatosConsulta);
?>