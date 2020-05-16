<?php
//requiere ejecutar primero gestionBD.php para el acceso de los datos a la Base de Datos
//actualizar_producto = detalle_producto para empleados
require_once ("gestionBD.php");
require_once ("requires/requires_empleado.php");


if (isset($_SESSION["producto"])){
		$libro = $_SESSION["producto"];
		unset($_SESSION["producto"]);
	}
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
		include_once ("cabecera_empleado.php");
		?>
	<body>
		<header>Actualizacion del producto seleccionado.</header>
		<?php crearMenuEmpleado($conexion, $login); ?>
		 <main>
			
			<article class="INFO_OBJETO">
								
				<div class="foto">
					<?php  $foto_url = $_POST["foto_url"]; ?>
					<img class="imagen_producto" src="fotos_productos/<?php echo "$foto_url"?>" alt="Mondecopy S.L.">
				</div>
				<div class="nombre">
					<?php  $nombre_producto = $_POST["nombre"]; ?>
					<p>Nombre del producto: <?php echo $nombre_producto; ?></p>
				</div>
				
				<div class="boton_eliminar">
						<p>¡Tenga cuidado!, un producto adquirido por un cliente no puede ser eliminado de la BBDD por seguridad.</p>
						<form id="eliminar" action="gestionar_precio_producto.php" method="post">
							<input type="hidden" name="id_producto" id="id_producto"
								value="<?php echo $_POST["id_producto"]; ?>" />
							<input type="hidden" name="eliminacion" id="eliminacion"
								value="1" />
	  							<input type="submit" value="Eliminar producto">
							</form>
				</div>
			
				

				<div class="actualizar_precio">
							<p>Precio actual:<?php  $precio = $_REQUEST["precio"];
							echo "$precio"; ?> </p>
							
							<form id="actualizar" action="gestionar_precio_producto.php" method="post">
								<input type="hidden" name="id_producto" id="id_producto"
								value="<?php echo $_POST["id_producto"]; ?>" />
								<input type="text" name="precio_modificado" id="precio_modificado"/>
	  							<input type="submit" value="Actualizar el precio del producto seleccionado.">
							</form>
							
							
				</div>
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