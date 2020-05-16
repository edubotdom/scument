<?php
session_start();

require_once ("gestionBD.php");

//inicializamos los valores
if (!isset($_SESSION['formulario'])) {
	$formulario['dni_cif'] = "";
	$formulario['login'] = "";
	$formulario['nombre'] = "";
	$formulario['contrasena'] = "";
	$formulario['direccion'] = "";
	$formulario['correo_electronico'] = "";
	$formulario['telefono_movil'] = "";
	$formulario['fecha_nacimiento'] = "";
	
	// Guardamos los datos en la sesión
	$_SESSION["formulario"] = $formulario;
}
// Si ya existían valores, los cogemos para inicializar el formulario
else
	$formulario = $_SESSION["formulario"];

// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/form_alta_usuario.css">
		<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script src="js/validacion_accion_alta_usuario.js" type="text/javascript"></script>
		<title>SCUMENT: Alta de Empleados</title>
	</head>

	<body>
		
		<script>
		
			// Inicialización de elementos y eventos cuando el documento se carga completamente
			$(document).ready(function() {
				$("#alta_empleado").on("submit", function() {
					return validateForm();
				});
				/*
				// Manejador de evento para copiar automáticamente el email como nick del empleado
				$("#correo_electronico").on("input", function(){
					$("#contrasena").val($(this).val());
				});
				*/
	
				// Manejador de evento del color de la contraseña
				$("#contrasena").on("input", function() {
					passwordColor();
				});
			});
			
		</script>
		
		<?php
		include_once ("cabecera.php");
		?>

		<?php
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores) > 0) {
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach ($errores as $error)
				echo $error;
			echo "</div>";
		}
		?>

		<p>Los campos con <em>*</em> son necesarios:</p>
		
		<?php include_once ("barra_lateral.php"); ?>
		
		<!--para probar que funciona la validación de PHP comentar: onsubmit-->
		<form id="alta_empleado" method="get" action="accion_alta_empleado.php" onsubmit="return validateForm()" ><!--novalidate --> 
			
		<div>
		<label for="nombre">Nombre y Apellidos<em>*</em>:</label>
		<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre']; ?>" required/>
		</div>

		<div>
		<label for="login">Empleado<em>*</em>:</label>
		<input id="login" name="login" type="text" size="80" value="<?php echo $formulario['login']; ?>" required/>
		</div>

		<div>
		<label for="contrasena">Contraseña<em>*</em>:</label>
		<input type="password" name="contrasena" id="contrasena" input pattern=".{8,}" placeholder="Mínimo 8 caracteres entre letras y dígitos" value="<?php echo $formulario['contrasena']; ?>" required oninput="passwordValidation();"/>
		</div>
		
		<div>
		<label for="confirmcontrasena">Confirme su contraseña<em>*</em>: </label>
		<input type="password" name="confirmcontrasena" id="confirmcontrasena" input pattern=".{8,}" placeholder="Confirmación de contraseña" value="<?php echo $formulario['confirmcontrasena']; ?>" required oninput="passwordConfirmation();"/>
		</div>

		<div>
		<label for="correo_electronico">Correo electrónico<em>*</em>:</label>
		<input id="correo_electronico" name="correo_electronico" type="email" placeholder="usuario@dominio.extension" value="<?php echo $formulario['correo_electronico']; ?>" required/>
		</div>

		<div>
		<label for="direccion">Dirección:</label>
		<input id="direccion" name="direccion" type="text" size="80" value="<?php echo $formulario['direccion']; ?>"/>
		</div>

		<div>
		<label for="dni_cif">DNI<em>*</em>:</label>
		<input id="dni_cif" name="dni_cif" type="text" placeholder="12345678X"
		pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula"
		value="<?php echo $formulario['dni_cif']; ?>" required>
		</div>

		<div>
		<label for="telefono_movil">Telefono móvil:</label>
		<input id="telefono_movil" name="telefono_movil" type="text" pattern="^[6-7][0-9]{8}" placeholder="600000000" title="Nueve cifras que comiencen por 6 o 7." size="80" value="<?php echo $formulario['telefono_movil']; ?>"/>
		</div>

		<div<<label for="fecha_nacimiento">Fecha de nacimiento<em>*</em>:</label>
		<input type="date" id="fecha_nacimiento" name="fecha_nacimiento" min="1900-01-01" value="<?php echo $formulario['fecha_nacimiento']; ?>"/>
		</div>

		<div>
		<input type="submit" value="Registrarse" />
		</div>

		</form>

		<?php
			include_once ("pie.php");
		?>

	</body>
</html>
