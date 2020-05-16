<?php
//requiere ejecutar primero gestionBD.php para el acceso de los datos a la Base de Datos
require_once ("gestionBD.php");
require_once ("requires/requires.php");
require("gestionarCarrito.php");
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/catalogo_producto.css">
		<link rel="stylesheet" href="css/detalle_producto.css">
		<title>MONDECOPY SL.</title>
	</head>
		<?php
		include_once ("cabecera.php");
		?>
	<body>
		<header>Información del producto seleccionado.</header>
		<?php crearMenu($conexion, $login); ?>
		 <main>
			
			<article class="INFO_OBJETO">
				
				<div class="foto">
					<?php  $foto_url = $_REQUEST["foto_url"]; ?>
					<img class="imagen_producto" src="fotos_productos/<?php echo "$foto_url"?>" alt="Mondecopy S.L.">
				</div>
				
				<div class="compra_alquiler">
					<?php  $cantidad_total = $_REQUEST["cantidad_total"];?>
					<?php if ($cantidad_total==0 || !isset($cantidad_total)){		//no está disponible?>		
						<p class="no_disponible">No se encuentra disponible</p>
					<?php }else{													//está disponible?>
						<p>Unidades disponibles: <?php echo "$cantidad_total"?></p>
						
						<p>Precio:<?php  $precio = $_REQUEST["precio"]; echo "$precio"; ?> </p>
						
						<div class="boton_compra">
							<form id="cantidad_seleccionada" method="post" action="carrito.php">
  								Seleccione la cantidad deseada:
	  							<input type="number" name="cantidad" id="cantidad" min="1" max=<?php echo "$cantidad_total" ?>>
	  							<input type="hidden" name="id_producto" id="id_producto" value="<?php echo $_POST["id_producto"];?>">
	  							<input type="submit" value="Añadir al carrito">
							</form>
							
						</div>
						
					<?php }?>
				</div>
				
				<div class="descripcion">
					<!--<p>Precio: <?php  $precio = $_POST["precio"];
						echo "$precio";
					?></p>
					-->
					
					<p>Tipo Impositivo: <?php  $tipo_impositivo = $_POST["tipo_impositivo"];
						echo "$tipo_impositivo";
					?></p>
					<p>Tasa fija: <?php  	$tasa_fija = $_POST["tasa_fija"];
						echo "$tasa_fija";
					?></p>
					<p>Marca: <?php  	$marca = $_POST["marca"];
						echo "$marca";
					?></p>
					<p>Fabricante: <?php  	$fabricante = $_POST["fabricante"];
						echo "$fabricante";
					?></p>
					<p>Peso: <?php  	$peso = $_POST["peso"];
						echo "$peso";
					?></p>
					<p>Dimensiones: <?php  	$dimensiones = $_POST["dimensiones"];
						echo "$dimensiones";
					?></p>
				
					<p>Precio del alquiler: <?php  	$precio_alquiler = $_POST["precio_alquiler"];
						echo "$precio_alquiler";
					?></p>
					
					<p>Descripcion: <?php  	$descripcion = $_POST["descripcion"];
						echo "$descripcion";
					?></p>
				</div>
				
				
			</article>
			
		</main>
	</body>
	<br>
		<?php
		include_once ("pie.php");
		?>
	<br>
</html>