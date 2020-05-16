<?php
session_start();

include_once ("gestionBD.php");
include ("gestionarEmpleados.php");
include ("gestionarMenus.php");

if (isset($_POST['submit'])) {
	$usuario = $_POST['login'];
	$contrasena = $_POST['contrasena'];

	$conexion = crearConexionBD();
	$num_empleados = consultarEmpleado($conexion, $usuario, $contrasena);
	cerrarConexionBD($conexion);

	if ($num_empleados == 0)
		$login = "error";
	else {
		$_SESSION['login'] = $usuario;
		Header("Location: panel_de_administracion.php");
	}
}
?>
<!DOCTYPE html>
<html lang="es">
	<?php
	include_once ("cabecera.php");
	?>

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/login.css">
		<title>SCUMENT: Inicio de sesión</title>
	</head>

	<body>

		<?php
		include_once ("cabecera.php");
		?>
		
		
		<main>
			
			
			
			<?php
			if (isset($login)) {
				echo "<div class=\"error\">";
				echo "Error en la contraseña o no existe el empleado.";
				echo "</div>";
			}
			?>

			<!-- The HTML login form -->
			<form id="formulario_login" action="login_empleado.php" method="post">
				<div>
					<label for="login">Empleado: </label>
					<input type="text" name="login" id="login" />
				</div>
				<br />
				<div>
					<label for="contrasena">Contraseña: </label>
					<input type="password" name="contrasena" id="contrasena" />
				</div>
				<br />
				<input type="submit" name="submit" value="submit" />
			</form>

			<p>Uso exclusivo de empleados</p> 
			<a class="registrate_empleado" href="form_alta_empleado.php">Registrarse como empleado</a>
		</main>

		<?php
		include_once ("pie.php");
		?>
	</body>
</html>
