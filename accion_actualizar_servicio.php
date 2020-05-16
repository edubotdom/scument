<?php	
	session_start();	
	
	if (isset($_SESSION["servicio"])) {
		$producto = $_SESSION["servicio"];
		unset($_SESSION["servicio"]);
		
		require_once("gestionBD.php");
		require_once("gestionarProductos.php");
		
		$conexion = crearConexionBD();		
		//hace falta la funcion que actualiza los productos!!! (hace falta un formulario para que el empleado indique lo que quiere cambiar)
		$excepcion = modifica_precio_servicio($conexion, $servicio["PRECIO"], $servicio["ID_PRODUCTO"]); 
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "modificar_servicios.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: modificar_servicios.php");
	} 
	else Header("Location: modificar_servicios.php"); // Se ha tratado de acceder directamente a este PHP
?>
