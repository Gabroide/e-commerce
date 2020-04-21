<?php 
	$query_DatosCategoriasPrincipales = sprintf("SELECT * FROM tblcategoria WHERE intEstado=1 AND intPrincipal=1");
	$DatosCategoriasPrincipales = mysqli_query($con,  $query_DatosCategoriasPrincipales) or die(mysqli_error($con));
	$row_DatosCategoriasPrincipales = mysqli_fetch_assoc($DatosCategoriasPrincipales);
	$totalRows_DatosCategoriasPrincipales = mysqli_num_rows($DatosCategoriasPrincipales);

	if($totalRows_DatosCategoriasPrincipales>0){
?>

	<div class="category-tab"><!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<?php 
					$primeracatespecial=1;
					do {
				?>
					<li <?php if ($primeracatespecial==1){?>class="active"<?php }?>><a href="#cat<?php echo $row_DatosCategoriasPrincipales["idCategoria"];?>" data-toggle="tab"><?php echo $row_DatosCategoriasPrincipales["strNombre"];?></a></li>
				<?php
					$primeracatespecial++;
			  		 } while ($row_DatosCategoriasPrincipales = mysqli_fetch_assoc($DatosCategoriasPrincipales)); 
				?>
			</ul>
		</div>
		<div class="tab-content">
			<?php 
				$query_DatosCategoriasPrincipales = sprintf("SELECT * FROM tblcategoria WHERE intEstado=1 AND intPrincipal=1");
				$DatosCategoriasPrincipales = mysqli_query($con,  $query_DatosCategoriasPrincipales) or die(mysqli_error($con));
				$row_DatosCategoriasPrincipales = mysqli_fetch_assoc($DatosCategoriasPrincipales);
				$totalRows_DatosCategoriasPrincipales = mysqli_num_rows($DatosCategoriasPrincipales);
			?>
			<?php 
				$primeracatespecial=1;
				do {
			?>
			<div class="tab-pane fade <?php if ($primeracatespecial==1){?>active in<?php }?>" id="cat<?php echo $row_DatosCategoriasPrincipales["idCategoria"];?>" >
				<?php 					
						$categoriaparaver = $row_DatosCategoriasPrincipales["idCategoria"];

						$query_DatosConsultaProddeCategoriaEspecial = sprintf("SELECT idProducto  FROM tblproducto WHERE intEstado=1  AND (refCategoria1=".$categoriaparaver." OR refCategoria2=".$categoriaparaver." OR refCategoria3=".$categoriaparaver." OR refCategoria4=".$categoriaparaver." OR refCategoria5=".$categoriaparaver." ) ORDER BY idProducto ASC LIMIT 4");
						$DatosConsultaProddeCategoriaEspecial = mysqli_query($con,  $query_DatosConsultaProddeCategoriaEspecial) or die(mysqli_error($con));
						$row_DatosConsultaProddeCategoriaEspecial = mysqli_fetch_assoc($DatosConsultaProddeCategoriaEspecial);
						$totalRows_DatosConsultaProddeCategoriaEspecial = mysqli_num_rows($DatosConsultaProddeCategoriaEspecial);

						if ($totalRows_DatosConsultaProddeCategoriaEspecial>0){
							do {
				?>
				<div class="col-sm-3">
					<?php ShowProductExtra($row_DatosConsultaProddeCategoriaEspecial["idProducto"]);?>
				</div>
				<?php 
					} while ($row_DatosConsultaProddeCategoriaEspecial = mysqli_fetch_assoc($DatosConsultaProddeCategoriaEspecial)); 
				 }
				?>
			</div>
			<?php
				$primeracatespecial++;
		 	} while ($row_DatosCategoriasPrincipales = mysqli_fetch_assoc($DatosCategoriasPrincipales)); 
			?>
		</div>
	</div>				
<?php }?>