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

	if(!isset($_SESSION["zonaactiva"]))
		$_SESSION["zonaactiva"]=0;
	if(isset($_GET["zona"]))
		$_SESSION["zonaactiva"]=$_GET["zona"];
	
	$query_DatosZona = sprintf("SELECT * FROM tblzona WHERE intEstado=1 AND refPadre=0 ORDER BY strNombre");

	$DatosZona = mysqli_query($con,  $query_DatosZona) or die(mysqli_error($con));
	$row_DatosZona = mysqli_fetch_assoc($DatosZona);
	$totalRows_DatosZona = mysqli_num_rows($DatosZona);
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
    <script type="text/javascript">
		function MM_jumpMenu(targ,selObj,restore){ //v3.0
		  eval(targ+".location='cart.php?zona="+selObj.options[selObj.selectedIndex].value+"'");
		  if (restore) selObj.selectedIndex=0;
		}
    </script>
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
						$totalpeso=0;
						
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
									<p><?php 
									$pesoproducto=$row_DatosConsultaProducto["dblPeso"]*$row_DatosConsulta["intCantidad"];
									$precioproducto=CalculateProductCost($row_DatosConsultaProducto["idProducto"], 1); echo number_format($precioproducto, 2, ",", ".").$_SESSION["monedasimbolo"];?></p>
								</td>
								<td width="10%">
									<p><?php $impuestoproducto=CalculateProductTax($row_DatosConsultaProducto["idProducto"]); $totalimpuestos=$totalimpuestos+($impuestoproducto*$row_DatosConsulta["intCantidad"]); echo $impuestoproducto;?></p>
								</td>
								<td width="15%"><!--class="cart_quantity">-->
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href="operate-cart.php?id=<?php echo $row_DatosConsulta["idContador"];?>&op=1" title="Añadir"> + </a>
										<input readonly class="cart_quantity_input" type="text" name="quantity" value="<?php echo $row_DatosConsulta["intCantidad"];?>" autocomplete="off" size="2">
										<a class="cart_quantity_down" href="operate-cart.php?id=<?php echo $row_DatosConsulta["idContador"];?>&op=2&actual=<?php echo $row_DatosConsulta["intCantidad"];?>" title="Restar"> - </a>
									</div>
								</td>
								<td width="20%"><!--class="cart_total">-->
									<p class="cart_total_price"><?php $precioproductounidades=($precioproducto+$impuestoproducto) * $row_DatosConsulta["intCantidad"]; $totalsinimpuestos=$totalsinimpuestos+($precioproducto * $row_DatosConsulta["intCantidad"]); echo number_format($precioproductounidades, 2, ",", ".").$_SESSION["monedasimbolo"]; $totalcarrito=$totalcarrito+$precioproductounidades;?></p>
								</td>
								<td width="5%"> <!--class="cart_delete">-->
									<a class="cart_quantity_delete" href="operate-cart.php?id=<?php echo $row_DatosConsulta["idContador"];?>&op=3" title="Eliminar el producto del carrito"><i class="fa fa-times"></a>
								</td>
							</tr>
						<?php
									$totalpeso=$totalpeso+$pesoproducto;
								} while($row_DatosConsulta=mysqli_fetch_assoc($DatosConsulta)); ?>						
						</tbody>
					</table>
				</div>
				<a href="operate-cart.php?id=<?php echo $row_DatosConsulta["idContador"];?>&op=4" title="Vaciar el carrito" class="cart_quantity_delete"><b>Vaciar el Carrito</b></a>
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
				</div>
				<div class="row">
					<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<h3><label for="intZona">Seleccionar Zona para envío</label></h3>
							</li>
							<li>							
								<select name="intZona" class="form-control" id="intZona" onChange="MM_jumpMenu('parent',this,0)">
									<option value="0" <?php if ($_SESSION["zonaactiva"]==0) echo "selected";?> >Selecciona la Zona de envío</option>
									<?php do { ?>
									<option value="<?php echo $row_DatosZona["idZona"]?>" <?php if ($row_DatosZona["idZona"]==$_SESSION["zonaactiva"]) echo "selected"; ?>><?php echo $row_DatosZona["strNombre"]?></option>
				
									<?php } while ($row_DatosZona = mysqli_fetch_assoc($DatosZona)); ?>
								</select>
							<li>
						</ul>
						<form action="pay.php" method="post">
							<ul class="user_option">
								<li><label for="strNombre">Nombre Completo:</label>
									<input name="strNombre"  type="text" id="strNombre"  class="form-control"/>
						  		</li>
								<li><label for="strDireccion">Dirección:</label>
									<input name="strDireccion"  type="text" id="strDireccion"  class="form-control"/>
								</li>
								<li><label for="strProvincia">Provincia:</label>
									<input name="strProvincia"  type="text" id="strProvincia"  class="form-control"/>
								</li>
								<li><lable for="strPais">Pais:</label>
									<input name="strPais"  type="text" id="strPais"  class="form-control"/>
								</li>
								<li><label for="intCP">Código Postal:</label>
									<input name="intCP"  type="number" id="intCP"  class="form-control"/>
								</li>
								<li><label for="strEmail">E-mail:</label> 
									<input name="strEmail"  type="mail" id="strEmail"  class="form-control"/>
								</li>
								<li><label for="intTelefono">Teléfono:</label>
									<input name="intTelefono"  type="number" id="intTelefono"  class="form-control"/>
								</li><br>
								<li><label for="intPago">Forma de Pago:</label><br>
									<input name="intPago" type="radio" value="1" checked="checked"> Transferencia Bancaria<br>
									<input name="intPago" type="radio" value="2"> Paypal<br>
									<input name="intPago" type="radio" value="3"> VISA Santander<br>
									<input name="intPago" type="radio" value="4"> VISA Caixa
								</li>	
							</ul>
						<input name="botonpagar" type="submit" class="btn btn-default update" value="Pagar">
						</form>		
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>SubTotal<span><?php echo number_format($totalsinimpuestos, 2, ",", ".").$_SESSION["monedasimbolo"];?></span></li>
							<li>Impuesto<span><?php echo number_format($totalimpuestos, 2, ",", ".").$_SESSION["monedasimbolo"];?></span></li>
							<li>Transporte <span><?php $portescalculados=CalculateDelivering($totalpeso, $_SESSION["zonaactiva"]); echo number_format($portescalculados, 2, ",", ".").$_SESSION["monedasimbolo"];
								?></span></li>
							<li>Total <span><?php echo number_format($totalcarrito+$portescalculados, 2, ",", ".").$_SESSION["monedasimbolo"];?></span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
<!--/#do_action-->
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