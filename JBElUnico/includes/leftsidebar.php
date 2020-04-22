<?php 
	$query_DatosConsultaCategorias = sprintf("SELECT * FROM tblcategoria WHERE refPadre=0 AND intEstado=1 ORDER BY intOrden ASC");

	$DatosConsultaCategorias = mysqli_query($con,  $query_DatosConsultaCategorias) or die(mysqli_error($con));
	$row_DatosConsultaCategorias = mysqli_fetch_assoc($DatosConsultaCategorias);
	$totalRows_DatosConsultaCategorias = mysqli_num_rows($DatosConsultaCategorias);
?>


<div class="left-sidebar">
	<h2>Categorías</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		<?php 
			$solapa="apertura";
			$count=1;
			do{
				$solapaapertura=$solapa.$count;
		?>
		<div class="panel panel-default">
			<?php if(hassubcategories($row_DatosConsultaCategorias["idCategoria"])){ ?>
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $solapaapertura;?>">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						<?php echo $row_DatosConsultaCategorias["strNombre"];?>
					</a>
				</h4>
			</div>
			<div id="<?php echo $solapaapertura;?>" < class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
					<?php showsubcategories($row_DatosConsultaCategorias["idCategoria"]);?>
					</ul>
				</div>
			</div>
		<?php }
			else
			{
		?>
		<div class="panel-heading">
				<h4 class="panel-title">
					<a href="<?php echo GenerarRutaCategoria($row_DatosConsultaCategorias["idCategoria"]);?>">
						<?php echo $row_DatosConsultaCategorias["strNombre"];?>
					</a>
				</h4>
			</div>
		<?php }?>
		</div>
		<?php
				$count++;
			} while ($row_DatosConsultaCategorias = mysqli_fetch_assoc($DatosConsultaCategorias)); 
		?>
	</div><!--/category-products-->
	
	<?php if (isset($_GET["id"]) && !empty($_GET["id"])){
	//BUSCADOR POR CARACTERISTICAS
		$query_BuscadorProductos = sprintf("SELECT DISTINCT(tblproductocaracteristica.refCaracteristica) FROM tblproducto Inner Join tblproductocaracteristica ON tblproducto.idProducto = tblproductocaracteristica.refProducto WHERE intEstado=1 AND (refCategoria1=".$categoriaparaver." OR refCategoria2=".$categoriaparaver." OR refCategoria3=".$categoriaparaver." OR refCategoria4=".$categoriaparaver." OR refCategoria5=".$categoriaparaver." ) ORDER BY idProducto ASC"); 
		$BuscadorProductos = mysqli_query($con,  $query_BuscadorProductos) or die(mysqli_error($con));
		$row_BuscadorProductos = mysqli_fetch_assoc($BuscadorProductos);
		$totalRows_BuscadorProductos = mysqli_num_rows($BuscadorProductos);
	
	//LISTAMOS LAS CARACTERISTICAS Y MOSTRAMOS LAS OPCIONES DE CADA UNA DE ELLAS
	
		if ($totalRows_BuscadorProductos>0){
	?>
	<form name="buscadorextra" action="category.php" method="get">
		<div class="brands_products" style="color:#696763;">
			<h2>Características</h2>
				<div class="brands-name">
					<ul class="nav nav-pills nav-stacked">
					<?php
						do {
							$query_BuscadorCaracteristicas = sprintf("SELECT * FROM tblcaracteristica WHERE idCaracteristica=%s AND intEstado=1 ORDER BY intOrden ASC", $row_BuscadorProductos["refCaracteristica"]); 
							$BuscadorCaracteristicas = mysqli_query($con,  $query_BuscadorCaracteristicas) or die(mysqli_error($con));
							$row_BuscadorCaracteristicas = mysqli_fetch_assoc($BuscadorCaracteristicas);
							$totalRows_BuscadorCaracteristicas = mysqli_num_rows($BuscadorCaracteristicas);
							
							if ($totalRows_BuscadorCaracteristicas>0)
							{
								do {
						?>
					  		<li style="padding-left: 25px;font-weight: bold;">   <?php echo $row_BuscadorCaracteristicas["strNombre"];?></li>
								<?php 
									$query_BuscadorCaracteristicasDatos = sprintf("SELECT * FROM tblcaracteristica WHERE refPadre=%s AND intEstado=1 ORDER BY intOrden ASC", $row_BuscadorProductos["refCaracteristica"]); 
									$BuscadorCaracteristicasDatos = mysqli_query($con,  $query_BuscadorCaracteristicasDatos) or die(mysqli_error($con));
									$row_BuscadorCaracteristicasDatos = mysqli_fetch_assoc($BuscadorCaracteristicasDatos);
									$totalRows_BuscadorCaracteristicasDatos = mysqli_num_rows($BuscadorCaracteristicasDatos);
	
									if ($totalRows_BuscadorCaracteristicasDatos>0)
									{
										do {
								?>
							<li style="padding-left: 35px;">  <input name="opcion-<?php echo $row_BuscadorProductos["refCaracteristica"];?>" type="radio" value="<?php echo $row_BuscadorCaracteristicasDatos["idCaracteristica"];?>" <?php if (isset($_GET["opcion-".$row_BuscadorProductos["refCaracteristica"]])) {
				  				if ($_GET["opcion-".$row_BuscadorProductos["refCaracteristica"]]==$row_BuscadorCaracteristicasDatos["idCaracteristica"]){?>
				  					checked<?php 
				  				}
							}?>
	> 						<?php echo $row_BuscadorCaracteristicasDatos["strNombre"];?></li>
							<?php
	
							} while ($row_BuscadorCaracteristicasDatos = mysqli_fetch_assoc($BuscadorCaracteristicasDatos));?>
							<li style="padding-left: 35px;">  <input name="opcion-<?php echo $row_BuscadorProductos["refCaracteristica"];?>" type="radio" value="-1" 
								<?php if (isset($_GET["opcion-".$row_BuscadorProductos["refCaracteristica"]])) {
				  					if ($_GET["opcion-".$row_BuscadorProductos["refCaracteristica"]]=="-1"){?>
				  						checked<?php 
				  					}
								}
								else 
								{
									echo "checked";
								}?>> Todos</li>
							<?php
								}				
							?>
						<?php
							} while ($row_BuscadorCaracteristicas = mysqli_fetch_assoc($BuscadorCaracteristicas));
						}
					} while ($row_BuscadorProductos = mysqli_fetch_assoc($BuscadorProductos)); ?>
			</ul>			</div>
		</div>
		<input type="hidden" value="<?php echo $_GET["id"];?>" name="id">
		<div class="text-center">
			<button type="submit" class="btn btn-default">Filtrar</button></div>
	</form>					
	<?php }
		}
	//FIN BUSCADOR POR CARACTERISTICAS
	?>
	
	<?php
		$query_DatosConsultaMarcas = sprintf("SELECT * FROM tblmarca WHERE intEstado=1 ORDER BY intOrden ASC");

	
		$DatosConsultaMarcas = mysqli_query($con,  $query_DatosConsultaMarcas) or die(mysqli_error($con));
		$row_DatosConsultaMarcas = mysqli_fetch_assoc($DatosConsultaMarcas);
		$totalRows_DatosConsultaMarcas = mysqli_num_rows($DatosConsultaMarcas);

	?>
	
	<?php if(_marcas==1){?>
		<div class="brands_products"><!--brands_products-->
			<h2>Marcas</h2>
			<div class="brands-name">
				<ul class="nav nav-pills nav-stacked">
					<?php 
						do{
					?>
					<li><a href="category.php?brand=<?php echo $row_DatosConsultaMarcas["idMarca"]?>"> <span class="pull-right">(<?php echo BrandsItems($row_DatosConsultaMarcas["idMarca"]); ?>)</span><?php echo $row_DatosConsultaMarcas["strMarca"];?></a></li>
					<?php
						} while ($row_DatosConsultaMarcas = mysqli_fetch_assoc($DatosConsultaMarcas)); 
					?>	
				</ul>
			</div>
		</div><!--/brands_products-->
	<?php }?>

	<div class="price-range"><!--price-range-->
		<h2>Price Range</h2>
		<div class="well text-center">
			 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
			 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
		</div>
	</div><!--/price-range-->

	<div class="shipping text-center"><!--shipping-->
		<img src="images/home/shipping.jpg" alt="" />
	</div><!--/shipping-->

</div>