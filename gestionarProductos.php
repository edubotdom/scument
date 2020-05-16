<?php
function consulta_producto($conexion, $id_producto){
	
	try{
		//$consulta_producto = "SELECT (*)"." FROM OBJETOS"." WHERE ID_PRODUCTO = :ID_PRODUCTO";
		
		$stmt = $conexion-> prepare("SELECT NOMBRE,PRECIO,TIPO_IMPOSITIVO,TASA_FIJA FROM OBJETOS WHERE ID_PRODUCTO = :ID_PRODUCTO");
		$stmt -> bindParam(":ID_PRODUCTO", $id_producto);
		$stmt -> execute();
		return $stmt -> fetch();
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
}

function modifica_precio_producto($conexion,$precio,$id_producto){
	try {
		$consulta = "CALL MODIFICA_PRECIO_OBJETO (:W_PRECIO, :W_ID_PRODUCTO)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':W_PRECIO', $precio);
		$stmt -> bindParam(':W_ID_PRODUCTO', $id_producto);
		$stmt -> execute();
		return TRUE;
	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}
}

function modifica_precio_servicio($conexion,$precio,$id_servicio){
	try {
		$consulta = "CALL MODIFICA_PRECIO_SERVICIO (:W_PRECIO, :W_ID_SERVICIO)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':W_PRECIO', $precio);
		$stmt -> bindParam(':W_ID_SERVICIO', $id_servicio);
		$stmt -> execute();
		return TRUE;
	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}
}

function eliminar_objeto($conexion,$id_objeto) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINA_OBJETO(:id_producto)');
		$stmt->bindParam(':id_producto',$id_objeto);
		$stmt->execute();
		return TRUE;
	} catch(PDOException $e) {
			echo $e->getMessage();
		return FALSE;
    }
}

function eliminar_servicio($conexion,$id_servicio) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINA_SERVICIO(:id_servicio)');
		$stmt->bindParam(':id_servicio',$id_servicio);
		$stmt->execute();
		return TRUE;
	} catch(PDOException $e) {
		echo $e->getMessage();
		return FALSE;
    }
}

?>