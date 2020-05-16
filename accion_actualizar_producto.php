<?php	
	session_start();	
	
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		unset($_SESSION["producto"]);
		
		require_once("gestionBD.php");
		require_once("gestionarProductos.php");
		
		$conexion = crearConexionBD();		
		//hace falta la funcion que actualiza los productos!!! (hace falta un formulario para que el empleado indique lo que quiere cambiar)
		$excepcion = modifica_precio_producto($conexion, $producto["PRECIO"], $producto["ID_PRODUCTO"]); 
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "modificar_productos.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: modificar_productos.php");
	} 
	else Header("Location: modificar_productos.php"); // Se ha tratado de acceder directamente a este PHP
?>
