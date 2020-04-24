	<?php require_once('Connections/conexion.php'); ?>
<?php
//MySQLi Fragmentos por http://www.dreamweaver-tutoriales.com
//Copyright Jorge Vila 2015

$variable_Consulta = "0";
if (isset($VARIABLE)) {
  $variable_Consulta = $VARIABLE;
}

$query_DatosConsulta = sprintf("SELECT * FROM tblproducto WHERE intEstado=1 AND strSEO=%s", GetSQLValueString($_GET["prod"], "text"));
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

//INSERTAR VISITA DE PRODUCTO
if (isset($_SESSION['tienda2020Front_UserId']))
	InsertProductViewed($row_DatosConsulta["idProducto"], $_SESSION['tienda2020Front_UserId']);

//COMENTARIOS
$query_DatosComentarios = sprintf("SELECT * FROM tblcomentario WHERE refProducto=%s AND intEstado=1 ORDER BY strFecha DESC", 
								  GetSQLValueString($row_DatosConsulta["idProducto"], "int"));

$DatosComentarios = mysqli_query($con,  $query_DatosComentarios) or die(mysqli_error($con));
$row_DatosComentarios = mysqli_fetch_assoc($DatosComentarios);
$totalRows_DatosComentarios = mysqli_num_rows($DatosComentarios);


//FINAL DE LA PARTE SUPERIOR
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
					<div class="product-details" itemscope itemtype="http://schema.org/Product"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<?php if ($row_DatosConsulta["strImagen1"]!=""){?>
									<img id="placeholder" src="images/products/<?php echo $row_DatosConsulta["strImagen1"];?>" alt="<?php echo $row_DatosConsulta["strNombre"];?>" data-big="images/products/<?php echo $row_DatosConsulta["strImagen1"];?>" itemprop="image"/>
								<?php }
									else
								{?>
									<img src="images/products/nodisponible.jpg" alt="Producto sin imagen" >
								<?php }?>
							</div>
							<div class="row">
								<div class="col-xs-4">
									<?php if ($row_DatosConsulta["strImagen1"]!=""){?>
										<a onclick="return showPic(this)" href="images/products/<?php echo $row_DatosConsulta["strImagen1"];?>" title="Mostrar esta imagen">
											<img src="images/products/<?php echo $row_DatosConsulta["strImagen1"];?>" alt="<?php echo $row_DatosConsulta["strNombre"];?>" id="" width="100%" >
										</a>
									<?php }?>
								</div>
								<div class="col-xs-4">
									<?php if ($row_DatosConsulta["strImagen2"]!=""){?>
										<a onclick="return showPic(this)" href="images/products/<?php echo $row_DatosConsulta["strImagen2"];?>" title="Mostrar esta imagen">
											<img src="images/products/<?php echo $row_DatosConsulta["strImagen2"];?>" alt="<?php echo $row_DatosConsulta["strNombre"];?>" title="<?php echo $row_DatosConsulta["strNombre"];?>" id="" width="100%">
										</a>
									<?php }?>
								</div>
								<div class="col-xs-4">
									<?php if ($row_DatosConsulta["strImagen3"]!=""){?>
										<a onclick="return showPic(this)" href="images/products/<?php echo $row_DatosConsulta["strImagen3"];?>" title="Mostrar esta imagen">
											<img src="images/products/<?php echo $row_DatosConsulta["strImagen3"];?>" alt="<?php echo $row_DatosConsulta["strNombre"];?>" title="<?php echo $row_DatosConsulta["strNombre"];?>" id="" width="100%">
										</a>
									<?php }?>
								</div>
								<div class="col-xs-4">
									<?php if ($row_DatosConsulta["strImagen4"]!=""){?>
										<a onclick="return showPic(this)" href="images/products/<?php echo $row_DatosConsulta["strImagen4"];?>" title="Mostrar esta imagen">
											<img src="images/products/<?php echo $row_DatosConsulta["strImagen4"];?>" alt="<?php echo $row_DatosConsulta["strNombre"];?>" title="<?php echo $row_DatosConsulta["strNombre"];?>" id="" width="100%">
										</a>
									<?php }?>
								</div>
								<div class="col-xs-4">
									<?php if ($row_DatosConsulta["strImagen5"]!=""){?>
										<a onclick="return showPic(this)" href="images/products/<?php echo $row_DatosConsulta["strImagen5"];?>" title="Mostrar esta imagen">
											<img src="images/products/<?php echo $row_DatosConsulta["strImagen5"];?>" alt="<?php echo $row_DatosConsulta["strNombre"];?>" title="<?php echo $row_DatosConsulta["strNombre"];?>" id="" width="100%">
										</a>
										<?php }?>
								</div>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="Novedad" />
								<h2 itemprop="name"><?php echo $row_DatosConsulta["strNombre"];?></h2>
								<!--<p>Web ID: 1089772</p>-->
								<img src="images/product-details/rating.png" alt="Valoración" />
								<form name="formcompra" id="formcompra" method="post" action="cart-add.php">
									<span>
										<?php if($row_DatosConsulta["dblPrecioAnterior"]!=0){?>
											<span class="preciotachado"><?php echo $row_DatosConsulta["dblPrecioAnterior"]*$_SESSION["monedavalor"].$_SESSION["monedasimbolo"];?></span>
											<br>
											<br>
										<?php }?>
										<span itemprop="price"><?php echo CalculateProductCost($row_DatosConsulta["idProducto"]);?></span>
										<label for="intCantidad">Cantidad:</label>
										<input id="intCantidad" name="intCantidad" type="number" value="1" />
										<input id="refProducto" name="refProducto" type="hidden" value="<?php echo $row_DatosConsulta["idProducto"];?>"/>
										<button type="button" class="btn btn-fefault cart" onClick="document.formcompra.submit()">
											<i class="fa fa-shopping-cart"></i>
											Añadir
										</button>
									</span>
									<br>
									<?php 
										if($row_DatosConsulta["refGrupo"]!=0)
											ShowGroupCost($row_DatosConsulta["refGrupo"]);
									?>									
									<?php ShowOptions($row_DatosConsulta["idProducto"]);?>
									<?php echo $row_DatosConsulta["strDescripcion"]; ?>
									<!--<p><b>Availability:</b> In Stock</p>
									<p><b>Condition:</b> New</p>
									<p><b>Brand:</b> E-SHOPPER</p>-->
								</form>
								<!-- Go to www.addthis.com/dashboard to customize your tools -->
							</div><!--/product-information-->
							<div class="addthis_inline_share_toolbox_7ge8" style="padding-left: 60px"></div>
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li  class="active"><a href="#details" data-toggle="tab">Detalles</a></li>
								<!--<li><a href="#companyprofile" data-toggle="tab">Productos similares</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li>
								--><li><a href="#reviews" data-toggle="tab">Comentarios (<?php echo GetCommentsAproved($row_DatosConsulta["idProducto"]);?>)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="col-sm-12" itemprop="description"><!-- LONG DESCRIPTION -->
									<?php ShowCharacFrontEnd($row_DatosConsulta["idProducto"]);?>
								</div>
							</div>
							
							<!--<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>-->
							
							<!--<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>-->
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<?php
									if($totalRows_DatosComentarios>0)
									{
										do{ 
									?>
										<ul>
											<li><span><i class="fa fa-user"></i>
												<?php
													if($row_DatosComentarios["refUsuario"]==0)
													{
														echo $row_DatosComentarios["strNombreComentador"];
													}
												?>
											</span></li>
											<li><span><i class="fa fa-clock-o"></i>
												<?php echo TimeToHumano($row_DatosComentarios["strFecha"]);?>
											</span></li>
											<li><span><i class="fa fa-calendar-o"></i>
												<?php echo DateToHumano($row_DatosComentarios["strFecha"]);?>
											</span></li>
										</ul>
										<p>
											<?php echo $row_DatosComentarios["txtComentario"];?>
										</p>
									<?php 
									   }while($row_DatosComentarios=mysqli_fetch_assoc($DatosComentarios));
									}
									?>
									<p><b>Deja un Comentario</b></p>
									
									<form action="product-detail-comment.php" method="post">
										<span>
											<?php if (isset($_SESSION['tienda2020Front_UserId'])){
											?>
												<input name="strNombreComentador" type="hidden"  id="strNombreComentador" value="Registrado"/>
											<?php }
											else
											{?>
												<label for="strNombreComentador">Nombre:</label>
												<input type="text" placeholder="Su nombre" required name="strNombreComentador" id="strNombreComentador"/>
											<?php }?> 
										</span>
										<label for="txtComentario">Comentario:</label>
										<textarea name="txtComentario" id="txtComentario" placeholder="Deje aquí su comentario" style="margin-top: 0;margin-bottom: 0;" required></textarea>
										<?php 
											if(isset($_SESSION["tienda2020Front_UserId"]))
											{
											?>
												<input name="intCaptcha" id="intCaptcha" type="hidden" value="11"/>
											<?php
											} 
											else
											{?>
												<label for="intCaptcha">5+6=</label>
												<input name="intCaptcha" id="intCaptcha" type="number" style="margin-top: 0"/>
											<?php }?>
										<!--<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										-->
										<input type="hidden" name="refProducto" id="refProducto" value="<?php echo $row_DatosConsulta["idProducto"];?>"/>
										<input type="hidden" name="refURL" id="refURL" value="<?php echo "http://". $_SERVER['SERVER_NAME'] .$_SERVER['REQUEST_URI'];?>"/>
										<input type="submit" class="btn btn-default pull-right" value="Enviar"/>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<?php include("includes/bestsellers.php"); ?>
	
				</div>
    </div>
  </div>
</section>
<?php include("includes/footer.php"); ?>
<?php include("includes/footerjs.php"); ?>
<script type="text/javascript" src="js/jquery.mlens-1.6.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
    $("#placeholder").mlens(
    {
        imgSrc: $("#placeholder").attr("data-big"),   // path of the hi-res version of the image
        lensShape: "circle",                // shape of the lens (circle/square)
        lensSize: 180,                  // size of the lens (in px)
        borderSize: 4,                  // size of the lens border (in px)
        borderColor: "#fff",                // color of the lens border (#hex)
        borderRadius: 0,                // border radius (optional, only if the shape is square)
		responsive: true      
    });
});

</script>
<script type="text/javascript" language="javascript">
function showPic (whichpic) {
 if (document.getElementById) {
  document.getElementById('placeholder').src = whichpic.href;
	 document.getElementById('placeholder').setAttribute("data-big", whichpic.href);
	 
	  $("#placeholder").mlens(
    {
        imgSrc: $("#placeholder").attr("data-big"),   // path of the hi-res version of the image
        lensShape: "circle",                // shape of the lens (circle/square)
        lensSize: 180,                  // size of the lens (in px)
        borderSize: 4,                  // size of the lens border (in px)
        borderColor: "#fff",                // color of the lens border (#hex)
        borderRadius: 0,                // border radius (optional, only if the shape is square)
		responsive: true      
    });
	 
	 
	 //$("#placeholder").attr("data-big") = whichpic.href;
  return false;
 } else {
  return true;
 }
}
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e9fe8b72ea1dab7"></script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html> 
<?php
//AÃ‘ADIR AL FINAL DE LA PÃGINA
mysqli_free_result($DatosConsulta);
?>