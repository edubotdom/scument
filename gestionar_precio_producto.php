<?php
require_once ("requires/requires.php");
require_once ("gestionarProductos.php");
if(isset($_POST["precio_modificado"])){
	print_r($_POST["precio_modificado"]);
	print_r($_POST["id_producto"]);
	if(modifica_precio_producto($conexion,$_POST["precio_modificado"],$_POST["id_producto"])){
		Header("Location: modificar_productos.php");
	} else {
		Header("Location: excepcion.php");
	}
}

if(isset($_POST["eliminacion"])){
	if(eliminar_objeto($conexion, $_POST["id_producto"])){
		Header("Location: modificar_productos.php");
	} else {
		Header("Location: excepcion.php");
	}
}

?>