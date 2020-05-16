<?php
	require("requires/requires.php");
	require_once("gestionarUsuarios.php");
	
function darBajaUsuario($conexion,$id){
	
	try {
		$consulta = "CALL BAJA_USUARIO(:id)";

		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':id', $id);

		$stmt -> execute();
		return true;

	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}
}
/*
function darBajaDefinitiva($conexion,$id){
	try{
		$consulta = "DELETE FROM USUARIOS WHERE ID_USUARIO = :id";
	
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':id', $id);

		$stmt -> execute();
		return true;

	} catch(PDOException $e ) {
		echo $e -> getMessage();
		return FALSE;
	}
}
*/
if(!isset($_SESSION["login"])){
	
	//si no está logueado por algún error vuelve al login
	Header("Location:login.php");
	
} else {
	
	//abrimos la conexion para realizar dicha Modificación en la BBDD
	$conexion=crearConexionBD();
	
	//se extrae dicho $login de $_SESSION (para almacenarlo antes de eliminarlo)
	$login=$_SESSION["login"];
	
	//se elimina la variable $_SESSION (ya se ha deslogueado)
	unset($_SESSION['login']);
	
	$id = getIdUsuario($conexion, $login);
	//se da de baja dicho login
	darBajaUsuario($conexion,$id[0]);
	
	//cerramos conexión por que ya se ha ejecutado
	cerrarConexionBD($conexion);
	
	header("Location: portada.php");
	
}


?>