<?php
//requiere ejecutar primero gestionBD.php para el acceso de los datos a la Base de Datos
require_once ("gestionBD.php");
require_once ("requires/requires.php");
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/catalogo_producto.css">
		<link rel="stylesheet" href="css/detalle_servicio.css">
		<title>MONDECOPY SL.</title>
	</head>
		<?php
		include_once ("cabecera.php");
		?>
	<body>
		<header>Servicios</header>
		 <?php crearMenu($conexion, $login); ?>
		 <main>
			
			<?php include_once ("barra_lateral.php"); ?>
			
			<article class="INFO_OBJETO">
				
				<div> 

				<div>
				<h1><?php $nombre = $_REQUEST["nombre"];
						echo "$nombre";
					?></h1>
				</div>
				<div>
				<p>Precio: <?php  	$precio = $_POST["precio"];
						echo "$precio";
					?></p>
				<p>Tipo Impositivo: <?php  $tipo_impositivo = $_POST["tipo_impositivo"];
						echo "$tipo_impositivo";
					?></p>
				<p>Tasa fija: <?php  	$tasa_fija = $_POST["tasa_fija"];
						echo "$tasa_fija";
					?></p>				
				<p>Precio del servicio: <?php  	$tipo_servicio = $_POST["tipo_servicio"];
						echo "$tipo_servicio";
					?></p>
				</div>
				<div>
				<p>Descripcion: <?php  	$descripcion = $_POST["descripcion"];
						echo "$descripcion";
					?></p>
				</div>
				
				
				</div>

				<form action="gestionarTransaccion.php" method="post">
				<input type="hidden" name="importe" id="importe"
				value="<?php echo "$precio"; ?>" />
				<input type="hidden" name="id_usuario" id="id_usuario"
				value="<?php echo getIdUsuario($conexion, $login)[0] ?>" />
				<input type="hidden" name="id_producto" id="id_producto"
				value="<?php echo $_REQUEST["id_producto"] ?>" />
				<input type="hidden" name="tipo_impositivo" id="tipo_impositivo"
				value="<?php echo "$tipo_impositivo" ?>" />
				<input type="hidden" name="tasa_fija" id="tasa_fija"
				value="<?php echo "$tasa_fija" ?>" />
				<input type="hidden" name="servicio" id="servicio"
				value="1" />
				<button class="compra" name="compra" type = "submit">
					<b>Confirmar solicitud de servicio</b>
				</button>
				</form>
				
			</article>
			
		</main>
	</body>
	<br>
		<?php
		include_once ("pie.php");
		?>
	<br>
</html>