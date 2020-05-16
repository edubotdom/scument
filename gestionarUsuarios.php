<?php

function alta_usuario($conexion, $usuario) {

	//formateamos las fechas
	$fecha_ingreso = date('d/m/Y');
	//fecha de ingreso es la actual
	$fecha_nacimiento = date('d/m/Y', strtotime($usuario["fecha_nacimiento"]));
	$ultima_fecha_acceso = date('d/m/Y');
	//última vez que estuvo activo es la fecha de creación

	try {
		$consulta = "CALL ALTA_CLIENTE(:dni_cif,:login,:nombre,:contrasena,
				:direccion,:correo_electronico,:telefono_movil,
				:fecha_ingreso,:fecha_nacimiento,:ultima_fecha_acceso,
				1,:telefono_fijo,0,'Por defecto','PARTICULAR')";

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
		$stmt -> bindParam(':telefono_fijo', $usuario["telefono_fijo"]);

		$stmt -> execute();
		return true;

	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}

}

function alta_empresa($conexion, $usuario) {

	//formateamos las fechas
	$fecha_ingreso = date('d/m/Y');
	//fecha de ingreso es la actual
	$fecha_nacimiento = /*null*/date('d/m/Y');
	//fecha de nacimiento al ser una empresa decimos que no existe
	$ultima_fecha_acceso = date('d/m/Y');
	//última vez que estuvo activo es la fecha de creación

	try {
		$consulta = "CALL ALTA_CLIENTE(:dni_cif,:login,:nombre,:contrasena,
				:direccion,:correo_electronico,:telefono_movil,
				:fecha_ingreso,:fecha_nacimiento,:ultima_fecha_acceso,
				1,:telefono_fijo,0,'Por defecto',:tipo_cliente)";

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
		$stmt -> bindParam(':telefono_fijo', $usuario["telefono_fijo"]);
		$stmt -> bindParam(':tipo_cliente', $usuario["tipo_cliente"]);

		$stmt -> execute();
		return true;

	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}

}

function datosUsuario($conexion, $login) {
	try {
		$stmt = $conexion -> prepare("SELECT dni_cif,login,nombre,direccion,correo_electronico,fecha_ingreso,fecha_nacimiento,telefono_fijo,telefono_movil,tipo_cliente FROM CLIENTES WHERE LOGIN = :LOGIN");
		$stmt -> bindParam(":LOGIN", $login);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}


function getIdUsuario($conexion, $login) {
	try {
		$stmt = $conexion -> prepare("SELECT id_usuario FROM CLIENTES WHERE LOGIN = :LOGIN");
		$stmt -> bindParam(":LOGIN", $login);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function getUsuario($conexion, $login) {
	try {
		$stmt = $conexion -> prepare("SELECT LOGIN FROM CLIENTES WHERE LOGIN = :LOGIN");
		$stmt -> bindParam(":LOGIN", $login);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function getUsuarioDNI($conexion, $dni_cif) {
	try {
		$stmt = $conexion -> prepare("SELECT DNI_CIF FROM CLIENTES WHERE DNI_CIF = :DNI_CIF");
		$stmt -> bindParam(":DNI_CIF", $dni_cif);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function getUsuarioActivo($conexion, $login) {
	try {
		$stmt = $conexion -> prepare("SELECT ACTIVO FROM CLIENTES WHERE LOGIN = :LOGIN");
		$stmt -> bindParam(":LOGIN", $login);
		$stmt -> execute();
		return $stmt -> fetch()[0];
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function validarLogin($conexion, $usuario, $contrasena) {
	try {
		$errores = array();
		$user = getUsuario($conexion, $usuario);
		if (empty($usuario)) {
			$errores[] = 'El usuario está vacío.';
			unset($_SESSION['login']);
		} else if (empty($user['LOGIN'])) {
			$errores[] = 'El usuario no se encuentra registrado.';
		} else if((getUsuarioActivo($conexion, $usuario))==0){
			$errores[] = 'El usuario ha sido dado de baja.';
		} else {
			$_SESSION['login'] = $usuario;
		}
		if (empty($contrasena)) {
			$errores[] = 'La contraseña esta vacía.';
			unset($_SESSION['contrasena']);
		} else {
			$_SESSION['contrasena'] = $contrasena;
		}
		return $errores;
		
	} catch(PDOException $e) {
		return $errores;
		//return $e -> getMessage();
	}
}

function consultarUsuario($conexion,$login,$contrasena) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTES WHERE LOGIN=:login AND CONTRASENA=:contrasena";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':login',$login);
	$stmt->bindParam(':contrasena',$contrasena);
	$stmt->execute();
	return $stmt->fetchColumn();
}


?>