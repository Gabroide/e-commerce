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
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<?php if ($row_DatosConsulta["strImagen1"]!=""){?>
									<img id="placeholder" src="images/products/<?php echo $row_DatosConsulta["strImagen1"];?>" alt="<?php echo $row_DatosConsulta["strNombre"];?>" data-big="images/products/<?php echo $row_DatosConsulta["strImagen1"];?>" />
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
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="New arrival" />
								<h2><?php echo $row_DatosConsulta["strNombre"];?></h2>
								<!--<p>Web ID: 1089772</p>-->
								<img src="images/product-details/rating.png" alt="" />
								<form name="formcompra" id="formcompra" method="post" action="cart-add.php">
									<span>
										<?php if($row_DatosConsulta["dblPrecioAnterior"]!=0){?>
											<span class="preciotachado"><?php echo $row_DatosConsulta["dblPrecioAnterior"]*$_SESSION["monedavalor"].$_SESSION["monedasimbolo"];?></span>
											<br>
											<br>
										<?php }?>
										<span><?php echo CalculateProductCost($row_DatosConsulta["idProducto"]);?></span>
										<label>Cantidad:</label>
										<input id="intCantidad" name="intCantidad" type="number" value="1" />
										<input id="refProducto" name="refProducto" type="hidden" value="<?php echo $row_DatosConsulta["idProducto"];?>"/>
										<button type="button" class="btn btn-fefault cart" onClick="document.formcompra.submit()">
											<i class="fa fa-shopping-cart"></i>
											Añadir
										</button>
									</span>
									<br>
									<?php ShowOptions($row_DatosConsulta["idProducto"]);?>
									<?php echo $row_DatosConsulta["strDescripcion"]; ?>
									<!--<p><b>Availability:</b> In Stock</p>
									<p><b>Condition:</b> New</p>
									<p><b>Brand:</b> E-SHOPPER</p>-->
									<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
								</form>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li  class="active"><a href="#details" data-toggle="tab">Detalles</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Productos similares</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li>
								<li><a href="#reviews" data-toggle="tab">Comentarios (XXX)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="col-sm-12">
								
									<?php ShowCharacFrontEnd($row_DatosConsulta["idProducto"]);?>
								
								</div>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
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
							</div>
							
							<div class="tab-pane fade" id="tag" >
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
							</div>
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
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
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html> 
<?php
//AÃ‘ADIR AL FINAL DE LA PÃGINA
mysqli_free_result($DatosConsulta);
?>