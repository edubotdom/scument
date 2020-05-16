<?php

function alta_empleado($conexion, $usuario) {

	//formateamos las fechas
	$fecha_ingreso = date('d/m/Y');
	//fecha de ingreso es la actual
	$fecha_nacimiento = date('d/m/Y', strtotime($usuario["fecha_nacimiento"]));
	$ultima_fecha_acceso = null;
	
	$fecha_vinculacion = date('d/m/Y');
	//última vez que estuvo activo es la fecha de creación

	try {
		$consulta = "CALL ALTA_EMPLEADO(:dni_cif,:login,:nombre,:contrasena,
				:direccion,:correo_electronico,:telefono_movil,
				:fecha_ingreso,:fecha_nacimiento,:ultima_fecha_acceso,
				1, 0, :fecha_vinculacion, null)";

		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':dni_cif', $usuario["dni_cif"]);
		$stmt -> bindParam(':login', $usuario["login"]);
		$stmt -> bindParam(':nombre', $usuario["nombre"]);
		$stmt -> bindParam(':contrasena', $usuario["contrasena"]);
		$stmt -> bindParam(':direccion', $usuario["direccion"]);
		$stmt -> bindParam(':correo_electronico', $usuario["correo_electronico"]);
		$stmt -> bindParam(':telefono_movil', $usuario["telefono_movil"]);
		$stmt -> bindParam(':fecha_ingreso', $fecha_ingreso);
		$stmt -> bindParam(':fecha_nacimiento', $fecha_nacimiento);
		$stmt -> bindParam(':ultima_fecha_acceso', $ultima_fecha_acceso);
		$stmt -> bindParam(':fecha_vinculacion', $fecha_vinculacion);
		$stmt -> execute();
		
		return true;

	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}
	
}

function datosEmpleado($conexion, $login) {
	try {
		$stmt = $conexion -> prepare("SELECT dni_cif,login,nombre,direccion,correo_electronico,fecha_ingreso,fecha_nacimiento,ultima_fecha_acceso,telefono_movil,salario,fecha_vinculacion,fecha_desvinculacion FROM EMPLEADOS WHERE LOGIN = :LOGIN");
		$stmt -> bindParam(":LOGIN", $login);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}


function getIdEmpleado($conexion, $login) {
	try {
		$stmt = $conexion -> prepare("SELECT id_usuario FROM EMPLEADOS WHERE LOGIN = :LOGIN");
		$stmt -> bindParam(":LOGIN", $login);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function getEmpleado($conexion, $login) {
	try {
		$stmt = $conexion -> prepare("SELECT LOGIN FROM EMPLEADOS WHERE LOGIN = :LOGIN");
		$stmt -> bindParam(":LOGIN", $login);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function getEmpleadoDNI($conexion, $dni_cif) {
	try {
		$stmt = $conexion -> prepare("SELECT DNI_CIF FROM EMPLEADOS WHERE DNI_CIF = :DNI_CIF");
		$stmt -> bindParam(":DNI_CIF", $dni_cif);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function validarLoginEmpleado($conexion, $usuario) {
	try {
		$errores = array();
		$user = getEmpleado($conexion, $usuario['login'], $usuario['contrasena']);
		if (empty($usuario['login'])) {
			$errores[] = 'El empleado está vacío.';
			unset($_SESSION['login']);
		} else if (empty($user['login'])) {
			$errores[] = 'El empleado no se encuentra registrado.';
		} else {
			$_SESSION['login'] = $usuario['login'];
		}
		if (empty($user['contrasena'])) {
			$errores[] = 'La contraseña esta vacía.';
			unset($_SESSION['contrasena']);
		} else {
			$_SESSION['contrasena'] = $usuario['contrasena'];
		}
	} catch(PDOException $e) {
		return $errores;
		//return $e -> getMessage();
	}
}

function consultarEmpleado($conexion,$login,$contrasena) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM EMPLEADOS WHERE LOGIN=:login AND CONTRASENA=:contrasena";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':login',$login);
	$stmt->bindParam(':contrasena',$contrasena);
	$stmt->execute();
	return $stmt->fetchColumn();
}

?>