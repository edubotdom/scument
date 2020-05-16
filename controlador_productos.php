<?php	
	session_start();
	
	if (isset($_REQUEST["id_producto"])){
		$producto["id_producto"] = $_REQUEST["id_producto"];
		$producto["precio"] = $_REQUEST["precio"];
		$producto["precio_alquiler"] = $_REQUEST["precio_alquiler"];
		$producto["descripcion"] = $_REQUEST["descripcion"];
		$producto["cantidad_total"] = $_REQUEST["cantidad_total"];
		$producto["dimensiones"] = $_REQUEST["dimensiones"];
		$producto["foto_url"] = $_REQUEST["foto_url"];
		$producto["nombre"] = $_REQUEST["nombre"];
		$producto["tipo_impositivo"] = $_REQUEST["tipo_impositivo"];
		$producto["tasa_fija"] = $_REQUEST["tasa_fija"];
		$producto["marca"] = $_REQUEST["marca"];
		$producto["fabricante"] = $_REQUEST["fabricante"];
		$producto["peso"] = $_REQUEST["peso"];
		
		
		$_SESSION["producto"] = $producto;
			
		if (isset($_REQUEST["actualizar"])) Header("Location: accion_actualizar_producto.php"); 
		else if (isset($_REQUEST["eliminar"])) Header("Location: accion_eliminar_producto.php"); 
	}
	else 
		Header("Location: modificar_productos.php");

?>
