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
					<a href="category.php?id=<?php echo $row_DatosConsultaCategorias["idCategoria"];?>">
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
	
	<div class="brands_products"><!--brands_products-->
		<h2>Brands</h2>
		<div class="brands-name">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
				<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
				<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
				<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
				<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
				<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
				<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
			</ul>
		</div>
	</div><!--/brands_products-->

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