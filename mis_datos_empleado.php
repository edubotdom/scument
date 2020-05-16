<?php

require_once ("requires/requires_empleado.php");
?>
<?php
//Se comprueba si no existe en sesión ningún DNI y en tal caso se redirige a la página de login, en caso contrario se mete la sesión del DNI en la variable $dni
if (!isset($login)) {
	header('Location: login_empleado.php');
}

$datos = datosEmpleado($conexion, $login);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/cabecera.css">
<link rel="stylesheet" href="css/pie.css">
<link rel="stylesheet" href="css/mis_datos.css">

<title>MONDECOPY SL.</title>
</head>
<?php
include_once ("cabecera_empleado.php");
	?>
	<header id="parte">
			<b>Mis datos</b>
	</header>
		<body>
	<?php crearMenuEmpleado($conexion, $login); ?>
	<br>
	<br />
							<div class="mis_datos1">
							<h4>Datos personales</h4><hr></hr>
							<p><b>Nombre:</b> <?php echo $datos[strtoupper("nombre")]; ?></p>
							<p><b>Usuario:</b> <?php echo $datos[strtoupper("login")]; ?></p>
							<p><b>Fecha de ingreso:</b> <?php echo $datos[strtoupper("fecha_ingreso")]; ?></p>
							<p><b>DNI:</b> <?php echo $datos[strtoupper("dni_cif")]; ?> </p>
							<p><b>Dirección:</b> <?php echo $datos[strtoupper("direccion")]; ?></p>
							<p><b>Salario:</b> <?php echo $datos[strtoupper("salario")] . "€"; ?></p>
							<p><b>Fecha de Nacimiento:</b> <?php echo $datos[strtoupper("fecha_nacimiento")]; ?></p>
							<p><b>Fecha de vinculación:</b> <?php echo $datos[strtoupper("fecha_vinculacion")]; ?></p>
							</div>
							
							<div class="mis_datos2">
							<h4>Datos de contacto</h4><hr></hr>
							<p><b>Correo electrónico:</b> <?php echo $datos[strtoupper("correo_electronico")]; ?></p>
							<p><b>Telefono movil:</b> <?php echo $datos[strtoupper("telefono_movil")]; ?></p>
							</div>
	<br />
	<br />
	<br />
	<br />
	<br />						
				
	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>