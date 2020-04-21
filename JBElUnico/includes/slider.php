<?php 

$query_Slider = sprintf("SELECT * FROM tblslider WHERE intEstado=1 ORDER BY intOrden ASC");
$Slider = mysqli_query($con,  $query_Slider) or die(mysqli_error($con));
$row_Slider = mysqli_fetch_assoc($Slider);
$totalRows_Slider = mysqli_num_rows($Slider);


if ($totalRows_Slider>0){
$iniciar=0;
$bloqueslider="";
$bloquecontenido="";
$bloqueinicial='
	<section id="slider">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">';
$bloquefinal='</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section>';	
$bloqueintermedio='</ol>
						
						<div class="carousel-inner">';
	
do {
	if ($iniciar==0)
		$bloqueslider.='<li data-target="#slider-carousel" data-slide-to="'.$iniciar.'" class="active"></li>';
	else
		$bloqueslider.='<li data-target="#slider-carousel" data-slide-to="'.$iniciar.'" ></li>';
	
	if ($iniciar==0)
		$bloquecontenido.='<div class="item active">
								<div class="col-sm-6">
									'.$row_Slider["strTexto"].'
									<a class="btn btn-default get" href="'._strURL.$row_Slider["strLink"].'">Más información</a></button>
								</div>
								<div class="col-sm-6">
									<img src="images/slider/'.$row_Slider["strImagen"].'" class="girl img-responsive" alt="" />
									
								</div>
							</div>';
	else
		$bloquecontenido.='<div class="item">
								<div class="col-sm-6">
									'.$row_Slider["strTexto"].'
									<a class="btn btn-default get" href="'._strURL.$row_Slider["strLink"].'">Más información</a></button>
								</div>
								<div class="col-sm-6">
									<img src="images/slider/'.$row_Slider["strImagen"].'" class="girl img-responsive" alt="" />
									
								</div>
							</div>';

	$iniciar++;
	    } while ($row_Slider = mysqli_fetch_assoc($Slider)); 
	
	echo $bloqueinicial.$bloqueslider.$bloqueintermedio.$bloquecontenido.$bloquefinal;
}?>