<?php
function agregar_al_carrito($producto) {

	if (isset($_SESSION["carrito"])) {// ya ha agregado antes el cliente

		//se extrae el carrito de $_SESSION
		$carrito = $_SESSION["carrito"];

		//se borra dicho dato de $_SESSION
		unset($_SESSION["carrito"]);

		//se agrega $producto a $carritoS
		array_push($carrito, $producto);

	} else {// no ha agregado nada el cliente

		//se agrega $producto como primer elemento del array $carrito
		$carrito = array($producto);

	}

	//se agrega carrito a $_SESSION
	$_SESSION["carrito"] = $carrito;
}

function eliminar_del_carrito($producto_elim) {

	if (!isset($_SESSION["carrito"])) {//reporta un error porque no está creado el carrito o el elemento no está en el carrito
		//salta un error y reenvia a error.php
		header("Location: error.php");
	} else {
		//se extrae el carrito de $_SESSION
		$carrito = $_SESSION["carrito"];
		//se elimina $_SESSION
		unset($_SESSION["carrito"]);
		//se elimina del carrito el producto dicho
		//array_diff($carrito, array($producto));
		//if (($key = array_search($producto, $carrito)) !== false) {
	    //unset($carrito[$key]);
	    unset($carrito[$producto_elim]);
		}
		//normalizo los indices
		//se agrega carrito a $_SESSION
		$_SESSION["carrito"] = array_values($carrito);
	}
?>