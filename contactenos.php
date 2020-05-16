<?php
require_once ("requires/requires.php");
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>MONDECOPY SL.</title>
		<link rel="stylesheet" href="css/contactenos.css">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
	</head>

	<?php
	include_once ("cabecera.php");
	?>
	<header id="seccion">
		<b>Contactenos</b>
	</header>
	<?php crearMenu($conexion, $login); ?>
	<br />
	<?php include_once ("barra_lateral.php"); ?>
	<body>
		<br />
		<br />
		<br />
		<p id="presentacion">
			Somos una pequeña empresa dedicada hace unos años al mantenimiento, venta y alquiler de todo tipo de productos de electrónica. Nuestros clientes nos avalan.
		</p>
		<p id="intro_tabla">
			Nuestro horario de tienda física:
		</p>
		<div class="horario">
			<table>
				<tr>
					<th>Horario</th>
					<th>Horario estándar</th>
					<th>Horario de verano</th>
				</tr>
				<tr>
					<td>L-V</td>
					<td>8:00-14:00</td>
					<td>8:00-14:00</td>
				</tr>
				<tr>
					<td>Sábados</td>
					<td>9:00-14:00</td>
					<td>9:30-13:30</td>
				</tr>
				<tr>
					<td>Domingos</td>
					<td>X</td>
					<td>X</td>
				</tr>
				<tr>
					<td>Festivos</td>
					<td>X</td>
					<td>X</td>
				</tr>
			</table>
		</div>

		<br />
		<br />
		<br />

		<div class="enlaces">
			<p>
				Acceda al resto de sitios web asociados: <a href="https://sites.google.com/site/mondecopysl/home">Sitio web</a>
				<a href="https://mondecopyslblog.blogspot.com/"> Blog</a>
			</p>
			<p>
				Puede contactar con nosotros a través de nuestro correo electrónico: <a href="mailto:mondecopy@gmail.com">Enviar correo</a>
			</p>
			
			<p>
				Información acerca de la página web: <a href="informacion_pagina_web.php">Información de la web</a>
			</p>

			<p>
				Nuestro teléfono de atención telefónica: 954064758
			</p>
			
			<p>
				Les dejamos acceso a la cuenta de Twitter de un proyecto asociado de los creadores de la página, por si fuese de su interés y para ponerse en contacto con los mismos.
			</p>
		</div>
		
	<div class="resultados">
		<a class="twitter-timeline" data-lang="es" data-width="300"
			data-height="500" data-theme="dark" data-link-color="#E95F28"
			href="https://twitter.com/goatbooks?ref_src=twsrc%5Etfw">GoatBooks</a>
		<script async src="https://platform.twitter.com/widgets.js"
			charset="utf-8"></script>
	</div>
		
	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>