<?php
	require("requires/requires_empleado.php");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/panel_de_administracion.css">
		<title>MONDECOPY SL.</title>
	</head>
	
	<?php
		include_once ("cabecera_empleado.php");
	?>
	<header>
		<b>Panel de administración</b>
	</header>
	<?php crearMenuEmpleado($conexion, $login); ?>
	<body>
		<?php crearMenuPortadaEmpleado(); ?>
	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>