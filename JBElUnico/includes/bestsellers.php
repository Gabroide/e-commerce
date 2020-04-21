<?php 
	$query_DatosVisitados = sprintf("SELECT tblcarrito.refProducto, Sum(tblcarrito.intCantidad) AS total FROM tblcarrito WHERE tblcarrito.intTransaccionEfectuada <>  '0' GROUP BY tblcarrito.refProducto ORDER BY total ASC LIMIT 6");
	$DatosVisitados = mysqli_query($con,  $query_DatosVisitados) or die(mysqli_error($con));
	$row_DatosVisitados = mysqli_fetch_assoc($DatosVisitados);
	$totalRows_DatosVisitados = mysqli_num_rows($DatosVisitados);

	$contadorproductos=1;


	if ($totalRows_DatosVisitados>0){
?>
	<div class="recommended_items"><!--recommended_items-->
		<h2 class="title text-center">Los más vendidos</h2>
		<div id="masvendidos-item-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
			<?php
		do {
				if 	($contadorproductos==1)	{ ?>			 
				<div class="item active">	
				<?php }
					if 	($contadorproductos==4)	{ ?>			 
					<div class="item">	
					<?php }?>
					<?php //echo $contadorproductos;?>
						<div class="col-sm-4">
							<?php ShowProductExtra($row_DatosVisitados["refProducto"]);?>
						</div>
					<?php 
				if ($contadorproductos==3)	{ ?>			 
					</div>	
				<?php }
					if ($contadorproductos==6)	{ ?>			 
				</div>	
				<?php }
					$contadorproductos++;
				 } while ($row_DatosVisitados = mysqli_fetch_assoc($DatosVisitados)); 

					if (($contadorproductos==2) ||($contadorproductos==3) || ($contadorproductos==6)|| ($contadorproductos==5)) echo "</div>";
				?>

			</div>
			 <a class="left recommended-item-control" href="#masvendidos-item-carousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			  </a>
			  <a class="right recommended-item-control" href="#masvendidos-item-carousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			  </a>			
		</div>
	</div>
<?php }?>