<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/baja_usuario.css">
		<link rel="stylesheet" href="css/pie.css">
		<title>SCUMENT: Eliminación de Cuenta</title>
	</head>

	<body>
		<?php
			include_once ("cabecera.php");

		?>

		<p>¿Está seguro que desea eliminar su cuenta?</p>
		<p>Le recordamos que si elimina su cuenta sus pedidos y su información actual de la cuenta quedará registrada en nuestro servidor, simplemente pasará a estado inactivo.</p>
		
		<?php
			//añadimos los requires
			require ("gestionBD.php");
			require ("gestionarUsuarios.php");
			
		?>
		
		<div>
			<form action="gestionarBaja.php" method="post">
				<button class="baja" name="baja" type = "submit">
					<b>Eliminar su cuenta</b>
				</button>
			</form>
		</div>
		
		

		<?php
		
			
			
			include_once ("pie.php");
		?>

	</body>
</html>