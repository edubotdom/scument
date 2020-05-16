<?php
require_once ("requires/requires.php");
require_once ("gestionarProductos.php");
if(isset($_POST["precio_modificado"])){
	print_r($_POST["precio_modificado"]);
	print_r($_POST["id_servicio"]);
	if(modifica_precio_servicio($conexion,$_POST["precio_modificado"],$_POST["id_servicio"])){
		Header("Location: modificar_servicios.php");
	} else {
		//Header("Location: excepcion.php");
	}
}

if(isset($_POST["eliminacion"])){
	if(eliminar_servicio($conexion, $_POST["id_servicio"])){
		Header("Location: modificar_servicios.php");
	} else {
		//Header("Location: excepcion.php");
	}
}

?>