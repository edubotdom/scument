<?php
//require ("requires/requires.php");
//require("gestionarTransaccion.php");
function crea_linea_transaccion_servicio($conexion, $id_producto, $importe, $tipo_impositivo, $tasa_fija, $login) {
	try {
		$consulta = "CALL ADD_LINEA (null, 1, :W_IMPORTE, :W_TIPO_IMPOSITIVO, :W_TASA_FIJA, null, :W_SERVICIOS, :W_TRANSACCIONES)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':W_SERVICIOS', $id_producto);
		$stmt -> bindParam(':W_IMPORTE', $importe);
		$stmt -> bindParam(':W_TIPO_IMPOSITIVO', $tipo_impositivo);
		$stmt -> bindParam(':W_TASA_FIJA', $tasa_fija);
		$stmt -> bindParam(':W_TRANSACCIONES', getIdTransaccionActual($conexion));
		$stmt -> execute();
		return TRUE;
	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}
}

function crea_linea_transaccion_objeto($conexion, $id_producto, $importe, $tipo_impositivo, $tasa_fija, $login, $cantidad, $transaccion) {
	try {
		$consulta = "CALL ADD_LINEA (0, :W_CANTIDAD, :W_IMPORTE, :W_TIPO_IMPOSITIVO, :W_TASA_FIJA, :W_OBJETOS, null, :W_TRANSACCIONES)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':W_OBJETOS', $id_producto);
		$stmt -> bindParam(':W_CANTIDAD', $cantidad);
		$stmt -> bindParam(':W_IMPORTE', $importe);
		$stmt -> bindParam(':W_TIPO_IMPOSITIVO', $tipo_impositivo);
		$stmt -> bindParam(':W_TASA_FIJA', $tasa_fija);
		$stmt -> bindParam(':W_TRANSACCIONES', $transaccion);
		$stmt -> execute();
		return TRUE;
	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}
}
function getIdTransaccionActual($conexion) {
	try {
		$stmt = $conexion -> prepare("SELECT SEC_ID_TRANSACCION.nextval from (select level from dual connect by level < 2)");
		$stmt -> execute();
		return $stmt -> fetch()[0] - 1;
	} catch(PDOException $e) {
		return $e -> GetMessage();
	}
}
?>