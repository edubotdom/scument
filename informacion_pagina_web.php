<?php
require_once ("requires/requires.php");
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>MONDECOPY SL.</title>
		<link rel="stylesheet" href="css/informacion_pagina_web.css">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
	</head>

	<?php
	include_once ("cabecera.php");
	?>
	<header id="seccion">
		<b>Información Página Web</b>
	</header>
	<?php crearMenu($conexion, $login); ?>
	<br />
	<?php include_once ("barra_lateral.php"); ?>
	<body>
		<br />
		<br />
		<br />
		<p id="descripcion">
			Esta página web es una herramienta para gestionar y/o comprar los diferentes productos y servicios que ofrece la empresa Mondecopy SL.
			Nuestra prioridad es la comodidad del cliente, de manera que teniendo Internet en cualquier dispositivo pueda contar con los servicios de nuestra empresa.
		</p>
		
		<p id="descripcion">Esta página web ha sido creada para la asignatura IISSI de 2ºIng. Inf. del Software en la US por las siguientes personas:</p>
		<table>
			<td>Daniel Arellano Martínez</td>
			<td>Eduardo Miguel Botía Domingo</td>
			<td>Juan Noguerol Tirado</td>
			<td>Javier Vázquez Zambrano</td>
		</table>
		<br />
		<br />
		<h2 id="titulo">
			Detalles de funcionamiento:
		</h2>
		<p id="descripcion">Para comenzar, en la web se pueden agregar al carrito los distintos productos con la cantidad deseada, de manera que cuando se desee, se realice la compra. En el caso de 
			servicios se realiza la compra directamente sin agregar dicho servicio al carrito. Para acceder a la compra es necesario autenticarse como usuario, en caso de que no se autentique puede crearse un nuevo usuario en la parte identificada como: ¡Registrese!</p>
		<p id="descripcion">También tenemos la opción de que pueda alquilar un producto para aquellos que dispongan de dicha opción.</p>
		<p id="descripcion">Por otra parte, ofrecemos información de nuestra tienda con un Mapa interactivo en "Localícenos" y disponemos de información acerca de la empresa y datos de contacto, de manera 
			que todo el que esté interesado pueda obtener información acerca de nuestra empresa.</p>
		<p id="descripcion">Cabe a destacar que cada producto/servicio posee una descripción para que usted esté informado en todo momento acerca de lo que compra/alquila.</p>
		<p id="descripcion">Para terminar, la página web es adaptable a cualquier dispositivo de manera que pueda acceder a nuestra web independientemente del dispositivo que use.</p>
	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>