<?php
require_once ("requires/requires.php");
require ("gestionarCarrito.php");
require ("gestionarProductos.php");

if(!isset($_SESSION["login"])){
	Header("Location:login.php");
}

//PROCESO PARA ANADIR ELEMENTOS AL CARRITO
if (isset($_POST["id_producto"])) {
	// hay que crear $agregado_carrito que incluya el id_producto y que contenga la cantidad seleccionada
	$agregado_carrito = array($_POST["id_producto"], $_POST["cantidad"]);
	//hay que agregar dicha variable al array del carrito mediante la siguiente funcion:
	agregar_al_carrito($agregado_carrito);
}

if (isset($_POST["eliminar"])) {
eliminar_del_carrito($_POST["producto_elim"]);
	if(count($_SESSION["carrito"])==0){
		unset($_SESSION["carrito"]);
	}	
}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/carrito.css">
		<title>MONDECOPY SL.</title>
	</head>
	<?php
	include_once ("cabecera.php");
	?>

	<body>
		<!-- redireccion de botones con javascrips; (mis datos, mis pedidos, mis alquileres, carrito-->
		<!-- lista de productos, detallandolos con una descripcion y botones correspondientes a:
		más informacion, retirar del carrito-->

		<!-- boton de procesar y pagar (redirige a pantalla compra) -->
		<!--paginacion de los resultados-->

		<header>
			<b>Carrito</b>
		</header>
		
		<?php crearMenu($conexion, $login); ?>
			
		<?php
		//PROCESO PARA PROCESAR LOS DATOS ALMACENADOS EN $_SESSION, Y PASARLOS A UNA VARIABLE LOCAL PARA QUE SE MUESTREN POR PANTALLA. PARA ELLO
		//SE OBTIENE INFORMACION SOBRE NOMBRE Y PRECIO DE LA BBDD SEGUN EL ID QUE ESTA ALMACENADO EN EL CARRITO.
		if (isset($_SESSION['carrito'])) {
		$carro = $_SESSION['carrito'];
		?>
		
		<h2> Productos en el carrito</h2>
		
		<?php
		include_once ("barra_lateral.php");
		
		$elementos_carrito = array();
		for ($i = 0; $i < count($carro); $i++) {
		array_push($elementos_carrito, consulta_producto($conexion, $carro[$i][0]));
		}
		
		$cantidades_carrito = array();
		for ($i = 0; $i < count($carro); $i++) {
		array_push($cantidades_carrito, $carro[$i][1]);
		}
		?>
		<?php for ($i = 0; $i < count($elementos_carrito); $i++) {
		?>

		<article class="CARRITO">
			<div class="nombre">
				<?php echo "<p><b>" . " Nombre:</b> <b>" . $elementos_carrito[$i][0] . "</b></p>"; ?>
			</div>
			<div class="precio">
				<?php echo "<p><b>" . "Precio:</b> " . $elementos_carrito[$i][1] . "€" . "</p>"; ?>
			</div>
			<div class="cantidad">
				<?php echo "<p><b>" . "Cantidad:</b> " . $cantidades_carrito[$i] . "</p>"; ?>
			</div>
			<div class="eliminar">
				<form id="eliminar" action="carrito.php" method="post">
				<input type="hidden" name="producto_elim" id="producto_elim"
					value="<?php echo $i; ?>" />
				<input type="hidden" name="eliminar" id="eliminar"
					value="1" />
				<button class="bot_eliminar" name="bot_eliminar" type = "submit">
					<b>Eliminar producto</b>
				</button>	
				</form>
			</div>
		</article>
		<?php }

			function suma_precios($elementos_carrito,$cantidades_carrito){
			$suma = 0;
			for($i = 0; $i < count($elementos_carrito);$i++){
			$suma = $suma + $elementos_carrito[$i][1] * $cantidades_carrito[$i];
			}
			return $suma;
			}
		?>
		<!-- Precio total de los objetos seleccionados -->
		<div class="precio_total">
			<?php echo "<p><b>" . "Precio total:</b> " . suma_precios($elementos_carrito, $cantidades_carrito) . "€" . "</p>"; ?>
		</div>
		<br>
		<br>
		<br>
		<!-- Boton de compra -->
		<div>
			<form action="gestionarTransaccion.php" method="post">
				<input type="hidden" name="importe" id="importe"
				value="<?php echo suma_precios($elementos_carrito, $cantidades_carrito); ?>" />
				<input type="hidden" name="id_usuario" id="id_usuario"
				value="<?php echo getIdUsuario($conexion, $login)[0] ?>" />
				<input type="hidden" name="compra_objeto" id="compra_objeto"
				value="1" >
				<button class="compra" name="compra" type = "submit">
					<b>Confirmar compra</b>
				</button>
			</form>
		</div>
		<?php } else {
			echo "<h2>El carrito está vacío</h2>";
			include_once ("barra_lateral.php");
			}
		?>
	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>