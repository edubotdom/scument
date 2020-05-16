<?php
	require("requires/requires.php");
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/portada.css">
		<title>MONDECOPY SL.</title>
	</head>
	
	<?php
		include_once ("cabecera.php");
	?>
	<header>
		<b>Inicio</b>
	</header>
	<?php crearMenu($conexion, $login); ?>
	<body>
		<?php crearMenuPortada(); ?>
	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>