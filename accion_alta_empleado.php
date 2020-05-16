<?php
session_start();

// Importar librerías necesarias para gestionar direcciones y géneros literarios
require_once ("gestionBD.php");
require_once ("gestionarEmpleados.php");

// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	$nuevoUsuario["dni_cif"] = $_REQUEST["dni_cif"];
	$nuevoUsuario["login"] = $_REQUEST["login"];
	$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
	$nuevoUsuario["contrasena"] = $_REQUEST["contrasena"];
	$nuevoUsuario["confirmcontrasena"] = $_REQUEST["confirmcontrasena"];
	$nuevoUsuario["direccion"] = $_REQUEST["direccion"];
	$nuevoUsuario["correo_electronico"] = $_REQUEST["correo_electronico"];
	$nuevoUsuario["fecha_nacimiento"] = $_REQUEST["fecha_nacimiento"];
	$nuevoUsuario["telefono_movil"] = $_REQUEST["telefono_movil"];

} else// En caso contrario, vamos al formulario
	Header("Location: form_alta_empleado.php");

// Guardar la variable local con los datos del formulario en la sesión.
$_SESSION["formulario"] = $nuevoUsuario;

// Validamos el formulario en servidor
$conexion = crearConexionBD();
$errores = validarDatosEmpleado($nuevoUsuario, $conexion);
alta_empleado($conexion, $nuevoUsuario);

// Si se han detectado errores
if (count($errores) > 0) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
	Header('Location: form_alta_empleado.php');
} else {

	// El usuario se logea
	$_SESSION['login'] = $nuevoUsuario["login"];
	
	// Ha sido un éxito la creación del usuario
	Header('Location: exito_alta_empleado.php');
}

cerrarConexionBD($conexion);

function validarDatosEmpleado($nuevoUsuario, $conexion) {

	$errores = array();
	
	// El usuario ya ha sido registrado anteriormente
	$user = getEmpleadoDNI($conexion, $nuevoUsuario['dni_cif']);
	if ($user['DNI_CIF'] == $nuevoUsuario['dni_cif']) {
		$errores[] = "<p>El dni/cif " . $user['DNI_CIF'] . " ya existe</p>";
	}

	// Validación del NIF
	if ($nuevoUsuario["dni_cif"] == "")
		$errores[] = "<p>El dni/cif no puede estar vacío</p>";
	else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["dni_cif"])) {
		$errores[] = "<p>El dni/cif debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["dni_cif"] . "</p>";
	}

	// Validación del Login
	$user = getEmpleado($conexion, $nuevoUsuario['login']);
	if ($user['LOGIN'] == $nuevoUsuario['login']) {
		$errores[] = "<p>El empleado " . $user['LOGIN'] . " ya existe</p>";
	}

	// Validación del Nombre
	if ($nuevoUsuario["nombre"] == "")
		$errores[] = "<p>El nombre no puede estar vacío</p>";

	// Validación del correo electronico
	if ($nuevoUsuario["correo_electronico"] == "") {
		$errores[] = "<p>El email no puede estar vacío</p>";
	} else if (!filter_var($nuevoUsuario["correo_electronico"], FILTER_VALIDATE_EMAIL)) {
		$errores[] = $error . "<p>El email es incorrecto: " . $nuevoUsuario["correo_electronico"] . "</p>";
	}

	// Validación de la contraseña
	if (!isset($nuevoUsuario["contrasena"]) || strlen($nuevoUsuario["contrasena"]) < 8) {
		$errores[] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
	} else if (!preg_match("/[a-z]+/", $nuevoUsuario["contrasena"]) || !preg_match("/[A-Z]+/", $nuevoUsuario["contrasena"]) || !preg_match("/[0-9]+/", $nuevoUsuario["contrasena"])) {
		$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
	} else if ($nuevoUsuario["contrasena"] != $nuevoUsuario["confirmcontrasena"]) {
		$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
	}
	
	// Validación del número de teléfono móvil (no es obligatorio, pero si se escribe, que esté validado)
	if( !preg_match("/^[0-9]{9}$/", $nuevoUsuario["telefono_movil"])){
		$errores[] = "<p>El número de teléfono móvil es opcional, pero debe incluir 9 números</p>";
	}


	return $errores;
}
?>