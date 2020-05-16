<?php
	session_start();
	require_once("gestionBD.php");
	require_once("gestionarUsuarios.php");
	require_once("gestionarMenus.php");
	require_once("paginacion_consulta.php");
	//require_once("gestionarTransaccion.php");
	//require_once("gestionarProductos.php");
	//require_once("gestionarLineaTransaccion.php");
	$conexion = crearConexionBD();
	if(isset($_SESSION['login'])){
		$login = $_SESSION['login'];
	} else {
		$login = NULL;
	}
	cerrarConexionBD($conexion);
?>