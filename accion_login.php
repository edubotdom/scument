<?php
session_start();

include_once ('gestionarUsuarios.php');
require_once ("gestionBD.php");
//Resultados del login
$usuario['login'] = $_REQUEST['login'];
$usuario['contrasena'] = $_REQUEST['contrasena'];

$conexion = crearConexionBD();
$errores = validarLogin($conexion, $usuario);
cerrarConexionBD($conexion);

if (count($errores) > 0) {
	$_SESSION['errores'] = $errores;
	header('Location: login.php');
} else {
	unset($_SESSION['errores']);
	$_SESSION['login'] = $usuario['login'];
	header('Location: portada.php');
}
?>