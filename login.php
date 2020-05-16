<!DOCTYPE html>
<html lang="es">

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
		<br \>
		<br \>
		<?php
			include_once ("barra_lateral.php");
		?>

		<main>

			<?php
			session_start();

			include_once ("gestionBD.php");
			include ("gestionarUsuarios.php");
			include ("gestionarMenus.php");

			if (isset($_POST['submit'])) {
				$usuario = $_POST['login'];
				$contrasena = $_POST['contrasena'];

				$conexion = crearConexionBD();
				$num_usuarios = consultarUsuario($conexion, $usuario, $contrasena);
				$errores = validarLogin($conexion, $usuario, $contrasena);
				cerrarConexionBD($conexion);

				if (sizeof($errores) != 0 || $num_usuarios == 0) {
					echo "<div class=\"error\">";
					for ($i = 0; $i < count($errores); $i++) {
						print_r($errores[$i]);
						echo "<br>";
					}
					echo "</div>";
				} else {
					$_SESSION['login'] = $usuario;
					Header("Location: portada.php");
				}

			}
		?>

			<!-- The HTML login form -->
			<form id="formulario_login" action="login.php" method="post">
			<div>
				<label for="login">Usuario: </label>
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
			<br />
			<br />
			<a class="registrate_usuario" href="login_empleado.php">¿Eres Empleado?</a>
			<br />
			<br />
			<p>
				¿No estás registrado?
			</p>
			<a class="registrate_usuario" href="form_alta_usuario.php">¡Registrate como usuario!</a>
			<a class="registrate_empresa" href="form_alta_empresa.php">¡Registrate como empresa!</a>
		</main>

		<?php
		include_once ("pie.php");
		?>
	</body>
</html>
