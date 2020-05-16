<?php 
require_once("gestionBD.php");
require_once("gestionarUsuarios.php");
require("requires/requires.php");
$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/mis_pedidos.css">
		<title>MONDECOPY SL.</title>
	</head>
	<?php
	include_once ("cabecera.php");
	include_once ("barra_lateral.php");
	function getTransaccionesUsuario($conexion, $idUsuario) {
	try {
		$stmt = $conexion -> prepare("SELECT id_transaccion,fecha_ejecucion,importe,tipo_transaccion FROM TRANSACCIONES WHERE CLIENTES = :ID_USUARIO");
		$stmt -> bindParam(":ID_USUARIO", $idUsuario);
		$stmt -> execute();
		return $stmt;
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}
	?>
	<body>
	<p id="titulo">Transacciones realizadas por el usuario.</p>
		<?php
	$filas = getTransaccionesUsuario($conexion, getIdUsuario($conexion, $_SESSION["login"])[0]);
	
	if(count($filas)==0){
		?> <p>Este usuario no tiene transacciones realizadas.</p><?php
	} else {

		?><table id="transacciones">
			<tr>
			<th>
				ID DE TRANSACCION
			</th>
			<th>
				FECHA EJECUCIÓN
			</th>
			<th>
				IMPORTE
			</th>
			<th>
				TIPO DE TRANSACCIÓN
			</th>
			</tr>
			<?php
	foreach($filas as $fila) {
			?>
			<tr>
				<td class="id_transaccion">
					<?php
					echo $fila[0];
					?>
				</td>
				<td class="fecha_ejecucion">
					<?php
					echo $fila[1];
					?>
				</td> 
				<td class="importe">
					<?php
					echo $fila[2];
					?>
				</td> 
				<td class="tipo_transaccion">
					<?php
					echo $fila[3];
					?>
				</td>
			</tr>  					
	<?php } ?>
		</table>
		<?php } ?>	
	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>