<?php
	require("requires/requires.php");
	require_once("gestionarProductos.php");
	require_once("gestionarLineaTransaccion.php");
function crea_transaccion($conexion, $importe, $login) {
	try {
		$consulta = "CALL CREA_TRANSACCION (:W_FECHA_EJECUCION, :W_IMPORTE, :W_FECHA_PAGO, 'EFECTIVO', 'COMPRA', :W_CLIENTES, 1)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':W_FECHA_EJECUCION', date('d/m/Y'));
		$stmt -> bindParam(':W_IMPORTE', $importe);
		$stmt -> bindParam(':W_FECHA_PAGO', date('d/m/Y'));
		$stmt -> bindParam(':W_CLIENTES', $login);
		$stmt -> execute();
		return TRUE;
	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}
}

if(!isset($_SESSION["login"])){
	Header("Location:login.php");
}

if(crea_transaccion($conexion, $_REQUEST["importe"], $_REQUEST["id_usuario"])){
		echo "haz algo";
	if(isset($_REQUEST["servicio"])){
		if(crea_linea_transaccion_servicio($conexion, $_REQUEST["id_producto"], $_REQUEST["importe"], $_REQUEST["tipo_impositivo"], $_REQUEST["tasa_fija"], $_REQUEST["id_usuario"])){
			Header("Location: exito_compra.php");
		} else {
			Header("Location: fracaso_compra.php");
		}}
	echo "descarto servicio";
	if(isset($_REQUEST["compra_objeto"])){
		echo"Procesando transaccion";
		
		$carro = $_SESSION["carrito"];
		$elementos_carrito = array();
		$cantidades_carrito = array();
		$transaccion = getIdTransaccionActual($conexion);
		for($i=0; $i<count($carro); $i++){
			array_push($elementos_carrito, consulta_producto($conexion, $carro[$i][0]));
			array_push($cantidades_carrito, $carro[$i][1]);
		}
		echo"Productos consultados";
		for($i=0; $i<count($carro); $i++){
			//NOMBRE,PRECIO,TIPO_IMPOSITIVO,TASA_FIJA
			$id_obj=$carro[$i][0];
			echo "$id_obj";
			echo $_REQUEST["id_usuario"];
			$cant_obj = $cantidades_carrito[$i];
			$nombre=$elementos_carrito[$i][0];
			$precio=$elementos_carrito[$i][1];
			$tipo_impositivo = $elementos_carrito[$i][2];
			$tasa_fija = $elementos_carrito[$i][3];
			$importe = $cant_obj * $precio + $tasa_fija+ $cant_obj * $precio * $tipo_impositivo;
			if(crea_linea_transaccion_objeto($conexion, $id_obj, $importe, $tipo_impositivo, $tasa_fija, $_REQUEST["id_usuario"], $cant_obj, $transaccion)){
				echo "Linea transaccion anadida";
				//Header("Location: exito_compra.php");
			} else {
				Header("Location: fracaso_compra.php");
			}
		}
	}
	
	Header("Location: exito_compra.php");
} else {
	Header("Location: fracaso_compra.php");
}


?>