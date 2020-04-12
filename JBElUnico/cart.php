<?php require_once('Connections/conexion.php'); 

	if(isset($_SESSION['tienda2020Front_UserId']) || (isset($_SESSION['MM2_Temporal'])))
	{
		if ($_SESSION['MM2_Temporal']=="ELEVADO")
		{
			$usuariotempoactivo=$_SESSION['tienda2020Front_UserId'];
			$insertGoTo = "index.php";//"cart_list.php";
		}
		else
		{
			$usuariotempoactivo=$_SESSION['MM2_Temporal'];
			$insertGoTo = "index.php";//"prealta.php";
		}	
		
		$query_DatosConsulta = sprintf("SELECT * FROM tblcarrito WHERE refUsuario=%s AND intTransaccionEfectuada=0",
									   $usuariotempoactivo);

		$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
		$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
		$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);
	}
	else
	{
		
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
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Inicio</a></li>
				  <li class="active">Carrito de Compra</li>
				</ol>
			</div>
			<?php if($totalRows_DatosConsulta>0){ ?>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">Producto</td>
								<td class="description"></td>
								<td class="price">Precio</td>
								<td class="price">Impuesto</td>
								<td class="quantity">Cantidad</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
						
						<?php 
						$totalcarrito=0;
						$totalsinimpuestos=0;
						$totalimpuestos=0;
						
						do{ 
							$query_DatosConsultaProducto = sprintf("SELECT * FROM tblproducto WHERE idProducto=%s",
									   $row_DatosConsulta['refProducto']);

							$DatosConsultaProducto = mysqli_query($con,  $query_DatosConsultaProducto) or die(mysqli_error($con));
							$row_DatosConsultaProducto = mysqli_fetch_assoc($DatosConsultaProducto);
							$totalRows_DatosConsultaProducto = mysqli_num_rows($DatosConsultaProducto);
	
							$linkProduct="product-detail.php?id=".$row_DatosConsultaProducto["idProducto"];
							?>
							<tr>
								<td width="10%">
									<?php if ($row_DatosConsultaProducto["strImagen1"]!=""){?>
										<a href="<?php echo $linkProduct; ?>">
											<img src="images/products/<?php echo $row_DatosConsultaProducto["strImagen1"];?>" alt="<?php echo $row_DatosConsultaProducto["strNombre"];?>" title="<?php echo $row_DatosConsultaProducto["strNombre"];?>" id="imagenproducto<?php echo $row_DatosConsultaProducto["idProducto"];?>" width="70%">
										</a>
										<?php }
										else
										{?>
										<a href="<?php echo $linkProduct;?>">
											<img src="images/products/nodisponible.jpg" alt="Producto sin Imagen" id="imagenproducto<?php echo $row_DatosConsultaProducto["idProducto"];?>" width="30%">
										</a>
									<?php }?>
								</td>
								<td width="30%"> <!--class="cart_description">-->
									<h4><a href="<?php echo $linkProduct; ?>"><?php echo $row_DatosConsultaProducto["strNombre"];?></a></h4>
									<p><?php ShowProductOptionsCart($row_DatosConsulta["idContador"]);?></p>
								</td>
								<td width="10%"><!-- class="cart_price">-->
									<p><?php $precioproducto=CalculateProductCost($row_DatosConsultaProducto["idProducto"]); echo $precioproducto."€";?></p>
								</td>
								<td width="10%">
									<p><?php $impuestoproducto=CalculateProductTax($row_DatosConsultaProducto["idProducto"]); $totalimpuestos=$totalimpuestos+($impuestoproducto*$row_DatosConsulta["intCantidad"]); echo $impuestoproducto;?></p>
								</td>
								<td width="15%"><!--class="cart_quantity">-->
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href="operate-cart.php?id=<?php echo $row_DatosConsulta["idContador"];?>&op=1" title="Añadir"> + </a>
										<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $row_DatosConsulta["intCantidad"];?>" autocomplete="off" size="2">
										<a class="cart_quantity_down" href="operate-cart.php?id=<?php echo $row_DatosConsulta["idContador"];?>&op=2&actual=<?php echo $row_DatosConsulta["intCantidad"];?>" title="Restar"> - </a>
									</div>
								</td>
								<td width="20%"><!--class="cart_total">-->
									<p class="cart_total_price"><?php $precioproductounidades=($precioproducto+$impuestoproducto) * $row_DatosConsulta["intCantidad"]; $totalsinimpuestos=$totalsinimpuestos+($precioproducto * $row_DatosConsulta["intCantidad"]); echo number_format($precioproductounidades, 2, ",", ".")."€"; $totalcarrito=$totalcarrito+$precioproductounidades;?></p>
								</td>
								<td width="5%"> <!--class="cart_delete">-->
									<a class="cart_quantity_delete" href="operate-cart.php?id=<?php echo $row_DatosConsulta["idContador"];?>&op=3" title="Eliminar el producto del carrito"><i class="fa fa-times"></a>
								</td>
							</tr>
						<?php
								} while($row_DatosConsulta=mysqli_fetch_assoc($DatosConsulta)); ?>						
						</tbody>
					</table>
				</div>
				<a href="operate-cart.php?id=<?php echo $row_DatosConsulta["idContador"];?>&op=4" title="class="cart_quantity_delete"">Vaciar el Carrito</a>
			<?php }
			else
				echo "<br><br><h2>No tiene ningún producto en el carrito.</h2><br><br>";
			?>
		</div>
	</section> <!--/#cart_items-->
	
	<?php if($totalRows_DatosConsulta>0){ ?>
		<section id="do_action">
			<div class="container">
				<div class="heading">
					<h3>What would you like to do next?</h3>
					<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="chose_area">
							<ul class="user_option">
								<li>
									<input type="checkbox">
									<label>Use Coupon Code</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Use Gift Voucher</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Estimate Shipping & Taxes</label>
								</li>
							</ul>
							<ul class="user_info">
								<li class="single_field">
									<label>Country:</label>
									<select>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>

								</li>
								<li class="single_field">
									<label>Region / State:</label>
									<select>
										<option>Select</option>
										<option>Dhaka</option>
										<option>London</option>
										<option>Dillih</option>
										<option>Lahore</option>
										<option>Alaska</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>

								</li>
								<li class="single_field zip-field">
									<label>Zip Code:</label>
									<input type="text">
								</li>
							</ul>
							<a class="btn btn-default update" href="">Get Quotes</a>
							<a class="btn btn-default check_out" href="">Continue</a>
						</div>
					</div> 
					<div class="col-sm-6">
						<div class="total_area">
							<ul>
								<li>SubTotal <span><?php echo number_format($totalsinimpuestos, 2, ",", ".")."€"; ?></span></li>
								<li>Impuestos <span><?php echo number_format($totalimpuestos, 2, ",", ".")."€";?></span></li>
								<li>Envío <span>Free</span></li>
								<li>Total <span><?php echo number_format($totalcarrito, 2, ",", ".")."€"; ?></span></li>
							</ul>
								<a class="btn btn-default update" href="">Update</a>
								<a class="btn btn-default check_out" href="">Check Out</a>
						</div>
					</div>
				</div>
			</div>
		</section><!--/#do_action-->
	<?php }?>
<?php include("includes/footer.php"); ?>
<?php include("includes/footerjs.php"); ?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html> 
<?php
//AÃ‘ADIR AL FINAL DE LA PÃGINA
mysqli_free_result($DatosConsulta);
?>