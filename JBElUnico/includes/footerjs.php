<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>


<script>
	function flyToElement(flyer, flyingTo) {
		var $func = $(this);
		var divider = 3;
		var flyerClone = $(flyer).clone();
		$(flyerClone).css({position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 1000});
		$('body').append($(flyerClone));
		var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width()/divider)/2;
		var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height()/divider)/2;

		$(flyerClone).animate({
			opacity: 0.4,
			left: gotoX,
			top: gotoY,
			width: $(flyer).width()/divider,
			height: $(flyer).height()/divider
		}, 700,
		function () {
			$(flyingTo).fadeOut('fast', function () {
				$(flyingTo).fadeIn('fast', function () {
					$(flyerClone).fadeOut('fast', function () {
						$(flyerClone).remove();
					});
				});
			});
		});
	}
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('.Adeseos').on('click',function(){
			//Scroll to top if cart icon is hidden on top
			$('html, body').animate({
				'scrollTop' : $(".destinodeseos").position().top
			}); 
			//Select item image and pass to the function

			var elemento = $(this).attr("id");
			var elemento = elemento.substring(5, elemento.length);
			//alert(elemento);
			var itemImg = document.getElementById("imagenproducto"+elemento);
			//alert(elemento);
			//var itemImg = $(this).parent().find('img').eq(0);
			flyToElement($(itemImg), $('.destinodeseos'));
			//INSERTAR COMO DESEO
			$.ajax({
				type:'POST',
				url:'ajax_deseo.php',
				data:'id='+elemento,
				success:function(html){
					$('#deseoli'+elemento).remove();
					//alert(html);
					$('#deseolista'+elemento).prepend(html);
				}
			}); 

		});
	});
</script>


<script type="text/javascript">
	function DeleteWish(producto){
		$.ajax({
			type: "POST",
			url:"ajax_quitar_deseo.php",
			data: 'id='+producto,
			success: function(resp)
			{  
				if (resp==1)
				{
					 $("#deseomostrado"+producto).hide("slow");
				}
			}
			});

	}
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('.Acomparar').on('click',function(){
			//Scroll to top if cart icon is hidden on top
			$('html, body').animate({
				'scrollTop' : $(".destinocomparar").position().top
			}); 
			//Select item image and pass to the function

			var elemento = $(this).attr("id");
			var elemento = elemento.substring(8, elemento.length);
			//alert(elemento);
			var itemImg = document.getElementById("imagenproducto"+elemento);
			//alert(elemento);
			//var itemImg = $(this).parent().find('img').eq(0);
			flyToElement($(itemImg), $('.destinocomparar'));
			//INSERTAR COMO DESEO
			$.ajax({
				type:'POST',
				url:'ajax_comparar.php',
				data:'id='+elemento,
				success:function(html){
					$('#compararli'+elemento).remove();
					//alert(html);
					$('#deseolista'+elemento).append(html);
				}
			}); 

		});
	});
</script>

<script type="text/javascript">
	function DeleteCompare(producto){
		$.ajax({
			type: "POST",
			url:"ajax_quitar_comparar.php",
			data: 'id='+producto,
			success: function(resp)
			{  
				if (resp==1)
				{
					 $("#deseomostrado"+producto).hide("slow");
				}
			}
			});

	}
</script>