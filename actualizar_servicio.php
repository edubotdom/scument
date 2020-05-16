<?php
//requiere ejecutar primero gestionBD.php para el acceso de los datos a la Base de Datos
//actualizar_producto = detalle_producto para empleados
require_once ("gestionBD.php");
require_once ("requires/requires_empleado.php");


if (isset($_SESSION["servicio"])){
		$libro = $_SESSION["servicio"];
		unset($_SESSION["servicio"]);
	}
?>


	
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/catalogo_servicio.css">
		<link rel="stylesheet" href="css/detalle_servicio.css">
		<title>MONDECOPY SL.</title>
	</head>
		<?php
		include_once ("cabecera_empleado.php");
		?>
	<body>
		<header>Actualizacion del servicio seleccionado.</header>
		<?php crearMenuEmpleado($conexion, $login); ?>
		 <main>
			
			<article class="INFO_SERVICIO">
								
				
				<div class="nombre">
					<?php  $nombre_servicio = $_POST["nombre"]; ?>
					<p>Nombre del servicio: <?php echo $nombre_servicio; ?></p>
				</div>
				
				<div class="boton_eliminar">
						<p>¡Tenga cuidado!, un servicio adquirido por un cliente no puede ser eliminado de la BBDD por seguridad.</p>
						<form id="eliminar" action="gestionar_precio_servicio.php" method="post">
							<input type="hidden" name="id_servicio" id="id_servicio"
								value="<?php echo $_POST["id_servicio"]; ?>" />
							<input type="hidden" name="eliminacion" id="eliminacion"
								value="1" />
	  							<input type="submit" value="Eliminar servicio">
							</form>
				</div>
			
				

				<div class="actualizar_precio">
							<p>Precio actual:<?php  $precio = $_REQUEST["precio"];
							echo "$precio"; ?> </p>
							
							<form id="actualizar" action="gestionar_precio_servicio.php" method="post">
								<input type="hidden" name="id_servicio" id="id_servicio"
								value="<?php echo $_POST["id_servicio"]; ?>" />
								<input type="text" name="precio_modificado" id="precio_modificado"/>
	  							<input type="submit" value="Actualizar el precio del servicio seleccionado.">
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