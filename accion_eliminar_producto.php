<?php	
	session_start();	
	
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		unset($_SESSION["producto"]);
		
		require_once("gestionBD.php");
		require_once("gestionaProductos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = eliminar_objeto($conexion, $producto["ID_PRODUCTO"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_libros.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_libros.php");
	}
	else Header("Location: consulta_libros.php"); // Se ha tratado de acceder directamente a este PHP
?>
