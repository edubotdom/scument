<?php
require_once ("requires/requires.php");

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/catalogo_producto.css">
		<link rel="stylesheet" href="css/barra_lateral.css">
		<!--<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>-->
		<!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		
		<title>MONDECOPY SL.</title>
	</head>
	<?php
	include_once ("cabecera.php");
	?>
	<body>
		<header>
			<b>Selector de precio</b>
		</header>
		<?php crearMenu($conexion, $login); ?>
		<br />
		
		<script>
		$(document).ready(function() {
			// Uso de AJAX con JQuery para cargar de manera asíncrona los municipios según la provincia seleccionada
			// Manejador de evento sobre el campo de provincias
			$("#selector_precio").keyup(function () {
				// Llamada AJAX con JQuery, pasándole el valor de la provincia como parámetro
        		$.get("cambio_productos.php", { precioSeleccionado: $("#selector_precio").val()}, function (data) {
        			// Borro los municipios que hubiera antes en el datalist
        			$("#mostrar_resultados").empty();
        			// Adjunto al datalist la lista de municipios devuelta por la consulta AJAX
        			$("#mostrar_resultados").append(data);
				});
    		});
  		});
		</script>
		
		<main>

<?php include_once ("barra_lateral.php"); ?>
			 

				<!--<form id="selector_precioForm" method="post">-->
					<p id="titulo_selector">Introduzca precio máximo de los productos que se muestran</p>
					<input type="number" name="selector_precio" id="selector_precio"/>
				<!--</form>-->
				<div id="mostrar_resultados">				

					<!-- Here the AJAX results are placed --> 
				
				</div>
				<!--
				<article class="OBJETOS">
				<form action="detalle_producto.php" method="post" target="_blank">
				<input type="hidden" name="id_producto" id="id_producto"
					value="<?php echo $fila[strtoupper("id_producto")]; ?>" />
				<input type="hidden" name="precio" id="precio"
					value="<?php echo $fila[strtoupper("precio")]; ?>" />
				<input type="hidden" name="precio_alquiler" id="precio_alquiler"
					value="<?php echo $fila[strtoupper("precio_alquiler")]; ?>" />
				<input type="hidden" name="descripcion" id="descripcion"
					value="<?php echo $fila[strtoupper("descripcion")]; ?>" />
				<input type="hidden" name="cantidad_total" id="cantidad_total"
					value="<?php echo $fila[strtoupper("cantidad_total")]; ?>" />
				<input type="hidden" name="dimensiones" id="dimensiones"
					value="<?php echo $fila[strtoupper("dimensiones")]; ?>" />								
				<input type="hidden" name="foto_url" id="foto_url"
					value="<?php echo $fila[strtoupper("foto_url")]; ?>" />
				<input type="hidden" name="nombre" id="nombre"
					value="<?php echo $fila[strtoupper("nombre")]; ?>" />
				<input type="hidden" name="tipo_impositivo" id="tipo_impositivo"
					value="<?php echo $fila[strtoupper("tipo_impositivo")]; ?>" />
				<input type="hidden" name="tasa_fija" id="tasa_fija"
					value="<?php echo $fila[strtoupper("tasa_fija")]; ?>" />
				<input type="hidden" name="marca" id="marca"
					value="<?php echo $fila[strtoupper("marca")]; ?>" />
				<input type="hidden" name="fabricante" id="fabricante"
					value="<?php echo $fila[strtoupper("fabricante")]; ?>" />
				<input type="hidden" name="peso" id="peso"
					value="<?php echo $fila[strtoupper("peso")]; ?>" />
				
				<button class="compra" name="compra" type = "submit">
					<b>Más información</b>
				</button>
				
				</form>
			</article>
				-->
		</main>
	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>