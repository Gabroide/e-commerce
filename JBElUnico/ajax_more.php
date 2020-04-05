<?php
require_once('Connections/conexion.php');

if(isset($_POST["id"]) && !empty($_POST["id"])){
	$extraconsulta="";
	
	if(isset($_POST["cat"]) && !empty($_POST["cat"])){
		$extraconsulta="AND (refCategoria1=".$_POST['cat']." OR refCategoria2=".$_POST['cat']." OR refCategoria3=".$_POST['cat']." OR refCategoria4=".$_POST['cat']." OR refCategoria5=".$_POST['cat']." )";
	}
	
	$extraprincipal="";
	
	if(isset($_POST["principal"]) && !empty($_POST["principal"])){
		$extraprincipal="AND intPrincipal=1";
	}
	
	$extramarcas="";
	
	if(isset($_POST["brand"]) && !empty($_POST["brand"])){
		$extramarcas="AND intMarca=".$_POST["brand"];
	}
	
//Mostrados hasta ahora 
	$Totalmostrados = $_POST["id"]*$_POST["max"];
//Contar resultados menos los mostrados hasta ahora
$query_DatosConsulta = sprintf("SELECT COUNT(idProducto) AS Totalconsulta FROM tblproducto WHERE intEstado=1 ".$extramarcas." ".$extraprincipal." ".$extraconsulta);
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$allRows = $row_DatosConsulta["Totalconsulta"]-$Totalmostrados;	


//Hacer consulta para bloque siguiente
	
$query_DatosConsulta = sprintf("SELECT idProducto FROM tblproducto WHERE intEstado=1 ".$extramarcas." ".$extraprincipal." ".$extraconsulta." ORDER BY idProducto ASC LIMIT %s OFFSET %s", $_POST["max"], $Totalmostrados);
	//echo $query_DatosConsulta;
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$rowCount = mysqli_num_rows($DatosConsulta);

$tutorial_id = $_POST["id"]+1; 

//Si hay resultados, los mostramos
if($rowCount > 0){ 
    do{ 
        
		?>
		<div class="col-sm-4">
		<?php
			ShowProduct($row_DatosConsulta["idProducto"]);
		?>
</div>
		<?php
	} while($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta)) ?>
<?php 
	// SI QUEDAN MAS POR MOSTRAR PONEMOS EL BOTON DE VER MAS OTRA VEZ
	if($allRows > $_POST["max"]){ ?>
    <div style="text-align: center">
			<div class="btn btn-default add-to-cart" id="show_more_main<?php echo $tutorial_id; ?>">
        <span id="<?php echo $tutorial_id; ?>" class="show_more" title="Ver más productos">Ver más productos</span>
        <span class="loding" style="display: none;"><span class="loding_txt">Cargando productos....</span></span>
    </div> </div>
<?php } ?>  
<?php 
    } 
}
?>